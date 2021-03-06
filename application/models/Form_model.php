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
            
            function insertCustomBuilder($data)
            {
                $this->db->trans_begin();
                $count = 1;
                
                $data1['name'] = $data['name'];
                //$caveInsert = array('form_name' => $formName);
                $caveInsert = $this->db->set($data1)->insert($this->table);
                $formID = $this->db->insert_id();
                if(!$formID)
                {
                    $this->db->rollback();
                    return 0;
                    exit;
                }
                
                if(!$caveInsert)
                {
                    $this->db->rollback();
                    return 0;
                    exit;
                }
                
                $items = $data['items'];
                foreach($items AS $item)
                {
                    $values = array();
                    $data2 = $item;
                    unset($data2['options']);
                    $data2['form_id'] = $formID;
                    $this->db->set($data2)->insert('form_type');
                    
                    $insertID = $this->db->insert_id();
                    if(!$insertID)
                    {
                        $this->db->rollback();
                        return 0;
                        exit;
                    }
                    
                    if($item['type'] == 'select')
                    {
                        if(isset($item['options']))
                        {
                            foreach($item['options'] AS $option)
                            {
                                $data3 = array();
                                $data3['form_type_id'] = $insertID;
                                $data3['name'] = $option;
                                if($item['value'] == $option)
                                {
                                    $data3['selected'] = 1;
                                }
                                else {
                                    $data3['selected'] = 0;
                                }
                                $this->db->set($data3)->insert('form_option');
                                
                                $optionID = $this->db->insert_id();
                                if(!$optionID)
                                {
                                    $this->db->rollback();
                                    return 0;
                                    exit;
                                }
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
            
            function insertData($data, $caveID, $formName = null)
            {
                $this->db->trans_begin();
                $count = 1;
                
                $caveInsert = array('form_name' => $formName);
                $caveUpdate = $this->db->where('cave_numb', $caveID)->set($caveInsert)->update('caves');
                if(!$caveUpdate)
                {
                    $this->db->rollback();
                    return 0;
                    exit;
                }
                
                $optionDelete = $this->db->where('cave_id', $caveID)->set(array('deleted_at' => date("Y-m-d H:i:s")))->update($this->table);
                if(!$optionDelete)
                {
                    $this->db->rollback();
                    return 0;
                    exit;
                }
                
                foreach($data AS $each)
                {
                 
                    $values = array();
                    $data1 = $each;
                    if(isset($data1['sub']))
                    {
                        $values = $data1['sub'];
                        unset($data1['sub']);
                    }
                    
                    $data1['field_order'] = $count++;
                    $data1['deleted_at'] = null;
                    
                    $form = $this->db->where('name', $data1['name'])->where('cave_id', $data1['cave_id'])->get('form')->row();
                    if(!$form)
                    {
                        $this->db->set($data1)->insert($this->table);
                        $insertID = $this->db->insert_id();
                    }
                    else
                    {
                        $insertID = $form->id;
                        $this->db->where('id', $insertID)->set($data1)->update($this->table);
                    }
                    
                    
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
                            $value1['label_name'] = $value['label'];
                            $value1['options'] = $value['value'];
                            $value1['form_id'] = $insertID;
                            
                            $formOption = $this->db->where('label_name', $value1['label_name'])->where('form_id', $insertID)->get('form_options')->row();
                            if(!$formOption)
                            {
                                $this->db->set($value1)->insert('form_options');
                                $insertID1 = $this->db->insert_id();
                            }
                            else
                            {
                                $insertID1 = $formOption->id;
                                $this->db->where('id', $insertID1)->set($value1)->update('form_options');
                            }
                            
                            if(!$insertID1)
                            {
                                $this->db->rollback();
                                return 0;
                                exit;
                            }
                        }
                    }
                }
                
                $delete = $this->db->where('cave_id', $caveID)->where('deleted_at IS NOT NULL')->delete($this->table);
                if(!$delete)
                {
                    $this->db->rollback();
                    return 0;
                    exit;
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
            
            public function getFormDetails($caveID)
            {
                $query = $this->db->where('form.cave_id', $caveID)->order_by('field_order')->get($this->table)->result_array();
                
                // Loop through the products array
                foreach($query as $i => $value) {
                    $count = 0;
                    // Get an array of products images
                    // Assuming 'p_id' is the foreign_key in the images table
                    $options = $this->db->where('form_id', $value['id'])->get('form_options')->result_array();

                    // Add the images array to the array entry for this product
                    if(!empty($options))
                    foreach($options AS $option)
                    {
                        $query[$i]['values'][$count]['label'] = $option['label_name'];
                        $query[$i]['values'][$count]['value'] = $option['options'];
                        $query[$i]['values'][$count]['selected'] = $option['selected'];
                        $count++;
                    }

                }
                return $query;
            }
            
            public function updateValues($forms)
            {
                $caveID = $forms['cave_id'];
                unset($forms['cave_id']);
                foreach($forms AS $key => $form){
                    $value['value'] = $form;
                    
                    $this->db->where('name', $key)->where('cave_id', $caveID)->set($value)->update($this->table);
                }
                
                return 1;
            }
            
            public function getAllForms()
            {
                return $this->db->get($this->table)->result_array();
            }
        }
        ?>