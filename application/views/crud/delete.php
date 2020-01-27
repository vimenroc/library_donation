<?php
$this->db->where('ID', $id);
$this->db->delete('t_donaciones');

echo "Registro borrado.<br>";
echo "redirigiendo en 3 segundos.";
header( "refresh:3;url=" . base_url() );

?>