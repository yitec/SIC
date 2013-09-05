<?
error_reporting(E_ALL ^ E_NOTICE);
session_start();
date_default_timezone_set('America/Los_Angeles');
require_once('../cnx/conexion.php');
conectar();
require_once('../cnx/conexion_materias.php');
conectarm();
$hoy=date("Y-m-d H:i:s");

$dia=substr($_REQUEST['txt_fecha'], 3, 2);
$ano=substr($_REQUEST['txt_fecha'], 6, 4);
$mes=substr($_REQUEST['txt_fecha'], 0, 2);

$fecha=$ano."-".$mes."-".$dia." ".$_GET['cmb_ini'].":00";
//actualiza_materias("628");
set_time_limit(200);

try{
	
/*	
$result=mysql_query("select * from bd_materiasprimas.tbl_muestras where id>=3774");
if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 

//while ($r1=mysql_fetch_assoc($result)){
  while ($r1=mysql_fetch_object($result)){
	
	$result2=mysql_query("select nombre from bd_materiasprimas.tbl_codigos_alimentos where id>='".$r1->codigo."'");
	$r2=mysql_fetch_object($result2);
	echo $r2->nombre."<br>";
*/	
	$res=mysql_query("update bd_materiasprimas.tbl_forrajes set year=29 where id>=3774")or throw_ex(mysql_error());



//}
}
catch (Exception $e)
	{
		echo $e;
		
		
	}



/*

$f1="1912-01-01";
$f2="1912-31-12";	
$result=mysql_query("select * from bd_materiasprimas.tbl_muestras where fecha_creacion>='".$f1."' and fecha_creacion<='".$f2."'");
if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 

//while ($r1=mysql_fetch_assoc($result)){
  while ($r1=mysql_fetch_object($result)){

$dia=substr($r1->fecha_creacion, 8, 2);
$ano=substr($r1->fecha_creacion, 0, 4);
$mes=substr($r1->fecha_creacion, 5, 2);
$fecha="2012-".$mes."-".$dia." 00:00:00";

echo "<br>".$fecha."->".$r1->fecha_creacion;	

	
	
	$res=mysql_query("update bd_materiasprimas.tbl_muestras set fecha_creacion='".$fecha."' where id='".$r1->id."'")or throw_ex(mysql_error());
	if (mysql_num_rows($res)>0){
		$r2=mysql_fetch_object($res);
		$cod=$r2->id;
		echo $r2->id;
	}else{
		$cod=0;
	}
 

	
$dia=substr($r1['a13'], 0, 2);
$ano=substr($r1['a13'], 6, 4);
$mes=substr($r1['a13'], 3, 2);
$fecha=$ano."-".$mes."-".$dia." 00:00:00";

mysql_query("insert into bd_materiasprimas.tbl_muestras (tipo_muestreo,clase_alimento,tipo_alimento,fuente,clasificacion_internacional,zona_geografica,year,procesamiento,codigo,fecha_creacion,proteina_cruda,fibra_cruda,extracto_etereo,cenizas,humedad_135,estado)values(
	'".trim($r1['a1'])."',
	'".trim($r1['a3'])."',	
	'".trim($r1['a4'])."',
	'".trim($r1['a5'])."',
	'".trim($r1['a6'])."',
	'".trim($r1['a7'])."',
	'".trim($r1['a10'])."',
	'".trim($r1['a11'])."',
	'".$cod."',
	'".$fecha."',
	'".trim($r1['a20'])."',
	'".trim($r1['a17'])."',
	'".trim($r1['a18'])."',
	'".trim($r1['a16'])."',
	'".trim($r1['a14'])."',	
	'"."1"."'
	)");

}//end while

	}//end try
	catch (Exception $e)
	{
		echo $e;
		mysql_query("insert into bd.materiasprimas.tbl_errores (error,fecha)values('".$e."','".$hoy."')");
		
	}
*/

function throw_ex($er){  
  throw new Exception($er);  
}  			
?>