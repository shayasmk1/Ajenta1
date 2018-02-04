<?php
require_once 'system/core/Model.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class StoryValidation extends CI_Model
{
    public function __construct()
    {
        $this->load->library('form_validation');
    }
    
    public function saveStory($data)
    {
        $this->form_validation->set_rules('data[title]', 'title', 'required', array('required' => 'Please Enter Title.'));
        $this->form_validation->set_rules('data[description]', 'description', 'required', array('required' => 'Please Enter Description.'));
        if ($this->form_validation->run() == false)
        {
            return validation_errors();
            exit;
        }
    }
    
    public function updateStory($data)
    {
        $this->form_validation->set_rules('data[title]', 'title', 'required', array('required' => 'Please Enter Title.'));
        $this->form_validation->set_rules('data[description]', 'description', 'required', array('required' => 'Please Enter Description.'));
       // $this->form_validation->set_rules('data[story_id]', 'story_id', 'required', array('required' => 'Story Reference is Required.'));
        if ($this->form_validation->run() == false)
        {
            return validation_errors();
            exit;
        }
    }
}