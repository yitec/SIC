<?

set_time_limit(0);	
ini_set('memory_limit', '512M');
include('../cnx/conexion_materias.php');
conectarm();



/**********************************Actualizo los resultados calcio*******************************/
/**********************************Actualizo los resultados calcio*******************************/
/**********************************Actualizo los resultados calcio*******************************/


$cont=0;
$sql="select id,calcio from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(calcio)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;


	
	$pos = strpos($row->calcio,'(');
	$calcio=substr($row->calcio, 0, $pos);  // abcd
	if($calcio<>''){
		echo $sql="update tbl_minerales set calcio='".$calcio."' where id='".$row->id."'";
		mysql_query($sql);
	}

}//end while

$sql="select id,calcio from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and calcio like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->calcio,utf8_decode('±'));
	$calcio=substr($row->calcio, 0, $pos);  // abcd
	if($calcio<>''){
		echo $sql="update tbl_minerales set calcio='".$calcio."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while



/**********************************Actualizo los resultados cobalto*******************************/
/**********************************Actualizo los resultados cobalto*******************************/
/**********************************Actualizo los resultados cobalto*******************************/


$cont=0;
$sql="select id,cobalto from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(cobalto)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;	
	$pos = strpos($row->cobalto,'y');
	$cobalto=substr($row->cobalto, 0, $pos);  // abcd
	if($cobalto<>''){
		echo $sql="update tbl_minerales set cobalto='".$cobalto."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$cont=0;
$sql="select id,cobalto from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(cobalto)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;	
	$pos = strpos($row->cobalto,'Y');
	$cobalto=substr($row->cobalto, 0, $pos);  // abcd
	if($cobalto<>''){
		echo $sql="update tbl_minerales set cobalto='".$cobalto."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$cont=0;
$sql="select id,cobalto from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(cobalto)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;	
	$pos = strpos($row->cobalto,'(');
	$cobalto=substr($row->cobalto, 0, $pos);  // abcd
	if($cobalto<>''){
		echo $sql="update tbl_minerales set cobalto='".$cobalto."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$sql="select id,cobalto from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and cobalto like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->cobalto,utf8_decode('±'));
	$cobalto=substr($row->cobalto, 0, $pos);  // abcd
	if($cobalto<>''){
		echo $sql="update tbl_minerales set cobalto='".$cobalto."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


/**********************************Actualizo los resultados cobre*******************************/
/**********************************Actualizo los resultados cobre*******************************/
$cont=0;
$sql="select id,cobre from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(cobre)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;	
	$pos = strpos($row->cobre,'y');
	$cobre=substr($row->cobre, 0, $pos);  // abcd
	if($cobre<>''){
		echo $sql="update tbl_minerales set cobre='".$cobre."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$cont=0;
$sql="select id,cobre from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(cobre)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;	
	$pos = strpos($row->cobre,'Y');
	$cobre=substr($row->cobre, 0, $pos);  // abcd
	if($cobre<>''){
		echo $sql="update tbl_minerales set cobre='".$cobre."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$cont=0;
$sql="select id,cobre from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(cobre)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;	
	$pos = strpos($row->cobre,'(');
	$cobre=substr($row->cobre, 0, $pos);  // abcd
	if($cobre<>''){
		echo $sql="update tbl_minerales set cobre='".$cobre."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$sql="select id,cobre from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and cobre like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->cobre,utf8_decode('±'));
	$cobre=substr($row->cobre, 0, $pos);  // abcd
	if($cobre<>''){
		echo $sql="update tbl_minerales set cobre='".$cobre."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

	
/**********************************Actualizo los resultados materia_seca*******************************/
/**********************************Actualizo los resultados materia_seca*******************************/
/**********************************Actualizo los resultados materia_seca*******************************/


$cont=0;
$sql="select id,materia_seca from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(materia_seca)>=6  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->materia_seca,'(');
	$materia_seca=substr($row->materia_seca, 0, $pos);  // abcd
	if($materia_seca<>''){
		echo $sql="update tbl_minerales set materia_seca='".$materia_seca."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while
$sql="select id,materia_seca from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and materia_seca like '%(%'  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->materia_seca,'(');
	$materia_seca=substr($row->materia_seca, 0, $pos);  // abcd
	if($materia_seca<>''){
		echo $sql="update tbl_minerales set materia_seca='".$materia_seca."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$sql="select id,materia_seca from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and materia_seca like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->materia_seca,utf8_decode('±'));
	$materia_seca=substr($row->materia_seca, 0, $pos);  // abcd
	if($materia_seca<>''){
		echo $sql="update tbl_minerales set materia_seca='".$materia_seca."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


/**********************************Actualizo los resultados fosforo*******************************/
/**********************************Actualizo los resultados fosforo*******************************//**********************************Actualizo los resultados fosforo*******************************/


$cont=0;
$sql="select id,fosforo from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(fosforo)>=6  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;	
	echo $sql="update tbl_minerales set fosforo=SUBSTRING('".$row->fosforo."',1,5) where id='".$row->id."'";
	mysql_query($sql);
}//end while
$sql="select id,fosforo from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20160101' and fosforo like '%(%'  order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;	
	$pos = strpos($row->fosforo,'(');
	$fosforo=substr($row->fosforo, 0, $pos);  // abcd
	if($fosforo<>''){
		echo $sql="update tbl_minerales set fosforo='".$fosforo."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


/**********************************Actualizo los resultados hierro*******************************/
/**********************************Actualizo los resultados hierro*******************************/
$cont=0;
$sql="select id,hierro from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(hierro)>=6  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->hierro,'(');
	$hierro=substr($row->hierro, 0, $pos);  // abcd
	if($hierro<>''){
		echo $sql="update tbl_minerales set hierro='".$hierro."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while
$sql="select id,hierro from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and hierro like '%(%'  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->hierro,'(');
	$hierro=substr($row->hierro, 0, $pos);  // abcd
	if($hierro<>''){
		echo $sql="update tbl_minerales set hierro='".$hierro."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while



$sql="select id,hierro from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and hierro like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->hierro,utf8_decode('±'));
	$hierro=substr($row->hierro, 0, $pos);  // abcd
	if($hierro<>''){
		echo $sql="update tbl_minerales set hierro='".$hierro."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


/**********************************Actualizo los resultados magnesio*******************************/
/**********************************Actualizo los resultados magnesio*******************************/
$cont=0;
$sql="select id,magnesio from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(magnesio)>=6  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->magnesio,'(');
	$magnesio=substr($row->magnesio, 0, $pos);  // abcd
	if($magnesio<>''){
		echo $sql="update tbl_minerales set magnesio='".$magnesio."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while
$sql="select id,magnesio from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and magnesio like '%(%'  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->magnesio,'(');
	$magnesio=substr($row->magnesio, 0, $pos);  // abcd
	if($magnesio<>''){
		echo $sql="update tbl_minerales set magnesio='".$magnesio."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while



$sql="select id,magnesio from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and magnesio like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->magnesio,utf8_decode('±'));
	$magnesio=substr($row->magnesio, 0, $pos);  // abcd
	if($magnesio<>''){
		echo $sql="update tbl_minerales set magnesio='".$magnesio."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


/**********************************Actualizo los resultados manganeso*******************************/
/**********************************Actualizo los resultados manganeso*******************************/
$cont=0;
$sql="select id,manganeso from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(manganeso)>=6  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->manganeso,'(');
	$manganeso=substr($row->manganeso, 0, $pos);  // abcd
	if($manganeso<>''){
		echo $sql="update tbl_minerales set manganeso='".$manganeso."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while
$sql="select id,manganeso from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and manganeso like '%(%'  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->manganeso,'(');
	$manganeso=substr($row->manganeso, 0, $pos);  // abcd
	if($manganeso<>''){
		echo $sql="update tbl_minerales set manganeso='".$manganeso."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while



$sql="select id,manganeso from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and manganeso like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->manganeso,utf8_decode('±'));
	$manganeso=substr($row->manganeso, 0, $pos);  // abcd
	if($manganeso<>''){
		echo $sql="update tbl_minerales set manganeso='".$manganeso."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


/**********************************Actualizo los resultados molibdeno*******************************/
/**********************************Actualizo los resultados molibdeno*******************************/
$cont=0;
$sql="select id,molibdeno from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(molibdeno)>=6  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->molibdeno,'(');
	$molibdeno=substr($row->molibdeno, 0, $pos);  // abcd
	if($molibdeno<>''){
		echo $sql="update tbl_minerales set molibdeno='".$molibdeno."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while
$sql="select id,molibdeno from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and molibdeno like '%(%'  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->molibdeno,'(');
	$molibdeno=substr($row->molibdeno, 0, $pos);  // abcd
	if($molibdeno<>''){
		echo $sql="update tbl_minerales set molibdeno='".$molibdeno."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while



$sql="select id,molibdeno from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and molibdeno like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->molibdeno,utf8_decode('±'));
	$molibdeno=substr($row->molibdeno, 0, $pos);  // abcd
	if($molibdeno<>''){
		echo $sql="update tbl_minerales set molibdeno='".$molibdeno."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while



/**********************************Actualizo los resultados ph*******************************/
/**********************************Actualizo los resultados ph*******************************/
$cont=0;
$sql="select id,ph from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(ph)>=6  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->ph,'(');
	$ph=substr($row->ph, 0, $pos);  // abcd
	if($ph<>''){
		echo $sql="update tbl_minerales set ph='".$ph."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while
$sql="select id,ph from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and ph like '%(%'  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->ph,'(');
	$ph=substr($row->ph, 0, $pos);  // abcd
	if($ph<>''){
		echo $sql="update tbl_minerales set ph='".$ph."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while



$sql="select id,ph from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and ph like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->ph,utf8_decode('±'));
	$ph=substr($row->ph, 0, $pos);  // abcd
	if($ph<>''){
		echo $sql="update tbl_minerales set ph='".$ph."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while



/**********************************Actualizo los resultados potasio*******************************/
/**********************************Actualizo los resultados potasio*******************************/
$cont=0;
$sql="select id,potasio from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(potasio)>=6  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->potasio,'(');
	$potasio=substr($row->potasio, 0, $pos);  // abcd
	if($potasio<>''){
		echo $sql="update tbl_minerales set potasio='".$potasio."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while
$sql="select id,potasio from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and potasio like '%(%'  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->potasio,'(');
	$potasio=substr($row->potasio, 0, $pos);  // abcd
	if($potasio<>''){
		echo $sql="update tbl_minerales set potasio='".$potasio."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while



$sql="select id,potasio from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and potasio like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->potasio,utf8_decode('±'));
	$potasio=substr($row->potasio, 0, $pos);  // abcd
	if($potasio<>''){
		echo $sql="update tbl_minerales set potasio='".$potasio."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

/**********************************Actualizo los resultados sodio*******************************/
/**********************************Actualizo los resultados sodio*******************************/
$cont=0;
$sql="select id,sodio from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(sodio)>=6  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->sodio,'(');
	$sodio=substr($row->sodio, 0, $pos);  // abcd
	if($sodio<>''){
		echo $sql="update tbl_minerales set sodio='".$sodio."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while
$sql="select id,sodio from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and sodio like '%(%'  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->sodio,'(');
	$sodio=substr($row->sodio, 0, $pos);  // abcd
	if($sodio<>''){
		echo $sql="update tbl_minerales set sodio='".$sodio."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while



$sql="select id,sodio from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and sodio like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->sodio,utf8_decode('±'));
	$sodio=substr($row->sodio, 0, $pos);  // abcd
	if($sodio<>''){
		echo $sql="update tbl_minerales set sodio='".$sodio."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


/**********************************Actualizo los resultados zinc*******************************/
/**********************************Actualizo los resultados zinc*******************************/
$cont=0;
$sql="select id,zinc from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and LENGTH(zinc)>=6  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->zinc,'(');
	$zinc=substr($row->zinc, 0, $pos);  // abcd
	if($zinc<>''){
		echo $sql="update tbl_minerales set zinc='".$zinc."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while
$sql="select id,zinc from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and zinc like '%(%'  order by fecha_creacion";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->zinc,'(');
	$zinc=substr($row->zinc, 0, $pos);  // abcd
	if($zinc<>''){
		echo $sql="update tbl_minerales set zinc='".$zinc."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while



$sql="select id,zinc from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and zinc like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->zinc,utf8_decode('±'));
	$zinc=substr($row->zinc, 0, $pos);  // abcd
	if($zinc<>''){
		echo $sql="update tbl_minerales set zinc='".$zinc."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


$sql="select id,arsenico from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and arsenico like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->arsenico,utf8_decode('±'));
	$arse=substr($row->arsenico, 0, $pos);  // abcd
	if($arsenico<>''){
		echo $sql="update tbl_minerales set arsenico='".$arse."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while


$sql="select id,plomo from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and plomo like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->plomo,utf8_decode('±'));
	$plomo=substr($row->plomo, 0, $pos);  // abcd
	if($plomo<>''){
		echo $sql="update tbl_minerales set plomo='".$plomo."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$sql="select id,cadmio from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and cadmio like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->cadmio,utf8_decode('±'));
	$cadmio=substr($row->cadmio, 0, $pos);  // abcd
	if($cadmio<>''){
		echo $sql="update tbl_minerales set cadmio='".$cadmio."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$sql="select id,mercurio from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and mercurio like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->mercurio,utf8_decode('±'));
	$mercurio=substr($row->mercurio, 0, $pos);  // abcd
	if($mercurio<>''){
		echo $sql="update tbl_minerales set mercurio='".$mercurio."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$sql="select id,aminoacidos from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and aminoacidos like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->aminoacidos,utf8_decode('±'));
	$aminoacidos=substr($row->aminoacidos, 0, $pos);  // abcd
	if($aminoacidos<>''){
		echo $sql="update tbl_minerales set aminoacidos='".$aminoacidos."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while

$sql="select id,fluor from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' and fluor like '%±%'  order by fecha_creacion";
$sql=utf8_decode($sql);
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	$cont++;
	$pos = strpos($row->fluor,utf8_decode('±'));
	$fluor=substr($row->fluor, 0, $pos);  // abcd
	if($fluor<>''){
		echo $sql="update tbl_minerales set fluor='".$fluor."' where id='".$row->id."'";
		mysql_query($sql);
	}
}//end while







/**********************************Borro los  registros en blanco*******************************/


$sql="delete from tbl_minerales where
calcio='' and
fosforo='' and
magnesio='' and
potasio='' and
hierro='' and
cobre='' and
manganeso='' and
zinc='' and
cobalto='' and
molibdeno='' and
ph='' and
sodio='' and
materia_seca='' and
arsenico='' and
plomo='' and
cadmio='' and
mercurio='' and
aminoacidos='' and
fluor='' and
 fecha_creacion >='".'20160101'."'";
 mysql_query($sql);


/**********************************Actualizo los numeros de registros*******************************/
/**********************************Actualizo los numeros de registros*******************************/
/**********************************Actualizo los numeros de registros*******************************/

$cont=0;
$sql="select id,consecutivo_contrato from tbl_minerales where fecha_creacion>='20160101' and fecha_creacion<'20170101' order by fecha_creacion";
$result=mysql_query($sql);

while ($row=mysql_fetch_object($result)){
	$cont++;

	
	mysql_query("update tbl_minerales set registro='".$cont."' where id='".$row->id."'");


}//end while

?>