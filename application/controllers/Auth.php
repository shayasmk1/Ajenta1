<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
require_once 'application/validation/AuthValidation.php';


class Auth extends CI_Controller {
	
    function __construct() {
        parent::__construct ();
        $this->load->helper ( array ('url','form' ) );
        $this->load->library ( 'session' );
        $this->lang->load('public_lang', 'english');
        
        $this->load->model('Users_model');
        $this->authValidation = new AuthValidation();
    }
    
    function p()
    {
        echo md5('password');
    }

    function register() {
        $this->load->view('register'); 
    }
    
    function login() {
        
        $res['errorMessage'] = '';
        if($this->input->method() == 'post')
        {
            $data = $this->input->post('data');
            
            $user_name = $data['user_name'];
            $password = md5($data['pass_word']);
            $user_profile = 'moderator';
            $is_valid = $this->Users_model->validate($user_name, $password); //function which return if its validated

            if ($is_valid) {
                $data = array(
                    'user_name' => $user_name,
                    'user_profile'=> $is_valid['user_profile'],
                    'is_logged_in' => true
                );
                $this->session->set_userdata($data); //set the session
                redirect('/home/index');
            }
            
            $res['errorMessage'] = 'Username And Password Does Not Match';
        }
        $this->load->view('login',$res); 
    }
    
    function user($function)
    {
        if($function == 'add')
        {
            if($this->input->method() == 'post')
            {
                $data = $this->input->post('data');
                $validation = $this->authValidation->register($data);
                if($validation)
                {
                    http_response_code(400);
                    echo json_encode($validation);
                    exit;
                }
                if(isset($data['conf_password']))
                {
                    unset($data['conf_password']);
                }
                $data['user_profile'] = 'moderator';
                $data['pass_word'] = md5($data['pass_word']);
                $res = $this->addUser($data);
                if($res)
                {
                    http_response_code(200);
                    echo json_encode('<p>User Registerd Successfully</p>');
                    exit;
                }
                
                http_response_code(500);
                echo json_encode('<p>Something Went Wrong</p>');
                exit;
            }
        }
    }
    
    private function addUser($data)
    {
        return $this->Users_model->insertData($data);
    }
    
    function logout()
    {
        $this->session->sess_destroy();
	redirect('/auth/login');
    }
}