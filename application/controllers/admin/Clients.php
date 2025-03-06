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
    public function edit($id = NULL) {
        if ($id) {
            $data ['client'] = $this->clients_m->get($id);
            $data['municipio'] = $this->clients_m->get_editMunicipio($data['client']->provincia_id);
            $data['sector'] = $this->clients_m->get_editSector($data['client']->municipio_id);
            
            $data ['client'] || show_404();
        } else {
            $data ['client'] = $this->clients_m->get_new();
        }
        
        $data['provincia'] = $this->clients_m->get_provincia();

        $rules = $this ->clients_m->clients_rules;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            $cst_data = $this->clients_m->array_from_post(['dni','first_name', 'last_name', 'gender', 'provincia_id', 'municipio_id', 'sector_id', 'mobile', 'address', 'phone', 'business_name', 'ruc', 'company']);
            
            // Check if DNI already exists
            if ($this->clients_m->dni_exists($cst_data['dni'], $id)) {
                
                $this->session->set_flashdata('error', 'La cédula ingresada ya existe. Por favor, use uno diferente.');
            } else {
                $this->clients_m->save($cst_data, $id);
      
                if($id){
                    $this->session->set_flashdata('msg', 'El cliente ha sido actualizado');
                }else{
                    $this->session->set_flashdata('msg', 'El cliente ha sido creado');
                }
            
                redirect('admin/clients');
            }
            
            
        }
            
        $data['subview'] = 'admin/clients/edit';
        $this->load->view('admin/_main_layout', $data);
    }

    public function ajax_getMunicipios($prov_id) {
        echo $this ->clients_m->get_municipio($prov_id);
    }

    public function ajax_getSectores($mp_id) {
        echo $this ->clients_m->get_sector($mp_id);
    }
    
    
    
}

