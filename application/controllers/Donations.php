<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donations extends CI_Controller {
    public function __construct() {
        parent:: __construct();

        $this->load->model('donation_model');
        $this->load->library("pagination");
    }

	function index(){
        $this->load->view('templates/header');
        $this->load->view('home/home');
        $this->load->view('templates/footer');
    }

    function delete($id){
        $this->load->database();
        $data['id'] = $id;
        $data['title'] = "Borrado exitoso";
        $this->load->view('templates/header', $data);
        $this->load->view('crud/delete', $data);
        $this->load->view('templates/footer');
    }

    function registry(){
        $this->load->database();
        $data['title'] = "Registro de Donaciones";
        $config['base_url'] = base_url('donations/registry');
        if ($_GET) {
            $GET_parameters = parse_str($_SERVER['QUERY_STRING'], $_GET);
            if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
                $this->db->like('NOMBRE', $_GET['nombre']);
            }
            if (isset($_GET['matricula']) && !empty($_GET['matricula'])) {
                $this->db->like('MATRICULA', $_GET['matricula']);
            }
            if (isset($args['fecha']) && !empty($args['fecha'])) {
                $fecha = $args['fecha'];
                $this->db->where('FECHA_GRADUACION', $fecha);
            }
            if (isset($_GET['carrera']) && !empty($_GET['carrera'])) {
                $this->db->like('CARRERA', $_GET['carrera']);
            }
        }else{
            $search = NULL;
        }
        $config['total_rows'] = $this->db->count_all_results('t_donaciones');
        $config['uri_segment'] = $this->uri->total_segments();
        // $config['use_page_numbers'] = TRUE;
        $config['cur_tag_close'] = '</a>&nbsp&nbsp&nbsp ';
        $config['cur_tag_open'] = ' &nbsp&nbsp&nbsp<a class = "current">';
        $config['per_page'] = 20;
        $config['num_tag_open'] = ' ';
        $config['num_tag_close'] = ' ';
        $config['reuse_query_string'] = true;
        $config['prev_link'] = '<i class="fa fa-step-backward"></i>Anterior ';
        $config['first_link'] = '<i class="fa fa-fast-backward"></i>Primero ';
        $config['next_link'] = ' Siguiente<i class="fa fa-step-forward"></i> ';
        $config['last_link'] = ' Último<i class="fa fa-fast-forward"></i>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagLinks'] = $this->pagination->create_links();
        $data['donaciones'] = $this->donation_model->donations($config["per_page"], $page,$_GET);

        $this->load->view('templates/header', $data);
        
        $this->load->view('pages/registry');
        $this->load->view('templates/footer');
    }
    
    function register(){
        $this->load->database();
        $data['title'] = "Nueva Donación";
        $this->load->view('templates/header', $data);
        $this->load->view('pages/register_front');
        $this->load->view('templates/footer');
    }
    
    function register_back(){
        $this->load->database();
        $this->load->view('pages/register_back');
	}
}
