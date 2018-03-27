        <?php

        class List_model extends CI_Model {

            function __construct() {
                parent::__construct();
                $this->table = 'all_list';
            }
            /*
             * Model to get User Selected Data
             */
            function getList() {
                $query = $this->db->query('SELECT * FROM `all_list`');
                return $query->result_array();
                //return $query->result();
            }

            /*
             * Model to add data to List
             */
            function updateListM($data) {
                $this->db->where('sno', $data['sno']);
                $result = $this->db->update('all_list', $data);
                if (!$result) {
                    echo "Unable to Update. Inform Administrator !";
                } else {
                    echo "Update Successfull";
                }
            }

            /*
             * Model to Delete the Code
             */
            function deleteListM($columnname){
                $sql= "ALTER TABLE `all_list` DROP $columnname";
                $result= $this->db->query($sql);
                if(!$result){
                    echo "Unable to Delete Column !";
                }else{
                    echo "Successfully Deleted !";
                }
            }
            /*
             * Function to add entry to list 
             */
            function addToListM($listname,$entry){
                $sql= "INSERT INTO `all_list`(`$listname`) VALUES ('$entry')";
                $result= $this-> db-> query($sql);
                if (!$result) {
                    echo "Duplicate Entry Exist !";
                } else {
                    echo "Entry Added to List !";
                }
            }
            
            function deleteEntry($listID,$column)
            {
                return $this->db->where('id', $listID)->set($data)->delete($this->table);
            }

        }
        ?>