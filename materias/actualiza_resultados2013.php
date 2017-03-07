<?
set_time_limit(0);	
ini_set('memory_limit', '512M');
include('../cnx/conexion_materias.php');
conectarm();

$sql="select id,consecutivo_contrato,id_muestra from tbl_minerales where fecha_creacion>='20160101' and  fecha_creacion<'20170101'";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
//'Proteína Cruda','fibra cruda','materia seca','eln','extracto etereo','energia bruta','Humedad 135° C'
//actualiza_resultado($row->id,$row->consecutivo_contrato,'Proteína Cruda',$row->id_muestra);
//actualiza_resultado($row->id,$row->consecutivo_contrato,'Fibra Cruda',$row->id_muestra);
///actualiza_resultado($row->id,$row->consecutivo_contrato,'Humedad a 60 ºC (Materia Seca a 60 ºC)',$row->id_muestra);

actualiza_resultado($row->id,$row->consecutivo_contrato,'Calcio',$row->id_muestra);
actualiza_resultado($row->id,$row->consecutivo_contrato,'Cobalto',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Cobre',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Fósforo',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Hierro',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Magnesio',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Manganeso',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Materia seca',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Molibdeno',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'pH',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Potasio',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Sodio',$row->id_muestra);
$contador=actualiza_resultado($row->id,$row->consecutivo_contrato,'Zinc',$row->id_muestra);



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

echo $id_muestra;
	$sql2="select res.resultado from bd_sic.tbl_resultados res
join bd_sic.tbl_analisis ana 
on res.id_analisis=ana.id
 join bd_sic.tbl_categoriasanalisis cat
 on cat.id=ana.id_analisis
 join bd_sic.tbl_muestras mues
 on  ana.id_muestra=mues.numero_muestra
 where 
 cat.nombre='".utf8_decode($analisis)."'

  and mues.id='".$id_muestra."'
  and res.consecutivo_contrato='".$consecutivo."'";

	$result2=mysql_query($sql2);
	if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
	$row2=mysql_fetch_object($result2);
	
	if ($row2->resultado>=0){
		echo "entro en ".$analisis." de contrato".$consecutivo;
	
	//echo utf8_decode($analisis);

	switch ($analisis) {
    case "Calcio":
		echo "||entro calcio||";
        $analisis="calcio";
        break;
    case "Cobalto":
		echo "||entro cobalto||";
        $analisis="cobalto";
        break;
    case "Cobre":
		echo "||entro cobre||";
        $analisis="cobre";
        break;
	case "Fósforo":
		echo "||entro fosforo||";
        $analisis="fosforo";
        break;	
	case "Hierro":
		echo "||entro hierro||";
        $analisis="hierro";
        break;	
	case "Magnesio":
		echo "||entro magnesio||";
        $analisis="magnesio";
        break;
    case "Manganeso":
		echo "||entro manganeso||";
        $analisis="manganeso";
        break;	
	case "Materia seca":
		echo "||entro materia||";
        $analisis="materia_seca";
        break;
	case "Molibdeno":
		echo "||entro molibdeno||";
        $analisis="molibdeno";
        break;
	
	case "pH":
		echo "||entro pH|||";
        $analisis="ph";
		$total++;
        break;
	
	case "Potasio":
		echo "||entro potasio||";
        $analisis="potasio";
		$total++;
        break;
	
		case "Sodio":
		echo "||entro sodio||";
        $analisis="sodio";
		$total++;
        break;
	
		case "Zinc":
		echo "||entro zinc||";
        $analisis="zinc";
		$total++;
        break;
	
	
}
	global $cont;
	$cont++;
	echo "<br>";
	 echo $sql3="update tbl_minerales set ".$analisis."='".$row2->resultado."' where id='".$id."' and id_muestra='".$id_muestra."'";
	echo "<br>";
	mysql_query($sql3);
	}

	
}


?>
