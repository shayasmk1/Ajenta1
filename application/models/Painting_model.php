<?php

class Painting_model extends CI_Model {
    
    /*
     * Constructor Function to Autoload Data
     */
    function __construct() {
        parent::__construct();
    }
    
    /*
     * Model for inserting paintings into database
     */
    function addPainting($data) {
        $result = $this->db->insert('painting', $data);
        if (!$result) {
            echo "Duplicate Entry Exist !";
        } else {
            echo "Save successful";
        }
    }

    function get_all_painting() {
        $query = $this->db->get('painting');
        $data['all_paintings'] = $query->result();
        return $data;
    }

}

?>