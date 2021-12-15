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

        public function get_questions($flashcard_id){
            $query = $this->db->query("SELECT * FROM flashcards_questions WHERE flashcard_id='$flashcard_id'");
            return $query->result_array();
        }

        public function insert_question($data){
            $this->db->trans_start();
            $this->db->insert('flashcards_questions', $data);
            $question_id = $this->db->insert_id();
            $this->db->trans_complete();

            return $question_id;
        }

        public function get_choices($data){
            // print_r($data);
            $choices = array();
            foreach($data as &$question){
                if ($question['choice_id'] != -1){
                    $question_choices = $this->retrieve_choice($question['choice_id']);
                    array_push($choices, $question_choices);
                }
            };
            return $choices;
        }

        private function retrieve_choice($choice_id){
            $query = $this->db->query("SELECT * FROM flashcard_multiple_choice WHERE id='$choice_id'");
            return $query->row_array();
        }

        public function insert_choices($data){
            $this->db->trans_start();
            $this->db->insert('flashcard_multiple_choice', $data);
            $choice_id = $this->db->insert_id();
            $this->db->trans_complete();

            return $choice_id;
        }

        public function set_question_choice_id($choice_id, $question_id){
            $this->db->query("UPDATE flashcards_questions SET choice_id = '$choice_id' WHERE id='$question_id'");
        }
    }
?>