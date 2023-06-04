<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends MY_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->middleware();
        $this->load->model('MUser');
        $this->load->model('MLog');
    }
        
    public function index()
    {
        $data['title'] = 'Logs - ManyMinds';
        $data['my_user'] = $this->MUser->getUser($this->session->userdata('user_id'));
        $data['logs'] = $this->MLog->getAllLogs();
        $data['content'] = $this->load->view('system/log/view', $data, true);
        $this->load->view('template', $data);
	}
}
