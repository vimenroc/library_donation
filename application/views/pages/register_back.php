<?php

$ci =& get_instance();
$dateCurrent = new DateTime(date("Y-m-d H:i:s"));
$dataRegistro = [
    "NOMBRE" => $_POST['nombre'],
    "MATRICULA" => $_POST['matricula'],
    "FECHA_GRADUACION" => $_POST['fecha-egreso'],
    "CARRERA" => $_POST['carrera'],
    "FECHA_TRAMITE" => $dateCurrent->format("Y-m-d H:i:s")
];
$ci->db->insert('t_donaciones', $dataRegistro);

$result = [ "result" => 1,
    "msg" => "Registro exitoso."
];
echo json_encode($result);
?>