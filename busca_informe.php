<?
session_start();
require_once('cnx/conexion.php');
require_once('cnx/session_activa.php');
conectar();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="css/cuadros.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Informes</div><div align="right"></div> </div>
<div class="der_sup_g"></div>
<div class="lineaAzul"></div>
<div class="izq_lat_g" style="height:3000px;"></div>
<div    class="contenido_gm">


<?
require_once('menu_superior.php');
?>
<div id="mainAzulFondo" align="center" style="   height:auto; width:auto;">
<div id="mainBlancoFondo" >

	<div align="center" class="Arial18Morado" style="margin-bottom:10px; margin-top:10px;">
	  <?
	  if($_REQUEST['estado']==1){
      	echo "Contratos Pendientes";
	  }else{
		echo "Contratos Antiguos";  
	  }
	  ?>
	</div>
    <div align="center" id="mainBlancoMolienda">
    

<?

	  if($_REQUEST['estado']==1){
      	$result=mysql_query("select * from tbl_contratos where estado='"."1"."' or estado='"."2"."' order by id");
	  }else{
		//$result=mysql_query("select * from tbl_contratos where estado='".$_REQUEST['estado']."' order by id");
		$result=mysql_query("select * from tbl_contratos where estado='"."4"."' and fecha_ingreso>='20120101' and  fecha_ingreso<='20121231' order by id ASC");
		echo '<div align="center" id="year_2012">    
    <table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td><div align="center" class="Arial14Azul">Contrato</div></td>
    <td><div align="center" class="Arial14Azul">Muestras</div></td>    
    <td><div align="center" class="Arial14Azul">Fecha Ingreso</div></td>
    <td><div align="center" class="Arial14Azul">Ver Contrato</div></td>        
    </tr>';
    while ($row=mysql_fetch_assoc($result)){
        echo '<tr>
    <td><div align="center" class="Arial14Negro">'.$row['consecutivo'].'</div></td>
    <td><div align="center" class="Arial14Negro">'.$row['numero_muestras'].'</div></td>
    <td><div align="center" class="Arial14Negro">'.$row['fecha_ingreso'].'</div></td>
    <td><div align="center" class="Arial14Negro"><a href="informe.php?id='.$row['id'].'" target="_blank"><img src="img/search.png" /></a>
    </div></td>        
    </tr>';
    }
    echo '</table>
    </div>';  
    echo '<div align="center" class="Arial14Morado">Año 2012</div>';
    echo '<div align="center" class="Arial14Azul"><img id="btn_2012" src="img/search.png" />
    </div><br>';  
	}


    if($_REQUEST['estado']==1){
        $result=mysql_query("select * from tbl_contratos where fecha_ingreso>='20130101' and  fecha_ingreso<='20131231' and  (estado=1 or estado=2) order by id ASC");    
    }else{
	   $result=mysql_query("select * from tbl_contratos where estado='"."4"."' and fecha_ingreso>='20130101' and  fecha_ingreso<='20131231' order by id ASC");    
    }
    echo '<div align="center" id="year_2013">    
    <table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td><div align="center" class="Arial14Azul">Contrato</div></td>
    <td><div align="center" class="Arial14Azul">Muestras</div></td>    
    <td><div align="center" class="Arial14Azul">Fecha Ingreso</div></td>
    <td><div align="center" class="Arial14Azul">Ver Contrato</div></td>        
    </tr>';
    while ($row=mysql_fetch_assoc($result)){
        echo '<tr>
    <td><div align="center" class="Arial14Negro">'.$row['consecutivo'].'</div></td>
    <td><div align="center" class="Arial14Negro">'.$row['numero_muestras'].'</div></td>
    <td><div align="center" class="Arial14Negro">'.$row['fecha_ingreso'].'</div></td>
    <td><div align="center" class="Arial14Negro"><a href="informe.php?id='.$row['id'].'" target="_blank"><img src="img/search.png" /></a>
    </div></td>        
    </tr>';
    }
    echo '</table>
    </div>';  
    echo '<div align="center" class="Arial14Morado">Año 2013</div>';   
    echo '<div align="center" class="Arial14Negro"><img id="btn_2013" src="img/search.png" />
    </div><br>';   
    //2014
    if($_REQUEST['estado']==1){
        $result=mysql_query("select * from tbl_contratos where fecha_ingreso>='20140101' and  fecha_ingreso<='20141231' and  (estado=1 or estado=2) order by id ASC");    
    }else{
       $result=mysql_query("select * from tbl_contratos where estado='"."4"."' and fecha_ingreso>='20140101' and  fecha_ingreso<='20141231' order by id ASC");    
    }
    echo '<div align="center" id="year_2014">    
    <table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td><div align="center" class="Arial14Azul">Contrato</div></td>
    <td><div align="center" class="Arial14Azul">Muestras</div></td>    
    <td><div align="center" class="Arial14Azul">Fecha Ingreso</div></td>
    <td><div align="center" class="Arial14Azul">Ver Contrato</div></td>        
    </tr>';
    while ($row=mysql_fetch_assoc($result)){
        echo '<tr>
    <td><div align="center" class="Arial14Negro">'.$row['consecutivo'].'</div></td>
    <td><div align="center" class="Arial14Negro">'.$row['numero_muestras'].'</div></td>
    <td><div align="center" class="Arial14Negro">'.$row['fecha_ingreso'].'</div></td>
    <td><div align="center" class="Arial14Negro"><a href="informe.php?id='.$row['id'].'" target="_blank"><img src="img/search.png" /></a>
    </div></td>        
    </tr>';
    }
    echo '</table>
    </div>';  
    echo '<div align="center" class="Arial14Morado">Año 2014</div>';   
    echo '<div align="center" class="Arial14Negro"><img id="btn_2014" src="img/search.png" />
    </div><br>';   


//2015
if($_REQUEST['estado']==1){
        $result=mysql_query("select * from tbl_contratos where  fecha_ingreso>='20150101' and (estado=1 or estado=2)  order by id ASC");    
    }else{
        $result=mysql_query("select * from tbl_contratos where estado='"."4"."' and fecha_ingreso>='20150101' order by id ASC");    
    }    
    echo '<div align="center" id="year_2015">    
    <table width="747" height="18" border="1"   cellpadding="0" cellspacing="0" bordercolor="#a6c9e2">
    <tr>
    <td><div align="center" class="Arial14Azul">Contrato</div></td>
    <td><div align="center" class="Arial14Azul">Muestras</div></td>    
    <td><div align="center" class="Arial14Azul">Fecha Ingreso</div></td>
    <td><div align="center" class="Arial14Azul">Ver Contrato</div></td>        
    </tr>';
    while ($row=mysql_fetch_assoc($result)){
        echo '<tr>
    <td><div align="center" class="Arial14Negro">'.$row['consecutivo'].'</div></td>
    <td><div align="center" class="Arial14Negro">'.$row['numero_muestras'].'</div></td>
    <td><div align="center" class="Arial14Negro">'.$row['fecha_ingreso'].'</div></td>
    <td><div align="center" class="Arial14Negro"><a href="informe.php?id='.$row['id'].'" target="_blank"><img src="img/search.png" /></a>
    </div></td>        
    </tr>';
    }
    echo '</table>
    </div>';              
    




?>
    
</div>



</div><!--fin cuadro gris--> 
</div><!--fin cuadro azul--> 

</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:3000px;"></div>
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
<script src="includes/jquery-1.7.1.js"></script>
<script src="includes/Scripts_Years.js"></script>
</html>
