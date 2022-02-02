<?php 

    class Notification_model extends CI_Model{

        public function notify($context_arg, $ref_id_arg, $user_id_arg){
            $this->db->trans_start();
            $this->db->set('context', $context_arg);
            $this->db->set('user_id', $user_id_arg);
            $this->db->set('reference_id', $ref_id_arg);
            $this->db->insert('notification');
            $this->db->trans_complete();
        } 

        public function notify_class($context_arg, $ref_id_arg, $class_id_arg){
            $query_var = $this->db->query("SELECT * FROM enroll WHERE class_id='$class_id_arg'");
            $user_var = $query_var->result_array();
            foreach($user_var as $user){
                $id_var = $user['user_id'];
                $this->notify($context_arg, $ref_id_arg, $id_var);
            }
        }

        public function notify_flashcard_access($context_arg, $ref_id_arg, $flashcard_id_arg){
            $query_var = $this->db->query("SELECT * FROM flashcards_user_access WHERE flashcard_id='$flashcard_id_arg'");
            $user_var = $query_var->result_array();
            foreach($user_var as $user){
                $id_var = $user['user_id'];
                $this->notify($context_arg, $ref_id_arg, $id_var);
            }
        }
        
        public function reference($text_arg, $class_id_arg, $flashcard_id_arg, $response_arg){
            $this->db->trans_start();
            $this->db->set('text', $text_arg);
            $this->db->set('class_id', $class_id_arg);
            $this->db->set('flashcard_id', $flashcard_id_arg);
            $this->db->set('response', $response_arg);
            $this->db->insert('notification_reference');
            $notify_id = $this->db->insert_id();
            $this->db->trans_complete();   
            return $notify_id; 
        }
        public function mark_read($notif_id_arg){
            $this->db->trans_start();
            $this->db->from('notification');
            $this->db->set('active', 0);
            $this->db->where('id', $notif_id_arg);
            $this->db->update('notification');
            $this->db->trans_complete();
        }
        public function change_response($ref_id_arg, $response_arg){
            $this->db->trans_start();
            $this->db->from('notification_reference');
            $this->db->set('response', $response_arg);
            $this->db->where('id', $ref_id_arg);
            $this->db->update('notification_reference');
            $this->db->trans_complete();
        }
        public function get_notifications($user_id_arg){
            $queryvar = $this->db->query("SELECT * FROM notification WHERE user_id='$user_id_arg'");
            return $queryvar->result_array();
        }

        public function get_reference($notif_id_arg){
            $queryvar = $this->db->query("SELECT * FROM notification WHERE id='$notif_id_arg'");
            $notifvar = $queryvar->row();

            if(isset($notifvar)){
                $idvar = $notifvar->reference_id;
                $query2var = $this->db->query("SELECT * FROM notification_reference WHERE id='$idvar'");
                return $query2var->row();
            }
            else{
                return FALSE;
            }
        }
    }

