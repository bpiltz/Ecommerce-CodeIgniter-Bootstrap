<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth extends VENDOR_Controller
{

    private $registerErrors = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Auth_model', 'Vendorprofile_model'));
    }

    public function index()
    {
        show_404();
    }

    public function login()
    {
        $data = array();
        $head = array();
        $head['title'] = lang('user_login_page');
        $head['description'] = lang('open_your_account');
        $head['keywords'] = '';

        if (isset($_POST['login'])) {
            $result = $this->verifyVendorLogin();
            if ($result == false) {
                $this->session->set_flashdata('login_error', lang('login_vendor_error'));
                redirect(LANG_URL . '/vendor/login');
            } else {
                $remember_me = false;
                if (isset($_POST['remember_me'])) {
                    $remember_me = true;
                }
                $this->setLoginSession($_POST['u_email'], $remember_me);
                redirect(LANG_URL . '/vendor/vendors');
            }
        }
        $this->load->view('_parts/header_auth', $head);
        $this->load->view('auth/login', $data);
        $this->load->view('_parts/footer_auth');
    }

    private function verifyVendorLogin()
    {
        return $this->Auth_model->checkVendorExsists($_POST);
    }

    public function register()
    {
        $data = array();
        $head = array();
        $head['title'] = lang('user_register_page');
        $head['description'] = lang('create_account');
        $head['keywords'] = '';
        if (isset($_POST['register'])) {
            $result = $this->registerVendor();
            if ($result == false) {
                $this->session->set_flashdata('error_register', $this->registerErrors);
                $this->session->set_flashdata('email', $_POST['u_email']);
                redirect(LANG_URL . '/vendor/register');
            } else {
                $this->setLoginSession($_POST['u_email'], false);
                redirect(LANG_URL . '/vendor/vendors');
            }
        }
        $this->load->view('_parts/header_auth', $head);
        $this->load->view('auth/register', $data);
        $this->load->view('_parts/footer_auth');
    }

    private function registerVendor()
    {
        $errors = array();
        if (mb_strlen(trim($_POST['u_password'])) == 0) {
            $errors[] = lang('please_enter_password');
        }
        if (mb_strlen(trim($_POST['u_password_repeat'])) == 0) {
            $errors[] = lang('please_repeat_password');
        }
        if ($_POST['u_password'] != $_POST['u_password_repeat']) {
            $errors[] = lang('passwords_dont_match');
        }
        if (!filter_var($_POST['u_email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = lang('vendor_invalid_email');
        }
        $count_emails = $this->Auth_model->countVendorsWithEmail($_POST['u_email']);
        if ($count_emails > 0) {
            $errors[] = lang('vendor_email_is_taken');
        }
        if (!empty($errors)) {
            $this->registerErrors = $errors;
            return false;
        }
        $this->Auth_model->registerVendor($_POST);
        return true;
    }

    public function forgotten()
    {
        if (isset($_POST['u_email'])) {
            $vendor = $this->Vendorprofile_model->getVendorInfoFromEmail($_POST['u_email']);
            if ($vendor != null) {
                $myDomain = $this->config->item('base_url');
                $email=md5($vendor['email']);
                $pass=md5($vendor['password']);
                $link="<a href='" . $myDomain . "vendor/change-password/" . $email . "/" . $pass . "'>Klicken um ein neues Passwort zu vergeben.</a>";
                // echo $link;
                
                $this->sendmail->sendTo($_POST['u_email'], 'Admin', 'Reset Passwort link für Konto bei ' . 
                    $myDomain, 'Hallo liebes Mitglied, <br/> <br/>hier der Link zum Rücksetzen des Passworts: <br/> <br/>' . $link . 
                    '<br/> <br/> Falls Du ihn nicht angefodert hast, kannst Du diese Nachricht ignorieren. <br/> <br/> Liebe Grüße,<br/> <br/>Dein Ortenau Netzwerk e.V.');
                $this->session->set_flashdata('link_sent', lang('new_pass_sended'));
                redirect(LANG_URL . '/vendor/login');
            }
        }

        $data = array();
        $head = array();
        $head['title'] = lang('user_forgotten_page');
        $head['description'] = lang('recover_password');
        $head['keywords'] = '';

        $this->load->view('_parts/header_auth', $head);
        $this->load->view('auth/recover_pass', $data);
        $this->load->view('_parts/footer_auth');
    }

    public function change($email = null, $pass = null)
    {
        $data = array();
        $head = array();
        $head['title'] = lang('user_change_password_page');
        $head['description'] = lang('user_change_password_page');
        $head['keywords'] = '';

        if (isset($_POST['change'])) {
            $errors = array();
            if (isset($_SESSION['logged_vendor'])) {
                if(mb_strlen(trim($_POST['u_password'])) == 0) {
                    $errors[] = lang('please_enter_old_password');
                }
            }
            if (mb_strlen(trim($_POST['u_password_new'])) == 0) {
                $errors[] = lang('please_enter_new_password');
            }
            if (mb_strlen(trim($_POST['u_password_repeat'])) == 0) {
                $errors[] = lang('please_repeat_new_password');
            }
            if ($_POST['u_password_new'] != $_POST['u_password_repeat']) {
                $errors[] = lang('passwords_dont_match');
            }

            if ($email && $pass) {
                $result = $this->Vendorprofile_model->getVendorInfoFromHashedCredentials($email,$pass);
                if($result === NULL){
                    $errors[] = lang('vendor_change_password_error');
                }else{
                    $_POST['u_email'] = $result['email'];
                }
            } else {
                $_POST['u_email'] = $_SESSION['logged_vendor']; 
                if(!$this->Auth_model->checkVendorExsists($_POST)){
                    $errors[] = lang('vendor_change_password_error');
                } 
            }

            if (!empty($errors)) {
                $this->session->set_flashdata('error_change', $errors);
            } else if ($this->Auth_model->changeVendorPassword($_POST)){
                $this->session->set_flashdata('update_vend_details', lang('vendor_password_updated'));
                redirect(LANG_URL . '/vendor/profile');
            } else{
                redirect(LANG_URL . '/vendor/login');
            }            

        }
        if ($email && $pass) {
            $this->load->view('_parts/header_auth', $head);
            $this->load->view('auth/change_pass', $data);
            $this->load->view('_parts/footer_auth');
        } else {
            $this->load->view('_parts/header', $head);
            $this->load->view('auth/change_pass', $data);
            $this->load->view('_parts/footer');
        }
    }

}
