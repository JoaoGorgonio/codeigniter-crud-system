<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
        public function index()
        {
                $data['title'] = 'Login - ManyMinds';
                $data['content'] = $this->load->view('login/login_view', '', true);
                $this->load->view('template', $data);
	}
}
