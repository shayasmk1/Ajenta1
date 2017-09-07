<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;


class Unity extends REST_Controller {

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}
	
	public function users_get()
	{
		// Users from a data store e.g. database
		$users = [
				['id' => 1, 'painting_cave' => '15', 'story' => 'I dont know ', 'type' => 'ABC'],
				['id' => 2, 'painting_cave' => '1', 'story' => 'Trying to know', 'type' => 'DEF'],
				['id' => 3, 'painting_cave' => '6', 'story' => 'I will let you know', 'type' => 'GEH', ['patron' => ['Vivek', 'Nithin']]],
		];
	
		$id = $this->get('id');
	
		// If the id parameter doesn't exist return all the users
	
		if ($id === NULL)
		{
			// Check if the users data store contains users (in case the database result returns NULL)
			if ($users)
			{
				// Set the response and exit
				$this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			}
			else
			{
				// Set the response and exit
				$this->response([
						'status' => FALSE,
						'message' => 'No users were found'
				], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			}
		}
	
		// Find and return a single record for a particular user.
		else {
			$id = (int) $id;
	
			// Validate the id.
			if ($id <= 0)
			{
				// Invalid id, set the response and exit.
				$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
			}
	
			// Get the user from the array, using the id as key for retrieval.
			// Usually a model is to be used for this.
	
			$user = NULL;
	
			if (!empty($users))
			{
				foreach ($users as $key => $value)
				{
					if (isset($value['id']) && $value['id'] === $id)
					{
						$user = $value;
					}
				}
			}
	
			if (!empty($user))
			{
				$this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			}
			else
			{
				$this->set_response([
						'status' => FALSE,
						'message' => 'User could not be found'
				], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			}
		}
	}
}