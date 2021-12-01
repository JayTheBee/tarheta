<?php 

    class flashcard_model extends CI_Model{
        function insert_flashcard($data){
            $this->db->trans_start();
            $this->db->insert('flashcards', $data);
            $flashcard_id = $this->db->insert_id();

            $this->db->set('user_id', $data['creator_id']);
            $this->db->set('flashcard_id', $flashcard_id);
            $this->db->insert('flashcards_user_access');

            $this->db->trans_complete();
        }
    }
?>