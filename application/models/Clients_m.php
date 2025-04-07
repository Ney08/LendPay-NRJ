<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clients_m extends MY_Model {

    protected $_table_name = 'clients';

    // this function is used to get all the data from the database
    public $clients_rules = array(
        array(
            'field' => 'dni',
            'label' => 'cédula',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'first_name',
            'label' => 'nombre(s)',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'apellido(s)',
            'rules' => 'trim|required'
        )
    );

    // get_new function is used to get the new client
    public function get_new() {
        $client = new stdClass();
        $client -> dni = '';
        $client -> first_name = '';
        $client -> last_name = '';
        $client -> gender = 'none';
        $client -> provincia_id = 0;
        $client -> municipio_id = 0;
        $client -> sector_id = 0;
        $client -> address = '';
        $client -> mobile = '';
        $client -> phone = '';
        $client -> business_name = '';
        $client -> ruc = '';
        $client -> company = '';

        return $client;
    }

    public function dni_exists($dni, $id = null) {
        $this->db->where('dni', $dni);
        if ($id) {
            $this->db->where('id !=', $id);
        }
        $query = $this->db->get($this->_table_name);
        return $query->num_rows() > 0;
    }
    public function get_provincia() {
        
        return $this->db->get('provincias')->result();
    }

    public function get_editMunicipio($prov_id){
        $this->db->where('provincia_id', $prov_id);
        return $this->db->get('municipios')->result();
    }

  public function get_editSector($mp_id){
        $this->db->where('municipio_id', $mp_id);
        return $this->db->get('sectores')->result();
  }


    public function get_municipio($prov_id) {
        $this->db->where('provincia_id', $prov_id);
        
        $query = $this->db->get('municipios');
        $output1 = '<option value="0">Seleccione el municipio</option>';
        foreach ($query->result() as $row) {
            $output1 .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        
        return $output1;
    }

    public function get_sector($mp_id) {
        $this->db->where('municipio_id', $mp_id);
        
        $query = $this->db->get('sectores');
        $output1 = '<option value="0">Seleccione el sector</option>';
        foreach ($query->result() as $row) {
            $output1 .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        
        return $output1;
    }

}