<?php
require_once 'system/core/Model.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class ApiValidation extends CI_Model
{
    public function __construct()
    {
        $this->load->library('form_validation');
    }
    
    public function register($data)
    {
        $this->form_validation->set_rules('data[email]', 'email', 'required|valid_email', array('required' => 'Please Enter Email.', 'valid_email' => 'Please enter valid email'));
        $this->form_validation->set_rules('data[password]', 'password', 'required|min_length[8]', array('required' => 'Please enter Password','min_length' => 'Minimum length of password should be 8'));
        $this->form_validation->set_rules('data[name]', 'name', 'required', array('required' => 'Please enter Name.'));
        if ($this->form_validation->run() == false)
        {
            return validation_errors();
            exit;
        }
    }
    
    public function login($data)
    {
        $this->form_validation->set_rules('data[email]', 'email', 'required|valid_email', array('required' => 'Please Enter Email.', 'valid_email' => 'Please enter valid email'));
        $this->form_validation->set_rules('data[password]', 'password', 'required|min_length[8]', array('required' => 'Please enter Password','min_length' => 'Minimum length of password should be 8'));
        
        if ($this->form_validation->run() == false)
        {
            return validation_errors();
            exit;
        }
    }
}