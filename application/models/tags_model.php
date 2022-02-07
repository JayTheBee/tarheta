<?php 

class tags_model extends CI_Model {

	function fetchCategory($flashcard){
            $query = $this->db->query("SELECT * FROM category_list WHERE flashcard_id='$flashcard'");
            $categories = $query->result_array();
            
            $result = array();

            //Getting the user's private and public flashcards
            foreach($categories as $cat){
                $id = $cat['category_id'];
                $query = $this->db->query("SELECT * FROM categories WHERE id='$id'");
                if($query->num_rows()==1){
                    array_push($result, $query->row_array());
                };
            }

            return $result;
    }
	function fetchCategoryList(){
    	$query = $this->db->query("SELECT name, id FROM categories");
		return $query->result();
    }

    function checkCategory($category){
        $query = $this->db->query("SELECT id FROM categories WHERE id='$category'");
	    if ($query->num_rows() == 1){
	    	return $query->row();
	    	
	    }else{
	    	return FALSE;
	    }
    }
    function insertCategory($cat_id, $flashcard_id){
        $this->db->trans_start();
        $this->db->set('flashcard_id', $flashcard_id);
        $this->db->set('category_id', $cat_id);
        $this->db->insert('category_list');
        $this->db->trans_complete();
    }

    public function update_flashcard_category($flashcard_id_arg, $cat_id_arg){
        $this->db->set('category_id', $cat_id_arg);
        $this->db->where('flashcard_id', $flashcard_id_arg);

        $this->db->update('category_list');
    }
}