<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models, libraries, or helpers here
    }

    public function index() {
        // Default method
        echo "Welcome to TestController!";
    }

    public function check_database() {
        $query = $this->db->query("SELECT DATABASE()");
        $row = $query->row_array();
        echo 'Connected to database: ' . $row['DATABASE()'];
    }

    
}