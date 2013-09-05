<?php
session_start();
require_once('../cnx/conexion_inventario.php');
conectar();
$hoy=date("Y-m-d H:i:s");
//guarda un articulo en inventario
$dia=substr($_REQUEST['txt_fecha'], 3, 2);
$ano=substr($_REQUEST['txt_fecha'], 6, 4);
$mes=substr($_REQUEST['txt_fecha'], 0, 2);

$fecha=$ano."-".$mes."-".$dia." ".$_GET['cmb_ini'].":00";

if($_REQUEST['opcion']==1)
{

//busco si no existe la categoria
$result=mysql_query("select nombre from tbl_categorias where nombre='".$_REQUEST['txt_nombre']."'");
$total=mysql_num_rows($result);
if($total>0){
	echo "repetido";
}else{
	$query="insert into tbl_categorias(nombre,estado)values('".utf8_decode($_REQUEST['txt_nombre'])."','"."1"."')";
	$result = mysql_query($query);	
	if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	}
	$mensaje=" Creacion Categoria ".utf8_decode($_REQUEST['txt_nombre']);
	$result = mysql_query("Insert into tbl_bitacora (usuario,accion,fecha) values ('".$_SESSION['nombre_usuario']."','".$mensaje."','".$hoy."')");
		
	
	desconectar();
	echo "Success";
	
	
	
}

}//end if opcion 1



//busco si no existe el articulo
if($_REQUEST['opcion']==2)
{

$result=mysql_query("select nombre from tbl_articulos where nombre='".$_REQUEST['txt_nombre']."'");
$total=mysql_num_rows($result);
if($total>0){
	echo "repetido";
}else{	
	$sql="insert into tbl_articulos(id_categoria,codigo,nombre,e_minima,ubicacion,unidad,existencia,botella,c_botellas,estado)values('".utf8_decode($_REQUEST['cmb_categoria'])."','".utf8_decode($_REQUEST['txt_codigo'])."','".utf8_decode($_REQUEST['txt_nombre'])."','".utf8_decode($_REQUEST['txt_existenciam'])."','".utf8_decode($_REQUEST['txt_ubicacion'])."','".utf8_decode($_REQUEST['txt_unidades'])."','".utf8_decode($_REQUEST['txt_existencia'])."','".utf8_decode($_REQUEST['rnd_botellas'])."','".utf8_decode($_REQUEST['txt_cbotellas'])."','"."1"."')";
	if($_REQUEST["cmb_categoria"]==2){
		$sql="insert into tbl_articulos(id_categoria,codigo,nombre,e_minima,ubicacion,unidad,existencia,botella,c_botellas,estado,tipo,capacidad,presentacion)values('".utf8_decode($_REQUEST['cmb_categoria'])."','".utf8_decode($_REQUEST['txt_codigo'])."','".utf8_decode($_REQUEST['txt_nombre'])."','".utf8_decode($_REQUEST['txt_existenciam'])."','".utf8_decode($_REQUEST['txt_ubicacion'])."','".utf8_decode($_REQUEST['txt_unidades'])."','".utf8_decode($_REQUEST['txt_existencia'])."','".utf8_decode($_REQUEST['rnd_botellas'])."','".utf8_decode($_REQUEST['txt_cbotellas'])."','"."1"."','".utf8_decode($_REQUEST['cmb_tipo'])."','".utf8_decode($_REQUEST['txt_capacidad'])."','".utf8_decode($_REQUEST['txt_presentacion'])."')";
	}
	if($_REQUEST["cmb_categoria"]==20){
		$sql="insert into tbl_articulos(id_categoria,codigo,nombre,e_minima,ubicacion,unidad,existencia,botella,c_botellas,estado,fabricante,referencia,lote,fecha_caducidad)values('".utf8_decode($_REQUEST['cmb_categoria'])."','".utf8_decode($_REQUEST['txt_codigo'])."','".utf8_decode($_REQUEST['txt_nombre'])."','".utf8_decode($_REQUEST['txt_existenciam'])."','".utf8_decode($_REQUEST['txt_ubicacion'])."','".utf8_decode($_REQUEST['txt_unidades'])."','".utf8_decode($_REQUEST['txt_existencia'])."','".utf8_decode($_REQUEST['rnd_botellas'])."','".utf8_decode($_REQUEST['txt_cbotellas'])."','"."1"."','".utf8_decode($_REQUEST['txt_fabricante'])."','".utf8_decode($_REQUEST['txt_referencia'])."','".$_REQUEST['txt_lote']."','".$_REQUEST['txt_fecha']."')";
	}

	$query=$sql;
	$result = mysql_query($query);	
	if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	}
	$id=mysql_insert_id();
	$v_codigos=explode(",",$_REQUEST['codigos']);
	$v_volumenes=explode(",",$_REQUEST['volumenes']);	
	foreach($v_codigos as $key => $value)
	{		
			$result=mysql_query("insert into tbl_codigos (id_articulo,codigo,volumen)values('".$id."','".$value."','".$v_volumenes[$key]."')");
		
	}
	
	
	desconectar();

	echo "Success";
	
	$mensaje=" Creacion articulo ".utf8_decode($_REQUEST['txt_nombre']);
	mysql_query("Insert into tbl_bitacora (usuario,accion,fecha) values ('".$_SESSION['nombre_usuario']."','".$mensaje."','".$hoy."')");
	
	
	
	
}

}//end if opcion 2





