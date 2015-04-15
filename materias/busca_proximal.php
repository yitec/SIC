<?
set_time_limit(0);	
ini_set('memory_limit', '512M');
include('../cnx/conexion.php');
conectar();
$cont=0;
$proxi="'Proteína Cruda','Fibra Cruda','Humedad a 60 ºC (Materia Seca a 60 ºC)','ELN','Extracto etéreo',
'Humedad 135 °C','Humedad 135° C','Cenizas','Proteína Equivalente (NNP)' ,
'Lignina Detergente Ácido','Fibra Detergente Neutro','Fibra Detergente Ácida',
'Lignina Detergente Ácido','Tamaño de Partículas','Energía Bruta'";
echo "<br><br>";
 $sql="select cat.nombre,mues.numero_muestra,mues.id_contrato as consecutivo,mues.id as id_muestra,
mues.fecha_ingreso, mues.numero_muestra, inf.tipo_alimento,inf.nombre_producto,inf.procedencia  
from tbl_muestras mues join tbl_analisis ana 
ON ana.id_muestra=mues.numero_muestra 
join tbl_categoriasanalisis cat
ON cat.id=ana.id_analisis
join tbl_infmuestras inf
on mues.id_contrato=inf.cons_contrato
where mues.fecha_ingreso>='20140101' and mues.fecha_ingreso<='20141231' 
and cat.nombre in (".utf8_decode($proxi).") and metodo not like 'no se realiza%'
group by mues.id order by mues.id_contrato";
$result=mysql_query($sql);

echo "<br><br>";

if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
while ($row=mysql_fetch_object($result)){
	
	//echo "<br>Revisando->".$row->consecutivo;
	busca_proximal($row->consecutivo,$row->id_muestra,$row->fecha_ingreso,$row->numero_muestra,$row->tipo_alimento,$row->nombre_producto,$row->numero_muestra,$row->procedencia);


}//end while

Echo "Total Contratos->".$cont;

function busca_proximal($id,$id_muestra,$fecha_ingreso,$numero_muestra,$tipo_muestra,$nombre_producto,$numero_muestra,$procedencia){

	$total=0;
	$sql2="select cat.nombre from tbl_analisis ana
join tbl_categoriasanalisis cat
on ana.id_analisis=cat.id
where ana.id_muestra=1
and ana.id_contrato='".$id."'";

	$result2=mysql_query($sql2);
	while ($row2=mysql_fetch_object($result2)){
	$encontrado=false;
	//echo "-".$row2->nombre ;
	$analisis_procesar.="|".utf8_encode($row2->nombre);
	
	switch (utf8_encode($row2->nombre)) {
    case "Proteína Cruda":
		//echo "||entro Prote||".$id;
        $analisis="proteína_cruda";
		$total++;
		$encontrado=true;
        break;
    case "Fibra Cruda":
		//echo "||entro fibra||".$id;
        $analisis="fibra_cruda";
		$total++;
		$encontrado=true;
        break;
    case "Humedad a 60 ºC (Materia Seca a 60 ºC)":
        //echo "||entro materia||".$id;
		$analisis="materia_seca";
		$total++;
		$encontrado=true;
        break;
	case "ELN":
		//echo "||entro eln||".$id;
        $analisis="eln";
		$total++;
		$encontrado=true;
    break;
	case "Extracto etéreo":
		//echo "||entro extrato||".$id;
        $analisis="extracto_etereo";
		$total++;
		$encontrado=true;
        break;	
	case "Humedad 135 °C":
		//echo "||entro 135||".$id;
        $analisis="humedad_135";
		$total++;
		$encontrado=true;
        break;
	
	case "Cenizas":
		//echo "||entro cenizas||".$id;
        $analisis="cenizas";
		$total++;
		$encontrado=true;
        break;
	
	case "Proteína Equivalente (NNP)":
		//echo "||entro NNP||".$id;
        $analisis="nnp";
		$total++;
		$encontrado=true;
        break;
	
	case "Lignina Detergente Ácido":
		//echo "||entro Ligni||".$id;
        $analisis="cenizas";
		$total++;
		$encontrado=true;
        break;
	
		case "Fibra Detergente Neutro":
		//echo "||entro fdn||".$id;
        $analisis="cenizas";
		$total++;
		$encontrado=true;
        break;
	
		case "Fibra Detergente Ácida":
		//echo "||entro fda||".$id;
        $analisis="cenizas";
		$total++;
		$encontrado=true;
        break;
		
		case "Tamaño de Partículas":
		//echo "||entro particulas||".$id;
        $analisis="cenizas";
		$total++;
		$encontrado=true;
        break;
	
		case "Energía Bruta":
		//echo "||entro enegia||".$id;
        $analisis="cenizas";
		$total++;
		$encontrado=true;
        break;
	}
	
	
	
	}//end while
	
	if ($encontrado==false){
	//echo"************analisis******->".$analisis_procesar;
	}
	//echo "<br>Total-> ".$total;
	if ($total>=1){
		echo "<br>Contrato-> ".$id."tiene Proximal";
		global $cont;
		$cont++;
		//funciones
		$tipo_muestreo=busca_muestreo($id);
		$clase_alimento=busca_clase_alimento($id,$numero_muestra);
		$procedencia=busca_region($procedencia);

		echo $sql3="insert into bd_materiasprimas.tbl_proxi2014 (consecutivo_contrato,numero_muestra,tipo_muestreo,clase_alimento,tipo_alimento,zona_geografica,year,fecha_ingreso,id_muestra,tipo_muestra,nombre_producto)
		values
		('$id','$numero_muestra','$tipo_muestreo','$clase_alimento',2,'$procedencia',29,'$fecha_ingreso','$id_muestra','$tipo_muestra','$nombre_producto')
		";
		$resultado=mysql_query($sql3);
		if (!$resulto) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $sql3;
		
		} 


	}else{
	echo "<br>UPS!!! Contrato-> ".$id."No entro->".utf8_encode($row2->nombre);
	}
	
}


