<?php  	
	class MLogin extends CI_Model 
    {
        public function authenticateUser($email, $password)
        {
            $query = $this->db->get_where('tb_usuario', array('cd_email' => $email));
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
    }      
?>