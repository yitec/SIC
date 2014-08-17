<?

session_start();
include ('../cnx/conexion_activos.php');
conectara();

$result=mysql_query("select * from tbl_activos where id_activos not in (select id_activo from tbl_activo_categoria) order by activo");
while ($row=mysql_fetch_object($result)){

	$result2=mysql_query("insert into tbl_activo_categoria (id_categoria,id_activo)values(8,'".$row->id_activos."')");
	echo "<br>".$row->id_activos;
}

?>