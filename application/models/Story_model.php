<?php

class Story_model extends CI_Model {
	function __construct(){
            $this->model = 'story';
		parent::__construct();
	}
	
	function insert_data($data){
            $res = $this->db->set($data)->insert($this->model);
            return $this->db->insert_id();
	}
        
        function updateData($data, $storyID){
            return $this->db->where('id', $storyID)->set($data)->update($this->model);
	}
        
        function getAllCaveImages($caveID, $caveImageID)
        {
            return $this->db->where('cave_id', $caveID)->where('cave_image_id', $caveImageID)->get($this->model)->result_array();
        }
}
?>