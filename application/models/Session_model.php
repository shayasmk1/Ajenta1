<?php

class Session_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->table = 'session';
    }
    
    public function insertData($data) {
        return $this->db->set($data)->insert($this->table);
    }
    
    public function checkCurrentSession($data)
    {
        return $this->db->where('api_user_id', $data['client_id'])->where('access_token', $data['access_token'])->get($this->table)->row();
    }
}
?>