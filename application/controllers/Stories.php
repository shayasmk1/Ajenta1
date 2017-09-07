<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );


class Stories extends CI_Controller {

	function __construct() {
		parent::__construct ();
		$this->load->helper ( array ('url','form' ) );
		$this->lang->load('public_lang', 'english');
	}
}