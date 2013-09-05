<?
error_reporting(E_ALL ^ E_NOTICE);
session_start();
set_time_limit(3000);
include('../cnx/conexion.php');
conectar();
require_once('../cnx/conexion_materias.php');
conectarm();
//**********************************Repara los nombres faltantes de materias**************************/
/*
$result=mysql_query("select id,codigo from bd_materiasprimas.tbl_muestras where  fecha_creacion BETWEEN DATE('2013-05-07 00:00:00') and Date('2013-12-31 00:00:00')");


while($row=mysql_fetch_object($result)){

	$result2=mysql_query("select id,nombre from tbl_codigos where codigo='".$row->codigo."'");
	if (mysql_num_rows($result2)>0){
	$row2=mysql_fetch_object($result2);
	
	echo $row2->nombre."<br>";
	$result3=mysql_query("update tbl_muestras set nombre='".$row2->nombre."' where id='".$row->id."' ");
	}

}
*/

/****************************************************************************************/
/****************************************************************************************/
/*
$result=mysql_query("select id,id_muestra from bd_materiasprimas.tbl_muestras where codigo=0 and fecha_creacion BETWEEN DATE('2012-07-06 00:00:00') and Date('2012-12-31 00:00:00')");

while($row=mysql_fetch_object($result)){

	$result2=mysql_query("select s.nombre from bd_sic.tbl_muestras m, bd_sic.tbl_subcatmuestras s where m.id='".$row->id_muestra."' and s.id=m.id_subCategoria");
	$row2=mysql_fetch_object($result2);
	echo $row2->nombre." //////////// ";
	
	$sql="select codigo,nombre from bd_materiasprimas.tbl_codigos_alimentos where nombre like '%$row2->nombre%'";
	
	$result3=mysql_query($sql);
	if (mysql_num_rows($result3)>0){			
		$row3=mysql_fetch_object($result3);
		
		echo $row3->nombre."<br>";

	}else{
		echo"<br>";
	}
}


*/

/***************************************************************************************/
/***************************************************************************************/
/******************************Repara tipo muestreo**************************************/
//Con numero de muestra
//$result=mysql_query("select id,id_muestra,fecha_creacion from bd_materiasprimas.tbl_muestras where codigo>0 and fecha_creacion BETWEEN DATE('2013-01-01 00:00:00') and Date('2013-12-31 00:00:00')");

//Con numero de contrato
$result=mysql_query("select id,consecutivo_contrato,fecha_creacion from bd_materiasprimas.tbl_muestras where codigo>0 and fecha_creacion BETWEEN DATE('2013-01-01 00:00:00') and Date('2013-12-31 00:00:00')");


while($row=mysql_fetch_object($result)){
	//con numero de muestra
	//$result2=mysql_query("select co.consecutivo,c.nombre,c.tipo_cliente from bd_sic.tbl_clientes c,bd_sic.tbl_muestras m, bd_sic.tbl_contratos co where m.id='".$row->id_muestra."' and co.consecutivo=m.id_contrato and co.id_cliente=c.id");
	//con numero de contrato
	$result2=mysql_query("select co.consecutivo,c.nombre,c.tipo_cliente from bd_sic.tbl_clientes c, bd_sic.tbl_contratos co where co.consecutivo='".$row->consecutivo_contrato."' and co.id_cliente=c.id");

	$r2=mysql_fetch_object($result2);
	$tipo_muestreo=busca_muestreo($r2->nombre,$r2->tipo_cliente);
	echo $r2->consecutivo."//".$row->fecha_creacion." /// ".$r2->nombre." //// ".$r2->tipo_cliente." //// ".$tipo_muestreo."<br>";
	$result3=mysql_query("update tbl_muestras set tipo_muestreo='".$tipo_muestreo."' where id='".$row->id."' ");

}

function busca_muestreo($nombre_cliente,$tipo_cliente){
	
	//busco si es de dos pinos	
 $pos= substr_count($nombre_cliente,"Dos Pinos");
 if ($pos>=1){
	  $encontrado=true;
	return 8; 
 }
 
	//busco si es de Pipasa	
 $pos= substr_count($nombre_cliente,"Pipasa");
 if ($pos>=1){
	 $encontrado=true;
	return 7; 
 }
 
 	//busco si es de dawes
 $pos= substr_count($nombre_cliente,"Dawes");
 if ($pos>=1){
	 $encontrado=true;
	return 6; 
 }
 
 	//busco si es del MAG
 $pos= substr_count($nombre_cliente,"MAG");
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



/***************************************************************************************/
/***************************************************************************************/
/******************************Repara Procedencia**************************************/
/*
//si solo tengo el numero de muetra
//$results=mysql_query("select id,id_muestra,fecha_creacion from bd_materiasprimas.tbl_muestras where codigo>0 and fecha_creacion BETWEEN DATE('2012-07-06 00:00:00') and Date('2012-12-31 00:00:00')");

//si solo tengo el numero de contrato
$results=mysql_query("select id,consecutivo_contrato,fecha_creacion from bd_materiasprimas.tbl_muestras where codigo>0 and fecha_creacion BETWEEN DATE('2013-01-01 00:00:00') and Date('2013-12-31 00:00:00')");

while($rows=mysql_fetch_object($results)){
	//si solo tengo el numero de muetra
	//$result2=mysql_query("select i.procedencia from bd_sic.tbl_infmuestras i ,bd_sic.tbl_muestras m, bd_sic.tbl_contratos co where m.id='".$rows->id_muestra."' and co.consecutivo=m.id_contrato and co.consecutivo=i.cons_contrato");
	
	//si solo tengo el numero de contrato
	$result2=mysql_query("select procedencia from bd_sic.tbl_infmuestras where cons_contrato='".$rows->consecutivo_contrato."'");	
	
	$r2=mysql_fetch_object($result2);
	$region=busca_region($r2->procedencia);
	echo "Contrato:".$rows->consecutivo_contrato." Proecedencia:".$r2->procedencia." Region---> ".$region."<br>";
	if ($region>0){
	$result3=mysql_query("update bd_materiasprimas.tbl_muestras set zona_geografica='".$region."' where id='".$rows->id."' ");
	}
/*
$v_procedencia=explode(",",$r2->procedencia);
	$cont=0;
	$result=mysql_query("select id,cantones from bd_materiasprimas.tbl_zona ")or throw_ex(mysql_error());
	while ($row=mysql_fetch_object($result)){

		$cont++;		
		switch ($cont)
		{
		case 1:
			$v_norte=explode(",",$row->cantones);
			
					
				if (in_array($v_procedencia[1],$v_norte)){
				echo $row->id;
				}
		break;	

		case 2:
			$v_atl=explode(",",$row->cantones);			
				if (in_array($v_procedencia[1],$v_atl)){
				echo $row->id;
				}
		break;	

		case 3:
			$v_ch=explode(",",$row->cantones);			
				if (in_array($v_procedencia[1],$v_ch)){
				echo $row->id;
				}
		break;	

		case 4:
			$v_ct=explode(",",$row->cantones);	
			//echo $v_procedencia[1];
			//print_r($v_ct);
			
				if (in_array($v_procedencia[1],$v_ct)){
					//echo "ZAAAAAAAAAAAAAAAAAAAAAAAAAAA";
				echo " Procedencia--->".$row->id;
				echo "<br>"		;
				}
		break;	

		case 5:
			$v_br=explode(",",$row->cantones);			
				if (in_array($v_procedencia[1],$v_br)){
				echo $row->id;
				}
		break;		
		}
	
	
	}
	
}

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
	echo "Error:". $e;
}
	
}//end function

*/
?>
