<?php

class Languages_model extends CI_Model {
    
    public function __construct() {
        
        parent::__construct();
        
    }
    
    public function get_languages() {
        
        $result = $this->db->where('visible', 1)
                           ->get('languages');
        
        return $result->result();
        
    }
    
}