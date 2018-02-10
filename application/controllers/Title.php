<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Title extends CI_Controller {

    /*
     * Constructor Call
     */
    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->database();
        $this->load->model('Story_model');
        $this->load->model('Title_model');
        $this->load->model('File_model');
        
        $this->load->library('session');
        $this->lang->load('public_lang', 'english');
        $this->load->library('upload');
    }

    public function save($storyID)
    {
        if(!isset($_POST['data']))
        {
            header('HTTP/1.1 400 Created');
            echo json_encode('No Input FOund');
            exit;
        }
        
        $story = $this->Story_model->getCurrentCaveStory($storyID);
        if(!$story)
        {
            header('HTTP/1.1 404 Created');
            echo json_encode('Story Not Found');
            exit;
        }
        
        $msg = '';
        $data = $_POST['data'];
        if(!isset($data['name']) || trim($data['name']) == '')
        {
            $msg.= "Name is required\n";
        }
        if(!isset($data['description']) || trim($data['description']) == '')
        {
            $msg.= "Description is required\n";
        }
        
        if(trim($msg) != '')
        {
            header('HTTP/1.1 400 Created');
            echo json_encode($msg);
            exit;
        }
        
        $maxPosition = $this->Title_model->getMaxPosition($storyID);
        $data['position'] = $maxPosition->position + 1;
        
        $data['cave_story_id'] = $storyID;
        $data['created_at'] = $data['updated_at'] = date("Y-m-d H:i:s");
        $res = $this->Title_model->insert_data($data);
        if(!$res)
        {
            header('HTTP/1.1 500 Created');
            echo json_encode('Something Went Wrong');
            exit;
        }
        
        header('HTTP/1.1 200 Created');
        echo json_encode('Title Added Successfully');
        exit;
    }
    
    public function update($titleID)
    {
        if(!isset($_POST['data']))
        {
            header('HTTP/1.1 400 Created');
            echo json_encode('No Input FOund');
            exit;
        }
        
        $title = $this->Title_model->getCurrentCaveStoryTitle($titleID);
        if(!$title)
        {
            header('HTTP/1.1 404 Created');
            echo json_encode('Title Not Found');
            exit;
        }
        
        $msg = '';
        $data = $_POST['data'];
        if(!isset($data['name']) || trim($data['name']) == '')
        {
            $msg.= "Name is required\n";
        }
        if(!isset($data['description']) || trim($data['description']) == '')
        {
            $msg.= "Description is required\n";
        }
        
        if(trim($msg) != '')
        {
            header('HTTP/1.1 400 Created');
            echo json_encode($msg);
            exit;
        }
        
        $data['created_at'] = $data['updated_at'] = date("Y-m-d H:i:s");
        $res = $this->Title_model->updateData($data, $titleID);
        if(!$res)
        {
            header('HTTP/1.1 500 Created');
            echo json_encode('Something Went Wrong');
            exit;
        }
        
        header('HTTP/1.1 200 Created');
        echo json_encode('Title Added Successfully');
        exit;
    }
    
    public function all($storyID)
    {
        $titles = $this->Title_model->getAllTitles($storyID);
        header('HTTP/1.1 200 Created');
        echo json_encode($titles);
    }
    
    public function current($titleID)
    {
        $title = $this->Title_model->getCurrentCaveStoryTitle($titleID);
        //$data['files'] = $this->File_model->getAllFilesForTitle($titleID);
        
        header('HTTP/1.1 200 Created');
        echo json_encode($title);
        exit;
    }
    
    public function mp3($titleID)
    {
        $files = $this->File_model->getAllFilesForTitle($titleID); 
        header('HTTP/1.1 200 Created');
        echo json_encode($files);
        exit;
    }
    
    function file_upload()
    {
        if (isset($_FILES) && !empty($_FILES) && isset($_POST['reference_task_id'])) {
            $target_dir = FCPATH . 'assets/uploads/mp3/';
            $randName = date("dmyhis") . rand(1000,9999) . '_' . basename($_FILES["file"]["name"]);
            $target_file = $target_dir . $randName;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $msg = '';
            // Check if image file is a actual image or fake image
            
            // Check if file already exists
            if (file_exists($target_file)) {
                $msg.= "Sorry, file already exists.";
            }
            // Check file size
            if ($_FILES["file"]["size"] > 500000000000) {
                $msg.= "Sorry, your file is too large.";
            }
            // Allow certain file formats
            if($imageFileType != "mp3") {
                $msg.= "Sorry, only mp3 files are allowed.";
            }
            
            if(trim($msg) != '')
            {
                header('HTTP/1.1 400 Created');
                echo json_encode($msg);
                exit;
            }
            
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                //$fileData['reference'] = 'Task';
                //$fileData['mp3'] = $_POST['reference_task_id'];
                $fileData['mp3'] = $randName;
                $fileData['updated_at'] = date("Y-m-d H:i:s");
                $res = $this->Title_model->updateData($fileData, $_POST['reference_task_id']);
                if(!$res)
                {
                    header('HTTP/1.1 500 Created');
                    echo json_encode('Something Went Wrong');
                    exit;
                }
            } else {
                header('HTTP/1.1 400 Created');
                echo json_encode('Sorry there was an error uploading file');
                exit;
            }
        }
    }
}
