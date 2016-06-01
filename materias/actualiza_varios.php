<?

set_time_limit(0);	
ini_set('memory_limit', '512M');
include('../cnx/conexion_materias.php');
conectarm();



/**********************************Actualizo los resultados humedad_135*******************************/
/**********************************Actualizo los resultados humedad_135*******************************/
/**********************************Actualizo los resultados humedad_135*******************************/


$cont=0;
$sql="select id,humedad_135 from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and LENGTH(humedad_135)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;


	
	$pos = strpos($row->humedad_135,'(');
	$humedad=substr($row->humedad_135, 0, $pos);  // abcd
	if($humedad<>''){
		echo $sql="update tbl_muestras set humedad_135='".$humedad."' where id='".$row->id."'";
		mysql_query($sql);
	}

}//end while

$sql="select id,humedad_135 from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and humedad_135 like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->humedad_135,utf8_decode('±'));
	$humedad_135=substr($row->humedad_135, 0, $pos);  // abcd
	if($humedad_135<>''){
		echo $sql="update tbl_muestras set humedad_135='".$humedad_135."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while



/**********************************Actualizo los resultados proteina*******************************/
/**********************************Actualizo los resultados proteina*******************************/
/**********************************Actualizo los resultados proteina y quita caracteres*******************************/


$cont=0;
$sql="select id,proteina_cruda from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and LENGTH(proteina_cruda)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;	
	$pos = strpos($row->proteina_cruda,'y');
	$proteina_cruda=substr($row->proteina_cruda, 0, $pos);  // abcd
	if($proteina_cruda<>''){
		echo $sql="update tbl_muestras set proteina_cruda='".$proteina_cruda."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$cont=0;
$sql="select id,proteina_cruda from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and LENGTH(proteina_cruda)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;	
	$pos = strpos($row->proteina_cruda,'Y');
	$proteina_cruda=substr($row->proteina_cruda, 0, $pos);  // abcd
	if($proteina_cruda<>''){
		echo $sql="update tbl_muestras set proteina_cruda='".$proteina_cruda."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$cont=0;
$sql="select id,proteina_cruda from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and LENGTH(proteina_cruda)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;	
	$pos = strpos($row->proteina_cruda,'(');
	$proteina_cruda=substr($row->proteina_cruda, 0, $pos);  // abcd
	if($proteina_cruda<>''){
		echo $sql="update tbl_muestras set proteina_cruda='".$proteina_cruda."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$sql="select id,proteina_cruda from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and proteina_cruda like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->proteina_cruda,utf8_decode('±'));
	$proteina_cruda=substr($row->proteina_cruda, 0, $pos);  // abcd
	if($proteina_cruda<>''){
		echo $sql="update tbl_muestras set proteina_cruda='".$proteina_cruda."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


/**********************************Actualizo los resultados fibra*******************************/
/**********************************Actualizo los resultados fibra*******************************/
/**********************************Actualizo los resultados fibre y quita caracteres*******************************/


$cont=0;
$sql="select id,fibra_cruda from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and LENGTH(fibra_cruda)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->fibra_cruda,'y');
	$fibra_cruda=substr($row->fibra_cruda, 0, $pos);  // abcd
	if($fibra_cruda<>''){
		echo $sql="update tbl_muestras set fibra_cruda='".$fibra_cruda."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


$sql="select id,fibra_cruda from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and fibra_cruda like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->fibra_cruda,utf8_decode('±'));
	$fibra_cruda=substr($row->fibra_cruda, 0, $pos);  // abcd
	if($fibra_cruda<>''){
		echo $sql="update tbl_muestras set fibra_cruda='".$fibra_cruda."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


	
/**********************************Actualizo los resultados materia_seca*******************************/
/**********************************Actualizo los resultados materia_seca*******************************/
/**********************************Actualizo los resultados materia_seca*******************************/


$cont=0;
$sql="select id,materia_seca from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and LENGTH(materia_seca)>=6  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->materia_seca,'(');
	$materia_seca=substr($row->materia_seca, 0, $pos);  // abcd
	if($materia_seca<>''){
		echo $sql="update tbl_muestras set materia_seca='".$materia_seca."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while
$sql="select id,materia_seca from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and materia_seca like '%(%'  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->materia_seca,'(');
	$materia_seca=substr($row->materia_seca, 0, $pos);  // abcd
	if($materia_seca<>''){
		echo $sql="update tbl_muestras set materia_seca='".$materia_seca."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$sql="select id,materia_seca from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and materia_seca like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->materia_seca,utf8_decode('±'));
	$materia_seca=substr($row->materia_seca, 0, $pos);  // abcd
	if($materia_seca<>''){
		echo $sql="update tbl_muestras set materia_seca='".$materia_seca."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


/**********************************Actualizo los resultados cenizas*******************************/
/**********************************Actualizo los resultados cenizas*******************************//**********************************Actualizo los resultados cenizas*******************************/


$cont=0;
$sql="select id,cenizas from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and LENGTH(cenizas)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;	
	echo $sql="update tbl_muestras set cenizas=SUBSTRING('".$row->cenizas."',1,5) where id='".$row->id."'";
	mysql_query($sql);
}//end while
$sql="select id,cenizas from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20150101' and cenizas like '%(%'  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;	
	$pos = strpos($row->cenizas,'(');
	$cenizas=substr($row->cenizas, 0, $pos);  // abcd
	if($cenizas<>''){
		echo $sql="update tbl_muestras set cenizas='".$cenizas."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


/**********************************Actualizo los resultados extracto*******************************/
/**********************************Actualizo los resultados extracto*******************************//**********************************Actualizo los resultados extracto*******************************/

$cont=0;
$sql="select id,extracto_etereo from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and LENGTH(extracto_etereo)>=6  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->extracto_etereo,'(');
	$extracto_etereo=substr($row->extracto_etereo, 0, $pos);  // abcd
	if($extracto_etereo<>''){
		echo $sql="update tbl_muestras set extracto_etereo='".$extracto_etereo."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while
$sql="select id,extracto_etereo from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and extracto_etereo like '%(%'  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->extracto_etereo,'(');
	$extracto_etereo=substr($row->extracto_etereo, 0, $pos);  // abcd
	if($extracto_etereo<>''){
		echo $sql="update tbl_muestras set extracto_etereo='".$extracto_etereo."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while



$sql="select id,extracto_etereo from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and extracto_etereo like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->extracto_etereo,utf8_decode('±'));
	$extracto_etereo=substr($row->extracto_etereo, 0, $pos);  // abcd
	if($extracto_etereo<>''){
		echo $sql="update tbl_muestras set extracto_etereo='".$extracto_etereo."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


/*******************************************FAD*****************************************************/

$sql="select id,fad from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and fad like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->fad,utf8_decode('±'));
	$fad=substr($row->fad, 0, $pos);  // abcd
	if($fad<>''){
		echo $sql="update tbl_muestras set fad='".$fad."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

/****************************************FND************************************************************/

$sql="select id,fnd from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and fnd like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->fnd,utf8_decode('±'));
	$fnd=substr($row->fnd, 0, $pos);  // abcd
	if($fnd<>''){
		echo $sql="update tbl_muestras set fnd='".$fnd."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


/***************************************lignina*******************************************************/

$sql="select id,lignina from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' and lignina like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->lignina,utf8_decode('±'));
	$lignina=substr($row->lignina, 0, $pos);  // abcd
	if($lignina<>''){
		echo $sql="update tbl_muestras set lignina='".$lignina."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while




/**********************************Actualizo los numeros de registros*******************************/
/**********************************Actualizo los numeros de registros*******************************/
/**********************************Actualizo los numeros de registros*******************************/

$cont=0;
$sql="select id,consecutivo_contrato from tbl_muestras where fecha_creacion>='20150101' and fecha_creacion<'20160101' order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;

	
	mysql_query("update tbl_muestras set registro='".$cont."' where id='".$row->id."'");


}//end while

?>
