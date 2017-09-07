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
}
