<?php
require_once 'system/core/Model.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class FormValidation extends CI_Model
{
    public function __construct()
    {
        $this->load->library('form_validation');
    }
    
    public function defaultFormSave($form_name)
    {
        $this->form_validation->set_rules('form_name', 'form_name', 'required', array('required' => 'Please Enter Form Name.'));
        if ($this->form_validation->run() == false)
        {
            return validation_errors();
            exit;
        }
        
        if($this->db->where('name', $form_name)->get('default_form_container')->row())
        {
            return '<p>Form Name Already Exists</p>';
            exit;
        }
    }
    
    public function defaultFormUpdate($form_name, $id)
    {
        $this->form_validation->set_rules('form_name', 'form_name', 'required', array('required' => 'Please Enter Form Name.'));
        if ($this->form_validation->run() == false)
        {
            return validation_errors();
            exit;
        }
        
        if($this->db->where('id!=', $id)->where('name', $form_name)->get('default_form_container')->row())
        {
            return '<p>Form Name Already Exists</p>';
            exit;
        }
    }
}