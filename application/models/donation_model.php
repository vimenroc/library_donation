<?php
class donation_model extends CI_Model{
	protected $table = 't_donaciones';

    public function __construct() {
        parent::__construct();
    }

    public function get_count() {
        return $this->db->count_all($this->table);
    }

	public function donations($limit, $start, $args= null) {
        $this->db->select('t_donaciones.ID');
        $this->db->select('cat_carreras.NOMBRE_CARRERA');
        $this->db->select('MATRICULA');
        $this->db->select('FECHA_GRADUACION');
        $this->db->select('NOMBRE');
        if ($args) {
            if (isset($args['nombre']) && !empty($args['nombre'])) {
                $this->db->like('NOMBRE', $args['nombre']);
            }
            if (isset($args['matricula']) && !empty($args['matricula'])) {
                $this->db->like('MATRICULA', $args['matricula']);
            }
            if (isset($args['carrera']) && !empty($args['carrera'])) {
                $carrera = $args['carrera'];
                $this->db->where('CARRERA', $carrera);
            }
            if (isset($args['fecha']) && !empty($args['fecha'])) {
                $fecha = $args['fecha'];
                $this->db->where('FECHA_GRADUACION', $fecha);
            }
            
        }
        $this->db->join('cat_carreras', 't_donaciones.CARRERA = cat_carreras.ID');
        $this->db->limit($limit, $start);
        $this->db->order_by("t_donaciones.ID", "ASC");
        $query = $this->db->get($this->table);

        return $query->result();
    }
}
?>