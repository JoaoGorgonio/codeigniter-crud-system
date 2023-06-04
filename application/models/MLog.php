<?php  	
	class MLog extends CI_Model 
    {
        public function getAllLogs() 
        {
            $this->db->select('tb_log.*, tb_usuario.nm_usuario');
            $this->db->from('tb_log');
            $this->db->join('tb_usuario', 'tb_log.cd_usuario = tb_usuario.cd_usuario');
            $this->db->order_by('cd_log', 'desc');
            $logs = $this->db->get()->result();
            return $logs;
        }

        public function registerLog($type, $user)
        {
            $data = [
                'dt_log' => date('Y-m-d'),
                'hr_log' => date('H:i:s'),
                'nm_tipo_log' => $type,
                'cd_usuario' => $user
            ];
            $this->db->insert('tb_log', $data);
        }
    }      
?>