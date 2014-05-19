<?php
session_start();
//error_reporting(-1);

include('../cnx/conexion_calidad.php');
conectarc();


include('../cnx/conexion.php');

include ('PHPExcel/PHPExcel.php');


//error_reporting(E_ALL);

//date_default_timezone_set('Europe/London');

/*************************************************
//$consulta = "SELECT nombre_categoria,codigo,fecha_creacion, ultima_revision,prefijo,id_usuario, responsable, nombre_subcat, nombre_archivo, version, url_archivo, url_online,copias_controladas FROM vista_maestro WHERE estado = 1";
$consulta = "SELECT nombre_categoria from tbl_categorias";
//$consulta = "SELECT  * FROM vista_maestro";
$result=mysql_query($consulta,$_SESSION['connectidc']);

if(!$result){
      echo mysql_error();     
}
while ($row=mysql_fetch_object($result)){
 echo $row->nombre_categoria."<br>";
}
*************************************************/

/** Include PHPExcel */

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


// Set document properties
$objPHPExcel->getProperties()->setCreator("R-GE-01")
                                           ->setLastModifiedBy("SIC")
                                           ->setTitle("R-GE-01")
                                           ->setSubject("R-GE-01")
                                           ->setDescription("R-GE-01")
                                           ->setKeywords("R-GE-01")
                                           ->setCategory("R-GE-01");

$consulta = "SELECT nombre_categoria,codigo,fecha_creacion, ultima_revision,prefijo,id_usuario, responsable, nombre_subcat, nombre_archivo, version, url_archivo, url_online,copias_controladas FROM vista_maestro WHERE estado = 1";
$result=mysql_query($consulta,$_SESSION['connectidc']);

if(!$result){
      echo mysql_error();     
}
$nombre_categoria='';
$pestanas=0;
$registros=5;
$primer_titulo=0;
conectar();


