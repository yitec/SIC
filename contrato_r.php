<?php
session_start();
require('includes/fpdf.php');

include('cnx/conexion.php');

conectar();
$contrato=$_REQUEST['contrato'];

$totr=0;

//Primero verifico si lleva info de muestra, forrajes y oficiales
$result=mysql_query("select * from tbl_infmuestras where cons_contrato='".$_REQUEST['contrato']."'");
$totr=mysql_num_rows($result);
if ($totr>=1){
	$muestras=1;
}else{
	$muestras=0;
}
mysql_free_result($result);




$result=mysql_query("select  * from tbl_infoficiales where cons_contrato='".$_REQUEST['contrato']."'");
$totr=mysql_num_rows($result);

if ($totr>=1){
	$oficiales=1;
}else{
	$oficiales=0;
}

mysql_free_result($result);

$result=mysql_query("select * from tbl_infforrajes where cons_contrato='".$_REQUEST['contrato']."'");
if (mysql_num_rows($result)>=1){
	$forrajes=1;
}else{
	$forrajes=0;
}



mysql_free_result($result);
if($muestras==1&&$oficiales==1&&$forrajes==1){

$result=mysql_query("SELECT * FROM tbl_contratos AS a INNER JOIN tbl_infmuestras AS b ON a.consecutivo = b.cons_contrato and a.consecutivo='".$contrato."' inner JOIN tbl_infforrajes as c on a.consecutivo = c.cons_contrato inner JOIN tbl_infoficiales as d on a.consecutivo = d.cons_contrato inner join tbl_clientes as e on a.id_cliente=e.id");

}

if($muestras==1&&$oficiales==1&&$forrajes==0){

$result=mysql_query("SELECT * FROM tbl_contratos AS a INNER JOIN tbl_infmuestras AS b ON a.consecutivo = b.cons_contrato and a.consecutivo='".$contrato."' inner JOIN tbl_infoficiales as d on a.consecutivo = d.cons_contrato inner join tbl_clientes as e on a.id_cliente=e.id");

}

if($muestras==1&&$oficiales==0&&$forrajes==1){

$result=mysql_query("SELECT * FROM tbl_contratos AS a INNER JOIN tbl_infmuestras AS b ON a.consecutivo = b.cons_contrato and a.consecutivo='".$contrato."' inner JOIN tbl_infforrajes as c on a.consecutivo = c.cons_contrato  inner join tbl_clientes as e on a.id_cliente=e.id");

}

if($muestras==0&&$oficiales==1&&$forrajes==1){

$result=mysql_query("SELECT * FROM tbl_contratos AS a  inner JOIN tbl_infforrajes as c on a.consecutivo = c.cons_contrato and a.consecutivo='".$contrato."' inner JOIN tbl_infoficiales as d on a.consecutivo = d.cons_contrato inner join tbl_clientes as e on a.id_cliente=e.id");
}

if($muestras==1&&$oficiales==0&&$forrajes==0){

$result=mysql_query("SELECT * FROM tbl_contratos AS a INNER JOIN tbl_infmuestras AS b ON a.consecutivo = b.cons_contrato and a.consecutivo='".$contrato."'  inner join tbl_clientes as e on a.id_cliente=e.id");

}

if($muestras==0&&$oficiales==1&&$forrajes==0){

$result=mysql_query("SELECT * FROM tbl_contratos AS a  inner JOIN tbl_infoficiales as d on a.consecutivo = d.cons_contrato and a.consecutivo='".$contrato."' inner join tbl_clientes as e on a.id_cliente=e.id");
}

if($muestras==0&&$oficiales==0&&$forrajes==1){

$result=mysql_query("SELECT * FROM tbl_contratos AS a   inner JOIN tbl_infforrajes as c on a.consecutivo = c.cons_contrato and a.consecutivo='".$contrato."' inner join tbl_clientes as e on a.id_cliente=e.id");
}
	
if($muestras==0&&$oficiales==0&&$forrajes==0){

$result=mysql_query("SELECT * FROM tbl_contratos AS a inner join tbl_clientes as e on a.id_cliente=e.id and a.consecutivo='".$contrato."'");
}





if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
		

$row=mysql_fetch_assoc($result);

//averiguo la procedencia geografica
if($muestras==1){
	$v_procedencia=explode(",",$row['procedencia']);
	
	if(isset($row['procedencia'])){

		$result3=mysql_query("select p.nombre, c.nombre, d.nombre from tbl_provincias p, tbl_cantones c, tbl_distritos d where p.id='".$v_procedencia[0]."' and c.id='".$v_procedencia[1]."' and d.id='".$v_procedencia[2]."' ");
$row3=mysql_fetch_array($result3);

	}
}//fin procedencia geogrfica

