<?php 

    class scoring_model extends CI_Model{

        /**
         * Function to return the user's score statistic on a flashcard.
         * 
         * Kaya may $save kasi nireuse ko itong function just to retrieve the scores and not update the DB
         */
        public function get_user_score($flashcard_id,$user_id, $questions, $save = TRUE){
            $data['user_score'] = 0;
            $data['correct_num'] = 0;
            $data['wrong_num'] = 0;
            $data['unanswered_num'] = 0;
            $data['attempt'] = 0;

            foreach($questions as $question){
                $question_id = $question['id'];
                $query = $this->db->query("SELECT * FROM user_answers WHERE question_id='$question_id' AND user_id='$user_id'");
                if($query->num_rows() != 0){
                    if($save)
                        $this->insert_question_stat($question_id);
                    $judgement = $query->row()->{'judgement'};
                    $data['user_score'] += $query->row()->{'points'};

                    $query_attempt = $query->row()->{'attempt'};
                    $data['attempt'] = ((int)$query_attempt > (int)$data['attempt']) ? $query_attempt : $data['attempt'];
                    $data['timestamp'] = $query->row()->{'timestamp'};

                    $data = $this->check_judgement($judgement, $data, $question_id, $save);
                }
            }
            
            if($save){
                $this->insert_flashcard_stat($flashcard_id, $user_id);
                $this->update_flashcard_stat($flashcard_id, $user_id, $data);
            }

            return $data;
        }


        /**
         * Returns updated number of a question's specific judgement statistic.
         * 
         * Used in get_user_score().
         */
        private function check_judgement($judgement, $data, $question_id, $save = TRUE){
            switch($judgement){
                case 'CORRECT':
                    $data['correct_num'] += 1;
                    break;
                case 'WRONG':
                    $data['wrong_num'] += 1;
                    break;
                case 'UNANSWERED':
                    $data['unanswered_num'] += 1;
                    break;
            }
            if($save)
                $this->update_question_stat($question_id, $judgement);
            return $data;
        }


        /**
         * Function to update the question's stat in the DB.
         * 
         * Used in check_judgement().
         */
        private function update_question_stat($question_id, $judgement){
            $query = $this->db->query("SELECT * FROM question_statistic WHERE question_id='$question_id'");
            
            if ($query->num_rows() != 0){
                switch($judgement){
                    case 'CORRECT':
                        $data['correct'] = 1 + (int)$query->row()->{'correct'};
                        break;
                    case 'WRONG':
                        $data['wrong'] = 1 + (int)$query->row()->{'wrong'};
                        break;
                    case 'UNANSWERED':
                        $data['unanswered'] = 1 + (int)$query->row()->{'unanswered'};
                        break;
                }
            }

            $this->db->trans_start();
            $this->db->from('question_statistic');
            $this->db->where('question_id', $question_id);
            $this->db->update('question_statistic', $data);
            $this->db->trans_complete();
        }


        /**
         * Function to insert a new row to the question_statistic table.
         * 
         * WOULD PROBABLY REWORK THIS
         * Used in get_user_score().
         */
        private function insert_question_stat($question_id){
            $query = $this->db->query("SELECT * FROM question_statistic WHERE question_id='$question_id'");
            if ($query->num_rows() == 0){
                $this->db->trans_start();
                $this->db->set('question_id', $question_id);
                $this->db->insert('question_statistic');
                $this->db->trans_complete();
            }
        }


        /**
         * Function to insert a new row to the flashcard_statistic table.
         * 
         * WOULD PROBABLY REWORK THIS(1).
         * Used in get_user_score().
         */
        private function insert_flashcard_stat($flashcard_id, $user_id){
            $query = $this->db->query("SELECT * FROM flashcard_statistic WHERE flashcard_id='$flashcard_id' AND user_id='$user_id'");
            if ($query->num_rows() == 0){
                $this->db->trans_start();
                $this->db->set('flashcard_id', $flashcard_id);
                $this->db->set('user_id', $user_id);
                $this->db->insert('flashcard_statistic');
                $this->db->trans_complete();
            }
        }

        
        /**
         * Function to update a row in the flashcard_statistic table.
         * 
         * Used in get_user_score().
         */
        private function update_flashcard_stat($flashcard_id, $user_id, $data){
            $this->db->trans_start();

            $this->db->from('flashcard_statistic');

            $this->db->set('correct', $data['correct_num']);
            $this->db->set('wrong', $data['wrong_num']);
            $this->db->set('unanswered', $data['unanswered_num']);
            //https://stackoverflow.com/questions/10538376/multiple-where-condition-codeigniter
            $condition = array('flashcard_id' => $flashcard_id, 'user_id' => $user_id);
            $this->db->where($condition);

            $this->db->update('flashcard_statistic');
            
            $this->db->trans_complete();
        }


        /**
         * This function creates a new row in the user_scores DB table.
         * Saving the score of the user's latest attempt at answering a flashcard.
         */
        public function update_user_score($flashcard_id, $user_id, $data){
            $query = $this->db->query("SELECT * FROM user_scores WHERE flashcard_id='$flashcard_id' AND user_id='$user_id'");
            
            if($query->num_rows() != 0){
                $this->update_latest_user_score($flashcard_id, $user_id);
            }

            $data2 = array(
                'user_id' => $user_id,
                'flashcard_id' => $flashcard_id,
                'score' => $data['user_score'],
                'timestamp' => $data['timestamp'],
                'attempt' => $data['attempt'],
                'latest' => 'YES',
            );
            $this->save_user_score($data2);

            // Once the user_score table is updated call and update the flashcard_ranks
            $this->update_flashcard_ranks($flashcard_id);
        }


        /**
         * This function saves a new row in the user_scores table.
         * 
         * This row would serve as the latest attempt of the user.
         */
        private function save_user_score($data){
            $this->db->trans_start();
            $this->db->insert('user_scores', $data);
            $this->db->trans_complete();
        }


        /**
         * This function update ther user's other scores from having the 'latest' column
         * displaying 'YES' -> 'NO'.
         */
        private function update_latest_user_score($flashcard_id, $user_id){
            $this->db->trans_start();

            $this->db->from('user_scores');
            $this->db->set('latest', 'NO');
            $condition = array('flashcard_id' => $flashcard_id, 'user_id' => $user_id, 'latest' => 'YES');
            $this->db->where($condition);
            $this->db->update('user_scores');
            
            $this->db->trans_complete();
        }


        /**
         * Function to update the flashcard rankings in the user_scores DB table.
         * 
         * What I did was take all the rows of a specific flashcard wherein the 'latest' column is set to 'YES'
         * Sort descending and change the 'flashcard_rank' field based on their index.
         * Then updated the rows in the DB.
         * 
         * IDK MAN xD
         */
        private function update_flashcard_ranks($flashcard_id){
            $query = $this->db->query("SELECT * FROM user_scores WHERE flashcard_id='$flashcard_id' AND latest='YES'");
            $result = $query->result_array();

            // Comment by 'Mark Amery' (437 upvotes) - https://stackoverflow.com/questions/1597736/how-to-sort-an-array-of-associative-arrays-by-value-of-a-given-key-in-php
            usort($result, function ($item1, $item2){
                if ($item1['score'] == $item2['score']) return 0;
                return ($item1['score'] < $item2['score']) ? 1 : -1;
            });
            
            $rank = 1;
            foreach ($result as $key => $user){
                $result[$key]['flashcard_rank'] = $rank;
                $rank += 1;
            }

            $this->db->trans_start();
            $this->db->from('user_scores');
            foreach ($result as $user){
                $this->db->set('flashcard_rank', $user['flashcard_rank']);
                $this->db->where('id', $user['id']);
                $this->db->update('user_scores');
            }
            $this->db->trans_complete();
        }

        /**
         * Query the data in the user_scores and get the users that answered a specific flashcard.
         * 
         * This function also gets the username of the user and appends it to the query.
         * 
         * KEYS:
         * 'flashcard' = data about the specific flashcard via $flashcard_id.
         * 'users' = all the users that have answered the flashcard.
         */
        public function get_ranking($flashcard_id, $latest = FALSE){
            if ($latest)
                $query = $this->db->query("SELECT * FROM user_scores WHERE flashcard_id = $flashcard_id AND latest='YES'");
            else
                $query = $this->db->query("SELECT * FROM user_scores WHERE flashcard_id = $flashcard_id AND attempt=1");
            
            if ($query->num_rows() != 0){
                $results = $query->result_array();
                foreach ($results as $key => $user_score){
                    $user = $this->db->get_where('users', array('id' => $user_score['user_id']));
                    $results[$key]['username'] = $user->row('username');
                }

                // Comment by 'Mark Amery' (437 upvotes) - https://stackoverflow.com/questions/1597736/how-to-sort-an-array-of-associative-arrays-by-value-of-a-given-key-in-php
                // Sorting the flashcard rank ascending.
                usort($results, function ($item1, $item2){
                    if ($item1['flashcard_rank'] == $item2['flashcard_rank']) return 0;
                    return ($item1['flashcard_rank'] > $item2['flashcard_rank']) ? 1 : -1;
                });

                return $results;
            }
            else{
                return array();
            }
            
        }

    }
?>