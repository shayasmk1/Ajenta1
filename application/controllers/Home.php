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
                $this->load->model('CaveHeader_model');
                $this->load->model('form_model');
                $this->load->model('DefaultFormContainer_model');
                $this->load->model('Story_model');
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
                        
                        
                        $data['list'] = array();
                        if($page == 'list')
                        {
                            $data['list'] = $this->listHeader_model->getList();
                        }
                        if($page == 'caves')
                        {
                            if($this->input->method() == 'post')
                            {
                                $forms = $this->input->post();
//                                foreach($forms AS $form)
//                                {
                                    $res = $this->form_model->updateValues($forms);
                                    if($res)
                                    {
                                        $data['message'] = 'Updated Successfully';
                                    }
                                    else
                                    {
                                        $data['message'] = 'Something went wrong';
                                    }
                              //  }
                            }
                            
                            $data['column_headers'] = $this->CaveHeader_model->getAllDistinctHeaders();
                        }
                        $data['cave_list'] = $this->cave_model->get_dropdown_list();
                        //To get Patron(p), Type(t), Period(p) for Autocomplete
                        $data['cave_ptp'] = $this->cave_model->getCaveM(); 
                        $data['defaultCaves'] = $this->DefaultFormContainer_model->getList();
                        
                        $this->load->view($page, $data);
			$this->load->view ('theme/footer');
			
		} else {
                    redirect('/auth/login');
			//$this->load->view ( 'login' );
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
                            'user_profile'=> $is_valid['user_profile'],
                            'is_logged_in' => true
			);
			$this->session->set_userdata($data); //set the session
			redirect('home/index');
		} else {
			
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
        
        
        function caves($action)
        {
            
            switch($action)
            {
                case 'save':
                    if($this->input->method() == 'post')
                    {
                        $data = $this->input->post();
                        $data = $data['data'];
                        $caveNum = $this->input->post('caveNum');
                        if(empty($data) || $caveNum == null)
                        {
                            header('HTTP/1.1 400 Created');
                            echo json_encode($data);
                            exit;
                        }
                        $cave = $this->db->where('cave_numb', $caveNum)->get('caves')->row();
                        if(!$cave)
                        {
                            header('HTTP/1.1 400 Created');
                            echo json_encode($data);
                            exit;
                        }
                        $this->db->where('cave_id', $cave->cave_id)->delete('cave_header');
                        $insertArray = array();
                        foreach($data AS $each)
                        {
                            $insertArray['name'] = $each['title'];
                            $insertArray['body'] = $each['body'];
                            $insertArray['column_order'] = $each['column_order'];
                            $insertArray['cave_id'] = $cave->cave_id;
                            $insertArray['column_show'] = $each['column_show'];
                            $this->CaveHeader_model->insertData($insertArray); 
                        }
                    }
                    
                    header('HTTP/1.1 200 Created');
                            echo json_encode($data);
                            exit;
            }
                
        }
}