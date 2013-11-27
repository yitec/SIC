<?
error_reporting(E_ALL ^ E_NOTICE);
session_start();
date_default_timezone_set('America/Los_Angeles');
//require_once('../cnx/conexion.php');
//conectar();
include('../cnx/conexion_materias.php');
conectarm();
$hoy=date("Y-m-d H:i:s");

$dia=substr($_REQUEST['txt_fecha'], 3, 2);
$ano=substr($_REQUEST['txt_fecha'], 6, 4);
$mes=substr($_REQUEST['txt_fecha'], 0, 2);

$fecha=$ano."-".$mes."-".$dia." ".$_GET['cmb_ini'].":00";
//actualiza_materias("628");
set_time_limit(1000);

try{

//********************************Cambian las fechas de los registros con fecha 1900***********************************************
//*********************************************************************************************************************************	
//*********************************************************************************************************************************	

	
$f1="1912-01-01";
$f2="1912-31-12";	
$result=mysql_query("select * from bd_materiasprimas.tbl_minerales where fecha_creacion>='".$f1."' and fecha_creacion<='".$f2."'");
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
$res=mysql_query("update bd_materiasprimas.tbl_minerales set fecha_creacion='".$fecha."' where id='".$r1->id."'")or throw_ex(mysql_error());

}


//********************************Actualiza los codigos a cada materia prima*******************************************************
//*********************************************************************************************************************************	
//*********************************************************************************************************************************	
/*
$result=mysql_query("select * from tbl_compacodigos group by nombre");
if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
while($row=mysql_fetch_object($result)){
	echo $row->nombre."<br>";
	//$sql=mysql_query("select codigo from tbl_codigos where nombre='".$row->nombre."'");
	//$r1=mysql_fetch_object($sql);
	//if($r1->codigo>=1){
		$cont++;
		$r2=mysql_query("update tbl_muestras set codigo = '".$row->codigo."' where nombre='".$row->nombre."'");
	//}
	


}
echo $cont;

*/


//********************************Arregla cifra año*******************************************************
//*********************************************************************************************************************************	
//*********************************************************************************************************************************	
/*
$result=mysql_query("select id,fecha_creacion from tbl_muestras ");
if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
while($row=mysql_fetch_object($result)){
	
$ano=substr($row->fecha_creacion, 0, 4);
echo $ano."<br>";
switch ($ano) {
		case '1985':
		$numero=1;
		break;
		case '1986':
		$numero=2;
		break;
		case '1987':
		$numero=3;
		break;
		case '1988':
		$numero=4;
		break;
		case '1989':
		$numero=5;
		break;
		case '1990':
		$numero=6;
		break;
		case '1991':
		$numero=7;
		break;
		case '1992':
		$numero=8;
		break;
		case '1993':
		$numero=9;
		break;
		case '1994':
		$numero=10;
		break;
		case '1995':
		$numero=11;
		break;
		case '1996':
		$numero=12;
		break;
		case '1997':
		$numero=13;
		break;
		case '1998':
		$numero=14;
		break;
		case '1999':
		$numero=15;
		break;
		case '2000':
		$numero=16;
		break;
		case '2001':
		$numero=17;
		break;
		case '2002':
		$numero=18;
		break;
		case '2003':
		$numero=19;
		break;
		case '2004':
		$numero=20;
		break;
		case '2005':
		$numero=21;
		break;
		case '2006':
		$numero=22;
		break;
		case '2007':
		$numero=23;
		break;
		case '2008':
		$numero=24;
		break;
		case '2009':
		$numero=25;
		break;
		case '2010':
		$numero=26;
		break;
		case '2011':
		$numero=27;
		break;
		case '2012':
		$numero=28;
		break;
		case '2013':
		$numero=29;
		break;
	
	default:
		$numero=-1;
		break;
}
echo $row->fecha_creacion."///".$numero."<br>";
$r2=mysql_query("update tbl_muestras set year = '".$numero."' where id='".$row->id."'");


}




}//end try
catch (Exception $e)
	{
		echo $e;
		
		
	}



/*	if (mysql_num_rows($res)>0){
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
*/
	}//end try
	catch (Exception $e)
	{
		echo $e;
		mysql_query("insert into bd.materiasprimas.tbl_errores (error,fecha)values('".$e."','".$hoy."')");
		
	}


function throw_ex($er){  
  throw new Exception($er);  
} 

?>