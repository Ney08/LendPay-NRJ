<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models, libraries, or helpers here
        $this->load->library('session');
        $this->load->model('User_m', 'user_m');
        $this->load->library('form_validation');
        
    }

    public function login(){
    $dashboard = 'admin/dashboard';
    $this->user_m->loggedin() == FALSE || redirect($dashboard);
    $rules = $this->user_m->rules;
    $this->form_validation->set_rules($rules);

    if ($this->form_validation->run() == TRUE) {
      
      if ($this->user_m->login() == TRUE) {
        redirect($dashboard);
      }else{
        $this->session->set_flashdata('error', 'Escribir correctamente su email o contraseña');
        redirect('user/login', 'refresh');
      }
      
    }

    $this->load->view('_login_layout');
  }

    public function logout() {
        // Logout the user and redirect to the login page
        $this->user_m->logout();
        redirect('user/login');
    }
   
}