<?
session_start();
?>
<body>

<div id="mainGris" style="height:510px;"><!--Cuadro Gris-->
	<? if (in_array(1, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px; margin-top:10px;  float:left;">
    <div align="center" class="Arial14Negro"><a href="ingresa_contrato.php"><img src="img/add.png" width="48" height="48"></a>Crear&nbsp;&nbsp; Contrato</div>
    </div>
    <? } ?>
    
	<? if (in_array(4, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="molienda.php"><img src="img/molienda.png" width="48" height="48"></a>Molienda Pendientes</div>
    </div>
    <? } ?>

	<? if (in_array(5, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="analisis_quimica.php"><img src="img/analisis.png" width="48" height="48"></a>An&aacute;lisis Qu&iacute;mica</div>
    </div>
    <? } ?>
	<? if (in_array(6, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="analisis_micro.php"><img src="img/analisis.png" width="48" height="48"></a>An&aacute;lisis Microbiolog&iacute;a</div>
    </div>
    <? } ?>
	<? if (in_array(7, $_SESSION['perfil'])){
	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="analisis_bromatologia.php"><img src="img/analisis.png" width="48" height="48"></a>An&aacute;lisis Bromatolog&iacute;a</div>
    </div>
    <? } ?>
    <? if (in_array(8, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="resultados_quimica.php"><img src="img/resultados.png" width="48" height="48"></a>Resultados Qu&iacute;mica</div>
    </div>
    <? } ?>

	<? if (in_array(9, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="resultados_micro.php"><img src="img/resultados.png" width="48" height="48"></a>Resultados Micro</div>
    </div>
    <? } ?>
    
    <? if (in_array(10, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="resultados_bromatologia.php"><img src="img/resultados.png" width="48" height="48"></a>Resultados Bromatolog&iacute;a</div>
    </div>
    <? } ?>
	<? if (in_array(11, $_SESSION['perfil'])){	?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="reportes/reportes.php"><img src="img/xcel.png" width="48" height="48"></a>Visualizar Reportes</div>
    </div>
    <? } ?>
    
    <? if (in_array(12, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="mantenimiento_usuario.php"><img src="img/usuarios.png" width="48" height="48"></a>Mantenimiento Usuarios</div>
    </div>
    <? } ?>
    <? if (in_array(13, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="mantenimiento_clientes.php"><img src="img/clientes.png" width="48" height="48"></a>Mantenimiento Clientes</div>
    </div>
    <? } ?>
     <? if (in_array(14, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="reimprime_etiquetas.php"><img src="img/printing.png" width="48" height="48"></a>Reimprimir Etiqueta</div>
    </div>
    <? } ?>
    <? if (in_array(15, $_SESSION['perfil'])){
	?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="mantenimiento_muestras.php"><img src="img/edit.png" width="48" height="48"></a>Mantenimiento Muestras</div>
    </div>
    <? } ?>
    <? if (in_array(16, $_SESSION['perfil'])){
	?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="despliega_contratos.php"><img src="img/edit.png" width="48" height="48"></a>Mantenimiento Contratos</div>
    </div>
    <? } ?>
    <? if (in_array(17, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="preresultados_quimica.php"><img src="img/resultados.png" width="48" height="48"></a>Pre_res Qu&iacute;mica</div>
    </div>
    <? } ?>
    <? if (in_array(18, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="busca_informe.php?estado=1"><img src="img/informe.png" width="48" height="48"></a>Informes Actuales</div>
    </div>
    <? } ?>
    <? if (in_array(19, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="busca_informe.php?estado=4"><img src="img/informe.png" width="48" height="48"></a>Informes Completos</div>
    </div>
    <? } ?>
    <? if (in_array(20, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="despliega_contratos_prod.php?estado=1"><img src="img/informe.png" width="48" height="48"></a>Contratos Actuales</div>
    </div>
    <? } ?>
    <? if (in_array(21, $_SESSION['perfil'])){?>
	<div id="mainBlancoMenu"  style=" margin-left:10px;  float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="despliega_contratos_prod.php?estado=4"><img src="img/informe.png" width="48" height="48"></a>Contratos Completos</div>
    </div>
    <? } ?>
    <? if (in_array(22, $_SESSION['perfil'])){
	?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="crear_analisis.php"><img src="img/edit.png" width="48" height="48"></a>Crear&nbsp;&nbsp;  An&aacute;lisis</div>
    </div>
    <? } ?>
    <? if (in_array(23, $_SESSION['perfil'])){
	?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="precios_analisis.php"><img src="img/precios.png" width="48" height="48"></a>Mantenimiento Precios</div>
    </div>
    <? } ?>
    <? if (in_array(24, $_SESSION['perfil'])){
	?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="mantenimiento_firmas.php"><img src="img/firmas.png" width="48" height="48"></a>Tiempos Firmas</div>
    </div>
    <? } ?>
<? if (in_array(25, $_SESSION['perfil'])){
	?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="crear_tipo.php"><img src="img/edit.png" width="48" height="48"></a><br>Tipos Muestras</div>
    </div>
    <? } ?>
<? if (in_array(26, $_SESSION['perfil'])){
	?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="inventario/menu_inventario.php"><img src="img/inventario.png" width="48" height="48"></a><br>Mantenimiento Inventarios</div>
    </div>
    <? } ?>
<? if (in_array(27, $_SESSION['perfil'])){
	?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="mantenimiento_impuestos.php"><img src="img/impuestos.png" width="48" height="48"></a><br>Mantenimiento Impuestos</div>
    </div>
    <? } ?>
<? if (in_array(28, $_SESSION['perfil'])){
    ?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="materias/menu_principal.php"><img src="img/bdmaterias.png" width="48" height="48"></a><br>Materias Primas</div>
    </div>
    <? } ?>    
<? if (in_array(29, $_SESSION['perfil'])){
    ?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="eliminar_analisis.php"><img src="img/minusi.png" width="48" height="48"></a><br>Eliminar An&aacute;lisis</div>
    </div>
    <? } ?>        
<? if (in_array(30, $_SESSION['perfil'])){
    ?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="crear_pedido.php"><img src="img/edit.png" width="48" height="48"></a><br>Crear Pedidos</div>
    </div>
    <? } ?>            
<? if (in_array(31, $_SESSION['perfil'])){
    ?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="control_pedidos.php"><img src="img/aprobe.png" width="48" height="48"></a><br>Control Pedidos</div>
    </div>
    <? } ?>                
<? if (in_array(32, $_SESSION['perfil'])){
    ?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="calidad/control_calidad.php"><img src="img/calidad.png" width="48" height="48"></a><br>Control Calidad</div>
    </div>
    <? } ?>                    
<? if (in_array(33, $_SESSION['perfil'])){
    ?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="calidad/nueva_peticion.php?acceso=1"><img src="img/edit.png" width="48" height="48"></a><br>Modificar Documento</div>
    </div>
    <? } ?>    
<? if (in_array(34, $_SESSION['perfil'])){
    ?>
    <div id="mainBlancoMenu"  style=" margin-left:10px; float:left; margin-top:10px;">
    <div align="center" class="Arial14Negro"><a href="calidad/ver_archivos.php"><img src="img/edit.png" width="48" height="48"></a><br>Documentos Oficiales</div>
    </div>
    <? } ?>        




</div><!--Fin Cuadro Gris-->

</body>
</html>
