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
<script src="../includes/Scripts_Materias.js"></script>

</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g" style="width:1100px;"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Mantenimiento Materias</div><div align="rightx" ></div> </div>
<div class="der_sup_g" style="postion: relative; margin-left: 1110px;"></div>
<div class="lineaAzul" style="width: 1117px;"></div>
<div class="izq_lat_g" style="height:1200px;"></div>
<div class="contenido_gm">
<?
require_once('menu_superior.php');
?>
<div id="mainAzulFondo" style="padding:10px; width:1000px;"  align="center">
<div id="mainBlancoFondo" style=" width:990px;" align="center">
      <div class="Arial14Negro" style="margin-left:500px; margin-top:5px;   ">
      Registro:
      <input class="inputboxPequeno" size="20" id="txt_registro_buscar" name="txt_orden" type="text"  />
      Year:
      <input class="inputboxPequeno" size="20" id="txt_year_buscar" name="txt_orden" type="text"  />
      <input name="btn_buscar" id="btn_buscar_mine" type="image" src="../img/search.png" />
      </div>
      	
      <input id="opcion" name="opcion" type="hidden" value="1" />

	<div align="center" class="Arial18Azul" style="margin-bottom:10px; margin-top:10px;">Base de datos Minerales</div>
     
	<table>
	<tr>
      <td class="Arial14Negro"><div align="left">Contrato</div></td>      
      <td class="Arial14Negro"><input id="txt_contrato" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Nombre Muestra</td>
      <td class="Arial14Negro"><input id="txt_nombre" class="inputbox"  type="text" /></td>    
      </tr>
      </table>
      <br>
      <table>
      <tr>
      <td class="Arial14Negro">Cifra 1</td>
      <td class="Arial14Negro"><input id="txt_cifra1" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Calcio</td>
      <td class="Arial14Negro"><input id="txt_calcio" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Fosforo</td>
      <td class="Arial14Negro"><input id="txt_fosforo" class="inputbox"  type="text" /></td>
      </tr>
      <tr>
      <td class="Arial14Negro">Cifra 2</td>
      <td class="Arial14Negro"><input id="txt_cifra2" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Fosforo_d</td>
      <td class="Arial14Negro"><input id="txt_fosforo_d" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Magnesio</td>
      <td class="Arial14Negro"><input id="txt_magnesio" class="inputbox"  type="text" /></td>
      </tr>

      <tr>
      <td class="Arial14Negro">Cifra 3</td>
      <td class="Arial14Negro"><input id="txt_cifra3" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Potasio</td>
      <td class="Arial14Negro"><input id="txt_potasio" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Sal</td>
      <td class="Arial14Negro"><input id="txt_sal" class="inputbox"  type="text" /></td>
      </tr>

      <tr>
      <td class="Arial14Negro">Cifra 4</td>
      <td class="Arial14Negro"><input id="txt_cifra4" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Hierro</td>
      <td class="Arial14Negro"><input id="txt_hierro" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Cobre</td>
      <td class="Arial14Negro"><input id="txt_cobre" class="inputbox"  type="text" /></td>
      </tr>

      <tr>
      <td class="Arial14Negro">Cifra 5</td>
      <td class="Arial14Negro"><input id="txt_cifra5" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Manganeso</td>
      <td class="Arial14Negro"><input id="txt_manganeso" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Zinc</td>
      <td class="Arial14Negro"><input id="txt_zinc" class="inputbox"  type="text" /></td>
      </tr>

      <tr>
      <td class="Arial14Negro">Cifra 6</td>
      <td class="Arial14Negro"><input id="txt_cifra6" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Cobalto</td>
      <td class="Arial14Negro"><input id="txt_cobalto" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Molibdeno</td>
      <td class="Arial14Negro"><input id="txt_molibdeno" class="inputbox"  type="text" /></td>
      </tr>

      <tr>
      <td class="Arial14Negro">Cifra 7</td>
      <td class="Arial14Negro"><input id="txt_cifra7" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Ph</td>
      <td class="Arial14Negro"><input id="txt_ph" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Carbonatos</td>
      <td class="Arial14Negro"><input id="txt_carbonatos" class="inputbox"  type="text" /></td>
      
      </tr>

      <tr>
      <td class="Arial14Negro">Cifra 8</td>
      <td class="Arial14Negro"><input id="txt_cifra8" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Sodio</td>
      <td class="Arial14Negro"><input id="txt_sodio" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Materia Seca</td>
      <td class="Arial14Negro"><input id="txt_materia_seca" class="inputbox"  type="text" /></td>
      
      </tr>

      <tr>
      <td class="Arial14Negro">Cifra 9</td>
      <td class="Arial14Negro"><input id="txt_cifra9" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Arsenico</td>
      <td class="Arial14Negro"><input id="txt_arsenico" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Plomo</td>
      <td class="Arial14Negro"><input id="txt_plomo" class="inputbox"  type="text" /></td>
      </tr>
      <tr>
      <td class="Arial14Negro">Cifra 10</td>
      <td class="Arial14Negro">
      <select name="cmb_cifra10" id="cmb_cifra10" > 
            <option value="Seleccione" selected="selected">Seleccione</option>
            <option value="-1">Antes de 1985 (-1)</option>
            <option value="1">1985 (1)</option>
            <option value="2">1986 (2)</option>
            <option value="3">1987 (3)</option>
            <option value="4">1988 (4)</option>
            <option value="5">1989 (5)</option>
            <option value="6">1990 (6)</option>
            <option value="7">1991 (7)</option>
            <option value="8">1992 (8)</option>
            <option value="9">1993 (9)</option>
            <option value="10">1994 (10)</option>
            <option value="11">1995 (11)</option>
            <option value="12">1996 (12)</option>
            <option value="13">1997 (13)</option>
            <option value="14">1998 (14)</option>
            <option value="15">1999 (15)</option>
            <option value="16">2000 (16)</option>
            <option value="17">2001 (17)</option>
            <option value="18">2002 (18)</option>
            <option value="19">2003 (19)</option>
            <option value="20">2004 (20)</option>
            <option value="21">2005 (21)</option>
            <option value="22">2006 (22)</option>
            <option value="23">2007 (23)</option>
            <option value="24">2008 (24)</option>
            <option value="25">2009 (25)</option>
            <option value="26">2010 (26)</option>
            <option value="27">2011 (27)</option>
            <option value="28">2012 (28)</option>
            <option value="29">2013 (29)</option>
            <option value="30">2014 (30)</option>
            <option value="31">2015 (31)</option>
            <option value="32">2016 (32)</option>
            <option value="33">2017 (33)</option>
            <option value="34">2018 (34)</option>
            <option value="35">2019 (35)</option>
            <option value="36">2020 (36)</option>
            <option value="37">2021 (37)</option>
            <option value="38">2022 (38)</option>
            <option value="39">2023 (39)</option>
            <option value="40">2024 (40)</option>
            <option value="41">2025 (41)</option>
      </select>
      <td class="Arial14Negro">Cadmio</td>
      <td class="Arial14Negro"><input id="txt_cadmio" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Mercurio</td>
      <td class="Arial14Negro"><input id="txt_mercurio" class="inputbox"  type="text" /></td>
      </tr>

      <tr>
      <td class="Arial14Negro"># Registro</td>
      <td class="Arial14Negro"><input id="txt_registro" class="inputbox" disabled="disabled" type="text" /></td>
      <td class="Arial14Negro">Aminoacidos</td> 
      <td class="Arial14Negro"><input id="txt_aminoacidos" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Humedad</td>
      <td class="Arial14Negro"><input id="txt_humedad" class="inputbox"  type="text" /></td>
      </tr>

      <tr>
      <td class="Arial14Negro"></td>
      <td class="Arial14Negro"></td>
       <td class="Arial14Negro">Proteina</td>
      <td class="Arial14Negro"><input id="txt_proteina" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Energia</td>
      <td class="Arial14Negro"><input id="txt_energia" class="inputbox"  type="text" /></td>
      </tr>

      <tr>
      <td class="Arial14Negro"></td>
      <td class="Arial14Negro"></td>
      <td class="Arial14Negro">Fluor</td>
      <td class="Arial14Negro"><input id="txt_fluor" class="inputbox"  type="text" /></td>
      <td class="Arial14Negro">Yodo</td>
      <td class="Arial14Negro"><input id="txt_yodo" class="inputbox"  type="text" /></td>
      </tr>
      <tr>
      <td class="Arial14Negro"></td>
      <td class="Arial14Negro"></td>
      <td class="Arial14Negro">Cloruros</td>
      <td class="Arial14Negro"><input id="txt_cloruros" class="inputbox"  type="text" /></td>
      </tr>
      </table>
      
      
       
	<div align="center" style="margin-top:20px; margin-bottom:20px;">
      <input name="btn_guardarm" id="btn_guardar_mine" type="image" src="../img/btn_guardar.png" />  
      <input name="btn_eliminarm" id="btn_eliminar_mine" type="image" src="../img/btn_eliminar.png" />
      </div>   

</div><!--fin cuadro blanco--> 
</div><!--fin cuadro azul--> 
</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="position:relative; margin-left: 1110px; height: 1200px;"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g" style="width:1100px;"></div>
<div class="der_inf_g" style="position:relative; margin-left: 1110px;"></div>
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
