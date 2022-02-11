<?php 

    class search_model extends CI_Model{

        private function _set_up_join(){
            
            // $this->db->select("flashcards.name"); 
            // $this->db->join('flashcards_user_access', 'flashcards_user_access.flashcard_id = flashcards.id');
            
            $this->db->join('flashcards', 'flashcards.id = flashcards_user_access.flashcard_id');
            $this->db->join('users', 'users.id = flashcards.creator_id');

        }


        /**
         * Function to get a list of flashcards to display to the searchbar
         */
        public function get_suggestions($search_arg, $user_id_arg){
            $this->db->select("flashcards.*, flashcards.name as label, flashcards_user_access.user_id, users.username as creator_username"); 
            $this->_set_up_join();

            $this->db->like('name', $search_arg);
            $this->db->limit(5);
            // $result = $this->db->get('flashcards')->result_array();
            $result = $this->db->get_where('flashcards_user_access', array('flashcards_user_access.user_id' => $user_id_arg))->result_array();
            return $result;
        }


        /**
         * Function to retrieve the flashcard ID of a given flashcard name
         */
        public function get_flashcard($flashcard_name_arg){
            $this->db->select("flashcards.*, flashcards_user_access.user_id");
            $this->_set_up_join();
            
            $query_var = $this->db->get_where('flashcards_user_access', array('flashcards.name' => $flashcard_name_arg));

            if ($query_var->num_rows() != 0)
                return $query_var->row_array()['id']; //Biglang ayaw gumana nung $query_var->row->id;
            else
                return FALSE;
        }
    }