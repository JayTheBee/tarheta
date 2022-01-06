<?php 

    class scoring_model extends CI_Model{

        // Kaya may $save kasi nireuse ko itong function just to retrieve the scores and not update the DB
        public function get_user_score($flashcard_id,$user_id, $questions, $save = TRUE){
            $data['user_score'] = 0;
            $data['correct_num'] = 0;
            $data['wrong_num'] = 0;
            $data['unanswered_num'] = 0;

            foreach($questions as $question){
                $question_id = $question['id'];
                $query = $this->db->query("SELECT * FROM user_answers WHERE question_id='$question_id' AND user_id='$user_id'");
                if($query->num_rows() != 0){
                    if($save)
                        $this->insert_question_stat($question_id);
                    $judgement = $query->row()->{'judgement'};
                    $data['user_score'] += $query->row()->{'points'};
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

    }
?>