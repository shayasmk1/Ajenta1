<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Painting extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( array (
				'url',
				'form' 
		) );
		$this->load->database();
		$this->load->model('painting_model');
		$this->load->library('session');
		$this->lang->load ( 'public_lang', 'english' );
	}
	function index(){
		echo "Reaching Index of Painting";
	}
	
	
	function all_paintings(){
		$this->load->database();
		$this->load->model('painting_model');
		$this->painting_model->get_all_painting();
		//$data['all_painting']=$this->select->select();
		$data['all_painting']= $this->painting_model->get_all_painting();
		//Loading the View
		$this->load->view ('theme/header');
		$this->load->view('all_paintings', $data);
		$this->load->view ('theme/footer');
	}
	
	public function upload() {
		$config = array (
				'upload_path' => "./assets/images/uploaded_images/",
				'upload_url' => base_url () . "/assets/images/uploaded_images/", // base_url() " http://localhost:8080/codiajanta/
				'allowed_types' => "gif|jpg|png|jpeg",
				'overwrite' => TRUE 
		);
		
		$this->load->library ( 'upload', $config );
		
		if ($this->upload->do_upload ( 'userfile' )) {
			$uploaded_file = $this->upload->data ();
			$file_name = $uploaded_file ['file_name'];
		}
		
		if ($file_name == "") {
			$file_name = 'listing-default.png';
			
			$data = array (
					'title' => filter_input ( INPUT_POST, 'title' ),
					'caption' => filter_input ( INPUT_POST, 'description' ),
					'cave_number'=>fiter_input(INPUT_POST,'cavenumber'),
					'cave_type'=>filter_input(INPUT_POST, 'cavetype'),
					//'file_dir' => base_url () . 'assets/img/' . $file_name 
			);
			
			$this->painting_model->insert_item ( $data );
		} else {
			$data = array (
					'title' => filter_input ( INPUT_POST, 'title' ),
					'caption' => filter_input ( INPUT_POST, 'description' ),
					'cave_number' => filter_input ( INPUT_POST, 'cavenumber' ),
					'cave_type' => filter_input ( INPUT_POST, 'cavetype' ),
					'filename' => $file_name,
					'date_added'=> date("Y/m/d"),
					'uploaded_by' => $this->session->userdata('user_name'),
					'file_dir' => base_url () . 'assets/images/uploaded_images/' . $file_name 
			);
			

			$this->painting_model->insert_data($data);
			$this->load->view ('theme/header');
			$this->load->view ('painting');
			$this->load->view ('theme/footer');
			/* $this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( array (
					'result' => 1 
			) ) ); */
		}
	}
}
