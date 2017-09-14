<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );


class Home extends CI_Controller {
	
	function __construct() {
		parent::__construct ();
		$this->load->helper ( array ('url','form' ) );
		$this->load->library ( 'session' );
		$this->lang->load('public_lang', 'english');
                $this->load->model('cave_model');
                $this->load->model('listHeader_model');
	}
	
	/*
         * Function which load the Variable Page with Same Header and Footer
         */
	function index($page='caves') {
		
		if ($this->session->userdata ( 'is_logged_in' )) {
			if (! file_exists ( 'application/views/' . $page . '.php' )) {
				show_404 ();
			}
			  
			$this->load->view ('theme/header');
                        
                        $data['cave_list'] = $this->cave_model->get_dropdown_list();
                        //To get Patron(p), Type(t), Period(p) for Autocomplete
                        $data['cave_ptp'] = $this->cave_model->getCaveM(); 
                        $data['list'] = array();
                        if($page == 'list')
                        {
                            $data['list'] = $this->listHeader_model->getList();
                        }
                        $this->load->view($page, $data);
                        
			$this->load->view ('theme/footer');
			
		} else {
			$this->load->view ( 'login' );
		}
		
	}
	
        /*
         * Function for Validating Credentials of User
         */
	
	function validate_credentials() {
		$this->load->model('Users_model');
	
		$user_name = $this->input->post('user_name');
		$password = $this->__encrip_password($this->input->post('password'));
		$user_profile = 'moderator';
		$is_valid = $this->Users_model->validate($user_name, $password); //function which return if its validated
		
		if ($is_valid) {
			$data = array(
					'user_name' => $user_name,
					'user_profile'=> 'moderator',
					'is_logged_in' => true
			);
			$this->session->set_userdata($data); //set the session
			redirect('home/index');
		} else {
			echo $this->lang->line('error_message');
			$data['is_logged_in'] = FALSE;
			$this->load->view('login'); 
		}
	}
	
	
	/*
         * Function for Enccrypting Password
         */
	function __encrip_password($password) {
		return md5($password);
	}
	
	
	/*
         * Function for Managing LogOut
         */
        
	function logout() {
		$this->session->sess_destroy();
		$this->load->view('login');
	}
}