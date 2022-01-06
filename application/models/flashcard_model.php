<?php 

    class flashcard_model extends CI_Model{
        public function insert_flashcard($data){
            $this->db->trans_start();
            $this->db->insert('flashcards', $data);
            $flashcard_id = $this->db->insert_id();

            // $this->db->set('user_id', $data['creator_id']);
            // $this->db->set('flashcard_id', $flashcard_id);
            // $this->db->insert('flashcards_user_access');
            $this->insert_flashcard_user_access($flashcard_id, $data['creator_id']);
            $this->db->trans_complete();
            return $flashcard_id;
        }


        public function get_flashcards(){
            $user_id = $_SESSION['Profile']['user_id'];
            $query = $this->db->query("SELECT * FROM flashcards_user_access WHERE user_id='$user_id'");
            $flashcards = $query->result_array();
            
            $result = array();

            //Getting the user's private and public flashcards
            foreach($flashcards as $flashcard){
                $id = $flashcard['flashcard_id'];
                $query = $this->db->query("SELECT * FROM flashcards WHERE id='$id' AND creator_id='$user_id'");
                if($query->num_rows()==1){
                    array_push($result, $query->row_array());
                };
            }

            //Getting flashcards that is shared to the user
            foreach($flashcards as $flashcard){
                $id = $flashcard['flashcard_id'];
                $query = $this->db->query("SELECT * FROM flashcards WHERE id='$id' AND visibility='PRIVATE' AND creator_id <> '$user_id' ");
                if($query->num_rows()==1){
                    array_push($result, $query->row_array());
                };
            }

            //Getting the other public flashcards that is not created by the user
            $query = $this->db->query("SELECT * FROM flashcards WHERE visibility='PUBLIC' AND creator_id <> '$user_id'");
            $result = array_merge($result, $query->result_array());

            return $result;
        }


        public function get_flashcard_data($flashcard_id){
            $query = $this->db->query("SELECT * FROM flashcards WHERE id='$flashcard_id'");
            return $query->row_array();
        }


        //Function where it returns an array containing all the question of a specific flashcard
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


        //Function that returns the choices of a multiple choice question
        public function get_choices($data){
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


        public function flashcard_share($flashcard_id, $email){

            //Check if the user exists in the DB
            $query = $this->db->query("SELECT * FROM users WHERE email='$email'");
            if($query->num_rows()==1){
                $user_id = $query->row()->{'id'};
            }
            else{
                return FALSE; //user not found
            }

            //Check if the user already has access to the flashcard
            $query = $this->db->query("SELECT * FROM flashcards_user_access WHERE flashcard_id='$flashcard_id' AND user_id='$user_id'");
            if($query->num_rows()==0){
                $this->insert_flashcard_user_access($flashcard_id, $user_id); //Insert new user access
            }
            return TRUE;
        }


        private function insert_flashcard_user_access($flashcard_id, $user_id){
            $this->db->trans_start();
            $this->db->set('flashcard_id', $flashcard_id);
            $this->db->set('user_id', $user_id);
            $this->db->insert('flashcards_user_access');
            $this->db->trans_complete();
        }


        public function delete_question($question_id){
            $this->db->query("DELETE FROM flashcards_questions WHERE id = $question_id");
        }


        //Function to check if the answer provided is correct
        public function check_answer($question_id, $answer){
            if(isset($answer) && strlen($answer) != 0){
                $query = $this->db->query("SELECT * FROM flashcards_questions WHERE id='$question_id' AND answer='$answer'");
                if($query->num_rows()!=0)
                    return "CORRECT";
                else
                    return "WRONG";
            }
            else
                return "UNANSWERED";
        }

        
        // Check the number of attempts of a user on a question
        // This works however i still creates a new input
        public function check_attempts($question_id, $user_id){
            $query = $this->db->query("SELECT * FROM user_answers WHERE question_id='$question_id' AND user_id='$user_id'");
            if($query->num_rows()==0)
                return 0;
            else
                return ($query->row()->{'attempt'});
        }


        // The function that is called by the Controller to initiate saving the user's answers
        public function save_answer($data){
            if($this->check_already_answered($data['question_id'], $data['user_id']))
                return $this->update_user_answer($data);
            else
                return $this->insert_user_answer($data);
        }


        private function assign_points($judgement, $total_points){
            if($judgement == 'CORRECT')
                return $total_points;
            else
                return 0;
        }


        public function check_already_answered($question_id, $user_id){
            $query = $this->db->query("SELECT * FROM user_answers WHERE question_id='$question_id' AND user_id='$user_id'");
            if ($query->num_rows() != 0)
                return TRUE;
            else
                return FALSE;
        }


        private function update_user_answer($data){
            $this->db->trans_start();

            $this->db->from('user_answers');

            $this->db->set('user_id', $data['user_id']);
            $this->db->set('question_id', $data['question_id']);
            $this->db->set('answer', $data['answer']);
            $this->db->set('judgement', $data['judgement']);
            $this->db->set('points', $data['points']);
            $this->db->set('timestamp', $data['timestamp']);
            $this->db->set('attempt', $data['attempt']);
            
            $condition = array('question_id' => $data['question_id'], 'user_id' => $data['user_id']);
            $this->db->where($condition);

            $this->db->update('user_answers');
            
            $this->db->trans_complete();

            return $data;
        }


        private function insert_user_answer($data){
            $this->db->trans_start();
            $this->db->insert('user_answers', $data);
            // $user_answer_id = $this->db->insert_id();
            $this->db->trans_complete();
            return $data;
        }
    }
?>