<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $head = array();
        $data = array();
        if (isset($_POST['message'])) {
            $result = $this->sendEmail();
            if ($result) {
                $this->session->set_flashdata('resultSend', lang('contact_send_success'));
            } else {
                $this->session->set_flashdata('resultSend', lang('contact_send_error'));
            }
            redirect('contacts');
        }
        $data['googleMaps'] = $this->Home_admin_model->getValueStore('googleMaps');
        $data['googleApi'] = $this->Home_admin_model->getValueStore('googleApi');
        $arrSeo = $this->Public_model->getSeo('contacts');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $this->render('contacts', $head, $data);
    }

    private function sendEmail()
    {
        $myEmail = $this->Home_admin_model->getValueStore('contactsEmailTo');

        if (filter_var($myEmail, FILTER_VALIDATE_EMAIL) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

            $this->sendmail->sendTo($myEmail, 'Kontaktformular', $_POST['subject'], 'Nachricht von:<br/>Name: ' . $_POST['name'] . ', Email: ' . $_POST['email'] . '<br/><br/>Nachricht:<br/>' . $_POST['message']);
            return true;
        }
        return false;
    }

}
