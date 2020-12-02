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

    public function getVendorByUrlAddress($urlAddr)
    {
        $this->db->where('url', $urlAddr);
        $result = $this->db->get('vendors');
        return $result->row_array();
    }

    public function saveNewVendorDetails($post, $vendor_id)
    {
        $birthdate = DateTime::createFromFormat('d.m.Y', !empty($_POST['vendor_birthday']) ? trim($post['vendor_birthday']) : '');
        $birthdate = $birthdate->format('Y-m-d');
        if (!$this->db->where('id', $vendor_id)->update('vendors', array(
                'name' => $post['vendor_name'],
                'url' => trim($post['vendor_url']),
                'street' => !empty($_POST['vendor_street']) ? trim($post['vendor_street']) : '',
                'number' => !empty($_POST['vendor_number']) ? trim($post['vendor_number']) : '',
                'city' => !empty($_POST['vendor_city']) ? trim($post['vendor_city']) : '',
                'post_code' => !empty($_POST['vendor_post_code']) ? trim($post['vendor_post_code']) : '',
                'country' => !empty($_POST['vendor_country']) ? trim($post['vendor_country']) : '',
                'phone' => !empty($_POST['vendor_phone']) ? trim($post['vendor_phone']) : '',
                'mobile' => !empty($_POST['vendor_mobile']) ? trim($post['vendor_mobile']) : '',
                'website' => !empty($_POST['vendor_website']) ? trim($post['vendor_website']) : '',
                'telegram' => !empty($_POST['vendor_telegram']) ? trim($post['vendor_telegram']) : '',
                'surname' => !empty($_POST['vendor_surname']) ? trim($post['vendor_surname']) : '',
                'gender' => !empty($_POST['vendor_gender']) ? trim($post['vendor_gender']) : '',
                'birthday' => $birthdate
            ))) {
            log_message('error', print_r($this->db->error(), true));
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
