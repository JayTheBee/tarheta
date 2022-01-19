<?php 

    class notification_model extends CI_Model{

        function notify($context, $ref_id, $user_id){
            $this->db->trans_start();
            $this->db->set('context', $context);
             $this->db->set('user_id', $user_id);
            $this->db->set('reference_id', $ref_id);
            $this->db->insert('notification');
            $this->db->trans_complete();
        } 

        function reference($text, $class_id, $flashcard_id){
            $this->db->trans_start();
            $this->db->set('text', $text);
            $this->db->set('class_id', $class_id);
            $this->db->set('flashcard_id', $flashcard_id);
            $this->db->insert('notification_reference');
            $notify_id = $this->db->insert_id();
            $this->db->trans_complete();   
            return $notify_id; 
        }
        function getNotifs($user_id){
            $query = $this->db->query("SELECT * FROM notification WHERE user_id='$user_id'");
            return $query->result_array();
        }

        function getRef($notif_id){
            $query = $this->db->query("SELECT * FROM notification WHERE id='$notif_id'");
            $notif = $query->result_array();
            if($query->num_rows()==1){
                $id = $notif['reference_id'];
                $query2 = $this->db->query("SELECT * FROM notification_reference WHERE id='$id'");
                return $query2->row();
            }
            else{
                return FALSE;
            }
        }
    }

?>