while ($row=mysql_fetch_object($result)){
      $consulta2 = "Select nombre, apellidos from tbl_usuarios where id='".$row->responsable."'";
      $result2=mysql_query($consulta2,$_SESSION['connectid']);
      $row2=mysql_fetch_object($result2);
      
      if ($pestanas==0 && $primer_titulo==0){
            $objPHPExcel->setActiveSheetIndex(0)
            //TITULO
            ->setCellValue('A1','CENTRO DE INVESTIGACIÓN Y NUTRICIÓN ANIMAL')            
            
            
            
            //ENCABEZADOS
            ->setCellValue('A2', 'R-GE-01')
            ->setCellValue('B2', 'V10')            
            ->setCellValue('A3', 'Fecha de emisión:')
            ->setCellValue('B3', '9-12-2013')

            ->setCellValue('A4', 'Tipo')
            ->setCellValue('B4', 'Código')
            ->setCellValue('C4', 'Nombre')
            ->setCellValue('D4', 'Versión')
            ->setCellValue('E4', 'Fecha de emisión o derogación')
            ->setCellValue('F4', 'Fecha de última revisión exhaustiva')
            ->setCellValue('G4', 'Copias controladas')
            ->setCellValue('H4', 'Estado de la revisión')
            ->setCellValue('I4', 'Responsable de la revisión periódica');
            //FORMATO
            $objPHPExcel->getActiveSheet()->getStyle('A4:j4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getFill()->getStartColor()->setARGB('B0C4DE');
            $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->getStartColor()->setARGB('90EE90');
            $objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('D1:D50')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);            
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);            
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getStyle('C5:C50')->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('E4:E50')->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('F4:F50')->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->setTitle($row->nombre_categoria);
            $objPHPExcel->setActiveSheetIndex($pestanas)
            ->setCellValue('A'.$registros, $row->nombre_categoria)
            ->setCellValue('B'.$registros, $row->prefijo."-".$row->codigo)
            ->setCellValue('C'.$registros, $row->nombre_archivo)
            ->setCellValue('D'.$registros, $row->version)
            ->setCellValue('E'.$registros, $row->fecha_creacion)
            ->setCellValue('F'.$registros, $row->ultima_revision)
            ->setCellValue('G'.$registros, $row->copias_controladas)
            ->setCellValue('H'.$registros, 'Estado de la revisión')
            ->setCellValue('I'.$registros, $row2->nombre." ".$row2->apellidos);
            $registros--;
            $nombre_categoria=$row->nombre_categoria;           
            $primer_titulo=1;

      }
      
      
      if ($nombre_categoria!=$row->nombre_categoria&&$primer_titulo!=0){
      $pestanas++;
      $nombre_categoria=$row->nombre_categoria;           
      $objPHPExcel->createSheet();
      $registros=5;
      
      $objPHPExcel->setActiveSheetIndex($pestanas)
            //TITULO
            ->setCellValue('A1','CENTRO DE INVESTIGACIÓN Y NUTRICIÓN ANIMAL')            
            
            
            
            //ENCABEZADOS
            ->setCellValue('A2', 'R-GE-01')
            ->setCellValue('B2', 'V10')            
            ->setCellValue('A3', 'Fecha de emisión:')
            ->setCellValue('B3', '9-12-2013')

            ->setCellValue('A4', 'Tipo')
            ->setCellValue('B4', 'Código')
            ->setCellValue('C4', 'Nombre')
            ->setCellValue('D4', 'Versión')
            ->setCellValue('E4', 'Fecha de emisión o derogación')
            ->setCellValue('F4', 'Fecha de última revisión exhaustiva')
            ->setCellValue('G4', 'Copias controladas')
            ->setCellValue('H4', 'Estado de la revisión')
            ->setCellValue('I4', 'Responsable de la revisión periódica');
            //FORMATO
            $objPHPExcel->getActiveSheet()->getStyle('A4:j4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getFill()->getStartColor()->setARGB('B0C4DE');
            $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->getStartColor()->setARGB('90EE90');
            $objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
            $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A4:J4')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('D1:D50')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);            
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);            
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getStyle('C5:C50')->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('E4:E50')->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle('F4:F50')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->setTitle($row->nombre_categoria);
      
            $objPHPExcel->setActiveSheetIndex($pestanas)
            ->setCellValue('A'.$registros, $row->nombre_categoria)
            ->setCellValue('B'.$registros, $row->prefijo."-".$row->codigo)
            ->setCellValue('C'.$registros, $row->nombre_archivo)
            ->setCellValue('D'.$registros, $row->version)
            ->setCellValue('E'.$registros, $row->fecha_creacion)
            ->setCellValue('F'.$registros, $row->ultima_revision)
            ->setCellValue('G'.$registros, $row->copias_controladas)
            ->setCellValue('H'.$registros, 'Estado de la revisión')
            ->setCellValue('I'.$registros, $row2->nombre." ".$row2->apellidos);
            //$registros++;
      
     
      }else{
           
            $registros++;
            $objPHPExcel->setActiveSheetIndex($pestanas)
            ->setCellValue('A'.$registros, $row->nombre_categoria)
            ->setCellValue('B'.$registros, $row->prefijo."-".$row->codigo)
            ->setCellValue('C'.$registros, utf8_decode($row->nombre_archivo))
            ->setCellValue('D'.$registros, $row->version)
            ->setCellValue('E'.$registros, $row->fecha_creacion)
            ->setCellValue('F'.$registros, $row->ultima_revision)
            ->setCellValue('G'.$registros, $row->copias_controladas)
            ->setCellValue('H'.$registros, 'Estado de la revisión')
            ->setCellValue('I'.$registros,  $row2->nombre." ".$row2->apellidos);     
      }


}










// Rename worksheet

// Create a new worksheet, after the default sheet







// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=ControlMaestro_'.date('d-m-Y').'.xlsx');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit();

?>
