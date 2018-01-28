        <?php

        class CaveImage_model extends CI_Model {

            function __construct() {
                parent::__construct();
                $this->table = 'cave_image';
            }
            /*
             * Model to get User Selected Data
             */
            function getAllCaveImages($caveID) {
                    return $this->db->where('cave_id', $caveID)->get($this->table)->result_array();
            }
            
            function insertData($data)
            {
                return $this->db->set($data)->insert($this->table);
            }
            
            function deleteList($column)
            {
                return $this->db->where('id', $column)->delete($this->table);
            }
            
            function getAllDistinctHeaders()
            {
                return $this->db->group_by('name')->get($this->table)->result_array();
            }
            
            function getCurrentCaveImage($caveImageID)
            {
                return $this->db->where('id', $caveImageID)->get($this->table)->row();
            }
        }
        ?>