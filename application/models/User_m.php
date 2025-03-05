<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class User_m extends MY_Model {
    protected $_table_name ="users";

    public $rules = array(
    'email' => array(
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'trim|required|valid_email'
    ),
    'password' => array(
      'field' => 'password',
      'label' => 'Contraseña',
      'rules' => 'trim|required'
    )
  );
    // this function this function login is used to check if the user is registered in the database
    public function login() {
        $user = $this->get_by(array(
            'email' => $this->input->post('email'),
            'password' => $this->hash($this->input->post('password'))
        ), TRUE);

        if (null !== $user) {
            // Log in user
            $data = array(
                'user_id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'loggedin' => TRUE
            );
            $this->session->set_userdata($data);
            return TRUE;
        }
    }

    // Logout user and destroy session data
    public function logout() {
        $this->session->sess_destroy();
    }

    // Check if user is logged in
    public function loggedin() {
        return (bool) $this->session->userdata('loggedin');
    }


}