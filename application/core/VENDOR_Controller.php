<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class VENDOR_Controller extends MX_Controller
{

    protected $allowed_img_types;
    public $vendor_id;
    public $vendor_name;
    public $vendor_url;
    public $vendor_profile;

    public function __construct()
    {
        parent::__construct();
        $this->loginCheck();
        $this->setVendorInfo();
        $this->allowed_img_types = $this->config->item('allowed_img_types');

        $this->load->model(array(
            'admin/Languages_model',
            ));

        $trans_load = null;
        if ($this->vendor_id) {
            $trans_load = $this->Vendorprofile_model->getTranslations($this->vendor_id);
        }

        $vars = array();
        $vars['vendor_name'] = $this->vendor_name;
        $vars['vendor_url'] = $this->vendor_url;
        $vars['vendor_street'] = $this->vendor_profile['vendor_street'];
        $vars['vendor_number'] = $this->vendor_profile['vendor_number'];
        $vars['vendor_city'] = $this->vendor_profile['vendor_city'];
        $vars['vendor_post_code'] = $this->vendor_profile['vendor_post_code'];
        $vars['vendor_country'] = $this->vendor_profile['vendor_country'];
        $vars['vendor_phone'] = $this->vendor_profile['vendor_phone'];
        $vars['vendor_mobile'] = $this->vendor_profile['vendor_mobile'];
        $vars['vendor_website'] = $this->vendor_profile['vendor_website'];
        $vars['vendor_telegram'] = $this->vendor_profile['vendor_telegram'];
        $vars['vendor_surname'] = $this->vendor_profile['vendor_surname'];
        $vars['vendor_gender'] = $this->vendor_profile['vendor_gender'];
        $vars['vendor_birthday'] = $this->vendor_profile['vendor_birthday'];
        $vars['languages'] = $this->Languages_model->getLanguages();
        $vars['trans_load'] = $trans_load;
        $this->load->vars($vars);
        if (isset($_POST['saveVendorDetails'])) {
            $this->saveNewVendorDetails();
        }
    }

    protected function loginCheck()
    {
        if (!isset($_SESSION['logged_vendor']) && get_cookie('logged_vendor') != null) {
            $_SESSION['logged_vendor'] = get_cookie('logged_vendor');
        }
        $authPages = array(
            'vendor/login',
            'vendor/register',
            'vendor/forgotten-password'
        );
        $urlString = uri_string();
        if (preg_match('/[a-zA-Z]{2}/', $urlString)) {
            $urlString = preg_replace('/^[a-zA-Z]{2}\//', '', $urlString);
        }
        if (!isset($_SESSION['logged_vendor']) && !in_array($urlString, $authPages)) {
            redirect(LANG_URL . '/vendor/login');
        } else if (isset($_SESSION['logged_vendor']) && in_array($urlString, $authPages)) {
            redirect(LANG_URL . '/vendor/me');
        }
    }

    protected function setLoginSession($email, $remember_me)
    {
        if ($remember_me == true) {
            set_cookie('logged_vendor', $email, 2678400);
        }
        $_SESSION['logged_vendor'] = $email;
    }

    private function setVendorInfo()
    {
        $this->load->model('Vendorprofile_model');
        if (isset($_SESSION['logged_vendor'])) {
            $array = $this->Vendorprofile_model->getVendorInfoFromEmail($_SESSION['logged_vendor']);
            $this->vendor_id = $array['id'];
            $this->vendor_name = $array['name'];
            $this->vendor_url = $array['url'];
            $this->vendor_profile = array();
            $this->vendor_profile['vendor_street'] = $array['street'];
            $this->vendor_profile['vendor_number'] = $array['number'];
            $this->vendor_profile['vendor_city'] = $array['city'];
            $this->vendor_profile['vendor_post_code'] = $array['post_code'];
            $this->vendor_profile['vendor_country'] = $array['country'];
            $this->vendor_profile['vendor_phone'] = $array['phone'];
            $this->vendor_profile['vendor_mobile'] = $array['mobile'];
            $this->vendor_profile['vendor_website'] = $array['website'];
            $this->vendor_profile['vendor_telegram'] = $array['telegram'];
            $this->vendor_profile['vendor_surname'] = $array['surname'];
            $this->vendor_profile['vendor_gender'] = $array['gender'];
            $this->vendor_profile['vendor_birthday'] = $array['birthday'];
        }
    }

    private function saveNewVendorDetails()
    {
        $errors = array();
        if (mb_strlen(trim($_POST['vendor_name'])) == 0) {
            $errors[] = lang('enter_vendor_name');
        }
        if (mb_strlen(trim($_POST['vendor_url'])) == 0) {
            $errors[] = lang('enter_vendor_url');
        }
        if (!$this->Vendorprofile_model->isVendorUrlFree($_POST['vendor_url']) && $this->vendor_url != trim($_POST['vendor_url'])) {
            $errors[] = lang('vendor_url_taken');
        }
        if (empty($errors)) {
            $this->session->set_flashdata('update_vend_details', lang('vendor_details_updated'));
            $this->Vendorprofile_model->saveNewVendorDetails($_POST, $this->vendor_id);
        } else {
            $this->session->set_flashdata('update_vend_err', $errors);
        }
        redirect(LANG_URL . '/vendor/profile');
    }

}
