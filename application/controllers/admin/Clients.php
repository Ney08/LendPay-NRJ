<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models, libraries, or helpers here
        $this->load->model('Clients_m', 'clients_m');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->session->userdata('loggedin') == TRUE || redirect('user/login');

    }

    public function index() {
        $data['clients'] = $this->clients_m->get();
        $data['subview'] = 'admin/clients/index';
        $this->load->view('admin/_main_layout', $data);
    }

    // this function allows to edit a client
   
    
}

