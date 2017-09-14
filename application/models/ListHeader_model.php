        <?php

        class ListHeader_model extends CI_Model {

            function __construct() {
                parent::__construct();
                $this->table = 'list_header';
            }
            /*
             * Model to get User Selected Data
             */
            function getList() {
                return $this->db->get($this->table)->result_array();
            }
            
            function insertData($data)
            {
                return $this->db->set($data)->insert($this->table);
            }
            
            function deleteList($column)
            {
                return $this->db->where('id', $column)->delete($this->table);
            }
        }
        ?>