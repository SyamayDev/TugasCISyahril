<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            'menu' => 'backend/menu',
            'content' => 'backend/adminKonten',
            'title' => 'Admin',
        );
        $this->load->view('template', $data);
    }
}
