<?php
    class DefaultFormContainer_model extends CI_Model {

        function __construct() {
            parent::__construct();
            $this->table = 'default_form_container';
        }

        /*
         * Model to get User Selected Data
         */
        function getList() {
            return $this->db->order_by('name')->get($this->table)->result_array();
        }

        function getForm($formID)
        {
            return $this->db->where('id', $formID)->get($this->table)->row();
        }

        function deleteForm($formID)
        {
            return $this->db->where('id', $formID)->delete($this->table);
        }
    }
?>