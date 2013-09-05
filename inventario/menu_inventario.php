<?
session_start();
require_once('../cnx/conexion.php');
require_once('../cnx/session_activa.php');
conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="../includes/jquery-1.6.1.js"></script>
<script type="text/javascript" src="../includes/jquery.fancybox-1.3.4.pack.js"></script>

<script>
function redirigir(id){
window.location = "imprime_muestras.php?id="+id;	
}

</script>
</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g">
  <div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Inventario</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:1000px;"></div>
<div    class="contenido_gm">


<?
require_once('menu_superior.php');
?>
<div id="mainAzulFondo" align="center" style="   height:auto; width:auto;">
<div id="mainBlancoFondo"  >

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">Menú Inventario</div>
    <div align="center" id="mainBlancoMolienda">
    <table cellpadding="0" cellspacing="0" border="0">
        
        <tr>
          <td><img src="../img/azul_izquierda.png" /></td>
          <td><div align="center" class=" Arial14blanco" id="consecutivo"  style=" float:left; height:21px; width:731px;background: #7ac9e9;"> Opciones<div class=" Arial14blanco" style="position:relative; margin-left:240px; margin-top:-15px; "  id="num_factura"></div></div>
                                              
          </td>
          <td><img src="../img/azul_derecha.png" /></td>
        </tr>
      </table>
      <table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
        <tr>
          <td><div align="center" class="azulColumn">Salida de Inventario</div></td>
          <td><div align="center" class="azulColumn">Ingreso de Inventario</div></td>
          <td><div align="center" class="azulColumn">Nuevo articulo</div></td>
                    
          <td><div align="center" class="azulColumn">Crear Categoria</div></td>
          <td><div align="center" class="azulColumn">Reportes</div></td>
          
          
        </tr>
  
        <tr>
          <td><br />
            <div align="center" class="Arial14Negro">
            <a href="salida_inventario.php">
            <img src="../img/minusi.png" width="48" height="47" />
            </a>
            </div><br />
          </td>
          <td><br />
          <div align="center" class="Arial14Negro">
          <a href="ingreso_inventario.php">
          <img src="../img/plusi.png" width="48" height="48" />
          </a>
          </div><br />
          </td>
          <td><br />
          <div align="center" class="Arial14Negro">
          <a href="crear_articulo.php">
          <img src="../img/articuloi.png" width="48" height="47" />
          </a>
          </div><br />
          </td>
          <td><br />
          <div align="center" class="Arial14Negro">
          <a href="mantenimiento_categorias.php">
          <img src="../img/nuevoi.png" width="48" height="47" />
          </a>
          </div><br />
          </td>
          <td><br />
          <div align="center" class="Arial14Negro">
          <a href="reportes.php">
          <img src="../img/xcel.png" width="48" height="47" />
          </a>
          </div><br />
          </td>
          
        </tr>
       
      </table>
    </div>
</div><!--fin cuadro gris--> 
</div><!--fin cuadro Azul--> 

</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:1000px;"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g"></div>
<div class="der_inf_g"></div>

<div align="center" style=" margin-left:350px;float:left" class="Arial8negro">
Sistema de Control e Informaci&oacute;n.  
</div>
<div align="center" style="float:left" class="Arial8azul">&nbsp;CINA.&nbsp;
</div>
<div align="center" style="float:left" class="Arial8negro">
Versi&oacute;n 1.0
</div>
</td></tr></table>

</div>




</body>

</html>
