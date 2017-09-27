        <?php

        class Form_model extends CI_Model {

            function __construct() {
                parent::__construct();
                $this->table = 'form';
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
                $this->db->trans_begin();
                foreach($data AS $each)
                {
                    $values = array();
                    $data1 = $each;
                    if(isset($data1['sub']))
                    {
                        $values = $data1['sub'];
                        unset($data1['sub']);
                    }
                    
                    $this->db->set($data1)->insert($this->table);
                    $insertID = $this->db->insert_id();
                    if(!$insertID)
                    {
                        $this->db->rollback();
                        return 0;
                        exit;
                    }
                    if(isset($values) || !empty($values))
                    {
                        foreach($values AS $value)
                        {
                            $value1 = $value;
                            $value1['form_id'] = $insertID;
                            
                            $this->db->set($value1)->insert('form_options');
                            $insertID1 = $this->db->insert_id();
                            if(!$insertID1)
                            {
                                $this->db->rollback();
                                return 0;
                                exit;
                            }
                        }
                    }
                }
                
                if($this->db->trans_status() === FALSE)
                {
                    $this->db->rollback();
                    return 0;
                    exit;
                }
                $this->db->trans_commit();
                return 1;
                exit;
            }
        }
        ?>