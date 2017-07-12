<?
session_start();
require_once('cnx/conexion_compras.php');
conectarc();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel ="stylesheet" href="css/pedidos.css" type="text/css" />
        <link href="css/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/ui-lightness/jquery.ui.all.css">
        <link rel="stylesheet" href="css/ui-lightness/demos.css">
        

        <title>SIC-CINA</title>
    </head>
    <body >
            
    		<div class="header"></div>
    		<div class="box"> 
            <div style="margin-top:20px;"><?require_once('menu_superior.php');?></div>               
                <div class="box_azul">
                    <div class="box_blanco">
                        <div class="titulo1" align="center"><h2>Nuevo Pedido</h2></div>
                        <table>
                            <tr>
                                <td height="29"  class="Arial14Morado">Consecutivo</td>
                                <?
                                $result=mysql_query("SELECT max(id_consecutivo) as consecutivo FROM tbl_consecutivos  ");
                                $row=mysql_fetch_object($result);
                                $cons=$row->consecutivo+1;
                                $_SESSION['consecutivo']='CO-'.$cons."-".date("Y");
                                ?>
                                <td><input  id="txt_consecutivo" name="txt_consecutivo"  value="CO-<?=$cons."-".date("Y");?>" class="inputbox"  type="text" disabled /></td>
                            </tr>
                            <tr>
                                <td height="25" class="Arial14Morado">Nombre Solicitante</td>
                                <td ><input id="txt_nombresoli" name="txt_nombresoli" value="<?=$_SESSION['nombre_usuario'];?>" disabled size="40"  class="inputbox" type="text" /></td>
                                <input type="hidden" id="txt_correo" value="<?=$_SESSION['correo'];?>">
                            </tr>
                            <tr>
                                <td height="25" class="Arial14Morado">Secci&oacute;n</td>
                                <td><select class="combos" id="cmb_seccion" name="cmb_seccion">
                                <option selected="selected">Qu&iacute;mica</option>
                                <option >Microbiolog&iacute;a</option>
                                <option >Bromatolog&iacute;a</option>
                                <option >UGC</option>
                                <option >Administraco&oacute;n</option>
                                </select></td>
                            </tr>                                    
                            <tr>
                                <td height="25" class="Arial14Morado">Justificación <br> de la compra</td>
                                <td><textarea maxlength="200" rows="4" cols="40" name="txt_justificacion" id="txt_justificacion" ></textarea></td>
                            </tr>
                        </table>
                        <img src="img/plus.png" id="btn_addtab" title="Agregar Muestra" width="20" height="20">
                       <div id="tabs">
  <ul>
    <li><a href="#tabs-0">Articulo 1</a></li>
    <li><a href="#tabs-2">Articulo 2</a></li>
    <li><a href="#tabs-3">Articulo 3</a></li>
  </ul>
  <div id="tabs-0">
    <div id="comprade_'+nproductos+'"><br class="none"><div class="Arial14Morado subtitulosl fl">Tipo de compra: </div><div><select class="combos" id="cmb_compra_'+nproductos+'" numero="'+nproductos+'" name="cmb_compra_0"><option value="0" selected="selected">Seleccione</option><option value="1">Reactivos</option><option value="2">Gases</option><option value="3">Cristalería</option><option value="4">Repuestos/Consumible de equipo</option><option value="5">Equipos</option><option value="6">Materiales Laboratorio</option><option value="7">Calibraciones</option><option value="8">Reparación o mantenimiento de equipo</option><option value="9">interlaboratoriales</option><option value="10">Medio de Cultivo</opcionption><option value="11">Software</option><option value="12">Capacitaciones</option><option value="13">Inscripciones, congresos etc</option><option value="14">Materiales de referencia</option></select></div><br>
  </div>
  <div id="tabs-2">
    <h2>Content heading 2</h2>
    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
  </div>
  <div id="tabs-3">
    <h2>Content heading 3</h2>
    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
    <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
  </div>
</div>
                       
                        <br><br>
                        <div  id="agregar" align="center"><input  id="btn_agregar"  type="image"  src="img/agregar.png" /></div>                        
                        <br>
                        <div align="center" class="Arial14Morado"><a id="ver" href="cotizacion_upload.php">Subir archivo<img src="img/add_icon.png" width="25" height="25"  /></a></div>
                        <br>   
                        <div id="siguiente" align="center">
                            <input  id="btn_siguiente"  type="image"  src="img/btn_continuar.png" /><br />
                        </div>
                    </div>
                </div>           
			</div>	
            

  </div> 
            <div class="modal"></div>	
    </body>

    <script src="includes/jquery-1.7.1.js"></script>
    <script src="includes/jquery.ui.core.js"></script>
    <script src="includes/jquery.ui.widget.js"></script>
    <script src="includes/jquery.ui.tabs.js"></script>

<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/Scripts_Pedidosv4.js" type="text/javascript"></script> 
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>

</html>

