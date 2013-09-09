<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel ="stylesheet" href="css/general_v2.css" type="text/css" />
        <link href="css/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
        <link href="css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css' />
        <title>SIC-CINA</title>
    </head>
    <body >
    		<div class="header"></div>
    		<div class="box">                
                <div class="box_azul">
                    <div class="box_blanco">
                        <div class="titulo1" align="center"><h2>Nuevo Pedido</h2></div>
                        <table>
                            <tr>
                                <td height="29" class="Arial14Morado">Consecutivo</td>
                                <td><input id="txt_consecutivo" name="txt_consecutivo"  value="" class="inputbox"  type="text" /></td>
                            </tr>
                            <tr>
                                <td height="25" class="Arial14Morado">Nombre Solicitante</td>
                                <td ><input id="txt_nombre" name="txt_nombre"  size="40"  class="inputbox" type="text" /></td>
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
                                <td height="25" class="Arial14Morado">Nombre Proyecto</td>
                                <td><input name="txt_nom_proyecto" id="txt_nom_proyecto"  class="inputbox" type="text" /></td>
                            </tr>
                            <tr>
                                <td height="25" class="Arial14Morado">Numero Proyecto</td>
                                <td><input name="txt_num_proyecto" id="txt_num_proyecto" class="inputbox" type="text" /></td>
                            </tr>        
                            <tr>
                                <td height="25" class="Arial14Morado">Asunto</td>
                                <td><textarea rows="4" cols="40" name="txt_asunto" id="txt_asunto" ></textarea></td>
                            </tr>
                            <tr>
                                <td class="Arial14Morado">Solicitud de: </td>
                                <td><select class="combos" id="cmb_tipo" name="cmb_tipo">
                                <option value="0" selected="selected">Seleccione</option>
                                <option value="1">Mantenimiento Instalaciones Fisicas</option>
                                <option value="2">Reparaci&oacute;-Servicio T&eacute;cnico</option>
                                <option value="3">Calibraci&oacute;n</option>
                                <option value="4">Contrataci&oacute;n de Servicios</option>
                                <option value="5">Contrataci&oacute;n de Servicios</option>
                                <option value="5">Compra de:</option>
                                </select></td>
                            </tr>
                        </table>
                        <div>---------------------------------------------------------------------------------------------------------------------------------------------------</div>
                        <div align="center"><h2>Detalle del Articulo</h2></div>
                        <table>
                            <tr>
                                <td width="130" height="29" class="Arial14Morado">Cantidad</td>
                                <td width="60"><input id="txt_cantidad" name="txt_cantidad" size="10"  value="" class="inputbox"  type="text" /></td>
                            </tr>
                        </table>
                        <div id="comprade">
                            <h2>Compra de</h2>
                                <table>

                                    <tr>
                                        <td width="135" class="Arial14Morado">Compra de: </td>
                                        <td><select class="combos" id="cmb_compra" name="cmb_compra">
                                        <option value="0" selected="selected">Seleccione</option>
                                        <option value="1">Reactivos</option>
                                        <option value="2">Gases</option>
                                        <option value="3">Est&aacute;ndares</option>
                                        <option value="4">Interlaboratoriales</option>
                                        <option value="5">Cristaler&iacute;a</option>
                                        <option value="6">Repuestos</option>
                                        <option value="7">Consumible de equipos</option>
                                        <option value="8">Muebler&iacute;a</option>
                                        <option value="9">Equipo Descripci&oacute;n</option>
                                        <option value="10">Medio de Cultivo</option>
                                        <option value="11">Materiales y &uacute;tiles de laboratorio varios</option>
                                        <option value="12">Materiales de Oficina</option>
                                        <option value="13">Materiales de Limpieza</option>
                                        <option value="14">Muebler&iacute;a</option>
                                        <option value="15">Software</option>
                                        </select></td>
                                    </tr>
                                </table>
                        </div><!--Fin Div de Mantenimiento -->
                        <table>
                            <tr>
                                <td height="25" class="Arial14Morado">Acreditado</td>
                                <td><span class="Arial14Negro">No</span><input type="radio" value="1" id="rnd_acreditado" name="rnd_acreditado" ><span class="Arial14Negro">S&iacute;</span><input type="radio" value="1" id="rnd_acreditado" name="rnd_acreditado" ></td>
                            </tr>            
                        </table>
                        <br>
                        <div id="productos_1">                            
                            <div id="generico">
                            <h2>Generico</h2>
                                <table>
                                    <tr>
                                        <td height="25" class="Arial14Morado">Descripci&oacute;n</td>                                
                                        <td><textarea rows="4" cols="30" name="txt_descripcion" id="txt_descripcion" ></textarea></td>
                                        <td height="25" class="Arial14Morado">Observaciones</td>                                
                                        <td><textarea rows="4" cols="30" name="txt_descripcion" id="txt_descripcion" ></textarea></td>
                                    </tr>
                                </table>
                            </div><!--Fin Div de Mantenimiento -->
                            <div id="reparacion">
                            <h2>Reparacion</h2>
                                <table  >
                                    <tr>
                                        <td height="29" width="80" class="Arial14Morado">Equipo:</td>
                                        <td width="70"><input id="txt_equipo" name="txt_equipo"   value="" class="inputbox"  type="text" /></td>
                                        <td height="29" width="80" class="Arial14Morado">C&oacute;digo Equipo:</td>
                                        <td width="70"><input id="txt_cequipo"  name="txt_cequipo"  value="" class="inputbox"  type="text" /></td>
                                        <td height="29" width="65" class="Arial14Morado">Placa:</td>
                                        <td width="70"><input id="txt_placa" name="txt_placa"   value="" class="inputbox"  type="text" /></td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td height="25" class="Arial14Morado">Descripci&oacute;n:</td>                                
                                        <td><textarea rows="4" cols="30" name="txt_descripcion" id="txt_descripcion" ></textarea></td>
                                        <td height="25" class="Arial14Morado">Observaciones:</td>                                
                                        <td><textarea rows="4" cols="30" name="txt_observaciones" id="txt_observaciones" ></textarea></td>
                                    </tr>
                                </table>
                            </div><!--Fin Div de Reparacion-->
                            <div id="calibracion">
                            <h2>Calibracion</h2>
                                <table>
                                    <tr>
                                        <td height="29" width="80" class="Arial14Morado">Equipo:</td>
                                        <td width="70"><input id="txt_equipo" name="txt_equipo"   value="" class="inputbox"  type="text" /></td>
                                        <td height="29" width="80" class="Arial14Morado">C&oacute;digo Equipo:</td>
                                        <td width="70"><input id="txt_cequipo"  name="txt_cequipo"  value="" class="inputbox"  type="text" /></td>
                                        
                                        <td height="29"  width="60"class="Arial14Morado">Marca:</td>
                                        <td width="60"><input id="txt_marca" name="txt_marca"  value="" class="inputbox"  type="text" /></td>
                                    </tr>
                                    <tr>                                        
                                        <td height="29" width="60" class="Arial14Morado">Modelo</td>
                                        <td width="60"><input id="txt_modelo" name="txt_modelo"  value="" class="inputbox"  type="text" /></td>
                                        <td height="29" width="60" class="Arial14Morado">Serie</td>
                                        <td width="60"><input id="txt_serie" name="txt_serie"  value="" class="inputbox"  type="text" /></td>
                                        <td height="29" width="60" class="Arial14Morado">Placa</td>
                                        <td width="60"><input id="txt_placa" name="txt_placa"  value="" class="inputbox"  type="text" /></td>                                        
                                    </tr>
                                </table>
                                <br>
                                <table>    
                                    <tr>                                        
                                        <td width="60" height="25" class="Arial14Morado">Observaciones</td>                                
                                        <td width="60"><textarea rows="4" cols="40" name="txt_observaciones" id="txt_observaciones" ></textarea></td>
                                    </tr>
                                </table>
                            </div><!--Fin Div de Reparacion-->                            
                            <div id="reactivos">
                            <h2>Reactivos</h2>
                                <table>
                                    <tr>
                                        <td height="25" class="Arial14Morado">Presentaci&oacute;n</td>                                
                                        <td width="60"><input id="txt_presentacion" name="txt_presentacion"  value="" class="inputbox"  type="text" /></td>
                                        <td height="25" class="Arial14Morado">Pureza</td>                                
                                        <td width="60"><input id="txt_pureza" name="txt_pureza"  value="" class="inputbox"  type="text" /></td>
                                    </tr>
                                </table>
                            </div><!--Fin Div de reactivos -->
                            <div id="gases">
                            <h2>Gases</h2>
                                <table>
                                    <tr>
                                        <td width="60" height="25" class="Arial14Morado">Pureza</td>                                
                                        <td width="60"><input id="txt_pureza" name="txt_pureza"  value="" class="inputbox"  type="text" /></td>
                                        <td height="25" class="Arial14Morado">Capacidad</td>                                
                                        <td width="60"><input id="txt_capacidad" name="txt_capacidad"  value="" class="inputbox"  type="text" /></td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td width="60"height="25" class="Arial14Morado">Volumen Cilindro</td>                                
                                        <td width="60"><input id="txt_volument" name="txt_volumen"  value="" class="inputbox"  type="text" /></td>
                                        <td width="60"height="25" class="Arial14Morado">Tipo Conecci&oacute;n</td>                                
                                        <td width="60"><input id="txt_tipoc" name="txt_tipoc"  value="" class="inputbox"  type="text" /></td>
                                    </tr>
                                </table>
                            </div><!--Fin Div de Gases -->
                            <div id="estandar">
                            <h2>Estandar</h2>
                                <table>
                                    <tr>
                                        <td width="60" height="25" class="Arial14Morado">Pureza</td>                                
                                        <td width="60"><input id="txt_pureza" name="txt_pureza"  value="" class="inputbox"  type="text" /></td>
                                        <td width="60"height="25" class="Arial14Morado">Certificador</td>                                
                                        <td width="60"><input id="txt_certificador" name="txt_certificador"  value="" class="inputbox"  type="text" /></td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td width="60"height="25" class="Arial14Morado">Volumen Cilindro</td>                                
                                        <td width="60"><input id="txt_volument" name="txt_volumen"  value="" class="inputbox"  type="text" /></td>
                                        <td width="60"height="25" class="Arial14Morado">Tipo Conecci&oacute;n</td>                                
                                        <td width="60"><input id="txt_tipoc" name="txt_tipoc"  value="" class="inputbox"  type="text" /></td>
                                    </tr>
                                </table>
                            </div><!--Fin Div de estandar -->
                            <div id="interlaboratoriales">
                             <h2>Interlaboratoriales</h2>
                                <table>
                                    <tr>
                                        <td height="25" class="Arial14Morado">Matriz</td>                                
                                        <td width="60"><input id="txt_matriz" name="txt_matriz"  value="" class="inputbox"  type="text" /></td>
                                        <td height="25" class="Arial14Morado">Certificador</td>                                
                                        <td width="60"><input id="txt_certificador" name="txt_certificador"  value="" class="inputbox"  type="text" /></td>
                                    </tr>
                                </table>                                
                            </div><!--Fin Div de Interlaboratoriales -->    
                        </div><!--Fin Div de Productos -->
                        <div id="productos_2"></div>
                        <div id="productos_3"></div>
                        <div id="productos_4"></div>
                        <div id="productos_5"></div>
                        <div id="productos_6"></div>
                        <div id="productos_7"></div>
                        <div id="productos_8"></div>
                        <div id="productos_9"></div>
                        <div id="productos_10"></div>

                        <div id="1">This is a paragraph.</div>
                        <div id="2">This is another paragraph.</div>
                        <br />                    
                        <div  align="center">Agregar<img id="btn_agregar" name="btn_agregar" src="img/add_icon.png"></div>
                        <br>    
                        <div align="center">
                            <input  id="btn_siguiente"  type="image" onclick="validar()" src="img/btn_continuar.png" /><br />
                        </div>
                    </div>
                </div>           
			</div>		
    </body>

<script src="includes/jquery-1.8.3.js" type="text/javascript"></script>
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/Scripts_Pedidos.js" type="text/javascript"></script> 
</html>

