<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );


class Home extends CI_Controller {
	
	function __construct() {
		parent::__construct ();
		$this->load->helper ( array ('url','form' ) );
		$this->lang->load('public_lang', 'english');
                $this->load->model('cave_model');
                $this->load->model('listHeader_model');
                $this->load->model('listBody_model');
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
                            $data['lists'] = $this->listHeader_model->getList();
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
                        //$data['allStories'] = $this->Story_model->getAllStories
                        
                        $this->load->view($page, $data);
			$this->load->view ('theme/footer');
			
		} else {
                    redirect('/auth/login');
			//$this->load->view ( 'login' );
		}
		
	}
	
        function create()
        {
            $this->load->view('theme/test/header');
            $this->load->view('theme/test/create');
            $this->load->view ('theme/test/footer');
        }
        
        function select()
        {
            
            $res1['message'] = '';
            if($this->input->method() == 'post')
            {
                $data = $this->input->post();
                $res1['message'] = 'Added Successfully';
                $res = $this->listHeader_model->insertData($data);
                if(!$res)
                {
                    $data['message'] = 'Something Went Wrong';
                }
            }
            $res1['headers'] = $this->listHeader_model->getList();
            $this->load->view('theme/test/header');
            $this->load->view('theme/test/select', $res1);
            $this->load->view ('theme/test/footer');
        }
        
        function body($headerID)
        {
            
            $res1['message'] = '';
            if($this->input->method() == 'post')
            {
                $data = $this->input->post();
                $res1['message'] = 'Added Successfully';
                $data['list_header_id'] = $headerID;
                $res = $this->listBody_model->insertData($data);
                if(!$res)
                {
                    $data['message'] = 'Something Went Wrong';
                }
            }
            $res1['headers'] = $this->listBody_model->getBodyOfHeader($headerID);
            $this->load->view('theme/test/header');
            $this->load->view('theme/test/list_body_create', $res1);
            $this->load->view ('theme/test/footer');
        }
        
        function builder()
        {
            $this->load->view('theme/test/header');
            $this->load->view('theme/test/builder');
            $this->load->view ('theme/test/footer');
        }
        
        function drag()
        {
            $this->load->view('theme/test/header');
            $this->load->view('theme/test/drag');
            $this->load->view ('theme/test/footer');
        }
        
        function buildercustom()
        {
            $this->load->view('theme/test/header');
            $this->load->view('theme/test/buildercustom');
            $this->load->view ('theme/test/footer');
        }
}