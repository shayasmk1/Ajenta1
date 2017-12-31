<?php
require_once 'system/core/Model.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class AuthValidation extends CI_Model
{
    public function __construct()
    {
        $this->load->library('form_validation');
    }
    
    public function register($data)
    {
        $this->form_validation->set_rules('data[first_name]', 'first_name', 'required', array('required' => 'Please Enter First Name.'));
        $this->form_validation->set_rules('data[last_name]', 'last_name', 'required', array('required' => 'Please Enter Last Name.'));
        $this->form_validation->set_rules('data[email_addres]', 'email', 'required|valid_email', array('required' => 'Please Enter Email.'));
        $this->form_validation->set_rules('data[user_name]', 'user_name', 'required|min_length[4]', array('required' => 'Please Enter Username.','min_length' => 'Minimum length of username should be 4'));
        $this->form_validation->set_rules('data[pass_word]', 'pass_word', 'required|min_length[6]', array('required' => 'Please enter Password','min_length' => 'Minimum length of password should be 6'));
        $this->form_validation->set_rules('data[conf_password]', 'conf_password', 'required|min_length[6]', array('required' => 'Please enter Confirm Password.','min_length' => 'Minimum length of Confirm password should be 6'));
        if ($this->form_validation->run() == false)
        {
            return validation_errors();
            exit;
        }
        
        if($data['pass_word'] != $data['conf_password'])
        {
            return '<p>Password and Confirm Password Does Not Match</p>';
            exit;
        }
        
        if($this->db->where('user_name', $data['user_name'])->get('membership')->row())
        {
            return '<p>Username Already Exists</p>';
            exit;
        }
        
        if($this->db->where('email_addres', $data['email_addres'])->get('membership')->row())
        {
            return '<p>Email Already Exists</p>';
            exit;
        }
    }
    
}