<?php 

    class flashcard_model extends CI_Model{
        /**
         * Function to insert a new flashcard into the DB.
         */
        public function insert_flashcard($data_arg){
            $this->db->trans_start();
            $this->db->insert('flashcards', $data_arg);
            $flashcard_id_var = $this->db->insert_id();

            $this->insert_flashcard_user_access($flashcard_id_var, $data_arg['creator_id']);
            $this->db->trans_complete();
            return $flashcard_id_var;
        }

        /**
         * Update a specific flashcard in the DB
         */
        public function update_flashcard($data_arg){
            $this->db->trans_start();
            $this->db->from('flashcards');

            $this->db->set('name', $data_arg['flashcard']['name']);
            $this->db->set('description', $data_arg['flashcard']['description']);
            $this->db->set('type', $data_arg['flashcard']['type']);
            $this->db->set('visibility', $data_arg['flashcard']['visibility']);
            $this->db->set('qtype', $data_arg['flashcard']['qtype']);
            $this->db->set('timeopen', $data_arg['flashcard']['timeopen']);
            $this->db->set('timeclose', $data_arg['flashcard']['timeclose']);

            $this->db->where('id', $data_arg['flashcard_id']);
            $this->db->update('flashcards');

            $this->db->trans_complete();
        }


        /**
         * Get all the flashcard that the user has access to
         */
        public function get_flashcards(){
            $user_id_var = $_SESSION['sess_profile']['user_id'];
            $query_var = $this->db->query("SELECT * FROM flashcards_user_access WHERE user_id='$user_id_var'");
            $flashcards_var = $query_var->result_array();
            
            $result_var = array();

            //Getting the user's private and public flashcards
            foreach($flashcards_var as $flashcard){
                $id_var = $flashcard['flashcard_id'];
                $query_var = $this->db->query("SELECT * FROM flashcards WHERE id='$id_var' AND creator_id='$user_id_var'");
                if($query_var->num_rows()==1){
                    array_push($result_var, $query_var->row_array());
                };
            }

            //Getting flashcards that is shared to the user
            foreach($flashcards_var as $flashcard){
                $id_var = $flashcard['flashcard_id'];
                $query_var = $this->db->query("SELECT * FROM flashcards WHERE id='$id_var' AND visibility='PRIVATE' AND creator_id <> '$user_id_var' ");
                if($query_var->num_rows()==1){
                    array_push($result_var, $query_var->row_array());
                };
            } 

            //Getting the other public flashcards that is not created by the user
            $query_var = $this->db->query("SELECT * FROM flashcards WHERE visibility='PUBLIC' AND creator_id <> '$user_id_var'");
            $result_var = array_merge($result_var, $query_var->result_array());
            
            
            return $result_var;
        }


        /**
         * Get all the flashcardsd that the user has created
         */
        public function get_created_flashcards(){
            $user_id_var = $_SESSION['sess_profile']['user_id'];
            $query_var = $this->db->query("SELECT * FROM flashcards_user_access WHERE user_id='$user_id_var'");
            $flashcards_var = $query_var->result_array();
            
            $result_var = array();

            //Getting the user's private and public flashcards
            foreach($flashcards_var as $flashcard){
                $id_var = $flashcard['flashcard_id'];
                $query_var = $this->db->query("SELECT * FROM flashcards WHERE id='$id_var' AND creator_id='$user_id_var'");
                if($query_var->num_rows()==1){
                    array_push($result_var, $query_var->row_array());
                };
            }

           return $result_var;
        }


        /**
         * 
         */
        public function get_flashcard_data($flashcard_id_arg){
            $this->db->select("flashcards.*, flashcards_user_access.user_id"); 
            $this->db->join('flashcards_user_access', 'flashcards_user_access.flashcard_id = flashcards.id');
            // if ($has_sets_arg){
            //     $this->db->join('flashcard_set_list', 'flashcard_set_list.flashcard_id = flashcards.id');
            //     $this->db->join('flashcard_sets', 'flashcard_sets.id = flashcard_set_list.set_id');
            // }

            $query = $this->db->get_where('flashcards', array('flashcards.id' => $flashcard_id_arg));

            return $query->row_array();
            // $query = $this->db->query("SELECT * FROM flashcards WHERE id='$flashcard_id'");
            // return $query->row_array();
        }


        /**
         * Function where it returns an array containing all the question of a specific flashcard
         */
        public function get_questions($flashcard_id_arg){
            $query_var = $this->db->query("SELECT * FROM flashcards_questions WHERE flashcard_id='$flashcard_id_arg'");
            return $query_var->result_array();
        }


        /**
         * Function that inserts a question input to the DB.
         */
        public function insert_question($data_arg){
            $this->db->trans_start();
            $this->db->insert('flashcards_questions', $data_arg);
            $question_id_var = $this->db->insert_id();
            $this->db->trans_complete();

            return $question_id_var;
        }


        /**
         * Function that returns an array that contains
         * the choices of a multiple choice question.
         */
        public function get_choices($data_arg){
            $choices_var = array();
            foreach($data_arg as &$question){
                if ($question['choice_id'] != -1){
                    $question_choices_var = $this->retrieve_choice($question['choice_id']);
                    array_push($choices_var, $question_choices_var);
                }
            };

            return $choices_var;
        }


        /**
         * Function that is called in the get_choices function.
         * This gets the row that contains all the choices of a question.
         */
        private function retrieve_choice($choice_id_arg){
            $query_var = $this->db->query("SELECT * FROM flashcard_multiple_choice WHERE id='$choice_id_arg'");
            return $query_var->row_array();
        }


        /**
         * This function inserts all the possible choices of a question
         * into the DB.
         */
        public function insert_choices($data_arg){
            $this->db->trans_start();
            $this->db->insert('flashcard_multiple_choice', $data_arg);
            $choice_id_var = $this->db->insert_id();
            $this->db->trans_complete();

            return $choice_id_var;
        }


        /**
         * Updates the choice id of a specific question.
         */
        public function set_question_choice_id($choice_id_arg, $question_id_arg){
            $this->db->query("UPDATE flashcards_questions SET choice_id = '$choice_id_arg' WHERE id='$question_id_arg'");
        }


        /**
         * Function that updates a user to have access to a private flashcard.
         */
        public function flashcard_share($flashcard_id_arg, $email_arg){

            //Check if the user exists in the DB
            $query_var = $this->db->query("SELECT * FROM users WHERE email='$email_arg'");

            if($query_var->num_rows()==1)
                $user_id_var = $query_var->row()->{'id'};
            else
                return FALSE; //user not found

            //Check if the user already has access to the flashcard
            $query_var = $this->db->query("SELECT * FROM flashcards_user_access WHERE flashcard_id='$flashcard_id_arg' AND user_id='$user_id_var'");
            if($query_var->num_rows()==0)
                $this->insert_flashcard_user_access($flashcard_id_arg, $user_id_var); //Insert new user access

            return $user_id_var;
        }


        /**
         * This function inserts a new row indicating that
         * the specified user will now have access to a private
         * flashcard.
         */
        private function insert_flashcard_user_access($flashcard_id_arg, $user_id_arg){
            $this->db->trans_start();
            $this->db->set('flashcard_id', $flashcard_id_arg);
            $this->db->set('user_id', $user_id_arg);
            $this->db->insert('flashcards_user_access');
            $this->db->trans_complete();
        }


        /**
         * 
         */
        public function insert_flashcard_class_access($flashcard_id_arg, $class_id_arg){
            $this->db->trans_start();
            $this->db->set('flashcard_id', $flashcard_id_arg);
            $this->db->set('class_id', $class_id_arg);
            $this->db->insert('flashcard_class_access');
            $this->db->trans_complete();

            $classMem_var = $this->classes_model->getMembers($class_id_arg);
            foreach($classMem_var as $members){
                $this->insert_flashcard_user_access($flashcard_id_arg, $members['user_id']);
            }
        }


        /**
         * 
         */
        public function get_class_flashcard($class_id_arg){
            $query_var = $this->db->query("SELECT * FROM flashcard_class_access WHERE class_id='$class_id_arg'");
            $flashcards_var = $query_var->result_array();

            $result_var = array();

            //Getting the user's private and public flashcards
           foreach($flashcards_var as $flashcard){
                $id = $flashcard['flashcard_id'];
                $query_var = $this->db->query("SELECT * FROM flashcards WHERE id='$id'");
                if($query_var->num_rows()==1){
                    array_push($result_var, $query_var->row_array());
                };
            }

            return $result_var;            
        }


        /**
         * Function to delete a question in the DB.
         */
        public function delete_question($question_id_arg){
            $this->db->query("DELETE FROM flashcards_questions WHERE id = $question_id_arg");
        }


        /**
         * Function to check if the answer provided is correct.
         */
        public function check_answer($question_id_arg, $answer_arg){
            if(isset($answer_arg) && strlen($answer_arg) != 0){
                $query_var = $this->db->query("SELECT * FROM flashcards_questions WHERE id='$question_id_arg' AND answer='$answer_arg'");
                if($query_var->num_rows()!=0)
                    return "CORRECT";
                else
                    return "WRONG";
            }
            else
                return "UNANSWERED";
        }

        
        /**
         * Check the number of attempts of a user on a question
         * This works however i still creates a new input
         */
        public function check_attempts($question_id_arg, $user_id_arg){
            $query_var = $this->db->query("SELECT * FROM user_answers WHERE question_id='$question_id_arg' AND user_id='$user_id_arg'");
            if($query_var->num_rows()==0)
                return 0;
            else
                return ($query_var->row()->{'attempt'});
        }


        /**
         * The function that is called by the Controller to initiate saving the user's answers
         */
        public function save_answer($data_arg){
            if($this->check_already_answered($data_arg['question_id'], $data_arg['user_id']))
                return $this->update_user_answer($data_arg);
            else
                return $this->insert_user_answer($data_arg);
        }

        public function verify_flashcard_data($flashcard_id_arg){                                                                       
            $query = $this->db->query("SELECT * FROM flashcard_class_access WHERE flashcard_id='$flashcard_id_arg'");                                         
            if($query->num_rows()==1){                                                                                               
                return FALSE;                                                                                             
            }                                                                                                                        
            else{                                                                                                                    
                return TRUE;                                                       
            }                                                                                                                       
         }  
         
        /**
         * Function to check how much total points would be given.
         */
        private function assign_points($judgement_arg, $total_points_arg){
            if($judgement_arg == 'CORRECT')
                return $total_points_arg;
            else
                return 0;
        }


        /**
         * Function to check if the user already
         * answer a specified flashcard.
         */
        public function check_already_answered($question_id_arg, $user_id_arg){
            $query_var = $this->db->query("SELECT * FROM user_answers WHERE question_id='$question_id_arg' AND user_id='$user_id_arg'");
            if ($query_var->num_rows() != 0)
                return TRUE;
            else
                return FALSE;
        }


        /**
         * Function to update the user's answer in the DB.
         */
        private function update_user_answer($data_arg){
            $this->db->trans_start();

            $this->db->from('user_answers');

            $this->db->set('user_id', $data_arg['user_id']);
            $this->db->set('question_id', $data_arg['question_id']);
            $this->db->set('answer', $data_arg['answer']);
            $this->db->set('judgement', $data_arg['judgement']);
            $this->db->set('points', $data_arg['points']);
            $this->db->set('timestamp', $data_arg['timestamp']);
            $this->db->set('attempt', $data_arg['attempt']);
            
            $condition_var = array('question_id' => $data_arg['question_id'], 'user_id' => $data_arg['user_id']);
            $this->db->where($condition_var);

            $this->db->update('user_answers');
            
            $this->db->trans_complete();

            return $data_arg;
        }


        /**
         * This function inserts a new row containing
         * ther user's answers.
         */
        private function insert_user_answer($data_arg){
            $this->db->trans_start();
            $this->db->insert('user_answers', $data_arg);
            // $user_answer_id = $this->db->insert_id();
            $this->db->trans_complete();

            return $data_arg;
        }


        /**
         * This return a associative array that contains:
         * 'flashcard' => the details of the flashcard (id, name, description. etc)
         * 'questions' => All the questions assigned to the flashcard_id. 
         * 'multi_choices' => contains all the multiple choices of a specific question.
         */
        public function get_data($flashcard_id_arg){
            $data_var['flashcard'] = $this->get_flashcard_data($flashcard_id_arg);
            $data_var['questions'] = $this->get_questions($flashcard_id_arg);
            $data_var['multi_choices'] = $this->get_choices($data_var['questions']);

            return $data_var;
        }


        /**
         * Function to get an array containing all of the
         * user's answers in a specific flashcard.
         */
        public function get_user_answers($flashcard_id_arg, $user_id_arg, $questions_arg){
            $data_var = array();
            foreach($questions_arg as $question){
                $question_id_var = $question['id'];
                $query_var = $this->db->query("SELECT * FROM user_answers WHERE question_id='$question_id_var' AND user_id='$user_id_arg'");
                if($query_var->num_rows() != 0){
                    array_push($data_var, $query_var->row_array());
                }
            }

            return $data_var;
        }


        /**
         * 
         */
        public function get_categories(){
            $query_var = $this->db->get('categories');
            return $query_var->result_array();
        }


        /**
         * 
         */
        public function get_category_list($flashcards_arg){
            $this->db->join('category_list', 'category_list.category_id = categories.id');
            $query_var = $this->db->get('categories');
            return $query_var->result_array();
        }
        

        /**
         * Function to that updates the datetime of the 
         * timeopen and timeclose of a specific flashcard.
         */
        public function time_update($data_arg, $flashcard_id_arg){
            $this->db->trans_start();

            $this->db->from('flashcards');
            $this->db->set('timeopen', $data_arg['timeopen']);
            $this->db->set('timeclose', $data_arg['timeclose']);
            $this->db->where('id', $flashcard_id_arg);

            $this->db->update('flashcards',$data_arg);
            
            $this->db->trans_complete();
        }
        

        /**
         * Function to insert a new flashcard set into the DB.
         */
        public function set_flashcards($data_arg)
        {
            $this->db->trans_start();
            $this->db->set('name', $data_arg['name']);
            $this->db->set('user_id', $data_arg['user_id']);
            $this->db->set('description', $data_arg['description']);
            $this->db->set('color', $data_arg['color']);
            $this->db->insert('flashcard_sets', $data_arg);
            $this->db->trans_complete();

        }
        
        //Function where it returns an array containing all the sets of flashcard
        public function get_sets($user_id){
            $query = $this->db->query("SELECT * FROM flashcard_sets WHERE user_id='$user_id'");
            if ($query->num_rows() != 0)
                return $query->result_array();
            else
                return FALSE;
        }


        public function update_total_points($flashcard_id_arg, $question_points_arg){
            $this->db->trans_start();
            $query_var = $this->db->get_where('flashcards', array('flashcards.id' => $flashcard_id_arg));
            $this->db->trans_complete();
            
            $total_points_var = (int)$question_points_arg + (int)$query_var->row('total_score');
            
            $this->db->trans_start();
            $this->db->from('flashcards');
            $this->db->set('total_score', $total_points_var);
            $this->db->where('id', $flashcard_id_arg);
            $this->db->update('flashcards',$data_arg);
            $this->db->trans_complete();

        }

        // function insert_flashcard_sets($set_id, $flashcard_id){
        //     $this->db->trans_start();
        //     $this->db->set('flashcard_id', $flashcard_id);
        //     $this->db->set('set_id', $set_id);
        //     $this->db->insert('flashcard_set_list');
        //     $this->db->trans_complete();
        // }
    }
