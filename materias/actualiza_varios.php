<?

set_time_limit(0);	
ini_set('memory_limit', '512M');
include('../cnx/conexion_materias.php');
conectarm();


/**********************************Actualizo los resultados humedad_135*******************************/
/**********************************Actualizo los resultados humedad_135*******************************/
/**********************************Actualizo los resultados humedad_135*******************************/
/*

$cont=0;
$sql="select id,humedad_135 from tbl_muestras where fecha_creacion>='20140101' and fecha_creacion<'20150101' and LENGTH(humedad_135)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;


	
	$pos = strpos($row->humedad_135,'(');
	$humedad=substr($row->humedad_135, 0, $pos);  // abcd

	echo $sql="update tbl_muestras set humedad_135='".$humedad."' where id='".$row->id."'";
	mysql_query($sql);


}//end while
*/
/**********************************Actualizo los resultados proteina*******************************/
/**********************************Actualizo los resultados proteina*******************************/
/**********************************Actualizo los resultados proteina y quita caracteres*******************************/


$cont=0;
$sql="select id,proteina_cruda from tbl_muestras where fecha_creacion>='20140101' and fecha_creacion<'20150101' and LENGTH(proteina_cruda)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;


	
	$pos = strpos($row->proteina_cruda,'y');
	$humedad=substr($row->proteina_cruda, 0, $pos);  // abcd

	echo $sql="update tbl_muestras set proteina_cruda='".$humedad."' where id='".$row->id."'";
	mysql_query($sql);


}//end while


	
/**********************************Actualizo los resultados materia_seca*******************************/
/**********************************Actualizo los resultados materia_seca*******************************/
/**********************************Actualizo los resultados materia_seca*******************************/
/*


$cont=0;
$sql="select id,materia_seca from tbl_muestras where fecha_creacion>='20130101' and fecha_creacion<'20140101' and LENGTH(materia_seca)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;

	
	echo $sql="update tbl_muestras set materia_seca=SUBSTRING('".$row->materia_seca."',1,5) where id='".$row->id."'";
	mysql_query($sql);


}//end while



/**********************************Actualizo los numeros de registros*******************************/
/**********************************Actualizo los numeros de registros*******************************/
/**********************************Actualizo los numeros de registros*******************************/
/*
$cont=0;
$sql="select id,consecutivo_contrato from tbl_muestras where id>=11515 order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;

	
	mysql_query("update tbl_muestras set registro='".$cont."' where id='".$row->id."'");


}//end while
*/
?>