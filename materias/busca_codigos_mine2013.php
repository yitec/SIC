<?
set_time_limit(0);	
ini_set('memory_limit', '512M');
include('../cnx/conexion_materias.php');
conectarm();


$sql="select id,tipo_muestra,nombre_muestra,nombre_producto from tbl_mine2015";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	
	$sql2="select codigo,nombre from tbl_codigos_minerales where nombre like '%".$row->nombre_producto."%' or nombre like '%".$row->tipo_muestra."%' or nombre like '%".$row->nombre_muestra."%'" ;
	$result2=mysql_query($sql2);
	if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;		
		} 
	$row2=mysql_fetch_object($result2);
	echo "<br>".$row->nombre_producto."------".$row2->nombre;
	if ($row2->codigo>0){
		
		echo"<br>1";
		echo"<br>";
		echo $sql3="update tbl_mine2015 set codigo='".$row2->codigo."', nombre='".$row2->nombre."' where id='".$row->id."'";
		mysql_query($sql3);
	}

}

echo '<br>*********************************************tabla de codigos adicionales************************';
echo '*********************************************tabla de codigos adicionales************************';
echo '*********************************************tabla de codigos adicionales************************';
echo '*********************************************tabla de codigos adicionales************************';
echo '*********************************************tabla de codigos adicionales************************<br>';



$sql="select id,tipo_muestra,nombre_muestra,nombre_producto from tbl_mine2015";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
		$sql2="select codigo,nombre_muestra from tbl_codigos_minerales_adicionales where tipo_muestra like '%".$row->tipo_muestra."%' or nombre_muestra like '%".$row->nombre_muestra."%' or nombre_producto like '%".$row->nombre_producto."%'" ;
		$result2=mysql_query($sql2);
		
		if(mysql_num_rows($result2)>0){
			$row2=mysql_fetch_object($result2);
			echo"<br>2";
			echo"<br>";
			echo $sql3="update tbl_mine2015 set codigo='".$row2->codigo."', nombre='".strTOUPPER($row->tipo_muestra)."' where id='".$row->id."'";
		mysql_query($sql3);
		}
		
}



?>