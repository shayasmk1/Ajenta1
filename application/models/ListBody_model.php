        <?php

        class ListBody_model extends CI_Model {

            function __construct() {
                parent::__construct();
                $this->table = 'list_body';
            }
            
            /*
             * Model to get User Selected Data
             */
            function getList() {
                return $this->db->get($this->table)->result_array();
            }
            
            function deleteEntry($listID)
            {
                return $this->db->where('id', $listID)->delete($this->table);
            }
            
            function insertData($data)
            {
                return $this->db->set($data)->insert($this->table);
            }
            
            function getBodyOfHeader($listHeaderID)
            {
                return $this->db->where('list_header_id', $listHeaderID)->get($this->table)->result_array();
            }
            
            function addNewRows($data, $headerID)
            {
                foreach($data AS $each)
                {
                    $insert = array();
                    $insert = $each;
                    //$insert['']
                }
            }
        }
        ?>