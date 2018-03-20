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
            $this->load->model('listHeader_model');
            $this->load->model('listBody_model');
            $this->load->library ( 'session' );
            $this->load->helper(array('url', 'form'));
            $this->lang->load('public_lang', 'english');
        }
        /*
         * Function to add list to table 'list'
         */
        function createList1(){
            $column_name = $this->input->post('columnname');
            $data['name']  = $column_name;
//            $fields = array(
//            $column_name => array(
//                    'type' => 'VARCHAR',
//                    'constraint' => '255',
//            ));
            //$result= $this->dbforge->add_column('all_list', $fields);
            $result = $this->listHeader_model->insertData($data);
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
            $data['name'] = $this->input->post('entryAdd');
            $data['list_header_id'] = $this->input->post('ret_list');
            
            $insert = $this->listBody_model->insertData($data);
            if(!$insert){
                echo "Unable to Add to List!";
            }else{
                echo "Successfully Added to List !";
            }
        }
        /*
         * Delete List
         */
        function deleteList(){
            $column_name = $this->input->post('del_list');
            $delete = $this->listHeader_model->deleteList($column_name);
            if(!$delete){
                echo "Unable to Delete List!";
            }else{
                echo "Successfully Deleted List !";
            }
        }
        /*
         * Function to Show columns availble in List
         */
        function allList(){
            $data = $this->list_model->getList();
            echo json_encode($data);
            return;
            
            
        }
        
        function allHeaderList()
        {
            $data = $this->listHeader_model->getList();
            echo json_encode($data);
            exit;
        }
        
        function allBodyList()
        {
            $data = $this->listBody_model->getList();
            echo json_encode($data);
            exit;
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
        
        
        function entry($listID, $type = 'delete')
        {
            switch($type)
            {
                case 'delete':
                    $this->deleteEntry($listID);
            }
        }
        
        private function deleteEntry($listID)
        {
            $delete = $this->listBody_model->deleteEntry($listID);
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
        
        function body($caveHeaderID)
        {
            $data = $this->listBody_model->getBodyOfHeader($caveHeaderID);
            echo json_encode($data);
            exit;
        }
        
        function create()
        {
            if($this->session->userdata('user_profile') != 'administrator')
            {
                redirect('home/index');
            }
            $this->load->view ('theme/header');
            $this->load->view('list/create');
            $this->load->view ('theme/footer');
        }
        
        function ajax($type)
        {
            switch($type)
            {
                case 'create':
                    if($this->input->method() != 'post')
                    {
                        http_response_code(404);
                        echo json_encode('Not Found');
                        exit;
                    }
                    $name  = $this->input->post('name');
                    $this->addHeaderType($name);
                    
                    break;
                
                default:
                    exit;
            }
        }
        
        private function addHeaderType($name)
        {
            $data['name'] = $name;
            $result = $this->listHeader_model->insertData($data);
            if(!$result){
                http_response_code(500);
                echo json_encode('Something Went Wrong');
                exit;
            }else{
                http_response_code(200);
                echo json_encode('List Header Added Successfully');
                exit;
            }
        }
    }
    
    

