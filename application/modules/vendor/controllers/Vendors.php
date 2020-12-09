<?php

/*
 * @Author:    Benjamin Piltz
 *  Gitgub:    https://github.com/bpiltz
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Vendors extends VENDOR_Controller
{

    private $num_rows = 20;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Vendors_model');
    }

    public function index($page = 0)
    {
 
        $data = array();
        $head = array();
        $head['title'] = lang('vendor_vendors');
        $head['description'] = lang('vendor_vendors');
        $head['keywords'] = '';
        $filterName = isset($_POST['vendors_filter_name']) ? $_POST['vendors_filter_name'] : '';
        $filterNDescription = isset($_POST['vendors_filter_description']) ? $_POST['vendors_filter_description'] : '';
        $data['vendors'] = $this->Vendors_model->getVendors($this->num_rows, $page, $filterName, $filterNDescription);
        if(isset($_POST['vendors_filter_submit'])){
            $data['filter'] = $_POST;
        }else{
            $data['filter'] = array(
                'vendors_filter_name' => '', 
                'vendors_filter_description' => ''
            );
        }
        
        // var_dump($data);
        /*
        $rowscount = $this->Products_model->productsCount($this->vendor_id);
        $data['products'] = $this->Products_model->getproducts($this->num_rows, $page, $this->vendor_id);
        $data['links_pagination'] = pagination('vendor/settings', $rowscount, $this->num_rows, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
        */
        $this->load->view('_parts/header', $head);
        $this->load->view('vendors', $data);
        $this->load->view('_parts/footer');

        
    }

    public function logout()
    {
        unset($_SESSION['logged_vendor']);
        delete_cookie('logged_vendor');
        redirect(LANG_URL . '/vendor/login');
    }

}