//Consultar articulos
if($_REQUEST['opcion']==3)
{
	

	$result=mysql_query("select * from tbl_articulos where nombre='".utf8_decode($_REQUEST['txt_articulo_buscar'])."'");
	$row=mysql_fetch_assoc($result);
	if (mysql_num_rows($result)>=1){
	echo utf8_encode($row['id_categoria']."|".$row['codigo']."|".utf8_encode($row['nombre'])."|".$row['e_minima']."|".$row['ubicacion']."|".$row['unidad']."|".$row['existencia']."|".$row['botella']."|".$row['c_botellas']."|".$row['tipo']."|".$row['capacidad']."|".$row['presentacion']."|".$row['fabricante']."|".$row['referencia']."|".$row['lote']."|".$row['fecha_caducidad'] ); 	
}else{
		echo "error";
	}
	
	desconectar();
}//end if opcion 2




//modificar articulo
if($_REQUEST['opcion']==4)
{	
$result=mysql_query("update tbl_articulos set nombre='".$_REQUEST['txt_nombre']."',codigo='".$_REQUEST['txt_codigo']."',id_categoria='".$_REQUEST['cmb_categoria']."',e_minima='".$_REQUEST['txt_existenciam']."',ubicacion='".$_REQUEST['txt_ubicacion']."',unidad='".$_REQUEST['txt_unidades']."',existencia='".$_REQUEST['txt_existencia']."',botella='".$_REQUEST['rnd_botellas']."',c_botellas='".$_REQUEST['txt_cbotellas']."' where nombre='".$_REQUEST['txt_articulo_buscar']."'");

if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	}
	else{
		echo "Success";
	}
	$mensaje=" Modificacion de articulo ".utf8_decode($_REQUEST['txt_nombre']);
	$result = mysql_query("Insert into tbl_bitacora (usuario,accion,fecha) values ('".$_SESSION['nombre_usuario']."','".$mensaje."','".$hoy."')");
	desconectar();
	
}//end if opcion 4



if($_REQUEST['opcion']==5)
{

	$result=mysql_query("select nombre from tbl_articulos	 ");
	while ($row=mysql_fetch_assoc($result)){
		$vector=$vector.",".utf8_encode($row['nombre']); 
	}
	echo $vector;
	desconectar();


}//end if opcion 5


//eliminar articulo

if($_REQUEST['opcion']==6)
{		
	$result=mysql_query("delete from tbl_codigos where id_articulo=(select id from tbl_articulos where nombre='".$_REQUEST['txt_articulo_buscar']."' )");	

	$result=mysql_query("delete from tbl_articulos where nombre='".$_REQUEST['txt_articulo_buscar']."'");
	

	if (!$result) {//si da error que me despliegue el error del query
		   echo $message  = 'Query invalido: ' . mysql_error() . "\n";
			$message .= 'Query ejecutado: ' . $query;
			
	} 

	
	$mensaje=" Eliminacion de articulo ".utf8_decode($_REQUEST['txt_articulo_buscar']);
	$result = mysql_query("Insert into tbl_bitacora (usuario,accion,fecha) values ('".$_SESSION['nombre_usuario']."','".$mensaje."','".$hoy."')");
desconectar();
}//end if opcion 6

//***************************busco la exitencia y ubicacion para agregar********************
if($_REQUEST['opcion']==7)
{		
	$result=mysql_query("select * from tbl_articulos where nombre='".utf8_decode($_REQUEST['nombre'])."'");
	$row=mysql_fetch_assoc($result);
	if (mysql_num_rows($result)>=1){
		$jsondata['existencia']=$row['existencia'];
		$jsondata['minima']=$row['e_minima'];
		$jsondata['ubicacion']=$row['ubicacion'];
		$jsondata['botellas']=$row['botella'];
		$jsondata['c_botellas']=$row['c_botellas'];
		$jsondata['unidades']=$row['unidad'];
		$jsondata['codigo']=$row['codigo'];
		$result=mysql_query("select * from tbl_codigos where id_articulo='".$row['id']."' order by codigo");
		while($row=mysql_fetch_assoc($result)){
			$codigos=$codigos.$row['codigo'].",";
			$existencia=$existencia.$row['volumen'].",";
		}
		$jsondata['codigos']=$codigos;
		$jsondata['volumenes']=$existencia;
		
		echo json_encode($jsondata);
	}else{
								

		echo "error";
	}
	
	desconectar();
}//end if opcion 7

