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
    public function get_flashcards_with_set($user_id){
        // Starting to learn the proper query building and would rework the other functions if there is time.
        // $this->db->select("flashcards.*, flashcards_user_access.user_id, flashcard_set_list.set_id, flashcard_sets.name AS set_name, flashcard_sets.color AS set_color, flashcard_sets.description AS set_description"); 
        // $this->db->join('flashcards_user_access', 'flashcards_user_access.flashcard_id = flashcards.id');
        // $this->db->join('flashcard_set_list', 'flashcard_set_list.flashcard_id = flashcards.id');
        // $this->db->join('flashcard_sets', 'flashcard_sets.id = flashcard_set_list.set_id');
        $this->_join_flashcard();
        $query = $this->db->get('flashcards');

        // echo "<pre>";
        // var_dump($query->result_array());
        // echo "</pre>";
        // exit();
        
        return $query->result_array();
    }


    /**
     * Reusable joining for getting an array of flashcards and singular flashcard
     */
    private function _join_flashcard(){
        $this->db->select("flashcards.*, flashcards_user_access.user_id, flashcard_set_list.set_id, flashcard_sets.name AS set_name, flashcard_sets.color AS set_color, flashcard_sets.description AS set_description"); 
        $this->db->join('flashcards_user_access', 'flashcards_user_access.flashcard_id = flashcards.id');
        $this->db->join('flashcard_set_list', 'flashcard_set_list.flashcard_id = flashcards.id');
        $this->db->join('flashcard_sets', 'flashcard_sets.id = flashcard_set_list.set_id');
    }


    public function get_flashcard_with_set($flashcard_id_arg){
        $this->_join_flashcard();
        $query_var = $this->db->get_where('flashcards', array('flashcards.id' => $flashcard_id_arg));

        if ($query_var->num_rows() != 0)
            return $query_var->row_array();
    }


    /**
     * Function to update a specific flashcard set row.
     */
    public function update_set_list($flashcard_id, $set_id){
        $this->db->trans_start();
        
        $query_var = $this->db->get_where('flashcard_set_list', array('flashcard_id'=>$flashcard_id));

        if ($query_var->num_rows() != 0){
            $this->db->from('flashcard_set_list');
            $this->db->set('set_id', $set_id);
            $this->db->where('flashcard_id', $flashcard_id);
            $this->db->update('flashcard_set_list');
        }
        else
            $this->insert_flashcard_sets($set_id, $flashcard_id);

        $this->db->trans_complete();
    }


    /**
     * Function where it returns an array containing all the sets of flashcard
     */
    public function get_sets($user_id){
        $query = $this->db->query("SELECT * FROM flashcard_sets WHERE user_id='$user_id'");
        if ($query->num_rows() != 0)
            return $query->result_array();
        else
            return FALSE;
    }


    /**
     * Function to get a singular set detail via set_id_arg
     */
    public function get($set_id_arg){
        $user_idvar = $_SESSION['sess_profile']['user_id'];
        $query = $this->db->get_where('flashcard_sets', array('flashcard_sets.id' => $set_id_arg, 'flashcard_sets.user_id' => $user_idvar));
        
        if ($query->num_rows() != 0)
            return $query->row_array();
        else
            return FALSE;
    }


    /**
     * Function to insert a new flashcard set row.
     */
    function insert_flashcard_sets($set_id, $flashcard_id){
        $this->db->trans_start();
        $this->db->set('flashcard_id', $flashcard_id);
        $this->db->set('set_id', $set_id);
        $this->db->insert('flashcard_set_list');
        $this->db->trans_complete();
    }

    
    /**
     * Function to check if the logged in user is the one who created the set
     */
    public function check_set($set_id_arg){
        $query = $this->get($set_id_arg);
        
        if ($query != FALSE)
            return TRUE;
        else
            return FALSE;
    }


    /**
     * Function update flashcard set details
     */
    public function update_set_datails($data_arg, $set_id_arg){
        $this->db->from('flashcard_sets');

        $this->db->set('name', $data_arg['name']);
        $this->db->set('description', $data_arg['description']);
        $this->db->set('color', $data_arg['color']);
        $this->db->where('id', $set_id_arg);

        $this->db->update('flashcard_sets');
    }


    /**
     * Function to delete a specific set in the DB
     */
    public function delete($set_id_arg){
        $this->db->where('id', $set_id_arg);
        $this->db->delete('flashcard_sets');
    }


    /**
     * Function to check if a flashcard is in a set
     */
    public function check_if_has_set($flashcard_id_arg){
        $query_var = $this->db->get_where('flashcard_set_list', array('flashcard_id' => $flashcard_id_arg));

        if ($query_var->num_rows() != 0 && $query_var->row('set_id') != -1)
            return TRUE;
        else
            return FALSE;

    }    
}