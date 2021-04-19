<?php

class Vendors_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getVendors($limit, $page, $search_name, $search_description)
    {
        $this->db->order_by('vendors.name', 'asc');
        $this->db->join('vendor_profile_translations', 'vendor_profile_translations.for_id = vendors.id', 'left');
        $where = "";
        $where .= "(`name` LIKE '%" . $search_name . "%' ESCAPE '!' OR `surname` LIKE '%" . $search_name . "%' ESCAPE '!') AND ";
        if($search_description != ""){
            $where .= "`vendor_profile_translations`.`description` LIKE '%" . $search_description . "%' ESCAPE '!' AND ";    
        }
        $where .= "(`vendor_profile_translations`.`abbr` = '" . MY_DEFAULT_LANGUAGE_ABBR . "' OR `vendor_profile_translations`.`abbr` IS NULL)";
        $this->db->where($where);
        $query = $this->db->select('vendors.*, vendor_profile_translations.description')->get('vendors', $limit, $page);
        //echo $this->db->last_query();
        //echo "<br/><br/><br/>";
        $result = $query->result();
        $with_pic = array();
        $no_pic = array();

        for ($i = 0; $i < count($result); $i++)  {
            if(strlen($result[$i]->profile_image) > 0){
                array_push($with_pic, $result[$i]);
            }else{
                array_push($no_pic, $result[$i]);
            }
        }
        $array_priorized = array_merge($with_pic, $no_pic);
        
        return $array_priorized;
    }

    public function getVendor($id)
    {
        $this->db->order_by('vendors.name', 'asc');
        $this->db->join('vendor_profile_translations', 'vendor_profile_translations.for_id = vendors.id', 'left');
        
        $where = "(`vendors.id` = " . $id  . ") ";
        $where .= "AND (`vendor_profile_translations`.`abbr` = '" . MY_DEFAULT_LANGUAGE_ABBR . "' OR `vendor_profile_translations`.`abbr` IS NULL)";
        $this->db->where($where);
        $query = $this->db->select('vendors.*, vendor_profile_translations.description')->get('vendors', 1, 0);
        //echo $this->db->last_query();
        return $query->result();
    }    

}
