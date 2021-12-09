<?php 

    class flashcard_model extends CI_Model{
        public function insert_flashcard($data){
            $this->db->trans_start();
            $this->db->insert('flashcards', $data);
            $flashcard_id = $this->db->insert_id();

            $this->db->set('user_id', $data['creator_id']);
            $this->db->set('flashcard_id', $flashcard_id);
            $this->db->insert('flashcards_user_access');
            $this->db->trans_complete();
            return $flashcard_id;
        }

        public function get_flashcards(){
            $user_id = $_SESSION['Profile']['user_id'];
            $query = $this->db->query("SELECT * FROM flashcards WHERE visibility='PUBLIC' OR creator_id='$user_id'");
            return $query->result_array();
            // echo("<pre>");
            //     print_r($query->result_array());
            // echo("</pre>");
            // exit();
        }
    }
?>