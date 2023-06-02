<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
        public function __construct() 
        {
                parent::__construct();
                $this->load->model('MLogin');
        }
        
        public function index()
        {
                $data['title'] = 'Login - ManyMinds';
                $data['content'] = $this->load->view('login/login_view', '', true);
                $this->load->view('template', $data);
        }

        public function auth()
        {
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                $ipAddress = $this->input->ip_address();
                $failedAttempts = $this->MLogin->getFailedLoginAttempts($ipAddress);

                if ($failedAttempts >= 3) 
                {
                        echo json_encode(['success' => false, 'message' => 'Sua conta foi temporariamente bloqueada. Tente novamente mais tarde.']);
                        return;
                }

                $user = $this->MLogin->authenticateUser($email, $password);

                if ($user && password_verify($password, $user->cd_senha)) 
                {
                        $this->session->set_userdata('user_id', $user->cd_usuario);
                        echo json_encode(['success' => true]);
                } 
                else 
                {
                        $this->MLogin->registerFailedLoginAttempt($ipAddress);
                        echo json_encode(['success' => false, 'message' => 'Credenciais inválidas']);
                }
        }

        public function logout()
        {
                $this->session->unset_userdata('user_id');
                redirect('login');
        }
}
