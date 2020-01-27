<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receipts extends CI_Controller {

    function index(){
        $this->load->database();
        $data['title'] = "Inicio";
        $this->load->view('templates/header',$data);
        $this->load->view('pages/home');
        $this->load->view('templates/footer');
    }

    function individual($id = null){
        $this->load->database();
        $data['title'] = "Recibos individuales";
        $data['ID'] = $id;
        $this->load->view('templates/header',$data);
        $this->load->view('pages/receipts', $data);
        $this->load->view('templates/footer');
    }

    function download_massive($mode, $val1 = null, $val2 = null, $val3 = null){
        $this->load->database();
        $data['mode'] = $mode;
        $data['carrera'] = $val1;
        $data['fechaInicio'] = $val2;
        $data['fechaFin'] = $val3;
        $this->load->view('receipts/download_massive', $data);
    }

    function single_search(){
        $this->load->database();
        $data['title'] = "Búsqeuda de recibo";
        $this->load->view('templates/header',$data);
        $this->load->view('receipts/search_one', $data);
        $this->load->view('templates/footer');
    }

    function massive_search(){
        $this->load->database();
        $data['title'] = "Búsqueda de recibos";
        $this->load->view('templates/header',$data);
        $this->load->view('receipts/massive', $data);
        $this->load->view('templates/footer');
    }

    // PDF recibo de estudiante
    function student($id = null){
        $this->load->database();
        $data['ID'] = $id;
        $this->load->view('receipts/individual', $data);
    }

    // PDF recibo de biblioteca
    function library($id = null){
        $this->load->database();
        $data['ID'] = $id;
        $this->load->view('receipts/library', $data);
    }
    
}
