<?php
$name = ($_GET) ? $_GET['nombre'] : NULL ;
$matricula = ($_GET) ? $_GET['matricula'] : NULL ;

$carrera = ($_GET) ? $_GET['carrera'] : NULL ;
$ci =& get_instance();
if ($_GET) {
    // print_r($_GET);
}
$ci->db->order_by('siglas_carrera', 'ASC');
$query = $ci->db->get('cat_carreras');
$carreras = $query->result_array();
?>

<style>
.current{
    font-weight : 900;
}
select {
  padding-left: 45px !important
}
option {
  padding: 0 !important:
}
.clickable-row{
    cursor: pointer;
}
</style>

<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel">
<div class="x_title">
<h2><a href="<?= base_url('donations/registry/') ?>">Registro de donaciones </a><small>.</small></h2>
<div class="clearfix"></div>
</div>
<div class="x_content">
    <div class = "row">
        <form action="<?= base_url('donations/registry/') ?>"  method="get">
            <div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Matrícula" name = "matricula" value = "<?= $matricula?>">
                <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
            </div>
            <!-- <div class="col-md-2 col-sm-2 col-xs-2 form-group has-feedback">
                <input type="date" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Fecha salida" name = "fecha" value = "<?= $date?>">
                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
            </div> -->
            <div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Nombre" name = "nombre" value = "<?= $name?>">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback">
            <span class="fa  fa-graduation-cap form-control-feedback left" aria-hidden="true"></span>
                <select class="form-control" name = "carrera" placeholder = "Carrera">
                    <option></option>
                    <?php
                    foreach ($carreras as $key => $value) {
                        $style = "style = 'padding-left: 0'";
                        $ID = $value['ID'];
                        echo ($ID == $carrera) ? "<option value='$ID' $style selected>" : "<option $style value='$ID'>" ;
                        echo $value['NOMBRE_CARRERA'];
                        echo "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-1 form-group has-feedback">
                <button type="submit" class="btn btn-success">Buscar</button>
            </div>
        </form>
    </div>


    <table id = "donation-registry" class="table table-hover">
        <thead>
            <tr>
                <th>Folio</th>
                <th>Matrícula</th>
                
                <th>Nombre</th>
                <th>Carrera</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($donaciones as $key => $value) :?>
                <tr class='clickable-row' data-href='<?= base_url("receipts/individual/$value->ID")?>'>
                    <th scope="row"><?= $value->ID ?></th>
                    <td><?= $value->MATRICULA ?></td>
                    <td><?= $value->NOMBRE ?></td>
                    <td><?= $value->NOMBRE_CARRERA ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pagLinks;?>
</div>
</div>
</div>
</div>

<script>
$(document).ready(function(){
    $('.table > tbody > tr').click(function() {
        // row was clicked
        window.location.href = $(this).data("href");
    });
});
</script>