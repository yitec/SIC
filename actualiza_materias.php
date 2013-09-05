<?
require_once('cnx/conexion.php');
conectar();
require_once('cnx/conexion_materias.php');
conectarm();

$result=mysql_query("select * from bd_materiasprimas.tbl_actualiza_materias");

while ($r1=mysql_fetch_object($result)){
	echo $r1->nombre."<br>"; 
	$result2=mysql_query("select id from tbl_subcatmuestras where nombre='".$r1->nombre."'");
	if (mysql_num_rows($result2)>=1){
	$r2=mysql_fetch_object($result2);
	echo $r2->id;	
	$result3=mysql_query("update bd_materiasprimas.tbl_codigos_alimentos set id_subcatmuestra='".$r2->id."' where id='".$r1->id_categoria."'");
	$tot=$tot + mysql_affected_rows();
	}
	
}
echo "Total=".$tot;




?>