<?php
require('includes/fpdf.php');

include('cnx/conexion.php');

conectar();


$result=mysql_query("Select a.*,b.nombre,b.direccion,b.tipo_cliente,b.tel_fijo,b.correo from tbl_contratos as a INNER JOIN tbl_clientes AS b ON a.id_cliente = b.id and a.id='".$_REQUEST['id']."'");
if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 

$row=mysql_fetch_assoc($result);

//busco todos los resultados
$result2=mysql_query("Select res.consecutivo_contrato,ana.id_laboratorio,cat.nombre,res.metodo,res.resultado,res.base_seca,
res.base_fresca,res.incertidumbre, res.incertidumbre_fresca,res.incertidumbre_seca,
res.unidades,res.fecha_aprobacion,res.valor_correjido,ana.id_analisis,ana.id_muestra,cat.acreditado
from tbl_resultados res  Inner join tbl_analisis as ana 
on res.id_analisis=ana.id inner join tbl_categoriasanalisis as cat on ana.id_analisis=cat.id
where
res.consecutivo_contrato='".$row['consecutivo']."'  order by res.id_laboratorio,ana.id_muestra ");

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
$pdf->Image('img/ucr_informe.png',12,12,16);
$pdf->Image('img/cina_informe.png',180,13,16);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,20,'',1,0,'C');
$pdf->Ln(2);
$pdf->Cell(190,5,'UNIVERSIDAD DE COSTA RICA',0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(190,5,'Centro de Investigación en Nutrición Animal',0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,5,'Teléfono (506) 2511-2049 ó (506)2511-2055. Fax: 2234-2415',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(190,3,'Ciudad de la investigación, Sabanilla, Montes de Oca, San José, Costa Rica',0,1,'C');
//Cuandro solicitud servicio


$pdf->Cell(190,15,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(45,10,'',0,0,'C');
$pdf->Ln(0);
$pdf->Cell(45,15,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(150,15,'',1,0,'C');
$pdf->SetFont('Arial','B',8);
$pdf->Ln(0);
$pdf->Cell(45,10,'Código:',0,0,'C');
$pdf->Ln(5);
$pdf->Cell(45,10,'R-TE-18',0,0,'C');
$pdf->SetFont('Arial','',8);
$pdf->Ln(-5);
$pdf->SetX(160);
$pdf->Cell(40,5,'Versión: 05',1,0,C);
$pdf->Ln(5);
$pdf->Cell(185,5,'Fecha de Emisión:',0,0,'R');
$pdf->Ln(5);
$pdf->Cell(180,5,'10-11-2015',0,0,'R');
$pdf->Ln(-5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(185,10,'INFORME DE ENSAYO',0,0,'C');
$pdf->SetFont('Arial','B',8);



//Cuadro info general de la solicitud
$pdf->Ln(20);
$pdf->Cell(190,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->SetFillColor(241,243,246);
$pdf->Cell(190,5,'INFORMACIÓN GENERAL DE LA SOLICITUD',1,0,'C',true);
$pdf->SetFont('Arial','',8);
$pdf->Ln(5);

$pdf->Ln(0);
$pdf->Cell(63,5,'N° Contrato',1,0,'C');
$pdf->Cell(63,5,'Fecha de recepción de muestras:',1,0,'C');
$pdf->Cell(64,5,'Tipo de cliente:',1,1,'C');

$pdf->Ln(0);
$pdf->Cell(63,5,$row['consecutivo'],1,0,'C');
$pdf->Cell(63,5,$fechas,1,0,'C');
$pdf->Cell(64,5,utf8_decode($row['tipo_cliente']),1,1,'C');


//Cuadro info general del cliente
$pdf->Ln(10);
$pdf->Cell(190,5,'',1,0,'C');
$pdf->Ln(0);
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(241,243,246);
$pdf->Cell(190,5,'INFORMACIÓN GENERAL DEL CLIENTE',1,0,'C',true);
$pdf->SetFont('Arial','',8);

$pdf->Ln(5);
$pdf->Cell(190,5,'Nombre de la empresa: '.$row['nombre'],1,1,'L');
$pdf->Cell(190,5,'Nombre Solicitante: '.utf8_decode($row['nombre_solicitante']),1,1,'L');
$pdf->Cell(190,5,'Teléfono: '.$row['tel_fijo'],1,1,'L');
$pdf->Cell(190,5,'Dirección: '.$row['direccion'],1,1,'L');
$pdf->Cell(190,5,'Correo Electrónico: '.$row['correo'],1,1,'L');



//INFORMACIÓN general de las muestras
$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(241,243,246);
$pdf->Cell(190,5,'INFORMACIÓN GENERAL DE LA(S) MUESTRA(S)',1,1,'C',true);
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,5,'Tipo de muestra: '.$row5['tipo_alimento'],1,1,'L');
$pdf->Cell(190,5,'Nombre o descripción del producto: '.$row5['nombre_producto'],1,1,'L');
$pdf->Cell(190,5,'Presentación de la muestra: '.$row5['condicion_muestra'],1,1,'L');
$pdf->Cell(190,5,'Fecha de toma de la muestra(s): '.$row5['fecha_muestra'],1,1,'L');
$pdf->Cell(190,5,'Proceso de elaboración: '.$row5['proceso_elaboracion'],1,1,'L');
$pdf->Cell(190,5,'Parte de la planta/animal que compone: '.$row5['parte_planta'],1,1,'L');
if(isset($row5['procedencia'])){
	$pdf->Cell(190,5,'Procedencia Geográfica: '.$row6[0].'-'.$row6[1].'-'.$row6[2],1,1,'L');

}else{
	$pdf->Cell(190,5,'Procedencia Geográfica:',1,1,'L');
}
$pdf->Cell(190,5,'Importado de: '.$row5['importado'],1,1,'L');
$pdf->Cell(190,5,'Elaborado por: '.$row5['elaborado'],1,1,'L');
$pdf->MultiCell(0,5,'Forma de muestreo utilizada: '.$row5['forma_muestreo'],1,1,'L');



if(isset($row7['empresa'])&&strlen($row7['empresa'])>1){

//INFORMACIÓN de Muestras Oficiales
$pdf->Ln(5);
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(241,243,246);
$pdf->Cell(190,5,'INFORMACIÓN DE MUESTRAS OFICIALES',1,1,'C',true);
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,5,'Empresa: '.$row7['empresa'],1,1,'L');
$pdf->Cell(190,5,'Lisencia DAA : '.$row7['lisencia'],1,1,'L');
$pdf->Cell(190,5,'Inspector: '.$row7['inspector'],1,1,'L');
$pdf->Cell(190,5,'Boleta de Campo: '.$row7['boleta'],1,1,'L');
$pdf->Cell(190,5,'Muestreado en :'.$row7['muestreado'],1,1,'L');
$pdf->Cell(190,5,'Fecha de elaboración: '.$row7['fecha_elaboracion'],1,1,'L');
$pdf->Cell(190,5,'Fecha de vencimiento: '.$row7['fecha_vencimiento'],1,1,'L');

}




//Cuadro info general del Pago
$pdf->Ln(5);
$pdf->SetFillColor(241,243,246);
$pdf->Cell(190,44,'',1,0,'C',true);
$pdf->SetFont('Arial','',6);
$pdf->Ln(0);
$pdf->Cell(190,4,'• El muestreo es responsabilidad del cliente y los resultados en este informe se refieren únicamente a las muestras ensayadas.',0,1,'L');
$pdf->Cell(190,4,'• Los resultados químicos  se reportan  utilizando un factor de cobertura  k=2 y una probabilidad de cobertura de 95% y corresponde ',0,1,'L');
$pdf->Cell(190,4,' al método de ensayo utilizado.',0,1,'L');
$pdf->Cell(190,4,'• La incertidumbre se expresa de forma relativa o como un intervalo de confianza y reflejan la precisión del mesurado.',0,1,'L');
$pdf->Cell(190,4,'• Para el análisis de energía bruta, el factor de conversión de 4,184 J/cal.',0,1,'L');
$pdf->Cell(190,4,'• El método de Escherichia coli por NMP detecta las cepas indol positivas (95 %).  ',0,1,'L');
$pdf->Cell(190,4,'• Documento no válido sin firmas originales. ',0,1,'L');
$pdf->Cell(190,4,'• Luego de tres meses se desecharán los informes de ensayo que no hayan sido retirados por el cliente. (El periodo será contado a partir del día en que se informa al cliente la emisión del ensayo)',0,1,'L');
$pdf->Cell(190,4,'• Cualquier copia parcial de este documento invalida los resultados presentados en él.',0,1,'L');
$pdf->Cell(190,4,'• Se conserva una muestra de respaldo por 3 meses.',0,1,'L');
$pdf->Cell(190,4,'• Cualquier duda o consulta sobre los resultados emitidos, por favor comuníquese con servicio al cliente 2511-2049 o 2511-2055.',0,1,'L');
$pdf->SetY(271);
$pdf->Cell(0,5,'Página '.$pdf->PageNo(),0,0,'R');

//****************cuadro de analisis********


$pdf->AddPage();
$hoja=1;
imprime_header($pdf,$acreditado,$hoja,$row['consecutivo']);


/*****************************************Busco los nombres de muestras e imprimo los resultados********************/
/*****************************************Busco los nombres de muestras e imprimo los resultados********************/
/*****************************************Busco los nombres de muestras e imprimo los resultados********************/
/*****************************************Busco los nombres de muestras e imprimo los resultados********************/
/*****************************************Busco los nombres de muestras e imprimo los resultados********************/
$pdf->SetFont('Arial','',5);
$cont=0;
$linea=0;
$posicion=0;
$muestra=0;
$v_metodos=array();
while($row2=mysql_fetch_object($result2)){

	if ($row2->id_muestra!=$muestra ){
		$cont=0;
		
		if($muestra<>0){
			imprime_metodos($pdf,$v_metodos,$sep_nir);		
		}
		$cont++;
		$pdf->SetY($pdf->GetY()+5);
		unset($v_metodos);
		$v_metodos=array(); 	//vector para almacenar los metodos
		//$v_acreditados=array(); //vector para almacenar los metodos a imprimir en verde
		$pdf->SetY($pdf->GetY()+5);
		//calcula_salto($pdf,'new');
		$hoja=calcula_salto($pdf,'new',$acreditado,$hoja,$row['consecutivo']);
		$muestra=$row2->id_muestra;				
		$v_metodos[]='  ('.$cont.')'.$row2->metodo;
		
		$pdf->SetFillColor(241,243,246);
		imprime_muestra($pdf,$row['consecutivo'],$muestra);		
		if($row2->nombre=="NIR"){			
			$sep_nir=imprime_nir($pdf,$row2->fecha_aprobacion,$row2->id_laboratorio,$row2->nombre,$row2->resultado,$row2->incertidumbre,$row2->base_fresca,$row2->incertidumbre_fresca,$row2->base_seca,$row2->incertidumbre_seca,$row2->unidades,$row2->valor_correjido,0,$cont);		
		}else{
		imprime_resultados($pdf,$row2->fecha_aprobacion,$row2->id_laboratorio,$row2->nombre,$row2->resultado,$row2->incertidumbre,$row2->base_fresca,$row2->incertidumbre_fresca,$row2->base_seca,$row2->incertidumbre_seca,$row2->unidades,$row2->valor_correjido,$row2->acreditado,$cont);		
		}
	}else{
		
		$cont++;		
		$v_metodos[]='  ('.$cont.')'.$row2->metodo;
		$hoja=calcula_salto($pdf,'old',$acreditado,$hoja,$row['consecutivo']);
		if($row2->nombre=="NIR"){
			$sep_nir=imprime_nir($pdf,$row2->fecha_aprobacion,$row2->id_laboratorio,$row2->nombre,$row2->resultado,$row2->incertidumbre,$row2->base_fresca,$row2->incertidumbre_fresca,$row2->base_seca,$row2->incertidumbre_seca,$row2->unidades,$row2->valor_correjido,0,$cont);		
		}else{
		imprime_resultados($pdf,$row2->fecha_aprobacion,$row2->id_laboratorio,$row2->nombre,$row2->resultado,$row2->incertidumbre,$row2->base_fresca,$row2->incertidumbre_fresca,$row2->base_seca,$row2->incertidumbre_seca,$row2->unidades,$row2->valor_correjido,$row2->acreditado,$cont);	
		}
	}


}

imprime_metodos($pdf,$v_metodos,$sep_nir);
$pdf->SetY($pdf->GetY()+5);
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
$pdf->Cell(190,5,'Fín del informe de ensayo',0,1,'C');


$pdf->SetFont('Arial','',8);	
$pdf->SetY(270);
$pdf->Cell(0,5,'Página '.$pdf->PageNo(),0,0,'R');


$pdf->Output();

function imprime_header($pdf,$acreditado,$hoja,$contrato){
$pdf->SetFont('Arial','B',8);
$pdf->Ln(10);
$pdf->Cell(190,35,'',1,0,'C');
$pdf->Ln(0);
$pdf->Cell(190,10,'RESULTADOS DE LOS ENSAYOS',0,1,'C');
if($acreditado==1){
	$pdf->Image('img/acreditados.png',165,25,30);
}
$pdf->SetFont('Arial','',8);
//$pdf->Cell(190,5,' ',0,1,'L');
//$pdf->Cell(190,5,' ',0,1,'L');
//$hoja=1;
$pdf->Cell(190,5,'Página # '.$hoja,0,1,'L');
$pdf->Cell(190,5,'Contrato # '.$contrato,0,1,'L');
$pdf->MultiCell(190,5,'Únicamente los análisis acreditados se muestran en color verde. Ver alcance de acreditación en www.eca.or.cr',0,2,'L');
$pdf->MultiCell(190,5,'Cuando se reporten resultados en base fresca y seca, se muestran entre paréntesis redondos y cuadrados respectivamente. En caso contrario, se reporta solamente un dato entre paréntesis redondos correspondiente al valor tal como ofrecido',0,2,'L');
$pdf->Ln(8);
}

function imprime_muestra($pdf,$consecutivo,$muestra){
		$result3=mysql_query("select nombre_muestra,codigo from tbl_muestras where id_contrato='".$consecutivo."' and  numero_muestra='".$muestra."'  ");
		$row3=mysql_fetch_object($result3);

		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(190,5,'Muestra: '.$row3->codigo.' ( '.$row3->nombre_muestra.' )',1,1,'L',true);
		$pdf->Cell(37,5,'Fecha de resultados:',1,0,'L',true);
		$pdf->Cell(20,5,'Laboratorio:',1,0,'L',true);
		$pdf->Cell(65,5,'Análisis:',1,0,'L',true);
		$pdf->Cell(68,5,'Resultado:',1,1,'L',true);

}


function imprime_resultados($pdf,$fecha,$laboratorio,$analisis,$resultado,$incertidumbre,$base_fresca,$incertidumbre_fresca,$base_seca,$incertidumbre_seca,$unidades,$valor_correjido,$acreditado,$cont){
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(37,5,$fecha,1,0,'L');
		$pdf->Cell(20,5,nombre_laboratorio($laboratorio),1,0,'L');
		if ($acreditado==1){
			$pdf->SetTextColor(39,210,75);
		}
		$pdf->Cell(65,5,$analisis." (".$cont.")",1,0,'L');
		$pdf->SetTextColor(0,0,0);
		if ($analisis=="Microscopía"){
			$pdf->Cell(68,5,"Ver siguiente línea",1,1,'C');
			$pdf->MultiCell(0,5,'Resultado Microscopía: '.calcula_resultado($resultado,$incertidumbre,$base_fresca,$incertidumbre_fresca,$base_seca,$incertidumbre_seca,$unidades,$valor_correjido),1,2,'L');
		}else{
			$pdf->Cell(68,5,calcula_resultado($resultado,$incertidumbre,$base_fresca,$incertidumbre_fresca,$base_seca,$incertidumbre_seca,$unidades,$valor_correjido),1,1,'L');
		}

}

function imprime_nir($pdf,$fecha,$laboratorio,$analisis,$resultado,$incertidumbre,$base_fresca,$incertidumbre_fresca,$base_seca,$incertidumbre_seca,$unidades,$valor_correjido,$acreditado,$cont){
	$resultado=explode('|',$resultado);
    $sep=explode('|',$incertidumbre);
    $analisis='Cenizas,Fibra Cruda,Proteina Cruda,Extracto Etéreo,Humedad';
    $ana=explode(',',$analisis);
	for ($i = 0; $i <= 4; $i++){
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(37,5,$fecha,1,0,'L');
		$pdf->Cell(20,5,nombre_laboratorio($laboratorio),1,0,'L');
		$pdf->Cell(65,5,$ana[$i]." (".$cont.")",1,0,'L');
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(68,5,$resultado[$i].' g/100 g  *SEP: '.$sep[$i],1,1,'L');

	}
	return $sep[$i-1];
}

function nombre_laboratorio($laboratorio){
	if($laboratorio==1){
		return "Química";
	}elseif ($laboratorio==2) {
		return "Microbiología";
	}else{
		return "Bromatología";
	}
}

function imprime_metodos($pdf,$v_metodos,$sep_nir){
	$l_metodos=implode(";",$v_metodos);
	$size=strlen($l_metodos);
	if($size>=120){
		$pdf->Cell(190,10,'',1,1,'L',true);
		$pdf->SetY($pdf->GetY()-10);
		$pdf->Write(5,'Métodos de referencia: '.$l_metodos);
		$pdf->SetY($pdf->GetY()+5);
		if($sep_nir!=''){
			$pdf->Cell(190,5,'',1,1,'L',true);
			$pdf->SetY($pdf->GetY()-5);
			$pdf->Write(5,'*SEP: Error estándar de predicción');
		}
	}else{
		$pdf->Cell(190,5,'',1,1,'L',true);
		$pdf->SetY($pdf->GetY()-5);

		$pdf->Write(5,'Métodos de referencia: '.$l_metodos);
		$pdf->SetY($pdf->GetY()+5);
		if($sep_nir!=''){
			$pdf->Cell(190,5,'',1,1,'L',true);
			$pdf->SetY($pdf->GetY()-5);
			$pdf->Write(5,'*SEP: Error estándar de predicción');
		}
	}
	
	
}


function calcula_resultado($resultado,$incertidumbre,$base_fresca,$incertidumbre_fresca,$base_seca,$incertidumbre_seca,$unidades,$valor_correjido){
	$r1="";
	$r2="";
	if ($base_fresca<>""){
		
		if ($base_seca<>""){//pregunto si tiene resultado en base seca
			
				if ($valor_correjido<>""){	//pregunto si tiene valor correjido			
					$resultado="(".utf8_decode($valor_correjido).$incertidumbre_fresca.")".utf8_decode($unidades)." [".utf8_decode($base_seca).$incertidumbre_seca."]".utf8_decode($unidades);	
					$r1="(".utf8_decode($valor_correjido)." ".$incertidumbre_fresca.") ".utf8_decode($unidades);
					$r2=" [".utf8_decode($base_seca)." ".$incertidumbre_seca."] ".utf8_decode($unidades);	
				}else{
					$resultado="(".utf8_decode($base_fresca).$incertidumbre_fresca.")".utf8_decode($unidades)." [".utf8_decode($base_seca).$incertidumbre_seca."]".utf8_decode($unidades);	
					$r1="(".$base_fresca." ".$incertidumbre_fresca.") ".utf8_decode($unidades);
					$r2=" [".$base_seca." ".$incertidumbre_seca."] ".utf8_decode($unidades);	
				}
		}else{
				if ($valor_correjido<>""){	//pregunto si tiene valor correjido			
					$resultado="(".utf8_decode($valor_correjido).$incertidumbre_fresca.")".$unidades." [".utf8_decode($resultado).$incertidumbre."]".utf8_decode($unidades);
					$r1="(".$valor_correjido." ".$incertidumbre_fresca.") ".$unidades;							
				}else{
					$resultado="(".utf8_decode($base_fresca).$incertidumbre_fresca.")".$unidades." [".utf8_decode($resultado).$incertidumbre."]".utf8_decode($unidades);	
					$r1="(".$base_fresca." ".$incertidumbre_fresca.") ".$unidades;					
				}
		}// fin base seca linea 458

	}else{
		// no tiene resultado en base fresca	
		if ($base_seca<>""){// pregunto si hay resultado en base seca	
		
			if ($valor_correjido<>""){	
				$resultado="(".$valor_correjido." ".$incertidumbre_seca.") ".utf8_decode($unidades)	;
				$r1=$resultado;
			}else{
				$resultado="(".$base_seca." ".$incertidumbre_seca.") ".utf8_decode($unidades)	;
				$r1=$resultado;				
			}
		}else{
			if ($valor_correjido<>""){	
				$resultado="(".$valor_correjido." ".$incertidumbre.") ".utf8_decode($unidades)	;
				$r1=$resultado;				
			}else{
				$resultado="(".$resultado." ".$incertidumbre.") ".utf8_decode($unidades)	;
				$r1=$resultado;				
			}		
		}//end if resultado base seca
	}//fin base fresca vacio linea 456
	//quito los saltos de linea del final
	$r1 =str_replace("\n", "", $r1);
	$r2 =str_replace("\n", "", $r2);
	return $r1." ".$r2;
}//fin funcion calcula_resultados

function calcula_salto($pdf,$new,$acreditado,$hoja,$contrato){

	if($pdf->GetY()>=200&&$new=="new"){//si ya Y es mas de xxx y viene un analisis nuevo
		$pdf->AddPage();
		$hoja++;
		imprime_header($pdf,$acreditado,$hoja,$contrato);

	}elseif ($pdf->GetY()>=250) {
		$pdf->AddPage();
		$hoja++;
		imprime_header($pdf,$acreditado,$hoja,$contrato);

	}
			return $hoja;

}

function color(){
$this->SetFillColor(230,230,0);	
	
}



?>

