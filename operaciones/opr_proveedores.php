<?php
session_start();
require_once('../cnx/conexion_compras.php');
conectarc();
$hoy=date("Y-m-d H:i:s");
//guarda un articulo en inventario
$dia=substr($_REQUEST['txt_fecha'], 3, 2);
$ano=substr($_REQUEST['txt_fecha'], 6, 4);
$mes=substr($_REQUEST['txt_fecha'], 0, 2);

$fecha=$ano."-".$mes."-".$dia." ".$_GET['cmb_ini'].":00";

if($_REQUEST['opcion']==1)
{

//busco si no existe el usuario
$result=mysql_query("select nombre from tbl_proveedores where nombre='".$_REQUEST['txt_usuario']."'");
$total=mysql_num_rows($result);
if($total>0){
	echo "repetido";
}else{
	$query="insert into tbl_proveedores(nombre,cedula,correo,marcas,tel_cel,tel_fijo,fax,nota,contacto,estado)values('".utf8_decode($_REQUEST['txt_nombre'])."','".$_REQUEST['txt_cedula']."','".$_REQUEST['txt_correo']."','".$_REQUEST['txt_marcas']."','".$_REQUEST['txt_tel_cel']."','".$_REQUEST['txt_tel_fijo']."','".$_REQUEST['txt_fax']."','".$_REQUEST['txt_nota']."','".$_REQUEST['txt_contacto']."','".$_REQUEST['rnd_activo']."')";
	$result = mysql_query($query);	
	if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	}
	echo "Success";
}

}//end if opcion 1



//Consultar usuarios
if($_REQUEST['opcion']==2)
{	
	$result=mysql_query("select * from tbl_proveedores where nombre='".utf8_decode($_REQUEST['usuario'])."'");
	$row=mysql_fetch_assoc($result);
	if (mysql_num_rows($result)>=1){
	echo utf8_encode($row['nombre'])."|".$row['cedula']."|".$row['correo']."|".$row['marcas']."|".$row['tel_cel']."|".$row['tel_fijo']."|".$row['fax']."|".$row['nota']."|".$row['contacto']."|".$row['estado'] ; 	}else{
		echo "error";
	}
	
	desconectarc();
}//end if opcion 2


//modificar usuario
if($_REQUEST['opcion']==3)
{	
$result=mysql_query("update tbl_proveedores set nombre='".utf8_decode($_REQUEST['txt_nombre'])."',cedula='".$_REQUEST['txt_cedula']."',correo='".$_REQUEST['txt_correo']."',marcas='".$_REQUEST['txt_marcas']."',tel_cel='".$_REQUEST['txt_tel_cel']."',tel_fijo='".$_REQUEST['txt_tel_fijo']."',fax='".$_REQUEST['txt_fax']."',nota='".$_REQUEST['txt_nota']."',contacto='".$_REQUEST['txt_contacto']."',estado='".$_REQUEST['rnd_activo']."' where nombre='".utf8_decode($_REQUEST['txt_usuario_buscar'])."'");

	//$result=mysql_query("update tbl_usuarios set nombre='".$_REQUEST['txt_nombre']."',cedula='".$_REQUEST['txt_cedula']."',correo='".$_REQUEST['txt_correo']."',fax='".$_REQUEST['txt_fax']."',direccion='".$_REQUEST['txt_direccion']."',tel_fijo='".$_REQUEST['txt_tel_fijo']."',tel_cel='".$_REQUEST['txt_tel_cel']."',tipo_cliente='".$_REQUEST['cmb_tipo']."',consumible='".$_REQUEST['txt_consumible']."',consumido='".$_REQUEST['txt_consumido']."',credito='".$_REQUEST['rnd_credito']."' where nombre='".$_REQUEST['txt_usuario_buscar']."'");

if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
} 
desconectarc();
}//end if opcion 3


if($_REQUEST['opcion']==4)
{		
	$result=mysql_query("delete from tbl_proveedores where nombre='".$_REQUEST['txt_usuario_buscar']."'");
	

	if (!$result) {//si da error que me despliegue el error del query
		   echo $message  = 'Query invalido: ' . mysql_error() . "\n";
			$message .= 'Query ejecutado: ' . $query;
			
	} 
desconectarc();
}//end if opcion 4

if($_REQUEST['opcion']==5)
{

	$result=mysql_query("select nombre from tbl_proveedores	 ");
	while ($row=mysql_fetch_assoc($result)){
		$vector=$vector.",".utf8_encode($row['nombre']); 
	}
	echo $vector;
	desconectarc();


}//end if opcion 6



	

?>