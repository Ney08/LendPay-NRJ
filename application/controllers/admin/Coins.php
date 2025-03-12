<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coins extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models, libraries, or helpers here
        $this->load->model('Coins_m', 'coins_m');
        $this->load->library('session');
        $this->load->library('form_validation');
        
    }

    public function index() {
        // Fetch all coins and pass to the view
        $data['coins'] = $this->coins_m->get();
        $data['subview'] = 'admin/coins/index';
        $this->load->view('admin/_main_layout', $data);
    }

    //function to edit a coin
    
    
}