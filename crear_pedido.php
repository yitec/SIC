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
        <link href="css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css' />
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
                                </select></td>
                            </tr>                                    
                            <tr>
                                <td height="25" class="Arial14Morado">Justificación <br> de la compra</td>
                                <td><textarea maxlength="200" rows="4" cols="40" name="txt_justificacion" id="txt_justificacion" ></textarea></td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td height="25" class="Arial14Morado">Bien existente en catálogo GECO</td>
                                <td>&nbsp;&nbsp;<form id="form_radio"><span class="Arial14Negro">S&iacute;</span><input type="radio" value="1" id="rnd_geco" name="rnd_geco" ><span class="Arial14Negro">No</span><input type="radio" value="0" id="rnd_geco" name="rnd_geco" ></form></td>
                            </tr>            
                        </table>
                        <div id="geco">
                            <label  class="Arial14Morado">C&oacute;digo de agrupaci&oacute;n&nbsp;</label><input id="txt_cagrup" name="txt_cagrup"  size="10"  class="inputbox" type="text" />
                            <label  class="Arial14Morado">C&oacute;digo de Articulo &nbsp;</label><input id="txt_carti" name="txt_carti"  size="10"  class="inputbox" type="text" />
                        </div>
                        <br>
                        <div id="generico"></div>                        
                        <div id="productos_dinamicos"><!--Dentro de este div se cargan todos los articulos -->                                            
                        </div><!--Dentro de este div se cargan todos los articulos -->                                            
                        <br />
                        <div><br /></div>
                        <div><br /></div>
                        <div><br /></div>
                        <div><br /></div>
                        <div><br /></div>
                        
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
            <div><input  id="txt_cantidad_lineas"  type="hidden" value="1" /></div>
  <div id="dialog-form" title="Informaci&oacute;n de la Entrega">
  <form>
  <fieldset>
  <div class="Arial14Morado">Detalle de la entrega</div>
  <div><textarea rows="4" cols="40" name="txt_detalle" consecutivo="" id="txt_detalle" ></textarea></div>
  </fieldset>
  </form>
  </div> 
            <div class="modal"></div>	
    </body>
<script src="includes/jquery-1.8.3.js" type="text/javascript"></script>
<script src="includes/ui/jquery-ui.js"></script>
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/Scripts_Pedidos.js" type="text/javascript"></script> 
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
</html>

