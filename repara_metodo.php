<?
session_start();
require_once('cnx/conexion.php');
conectar();
$result=mysql_query("select id from tbl_resultados where metodo='"." "."'");
while ($r1=mysql_fetch_object($result)){

 $res=mysql_query("select c.metodo from tbl_resultados r, tbl_analisis a, tbl_categoriasanalisis c where r.id='".$r1->id."' and a.id=r.id_analisis and c.id=a.id_analisis")	;
 $r2=mysql_fetch_object($res);
 echo $r2->metodo."<br>";
	mysql_query("update tbl_resultados set metodo='".$r2->metodo."' where id='".$r1->id."'");

}


?>