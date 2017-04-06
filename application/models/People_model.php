<?php

/**
 * People Model
 * 
 * Handles all database interactions between the People controller and the 
 * database.
 */
class People_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get People
     * 
     * Gets a page of people to be displayed on the frontend
     * 
     * @param int $page
     * @return object
     */
    public function get_people($page) {
        
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        $result = $this->db->select('people.id AS id, first_name, last_name, mobile, email, language_id, languages.name AS language, dob, date_modified, modified_by, people.date_created AS date_created')
                           ->limit($limit, $offset)
                           ->join('languages', 'people.language_id = languages.id', 'left')
                           ->where('deleted', 0)
                           ->get('people');
        
        if($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
        
    }
    
    /**
     * Get Person
     * 
     * Gets a specific person by ID
     * @param int $id
     * @return object
     */
    public function get_person($id) {
        
        $result = $this->db->select('people.id AS id, first_name, last_name, mobile, email, language_id, languages.name AS language, dob, date_modified, modified_by, people.date_created AS date_created')
                           ->where('people.id', $id)
                           ->where('deleted', 0)
                           ->join('languages', 'people.language_id = languages.id', 'left')
                           ->limit(1)
                           ->get('people');
        
        if($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
        
    }
    
    /**
     * Upsert
     * 
     * Checks to see if the Person ID exists. If so, update, otherwise create
     * a new user.
     * @param int $id
     * @param object $data
     * @return object
     */
    public function upsert($data, $id = 0) {
        
        if($this->get_person($id)) {
            
            return $this->update_person($id, $data);
            
        } else {
            // Create a new person
            return $this->add_person($data);
        }
    }
    
    private function add_person($data) {
        
        $this->db->insert('people', $data);
        
        return $this->get_person($this->db->insert_id());
        
    }
    
    /**
     * Update Person
     * 
     * Updates a person's details by ID
     * @param int $id
     * @param object $data
     * @return object
     */
    private function update_person($id, $data) {
        
        $this->db->where('id', $id)
                 ->limit(1)
                 ->update('people', $data);
        
        return $this->get_person($id);
        
    }
    
    
    
}
