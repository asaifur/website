<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Vaul extends MY_Controller
{
    public function index()
    {
        $data['title'] = "Send Email";
        $this->template->load('vaul', 'send_email', $data);
    }
}
