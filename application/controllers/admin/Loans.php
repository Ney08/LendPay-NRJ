<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loans extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models, libraries, or helpers here
        $this->load->model('loans_m'); // Ensure the model is loaded correctly
        $this->load->library('session');
        $this->load->library('form_validation'); // Load the input library
        $this->session->userdata('loggedin') == TRUE || redirect('user/login');
    }

    public function index(){
        // Load a view to list all loans
        $data['loans'] = $this->loans_m->get_loans();
        $data['subview'] = 'admin/loans/index';
        $this->load->view('admin/_main_layout', $data);
    }

 

    // function ajax_checkPendingPayments() {
    //     $client_id = $this->input->post('client_id');
    //     $pending_payments = $this->loans_m->get_pendingPayments($client_id);

    //     echo json_encode($pending_payments);
    // }

    

}