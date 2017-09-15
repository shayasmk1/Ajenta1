<?php

class ApiUsers_model extends CI_Model {

    function __construct() {
        $this->table = 'api_users';
        parent::__construct();
    }
    
    /*
     * Model to Insert Data into Database
     */
    public function insertData($data) {
        $this->db->set($data)->insert($this->table);
        return $this->db->insert_id();
    }

    public function checkEmail($email)
    {
        return $this->db->where('email', $email)->get($this->table)->row();
    }
}
?>