<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fire_auth_m extends CI_Model {

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
        log_message('debug', 'Fire Auth Model loaded');
        
        // Load config.
        $auth_config = $this->config->item('auth');
        
        // Set config items.
        $this->user_table = $auth_config['user_table'];
        $this->identifier_field = $auth_config['identifier_field'];
        $this->display_name_field = $auth_config['display_name_field'];
        $this->username_field = $auth_config['username_field'];
        $this->password_field = $auth_config['password_field'];
    }
    
    public function check_username($username)   
    {
        $query = $this->db->where($this->username_field, $username)->get($this->user_table);
        
        if($query->num_rows() > 0)
        {
            // Username exists.
            return true;
        } else {
            return false;
        }
    }
    
    public function check_user_exists($username)
    {
        // Select.
        $this->db->select($this->identifier_field.' as identifier, '.$this->username_field.' as username, '.$this->password_field.' as password')
            ->where($this->username_field, $username);
            
        // Run the query.
        $query = $this->db->get($this->user_table);
        
        if($query->num_rows() > 0)
        {   
            $data = array(
                'identifier' => $query->row('identifier'),
                'username' => $query->row('username'),
                'password' => $query->row('password'),
            );
            
            return $data;
        } else {
            return false;
        }
    }
    
    public function register($data)
    {
        // Perfrom the query.
        $query = $this->db->insert($this->user_table, $data);
        
        if($this->db->affected_rows() > 0)
        {
            return true;
        } else {
            return false;
        }
    }
}
