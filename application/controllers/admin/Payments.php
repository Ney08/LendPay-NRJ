<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models, libraries, or helpers here
        $this->load->model('payments_m');
        $this->load->library('form_validation');
        $this->load->library('session');
        
    }

    public function index() {
        // Load a view for listing payments
        $data['payments'] = $this->payments_m->get_payments();
        $data['subview'] = 'admin/payments/index';
        $this->load->view('admin/_main_layout', $data);
    }

    public function edit() {
        $data['subview'] = 'admin/payments/edit';
        $this->load->view('admin/_main_layout', $data);
    }

    public function ajax_searchCst() {
        $dni = $this->input->post('dni');
        $cst = $this->payments_m->get_searchCst($dni);
        $quota_data = '';

        if ($cst != null) {
            $quota_data = $this->payments_m->get_quotasCst($cst->loan_id);
        } 

        $search_data = ['cst' => $cst, $quota_data];

        echo json_encode($search_data);
    }

    

    function ticket(){
        $data['name_cst'] = $this->input->post('name_cst');
        $data['coin'] = $this->input->post('coin');
        $data['loan_id'] = $this->input->post('loan_id');
        $data['client_id'] = $this->input->post('client_id');
  
        foreach ($this->input->post('quota_id') as $q) {
            $this->payments_m->update_quota(['status' => 0], $q);
        }
  
        if (!$this->payments_m->check_cstLoan($this->input->post('loan_id'))) {
            $this->payments_m->update_cstLoan($this->input->post('loan_id'));
            $this->db->select('client_id');
            $this->db->from('loans');
            $this->db->join('clients', 'clients.id = loans.client_id');
            $this->db->where('loans.id', $this->input->post('loan_id'));
            $query = $this->db->get();

            $client_id = $query->row()->client_id;
            $this->payments_m->update_clientLoanStatus($client_id);
            
        }
  
        $data['quotasPaid'] = $this->payments_m->get_quotasPaid($this->input->post('quota_id'));
  
        $this->load->view('admin/payments/ticket', $data);
    }


}