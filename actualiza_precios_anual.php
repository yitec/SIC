<?
session_start();
require_once('cnx/conexion.php');
require_once('cnx/session_activa.php');
conectar();

$result=mysql_query("select * from tbl_precios_anuales");
while ($row=mysql_fetch_object($result)){

	$r2=mysql_query("update tbl_categoriasanalisis set precio='".$row->precio."' where nombre='".$row->nombre."' and precio>1 ");
	$tot=$tot + mysql_affected_rows();
}
echo "Total=".$tot;

 

?>