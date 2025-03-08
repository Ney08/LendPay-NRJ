<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct(){
        parent::__construct();
        // Load necessary models, libraries, or helpers here
        $this->load->model('coins_m');
        $this->load->model('reports_m');
        $this->load->library('session');
        $this->load->helper('url');
        $this->session->userdata('loggedin') == TRUE || redirect('user/login');
        
    }

    public function index(){
        // Default method for the Reports controller
        $data['coins'] = $this->coins_m->get();
        $data['subview'] = 'admin/reports/index';
        $this->load->view('admin/_main_layout', $data);
    }

  }