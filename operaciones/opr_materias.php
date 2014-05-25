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

function actualiza_materias($id_resultado)
{
	
	try{
	$hoy=date("Y-m-d H:i:s");	
	$result=mysql_query("select * from tbl_resultados where id='".$id_resultado."' ")or throw_ex(mysql_error());
	$r1=mysql_fetch_object($result);
	
	$result=mysql_query("select * from tbl_analisis where id='".$r1->id_analisis."' ");
	$r2=mysql_fetch_object($result);

	$result=mysql_query("select * from bd_sic.tbl_muestras where numero_muestra='".$r2->id_muestra."' and id_contrato='".$r2->id_contrato."' ")or throw_ex(mysql_error());
	$r3=mysql_fetch_object($result);
	
	$encontrado=false;	
	$result=mysql_query("select id from bd_materiasprimas.tbl_muestras where id_muestra='".$r3->id."' ");
	if (mysql_num_rows($result)>0){
		$encontrado=true;	
	}
	$result=mysql_query("select id from bd_materiasprimas.tbl_forrajes where id_muestra='".$r3->id."' ");
	if (mysql_num_rows($result)>0){
		$encontrado=true;	
	}
	
	
	
if ($encontrado==false){
	
	$result=mysql_query("select * from tbl_contratos where consecutivo='".$r1->consecutivo_contrato."' ");
	$r4=mysql_fetch_object($result);
	
	$result=mysql_query("select * from tbl_infmuestras where cons_contrato='".$r1->consecutivo_contrato."' ");
	$r5=mysql_fetch_object($result);
	
	$result=mysql_query("select * from tbl_infforrajes where cons_contrato='".$r1->consecutivo_contrato."' ");
	$r6=mysql_fetch_object($result);
	
	$result=mysql_query("select * from tbl_infoficiales where cons_contrato='".$r1->consecutivo_contrato."' ");
	$r7=mysql_fetch_object($result);
	
	$result=mysql_query("select * from tbl_clientes where id='".$r4->id_cliente."' ");
	$r8=mysql_fetch_object($result);
	////echo $hoy;
	////echo "<br> Tipo muestreo=";
	$tipo_muestreo=busca_muestreo($r8->nombre,$r8->tipo_cliente);
	////echo "<br> Sub Categoria=";
	////echo $r3->id_subCategoria;
	
	
	
	if($r3->id_categoria==2||$r3->id_categoria==3||$r3->id_categoria==4||$r3->id_categoria==6||$r3->id_categoria==7||$r3->id_categoria==12||$r3->id_categoria==13||$r3->id_categoria==14)
	{
	////echo "<br> Clase Alimento=";	
	////echo $clase_alimento=busca_clase_alimento($r3->id_subCategoria);
	////echo "<br> Tipo Alimento=";
	////echo $tipo_alimento="2";
	$clasificacion="";
	////echo "<br> Codigo=";
	////echo $codigo_alimento=busca_codigo($r3->id_subCategoria);
	$v_codigo=explode("|",$codigo_alimento);
	$codigo_alimento=$v_codigo[0];
	$nombre=$v_codigo[1];	
	////echo "<br> Proecesamiento=";
	////echo $procesamiento=busca_procesamiento($r5->proceso_elaboracion);	
	////echo "<br> Fuente=";
	////echo $codigo_fuente=busca_fuente($codigo_alimento);	
	}
	
	 
	if ($r3->id_categoria==5){//forrajes
	//echo "<br> Region=";
	//echo $region=busca_region($r5->procedencia);		
	//echo "<br> Pasto=";	
	//echo $pasto=busca_pasto($r3->id_subCategoria);
	$v_forrajes=explode(",",$pasto);		
	//echo "<br> Vulgar=";
	//echo $v_forrajes[0];
	//echo "<br> Cientifico=";
	//echo $v_forrajes[1];
	//echo "<br> Nombre=";
	//echo $v_forrajes[2];
	//echo "<br> Parte Planta=";
	//echo $parte=busca_parte($r5->parte_planta);
	//echo "<br> Madurez=";
	//echo $madurez=busca_madurez($r6->madurez);
	//echo "<br> Tipo=";
	//echo $tipo=busca_tipo($r6->tipo);
	//echo "<br> Mes=".$mes;
	//echo "<br> Origen=";
	//echo $origen=busca_origen($r6->origen);		
		switch ($r6->fertilizacion){
			case "Si":
			 	$fer=1;
			 break;
			 case "No":
			 	$fer=1;
			 break;			 	
			 case "SE DESCONOCE":
			 	$fer=2;
			 break;			
		}
	//echo "<br> Fertilizacion=";
	//echo $fer;

	//echo "<br> Nitrogeno=";
	//echo $nitro=busca_nitrogeno($r6->nitrogeno);			


		
	}//end if forrajes
	//echo "<br> Año=";
	//echo $year=busca_year($r5->fecha_muestra);	
	
	
	$v_localizacion=explode(",",$r5->procedencia);
	
	//si es forraje
	if ($r3->id_categoria==5){
		
		$result=mysql_query("insert into bd_materiasprimas.tbl_forrajes (consecutivo_contrato,id_muestra,tipo_muestreo,zona_geografica,provincia,canton,distrito,vulgar,cientifico,nombre,parte_planta,madurez,tipo_forraje,mes,year,origen,fertilizacion,nitrogeno,estado_laboratorio,fecha_creacion,estado)values(
	'".$r3->id_contrato."',
	'".$r3->id."',	
	'".$tipo_muestreo."',
	'".$region."',
	'".$v_localizacion[0]."',
	'".$v_localizacion[1]."',
	'".$v_localizacion[2]."',
	'".$v_forrajes[0]."',
	'".$v_forrajes[1]."',
	'".$v_forrajes[2]."',
	'".$parte."',
	'".$madurez."',
	'".$tipo."',
	'".$mes."',
	'".$year."',
	'".$origen."',
	'".$fer."',
	'".$nitro."',
	'"."3"."',
	'".$hoy."',
	'"."1"."'
	)")or throw_ex(mysql_error());
		
	}//end if forraje
	
	if($r3->id_categoria==2||$r3->id_categoria==3||$r3->id_categoria==4||$r3->id_categoria==6||$r3->id_categoria==7||$r3->id_categoria==12||$r3->id_categoria==13||$r3->id_categoria==14)
	{
		
	$result=mysql_query("insert into bd_materiasprimas.tbl_muestras (consecutivo_contrato,id_muestra,tipo_muestreo,clase_alimento,tipo_alimento,fuente,clasificacion_internacional,zona_geografica,provincia,canton,distrito,year,procesamiento,codigo,nombre,fecha_creacion,estado)values(
	'".$r3->id_contrato."',
	'".$r3->id."',	
	'".$tipo_muestreo."',
	'".$clase_alimento."',
	'".$tipo_alimento."',
	'".$codigo_fuente."',
	'".$clasificacion."',
	'".$region."',
	'".$v_localizacion[0]."',
	'".$v_localizacion[1]."',
	'".$v_localizacion[2]."',
	'".$year."',
	'".$procesamiento."',
	'".$codigo_alimento."',
	'".$nombre."',
	'".$hoy."',
	'"."1"."'
	)")or throw_ex(mysql_error());
	
	}//end if materia
	
	
	}//end if encontrado
	
	if($r3->id_categoria==2||$r3->id_categoria==3||$r3->id_categoria==4||$r3->id_categoria==5||$r3->id_categoria==6||$r3->id_categoria==7||$r3->id_categoria==12||$r3->id_categoria==13||$r3->id_categoria==14)
	{
			actualiza_resultados($id_resultado,$r3->id,$r3->id_categoria);			
	}
	
	
	
	}//end try
	catch (Exception $e)
	{
		//echo $e;
		mysql_query("insert into bd.materiasprimas.tbl_errores (error,fecha)values('".$e."','".$hoy."')");
		
	}
	
	
	
	
	
	
}//end function

