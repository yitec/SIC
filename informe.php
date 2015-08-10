<?php
require('includes/fpdf.php');

include('cnx/conexion.php');

conectar();


$result=mysql_query("Select * from tbl_contratos as a INNER JOIN tbl_clientes AS b ON a.id_cliente = b.id and a.id='".$_REQUEST['id']."'");





if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 

$row=mysql_fetch_assoc($result);

$result2=mysql_query("Select * from tbl_resultados as a Inner join tbl_analisis as b on a.id_analisis=b.id and a.consecutivo_contrato='".$row['consecutivo']."' inner join tbl_categoriasanalisis as c on b.id_analisis=c.id order by a.id_laboratorio,b.id_muestra ");

if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
} 


//tengo que revisar si algun resultado es certificado, en el caso que exista alguno debo imprimir el logo del ECA

$result4=mysql_query("select r.id_analisis,a.id_analisis,c.acreditado from tbl_resultados r, tbl_analisis a, tbl_categoriasanalisis c where r.consecutivo_contrato='".$row['consecutivo']."' and r.id_analisis=a.id and a.id_analisis=c.id and c.acreditado='"."1"."'");

if (mysql_num_rows($result4)>0){
$acreditado=1;	
}

//Cambio el formato a la fecha


$ano=substr($row['fecha_ingreso'], 0, 4);
$mes=substr($row['fecha_ingreso'], 5, 2);
$dia=substr($row['fecha_ingreso'], 8, 2);
$horas=substr($row['fecha_ingreso'], 10, 10);



$fechas=$dia."-".$mes."-".$ano." ".$horas;



$result5=mysql_query("Select * from tbl_infmuestras  where cons_contrato='".$row['consecutivo']."'");

$row5=mysql_fetch_assoc($result5);


$v_procedencia=explode(",",$row5['procedencia']);
	
	if(isset($row5['procedencia'])){

		$result6=mysql_query("select p.nombre, c.nombre, d.nombre from tbl_provincias p, tbl_cantones c, tbl_distritos d where p.id='".$v_procedencia[0]."' and c.id='".$v_procedencia[1]."' and d.id='".$v_procedencia[2]."' ");
$row6=mysql_fetch_array($result6);

	}

//datos de muestras oficiales
$result7=mysql_query("Select * from tbl_infoficiales  where cons_contrato='".$row['consecutivo']."'");

$row7=mysql_fetch_assoc($result7);



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
$pdf->Cell(190,5,'Centro de Investigación en Nutrición Animal',0,0,'C');
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
$pdf->Ln(0);
$pdf->Cell(190,5,'Código: R-TE-18',0,0,'L');
$pdf->Ln(0);
$pdf->Cell(185,5,'Fecha de Emisión:',0,0,'R');
$pdf->Ln(5);
$pdf->Cell(20,5,'Versión: 4',0);
$pdf->Ln(0);
$pdf->Cell(180,5,'29-05-2012',0,0,'R');
$pdf->Ln(0);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(185,5,'INFORME DE ENSAYO',0,0,'C');
$pdf->SetFont('Arial','',10);



//Cuadro info general de la solicitud
$pdf->Ln(5);
$pdf->Cell(190,5,'',1,0,'C');
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
$fecha=
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
$pdf->Cell(190,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,5,'INFORMACIÓN GENERAL DEL CLIENTE',0,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,10,'',1,0,'C');
$pdf->Ln(5);
$pdf->Cell(20,5,'Nombre:',0,0,'L');

