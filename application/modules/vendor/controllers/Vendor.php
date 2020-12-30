<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Vendor extends VENDOR_Controller
{

    private $num_rows = 20;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('vendor/Vendorprofile_model');
        $this->load->model('Vendors_model');
    }

    public function index($vendor = null)
    {
        $vendorInfo = $this->Vendorprofile_model->getVendorByUrlAddress($vendor);
        if ($vendorInfo == null) {
            show_404();
        }
        $data = array();
        $head = array();
        $head['title'] = $vendorInfo['surname'] . ' ' . $vendorInfo['name'];
        $head['description'] = $vendorInfo['surname'] . ' ' . $vendorInfo['name'];
        $head['keywords'] = '';
        $data['vendor'] = $this->Vendors_model->getVendor($vendorInfo['id']);
        //$rowscount = $this->Products_model->productsCount($this->vendor_id);
        //$data['products'] = $this->Products_model->getproducts($this->num_rows, $page, $this->vendor_id);
        //$data['links_pagination'] = pagination('vendor/settings', $rowscount, $this->num_rows, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
        $this->load->view('_parts/header', $head);
        $this->load->view('vendor', $data);
        $this->load->view('_parts/footer');
    }

    public function deleteProduct($id)
    {
        $this->Products_model->deleteProduct($id, $this->vendor_id);
        $this->session->set_flashdata('result_delete', lang('vendor_product_deleted'));
        redirect(LANG_URL . '/vendor/products');
    }

    public function logout()
    {
        unset($_SESSION['logged_vendor']);
        delete_cookie('logged_vendor');
        redirect(LANG_URL . '/vendor/login');
    }

}
