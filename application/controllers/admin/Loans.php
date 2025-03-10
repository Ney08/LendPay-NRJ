<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loans extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models, libraries, or helpers here
        $this->load->model('loans_m'); // Ensure the model is loaded correctly
        $this->load->library('session');
        $this->load->library('form_validation'); // Load the input library
        
    }

    public function index(){
        // Load a view to list all loans
        $data['loans'] = $this->loans_m->get_loans();
        $data['subview'] = 'admin/loans/index';
        $this->load->view('admin/_main_layout', $data);
    }

    public function edit(){
        $data['coins'] = $this->loans_m->get_coins();

        $rules = $this->loans_m->loan_rules;

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {

            if ($this->input->post('payment_m') == 'diario')
                $p = 'P1D';
            if ($this->input->post('payment_m') == 'semanal')
                $p = 'P7D';
            if ($this->input->post('payment_m') == 'quincenal')
                $p = 'P15D';
            if ($this->input->post('payment_m') == 'mensual')
                $p = 'P1M';

            // definir periodo de fechas
            $period = new DatePeriod(
                new DateTime($this->input->post('date')), // Donde empezamos a contar el periodo
                new DateInterval($p), // Definimos el periodo a 1 día, 1mes
                $this->input->post('num_fee'), // Aplicamos el numero de repeticiones
                DatePeriod::EXCLUDE_START_DATE
            );

            $num_quota = 1;

            foreach ($period as $date) {
                //echo $date->format('Y-m-d');
                $items[] = array(
                    'date' => $date->format('Y-m-d'),
                    'num_quota' => $num_quota++,
                    'fee_amount' => $this->input->post('fee_amount')
                );
            }

            $loan_data = $this->loans_m->array_from_post(['client_id', 'credit_amount', 'interest_amount', 'num_fee', 'fee_amount', 'payment_m', 'coin_id', 'date']);

            if ($this->loans_m->add_loan($loan_data, $items)) {

                $this->session->set_flashdata('msg', 'Prestamo agregado correctamente');
            }

            redirect('admin/loans');
        }

        $data['subview'] = 'admin/loans/edit';
        $this->load->view('admin/_main_layout', $data);
    }

    function ajax_searchCst(){
        $dni = $this->input->post('dni');
        $cst = $this->loans_m->get_searchCst($dni);

        echo json_encode($cst);
    }

    function view($id){
        $data['loan'] = $this->loans_m->get_loan($id);
        $data['items'] = $this->loans_m->get_loanItems($id);

        $this->load->view('admin/loans/view', $data);
    }


    // function ajax_checkPendingPayments() {
    //     $client_id = $this->input->post('client_id');
    //     $pending_payments = $this->loans_m->get_pendingPayments($client_id);

    //     echo json_encode($pending_payments);
    // }

    

}