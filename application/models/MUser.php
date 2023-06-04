<?php  	
	class MUser extends CI_Model 
    {
        public function getAllUsers() 
        {
            $query = $this->db->get('tb_usuario');
            $users = $query->result();

            return $users;
        }   

        public function getUser($userId) 
        {
            $query = $this->db->get_where('tb_usuario', array('cd_usuario' => $userId));
            $user = $query->row();

            return $user;
        }

        public function getUserAddress($userId) 
        {
            $query = $this->db->get_where('tb_endereco', array('cd_usuario' => $userId));
            $addresses = $query->result();

            return $addresses;
        }

        public function getStates() 
        {
            $query = $this->db->get('tb_estado');
            $states = $query->result();
            
            return $states;
        }

        public function getUserPassword($userId)
        {
            $query = $this->db->get_where('tb_usuario', ['cd_usuario' => $userId]);
            $result = $query->row();

            return $result;
        }

        public function verifyUserEmail($data, $excludedUserId = null)
        {
            $this->db->where('cd_email', $data['email']);
            
            if ($excludedUserId !== null) {
                $this->db->where('cd_usuario !=', $excludedUserId);
            }

            $query = $this->db->get('tb_usuario');
            $user = $query->row();

            return $user;
        }
        
        public function searchUsers($name) 
        {
            $this->db->like('nm_usuario', $name);
            $query = $this->db->get('tb_usuario');
            $users = $query->result();

            return $users;
        }

        public function storeUser($data)
        {
            $data = [
                'nm_usuario' => $data['name'],
                'cd_email' => $data['email'],
                'cd_senha' => $data['password'],
                'ic_admin' => $data['admin'],
                'ic_ativo' => '1'
            ];
            $this->db->insert('tb_usuario', $data);
            $user_id = $this->db->insert_id();
            
            return $user_id;
        }

        public function storeUserAddress($address_data)
        {
            $data = [
                'cd_cep' => $address_data['cep'],
                'sg_uf' => $address_data['state'],
                'nm_cidade' => $address_data['city'],
                'nm_bairro' => $address_data['district'],
                'nm_rua' => $address_data['street'],
                'cd_rua' => $address_data['street_id'],
                'ds_complemento' => !empty($address_data['complement']) ? $address_data['complement'] : NULL,
                'cd_usuario' => $address_data['user_id']
            ];
            
            $this->db->insert('tb_endereco', $data);
        }

        public function updateUser($data)
        {
            $updateData = array(
                'nm_usuario' => $data['name'],
                'cd_email' => $data['email'],
                'cd_senha' => $data['password'],
                'ic_admin' => $data['admin'],
                'ic_ativo' => $data['status'],
            );

            $this->db->where('cd_usuario', $data['id']);
            $result = $this->db->update('tb_usuario', $updateData);

            return $result;
        }

        public function deleteUser($user_id) 
        {
            $data = array(
                'ic_ativo' => 0
            );

            $this->db->where('cd_usuario', $user_id);
            $this->db->update('tb_usuario', $data);
        }

        public function deleteUserAddresses($userId)
        {
            $this->db->where('cd_usuario', $userId);
            $this->db->delete('tb_endereco');
        }
    }
?>