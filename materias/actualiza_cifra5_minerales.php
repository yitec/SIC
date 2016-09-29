<?
set_time_limit(0);	
ini_set('memory_limit', '512M');
include('../cnx/conexion_materias.php');
conectarm();


$sql="select nombre,cifra5 from temp_minerales ";
$result=mysql_query($sql);
while ($row=mysql_fetch_object($result)){
	
		mysql_query("update tbl_minerales set cifra5='".$row->cifra5."' where nombre='".$row->nombre."' and cifra10>=29");
	

}

?>