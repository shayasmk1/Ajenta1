<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Caves extends CI_Controller {

    /*
     * Constructor Call
     */
    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->database();
        $this->load->model('cave_model');
        $this->load->model('form_model');
        $this->load->model('painting_model');
        $this->load->library('session');
        $this->lang->load('public_lang', 'english');
        $this->load->library('upload');
    }

    /*
     * Function to Add New Cave Data
     */
    function addCave() {
        $data = array(
            'cave_description' => $this->input->post('cave_description'),
            'cave_patron' => $this->input->post('cave_patron'),
            'cave_period' => $this->input->post('cave_period'),
            'cave_type' => $this->input->post('cave_type'),
            'uploaded_by' => $this->session->userdata('user_name'),
            'date_added' => date("Y/m/d"),
            'cave_numb' => $this->input->post('cave_numb'),
        );
        $this->cave_model->insertCaveM($data);
    }

    /*
     * Function to Update the Cave Data 
     */
    function updateCave() {
        $data = array(
            'cave_description' => $this->input->post('cave_description'),
            'cave_patron' => $this->input->post('cave_patron'),
            'cave_period' => $this->input->post('cave_period'),
            'cave_type' => $this->input->post('cave_type'),
            'uploaded_by' => $this->session->userdata('user_name'),
            'date_added' => date("Y/m/d"),
            'cave_numb' => $this->input->post('cave_numb'),
        );
        $this->cave_model->updateCaveM($data);
        $data['one_cave_data'] = $this->cave_model->getOneCaveM($data['cave_numb']);
        echo json_encode($data);
    }

    /*
     *  Function to Delete Cave Data
     */
    public function deleteCave() {
        $search = $this->input->post('cave_numb');
        $this->cave_model->deleteCaveM($search);
    }
    
    /*
     *  Function to get cave based on user-selected Cave
     */
    function getOneCave() {
        $search = $this->input->post('cave_numb');
        $data['one_cave_data'] = $this->cave_model->getOneCaveM($search);
        $data['header'] = $this->cave_model->getHeaders($search);
        echo json_encode($data);
    }
    
    
    /*
     * Function to upload LineDrawings, Painting , Reconstructed , Recreated
     */
    function galleryUpload(){
        $config = array(
            'upload_path' => "assets/images/uploaded_images/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024"
        );
        //Load Library and initialise $config configuarations
        $this->load->library('upload'); 
        $this->upload->initialize($config);
        
        if($this->upload->do_upload('painting'))
        {
          $image_data = array('upload_data' => $this->upload->data()); // Data of uploaded Image
          //Create require set of Data for database
          $req_data = array(
              'title' => $this->input->post('title'),
              'description'=>$this->input->post('description'),
              'filename' => $image_data['upload_data']['file_name'],
              'file_dir' => $image_data['upload_data']['full_path'],
              'date_added'=> date("d/m/Y"),
          );
        $this->painting_model->addPainting($req_data);
          //$this->load->view('uploaded_success',$data);
        }
        else
        {
          $error = array('error' => $this->upload->display_errors());
          $this->load->view('error', $error);
        }
    }
    
    function index() {
        echo "index check 1 2 3 ";
    }
    
    function forms()
    {
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
                if($each->type == 'checkbox-group' || $each->type == 'radio-group' || $each->type= 'select')
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
                else if($each->type == 'button' || $each->type == 'date' || $each->type == 'file' || $each->type == 'header'
                            || $each->type == 'paragraph' || $each->type == 'number' || $each->type == 'text' || $each->type == 'textarea')
                {
                    $eachArray[$count]['type'] = $each->type;
                    $eachArray[$count]['label'] = $each->label;
                    $eachArray[$count]['placeholder'] = $each->placeholder;
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
                }
                $count++;
            }
            
            $res = $this->form_model->insertData($eachArray);
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
