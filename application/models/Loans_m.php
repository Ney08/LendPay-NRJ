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
    public function get_coins(){
        return $this->db->get('coins')->result();
    }

    // this function is used to get a client by its dni
    public function get_searchCst($dni){
        $this->db->where('dni', $dni);
        return $this->db->get('clients')->row();
    }

    // this function is used to add a new loan to the database
    public function add_loan($data, $items){
        // insert loan data to loans table
        if($this->db->insert('loans', $data)){
            $loan_id = $this->db->insert_id();
            
            $this->db->where('id', $data['client_id']);
            $this->db->update('clients', ['loan_status'=> 1]);
            foreach ($items as $item) {
                $item['loan_id'] = $loan_id;
                $this->db->insert('loan_items', $item);
            }
            return TRUE;
        }
        return FALSE;
    }

    //get loan by id
    public function get_loan($loan_id){
        $this->db->select("l.*, CONCAT(c.first_name, ' ', c.last_name) AS client_name, co.short_name");
        $this->db->from('loans l');
        $this->db->join('clients c', 'c.id = l.client_id', 'left');
        $this->db->join('coins co', 'co.id = l.coin_id', 'left');
        $this->db->where('l.id', $loan_id);

        return $this->db->get()->row();
     }

     public function get_loanItems($loan_id){
        $this->db->where('loan_id', $loan_id);

        return $this->db->get('loan_items')->result(); 
    }
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