/*****************************Busca Tipo Muestreo****************************************/
/****************************************************************************************/
/****************************************************************************************/
/****************************************************************************************/
 
  
       																					
 


function busca_muestreo($id){

	$sql4="select cli.nombre,cli.tipo_cliente from bd_sic.tbl_clientes cli join bd_sic.tbl_contratos con
	on cli.id=con.id_cliente where con.consecutivo='".$id."'";
	$result4=mysql_query($sql4);
	$row4=mysql_fetch_object($result4);
	$id_cliente=$row4->nombre;
	$tipo_cliente=$row4->tipo_cliente;
	$encontrado=false;
	
	//busco si es de dos pinos	
 $pos= substr_count($id_cliente,"Dos Pinos");
 if ($pos>=1){
	  $encontrado=true;
	return 8; 
 }
 
	//busco si es de Pipasa	
 $pos= substr_count($id_cliente,"Pipasa");
 if ($pos>=1){
	 $encontrado=true;
	return 7; 
 }
 
 	//busco si es de dawes
 $pos= substr_count($id_cliente,"Dawes");
 if ($pos>=1){
	 $encontrado=true;
	return 6; 
 }
 
 	//busco si es del MAG
 $pos= substr_count($id_cliente,"MAG");
 if ($pos>=1){
	 $encontrado=true;
	return 1; 
 }


if($encontrado==false){
	switch ($tipo_cliente){
	
		case "Investigacion":
			return 3;			
		case "Particular":
			return 2;
		case "Exonerado":
			return 3;
		
		
	}//end switch
	
}
}


//***************************************************funcion tipo alimento**********************
//***************************************************funcion tipo alimento**********************
//***************************************************funcion tipo alimento**********************
//***************************************************funcion tipo alimento**********************


function busca_clase_alimento($id,$numero_muestra){


	$result=mysql_query("select * from bd_sic.tbl_muestras where numero_muestra='".$numero_muestra."' and id_contrato='".$id."' ");
	$r3=mysql_fetch_object($result);
	$id_subcategoria=$r3->id_subCategoria;

	$result=mysql_query("select id from bd_materiasprimas.tbl_clase_alimento where id_subcategoria like '".$id_subcategoria."'");
	if(mysql_num_rows($result)>0){
		$row=mysql_fetch_object($result);
		return $row->id;
	}else{
		return 44;
	}

	
}//end function


//***************************************************funcion busca Region***************
//***************************************************funcion busca Region***************
//***************************************************funcion busca Region***************
//***************************************************funcion busca Region***************

function busca_region($procedencia)
{
try{
	$v_procedencia=explode(",",$procedencia);
	$cont=0;
	$result=mysql_query("select id,cantones from bd_materiasprimas.tbl_zona ")or throw_ex(mysql_error());
	while ($row=mysql_fetch_object($result)){

		$cont++;		
		switch ($cont)
		{
		case 1:
			$v_norte=explode(",",$row->cantones);			
				if (in_array($v_procedencia[1],$v_norte)){
				return $row->id;
				}
		break;	

		case 2:
			$v_atl=explode(",",$row->cantones);			
				if (in_array($v_procedencia[1],$v_atl)){
				return $row->id;
				}
		break;	

		case 3:
			$v_ch=explode(",",$row->cantones);			
				if (in_array($v_procedencia[1],$v_ch)){
				return $row->id;
				}
		break;	

		case 4:
			$v_ct=explode(",",$row->cantones);			
				if (in_array($v_procedencia[1],$v_ct)){
				return $row->id;
				}
		break;	

		case 5:
			$v_br=explode(",",$row->cantones);			
				if (in_array($v_procedencia[1],$v_br)){
				return $row->id;
				}
		break;		
		}
	
	
	}
}
	catch(Exception $e)
{
	//echo "Error:". $e;
}
	
}//end function





?>