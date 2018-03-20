<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mainlist extends CI_Controller {

    /*
     * Constructor Call
     */
    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->database();
        
        $this->load->library('session');
        $this->lang->load('public_lang', 'english');
        $this->load->library('upload');
        
        $this->storValidation = new StoryValidation();
    }

    /*
     * Main Function
     */
    function index() {
        $lists = 
        $this->load->view ('theme/header');
        $this->load->view('list', $data);
        $this->load->view ('theme/footer');
    }

}
