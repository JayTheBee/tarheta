<?php 

    class scoring_model extends CI_Model{

        // Kaya may $save kasi nireuse ko itong function just to retrieve the scores and not update the DB
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


        private function update_question_stat($question_id, $judgement){
            $query = $this->db->query("SELECT * FROM question_statistic WHERE question_id='$question_id'");
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

            $this->db->trans_start();
            $this->db->from('question_statistic');
            $this->db->where('question_id', $question_id);
            $this->db->update('question_statistic', $data);
            $this->db->trans_complete();
        }


        private function insert_question_stat($question_id){
            $query = $this->db->query("SELECT * FROM question_statistic WHERE question_id='$question_id'");
            if ($query->num_rows() == 0){
                $this->db->trans_start();
                $this->db->set('question_id', $question_id);
                $this->db->insert('question_statistic');
                $this->db->trans_complete();
            }
        }


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
        }

        private function save_user_score($data){
            $this->db->trans_start();
            $this->db->insert('user_scores', $data);
            $this->db->trans_complete();
        }


        private function update_latest_user_score($flashcard_id, $user_id){
            $this->db->trans_start();

            $this->db->from('user_scores');
            $this->db->set('latest', 'NO');
            $condition = array('flashcard_id' => $flashcard_id, 'user_id' => $user_id, 'latest' => 'YES');
            $this->db->where($condition);
            $this->db->update('user_scores');
            
            $this->db->trans_complete();
        }

    }
?>