function busca_muestreo($id_cliente,$tipo_cliente){
	
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


 

}//end function


//***************************************************funcion tipo alimento***************

function busca_clase_alimento($id_subcategoria)
{
try{
	$result=mysql_query("select id from bd_materiasprimas.tbl_clase_alimento where id_subcategoria='".$id_subcategoria."'")or throw_ex(mysql_error());
	if(mysql_num_rows($result)>0){
		$row=mysql_fetch_object($result);
		return $row->id;
	}else{
		return 44;
	}
}
	catch(Exception $e)
{
	//echo "Error:". $e;
}
	
}//end function


//***************************************************funcion busca codigo***************

function busca_codigo($id_subcategoria)
{
try{
	$result=mysql_query("select id,nombre from bd_materiasprimas.tbl_codigos_alimentos where id_subcatmuestra='".$id_subcategoria."'")or throw_ex(mysql_error());
	$row=mysql_fetch_object($result);
	return $row->id."|".$row->nombre;
}
	catch(Exception $e)
{
	//echo "Error:". $e;
}
	
}//end function

//**************************************************funcion tipo procesamiento***************

function busca_procesamiento($procesamiento)
{
try{
	
	$result=mysql_query("select id from bd_materiasprimas.tbl_procesamiento where nombre='".$procesamiento."'")or throw_ex(mysql_error());
	$row=mysql_fetch_object($result);
	if (mysql_num_rows($result)){		
		return $row->id;
	}
	return 17;
}
	catch(Exception $e)
{
	//echo "Error:". $e;
}
	
}//end function



