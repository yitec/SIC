<?
set_time_limit(0);	
ini_set('memory_limit', '512M');
include('../cnx/conexion_materias.php');
conectarm();

$sql="select id,consecutivo_contrato,id_muestra from tbl_muestras where id>=14390";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
//'Proteína Cruda','fibra cruda','materia seca','eln','extracto etereo','energia bruta','Humedad 135° C'
//actualiza_resultado($row->id,$row->consecutivo_contrato,'Proteína Cruda',$row->id_muestra);
//actualiza_resultado($row->id,$row->consecutivo_contrato,'Fibra Cruda',$row->id_muestra);
///actualiza_resultado($row->id,$row->consecutivo_contrato,'Humedad a 60 ºC (Materia Seca a 60 ºC)',$row->id_muestra);
actualiza_resultado($row->id,$row->consecutivo_contrato,'ELN',$row->id_muestra);
actualiza_resultado($row->id,$row->consecutivo_contrato,'Extracto etéreo',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Humedad 135 °C',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Cenizas',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Proteína Equivalente (NNP)',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Lignina Detergente Ácido',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Fibra Detergente Neutro',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Fibra Detergente Ácida',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Lignina Detergente Ácido',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Tamaño de Partículas',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Energía Bruta',$row->id_muestra);


echo "<br>";
echo "------------------------------------------------------------------<br>";


	/*$sql2="select id from bd_sic.tbl_muestras where id_contrato='".$row->consecutivo_contrato."'";
	$result2=mysql_query($sql2);
	$row2=mysql_fetch_object($result2);
	//echo $row2->fecha_creacion;	
	echo $sql3="update tbl_muestras set id_muestra='".$row2->id."' where id='".$row->id."'";
	//echo ";";
	echo "<br>";
	mysql_query($sql3);
	//echo $row->consecutivo_contrato."<br>";
	*/

}

echo "total=".$cont;


function actualiza_resultado($id,$consecutivo,$analisis,$id_muestra){

//	echo $id,$consecutivo,$analisis;


	$sql2="select res.resultado from bd_sic.tbl_resultados res
join bd_sic.tbl_analisis ana 
on res.id_analisis=ana.id
 join bd_sic.tbl_categoriasanalisis cat
 on cat.id=ana.id_analisis
 join bd_sic.tbl_muestras mues
 on mues.numero_muestra= ana.id_muestra
 where 
 cat.nombre='".utf8_decode($analisis)."'
  and res.consecutivo_contrato='".$consecutivo."'";
	$result2=mysql_query($sql2);
	if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
	$row2=mysql_fetch_object($result2);
	
	if ($row2->resultado>0){
		echo "entro en ".$analisis." de contrato".$consecutivo;
	
	//echo utf8_decode($analisis);

	switch ($analisis) {
    case "Proteína Cruda":
		echo "||entro Prote||";
        $analisis="proteina_cruda";
        break;
    case "Fibra Cruda":
		echo "||entro fibra||";
        $analisis="fibra_cruda";
        break;
    case "Humedad a 60 ºC (Materia Seca a 60 ºC)":
		echo "||entro materia||";
        $analisis="materia_seca";
        break;
	case "ELN":
		echo "||entro eln||";
        $analisis="eln";
        break;	
	case "Extracto etéreo":
		echo "||entro extracto||";
        $analisis="extracto_etereo";
        break;	
	case "Humedad 135 °C":
		echo "||entro humedad||";
        $analisis="humedad_135";
        break;
	case "Cenizas":
		echo "||entro cenizas||";
        $analisis="cenizas";
        break;
	
	case "Proteína Equivalente (NNP)":
		//echo "||entro cenizas||";
        $analisis="nnp";
		$total++;
        break;
	
	case "Lignina Detergente Ácido":
		//echo "||entro cenizas||";
        $analisis="lignina";
		$total++;
        break;
	
		case "Fibra Detergente Neutro":
		//echo "||entro cenizas||";
        $analisis="fnd";
		$total++;
        break;
	
		case "Fibra Detergente Ácida":
		//echo "||entro cenizas||";
        $analisis="fad";
		$total++;
        break;
	
	
		case "Tamaño de Partículas":
		//echo "||entro cenizas||";
        $analisis="particula";
		$total++;
        break;
	
		case "Energía Bruta":
		//echo "||entro cenizas||";
        $analisis="energia_bruta";
		$total++;
        break;
}
	global $cont;
	$cont++;
	echo "<br>";
	echo $sql3="update tbl_muestras set ".$analisis."='".$row2->resultado."' where id='".$id."' and id_muestra='".$id_muestra."'";
	echo "<br>";
	mysql_query($sql3);
	}

	
}


?>
