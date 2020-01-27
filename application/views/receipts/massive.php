<?php
$ci =& get_instance();
$ci->db->order_by('siglas_carrera', 'ASC');
$query = $ci->db->get('cat_carreras');
$carreras = $query->result_array();
$val1 = ( isset($_GET['carrera']) && $_GET['carrera'] != "") ? $_GET['carrera'] : null ;
$val2 = (isset($_GET['fecha-inicio']) && $_GET['fecha-inicio'] != "") ? $_GET['fecha-inicio'] : null ;
$val3 = (isset($_GET['fecha-fin']) && $_GET['fecha-fin'] != "") ? $_GET['fecha-fin'] : null ;

?>
<style>
.center-align{
    text-align: center !important;
}
</style>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Búsqueda y Descarga Masiva <small>Recibos de donaciones</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method = "GET">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Carrera <span class="required">*</span></label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" required id = "carrera" name = "carrera">
                                <option></option>
                                <?php
                                foreach ($carreras as $key => $value) {
                                    $ID = $value['ID'];
                                    echo "<option value='$ID'>";
                                    echo $value['NOMBRE_CARRERA'];
                                    echo "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group center-align">
                        Limitar por fechas
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Desde<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="grad" name = "fecha-inicio" class="date-picker form-control col-md-7 col-xs-12" required="required" type="date" value="<?= $val2 ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Hasta<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="grad" name = "fecha-fin" class="date-picker form-control col-md-7 col-xs-12" required="required" type="date" value="<?= $val3 ?>">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <a href="<?= base_url('receipts/massive_search')?>" class="btn btn-primary" type="button">Cancel</a>
                            <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                    </div>
                </form>
                <?php ($_GET) ? DrawResultTable() : null ?>
            </div>
            
        </div>
    </div>
</div>

<script>
$( document ).ready(function() {
    <?php
    if (isset($_GET['carrera']) && $_GET['carrera'] != "") {?>
        $('#carrera option[value=<?= $_GET['carrera'] ?>]').prop('selected', true)    
        <?php
    }?>
    
});
</script>

<?php

function DrawResultTable(){
    if (
        $_GET['carrera'] != "" ||
        $_GET['fecha-inicio'] != "" ||
        $_GET['fecha-fin'] != ""
    ) {
        
        $array = ["carrera", "fecha-inicio", "fecha-fin"];
        $multipleParameters = false;
        $ci =& get_instance();
        if ($_GET['carrera'] != "") {
            $ci->db->where("CARRERA", $_GET['carrera']);
        }else{
            $_GET['carrera'] = 0;
        }
        if ($_GET['fecha-inicio'] != "") {
            $ci->db->where('FECHA_TRAMITE >=', $_GET['fecha-inicio']);
        }else{
            $_GET['fecha-inicio'] = 0;
        }
        if ($_GET['fecha-fin'] != "") {
            $ci->db->where('FECHA_TRAMITE <=', $_GET['fecha-fin'] . " 23:59");
        }else{
            $_GET['fecha-fin'] = 0;
        }
         
        $query = $ci->db->get('t_donaciones');
        $numResultados = $query->num_rows();

        $url = $_GET['carrera'] . "/" .$_GET['fecha-inicio'] . "/" .$_GET['fecha-fin'];
        ?>
        <div class="ln_solid"></div>
        <div class="form-group">
                        
            <div class="col-md-12 col-sm-12 col-xs-12">
            Número de resultados: <?= $numResultados?>
            </div>
        </div>
        <div class="item form-group">
        
        
            <div class="col-md-12 col-sm-12 offset-md-12">
                <button class="btn btn-primary" type="button">Cancel</button>
                <a href="<?= base_url('receipts/download_massive/2/' . $url) ?>" class="btn btn-success" type="reset">Descargar Biblioteca</a>
                <a href="<?= base_url('receipts/download_massive/1/' . $url) ?>" class="btn btn-success">Descargar Tesorería/Alumno</a>
            </div>
        </div>
        <?php
    #$pagLinks;
    }else{

    }
}

?>