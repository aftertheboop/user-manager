<?php

/**
 * Languages Model
 * 
 * Handles all database interactions for Languages
 */
class Languages_model extends CI_Model {
    
    public function __construct() {
        
        parent::__construct();
        
    }
    
    /**
     * Get Languages
     * 
     * @return object
     */
    public function get_languages() {
        
        $result = $this->db->where('visible', 1)
                           ->get('languages');
        
        return $result->result();
        
    }
    
}