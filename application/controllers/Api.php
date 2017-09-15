<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/validation/ApiValidation.php';

class Api extends CI_Controller {

    /*
     * Constructor Call
     */
    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->database();
        $this->load->model('cave_model');
        $this->load->model('ApiUsers_model');
        $this->load->model('Session_model');
        $this->load->model('cave_model');
        
        $this->load->library('session');
        $this->lang->load('public_lang', 'english');
        $this->load->library('upload');
        
        $this->apiValidation = new ApiValidation();
    }
    
    function v1($type, $action = null)
    {
        switch($type)
        {
            case 'register':
                if($this->input->method() == 'post')
                {
                    $data = $this->input->post('data');
                    return $this->register($data);
                    break;
                }
                
                
            case 'login':
                if($this->input->method() == 'post')
                {
                    $data = $this->input->post('data');
                    return $this->login($data);
                    break;
                }
                
                
            case 'cave':
                
                if($this->input->method() == 'post')
                {
                    $data = $this->input->post();
                }
                else if($this->input->method() == 'get')
                {
                    $data = $this->input->get();
                }
                
                    $auth = $this->Session_model->checkCurrentSession($data);
                    if(!$auth)
                    {
                        return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(201)
                        ->set_output(json_encode(array(
                                'message' => 'Not Authorized'
                        )));
                        exit;
                    }
                    if($action == 'list')
                    {
                        return $this->listCaves();
                    }
                    else if($action == 'single')
                    {
                        if(!isset($data['data']['cave_num']))
                        {
                             return $this->output
                            ->set_content_type('application/json')
                            ->set_status_header(400)
                            ->set_output(json_encode(array(
                                    'message' => 'Cave Number is required'
                            )));
                            exit;
                        }
                        return $this->listOneCave($data['data']['cave_num']);
                    }
                    else if($action == 'edit')
                    {
                        if(!isset($data['data']['cave_num']))
                        {
                             return $this->output
                            ->set_content_type('application/json')
                            ->set_status_header(400)
                            ->set_output(json_encode(array(
                                    'message' => 'Cave Number is required'
                            )));
                            exit;
                        }
                        return $this->editCave($data['data']);
                    }
                    else if($action == 'delete')
                    {
                        if(!isset($data['data']['cave_num']))
                        {
                             return $this->output
                            ->set_content_type('application/json')
                            ->set_status_header(400)
                            ->set_output(json_encode(array(
                                    'message' => 'Cave Number is required'
                            )));
                            exit;
                        }
                        return $this->deleteCave($data['data']['cave_num']);
                    }
                    break;
                
        }
    }
    
    
    private function register($data)
    {
        $validation = $this->apiValidation->register($data);
        if($validation)
        {
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(400)
            ->set_output(json_encode(array(
                    'message' => $validation
            )));
            exit;
        }
        
        $user = $this->ApiUsers_model->checkEmail($data['email']);
        if($user)
        {
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(400)
            ->set_output(json_encode(array(
                    'message' => 'Email already exists'
            )));
            exit;
        }
        
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $insertID = $this->ApiUsers_model->insertData($data);
        if(!$insertID)
        {
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(500)
            ->set_output(json_encode(array(
                    'message' => 'Something went wrong'
            )));
            exit;
        }
        
        return $this->output
        ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'message' => 'User Registered Successfully',
                    'id' => $insertID
            )));
    }
    
    private function login($data)
    {
        $validation = $this->apiValidation->login($data);
        if($validation)
        {
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(400)
            ->set_output(json_encode(array(
                    'message' => $validation
            )));
            exit;
        }
        
        $user = $this->ApiUsers_model->checkEmail($data['email']);
        if (!password_verify($data['password'], $user->password)) {
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(201)
            ->set_output(json_encode(array(
                    'message' => 'Authentication Failed'
            )));
            exit;
            
        }
        
        $data1['access_token'] = md5(rand(1000000,9999999));
        $data1['api_user_id'] = $user->id;
        $insert = $this->Session_model->insertData($data1);
        
        if(!$insert)
        {
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(500)
            ->set_output(json_encode(array(
                    'message' => 'Something went wrong'
            )));
            exit;
        }
        
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'message' => 'Login Successful',
                    'access_token' => $data1['access_token']
            )));
    }
    
    private function listCaves()
    {
        $caves = $this->cave_model->get_all_cave_data();
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'data' => $caves
            )));
    }
    
    private function listOneCave($cave_numb)
    {
        $cave = $this->cave_model->getOneCaveM($cave_numb);
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'data' => $cave
            )));
    }
    
    private function editCave($data)
    {
        $cave = $this->cave_model->updateCave($data);
        if(!$cave)
        {
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(500)
            ->set_output(json_encode(array(
                    'message' => 'Something went wrong'
            )));
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'message' => 'Updated Successfully'
            )));
    }
    
     private function deleteCave($cave_num)
    {
        $cave = $this->cave_model->deleteCaveM($cave_num);
        if($cave)
        {
            return $this->output
            ->set_content_type('application/json')
            ->set_status_header(500)
            ->set_output(json_encode(array(
                    'message' => 'Something went wrong'
            )));
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'message' => 'Deleted Successfully'
            )));
    }
}

