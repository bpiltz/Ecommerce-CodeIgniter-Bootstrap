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
        //var_dump($vendorInfo['id']);
        //var_dump($data['vendor']);
        //die();
        //$rowscount = $this->Products_model->productsCount($this->vendor_id);
        //$data['products'] = $this->Products_model->getproducts($this->num_rows, $page, $this->vendor_id);
        //$data['links_pagination'] = pagination('vendor/settings', $rowscount, $this->num_rows, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
        if(isset($_POST["sendMessage"]) && strlen($_POST["message"]) > 0){
            $messages = $this->mahana_messaging->send_new_message($this->vendor_id, $vendorInfo['id'], $_POST["subject"], $_POST["message"], $priority = PRIORITY_NORMAL);
            
            $this->sendmail->sendTo($vendorInfo['email'], 'Brieftaube Ortenau Netzwerk e.V.', 'Deine Nachricht von ' . 
                $vendor['name'], 'Hallo liebes Mitglied,<br/><br/>diese Nachricht wurde an dich von ' . $vendor['name'] . ' gesendet:<br/><br/>' . $_POST["subject"] . 
                '<br/><br/>' . $_POST["message"] . '<br/><br/>hier kommst Du direkt zum Dialog:<br/><br/>' . LANG_URL . '/vendor/' . $vendor .
                '<br/><br/>Liebe Grüße,<br/><br/>Dein Ortenau Netzwerk e.V.');

            redirect(LANG_URL . '/vendor/' . $vendor);
        }


        $messagesRaw = $this->mahana_messaging->get_Dialog($this->vendor_id, $vendorInfo['id']);

        //var_dump($messagesRaw);
        //echo "<br/><br/>";
        //die();

        $messages = array();
        
        for ($i = 0; $i < count($messagesRaw["retval"]); $i++)  {
            if($messagesRaw["retval"][$i]["sender_id"] == $this->vendor_id || $messagesRaw["retval"][$i]["sender_id"] == $vendorInfo['id']){
                array_push($messages, (object) $messagesRaw["retval"][$i]);
                if($messagesRaw["retval"][$i]["sender_id"] == $vendorInfo['id'] && intval($messagesRaw["retval"][$i]["status"]) == MSG_STATUS_UNREAD){
                    //var_dump($messagesRaw["retval"][$i]);
                    //echo "<br/><br/>";
                    $result = $this->mahana_messaging->update_message_status(intval($messagesRaw["retval"][$i]["id"]), $this->vendor_id, MSG_STATUS_READ );
                }
            }
        }


        $data["messages"] = $messages;

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
