
<?
session_start();
require_once('cnx/conexion.php');
conectar();

$sql="select * from tbl_temporal where cantidad_analisis>=5";
$result=mysql_query($sql);

while($row=mysql_fetch_object($result)){

/*
//busca las categorias
$sql2="select ana.id_analisis, cat.nombre,catmu.nombre as categoria from tbl_analisis ana inner join tbl_categoriasanalisis cat 
on ana.id_analisis=cat.id
inner join tbl_categoriasmuestras catmu 
  on cat.ids_categoriaMuestra=catmu.id  
 where ana.id_contrato='".$row->consecutivo."' and ana.id_muestra='".$row->numero_muestra."' limit 1";
$result2=mysql_query($sql2);
$row2=mysql_fetch_object($result2);
	echo $sql3="update tbl_temporal set Categoria='".$row2->categoria."' where id_muestra='".$row->id_muestra."'";
	echo "<br>";
	$result3=mysql_query($sql3);
*/

/* actualiza las sub categorias
$sql2="select * from `tbl_infmuestras` where cons_contrato='".$row->consecutivo."'";
$result2=mysql_query($sql2);
$row2=mysql_fetch_object($result2);
	echo $sql3="update tbl_temporal set sub_categoria='".$row2->tipo_alimento."',nombre_producto='".$row2->nombre_producto."' where id_muestra='".$row->id_muestra."'";
	echo "<br>";
	$result3=mysql_query($sql3);
*/


/*actualiza la cantidad de analisis por muestras


  $sql2=utf8_decode("select count(1) as total from tbl_analisis where id_contrato='".$row->consecutivo."' and id_muestra='".$row->numero_muestra."'
and id_analisis in (select id from tbl_categoriasanalisis where nombre in ('Proteína Cruda','fibra cruda','materia seca','eln','extracto etereo','energia bruta','Humedad 135° C','cenizas') )");
	$result2=mysql_query($sql2);
	$row2=mysql_fetch_object($result2);
	echo $sql3="update tbl_temporal set cantidad_analisis='".$row2->total."' where id_muestra='".$row->id_muestra."'";
	echo "<br>";
	$result3=mysql_query($sql3);


	if($row->total>=5){
	echo "Consecutivo->".$row->consecutivo." Muestra->".$row->numero_muestra." Total analisis->".$row2->total;
	echo "<br>";
	}
*/
echo "*******************************************************************<br>";
echo "Nombre Producto->".$row->nombre_producto."<br>";
$sql2="select codigo, nombre from bd_materiasprimas.tbl_codigos where nombre like '%".$row->nombre_producto."%' ";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_object($result2)){
	echo $row2->nombre."<br>";
	if ($row2->nombre!=''){
		$sql3="update tbl_temporal set codigo_materia='".$row2->codigo."',nombre_materia='".$row2->nombre."' where id_muestra='".$row->id_muestra."'";
		$result3=mysql_query($sql3);
	}
}





}//end while



?>