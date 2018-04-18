<?php

        class FormType_model extends CI_Model {

            function __construct() {
                parent::__construct();
                $this->table = 'form_type';
            }
            
            function getCurrentForm($id)
            {
                return $this->db->where('form_id', $id)->get($this->table)->result_array();
            }
        }