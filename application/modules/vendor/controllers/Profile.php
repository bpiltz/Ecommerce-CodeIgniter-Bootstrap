<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Profile extends VENDOR_Controller
{

    private $num_rows = 20;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Products_model');
    }

    public function index($page = 0)
    {   
        $data = array();
        $head = array();
        $head['title'] = lang('vendor_profile');
        $head['description'] = lang('vendor_profile');
        $head['keywords'] = '';
        $this->load->view('_parts/header', $head);
        $this->load->view('profile', $data);
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
