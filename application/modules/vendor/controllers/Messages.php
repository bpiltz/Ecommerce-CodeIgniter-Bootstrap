<?php

/*
 * @Author:    Benjamin Piltz
 *  Gitgub:    https://github.com/bpiltz
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Messages extends VENDOR_Controller
{

    private $num_rows = 100;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Vendors_model');
    }

    public function index($page = 0)
    {
        $messages = $this->mahana_messaging->get_all_threads_grouped($this->vendor_id);

        $messageStatsRaw = array();
        $messageStatsRaw["sender_ids"] = array();
        $messageStatsRaw["sender_names"] = array();
        $messageStatsRaw["status_0s"] = array();
        $messageStatsRaw["last_times"] = array();

        //var_dump($messages);
        //echo "<br/><br/>";
        //die();
        $statsIndex = 0;
        for ($i = 0; $i < count($messages["retval"]); $i++)  {
            //var_dump($messages["retval"][$i+1]);
            //echo "<br/>";
            if(isset($messages["retval"][$i+1]) && $messages["retval"][$i+1]["messages"][0]["sender_id"] != $this->vendor_id){
                $key = array_search($messages["retval"][$i+1]["messages"][0]["sender_id"], $messageStatsRaw["sender_ids"]);
                //echo $key;
                if ($key === false) {
                    $messageStatsRaw["sender_ids"][$statsIndex] = $messages["retval"][$i+1]["messages"][0]["sender_id"];
                    $messageStatsRaw["sender_names"][$statsIndex] = $messages["retval"][$i+1]["messages"][0]["user_name"];
                    if (intval($messages["retval"][$i+1]["messages"][0]["status"]) == MSG_STATUS_UNREAD) {
                        $messageStatsRaw["status_0s"][$statsIndex] = 1;
                    } else {
                        $messageStatsRaw["status_0s"][$statsIndex] = 0;
                    }
                    $messageStatsRaw["last_times"][$statsIndex] = $messages["retval"][$i+1]["messages"][0]["cdate"];
                    $statsIndex++;
                } else {
                    for ($j = 0; $j < count($messages["retval"][$i+1]["messages"]); $j++) {
                        if (intval($messages["retval"][$i+1]["messages"][$j]["status"]) == MSG_STATUS_UNREAD) {
                            $messageStatsRaw["status_0s"][$key]++; 
                        }
                        $messageStatsRaw["last_times"][$key] = $messages["retval"][$i+1]["messages"][$j]["cdate"];
                    }
                }
            }
             //echo "<br/><br/>";
        }

        // var_dump($messageStatsRaw);
        $dialogs = array();
        $size = count($messageStatsRaw["sender_ids"]);
        for ($i = 0; $i < $size; $i++)  {
            $element = array();
            $element["senderId"] = intval($messageStatsRaw["sender_ids"][$size - $i - 1]);
            $element["senderName"] = $messageStatsRaw["sender_names"][$size - $i - 1];
            $element["unread"] = $messageStatsRaw["status_0s"][$size - $i - 1];
            $element["time"] = $messageStatsRaw["last_times"][$size - $i - 1];
            $vendorData = $this->Vendors_model->getVendor($element["senderId"]);
            $element["url"] = $vendorData[0]->url;
            $element["profile_image"] = $vendorData[0]->profile_image;
            $elObj = (object) $element;
            array_push($dialogs, $elObj);
        }

        $data = array();
        $head = array();
        $head['title'] = lang('vendor_messages');
        $head['description'] = lang('vendor_messages');
        $head['keywords'] = '';

        $data["dialogs"] = $dialogs;

        $this->load->view('_parts/header', $head);
        $this->load->view('messages', $data);
        $this->load->view('_parts/footer');
    }

    public function logout()
    {
        unset($_SESSION['logged_vendor']);
        delete_cookie('logged_vendor');
        redirect(LANG_URL . '/vendor/login');
    }

}
