<?
set_time_limit(0);	
ini_set('memory_limit', '512M');
include('../cnx/conexion_materias.php');
conectarm();


$sql="select id,tipo_muestra,nombre_producto from tbl_proxi2013";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	
	$sql2="select codigo,nombre from tbl_codigos where nombre like '%".$row->nombre_producto."%' or nombre like '%".$row->tipo_muestra."%'";
	$result2=mysql_query($sql2);
	if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;		
		} 
	$row2=mysql_fetch_object($result2);
	echo "<br>".$row->nombre_producto."------".$row2->nombre;
	if ($row2->nombre==''){
		mysql_query("update tbl_proxi2013 set codigo='".$row2->codigo."', nombre='".strTOUPPER($row->nombre_producto)."' where id='".$row->id."'");
	}else{
		mysql_query("update tbl_proxi2013 set codigo='".$row2->codigo."', nombre='".$row2->nombre."' where id='".$row->id."'");
	}

}

?>