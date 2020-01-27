<?php
$ci =& get_instance();
$totalDonations = $ci->db->count_all_results('t_donaciones');
$MD = MostDonations();
$queryLastRecord = $ci->db->query("SELECT * 
FROM t_donaciones
ORDER BY ID DESC
LIMIT 1");
$resultLastRecord = $queryLastRecord->row_array();
?>

<!-- top tiles -->
<div class="row tile_count">
    <div class="col-md-4 col-sm-6 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-book"></i> Total de Donaciones</span>
        <div class="count"><?= $totalDonations ?></div>
        <!-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
    </div>

    <div class="col-md-4 col-sm-6 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Carrera con más Donaciones</span>
        <div class="count"><?= $MD['NAME'] . ": " . $MD['TOTAL'] ?></div>
        <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
    </div>

    <div class="col-md-4 col-sm-6 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Última Donación</span>
        <div class="count"><?= $resultLastRecord['NOMBRE'] ?></div>
        <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
    </div>
 
</div>
<!-- /top tiles -->
<br />
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel tile fixed_height_320 overflow_hidden">
            <div class="x_title">
                <h2>Gráfica donaciones/carrera</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="" style="width:100%">
                    <tr>
                        <th style="width:37%;">
                            <p>Donaciones Porcentaje</p>
                        </th>
                        <th>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                <p class="">Carrera</p>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <p class="">Porcentaje</p>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <!-- dona -->
                        <td>
                            <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                        </td>
                        <!-- /dona -->
                        <?php DrawDonationPercentage() ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>



<?php

function DrawDonationPercentage(){
    $ci =& get_instance();
    $statsArray = [];
    $total = 0;
    $colors = ["green", "red", "yellow", "blue", "purple", "gray", "aero"];
    $queryScript = "SELECT ID, NOMBRE_CARRERA
    FROM
    cat_carreras
    ";
    $queryCarreras = $ci->db->query($queryScript);
    $resultCarreras = $queryCarreras->result_array();
    // print_r($resultCarreras);

    foreach ($resultCarreras as $key => $value):
        $queryScript = "SELECT
        Count(t_donaciones.CARRERA) AS COUNT
        FROM
        t_donaciones
        WHERE
        t_donaciones.CARRERA = " . $value['ID'];
        $queryCuenta = $ci->db->query($queryScript);
        $resultCuenta = $queryCuenta->row_array();
        array_push($statsArray, [
            $value['NOMBRE_CARRERA'],
            $resultCuenta['COUNT']
        ]);
        $total += $resultCuenta['COUNT'];

    endforeach;
    echo "<td>";
    echo "<table class = 'tile_info'>";
    if ($total) {
        foreach ($statsArray as $key => $value) {
            $percentage = $value[1] / $total * 100;
            $color = $colors[$key];
            $percentage = number_format((float)$percentage, 2, '.', '');
            echo "<tr>";
            echo "<td>";
            echo "<p><i class='fa fa-square $color'></i>" . $value[0] .  "</p>";
            echo "</td>";
            echo "<td>$percentage%</td>";
            echo "</tr>";
        }
    }
    
    echo "</table>";
    echo "</td>";
    ?>

<?php
}

function MostDonations(){
    $ci =& get_instance();
    $v1 = 0;$v2 = 0;
    $id1 = ""; $id2 = "";
    $start = true;
    $query = $ci->db->query('SELECT
    cat_carreras.NOMBRE_CARRERA,
    Count(t_donaciones.ID) AS TOTAL,
    cat_carreras.SIGLAS_CARRERA AS SIGLAS
    FROM
    t_donaciones
    INNER JOIN cat_carreras ON t_donaciones.CARRERA = cat_carreras.ID
    GROUP BY
    cat_carreras.NOMBRE_CARRERA
    ');
    foreach ($query->result() as $row){
        if ($start) {
            $id1 = $row->SIGLAS;
            $v1 = $row->TOTAL;
            $start = false;
        }else{
            $v2 = $v1;
            $id2 = $id1;
            $id1 = $row->SIGLAS;
            $v1 = $row->TOTAL;
            $v1 = ($v1 > $v2) ? $v1 : $v2 ;
            $id1 = ($v1 > $v2) ? $id1 : $id2 ;
        }
    }
    $result = [
        "NAME" => $id1,
        "TOTAL" => $v1
    ];
    return $result; 
}


?>