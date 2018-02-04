<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );


class Stories extends CI_Controller {
    function __construct() {
        parent::__construct ();
        $this->load->helper ( array ('url','form' ) );
        $this->lang->load('public_lang', 'english');
        $this->load->model('Story_model');
        $this->load->model('File_model');
    }

    function current($storyID)
    {
        $strory = $this->Story_model->getCurrentCaveStory($storyID);
        header('HTTP/1.1 200 Created');
        echo json_encode($strory);
        exit;
    }
}