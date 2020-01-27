<?php 
session_start();
include("./assets/plugins/fpdf/fpdf.php");
// include('./assets/plugins/fpdi/autoload.php');

$data = GetData($carrera, $fechaInicio, $fechaFin);

switch ($mode) {
    case 1:
        GenerarPDF($data);
        break;
    
    case 2:
        GenerarPDF_Biblioteca($data);
        break;
}



function GenerarPDF_Biblioteca($data){

    $logo_1   = "./assets/images/uanl_shield.png";
    $logo_2   = "./assets/images/fcfm_shield.png";
    $tipoRecibo = ["Biblioteca"];
    


    $pdf = new FPDF();
    

    foreach ($data as $key => $value) {
        $x = 100; $y = 20;
        $pdf->AddPage('P', 'A4');
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(15);
        $pdf->SetRightMargin(15);
        for($i = 0; $i < sizeof( $tipoRecibo); $i++) {
        
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
                ,"Folio: " . $value['Folio']);
            $pdf->Cell(90,5,$msg,0 , 0, 'L');
            $msg = iconv('UTF-8'
                ,'windows-1252//IGNORE'
                ,$tipoRecibo[$i]);
            $pdf->Cell(90,5,$msg,0 , 0, 'R');
    
            // Datos del alumno
            foreach ($value as $k => $v) {
                if ($k != "Folio") {
                    $y += 5;
                    $pdf->setY($y);
                    $msg = iconv('UTF-8'
                        ,'windows-1252//IGNORE'
                        ,"$k: ");
                    $pdf->Cell(40,5,$msg,1 , 0, 'L');
                    $msg = iconv('UTF-8'
                        ,'windows-1252//IGNORE'
                        , $v);
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
    }

    
    $pdf->Output('I');
}

function GetData($carrera, $fechaInicio, $fechaFin){
    $ci =& get_instance();
    $ci->db->join('cat_carreras', 't_donaciones.CARRERA = cat_carreras.ID');
    $ci->db->select("FECHA_TRAMITE AS 'Fecha'");
    $ci->db->select("MATRICULA AS 'Matrícula'");
    $ci->db->select("NOMBRE AS 'Nombre'");
    $ci->db->select("NOMBRE_CARRERA AS 'Carrera'");
    $ci->db->select("t_donaciones.ID AS 'Folio'");
    
    ($carrera != 0 ) ? $ci->db->where("CARRERA", $carrera) : null ;
    ($fechaInicio != 0 ) ? $ci->db->where('FECHA_TRAMITE >=', $fechaInicio) : null ;
    ($fechaFin != 0 ) ? $ci->db->where('FECHA_TRAMITE <=', $fechaFin . " 23:59") : null ;
    $query = $ci->db->get('t_donaciones');
    $resultados = $query->result_array();
    // print_r($resultados);
    return $resultados;
}

function GenerarPDF($data){
    
    $logo_1   = "./assets/images/uanl_shield.png";
    $logo_2   = "./assets/images/fcfm_shield.png";
    $tipoRecibo = ["Tesorería", "Alumno"];
    


    $pdf = new FPDF();
    

    foreach ($data as $key => $value) {
        $x = 100; $y = 20;
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
            $pdf->Cell(180,5,$msg,0, 0, 'C');
    
            $y += 25;
            $pdf->setY($y);
            $msg = iconv('UTF-8'
                ,'windows-1252//IGNORE'
                ,"Folio: " . $value['Folio']);
            $pdf->Cell(90,5,$msg,0 , 0, 'L');
            $msg = iconv('UTF-8'
                ,'windows-1252//IGNORE'
                ,$tipoRecibo[$i]);
            $pdf->Cell(90,5,$msg,0 , 0, 'R');
    
            // Datos del alumno
            foreach ($value as $k => $v) {
                if ($k != "Folio") {
                    $y += 5;
                    $pdf->setY($y);
                    $msg = iconv('UTF-8'
                        ,'windows-1252//IGNORE'
                        ,"$k: ");
                    $pdf->Cell(40,5,$msg,1 , 0, 'L');
                    $msg = iconv('UTF-8'
                        ,'windows-1252//IGNORE'
                        , $v);
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
    }

    
    $pdf->Output('I');
}
?>