//***************************************************funcion busca fuente***************

function busca_fuente($cod)
{
try{
	$result=mysql_query("select id from bd_materiasprimas.tbl_fuente where id_codigo='".$cod."'")or throw_ex(mysql_error());
	$row=mysql_fetch_object($result);
	return $row->id;
}
	catch(Exception $e)
{
	//echo "Error:". $e;
}
	
}//end function


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


	



//***************************************************funcion busca epoca***************

function busca_epoca($fecha)
{
try{
	$v_mes=explode("-",$fecha);
	if($v_mes[1]>=6 && $mes[1]<=11){
		return 1;
	}
	if($v_mes[1]>=1 && $mes[1]<=5){
		return 2;
	}
	if($v_mes[1]==12){
		return 2;
	}

	return 3;//si no coincide 3 Se desconoce
}
	catch(Exception $e)
{
	//echo "Error:". $e;
}
	
}//end function



//***************************************************funcion busca año***************

function busca_year($fecha)
{
try{
	$v_mes=explode("-",$fecha);
	$result=mysql_query("select id from bd_materiasprimas.tbl_year where nombre='".$v_mes[2]."'")or throw_ex(mysql_error());
	$row=mysql_fetch_object($result);
	return $row->id;
	
}
	catch(Exception $e)
{
	//echo "Error:". $e;
}
	
}//end function

//***************************************************funcion busca año***************

function busca_pasto($sub)
{
try{
	
	$result=mysql_query("select nombre from bd_sic.tbl_subcatmuestras where id='".$sub."'")or throw_ex(mysql_error());
	$row=mysql_fetch_object($result);
	$v_nombre=explode(" ",$row->nombre);

	$result=mysql_query("select v.id as id_vul, c.id as id_cie,v.nombre as nombre from bd_materiasprimas.tbl_vulgar v, bd_materiasprimas.tbl_cientifico c where v.nombre='".$v_nombre[1]."' and v.id=c.id")or throw_ex(mysql_error());

	
	if(mysql_num_rows($result)>0){

		$row=mysql_fetch_object($result);
		$ids=$row->id_vul.",".$row->id_cie.",".$row->nombre;
		return $ids	;
	}else{

		$ids="0,0";// el id 0 significa que no aplica
		return	$ids;
	}
		
	return $row->id;
	
}
	catch(Exception $e)
{
	//echo "Error:". $e;
}
	
}//end function


