<?php

class Story_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	
	function insert_data($data){
		$this->db->insert('painting',$data);
	}
}
?>