<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2012 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2012 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.7, 2012-05-19
 */

/** Error reporting */
error_reporting(E_ALL);

$hoy=date("d-m-Y H:i:s");
date_default_timezone_set('Europe/London');

/** Include PHPExcel */
require_once 'includes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Yitec")
							 ->setLastModifiedBy("Yitec")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Etiquetas para contrato")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

//pongo la columna como autoajustable
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
for ($i=1;$i<=$_REQUEST['numero_muestras'];$i++){



$objPHPExcel->getActiveSheet()->getCell('A'.$i)->setValue("Contrato=".$_REQUEST['contrato']."\nMuestra=".$i."\nFecha Ingreso=".$hoy);
$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setWrapText(true);


}//end for
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Etiquetas Contrato '.$_REQUEST['contrato']);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
//pongo la impresion como landscape
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
//Seteo los margenes de impresion
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.20);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.20);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.50);




// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//$disposition='Content-Disposition: attachment;filename="Etiquetas COntrato "'..
header('Content-Disposition: attachment;filename="Etiquetas Contrato '.$_REQUEST['contrato'].'.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
