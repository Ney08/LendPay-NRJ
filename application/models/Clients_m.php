<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clients_m extends MY_Model {

    protected $_table_name = 'clients';

    // this function is used to get all the data from the database
    public $clients_rules = array(
        array(
            'field' => 'dni',
            'label' => 'dni',
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

   

}