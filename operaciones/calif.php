<?php

//select * from face,calif where face.id = calif.id_usuario and face.id=1;
//select face.nombre, calif.c1, calif.c2, calif.c3 from face,calif where face.id = calif.id_usuario and face.id=1;

include ('../cnx/Conexion_Calidad.php');
if($_POST)
{

$q=$_POST['palabra'];//se recibe la cadena que queremos buscar
$sql_res=mysql_query("select * from tbl_archivos where nombre_archivo like '%$q%'",$c);
while($row=mysql_fetch_array($sql_res))
{
$id=$row['id'];
$nombre=$row['nombre'];
$direc=$row['direccion'];
$foto=$row['url'];


?>
<a href="usuario_completo.php?id=<?php echo $id; ?>" style="text-decoration:none;" >
<div class="display_box" align="left">
<div style="float:left; margin-right:6px;"><img src="<?php echo $foto?>" width="60" height="60" /></div> 
<div style="margin-right:6px;"><b><?php echo $nombre; ?></b></div>
<div style="margin-right:6px; font-size:14px;" class="desc"><?php 

$consulta=mysql_query("select * from calif where id_usuario=$id",$c);
while($row=mysql_fetch_array($consulta))
{
echo "Maestro con el id: ".$docente=$row['docente'];	
echo " Parcial 1= ".$c1=$row['c1'];
echo " Parcial 2= ".$c2=$row['c2'];
echo " Parcial 3= ".$c3=$row['c3'];
echo "<br>";
}
?></div></div>
</a>

<?php
}

}
else
{

}


?>
