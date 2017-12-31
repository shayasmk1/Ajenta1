<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller {

    /*
     * Constructor Call
     */
    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->database();
        $this->load->model('DefaultForm_model');
        $this->load->library('session');
        $this->lang->load('public_lang', 'english');
        $this->load->library('upload');
    }

    /*
     * Function to Add New Cave Data
     */
    
    function default_add()
    {
        if($this->session->userdata('user_profile') != 'administrator')
        {
            redirect('home/index');
        }
        $this->load->view ('theme/header');
        $this->load->view('default_form');
        $this->load->view ('theme/footer');
    }
    
    function getDefaultFormData()
    {
        $formDetails = $this->DefaultForm_model->getDefaultFormDetails();
       
        if(empty($formDetails))
        {
            header('HTTP/1.1 201 Created');
            echo json_encode(array('message' => 'Empty Array'));
            exit;
        }
        
        $formDetails = json_encode($formDetails);
        
        header('HTTP/1.1 200 Created');
            echo json_encode(array('message' => 'Successfully Saved', 'data' => $formDetails));
            exit;
    }
    
    function default_save() {
        if($this->input->method() == 'post')
        {
            $data = $this->input->post('data');
            
            $data = json_decode($data);
            $eachArray = array();
            $count = 0;
            
            if(empty($data))
            {
                header('HTTP/1.1 400 Created');
                echo json_encode(array('message' => 'No input found'));
                exit;
            }
            
            
            foreach($data AS $each)
            {
                $count1 = 0;
                if($each->type == 'checkbox-group' || $each->type == 'radio-group' || $each->type == 'select')
                {
                    
                    $eachArray[$count]['type'] = $each->type;
                    if(isset($each->name))
                    {
                        $eachArray[$count]['name'] = $each->name;
                    }
                    if(isset($each->label))
                    {
                        $eachArray[$count]['label'] = $each->label;
                    }
                    if(isset($each->placeholder))
                    {
                        $eachArray[$count]['placeholder'] = $each->placeholder;
                    }
                    
                    if(isset($each->className))
                    {
                        $eachArray[$count]['className'] = $each->className;
                    }
                    if(isset($each->value))
                    {
                        $eachArray[$count]['value'] = $each->value;
                    }
                    
                    if(isset($each->subtype))
                    {
                        $eachArray[$count]['subtype'] = $each->subtype;
                    }
                    
                    if(isset($each->required))
                    {
                        $eachArray[$count]['required'] = 1;
                    }
                    
                    if(isset($each->maxlength))
                    {
                        $eachArray[$count]['maxlength'] = $each->maxlength;
                    }
                    
                    if(!empty($each->values))
                    foreach($each->values AS $value){
                        
                        $eachArray[$count]['sub'][$count1]['label'] = $value->label;
                        if(isset($value->selected))
                        {
                            $eachArray[$count]['sub'][$count1]['selected'] = $value->selected;
                        }
                        $eachArray[$count]['sub'][$count1]['value'] = $value->value;
                                
                        $count1++;
                    }
                }
                else if($each->type == 'button' || $each->type == 'date' || $each->type == 'file' || $each->type == 'number' || $each->type == 'text' || $each->type == 'textarea')
                {
                    
                    $eachArray[$count]['type'] = $each->type;
                    
                    $eachArray[$count]['label'] = $each->label;
                    if(isset($each->placeholder))
                    {
                        $eachArray[$count]['placeholder'] = $each->placeholder;
                    }
                    if(isset($each->name))
                    {
                        $eachArray[$count]['name'] = $each->name;
                    }
                    if(isset($each->className))
                    {
                        $eachArray[$count]['className'] = $each->className;
                    }
                    if(isset($each->style))
                    {
                        $eachArray[$count]['style'] = $each->style;
                    }
                    if(isset($each->value))
                    {
                        $eachArray[$count]['value'] = $each->value;
                    }
                    
                    if(isset($each->subtype))
                    {
                        $eachArray[$count]['subtype'] = $each->subtype;
                    }
                    
                    if(isset($each->required))
                    {
                        $eachArray[$count]['required'] = 1;
                    }
                    
                    if(isset($each->maxlength))
                    {
                        $eachArray[$count]['maxlength'] = $each->maxlength;
                    }
                }
                else if($each->type == 'header' || $each->type == 'paragraph')
                {
                    $eachArray[$count]['name'] = $each->type . rand(1000000,9999999);
                    $eachArray[$count]['type'] = $each->type;
                    $eachArray[$count]['label'] = $each->label;
                    
                    if(isset($each->subtype))
                    {
                        $eachArray[$count]['subtype'] = $each->subtype;
                    }
                }
                $count++;
            }
          
            $res = $this->DefaultForm_model->insertData($eachArray);
            if(!$res)
            {
                header('HTTP/1.1 500 Created');
                echo json_encode('Something went wrong');
                exit;
            }
            else
            {
                header('HTTP/1.1 200 Created');
                echo json_encode('Successfully Saved');
                exit;
            }
        }
    }
}