<?php

class Users_model extends CI_Model {

	public function validate($user_name, $password) {
		$this->db->where('user_name', $user_name);
		$this->db->where('pass_word', $password);

		//Fetch all record from
		$query = $this->db->get('membership')->row(); //SELECT * FROM membership
		
		//echo $query;
		//die();
		
                if(!$query)
                {
                    return false;
                    exit;
                }
                
                $res['user_profile'] = $query->user_profile;
                return $res;
//		if ($query->num_rows() == 1) {
//			//echo "I am able to match";
//                    
//			return true;
//		} else {
//			//echo "I am not able to match";
//			return false;
//		}
	}

	/**
	 * Serialize the session data stored in the database,
	 * store it in a new array and return it to the controller
	 * @return array
	 */
	public function get_db_session_data() {
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row) {
			$udata = unserialize($row->user_data);
			/* put data in array using username as key */
			$user['user_name'] = $udata['user_name'];
			$user['is_logged_in'] = $udata['is_logged_in'];
		}
		return $user;
	}

	public function rights_by_admin(){
		//$query = $this->db->query('SELECT * FROM membership');
		$query= $this->db->get('membership');
		$data['users']= $query->result();
		return $data;
	}

	/**
	 * Store the new user's data into the database
	 * @return boolean - check the insert
	 */
	function create_member() {

		$this->db->where('user_name', $this->input->post('username'));
		$query = $this->db->get('membership');
		// fetch all records from membership and returns an object
		//which will store in '$query' object

		if ($query->num_rows > 0) {
			echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">�</a><strong>';
			echo "Username already taken";
			echo '</strong></div>';
		} else {

			$new_member_insert_data = array(
					'first_name' => $this->input->post('first_name'),
					'user_profile' => $this->input->post('user_profile'),
					'last_name' => $this->input->post('last_name'),
					'email_addres' => $this->input->post('email_address'),
					'user_name' => $this->input->post('username'),
					'pass_word' => md5($this->input->post('password'))
			);
			$insert = $this->db->insert('membership', $new_member_insert_data);
			return $insert;
		}
	}

        function insertData($data)
        {
            return $this->db->set($data)->insert('membership');
        }
}
