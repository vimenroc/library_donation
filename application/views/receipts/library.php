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
            t_donaciones.FECHA_TRAMITE
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

    $x = 100; $y = 20;
    $pdf = new FPDF();
    $pdf->AddPage('P', 'A4');
    $pdf->SetTopMargin(15);
    $pdf->SetLeftMargin(15);
    $pdf->SetRightMargin(15);
        
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
    $pdf->Cell(180,5,$msg,0, 0, 'C');

    $y += 25;
    $pdf->setY($y);
    $msg = iconv('UTF-8'
        ,'windows-1252//IGNORE'
        ,"Biblioteca");
    $pdf->Cell(180,5,$msg,0 , 0, 'R');

    // Datos del alumno
    $y += 5;
    $pdf->setY($y);
    $msg = iconv('UTF-8'
        ,'windows-1252//IGNORE'
        ,"Fecha: ");
    $pdf->Cell(40,5,$msg,1 , 0, 'L');
    $msg = iconv('UTF-8'
        ,'windows-1252//IGNORE'
        ,substr_replace($result['FECHA_TRAMITE'],"",-9));
    $pdf->Cell(110,5,$msg,1 , 0, 'L');
    $msg = iconv('UTF-8'
        ,'windows-1252//IGNORE'
        ,"Vo.Bo. ");
    $pdf->Cell(30,5,$msg,1 , 0, 'L');
    
    $y += 5;
    $pdf->setY($y);
    $msg = iconv('UTF-8'
        ,'windows-1252//IGNORE'
        ,"Matrícula: ");
    $pdf->Cell(40,5,$msg,1 , 0, 'L');
    $msg = iconv('UTF-8'
        ,'windows-1252//IGNORE'
        ,$result['MATRICULA']);
    $pdf->Cell(110,5,$msg,1 , 0, 'L');

    $y += 5;
    $pdf->setY($y);
    $msg = iconv('UTF-8'
        ,'windows-1252//IGNORE'
        ,"Nombre: " . $result['NOMBRE']);
    $pdf->Cell(90,5,$msg,1 , 0, 'L');
    $msg = iconv('UTF-8'
        ,'windows-1252//IGNORE'
        ,"Celular:");
    $pdf->Cell(60,5,$msg,1 , 0, 'L');

    $y += 5;
    $pdf->setY($y);
    $msg = iconv('UTF-8'
        ,'windows-1252//IGNORE'
        ,"Carrera: " . $result['NOMBRE_CARRERA']);
    $pdf->Cell(90,5,$msg,1 , 0, 'L');
    $msg = iconv('UTF-8'
        ,'windows-1252//IGNORE'
        ,"Fecha de egreso: " . substr_replace($result['FECHA_GRADUACION'] ,"", -9));
    $pdf->Cell(60,5,$msg,1 , 0, 'L');

    $y -= 10;
    $x = 165;
    $pdf->setXY($x, $y);
    $pdf->MultiCell(30,15,"",1, 'C');

    $pdf->Output('I');
}



?>