//***************************************************funcion busca parte planta***************

function busca_parte($parte)
{
try{

	$result=mysql_query("select id from bd_materiasprimas.tbl_parte_planta where nombre='".$parte."'")or throw_ex(mysql_error());
	$row=mysql_fetch_object($result);
	
	if(mysql_num_rows($result)>0){
		return $row->id;
	}else{
		return 5;			
	}
}
	catch(Exception $e)
{
	//echo "Error:". $e;
}
	
}//end function

//***************************************************funcion busca madurez planta***************

function busca_madurez($madurez)
{
try{
	
	$result=mysql_query("select id from bd_materiasprimas.tbl_madurez where nombre='".$madurez."'")or throw_ex(mysql_error());
	$row=mysql_fetch_object($result);				
	return $row->id;
	
}
	catch(Exception $e)
{
	//echo "Error:". $e;
}
	
}//end function

//***************************************************funcion busca tipo de forraje***************

function busca_tipo($tipo)
{
try{
	
	$result=mysql_query("select id from bd_materiasprimas.tbl_tipo_forraje where nombre='".$tipo."'")or throw_ex(mysql_error());
	$row=mysql_fetch_object($result);				
	return $row->id;
	
}
	catch(Exception $e)
{
	//echo "Error:". $e;
}
	
}//end function


//***************************************************funcion busca origen de forraje***************

function busca_origen($origen)
{
try{
	
	$result=mysql_query("select id from bd_materiasprimas.tbl_origen where nombre='".$origen."'")or throw_ex(mysql_error());
	$row=mysql_fetch_object($result);				
	return $row->id;
	
}
	catch(Exception $e)
{
	//echo "Error:". $e;
}
	
}//end function


//***************************************************funcion busca nitrogeno de forraje***************

function busca_nitrogeno($nitrogeno)
{
try{
	
	$result=mysql_query("select id from bd_materiasprimas.tbl_nitrogeno where nombre='".$nitrogeno."'")or throw_ex(mysql_error());
	$row=mysql_fetch_object($result);				
	return $row->id;
	
}
	catch(Exception $e)
{
	//echo "Error:". $e;
}
	
}//end function



//**********************************************function actualiza los resultados*************************************

