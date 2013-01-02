<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fire_Auth {
    
    /**
    * Codeigniter
    * 
    * @access private
    */
    protected $ci;
    
    /**
    * Config items
    * 
    * @access private
    */
    private $user_table;
    private $identifier_field;
    private $display_name_field;
    private $username_field;
    private $password_field;
    
    public function __construct()
    {
        // Set debug message.
        log_message('debug', 'Fire Auth Library loaded');
        
        // Get codeigniter super object.
        $this->ci =& get_instance();
        
        // Load config.
        $this->ci->config->load('fire_auth');
        $auth_config = $this->ci->config->item('auth');
        
        // Set config items.
        $this->user_table = $auth_config['user_table'];
        $this->identifier_field = $auth_config['identifier_field'];
        $this->display_name_field = $auth_config['display_name_field'];
        $this->username_field = $auth_config['username_field'];
        $this->password_field = $auth_config['password_field'];
        
        // Load database.
        $this->ci->load->database();
        
        // Load libraries.
        $this->ci->load->library('session');
        
        // Load Model.
        $this->ci->load->model('fire_auth_m');
    }
    
    public function login($username, $password)
    {
        // Check the user exists.
        $user = $this->ci->fire_auth_m->check_user_exists($username);   
        
        if($user == false)
        {
            // There is no user with that username.
            return false;
        }
        
        // Do password match.
        if($this->ci->phpass->check($password, $user['password']))
        {
            // The passwords matched, lets create the session data.
            $this->ci->session->set_userdata(array(
                'identifier' => $user['identifier'],
                'username' => $user['username'],
                'logged_in' => $_SERVER['REQUEST_TIME']
            ));
            
            return true;
            
        } else {
            return false;
        }
    }
    
    public function logout()
    {
        // Remove userdata.
        $this->ci->session->unset_userdata('identifier');
        $this->ci->session->unset_userdata('username');
        $this->ci->session->unset_userdata('logged_in');
        
        return true;   
    }
    
    public function register($username, $password, $display_name)
    {
        // Check the username.
        if($this->check_username($username) == true)
        {
            // Username is taken.
            return false;
        } 
        
        // Hash password.
        $password = $this->generate_hash($password);
        
        // Data to insert.
        $data = array(
            $this->display_name_field => $display_name,
            $this->username_field => $username,
            $this->password_field => $password,
        );
        
        // Enter into the database.
        $query = $this->ci->fire_auth_m->register($data);
        
        if($query == false)
        {
            return false;
        }
        
        return (int) $this->ci->db->insert_id();
    }
    
    public function check_username($username)
    {
        // Results.
        if($this->ci->fire_auth_m->check_username($username) == true)
        {
            //  Username exists.
            return true;
        } 
        
        // No users were found.
        return false;
    }
    
    public function logged_in()
    {
        // Check the status of the current user.
        return (bool) $this->ci->session->userdata('identifier');   
    }
    
    protected function generate_hash($password)
    {
        return $this->ci->phpass->hash($password);
    }
}