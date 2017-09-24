<?php

class Cave_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->model = 'caves';
    }
    /*
     * Model for Managing AutoFill in Inputs 
     */
    function getCaveM() {
        $query = $this->db->query('SELECT `cave_patron`, `cave_period`, `cave_type` FROM `caves`');
        return json_encode($query->result());
    }
    
    /*
     * Model for Filling the Dropdown with Caves Data Avaiable in Database Only
     */
    function get_dropdown_list() {
        $this->db->from('caves');
        $this->db->order_by("cave_numb", "asc");
        $result = $this->db->get();
        $return = array();
        if ($result->num_rows() > 0) {
            foreach ($result->result_array() as $row) {
                $return[$row['cave_id']] = $row['cave_numb'];
            }
        }
        return $return;
    }
    
    /*
     * Model to get User Selected Data
     */
    function getOneCaveM($search) {
        $query = $this->db->query('SELECT * FROM `caves` WHERE cave_numb =' . $search . '');
        return $query->result();
    }
    
    function getHeaders($caveID)
    {
        return $this->db->join('cave_header', 'caves.cave_id = cave_header.cave_id')->where('caves.cave_numb', $caveID)->get($this->model)->result_array();
    }
    
    /*
     * Model to Insert Data into Database
     */
    public function insertDataToDB($data) {
        return $this->db->insert('content', $data);
    }

    
    /*
     * Get the Inserted data from content table
     */
//    public function getLastEnrtyData() {
//        $this->db->from('content');
//        $last_id = $this->db->insert_id();
//        $this->db->where('id', $last_id);
//        return $this->db->get()->row();
//    }

    function insertCaveM($data) {
        $result = $this->db->insert('caves', $data);
        if (!$result) {
            echo "Duplicate Entry Exist !";
        } else {
            echo "Save successful";
        }
    }
    
    
    /*
     * Model to Get all Cave Data 
     */
    function get_all_cave_data($data) {
        $query = $this->db->query('SELECT * FROM caves');
        return $query->result();
    }

    
    /*
     * Function to Update Selected Cave of User
     */
    function updateCaveM($data) {
        $this->db->where('cave_numb', $data['cave_numb']);
        $result = $this->db->update('caves', $data);
        if (!$result) {
            echo "Unable to Update. Inform Administrator !";
        } else {
            echo "Update Successfull";
        }
    }
    
    
    function updateCave($data) {
       
        $this->db->where('cave_numb', $data['cave_num']);
        unset($data['cave_num']);
        $result = $this->db->set($data)->update('caves');
        if (!$result) {
            return 0;
        } else {
            return 1;
        }
    }

    /*
     * Function to Delete User Selected Cave
     */
    function deleteCaveM($data) {
        $this->db->where('cave_numb', $data);
        $result = $this->db->delete('caves');
        if (!$result) {
            echo "Unable to Delete. Inform Administrator !";
        } else {
            echo "Delete Successfull";
        }
    }
    
    function deleteCave($data) {
        $this->db->where('cave_numb', $data);
        $result = $this->db->delete('caves');
        if (!$result) {
            return 0;
        } else {
            return 1;
        }
    }

}
?>