<?php 
/*
Mysql To Excel
Generación de excel versión 1.0
Nicolás Pardo - 2007
*/
#Conexion a la db
require_once('../cnx/conexion_calidad.php');
conectar();
#Cambiando el content-type más las <table> se pueden exportar formatos como csv
header("Content-type: application/vnd-ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=ControlMaestro_".date('d-m-Y').".xls");
#Sql, acá pone tu consulta a la tabla que necesites exportar filtrando los datos que creas necesarios.
$consulta = "SELECT `nombre_categoria`, `nombre_subcat`, `nombre_archivo`, `version`, `url_archivo`, `url_online` FROM `vista_maestro` WHERE `estado` = 1";
$dt=mysql_query($consulta);
 ?>   
<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD  bgcolor="#CCCCCC">CATEGORIA</TD>
<TD bgcolor="#CCCCCC">SUBCATEGORIA</TD>
<TD bgcolor="#CCCCCC">NOMBRE</TD>
<TD bgcolor="#CCCCCC">VERSION</TD>
<TD bgcolor="#CCCCCC">ARCHIVO</TD>
<TD bgcolor="#CCCCCC">URL</TD>

</TR>
<?php
while($info = mysql_fetch_array($dt)) {
printf("<tr>
<td>&nbsp;%s</td>
<td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
<td>&nbsp;%s</td>
</tr>", $info[0],$info[1],$info[2],$info[3],$info[4],$info[5]);
}

?>