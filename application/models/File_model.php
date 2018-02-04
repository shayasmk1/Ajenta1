        <?php

        class File_model extends CI_Model {

            function __construct() {
                parent::__construct();
                $this->table = 'files';
            }
            
            public function insertData($data)
            {
                return $this->db->set($data)->insert($this->table);
            }
            
            public function getAllFilesForTitle($titleID)
            {
                return $this->db->where('reference_id', $titleID)->where('reference', 'Task')->get($this->table)->result_array();
            }
            
        }
        ?>