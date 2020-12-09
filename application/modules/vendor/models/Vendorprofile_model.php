<?php

class Vendorprofile_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getVendorInfoFromEmail($email)
    {
        $this->db->where('email', $email);
        $result = $this->db->get('vendors');
        return $result->row_array();
    }

    public function getVendorInfoFromHashedCredentials($email,$pass)
    {
        $this->db->where('md5(email)', $email);
        $this->db->where('md5(password)', $pass);
        $result = $this->db->get('vendors');
        return $result->row_array();
    }

    public function getTranslations($id)
    {
        $this->db->where('for_id', $id);
        $query = $this->db->get('vendor_profile_translations');
        $arr = array();
        foreach ($query->result() as $row) {
            $arr[$row->abbr]['description'] = $row->description;
        }
        return $arr;
    }

    public function getVendorByUrlAddress($urlAddr)
    {
        $this->db->where('url', $urlAddr);
        $result = $this->db->get('vendors');
        return $result->row_array();
    }

    public function saveNewVendorDetails($post, $vendor_id)
    {
        $updated_at = date("Y-m-d H:i:s");
        $birthdate = DateTime::createFromFormat('d.m.Y', !empty($post['vendor_birthday']) ? trim($post['vendor_birthday']) : '');
        if($birthdate) {
            $birthdate = $birthdate->format('Y-m-d');
        }else{
            $birthdate = '';
        }
        if (!$this->db->where('id', $vendor_id)->update('vendors', array(
                'name' => $post['vendor_name'],
                'url' => trim($post['vendor_url']),
                'street' => !empty($post['vendor_street']) ? trim($post['vendor_street']) : '',
                'number' => !empty($post['vendor_number']) ? trim($post['vendor_number']) : '',
                'city' => !empty($post['vendor_city']) ? trim($post['vendor_city']) : '',
                'post_code' => !empty($post['vendor_post_code']) ? trim($post['vendor_post_code']) : '',
                'country' => !empty($post['vendor_country']) ? trim($post['vendor_country']) : '',
                'phone' => !empty($post['vendor_phone']) ? trim($post['vendor_phone']) : '',
                'mobile' => !empty($post['vendor_mobile']) ? trim($post['vendor_mobile']) : '',
                'website' => !empty($post['vendor_website']) ? trim($post['vendor_website']) : '',
                'telegram' => !empty($post['vendor_telegram']) ? trim($post['vendor_telegram']) : '',
                'surname' => !empty($post['vendor_surname']) ? trim($post['vendor_surname']) : '',
                'gender' => !empty($post['vendor_gender']) ? trim($post['vendor_gender']) : '',
                'birthday' => $birthdate,
                'updated_at' => $updated_at
            ))) {
            log_message('error', print_r($this->db->error(), true));
        }
        $this->setVendorProfileTranslation($post,$vendor_id);
    }

    private function setVendorProfileTranslation($post, $id)
    {
        $i = 0;
        $current_trans = $this->getTranslations($id, 'product');
        foreach ($post['translations'] as $abbr) {
            $arr = array();
            $arr = array(
                'description' => !empty($post['vendor_description'][$i]) ? trim($post['vendor_description'][$i]) : '',
                'abbr' => $abbr,
                'for_id' => $id
            );

            $emergency_insert = false;
            if (!isset($current_trans[$abbr])) {
                $emergency_insert = true;
            }

            if ($emergency_insert === false) {
                $abbr = $arr['abbr'];
                unset($arr['for_id'], $arr['abbr']);
                if (!$this->db->where('abbr', $abbr)->where('for_id', $id)->update('vendor_profile_translations', $arr)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            } else {
                if (!$this->db->insert('vendor_profile_translations', $arr)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            }
            $i++;
        }
    }

    public function isVendorUrlFree($vendorUrl)
    {
        $this->db->where('url', $vendorUrl);
        $num = $this->db->count_all_results('vendors');
        if ($num > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getOrdersByMonth($vendor_id)
    {
        $vendor_id = (int)$vendor_id;
        $result = $this->db->query("SELECT YEAR(FROM_UNIXTIME(date)) as year, MONTH(FROM_UNIXTIME(date)) as month, COUNT(id) as num FROM vendors_orders WHERE vendor_id = $vendor_id GROUP BY YEAR(FROM_UNIXTIME(date)), MONTH(FROM_UNIXTIME(date)) ORDER BY year, month ASC");
        $result = $result->result_array();
        $orders = array();
        $years = array();
        if(!empty($result)) {
            foreach ($result as $res) {
                if (!isset($orders[$res['year']])) {
                    for ($i = 1; $i <= 12; $i++) {
                        $orders[$res['year']][$i] = 0;
                    }
                }
                $years[] = $res['year'];
                $orders[$res['year']][$res['month']] = $res['num'];
            }
        }
        return array(
            'years' => count($years) > 0 ? array_unique($years): [],
            'orders' => count($orders) > 0 ? $orders : [],
        );
    }

}
