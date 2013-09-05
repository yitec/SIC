<?
session_start();
require_once('../cnx/session_activa.php');
require_once('../cnx/conexion_inventario.php');
conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css" />
<link href="../css/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
<link href="../css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />

<script src="../includes/jquery-1.6.1.js" type="text/javascript"></script>
<script src="../includes/jquery.pnotify.js" type="text/javascript"></script> 

<script src="../includes/jquery.ui.core.js"></script>
<script src="../includes/jquery.ui.widget.js"></script>
<script src="../includes/jquery.ui.autocomplete.js"></script>
<script src="../includes/jquery.ui.position.js"></script>

<script src="../includes/Scripts_Inventarios.js" type="text/javascript"></script> 



</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Ingreso Inventario</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:3000px"></div>
<div    class="contenido_gm">


<?
require_once('menu_superior.php');
?>


<div id="mainAzulFondo" style="padding:10px;" align="center">
<div id="mainBlancoFondo" style=" width:750px;" align="center">
	<input name="accion" id="accion" type="hidden" value="sumar" />
	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Ingreso de inventario</div><br />
    <table>
	 <tr>
     <td>
     <span class=" Arial14Negro">Categoría</span>
     </td>
     <td>
     <span class="Arial14Negro">Articulo</span>
     </td>
     </tr>
     <tr>
     <td>     
        <select name="cmb_categoria" id="cmb_categoria" class="combos" >
		<option value="Seleccione">Seleccione</option>
		<?
        $result=mysql_query("select * from tbl_categorias order by nombre");
		while($row=mysql_fetch_object($result)){
			echo '<option value='.utf8_encode($row->id).'>'.utf8_encode($row->nombre).'</option>';	
			
		}
		?>

        </select>
     
     </td>
     
     
     	<td>
        
        <select name="cmb_nombrei" id="cmb_nombrei" class="combos">
        
       
	      
	      </select>
     	</td>
        
        <div id="actual" align="center" class="Arial14Negro"></div><br />
     
     </tr>
	        
	  </table>
      <br />
      <div id="mainGrisFondo" >
      <span align="center" class=" Arial18Azul">
      Cantidad en unidades
      </span>
        <br>
      <span align="center"  class=" Arial18Azul">
      <input size="10" class="inputbox" name="txt_cantidad" id="txt_cantidad" type="text" />
      </span> 
	  </div>
      <div id="n_botellas" >
      <span align="center" id="b_titulo" class=" Arial18Azul">
      Agregar
      </span>
      <br />
                    
      <span align="center" id="b_input" class=" Arial18Azul"><img src="../img/add_icon.png" id="btn_codigos" width="20" height="20" />
      </span>
       
      </div>
<div id="botellas">
</div>

<div id="detalles">
<table cellpadding="0" cellspacing="0" bordercolor="#a6c9e2" border="1">
		<tr id="linea1"></tr>
        <tr id="linea2"></tr>
        <tr id="linea3"></tr>
        <tr id="linea4"></tr>
        <tr id="linea5"></tr>
        <tr id="linea6"></tr>
        <tr id="linea7"></tr>
        <tr id="linea8"></tr>
        <tr id="linea9"></tr>
        <tr id="linea10"></tr>
        <tr id="linea11"></tr>
        <tr id="linea12"></tr>
        <tr id="linea13"></tr>
        <tr id="linea14"></tr>
        <tr id="linea15"></tr>
        <tr id="linea16"></tr>
        <tr id="linea17"></tr>
        <tr id="linea18"></tr>
        <tr id="linea19"></tr>
        <tr id="linea20"></tr>
</table>
<input name="total_codigos" id="total_codigos" type="hidden" value="" />

</div>      


           
       <br />
	<div align="center" style="margin-top:20px; margin-bottom:20px;"><input name="btn_guardar" id="btn_guardari" type="image" src="../img/btn_guardar.png" /></div>    

</div><!--fin cuadro blanco--> 
</div><!--fin cuadro azul--> 




</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:3000px"></div>
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
