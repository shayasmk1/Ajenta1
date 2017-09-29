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
        $this->load->model('CaveImage_model');
        $this->load->model('Story_model');
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
            
            $cave_id = $this->input->post('cave_id');
            if($cave_id == 0)
            {
                header('HTTP/1.1 500 Created');
                echo json_encode(array('message' => 'Something went wrong'));
                exit;
            }
            
            foreach($data AS $each)
            {
                $count1 = 0;
                if($each->type == 'checkbox-group' || $each->type == 'radio-group' || $each->type == 'select')
                {
                    $eachArray[$count]['cave_id'] = $cave_id;
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
                else if($each->type == 'button' || $each->type == 'date' || $each->type == 'file' || $each->type == 'header'
                            || $each->type == 'paragraph' || $each->type == 'number' || $each->type == 'text' || $each->type == 'textarea')
                {
                    $eachArray[$count]['cave_id'] = $cave_id;
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
    
    public function getFormData()
    {
        $caveNumb = $this->input->post('cave_numb');
        
        $formDetails = $this->form_model->getFormDetails($caveNumb);
       
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
    
    public function uploadImage()
    {
        $storeFolder = '';   //2
        if (isset($_FILES) && !empty($_FILES) && isset($_POST['cave_num_global'])) {
            
            $tempFile = $_FILES['file']['tmp_name'];
            $caveNum = $_POST['cave_num_global'];
            $cave = $this->cave_model->getCaveByCaveNumber($caveNum);
            if(!$cave)
            {
                header('HTTP/1.1 400 Created');
                echo json_encode(array('message' => 'Somehting went wrong'));
                exit;
            }
            
            $targetPath = FCPATH . 'assets/uploads/';  //4
            $random = date("dhiyms") . rand(10000,99999). $_FILES['file']['name'];
            $targetFile =  $targetPath. $random;  //5

            if(!move_uploaded_file($tempFile,$targetFile))
            {
                header('HTTP/1.1 500 Created');
                echo json_encode(array('message' => 'Something went wrong'));
                exit;
            }
            
            $insert['cave_id'] = $cave->cave_id;
            $insert['location'] = $random;
            $res = $this->CaveImage_model->insertData($insert);
            if(!$res)
            {
                header('HTTP/1.1 500 Created');
                echo json_encode(array('message' => 'Somehting went wrong'));
                exit;
            }
            
            header('HTTP/1.1 200 Created');
                echo json_encode(array('message' => 'Uploaded SUccessfully'));
                exit;
            //$upload->index($storeFolder .'/'. $random);
            
        }
    }
    
    public function getImages()
    {
        if($this->input->method() == 'get')
        {
            $caveNumber = $this->input->get('cave_num');
            $cave = $this->cave_model->getCaveByCaveNumber($caveNumber);
            if(!$cave)
            {
                header('HTTP/1.1 400 Created');
                echo json_encode(array('message' => 'Somehting went wrong'));
                exit;
            }
            $res = $this->CaveImage_model->getAllCaveImages($cave->cave_id);
            header('HTTP/1.1 200 Created');
                echo json_encode($res);
                exit;
        }
    }
    
    public function saveStory()
    {
        if($this->input->method() == 'post')
        {
            if($this->input->post('data'))
            {
                $data = $this->input->post('data');
                $caveNumber = $data['cave_num'];
                $cave = $this->cave_model->getCaveByCaveNumber($caveNumber);
                if(!$cave)
                {
                    header('HTTP/1.1 400 Created');
                    echo json_encode(array('message' => 'Somehting went wrong'));
                    exit;
                }
                $data['cave_id'] = $cave->cave_id;
                unset($data['cave_num']);
                $id = $this->Story_model->insert_data($data);
                if(!$id)
                {
                    header('HTTP/1.1 500 Created');
                    echo json_encode(array('message' => 'Something went wrong'));
                    exit;
                }
                
                header('HTTP/1.1 200 Created');
                echo json_encode(array('message' => 'Story Saved Successfully', 'id' => $id));
                exit;
            }
        }
    }
    
    public function updateStory()
    {
        if($this->input->method() == 'post')
        {
            if($this->input->post('data'))
            {
                $data = $this->input->post('data');
                $strotyID = $this->input->post('storyID');
                if(!$strotyID || $strotyID == 0 || trim($strotyID) == '')
                {
                    header('HTTP/1.1 400 Created');
                    echo json_encode(array('message' => 'Somehting went wrong'));
                    exit;
                }
                $caveNumber = $data['cave_num'];
                $cave = $this->cave_model->getCaveByCaveNumber($caveNumber);
                if(!$cave)
                {
                    header('HTTP/1.1 400 Created');
                    echo json_encode(array('message' => 'Somehting went wrong'));
                    exit;
                }
                $data['cave_id'] = $cave->cave_id;
                unset($data['cave_num']);
                $id = $this->Story_model->updateData($data, $strotyID);
                if(!$id)
                {
                    header('HTTP/1.1 500 Created');
                    echo json_encode(array('message' => 'Something went wrong'));
                    exit;
                }
                
                header('HTTP/1.1 200 Created');
                echo json_encode(array('message' => 'Story Saved Successfully', 'id' => $id));
                exit;
            }
        }
    }
    
    public function getAllCaveImages()
    {
        if($this->input->method() == 'get')
        {
            $caveNum = $this->input->get('cave_num');
            $cave = $this->cave_model->getCaveByCaveNumber($caveNum);
            if(!$cave)
            {
                header('HTTP/1.1 400 Created');
                echo json_encode(array('message' => 'Somehting went wrong'));
                exit;
            }
            $res = $this->Story_model->getAllCaveImages($cave->cave_id);
            header('HTTP/1.1 200 Created');
                echo json_encode($res);
                exit;
        }
    }
}
