<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class MY_Model extends CI_Model {

    protected $_table_name = '';
    protected $_primary_key = 'id';

    // this function is used to get all the data from the database
    public function get($id = NULL, $single = FALSE) {
        if ($id != NULL) {
            $filter = $this->_primary_key;
            $this->db->where($filter, $id);
            $method = 'row';
        } elseif ($single == TRUE) {
            $method = 'row';
        } else {
            $method = 'result';
        }
        $this->db->order_by("id", "desc");
        return $this->db->get($this->_table_name)->$method();
    }

    // this function is used to get data from the database by a specific id
    // $where is an array that contains the id of the data to be fetched
    public function get_by($where, $single = FALSE) {
        $this->db->where($where);

        return $this->get(NULL, $single);
    }

    // this function is used to get data from the database by a specific field
    // $where is an array that contains the field of the data to be fetched
    public function save($data, $id = NULL) {
        // Insert
        if ($id === NULL) {
            $this->db->insert($this->_table_name, $data);
            $id = $this->db->insert_id();
            
        }
        // Update
        else {
            $filter = $this->_primary_key;
            $this->db->where($filter, $id);
            $this->db->update($this->_table_name, $data);
            
        }
        
        return $id;
    }


    // this function is used to delete data from the database by a specific id
    // $id is the id of the data to be deleted
    public function delete($id) {
        if (!$id) {
            return FALSE;
          }
      
          $this->db->where($this->_primary_key, $id);
          $this->db->delete($this->_table_name);
    }

    
    //$this->clients_m->array_from_post(array('dni', 'first_name','last_name','email','gender','department_id','province_id','district_id','mobile', 'address', 'phone', 'business_name', 'ruc', 'company')); 

    // this function is used to get data from the database by a specific field
    // $where is an array that contains the field of the data to be fetched
    public function array_from_post($fields) {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

    // this function is used to hash the password by using the sha512 algorithm
    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }
}