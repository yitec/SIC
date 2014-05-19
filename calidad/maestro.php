<?php

include ('../cnx/conexion_calidad.php');
$hoy=date("Y-m-d H:i:s");
conectarc();
$consulta = "SELECT * FROM `vista_maestro` WHERE `estado` =1 ORDER BY `prefijo` ASC";	
$dt=mysql_query($consulta);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel ="stylesheet" href="../css/calidad.css" type="text/css" />
        <link rel ="stylesheet" href="../css/cuadros.css" type="text/css" />
        <link rel ="stylesheet" href="../css/tablas_calidad.css" type="text/css" />
        <link rel ="stylesheet" href="../css/jquery.pnotify.default.css" type="text/css" />
        <link rel ="stylesheet" href="../css/ui-lightness/jquery-ui-1.8.18.custom.css" type="text/css" />        
        <title>SIC CINA</title>
    </head>
<body >
<div class="header"></div>
<div style="margin-left:950px;  margin-top:5px; " ><a href="javascript:history.back(-1)">Volver</a>&nbsp;-&nbsp;<a href="control_calidad.php">Men&uacute;</a>&nbsp;-&nbsp;<a href="../login.php">Salir</a></div>
	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Control Maestro</div>
    <div align="center" class=" Arial14Negro" style="margin-bottom:10px; margin-top:10px;">
    <table cellpadding="0" cellspacing="0"class="diseno_tablas">
    <tbody>
    <tr>
    <th class="titulo_tablas">Categoria</th>
    <th class="titulo_tablas">Código</th>
    <th class="titulo_tablas">Nombre</th>
    <th class="titulo_tablas">Versión</th>
    <th class="titulo_tablas">Emisión o derogación</th>
    <th class="titulo_tablas">Última revisión</th>
    <th class="titulo_tablas">Archivo</th>
    </tr>
     <?php				
    while($info=mysql_fetch_array($dt)){

	//echo '<div class="maestro_lista">'.utf8_encode($info[9]).'</div><div class="maestro_lista">'.utf8_encode($info[10]).'</div><div class="maestro_lista">'.utf8_encode($info[3]).'</div><div class="maestro_lista">'.utf8_encode($info[4]).'</div><div class="maestro_lista"><a target="_blank" href="http://localhost/SIC/calidad/archivos/ControlCalidad/'.($info[7]).'">Ver Archivo</a></div>

	//echo '<div class="maestro_lista1">'.utf8_encode($info[1]).'</div><div class="maestro_lista">'.utf8_encode($info[4]).'</div><div class="maestro_lista3">'.utf8_encode($info[3]).'</div><div class="maestro_lista">'.utf8_encode($info[6]).'</div><div class="maestro_lista1">'.utf8_encode($info[10]).'</div><div class="maestro_lista"><a target="_blank" href="'.($info[8]).'">Ver Archivo</a></div>';
    ?>
    <tr>
    <?
    if ($info[8]!=""){
        $archivo= "http://localhost/SIC/calidad/archivos/ControlCalidad/".$info[8];
    }else{
        $archivo= "http://".$info[9];
    }

	echo '
    
    <td class="datos_tablas">'.utf8_encode($info[15]).'</td>
    <td class="datos_tablas">'.$info[16].'-'.$info[1].'</td>
    <td class="datos_tablas">'.utf8_decode($info[4]).'</td>
    <td class="datos_tablas">'.utf8_encode($info[5]).'</td>
    <td class="datos_tablas">'.utf8_encode($info[6]).'</td>
    <td class="datos_tablas">'.utf8_encode($info[10]).'</td>
    <td class="datos_tablas"><a target="_blank" href="'.$archivo.'">Ver Archivo</a></td>';
    ?>
    </tr>
    <?
    } //end while
    ?>
    
    </tbody>
    </table>
    </div>

     
	<div align="center" style="margin-top:20px; margin-bottom:20px;">
	  <a href="../includes/genera_maestroExcell.php" target="_blank"> <input type="button" name="boton" value="Generar Archivo Excell" /> </a>
	</div>    




	
</body>
<script src="../includes/jquery-1.8.3.js" type="text/javascript"></script>
<script src="../includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="../includes/Scripts_Calidad.js" type="text/javascript"></script> 
</html>

