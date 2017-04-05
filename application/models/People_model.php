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
        
        $result = $this->db->select('people.id AS id, first_name, last_name, mobile, email, languages.name AS language, dob, date_modified, modified_by, people.date_created AS date_created')
                           ->limit($limit, $offset)
                           ->join('languages', 'people.language_id = languages.id')
                           ->get('people');
        
        if($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
        
    }
    
}
