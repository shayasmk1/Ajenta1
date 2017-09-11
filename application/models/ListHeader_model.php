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

        }
        ?>