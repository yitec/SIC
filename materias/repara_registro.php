<?
set_time_limit(0);	
ini_set('memory_limit', '512M');
include('../cnx/conexion_materias.php');
conectarm();
$tot=0;
round(1.95583, 2);
/********************************************Repara decimales***********************************************/
/********************************************Repara decimales***********************************************/
/********************************************Repara decimales***********************************************/
$result=mysql_query("select id,humedad_135,materia_seca,cenizas,fibra_cruda,extracto_etereo,eln,cenizas,protenia_cruda
,silica,
,celulosa,
,lignina,
,fnd,
,fad,
,dims,
,calcio,
,fosforo_t,
,fosforo_d,
,magnesio,
,potasio,
,hierro,
,cobre,
,manganeso,
,zinc,
,cobalto,
,molibdeno,
,sodio,
,e_bruta,
,azufre,
,cloro,
,ph,
,hemicelulosa,
,ceinsolu,
,nfnd,
,nfad,
,cne,
,enl,
,fa1,
,fb1,
,fb2,
,fb3,
,fc from tbl_muestras");
while ($r1=mysql_fetch_object($result)){
$result2=mysql_query("update tbl_muestras set proteina_cruda='".round($r1->proteina_cruda, 2)."', fibra_cruda='".round($r1->fibra_cruda, 2)."', humedad_135='".round($r1->humedad_135, 2)."', extracto_etereo='".round($r1->extracto_etereo, 2)."', eln='".round($r1->eln, 2)."', cenizas='".round($r1->cenizas, 2)."',
materia_seca='".round($r1->materia_seca, 2)."', 
humedad_135='".round($r1->humedad_135, 2)."',
materia_seca='".round($r1->materia_seca, 2)."',
cenizas='".round($r1->cenizas, 2)."',
fibra_cruda='".round($r1->fibra_cruda, 2)."',
extracto_etereo='".round($r1->extracto_etereo, 2)."',
eln='".round($r1->eln, 2)."',
proteina_cruda='".round($r1->proteina_cruda, 2)."',
silica='".round($r1->silica, 2)."',
celulosa='".round($r1->celulosa, 2)."',
lignina='".round($r1->lignina, 2)."',
fnd='".round($r1->fnd, 2)."',
fad='".round($r1->fad, 2)."',
dims='".round($r1->dims, 2)."',
calcio='".round($r1->calcio, 2)."',
fosforo_t='".round($r1->fosforo_t, 2)."',
fosforo_d='".round($r1->fosforo_d, 2)."',
magnesio='".round($r1->magnesio, 2)."',
potasio='".round($r1->potasio, 2)."',
hierro='".round($r1->hierro, 2)."',
cobre='".round($r1->cobre, 2)."',
manganeso='".round($r1->manganeso, 2)."',
zinc='".round($r1->zinc, 2)."',
cobalto='".round($r1->cobalto, 2)."',
molibdeno='".round($r1->molibdeno, 2)."',
sodio='".round($r1->sodio, 2)."',
e_bruta='".round($r1->e_bruta, 2)."',
azufre='".round($r1->azufre, 2)."',
cloro='".round($r1->cloro, 2)."',
ph='".round($r1->ph, 2)."',
hemicelulosa='".round($r1->hemicelulosa, 2)."',
ceinsolu='".round($r1->ceinsolu, 2)."',
nfnd='".round($r1->nfnd, 2)."',
nfad='".round($r1->nfad, 2)."',
cne='".round($r1->cne, 2)."',
enl='".round($r1->enl, 2)."',
fa1='".round($r1->fa1, 2)."',
fb1='".round($r1->fb1, 2)."',
fb2='".round($r1->fb2, 2)."',
fb3='".round($r1->fb3, 2)."',
fc='".round($r1->fc, 2)."'
where id='".$r1->id."'");
	if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 
	//echo round($r1->materia_seca, 2)."<br>";
}
/*
$fecha1='1987-01-01 00:00:00';
$fecha2='1987-12-31 00:00:00';

$result=mysql_query("select id,registro,year, proteina_cruda,fecha_creacion from tbl_muestras where  fecha_creacion<='".$fecha1."' and fecha_creacion<='".$fecha2."'");
while ($r1=mysql_fetch_object($result)){
	$res2=mysql_query("select id,registro,year,proteina_cruda from  tbl_muestras_registro where id='".$r1->id."'");
	$r2=mysql_fetch_object($res2);
	echo $r1->id." / ".$r1->registro." / ".$r1->year." &&&&&&&&&&&&&&&& ".$r2->id." / ".$r2->registro." / ".$r2->year."<br>";
		$tot++;
}*/



/********************************************Registro Forrajes***********************************************/
/********************************************Registro Forrajes***********************************************/
/*

$result=mysql_query("select id,registro from tbl_registro_forraje");
while ($r1=mysql_fetch_object($result)){
		$res2=mysql_query("update tbl_forrajes set registro='".$r1->registro."' where id='".$r1->id."'");
		echo $r1->registro."<br>";
		$tot++;
}
*/
/********************************************Registro muestras***********************************************/
/********************************************Registro muestras***********************************************/
/*
$result=mysql_query("select id,registro from tbl_muestras_registro");
while ($r1=mysql_fetch_object($result)){
		$res2=mysql_query("update tbl_muestras set registro='".$r1->registro."' where id='".$r1->id."'");
		echo $r1->registro."<br>";
		$tot++;
}
*/














/*
$result=mysql_query("select id,registro,year, proteina_cruda,fibra_cruda,humedad_135,cenizas,materia_seca,eln,extracto_etereo from tbl_muestras_registro");
while ($r1=mysql_fetch_object($result)){
	$res2=mysql_query("select id,year from  tbl_muestras where year='".$r1->year."' and proteina_cruda='".$r1->proteina_cruda."'
		and fibra_cruda='".$r1->fibra_cruda."'
		and humedad_135='".$r1->humedad_135."'
		and cenizas='".$r1->cenizas."'
		and materia_seca='".$r1->materia_seca."'
		and eln='".$r1->eln."'
		and extracto_etereo='".$r1->extracto_etereo."'

	 ");
	//$res2=mysql_query("select * from  tbl_muestras where year='$r1->year' and nombre='$r1->nombre' and proteina_cruda='$proteina_cruda' and fibra_cruda='$r1->fibra_cruda' and materia_seca='$r1->materia_seca' and eln='$r1->eln' and extracto_etereo='$r1->extracto_etereo' and cenizas='$r1->cenizas' and humedad_135='$r1->humedad_135'");
	if(!$res2){
		echo mysql_error();
	}
	$r2=mysql_fetch_object($res2);
	$var=mysql_num_rows($res2);
	if ($var>0){
		$tot++;
		echo $r1->id."-----".$r2->id."<br>";
		$res3=mysql_query("update tbl_muestras set registro='".$r1->registro."',estado=5 where id ='".$r1->id."'");
		if(!$res3){
		echo mysql_error();
		}
	}
	/*$res2=myslq_query("update tbl_muestras set registro='$r1->registro'
	where year='$r1->year' and nombre='$r1->nombre' and proteina_cruda='$proteina_cruda' and fibra_cruda='$r1->fibra_cruda'
	and materia_seca='$r1->materia_seca' and eln='$r1->eln'
	and extracto_etereo='$r1->extracto_etereo' 
	and cenizas='$r1->cenizas'
	and humedad_135='$r1->humedad_135'");

//	$res2=myslq_query("update tbl_muestras_copias set estado=5 where id ='$r1->id'");
}*/
echo "total:".$tot;


?>