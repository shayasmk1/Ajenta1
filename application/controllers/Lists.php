    <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Lists extends CI_Controller {

        /*
         * Constructor Call
         */
        function __construct() {
            parent::__construct();
            $this->load->dbforge(); //Loading Dbforge class of CodeIgnitor
            $this->load->model('list_model');
        }
        /*
         * Function to add list to table 'list'
         */
        function createList1(){
            $column_name = $this->input->post('columnname');
            $fields = array(
            $column_name => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
            ));
            $result= $this->dbforge->add_column('all_list', $fields);
            if(!$result){
                echo "Unable to Create List!";
            }else{
                echo "Successfully Created List !";
            }
        }

        /*
         * Function to add entry to list
         */
        function addToList(){
            $entry = $this->input->post('entryAdd');
            $listname = $this->input->post('ret_list');
            $this->list_model->addToListM($listname,$entry);
        }
        /*
         * Delete List
         */
        function deleteList(){
            $column_name = $this->input->post('del_list');
            $this->list_model->deleteListM($column_name);
        }
        /*
         * Function to Show columns availble in List
         */
        function allList(){
            $data = $this->list_model->getList();
            echo json_encode($data);
            return;
        }

        /*
         * Update List to show 
         */
        function updateList(){
            $post_data  = $this->input->post();
            //print_r($post_data['post_data'][0]['all_period']);
            
            foreach ($post_data['post_data'][0] as $value) {
                //echo $value ;
                //echo "<br>";
                $data = array(
                        "all_period"=>$post_data['post_data'][0]['all_period'],
                        "sno"=>$post_data['post_data'][0]['sno'],
                        "all_patron"=>$post_data['post_data'][0]['all_patron'],
                        "all_type"=>$post_data['post_data'][0]['all_type'],
                );
              
            }
            $this->list_model->updateListM($data); 
        }


        /*
         * Function to Create different table name and different column name
         */
        function createList2(){
            $fields = array(
            'blog_id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
            ),
            'blog_title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'unique' => TRUE,
            ),
            'blog_author' => array(
                    'type' =>'VARCHAR',
                    'constraint' => '100',
                    'default' => 'King of Town',
            ),
            'blog_description' => array(
                    'type' => 'TEXT',
                    'null' => TRUE,
            ),
    );
            $this->dbforge->add_field($fields);
            $attributes = array('ENGINE' => 'InnoDB');
            $table_name = $this->input->post('listname');
            $this->dbforge->create_table($table_name, TRUE, $attributes);
        }

        function index() {
            echo "index check 1 2 3 ";
        }
        
        
        function entry($listID, $column, $type = 'delete')
        {
            switch($type)
            {
                case 'delete':
                    $this->deleteEntry($listID,$column);
            }
        }
        
        private function deleteEntry($listID,$column)
        {
            $delete = $this->list_model->deleteEntry($listID,$column);
            if(!$delete)
            {
                http_response_code(500);
                echo json_encode('something went wrong');
                exit;
            }
            
            http_response_code(200);
            echo json_encode('Deleted');
            exit;
        }
    }