//actualizar existencia suma de inventario
if($_REQUEST['opcion']==8)
{	
$result=mysql_query("update tbl_articulos set existencia=existencia + '".$_REQUEST['txt_cantidad']."' where nombre='".utf8_decode($_REQUEST['cmb_nombrei'])."'");

if ($_REQUEST['txt_cbotellas']>=0){
	
	$result=mysql_query("update tbl_articulos set c_botellas=c_botellas+'".$_REQUEST['txt_cbotellas']."' where nombre='".utf8_decode($_REQUEST['cmb_nombrei'])."'");
	
	$result=mysql_query("select id from tbl_articulos where nombre='".utf8_decode($_REQUEST['cmb_nombrei'])."'");
	$row=mysql_fetch_object($result);
	$id=$row->id;
	
	$v_codigos=explode(",",$_REQUEST['codigos']);
	$v_volumenes=explode(",",$_REQUEST['volumenes']);	
	foreach($v_codigos as $key => $value)
	{		
			$result=mysql_query("insert into tbl_codigos (id_articulo,codigo,volumen)values('".$id."','".$value."','".$v_volumenes[$key]."')");
		
	}
	

}//end cbotellas

if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	}
	else{
		echo "Success";
	}
	$mensaje=" Agrego a articulo ".utf8_decode($_REQUEST['cmb_nombrei']). " un total de= ".$_REQUEST['txt_cantidad'];
	$result = mysql_query("Insert into tbl_bitacora (usuario,accion,fecha) values ('".$_SESSION['nombre_usuario']."','".$mensaje."','".$hoy."')");
	desconectar();
	
}//end if opcion 8


//actualizar existencia salida de inventario
if($_REQUEST['opcion']==9)
{	
$result=mysql_query("update tbl_articulos set existencia=existencia - '".$_REQUEST['txt_cantidad']."' where nombre='".$_REQUEST['cmb_nombrei']."'");

if ($_REQUEST['codigos']<>""){
	$v_codigos=explode(",",$_REQUEST['codigos']);
	$v_existencia=explode(",",$_REQUEST['volumenes']);
	$v_reducir=explode(",",$_REQUEST['reducir']);
	
	foreach($v_codigos as $key => $value)
	{		
		$tot=$tot+$v_reducir[$key];
		$result=mysql_query("update tbl_codigos set volumen=volumen-'".$v_reducir[$key]."' where codigo='".$v_codigos[$key]."'");				
		
	}
		$result=mysql_query("update tbl_articulos set existencia=existencia-'".$tot."' where nombre='".utf8_decode($_REQUEST['cmb_nombrei'])."'");				
		$result=mysql_query("delete from tbl_codigos where volumen=0");				

}//end if codigos

if ($_REQUEST['txt_cbotellas']>=0){
	$result=mysql_query("update tbl_articulos set c_botellas=c_botellas-'".$_REQUEST['txt_cbotellas']."' where nombre='".utf8_decode($_REQUEST['cmb_nombrei'])."'");	



}


$mensaje=" Elimino del articulo ".utf8_decode($_REQUEST['cmb_nombrei']). " un total de= ".$_REQUEST['txt_cantidad'];
$result = mysql_query("Insert into tbl_bitacora (usuario,accion,fecha) values ('".$_SESSION['nombre_usuario']."','".$mensaje."','".$hoy."')");

$result=mysql_query("select existencia,e_minima from  tbl_articulos where nombre='".utf8_decode($_REQUEST['cmb_nombrei'])."'");

$row=mysql_fetch_object($result);

if ($row->existencia==0){

mysql_query("delete from tbl_articulos  where nombre='".$_REQUEST['cmb_nombrei']."'");


}

if($row->existencia<$row->e_minima){
		envia_correo($_REQUEST['cmb_nombrei']);	
}



if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	}
	else{
		echo "Success";
	}
	desconectar();
	
}//end if opcion 9





//eliminar articulo

if($_REQUEST['opcion']==10)
{		
	$result=mysql_query("select * from tbl_articulos where id_categoria='".$_REQUEST['valor']."' order by nombre");
	
		while ($row=mysql_fetch_assoc($result)){
			
			$vector=$vector."|".$row['nombre']; 
	}
	echo utf8_encode($vector);
	desconectar();
}//end if opcion 10

	

function envia_correo(){

date_default_timezone_set('America/Denver');
       $dest = "mizard6@yahoo.es,fabio.granados@ucr.ac.cr,malfaro@feednet.ucr.ac.cr,jennyasc69@gmail.com,johnnyvillalobos3@gmail.com,edwinalexanderjimenez@gmail.com,molinaucr@gmail.com,amartinez@feednet.ucr.ac.cr";
       $head = "From: info@siccina.ucr.ac.cr<info@siccina.ucr.ac.cr>\r\n";
	   $asunto = "Articulo en existencia minima = ".$_REQUEST['cmb_nombrei'];
	   $email = "info@siccina.ucr.ac.cr";
		$msg="El articulo  ".$_REQUEST['cmb_nombrei']." esta dentro del rango de existencia minima.";
		mail($dest, $asunto, $msg, $head);
      

	
}


?>