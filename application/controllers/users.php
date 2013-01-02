<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    private $validation_rules = array(
        'login' => array(
            array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'required',
            ),
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required',
            ),
        ),
        'register' => array(
            array(
                'field' => 'display_name',
                'label' => 'Display Name',
                'rules' => 'required',
            ),
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|matches[confirm_username]',
            ),
            array(
                'field' => 'confirm_username',
                'label' => 'Confirm Username',
                'rules' => 'required',
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|matches[confirm_password]',
            ),
            array(
                'field' => 'confirm_password',
                'label' => 'Confirm Password',
                'rules' => 'required',
            ),
        ),
    ); 
    
    private $form_fields = array(
        'login' => array(
            array(
                'id' => 'username',
                'name' => 'username',
            ),
            array(
                'id' => 'password',
                'name' => 'password',
            ),
        ),
        'register' => array(
            array(
                'id' => 'display_name',
                'name' => 'display_name',
            ),
            array(
                'id' => 'username',
                'name' => 'username',
            ),
            array(
                'id' => 'confirm_username',
                'name' => 'confirm_username',
            ),
            array(
                'id' => 'password',
                'name' => 'password',
            ),
            array(
                'id' => 'confirm_password',
                'name' => 'confirm_password',
            ),
        ),
    ); 
      
    public function index()
    {   
        if($this->fire_auth->logged_in())
        {
            echo 'You are logged in as '.$this->session->userdata('username').' - '.anchor('users/logout', 'Logout').'';
        } else {
            echo 'You are not logged in, '.anchor('users/register', 'Register').' or '.anchor('users/login', 'Login').'';
        }
        
        $this->output->enable_profiler(TRUE);
    }
 
    public function login()
    {
        // Set the validation rules.
        $this->form_validation->set_rules($this->validation_rules['login']);
        
        if($this->form_validation->run() == FALSE)
        {
            $data = array(
                // Form Data.
                'form_open' => form_open(''.site_url().'/users/login'),
                'form_close' => form_close(),
                // Fieldset Data.
                'login_fieldset' => form_fieldset('Login'),
                'close_fieldset' => form_fieldset_close(),
                // Fields.
                'username_field' => form_input($this->form_fields['login']['0']),
                'password_field' => form_input($this->form_fields['login']['1']),
                // Links.
                'forgot_password_link' => anchor('users/forgot_password', 'Forgot Password'),
                // Buttons.
                'submit_button' => form_submit(array('name' => 'submit'), 'Login'),
            );
            
            $this->load->view('login', $data);
        } else {
            $perform_login = $this->fire_auth->login($this->input->post('username'), $this->input->post('password'));
            
            if($perform_login == true)
            {
                // Login successful.
                redirect('users');
            } else {
                redirect('users/login');
            }
        }  
    }  
    
    public function logout()
    {
        // Perform the logout.
        if($this->fire_auth->logout() == true)
        {
            // The user has been logged out.
            redirect('users');
        }
    } 
    
    public function register()
    {
        // Set the validation rules.
        $this->form_validation->set_rules($this->validation_rules['register']);
        
        if($this->form_validation->run() == FALSE)
        {
            $data = array(
                // Form Data.
                'form_open' => form_open(''.site_url().'/users/register'),
                'form_close' => form_close(),
                // Fieldset Data.
                'register_fieldset' => form_fieldset('Register'),
                'close_fieldset' => form_fieldset_close(),
                // Fields.
                'display_name_field' => form_input($this->form_fields['register']['0']),
                'username_field' => form_input($this->form_fields['register']['1']),
                'confirm_username_field' => form_input($this->form_fields['register']['2']),
                'password_field' => form_input($this->form_fields['register']['3']),
                'confirm_password_field' => form_input($this->form_fields['register']['4']),
                // Buttons.
                'submit_button' => form_submit(array('name' => 'submit'), 'Register'),
            );
            
            $this->load->view('register', $data);
        } else {
            $perform_registration = $this->fire_auth->register($this->input->post('username'), $this->input->post('password'), $this->input->post('display_name'));
            
            if($perform_registration == true)
            {
                echo 'Registration Successful<br />';
                echo 'Click '.anchor(''.site_url().'/users/', 'Here').' to redirect.';
            } else {
                redirect('users/register');
            }     
        }  
    }
    
    public function activate()
    {
        
    }
}