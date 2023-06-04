<?php  	
	class MLogin extends CI_Model 
    {
        public function authenticateUser($email, $password)
        {
            $query = $this->db->get_where('tb_usuario', array('cd_email' => $email, 'ic_ativo' => 1));
            $user = $query->row();
    
            if ($user && password_verify($password, $user->cd_senha)) 
            {
                return $user;
            } 
            else 
            {
                return false;
            }
        }

        public function getFailedLoginAttempts($ipAddress)
        {
            $this->db->where('cd_ip', $ipAddress);
            $this->db->where('dt_tentativa >', date('Y-m-d H:i:s', strtotime('-1 hour')));
            $this->db->from('tb_falha_login');
            return $this->db->count_all_results();
        }

        public function registerFailedLoginAttempt($ipAddress)
        {
            $data = [
                'cd_ip' => $ipAddress,
                'dt_tentativa' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('tb_falha_login', $data);
        }
    }      
?>