<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->middleware();
    }
        
    public function index()
    {
        $data['title'] = 'Home - ManyMinds';
        $data['content'] = $this->load->view('system/home', '', true);
        $this->load->view('template', $data);
	}
}
