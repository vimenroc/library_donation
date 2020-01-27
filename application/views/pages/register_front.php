<?php
$ci =& get_instance();
$ci->db->order_by('siglas_carrera', 'ASC');
$query = $ci->db->get('cat_carreras');
$carreras = $query->result_array();
?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Nueva Donación <small>Registro</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                    <form id="registro" data-parsley-validate="" class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name = "nombre" type="text" id="first-name" required class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Matrícula <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="matricula" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Carrera <span class="required">*</span></label> 
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" required name = "carrera">
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

                        <!-- <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="grad" name = "fecha-egreso" class="date-picker form-control col-md-7 col-xs-12" required="required" type="date">
                            </div>
                        </div> -->
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="button">Cancelar</button>
						        <button class="btn btn-primary" type="reset">Borrar</button>
                                <button type="submit" class="btn btn-success">Registrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#registro").on('submit', function(e){
        e.preventDefault();
        var form = new FormData(this);
        sendBack(form);
    }); 
});

function sendBack(formData){
    var url = "<?php echo base_url('donations/register_back')?>";
        $.ajax({
            url: url,
            method: "post",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            beforeSend : function(data){
            },
            success: function(data){
            },
            complete: function(){
                $("#registro")[0].reset();
            },
            error: function(e){
            }
        });
}


</script>