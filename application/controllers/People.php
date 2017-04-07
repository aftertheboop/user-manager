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
        $this->load->library('tank_auth');
        $this->load->model('people_model');
        $this->load->helper('restful');
        $this->load->helper('url');
        
        // Auth for this page. Redirect the user to the login page
        // if no session exists
        if(!$this->tank_auth->is_logged_in()) {
            redirect('auth/login');
        }
    }
    
    public function index($page = 1) {
        // Set the allowed request types. Since this controller offers full CRUD
        // all four req. types are permitted
        allowed_request_types(array('get','put','post','delete'));
        
        $req_type = get_request_type();
        // Check the type of request and act accordingly
        switch($req_type) {
            case 'get':
                $this->_get($page);
                break;
            case 'put':
                $this->_put();
                break;
            case 'post':
                $this->_post();
                break;
            case 'delete':
                $this->_put();
                break;
        }
    }
    
    /**
     * GET
     * 
     * Handles all server GET requests 
     * @param int $page
     */
    private function _get($page = null) {
        
        // Load languages model
        $this->load->model('languages_model');
        // Gets a list of all languages
        $languages = $this->languages_model->get_languages();
        // Retrieve a list of all variables sent to the controller
        $vars = get_vars();
        // If the incoming request has an ID
        if(isset($vars->id)) {
            // Get a single person based on their ID
            $person = $this->people_model->get_person($vars->id); 
            
            $this->load->view('common/template', array('_views' => 'people/index.php',
                                                       'people' => array($person),
                                                       'languages' => $languages));
            
        } else {
            // Get a page of people
            $this->load->library('pagination');
            // Configure the pagination 
            $config['base_url'] = '/people/';
            $config['total_rows'] = $this->db->where('deleted', 0)
                                             ->count_all('people');
            $config['per_page'] = 10;
            $config['use_page_numbers'] = true;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#"><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);
            
            // Get a page of people
            $people = $this->people_model->get_people($page);
            $this->load->view('common/template', array('_views' => 'people/index.php',
                                                       'people' => $people,
                                                       'languages' => $languages));
            
        }
    }
    
    /**
     * POST
     * 
     * Used for creating a new person in the database
     */
    private function _post() {
        // Load the mobile helper
        $this->load->helper('mobile');
        // Get a list of all variables POSTed to the controller
        $vars = get_vars();
        // Convert the number from 0... notation to 27... notation
        $vars->mobile = human_to_db($vars->mobile);
        // Add creation data to variables
        $vars->modified_by = $this->tank_auth->get_user_id();
        $vars->date_modified = date('Y-m-d H:i:s');
        $vars->date_created = date('Y-m-d H:i:s');
        
        $errors = $this->_validate($vars);
        
        if(empty($errors)) {
            // Upsert the person
            $person = $this->people_model->upsert($vars);
            // Return a JSON object
            return_json(array('message' => 'Person has been created', 'data' => $person), 200);        
        } else {
            return_json(array('message' => 'Person could not be created', 'errors' => $errors), 403);
        }
    }
    
    /**
     * PUT
     * 
     * Handles all PUT requests to the controller (deletion and edits)
     */
    private function _put() {
        // Load a mobile helper to assist with converting the mobile number
        $this->load->helper('mobile');
                
        $vars = get_vars();
        
        if(isset($vars->id)) {
            // Set the variables detailing the modification
            $vars->modified_by = $this->tank_auth->get_user_id();
            $vars->date_modified = date('Y-m-d H:i:s');
            
            // Convert the number from 0... notation to 27... notation
            if(isset($vars->mobile)) {
                $vars->mobile = human_to_db($vars->mobile);
            }
            
            $errors = $this->_validate();
            
            // Update user by their ID
            if(empty($errors)) {
            $person = $this->people_model->upsert($vars, $vars->id);
            // Return user data
            return_json(array('message' => 'Person has been updated', 'data' => $person), 200);
            } else {
                return_json(array('message' => 'Person could not be updated', 'errors' => $errors), 403);
            }
            
        } else {
            // Fail. No ID set to update
            return_json(array('message' => 'Person could not be updated'), 403);
        }
        
    }
    
    /**
     * Validate
     * 
     * Server-side validation
     */
    private function _validate() {
        
        $vars = get_vars();
        $errors = array();
        
        if(get_request_type() != 'delete') {
        
            // First Name
            if(!isset($vars->first_name) || strlen($vars->first_name) < 1) {
                $errors['first_name'] = 'Please enter your first name'; 
            }

            // Last Name
            if(!isset($vars->last_name) || strlen($vars->last_name) < 1) {
                $errors['last_name'] = 'Please enter your last name'; 
            }

            // Email address
            if(!isset($vars->email) || strlen($vars->email) < 1) {
                $errors['email'] = 'Please enter your email address';
            }
            if (filter_var($vars->email, FILTER_VALIDATE_EMAIL) === false) {
                $errors['email'] = 'Please enter a valid email address';
            }

            // Phone number
            $this->load->helper('mobile');
            $vars->mobile = human_to_db($vars->mobile);
            if(strlen($vars->mobile) != 11 || !is_numeric($vars->mobile)) {
                $errors['mobile'] = 'Please enter a valid mobile number';
            }

            // DOB
            if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$vars->dob)) {
                $errors['dob'] = 'Please enter your date of birth in the format required';
            }
        }
        
        return $errors;
        
    }
    
    
    
}