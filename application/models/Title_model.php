<?php

class Title_model extends CI_Model {
	function __construct(){
            $this->model = 'title';
		parent::__construct();
	}
	
	function getAllTitles($caveStoryID){
            return $this->db->where('cave_story_id', $caveStoryID)->order_by('position')->get($this->model)->result_array();
            
	}
        
        function insert_data($data){
            $res = $this->db->set($data)->insert($this->model);
            return $this->db->insert_id();
	}
        
        function updateData($data, $titleID){
            return $this->db->set($data)->where('id', $titleID)->update($this->model);
	}
        
        function getMaxPosition($caveStoryID)
        {
             return $this->db->select_max('position')->where('cave_story_id', $caveStoryID)->get($this->model)->row();
        }
        
        function getCurrentCaveStoryTitle($id)
        {
            return $this->db->where('id', $id)->get($this->model)->row();
        }
}
?>