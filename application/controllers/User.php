<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
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
        $data['title'] = 'Usuários - ManyMinds';
        $data['my_user'] = $this->MUser->getUser($this->session->userdata('user_id'));
        $data['users'] = $this->MUser->getAllUsers();
        $data['content'] = $this->load->view('system/user/view', $data, true);
        $this->load->view('template', $data);
	}

    public function show()
    {
        $searchValue = $this->input->post('search');
        $data['users'] = $this->MUser->searchUsers($searchValue);
        $userViewHtml = $this->load->view('system/user/view', $data, true);
        $this->MLog->registerLog('Pesquisa no Sistema', $this->session->userdata('user_id'));
        echo $userViewHtml;
    }

    public function store()
    {
        $data['title'] = 'Cadastro de Usuário - ManyMinds';
        $data['my_user'] = $this->MUser->getUser($this->session->userdata('user_id'));
        $data['states'] = $this->MUser->getStates();
        $data['content'] = $this->load->view('system/user/create', $data, true);
        $this->load->view('template', $data);
    }

    public function registering()
    {
        $data['email'] = $this->input->post('user_email');
        $user = $this->MUser->verifyUserEmail($data);

        if (!$user) 
        {
            $data['name'] = $this->input->post('user_name');
            $data['password'] = password_hash($this->input->post('user_password'), PASSWORD_DEFAULT);
            $data['admin'] = $this->input->post('user_admin') ? 1 : 0;
            
            $user_id = $this->MUser->storeUser($data);
            
            if ($user_id) 
            {
                $ceps = $this->input->post('user_cep[]');
                $states = $this->input->post('user_state[]');
                $cities = $this->input->post('user_city[]');
                $districts = $this->input->post('user_district[]');
                $streets = $this->input->post('user_street[]');
                $street_ids = $this->input->post('user_street_id[]');
                $complements = $this->input->post('user_complement[]');
        
                // Itera sobre os arrays usando foreach
                foreach ($ceps as $index => $cep) 
                {
                    $address_data = [
                        'user_id' => $user_id,
                        'cep' => $cep,
                        'state' => $states[$index],
                        'city' => $cities[$index],
                        'district' => $districts[$index],
                        'street' => $streets[$index],
                        'street_id' => $street_ids[$index],
                        'complement' => $complements[$index]
                    ];
        
                    $this->MUser->storeUserAddress($address_data);
                }
                $this->MLog->registerLog('Cadastro de Usuário', $this->session->userdata('user_id'));
                echo json_encode(['success' => true, 'message' => 'Usuário criado com sucesso.']);
            } 
            else 
            {
                echo json_encode(['success' => false, 'message' => 'Não foi possível criar um usuário.']);
            }
        }
        else 
        {
            echo json_encode(['success' => false, 'message' => 'O e-mail de usuário já está cadastrado.']);
        }
    }

    public function update($userId)
    {
        $data['title'] = 'Editar Usuário - ManyMinds';
        $data['my_user'] = $this->MUser->getUser($this->session->userdata('user_id'));
        $data['user'] = $this->MUser->getUser($userId);
        $data['user_address'] = $this->MUser->getUserAddress($userId);
        $data['states'] = $this->MUser->getStates();
        $data['content'] = $this->load->view('system/user/edit', $data, true);
        $this->load->view('template', $data);
    }

    public function editing()
    {
        $data['id'] = $this->input->post('user_id');
        $data['email'] = $this->input->post('user_email');
        $userEmail = $this->MUser->verifyUserEmail($data, $data['id']);

        if (!$userEmail) 
        {
            $data['name'] = $this->input->post('user_name');
            $data['status'] = $this->input->post('user_status');
            $data['admin'] = $this->input->post('user_admin') ? 1 : 0;

            $data['password'] = $this->input->post('user_password');
            $existingPassword = $this->MUser->getUserPassword($data['id']);
            
            if ($data['password'] != $existingPassword->cd_senha) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
            $user = $this->MUser->updateUser($data);
            
            if ($user) 
            {
                $this->MUser->deleteUserAddresses($data['id']);
                
                $ceps = $this->input->post('user_cep[]');
                $states = $this->input->post('user_state[]');
                $cities = $this->input->post('user_city[]');
                $districts = $this->input->post('user_district[]');
                $streets = $this->input->post('user_street[]');
                $street_ids = $this->input->post('user_street_id[]');
                $complements = $this->input->post('user_complement[]');
        
                // Itera sobre os arrays usando foreach
                foreach ($ceps as $index => $cep) 
                {
                    $address_data = [
                        'user_id' => $data['id'],
                        'cep' => $cep,
                        'state' => $states[$index],
                        'city' => $cities[$index],
                        'district' => $districts[$index],
                        'street' => $streets[$index],
                        'street_id' => $street_ids[$index],
                        'complement' => $complements[$index]
                    ];
        
                    $this->MUser->storeUserAddress($address_data);
                }
                $this->MLog->registerLog('Alteração de Usuário', $this->session->userdata('user_id'));
                echo json_encode(['success' => true, 'message' => 'Usuário atualizado com sucesso.']);
            } 
            else 
            {
                echo json_encode(['success' => false, 'message' => 'Não foi possível atualizar o usuário.']);
            }
        }
        else 
        {
            echo json_encode(['success' => false, 'message' => 'O e-mail digitado já está cadastrado em outro usuário.']);
        }
    }
}
