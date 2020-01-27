<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {

    function index(){
        $this->load->database();
        $data['title'] = "Inicio";
        $this->load->view('templates/header',$data);
        $this->load->view('pages/home');
        $this->load->view('templates/footer');
    }
    
}
