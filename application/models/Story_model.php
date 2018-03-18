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
        
        function getAllCaveStories($caveID, $caveImageID)
        {
            return $this->db->select('story.*, cave_image.location')->join('cave_image', 'story.cave_image_id = cave_image.id', 'left')->where('story.cave_id', $caveID)->where('cave_image_id', $caveImageID)->get($this->model)->result_array();
        }
        
        function getCurrentCaveStory($id)
        {
            return $this->db->where('id', $id)->get($this->model)->row();
        }
        
        function deleteStory($storyID)
        {
            return $this->db->where('id', $storyID)->delete($this->model);
        }
        
        function getAllGeneralStories($caveID)
        {
            return $this->db->where('cave_id', $caveID)->where('cave_image_id', 0)->get($this->model)->result_array();
        }
        
        function getAllStories($caveID)
        {
            return $this->db->select('story.*,cave_image.location')->join('cave_image', 'story.cave_image_id = cave_image.id', 'left')->where('story.cave_id', $caveID)->get($this->model)->result_array();
        }
}
?>