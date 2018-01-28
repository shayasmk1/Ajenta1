<?php

class Title_model extends CI_Model {
	function __construct(){
            $this->model = 'title';
		parent::__construct();
	}
	
	function getAllTitles($caveStoryID){
            return $this->db->where('cave_story_id', $caveStoryID)->get($this->model)->result_array();
            
	}
        
        function insert_data($data){
            $res = $this->db->set($data)->insert($this->model);
            return $this->db->insert_id();
	}
        
}
?>