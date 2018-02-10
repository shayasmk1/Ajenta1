<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );


class Stories extends CI_Controller {
    function __construct() {
        parent::__construct ();
        $this->load->helper ( array ('url','form' ) );
        $this->lang->load('public_lang', 'english');
        $this->load->model('Story_model');
        $this->load->model('Title_model');
        $this->load->model('File_model');
    }

    function current($storyID)
    {
        $strory = $this->Story_model->getCurrentCaveStory($storyID);
        header('HTTP/1.1 200 Created');
        echo json_encode($strory);
        exit;
    }
    
    public function delete($storyID)
    {
        if($this->input->method() == 'post')
        {
            $res = $this->Story_model->deleteStory($storyID);
            if(!$res)
            {
                header('HTTP/1.1 400 Created');
                echo json_encode('Something Went Wrong While Deleting Story');
                exit;
            }
            
            header('HTTP/1.1 200 Created');
            echo json_encode('Deletion Successful');
            exit;
        }
    }
    
    public function delete_title($chapterID)
    {
        if($this->input->method() == 'post')
        {
            $res = $this->Title_model->deleteChapter($chapterID);
            if(!$res)
            {
                header('HTTP/1.1 400 Created');
                echo json_encode('Something Went Wrong While Deleting Chapter');
                exit;
            }
            
            header('HTTP/1.1 200 Created');
            echo json_encode('Deletion Successful');
            exit;
        }
    }
}