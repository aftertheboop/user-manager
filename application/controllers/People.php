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
        $this->load->helper('restful');
        
    }
    
    public function index($page = 1) {
        // Set the allowed request types. Since this controller offers full CRUD
        // all four req. types are permitted
        allowed_request_types(array('get','put','post','delete'));
        
        $req_type = get_request_type();
        
        switch($req_type) {
            case 'get':
                $this->get($page);
                break;
            case 'put':
                break;
            case 'post':
                break;
            case 'delete':
                break;
        }
    }
    
    private function get($page = null) {
        
        // Load models and libraries
        $this->load->model('people_model');
        
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
    
    
    
}