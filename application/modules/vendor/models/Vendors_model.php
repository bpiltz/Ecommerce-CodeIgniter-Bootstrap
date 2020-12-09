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
        
        $where = "(`name` LIKE '%" . $search_name . "%' ESCAPE '!' OR `surname` LIKE '%" . $search_name . "%' ESCAPE '!') ";
        $where .= "AND `vendor_profile_translations`.`description` LIKE '%" . $search_description . "%' ESCAPE '!' ";
        $where .= "AND `vendor_profile_translations`.`abbr` = '" . MY_DEFAULT_LANGUAGE_ABBR . "'";
        $this->db->where($where);
        $query = $this->db->select('vendors.*, vendor_profile_translations.description')->get('vendors', $limit, $page);
        //echo $this->db->last_query();
        return $query->result();
    }

}
