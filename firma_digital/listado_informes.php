<?php

include ('../cnx/conexion.php');
$hoy=date("Y-m-d H:i:s");
conectar();
$consulta = "SELECT * FROM `vista_maestro` WHERE `estado` =1 ORDER BY `prefijo` ASC";	
$dt=mysql_query($consulta);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel ="stylesheet" href="../css/firma_digital.css" type="text/css" />
        <link rel ="stylesheet" href="../css/cuadros.css" type="text/css" />
        <link rel ="stylesheet" href="../css/tablas_fdigital.css" type="text/css" />
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
    <th class="titulo_tablas">Contrato</th>
    <th class="titulo_tablas">Status Actual</th>
    <th class="titulo_tablas">Requiere Firmas</th>
    <th class="titulo_tablas">Fecha Qu&iacute;mica</th>
    <th class="titulo_tablas">Fecha Zootecnia</th>
    <th class="titulo_tablas">Fecha Microbiolog&iacute;a</th>
    <th class="titulo_tablas">Fecha Bromatolog&iacute;a</th>
    <th class="titulo_tablas">Acción</th>
    </tr>
    <?
    $sql = "SELECT * FROM tbl_contratos WHERE estado =4 and fecha_ingreso>='20170201' ORDER BY consecutivo desc ";   
    $result=mysql_query($sql);				
    while($row=mysql_fetch_object($result)){
        $quimi='No Aplica';$micro='No Aplica';$broma='No Aplica';$zoo='No Aplica';
        $sql2 = "SELECT id_laboratorio FROM tbl_analisis WHERE id_contrato='".$row->consecutivo."' GROUP by id_laboratorio";
        $result2=mysql_query($sql2);
        while($row2=mysql_fetch_object($result2)){
            if($row2->id_laboratorio==1){
                $firmas="Química-Zootecnia";
                $quimi=1;
                $zoo=1;
            }
            if($row2->id_laboratorio==2){
                $firmas="-Microbiología";
                $micro=1;
            }

            if($row2->id_laboratorio==3){
                $firmas="-Bromatología";
                $broma=1;
            }
        }
        if($quimi==1){
            if($row->fecha_fquimica==''){
                $quimi="Pendiente";
            }else{
                $quimi=$row->fecha_fquimica;
            }
        }
        if($zoo==1){
            if($row->fecha_fzootecnia==''){
                $zoo="Pendiente";
            }else{
                $zoo=$row->fecha_fzootencia;
            }
        }
        if($broma==1){
            if($row->fecha_fbroma==''){
                $broma="Pendiente";
            }else{
                $broma=$row->fecha_fbroma;
            }
        }
        if($micro==1){
            if($row->fecha_fmicro==''){
                $micro="Pendiente";
            }else{
                $micro=$row->fecha_fmicro;
            }
        }

	echo '
    <tr>
    <td class="datos_tablas">'.$row->consecutivo.'</td>
    <td class="datos_tablas">'.$row->consecutivo.'</td>
    <td class="datos_tablas">'.$firmas.'</td>
    <td class="datos_tablas">'.$quimi.'</td>
    <td class="datos_tablas">'.$zoo.'</td>
    <td class="datos_tablas">'.$micro.'</td>
    <td class="datos_tablas">'.$broma.'</td>
    <td class="datos_tablas">'.$row->consecutivo.'</td>
    </tr>';
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

