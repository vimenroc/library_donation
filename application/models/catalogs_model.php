<?php
class catalogs_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	// methods always inside the class
	// remember to add model to autoload if needed
	public function get_sub_units(){
	    $query = $this->db->query("SELECT
        *
		FROM
		cat_carreras
		");
	    $result = $query->result_array();
	    return $result;
    }
}
?>