function actualiza_resultados($id_resultado,$id_muestra,$id_categoria){
		
		$result=mysql_query("select c.nombre from tbl_categoriasanalisis c,tbl_resultados r,tbl_analisis a where r.id='".$id_resultado."' and a.id= r.id_analisis and c.id=a.id_analisis ")or trow_ex(mysql_error());	
		$row=mysql_fetch_object($result);

		$nombre=utf8_encode($row->nombre);
		
		if($id_categoria==5){
			$tabla="bd_materiasprimas.tbl_forrajes";	
		}else{
			$tabla="bd_materiasprimas.tbl_muestras";		
		}

		
		switch ($nombre){
			
			case "Cenizas":

				$result=mysql_query("Select resultado,base_fresca from tbl_resultados where id='".$id_resultado."'")or trow_ex(mysql_error());
				$r9=mysql_fetch_object($result);
				if ($r9->base_fresca<>""){							
					mysql_query("update ".$tabla." set cenizas='".$r9->base_fresca."' where id_muestra='".$id_muestra."'")or trow_ex(mysql_error()); 

				}else{								
					mysql_query("update ".$tabla." set cenizas='".$r9->resultado."' where id_muestra='".$id_muestra."'")or trow_ex(mysql_error()); 
				}
			
			break;

			case "Proteína Cruda":						
				$result=mysql_query("Select resultado,base_fresca from tbl_resultados where id='".$id_resultado."'")or trow_ex(mysql_error());
				$r9=mysql_fetch_object($result);
				if ($r9->base_fresca<>""){							
					mysql_query("update ".$tabla." set proteina_cruda='".$r9->base_fresca."' where id_muestra='".$id_muestra."'")or trow_ex(mysql_error()); 
				}else{								
					mysql_query("update ".$tabla." set proteina_cruda='".$r9->resultado."' where id_muestra='".$id_muestra."'"); 
				}
			
			break;

			case "Fibra Cruda":						
				$result=mysql_query("Select resultado,base_fresca from tbl_resultados where id='".$id_resultado."'")or trow_ex(mysql_error());
				$r9=mysql_fetch_object($result);
				if ($r9->base_fresca<>""){							
					mysql_query("update ".$tabla." set fibra_cruda='".$r9->base_fresca."' where id_muestra='".$id_muestra."'")or trow_ex(mysql_error()); 
				}else{								
					mysql_query("update ".$tabla." set fibra_cruda='".$r9->resultado."' where id_muestra='".$id_muestra."'"); 
				}
			
			break;
			
			case "Extracto etéreo":						
				$result=mysql_query("Select resultado,base_fresca from tbl_resultados where id='".$id_resultado."'")or trow_ex(mysql_error());
				$r9=mysql_fetch_object($result);
				if ($r9->base_fresca<>""){							
					mysql_query("update ".$tabla." set extracto_etereo='".$r9->base_fresca."' where id_muestra='".$id_muestra."'")or trow_ex(mysql_error()); 
				}else{								
					mysql_query("update ".$tabla." set extracto_etereo='".$r9->resultado."' where id_muestra='".$id_muestra."'"); 
				}
			
			break;
			
			case "Humedad 135° C":		

				$result=mysql_query("Select resultado,base_fresca from tbl_resultados where id='".$id_resultado."'")or trow_ex(mysql_error());
				$r9=mysql_fetch_object($result);
				if ($r9->base_fresca<>""){							
					mysql_query("update ".$tabla." set humedad_135='".$r9->base_fresca."' where id_muestra='".$id_muestra."'")or trow_ex(mysql_error()); 
				}else{								
					mysql_query("update ".$tabla." set humedad_135='".$r9->resultado."' where id_muestra='".$id_muestra."'"); 
				}
			
			break;			
		}
}//end function

//**************************************************Operaciones***************************
/*************************************************************
	Accion: Inserta una nueva empresa
	Parametros: Clasificacion, Sub_Categoria, Fuente, Nombre.	
*******************************************************/
if ($_REQUEST['opcion']==1){
	try{
		$result=mysql_query("select id from bd_sic.tbl_subcatmuestras where nombre='".$_REQUEST['sub_categoria']."'")or throw_ex(mysql_error());
		$row=mysql_fetch_object($result);
		$sub=$row->id;
		mysql_query("insert into bd_materiasprimas.tbl_codigos_alimentos(id_clasificacion,id_subcatmuestra,nombre)values('".$_REQUEST['clasificacion']."','".$sub."','".$_REQUEST['nombre']."')")or throw_ex(mysql_error());
		$id_codigo=mysql_insert_id();
		mysql_query("insert into bd_materiasprimas.tbl_fuente (id_codigo,nombre)values('".$id_codigo."','".$_REQUEST['fuente']."')")or throw_ex(mysql_error());		
		$jsondata['resultado'] = "Success";
		//echo json_encode($jsondata);
	}
	catch(Exception $e)
	{
		//echo "Error:". $e;
	}
}

//**********************************************funcion que recibe los errores**********************************************
/*******************************************
	Accion:Recibe todos los errores del sistema.
	Parametros: error.
*******************************************/
function throw_ex($er){  

  throw new Exception($er);  
		mysql_query("insert into bd_materiasprimas.tbl_errores (error,fecha)values('".$er."','".$hoy."')");
} 

?>

