<?php
$ci =& get_instance();
$queryScript = "SELECT
t_donaciones.NOMBRE AS Nombre,
t_donaciones.MATRICULA AS `Matrícula`,
cat_carreras.NOMBRE_CARRERA AS Carrera,
t_donaciones.FECHA_GRADUACION AS Fecha,
t_donaciones.FECHA_TRAMITE AS `Fecha trámite`
FROM
t_donaciones
INNER JOIN cat_carreras ON t_donaciones.CARRERA = cat_carreras.ID
WHERE
t_donaciones.ID = $ID
";
$query = $ci->db->query($queryScript);
$result = $query->row_array();

?>

<style>
button{
    width :100%;
}
</style>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Nueva Donación <small>Registro</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-md-4 col-lg-4 col-sm-12"></div>
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <?php PrintInfo($result); ?>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12"></div>
            </div>
            <div class="x_content">
                <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-3 col-lg-3 col-sm-12"></div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href='<?= base_url("receipts/student/$ID/" . $result["Matrícula"] . ".pdf") ?>'>
                            <button class="btn btn-primary" type="button">Recibo Alumno/Tesorería</button>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <a href='<?= base_url("receipts/library/$ID/" . $result["Matrícula"] . ".pdf") ?>'>
                            <button class="btn btn-primary" type="button">Recibo Biblioteca</button>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <button id = "borrar" class="btn btn-danger" type="button">Borrar</button>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-12"></div>
                </div>
                    
                
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $( "#borrar" ).click(function() {
        if (confirm('Borrar el registro?')) {
            window.location.href = "<?= base_url('donations/delete/' . $ID) ?>";
        }
    });
});
</script>

<?php

function PrintInfo($result){
    foreach ($result as $key => $value):
        echo "<p> $key: $value </p>";
    endforeach;
}

?>