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
}