$result2=mysql_query("select * from tbl_analisis as a inner join tbl_categoriasanalisis as b on a.id_analisis=b.id and a.id_contrato='".$contrato."' inner JOIN tbl_laboratorios as c on a.id_laboratorio=c.id order by a.id_laboratorio");




//Cambio el formato a la fecha


$ano=substr($row['fecha_ingreso'], 0, 4);
$mes=substr($row['fecha_ingreso'], 5, 2);
$dia=substr($row['fecha_ingreso'], 8, 2);
$horas=substr($row['fecha_ingreso'], 10, 10);



$fechas=$dia."-".$mes."-".$ano." ".$horas;






$pdf=new FPDF();
$pdf->AddPage();
$pdf->Image('img/ucr_informe.png',12,16,17);
$pdf->Image('img/cina_informe.png',180,17,17);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(190,30,'',1,0,'C');
$pdf->Ln(5);
$pdf->Cell(190,5,'UNIVERSIDAD DE COSTA RICA',0,0,'C');
$pdf->Ln(6);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,5,'Centro de Investigación en Nutricion Animal',0,0,'C');
$pdf->Ln(7);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,5,'Teléfono (506) 2511-2049 ó (506)2511-2055. Fax: 2234-2415',0,0,'C');
$pdf->Ln(7);
$pdf->Cell(190,3,'Ciudad de la investigación, Sabanilla, San José, Costa Rica',0,0,'C');
//Cuandro solicitud servicio
$pdf->Ln(8);
$pdf->Cell(190,10,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(45,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(45,10,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(150,10,'',1,0,'C');
$pdf->Ln(2);
$pdf->Cell(190,3,'Código: R-GE-07',0,0,'L');
$pdf->Ln(0);
$pdf->Cell(185,3,'Fecha de Emisión:',0,0,'R');


$pdf->Ln(4);
$pdf->Cell(20,3,'Versión: 10',0);
$pdf->Ln(0);
$pdf->Cell(180,3,'29-05-2012',0,0,'R');

$pdf->Ln(0);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(185,3,'SOLICITUD DE SERVICIO',0,0,'C');
$pdf->SetFont('Arial','',10);


$pdf->Cell(20,3,$fecha,0);

//Cuadro info general de la solicitud
$pdf->Ln(4);
$pdf->SetFillColor(250,106,11);
$pdf->Cell(190,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,5,'',1,0,'C');
$pdf->SetFillColor(250,106,11);
$pdf->Ln(0);
$pdf->Cell(190,5,'INFORMACIÓN GENERAL DE LA SOLICITUD',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(63,5,'',1,0,'C');
$pdf->Cell(63,5,'',1,0,'C');
$pdf->Cell(64,5,'',1,0,'C');

$pdf->Ln(0);
$pdf->Cell(63,5,'Consecutivo',0,0,'C');
$pdf->Cell(63,5,'Fecha de recepción de muestras:',0,0,'C');
$pdf->Cell(64,5,'Tipo de cliente:',0,1,'C');

$pdf->Ln(0);
$pdf->Cell(63,5,'',1,0,'C');
$pdf->Cell(63,5,'',1,0,'C');
$pdf->Cell(64,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(63,5,$row['consecutivo'],0,0,'C');
$pdf->Cell(63,5,$fechas,0,0,'C');
$pdf->Cell(64,5,utf8_decode($row['tipo_cliente']),0,1,'C');


//Cuadro info general del cliente
$pdf->Ln(0);
$pdf->Cell(190,10,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,5,'INFORMACIÓN GENERAL DEL CLIENTE',0,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,5,'',1,0,'C');
$pdf->Ln(5);
$pdf->Cell(20,5,'Nombre:',0,0,'L');
$pdf->Cell(80,5,$row['nombre'],0,0,'L');
$pdf->Ln(5);
$pdf->Cell(190,10,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(27,5,'',1,0,'C');
$pdf->Cell(27,5,'',1,0,'C');
$pdf->Cell(67,5,'',1,0,'C');
$pdf->Cell(69,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(27,5,'Teléfono:',0,0,'C');
$pdf->Cell(27,5,'Fax:',0,0,'C');
$pdf->Cell(67,5,'Correo Electrónico:',0,0,'C');
$pdf->Cell(69,5,'Nombre Solicitante:',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(27,5,'',1,0,'C');
$pdf->Cell(27,5,'',1,0,'C');
$pdf->Cell(67,5,'',1,0,'C');
$pdf->Cell(69,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(27,5,$row['tel_fijo'],0,0,'C');
$pdf->Cell(27,5,$row['fax'],0,0,'C');
$pdf->Cell(67,5,$row['correo'],0,0,'C');
$pdf->Cell(69,5,utf8_decode($row['nombre_solicitante']),0,2,'C');

//INFORMACIÓN general de las muestras
$pdf->Ln(5);
$pdf->Cell(190,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,5,'INFORMACIÓN GENERAL DE LA(S) MUESTRA(S)',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Tipo de muestra:',0,0,'L');
$pdf->Cell(70,5,$row['tipo_alimento'],0,0,'L');
$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Nombre o descripción del producto:',0,0,'L');
$pdf->Cell(70,5,$row['nombre_producto'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Presentación de la muestra:',0,0,'L');
$pdf->Cell(70,5,$row['condicion_muestra'],0,0,'L');


$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Fecha de toma de la muestra(s):',0,0,'L');
$pdf->Cell(70,5,$row['fecha_muestra'],0,0,'L');





$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Proceso de elaboración:',0,0,'L');
$pdf->Cell(70,5,$row['proceso_elaboracion'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Parte de la planta/animal que compone:',0,0,'L');
$pdf->Cell(70,5,$row['parte_planta'],0,0,'L');



$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Procedencia Geográfica:',0,0,'L');
if(isset($row['procedencia'])){
$pdf->Cell(70,5,$row3[0]."-".$row3[1]."-".$row3[2],0,0,'L');	
}
$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Importado de:',0,0,'L');
$pdf->Cell(70,5,$row['importado'],0,0,'l');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Elaborado por:',0,0,'L');
$pdf->Cell(70,5,$row['elaborado'],0,2,'L');

$pdf->Ln(0);
$pdf->MultiCell(0,5,'Forma de muestreo utilizada: '.$row['forma_muestreo'],1,'L');

//$pdf->AddPage();//****************************+Pagina 2*****************/

if(isset($row['tipo'])&&strlen($row['tipo'])>1){
//INFORMACIÓN de forrajes
$pdf->Ln(10);
$pdf->Cell(190,30,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,5,'INFORMACIÓN DE FORRAJES',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Tipo de forraje:',0,0,'L');
$pdf->Cell(70,5,$row['tipo'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Origen del forraje :',0,0,'L');
$pdf->Cell(70,5,$row['origen'],0,0,'L');
$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Fertilización:',0,0,'L');
$pdf->Cell(70,5,$row['fertilizacion'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Aplicación del Fertilizante:(Kg/Ha)',0,0,'L');
$pdf->Cell(70,5,$row['aplicacion'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Edad en días:',0,0,'L');
$pdf->Cell(70,5,$row['edad'],0,2,'L');


}//end if

if(isset($row['empresa'])&&strlen($row['empresa'])>1){

//INFORMACIÓN de Muestras Oficiales

$pdf->Ln(10);
$pdf->Cell(190,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,5,'INFORMACIÓN DE MUESTRAS OFICIALES',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Empresa:',0,0,'L');
$pdf->Cell(70,5,$row['empresa'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Licencia DAA :',0,0,'L');
$pdf->Cell(70,5,$row['lisencia'],0,0,'L');
$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Inspector:',0,0,'L');
$pdf->Cell(70,5,$row['inspector'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Boleta de Campo:',0,0,'L');
$pdf->Cell(70,5,$row['boleta'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Muestreado en:',0,0,'L');
$pdf->Cell(70,5,$row['muestreado'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Fecha de elaboración:',0,0,'L');
$pdf->Cell(70,5,$row['fecha_elaboracion'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Fecha de vencimiento:',0,0,'L');
$pdf->Cell(70,5,$row['fecha_vencimiento'],0,0,'L');

}

//Cuadro info general del Pago
$pdf->Ln(10);
$pdf->Cell(190,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,5,'INFORMACIÓN DEL PAGO ',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(64,5,'',1,0,'C');
$pdf->Cell(64,5,'',1,0,'C');
$pdf->Cell(40,5,'',1,0,'C');
$pdf->Cell(22,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(64,5,'Tipo Pago:',0,0,'C');
$pdf->Cell(64,5,'Total:',0,0,'C');
$pdf->Cell(40,5,'Resultados por correo:',0,0,'C');
$pdf->Cell(22,5,'Factura',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(64,5,'',1,0,'C');
$pdf->Cell(64,5,'',1,0,'C');
$pdf->Cell(40,5,'',1,0,'C');
$pdf->Cell(22,5,'',1,0,'C');
$pdf->Ln(0);
if ($row['tipo_pago']=="Rebajar"){
	$pdf->Cell(64,5,'Rebajo de Partida',0,0,'C');
}else{
	$pdf->Cell(64,5,$row['tipo_pago'],0,0,'C');
}

if ($row['tipo_pago']=="Exonerado"){
	$pdf->Cell(64,5,'0',0,0,'C');
}else{
	$pdf->Cell(64,5,number_format($row['monto_total'],2,',','.'),0,0,'C');
}
$pdf->Cell(40,5,$row['envio_correo'],0,0,'C');
$pdf->Cell(22,5,$row['factura'],0,2,'C');

//cuadros de observaciones

//Cuadro info general de Observaciones
$pdf->Ln(5);
$pdf->Cell(190,50,'',1,0,'C');
$pdf->SetFont('Arial','',8);
$pdf->Ln(0);
$pdf->Cell(190,5,'*El cliente se hace responsable del muestreo. Las muestras deben de cumplir con los requisitos establecidos por el CINA que se encuentran en',0,1,'L');
$pdf->Cell(190,5,'el documento "Información y requisitos que deben reunir las muestras de alimentos, materias primas y forrajes para ser analizadas en el CINA"',0,1,'L');
$pdf->Cell(190,5,'el cual se puede encontrar en la página Web : www.cina.ucr.ac.cr',0,1,'L');
$pdf->Cell(190,5,'**El pago puede ser realizado únicamente en colones. Se puede hacer mediante a) Efectivo, b) Cheque (el mismo debe de venir girado ',0,1,'L');
$pdf->Cell(190,5,'a nombre de FUNDEVI) ó c) por medio de tarjeta (VISA, MASTER CARD O BANCO POPULAR), d) depósito bancario a la cuenta corriente ',0,1,'L');
$pdf->Cell(190,5,'No. 100-01-000-140077-9 del BNCR o e) transferencia electrónica a la cuenta cliente No. 15100010011400776 del BNCR. ',0,1,'L');
$pdf->Cell(190,5,'Favor indicar en el detalle "pago de análisis Cód. 2281-00".',0,1,'L');
$pdf->Cell(190,5,'***Cuando el cliente autoriza el resultado se envía al correo arriba indicado. Para ello el 100% del costo de los análisis debe de haber sido cancelado.',0,1,'L');
$pdf->Cell(190,5,'El informe válido es el impreso con las firmas de los responsables y el sello de agua, que el cliente deberá de pasar a retirar  al CINA.',0,1,'L');
$pdf->Cell(190,5,'El cliente se hace responsable de la confidencialidad de los resultados enviados vía electrónica.',0,2,'L');


$pdf->Ln(0);
$pdf->Cell(190,10,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,5,'Esta solicitud generará un único informe de ensayo',0,1,'L');
$pdf->Cell(190,5,'Al finalizar el servicio de análisis la secretaria se lo informará vía telefónica y al correo electrónico arriba indicado.',0,1,'L');


$pdf->Ln(0);
$pdf->Cell(190,15,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,5,'Se ha creado una base de datos sobre la composición nutricional de las materias primas para fines de investigación y enseñanza.',0,1,'L');
$pdf->Cell(190,5,'Deseamos solicitarle nos permita incorporar los resultados de los análisis que usted está solicitando en nuestra base de datos,',0,2,'L');
$pdf->Cell(190,5,'siendo dicha información tabulada de forma anónima. ¿Autoriza usted el uso de sus datos?    SI___ NO___',0,2,'L');


$pdf->Ln(0);
//$pdf->Cell(190,10,'',1,0,'C');
$pdf->Ln(0);
//$pdf->Cell(190,5,'Observaciones: '.$row['observaciones'],0,2,'L');
$pdf->MultiCell(0,5,'Observaciones: '.$row['observaciones'],1,'L');


$pdf->Ln(15);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(20,5,'Firma:',0,0,'L');
$pdf->Cell(70,5,'________________',0,0,'L');
$pdf->Cell(50,5,'Recibió Muestras:  '.$_SESSION['nombre_usuario'],0,0,'L');
$pdf->Cell(70,5,'________________',0,0,'L');


//****************cuadro de analisis********

$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->Ln(10);
$pdf->Cell(190,20,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,10,'INFORMACIÓN ANÁLISIS',0,0,'C');
$pdf->Ln(10);
$pdf->Cell(190,10,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(22,10,'',1,0,'C');
$pdf->Cell(48,10,'',1,0,'C');
$pdf->Cell(18,10,'',1,0,'C');
$pdf->Cell(82,10,'',1,0,'C');
$pdf->Cell(20,10,'',1,0,'C');
$pdf->Ln(3);
$pdf->Cell(22,5,'Código Muestra',0,0,'C');
$pdf->Cell(48,5,'Nombre Muestra',0,0,'C');
$pdf->Cell(18,5,'Laboratorio',0,0,'C');
$pdf->Cell(82,5,'Análisis Solicitados',0,0,'C');
$pdf->Cell(20,5,'Costo Análisis',0,2,'C');
$pdf->Ln(2);
//$linea=0;
while($row2=mysql_fetch_array($result2)){
//	$pdf->Ln($linea);
$result4=mysql_query("select nombre_muestra from tbl_muestras where id_contrato='".$row['consecutivo']."' and  numero_muestra='".$row2[4]."'");	
	$row4=mysql_fetch_assoc($result4);
	//si el nombre de muestra es mayor a 18 caracteres lo imprimo en 2 lineas
		$mayor=false;
	if (strlen($row4['nombre_muestra'])>18){
		$mayor=true;
	}		
	if ($mayor==true){		
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(22,10,$row2[2],1,0,'C');
		$pdf->SetFont('Arial','',8);	
		$saltoi=strpos($row4['nombre_muestra'],"*");	
		if ($saltoi>0){
			$inicio=substr($row4['nombre_muestra'], 0,$saltoi);
			$fin=substr($row4['nombre_muestra'], $saltoi+1,strlen($row4['nombre_muestra']));	
			$pdf->MultiCell(48,5,utf8_decode(" ".$inicio."\n ".$fin."\n" ),1,'L');
			//$pdf->Cell(48,10,utf8_decode($row4['nombre_muestra']),1,1,'C');	
		}else{
			if (strlen($row4['nombre_muestra'])<=33){
				$pdf->MultiCell(48,10,utf8_decode($row4['nombre_muestra']),1,'L');
			}else{
				$pdf->SetFont('Arial','',5);	
				$pdf->MultiCell(48,10,utf8_decode($row4['nombre_muestra']),1,'L');
			}
		}
		$pdf->SetFont('Arial','',8);		
		$var = $pdf->GetY();		
		$pdf->SetY($var-10);
		$var2 = $pdf->GetX();		
		$pdf->SetX($var2+70);
		$pdf->Cell(18,10,$row2[30],1,0,'C');
		$pdf->MultiCell(82,5,$row2[19]."\n".$row2[20],1,'L');
		$pdf->Ln(-10);	
		$pdf->SetX(180);	
		// SI el precio del analisis es 0 lo imprimo como incluido
		if ($row2[6]==0){
			$pdf->Cell(20,10,'Incluido',1,1,'C');
		}else{
			$pdf->Cell(20,10,$row2[6],1,1,'C');
		}

	}else{
		$pdf->SetFont('Arial','',8);				
		$pdf->Cell(22,10,$row2[2],1,0,'C');
		$pdf->Cell(48,10,utf8_decode($row4['nombre_muestra']),1,0,'C');	
		$pdf->Cell(18,10,$row2[30],1,0,'C');
		$pdf->MultiCell(82,5,$row2[19]."\n".$row2[20],1,'L');
		$pdf->Ln(-10);	
		$pdf->SetX(180);
		// SI el precio del analisis es 0 lo imprimo como incluido
		if ($row2[6]==0){
			$pdf->Cell(20,10,'Incluido',1,1,'C');
		}else{
			$pdf->Cell(20,10,$row2[6],1,1,'C');
		}

	}

}//end while
$pdf->Ln(0);
$pdf->Cell(22,10,'',0,0,'C');
$pdf->Cell(48,10,'',0,0,'C');
$pdf->Cell(18,10,'',0,0,'C');
$pdf->Cell(82,10,'',1,0,'C');
$pdf->Cell(20,10,'',1,0,'C');
$pdf->Ln(5);
$pdf->Cell(22,5,'',0,0,'C');
$pdf->Cell(48,5,'',0,0,'C');
$pdf->Cell(18,5,'',0,0,'C');
$pdf->Cell(82,5,'Total:',0,0,'R');
$pdf->Cell(20,5,number_format($row['monto_total'],2,',','.'),0,2,'C');


$pdf->Output();

function color(){
$this->SetFillColor(230,230,0);	
	
}



?>
