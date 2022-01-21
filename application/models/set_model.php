<?php 

class set_model extends CI_Model {
    /**
     * Returns the flashcard that the user can access.
     * 
     * This comes with extra columns such as:
     * 'user_id' from the flashcard_user_access table.
     * 'set_id' from flashcard_set_list. 
     * 'set_name' from falshcard_sets. 
     * 'set_description' from flashcard_sets. 
     * 'set_color' from flashcard_sets. 
     */
    public function get_flashcard_with_set($user_id){
        // Starting to learn the proper query building and would rework the other functions if there is time.
        $this->db->select("flashcards.*, flashcards_user_access.user_id, flashcard_set_list.set_id, flashcard_sets.name AS set_name, flashcard_sets.color AS set_color, flashcard_sets.description AS set_description"); 
        $this->db->join('flashcards_user_access', 'flashcards_user_access.flashcard_id = flashcards.id');
        $this->db->join('flashcard_set_list', 'flashcard_set_list.flashcard_id = flashcards.id');
        $this->db->join('flashcard_sets', 'flashcard_sets.id = flashcard_set_list.set_id');
        $query = $this->db->get('flashcards');

        // echo "<pre>";
        // var_dump($query->result_array());
        // echo "</pre>";
        // exit();
        return $query->result_array();
    }


    public function update_set_list($flashcard_id, $set_id){
        $this->db->trans_start();
        $this->db->from('flashcard_set_list');

        $this->db->set('set_id', $set_id);
        $this->db->where('flashcard_id', $flashcard_id);

        $this->db->update('flashcard_set_list');

        $this->db->trans_complete();
    }
}