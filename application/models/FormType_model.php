<?php

        class FormType_model extends CI_Model {

            function __construct() {
                parent::__construct();
                $this->table = 'form_type';
            }
            
            function getCurrentForm($id)
            {
                return $this->db->select('form_type.*, form_option.name, form_option.selected, form_option.id AS form_option_id')->join('form_option', 'form_option.form_type_id=form_type.id', 'left')->where('form_id', $id)->order_by('form_type.id')->get($this->table)->result_array();
            }
        }