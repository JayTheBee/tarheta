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

?>
