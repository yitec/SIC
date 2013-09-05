<?php
session_start();
include('../cnx/conexion.php');
conectar();

/** Error reporting */
error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** Include PHPExcel */
require_once '../includes/PHPExcel/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");



//**********************************************Tipo muestreo**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_tipo_muestreo");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$col, $row->id)
            ->setCellValue('B'.$col, $row->nombre);
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Tipo Muestreo');
$objPHPExcel->createSheet();
//**********************************************Tipo muestreo**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_zona");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A'.$col, $row->id)
            ->setCellValue('B'.$col, $row->nombre);
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Zona Geografica');
$objPHPExcel->createSheet();
// Create a new worksheet
//**********************************************Tipo alimento**************************************
$result=mysql_query("select * from tbl_provincias");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(2)
            ->setCellValue('A'.$col, $row->id)
            ->setCellValue('B'.$col, $row->nombre);
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Provincias');
$objPHPExcel->createSheet();
// Create a new worksheet
//**********************************************Tipo alimento**************************************
$result=mysql_query("select * from tbl_cantones");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(2)
            ->setCellValue('A'.$col, $row->id)
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Cantones');
$objPHPExcel->createSheet();
//**********************************************Clasificacion**************************************
$result=mysql_query("select * from tbl_distritos");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(3)
            ->setCellValue('A'.$col,utf8_encode($row->id))
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Distritos');
$objPHPExcel->createSheet();
//**********************************************Año**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_year");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(4)
            ->setCellValue('A'.$col,utf8_encode($row->id))
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Año Toma Muestra');
$objPHPExcel->createSheet();
//**********************************************Procesamiento**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_vulgar");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(5)
            ->setCellValue('A'.$col,utf8_encode($row->id))
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Nombre Vulgar');
$objPHPExcel->createSheet();
//**********************************************Fuente**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_cientifico");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(6)
            ->setCellValue('A'.$col,utf8_encode($row->id))
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Nombre Cientifico');
$objPHPExcel->createSheet();
//**********************************************Fuente**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_parte_planta");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(7)
            ->setCellValue('A'.$col,utf8_encode($row->id))
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Parte Planta');
$objPHPExcel->createSheet();

//**********************************************Fuente**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_madurez");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(8)
            ->setCellValue('A'.$col,utf8_encode($row->id))
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Madurez');
$objPHPExcel->createSheet();
//**********************************************Fuente**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_tipo_forraje");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(9)
            ->setCellValue('A'.$col,utf8_encode($row->id))
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Tipo Forraje');
$objPHPExcel->createSheet();
//**********************************************Fuente**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_mes");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(10)
            ->setCellValue('A'.$col,utf8_encode($row->id))
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Mes');
$objPHPExcel->createSheet();

//**********************************************Fuente**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_origen");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(11)
            ->setCellValue('A'.$col,utf8_encode($row->id))
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Origen');
$objPHPExcel->createSheet();
//**********************************************Fuente**************************************

            $objPHPExcel->setActiveSheetIndex(12)
            ->setCellValue('A1','1')
            ->setCellValue('B1','SI');
            $objPHPExcel->setActiveSheetIndex(12)
            ->setCellValue('A2','2')
            ->setCellValue('B2','NO');
            $objPHPExcel->setActiveSheetIndex(12)
            ->setCellValue('A2','3')
            ->setCellValue('B2','SE DESCONOCE');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Fertilizacion');
$objPHPExcel->createSheet();
//**********************************************Fuente**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_nitrogeno");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(13)
            ->setCellValue('A'.$col,utf8_encode($row->id))
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Nitrogeno');
$objPHPExcel->createSheet();
//**********************************************Fuente**************************************

            $objPHPExcel->setActiveSheetIndex(14)
            ->setCellValue('A3','1')
            ->setCellValue('B3','FRESCA');
            $objPHPExcel->setActiveSheetIndex(14)
            ->setCellValue('A3','2')
            ->setCellValue('B3','SECADA ARTIFICIALMENTE');
            $objPHPExcel->setActiveSheetIndex(14)
            ->setCellValue('A3','3')
            ->setCellValue('B3','NO APLICA');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Estado de la muestra');
$objPHPExcel->createSheet();

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Codificacion_Forrajes.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