$pdf->Cell(80,5,$row['nombre'],0,0,'L');
$pdf->Ln(5);
$pdf->Cell(190,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(27,5,'',1,0,'C');
$pdf->Cell(27,5,'',1,0,'C');
$pdf->Cell(67,5,'',1,0,'C');
$pdf->Cell(69,10,'',1,0,'C');
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
$pdf->Cell(190,50,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,5,'INFORMACIÓN GENERAL DE LA(S) MUESTRA(S)',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Tipo de muestra:',0,0,'L');
$pdf->Cell(70,5,$row5['tipo_alimento'],0,0,'L');
$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Nombre o descripción del producto:',0,0,'L');
$pdf->Cell(70,5,$row5['nombre_producto'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Presentación de la muestra:',0,0,'L');
$pdf->Cell(70,5,$row5['condicion_muestra'],0,0,'L');


$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Fecha de toma de la muestra(s):',0,0,'L');
$pdf->Cell(70,5,$row5['fecha_muestra'],0,0,'L');


$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Proceso de elaboración:',0,0,'L');
$pdf->Cell(70,5,$row5['proceso_elaboracion'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Parte de la planta/animal que compone:',0,0,'L');
$pdf->Cell(70,5,$row5['parte_planta'],0,0,'L');



$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Procedencia Geográfica:',0,0,'L');
if(isset($row5['procedencia'])){
$pdf->Cell(70,5,$row6[0]."-".$row6[1]."-".$row6[2],0,0,'L');	
}

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Importado de:',0,0,'L');
$pdf->Cell(70,5,$row5['importado'],0,0,'l');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'C');
$pdf->Cell(120,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(70,5,'Elaborado por:',0,0,'L');
$pdf->Cell(70,5,$row5['elaborado'],0,2,'L');

$pdf->Ln(0);
$pdf->MultiCell(0,5,'Forma de muestreo utilizada: '.$row5['forma_muestreo'],1,'L');


if(isset($row7['empresa'])&&strlen($row7['empresa'])>1){

//INFORMACIÓN de Muestras Oficiales

$pdf->Ln(5);
$pdf->Cell(190,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,5,'INFORMACIÓN DE MUESTRAS OFICIALES',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Empresa:',0,0,'L');
$pdf->Cell(70,5,$row7['empresa'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Lisencia DAA :',0,0,'L');
$pdf->Cell(70,5,$row7['lisencia'],0,0,'L');
$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Inspector:',0,0,'L');
$pdf->Cell(70,5,$row7['inspector'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Boleta de Campo:',0,0,'L');
$pdf->Cell(70,5,$row7['boleta'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Muestreado en:',0,0,'L');
$pdf->Cell(70,5,$row7['muestreado'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Fecha de elaboración:',0,0,'L');
$pdf->Cell(70,5,$row7['fecha_elaboracion'],0,0,'L');

$pdf->Ln(5);
$pdf->Cell(70,5,'',1,0,'L');
$pdf->Cell(120,5,'',1,0,'L');
$pdf->Ln(0);
$pdf->Cell(70,5,'Fecha de vencimiento:',0,0,'L');
$pdf->Cell(70,5,$row7['fecha_vencimiento'],0,2,'L');

}


//$pdf->AddPage();//*	***************************+Pagina 2*****************/



//Cuadro info general del Pago
/*$pdf->Ln(5);
$pdf->Cell(190,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,5,'INFORMACION DEL PAGO ',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(190,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(64,5,'',1,0,'C');
$pdf->Cell(64,5,'',1,0,'C');
$pdf->Cell(62,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(64,5,'Tipo Pago:',0,0,'C');
$pdf->Cell(64,5,'Total:',0,0,'C');
$pdf->Cell(62,5,'Resultados por correo:',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(64,5,'',1,0,'C');
$pdf->Cell(64,5,'',1,0,'C');
$pdf->Cell(62,5,'',1,0,'C');
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
$pdf->Cell(62,5,$row['envio_correo'],0,2,'C');
*/
//cuadros de observaciones

//Cuadro info general del Pago
$pdf->Ln(2);
$pdf->Cell(190,40,'',1,0,'C');
$pdf->SetFont('Arial','',8);
$pdf->Ln(0);
$pdf->Cell(190,5,'-El muestreo es responsabilidad del cliente y los resultados en este informe se refieren únicamente a las muestras ensayadas.',0,1,'L');
$pdf->Cell(190,5,'-Los resultados químicos  se reportan  utilizando un factor de cobertura  k=2 y una probabilidad de cobertura de 95% y corresponde ',0,1,'L');
$pdf->Cell(190,5,' al método de ensayo utilizado. La incertidumbre se expresa de forma relativa o como intervalos de confianza y reflejan la precisión del mesurando.',0,1,'L');
$pdf->Cell(108,5,' Para el análisis de energía bruta, el factor de conversión es 4,184 J/cal. El método de ',0,0,'L');
$pdf->SetFont('Arial','I',8);
$pdf->Cell(20,5,' Escherichia coli ',0,0,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(20,5,'  por NMP  ',0,1,'L');
$pdf->Cell(190,5,' detecta las cepas indol positivas (95 %).  ',0,1,'L');
$pdf->Cell(190,5,'-Documento no válido sin firmas originales y sello blanco del Centro de Investigaciones en Nutrición Animal. Cualquier copia parcial de',0,1,'L');
$pdf->Cell(190,5,' este documento invalida los resultados presentados en él.',0,1,'L');
$pdf->Cell(190,5,'-Se conserva una muestra de respaldo por 3 meses, excepto para las muestras con ensayos microbiológicos.',0,1,'L');
$pdf->SetY(270);
$pdf->Cell(0,5,'Página '.$pdf->PageNo(),0,0,'R');

//****************cuadro de analisis********

$pdf->AddPage();
$pdf->SetFont('Arial','B',8);
$pdf->Ln(10);
$pdf->Cell(190,38,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,10,'RESULTADOS DE LOS ENSAYOS',0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,5,'Acreditados=Verde',0,1,'L');
$pdf->Cell(190,5,'No Acreditados=Negro',0,1,'L');
$hoja=1;
$pdf->Cell(190,5,'Página # '.$hoja,0,1,'L');
$pdf->Cell(190,5,'Contrato # '.$row['consecutivo'],0,1,'L');
$pdf->Cell(190,5,'Cuando aplique  resultados en base fresca y seca, se indica el primero en base fresca y entre parétesis cuadrados en base seca',0,1,'L');
$pdf->Ln(8);

//*************************************************Acreeditados**********************************************
//*************************************************Acreeditados**********************************************
//*************************************************Acreeditados**********************************************
if($acreditado==1){
	$pdf->Image('img/acreditados.png',165,25,30);
}
$pdf->Cell(190,0,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(48,5,'',1,0,'C');
$pdf->Cell(20,5,'',1,0,'C');
$pdf->SetFillColor(200,220,255);
$pdf->Cell(86,5,'',1,0,'C');
$pdf->Cell(36,5,'',1,0,'C');
$pdf->SetFont('Arial','B',7);
$pdf->Ln(0);
$pdf->Cell(48,5,'Identificación Muestra',0,0,'C');
$pdf->Cell(20,5,'Laboratorio',0,0,'L');
$pdf->SetFillColor(200,220,255);

$pdf->Cell(86,5,'Análisis Solicitados',0,0,'C');
$pdf->Cell(36,5,'Resultados',0,2,'C');
$pdf->Ln(0);
$pdf->SetFont('Arial','',5);
$cont=0;
$linea=0;
$posicion=0;
while($row2=mysql_fetch_array($result2)){
	$cont++;
	if($cont>7){
	$pdf->SetY(270);
	$pdf->Cell(0,5,'Página '.$pdf->PageNo(),0,0,'R');
	
	$hoja++;
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',8);
	$pdf->Ln(10);
	$pdf->Cell(190,38,'',1,0,'C');
	$pdf->Ln(0);
	$pdf->Cell(190,10,'RESULTADOS DE LOS ENSAYOS',0,1,'C');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(190,5,'Acreditados=Verde',0,1,'L');
	$pdf->Cell(190,5,'No Acreditados=Negro',0,1,'L');
	$pdf->Cell(190,5,'Página # '.$hoja,0,1,'L');
	$pdf->Cell(190,5,'Contrato # '.$row['consecutivo'],0,1,'L');
	$pdf->Cell(190,5,'Cuando aplique  resultados en base fresca y seca, se indica el primero en base fresca y entre paréntesis cuadrados en base seca',0,0,'L');
	
	$pdf->Ln(8);
	if($acreditado==1){
		$pdf->Image('img/acreditados.png',165,25,30);
	}
	$pdf->Cell(190,0,'',1,0,'C');
	$pdf->Ln(0);
	$pdf->Cell(48,5,'',1,0,'C');
	$pdf->Cell(20,5,'',1,0,'C');
	$pdf->SetFillColor(200,220,255);
	$pdf->Cell(86,5,'',1,0,'C');
	$pdf->Cell(36,5,'',1,0,'C');
	$pdf->SetFont('Arial','B',7);
	$pdf->Ln(0);
	$pdf->Cell(48,5,'Identificación Muestra',0,0,'C');
	$pdf->Cell(20,5,'Laboratorio',0,0,'L');
	$pdf->SetFillColor(200,220,255);

	$pdf->Cell(86,5,'Análisis Solicitados',0,0,'C');
	$pdf->Cell(36,5,'Resultados',0,2,'C');
	$pdf->Ln(0);
	$pdf->SetFont('Arial','',8);
	$cont=0;
	$linea=0;		
	}
	$pdf->SetFont('Arial','',8);
	$result3=mysql_query("select nombre_muestra,codigo from tbl_muestras where id_contrato='".$row['consecutivo']."' and  numero_muestra='".$row2[22]."'  ");
	$row3=mysql_fetch_assoc($result3);
	$pdf->Ln($linea);
	$pdf->Cell(48,15,'',1,0,'C');
	$pdf->Cell(20,15,'',1,0,'C');
	$pdf->Cell(86,15,'',1,0,'L');
	$pdf->Cell(36,15,'',1,0,'C');
	if ($posicion==0){
		$pdf->Ln(0);
	}else{
		$pdf->Ln(0);
		$posicion=0;
	}
			if (strlen($row3['nombre_muestra'])>18){
				$pdf->SetTextColor(0,0,0);
				$pdf->SetFont('Arial','',8);
				$saltoi=strpos($row3['nombre_muestra'],"*");
				if (strlen($row3['nombre_muestra'])<=71){
					if ($saltoi>0){
						$inicio=substr($row3['nombre_muestra'], 0,$saltoi);
						$fin=substr($row3['nombre_muestra'], $saltoi+1,strlen($row3['nombre_muestra']));	
						$pdf->MultiCell(48,5,utf8_decode(" ".$inicio."\n ".$fin."\n" ),0,'L');
						//$pdf->MultiCell(48,5,$salto,0,'L');
					}else{
					$pdf->Cell(48,15,utf8_decode($row3['nombre_muestra']),1,1,'C');
					$var = $pdf->GetY();		
					$pdf->SetY($var-5);
					}
					$salto=0;	

				}else{
					$pdf->MultiCell(48,5,utf8_decode($row3['nombre_muestra']),1,'L');
				}
				$var = $pdf->GetY();		
				$pdf->SetY($var-10);
				$pdf->SetX(58);
				$pdf->SetFont('Arial','',8);
			}else{
				$pdf->Cell(48,15,$row3['nombre_muestra'],1,0,'C');		
			}


$pdf->Ln(0);	
$pdf->SetX(58);
		
	if($row2[2]==1){
		$pdf->MultiCell(20,5,"Química\n".$row3['codigo']."\n ",0,1,'L');
		//$pdf->Cell(18,10,'Química'\n,1,0,'C');
	}
	if($row2[2]==2){
		$pdf->MultiCell(20,5,"Microbiología\n".$row3['codigo']."\n ",0,1,'L');		
		//$pdf->Cell(18,10,'Microbiología',1,0,'C');
	}
	if($row2[2]==3){
		$pdf->MultiCell(20,5,"Bromatología\n".$row3['codigo']."\n ",0,1,'L');		
		//$pdf->Cell(18,10,'Bromatología',1,0,'C');	
	}
	$pdf->Ln(-15);	
	
	$pdf->SetX(78);
	
	if($row2[39]==1){//si es acreditado lo imprimo en verde
	

		//si es un metodo de caracteres muy largos bajo la letra  a 4
		if (strlen($row2[4])>=50){
			$pdf->SetTextColor(39,210,75);
			$pdf->SetFont('Arial','',8);
			if($row2['37']=="Salmonella sp"){
			$pdf->SetFont('Arial','IUB',8);
			}
			$pdf->MultiCell(86,5,$row2[37]."\n".$row2[4]."\n\n",0,'L');
			$pdf->Ln(-10);
			$pdf->SetX(154);
			$pdf->SetFont('Arial','',8);
		}else{
			$pdf->SetTextColor(39,210,75);
			$pdf->MultiCell(86,5,$row2[37]."\n".$row2[4]."\n\n",0,'L');
			$pdf->Ln(-15);
			$pdf->SetX(154);
			$pdf->SetFont('Arial','',8);
		}
		
		
	}else{
		//si es un metodo de caracteres muy largos bajo la letra  a 7
		if (strlen($row2[4])>=50){
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','',8);
			$pdf->MultiCell(86,5,$row2[37]."\n".$row2[4]."\n",0,'L');
			$pdf->Ln(-10);
			$pdf->SetX(154);
			$pdf->SetFont('Arial','',8);
		}else{
			$pdf->SetTextColor(0,0,0);
			$pdf->MultiCell(86,5,$row2[37]."\n".$row2[4]."\n",0,'L');
			$pdf->Ln(-10);
			$pdf->SetX(154);
		}
	}
	$var = $pdf->GetY();
	if($cont==1){		
		$pdf->SetY($var+5);
	}
	
	//pregunto si hay resultado en base fresca, si la hay primero va el resultado en base fresca y luego seca
	//valor corregido&incertidumbre
	$r1="";
	$r2="";
	if($row2[7]<>""){	
	
		
		if ($row2[6]<>""){//pregunto si tiene resultado en base seca
			
				if ($row2[16]<>""){	//pregunto si tiene valor corregido
			
			$resultado="(".utf8_decode($row2[16]).$row2[10].")".utf8_decode($row2[11])." [".utf8_decode($row2[6]).$row2[9]."]".utf8_decode($row2[11]);	
			$r1="(".utf8_decode($row2[16])." ".$row2[10].") ".utf8_decode($row2[11]);
			$r2=" [".utf8_decode($row2[6])." ".$row2[9]."] ".utf8_decode($row2[11]);	
				}else{
			$resultado="(".utf8_decode($row2[7]).$row2[10].")".utf8_decode($row2[11])." [".utf8_decode($row2[6]).$row2[9]."]".utf8_decode($row2[11]);	
			$r1="(".$row2[7]." ".$row2[10].") ".utf8_decode($row2[11]);
			$r2=" [".$row2[6]." ".$row2[9]."] ".utf8_decode($row2[11]);	
				}
		
		}else{
			
				
				
				if ($row2[16]<>""){	//pregunto si tiene valor corregido			
					$resultado="(".utf8_decode($row2[16]).$row2[10].")".$row2[11]." [".utf8_decode($row2[5]).$row2[8]."]".utf8_decode($row2[11]);
					$r1="(".$row2[16]." ".$row2[10].") ".$row2[11];
					//$r2=" [".$row2[5].$row2[8]."]".utf8_decode($row2[11]);	
			
			}else{
					$resultado="(".utf8_decode($row2[7]).$row2[10].")".$row2[11]." [".utf8_decode($row2[5]).$row2[8]."]".utf8_decode($row2[11]);	
					$r1="(".$row2[7]." ".$row2[10].") ".$row2[11];
					//$r2=" [".$row2[5].$row2[8]."]".utf8_decode($row2[11]);	
			}
		
			
		
		
		}//fin base seca
		
	
	}else{
		
		// no tiene resultado en base fresca	
		if ($row2[6]<>""){// pregunto si hay resultado en base seca	
		
			if ($row2[16]<>""){	
				$resultado="(".$row2[16]." ".$row2[9].") ".utf8_decode($row2[11])	;
				$r1=$resultado;
			}else{
				$resultado="(".$row2[6]." ".$row2[9].") ".utf8_decode($row2[11])	;
				$r1=$resultado;				
			}
		}else{
			if ($row2[16]<>""){	
				$resultado="(".$row2[16]." ".$row2[8].") ".utf8_decode($row2[11])	;
				$r1=$resultado;				
			}else{
				$resultado="(".$row2[5]." ".$row2[8].") ".utf8_decode($row2[11])	;
				$r1=$resultado;				
			}
		
		}//end if resultado base seca
	}//end if resultado base fresca
	
	
	//quito los saltos de linea del final
	$r1 =str_replace("\n", "", $r1);
	$r2 =str_replace("\n", "", $r2);

	
	
	$pdf->SetTextColor(0,0,0);
	//Si el análisis es de microscopia imprimo una multicelda por ser muy largo el resultado
	if ($row2['37']=="Microscopía"){
		$pdf->Cell(48,10,"Ver siguiente línea",0,0,'C');
		$pdf->Ln(10);
		$pdf->MultiCell(0,5,'Resultado Microscopía: '.$resultado,1,2,'L');
		$posicion=1;	
				

	}else{
	
		if (strlen($resultado)<=6){
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','',8);
		$var = $pdf->GetY();		
		$pdf->SetY($var-25);
		$var2 = $pdf->GetX();		
		$pdf->SetX($var2+154);
		$pdf->MultiCell(36,5,$r1."\n ",0,'L');
			//$pdf->Cell(56,10,$resultado,1,0,'C');
			$pdf->SetFont('Arial','',8);
		}else{
		$var = $pdf->GetY();
			if($cont==1){		
				$pdf->SetY($var-5);
			}else{
				$pdf->SetY($var);
			}
		$pdf->SetFont('Arial','',8);	
		$var2 = $pdf->GetX();		
		$pdf->SetX($var2+154);
		$pdf->MultiCell(36,5,$r1."\n ".$r2."\n\n ",0,'L');		
			//$pdf->Cell(56,10,$resultado,1,0,'C');
		}

	}


}//end while


$pdf->SetFont('Arial','B',8);
$pdf->Ln(20);
$pdf->Cell(190,44,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,10,'Firmas Responsables',0,1,'C');
$pdf->Ln(15);
$pdf->Cell(42,5,'______________________',0,0,'C');
$pdf->Cell(58,5,'______________________',0,0,'C');
$pdf->Cell(38,5,'_______________________',0,0,'C');
$pdf->Cell(58,5,'_______________________',0,1,'C');

$pdf->SetFont('Arial','',6);
$pdf->Cell(42,5,'Responsable Laboratorio Química',0,0,'C');
$pdf->Cell(58,5,'Ingeniero(a) Agrónomo Zootecnista Responsable',0,0,'C');
$pdf->Cell(38,5,'Responsable Laboratorio Bromatología ',0,0,'L');
$pdf->Cell(58,5,'Responsable Laboratorio Microbiología',0,0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',6);
$pdf->Cell(190,5,'Las firmas indicadas en cada informe solo corresponden a los análisis solicitados y a los laboratorios que intervienen en su ejecución.',0,0,'C');

$pdf->SetFont('Arial','B',8);
$pdf->Ln(20);
$pdf->Cell(190,40,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,10,'Firma Recibido',0,1,'C');
$pdf->Ln(15);
$pdf->Cell(95,5,'________________________________________',0,0,'C');
$pdf->Cell(95,5,'________________________________________',0,1,'C');

$pdf->SetFont('Arial','',6);
$pdf->Cell(95,5,'Nombre',0,0,'C');
$pdf->Cell(95,5,'Fecha',0,1,'C');


$pdf->SetFont('Arial','',8);	
$pdf->SetY(270);
$pdf->Cell(0,5,'Página '.$pdf->PageNo(),0,0,'R');


$pdf->Output();

function color(){
$this->SetFillColor(230,230,0);	
	
}



?>

