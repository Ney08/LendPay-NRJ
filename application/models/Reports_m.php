<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports_m extends CI_Model {

    public function get_reportLoan($coin_id){
        $this->db->select('c.short_name, sum(l.credit_amount) as sum_credit');
        $this->db->join('coins c', 'c.id = l.coin_id', 'left');
        $this->db->where('l.coin_id', $coin_id);
        $cr = $this->db->get('loans l')->row();

        $this->db->select('c.short_name, sum(TRUNCATE(l.credit_amount*(l.interest_amount/100) + l.credit_amount,2)) AS cr_interest');
        $this->db->join('coins c', 'c.id = l.coin_id', 'left');
        $this->db->where('l.coin_id', $coin_id);
        $cr_interest = $this->db->get('loans l')->row();

        $this->db->select('c.short_name, sum(TRUNCATE(l.credit_amount*(l.interest_amount/100) + l.credit_amount,2)) AS cr_interestPaid');
        $this->db->join('coins c', 'c.id = l.coin_id', 'left');
        $this->db->where(['l.coin_id' => $coin_id, 'l.status' => 0]);
        $cr_interestPaid = $this->db->get('loans l')->row();

        $this->db->select('c.short_name, sum(TRUNCATE(l.credit_amount*(l.interest_amount/100) + l.credit_amount,2)) AS cr_interestPay');
        $this->db->join('coins c', 'c.id = l.coin_id', 'left');
        $this->db->where(['l.coin_id' => $coin_id, 'l.status' => 1]);
        $cr_interestPay = $this->db->get('loans l')->row();

        $credits = [$cr, $cr_interest, $cr_interestPaid, $cr_interestPay];

        return $credits;
    }

    public function get_reportCoin($coin_id){
        $this->db->where('id', $coin_id);

        return $this->db->get('coins')->row();
    }

   

    

}
