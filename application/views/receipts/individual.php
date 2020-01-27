<?php 
session_start();
include("./assets/plugins/fpdf/fpdf.php");
// include('./assets/plugins/fpdi/autoload.php');

GenerarPDF($ID);

function GenerarPDF($ID){
    $ci =& get_instance();
    $logo_1   = "./assets/images/uanl_shield.png";
    $logo_2   = "./assets/images/fcfm_shield.png";
    $tipoRecibo = ["Tesorería", "Alumno"];
    

    if ($ID) {
        $queryScript = "SELECT
            t_donaciones.NOMBRE,
            t_donaciones.MATRICULA,
            cat_carreras.NOMBRE_CARRERA,
            t_donaciones.FECHA_GRADUACION,
            t_donaciones.FECHA_TRAMITE,
            t_donaciones.ID
            FROM
            t_donaciones
            INNER JOIN cat_carreras ON t_donaciones.CARRERA = cat_carreras.ID
            WHERE
            t_donaciones.ID = $ID";
        $query = $ci->db->query($queryScript);
        $result = $query->row_array();
    }else{
        exit;
    }
    $datosDeAlumno = [
        "Fecha" => substr_replace($result['FECHA_TRAMITE'],"",-9),
        "Matrícula" => $result['MATRICULA'],
        "Nombre" => $result['NOMBRE'],
        "Carrera" => $result['NOMBRE_CARRERA']
    ];


    $x = 100; $y = 20;
    $pdf = new FPDF();
    $pdf->AddPage('P', 'A4');
    $pdf->SetTopMargin(15);
    $pdf->SetLeftMargin(15);
    $pdf->SetRightMargin(15);

    for($i = 0; $i <2; $i++) {
        
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetAutoPageBreak(true, 10);
        // Logos
        $pdf->Image($logo_1, 15, $y, 30, 0);
        $pdf->Image($logo_2, 165, $y, 30, 0);
        
        // Encabezado
        $y += 0;
        $pdf->setY($y);
        $msg = iconv('UTF-8'
            ,'windows-1252//IGNORE'
            ,"FACULTAD DE CIENCIAS FÍSICO-MATEMÁTICAS");
        $pdf->Cell(180,5,$msg,0, 0, 'C');
        $y += 5;
        $pdf->setY($y);
        $msg = iconv('UTF-8'
            ,'windows-1252//IGNORE'
            ,"CERTIFICACIÓN DE DOCUMENTO ACADÉMICO ADMINISTRATIVO
DE EGRESO DE LICENCIATURA");
        $pdf->MultiCell(180,5,$msg,0, 'C');
        $y += 10;
        $pdf->setY($y);
        $msg = iconv('UTF-8'
            ,'windows-1252//IGNORE'
            ,"DONACIÓN CICE");
        $pdf->Cell(90,5,$msg,0, 0, 'C');

        $y += 25;
        $pdf->setY($y);
        $msg = iconv('UTF-8'
            ,'windows-1252//IGNORE'
            ,"Folio: " . $result['ID']);
        $pdf->Cell(90,5,$msg,0 , 0, 'L');
        $msg = iconv('UTF-8'
            ,'windows-1252//IGNORE'
            ,$tipoRecibo[$i]);
        $pdf->Cell(90,5,$msg,0 , 0, 'R');
        

        // Datos del alumno
        foreach ($datosDeAlumno as $key => $value) {
            if ($key != "Folio") {
                $y += 5;
                $pdf->setY($y);
                $msg = iconv('UTF-8'
                    ,'windows-1252//IGNORE'
                    ,"$key: ");
                $pdf->Cell(40,5,$msg,1 , 0, 'L');
                $msg = iconv('UTF-8'
                    ,'windows-1252//IGNORE'
                    , $value);
                $pdf->Cell(110,5,$msg,1 , 0, 'L');
            }
        }
        $y -= 15;
        $x = 165;
        $pdf->setXY($x, $y);
        $msg = iconv('UTF-8'
            ,'windows-1252//IGNORE'
            ,"Vo.Bo. ");
        $pdf->Cell(30,5,$msg,1 , 0, 'L');
        $y += 5;
        $pdf->setXY($x, $y);
        $pdf->MultiCell(30,15,"",1, 'C');
        $y += 90;
    }
    $pdf->Output('I');
}
?>