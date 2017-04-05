<?php
/**
 * People Controller
 *
 * Provides a CRUD interface for people in the database. This is NOT related
 * to the auth library/system users but can rather be perceived as an employee
 * management system etc.
 */
class People extends CI_Controller {
    
    public function __construct() {
        
        parent::__construct();
        
        // Load in general use libraries, models and helpers
        $this->load->model('people_model');
        $this->load->helper('restful');
        
    }
    
    public function index($page = 1) {
        // Set the allowed request types. Since this controller offers full CRUD
        // all four req. types are permitted
        allowed_request_types(array('get','put','post','delete'));
        
        $req_type = get_request_type();
        
        switch($req_type) {
            case 'get':
                $this->_get($page);
                break;
            case 'put':
                $this->_put();
                break;
            case 'post':
                break;
            case 'delete':
                $this->_put();
                break;
        }
    }
    
    private function _get($page = null) {
        
        $vars = get_vars();
        // If the incoming request has an ID
        if(isset($vars->id)) {
            // Get a single person based on their ID
        } else {
            // Get a page of people
            $people = $this->people_model->get_people($page);
            
            $this->load->view('common/template', array('_views' => 'people/index.php',
                                                       'people' => $people));
            
        }
    }
    
    private function _put() {
        // Load a mobile helper to assist with converting the mobile number
        $this->load->helper('mobile');
                
        $vars = get_vars();
        
        if(isset($vars->id)) {
            // Set the variables detailing the modification
            $vars->modified_by = USER_ID;
            $vars->date_modified = date('Y-m-d H:i:s');
            
            // Process the mobile number to be DB friendly
            if(isset($vars->mobile)) {
                $vars->mobile = human_to_db($vars->mobile);
            }
            
            // Update user
            $person = $this->people_model->upsert($vars->id, $vars);
            
            return_json(array('message' => 'Person has been updated', 'data' => $person), 200);
            
        } else {
            // Fail. No ID set to update
        }
        
    }
    
    
    
}