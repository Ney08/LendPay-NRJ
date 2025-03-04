<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coins extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models, libraries, or helpers here
        $this->load->model('Coins_m', 'coins_m');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->session->userdata('loggedin') == TRUE || redirect('user/login');
    }

    public function index() {
        // Fetch all coins and pass to the view
        $data['coins'] = $this->coins_m->get();
        $data['subview'] = 'admin/coins/index';
        $this->load->view('admin/_main_layout', $data);
    }

    //function to edit a coin
    public function edit( $id = null ) {
        if($id) {
            $data['coin'] = $this->coins_m->get($id);
            $data['coin'] || show_404();
        } else {
            $data['coin'] = $this->coins_m->get_new();
        }

        $rules = $this->coins_m->coin_rules;

        $this->form_validation->set_rules($rules);

        if($this->form_validation->run() == true) {
            $coin_data = $this->coins_m->array_from_post(array('name', 'short_name', 'symbol', 'description'));
            $this->coins_m->save($coin_data, $id);

            if(isset($coin_data['id'])) {
                $this->session->set_flashdata('msg', 'La moneda ha sido actualizada');
            } else {
                $this->session->set_flashdata('msg', 'La moneda ha sido creada');
            }

            redirect('admin/coins');
        } else {
            $data['subview'] = 'admin/coins/edit';
            $this->load->view('admin/_main_layout', $data);
        }

        

    }
    
}