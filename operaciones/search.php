<?php
include ('../cnx/conexion_calidad.php');
conectar();
if($_POST)
{

$q=$_POST['palabra'];//se recibe la cadena que queremos buscar
$result=mysql_query("select * from tbl_archivos where nombre_archivo like '%$q%'");
while($row=mysql_fetch_array($result))
{
$id=$row[0];
$nombre=$row[3];
$urlarchivo=$row[7];


?>
<a href="archivos/ControlCalidad/<?php echo $urlarchivo; ?>" style="text-decoration:none;" >
<div class="display_box" align="left">
<div style="margin-right:6px;"><b><?php echo $nombre; ?></b></div>
<div style="margin-right:6px; font-size:14px;" class="desc"><?php echo $urlarchivo; ?></div></div>
</a>

<?php
}

}
else
{

}


?>
