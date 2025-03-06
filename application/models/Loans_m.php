<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loans_m extends MY_Model
{

    protected $_table_name = 'loans';

    public $loan_rules = array(
        array(
            'field' => 'client_id',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'selecione un cliente',
            ),
        )
    );



    // this function is used to get all loans from the database
    public function get_loans(){
        $this->db->select("l.id, CONCAT(c.first_name, ' ', c.last_name) AS client, l.credit_amount, l.interest_amount, co.short_name, l.status");
        $this->db->from('loans l');
        $this->db->join('clients c', 'c.id = l.client_id', 'left');
        $this->db->join('coins co', 'co.id = l.coin_id', 'left');
        $this->db->order_by('l.id', 'desc');

        return $this->db->get()->result();
    }

    // this function is used to get all coins from the database
   
    // this function is used to get all payments from the database
    // public function get_payments($loan_id){
    //     $this->db->where('loan_id', $loan_id);
    //     return $this->db->get('loan_items')->result();
    // }

    // //get all clients
    // public function get_clients(){
    //     return $this->db->get('clients')->result();
    // }

    // // this function is used to get all pending payments for a specific client
    // public function get_pendingPayments($client_id){
    //     $this->db->select("l.id AS loan_id, l.credit_amount, l.interest_amount, li.amount AS pending_amount, li.due_date");
    //     $this->db->from('loans l');
    //     $this->db->join('loan_items li', 'li.loan_id = l.id', 'left');
    //     $this->db->where('l.client_id', $client_id);
    //     $this->db->where('li.status', 'pending');
    //     $this->db->order_by('li.due_date', 'asc');

    //     return $this->db->get()->result();
    // }
   

}