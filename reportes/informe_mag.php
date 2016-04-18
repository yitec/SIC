<?
session_start();
require_once('../cnx/conexion.php');
conectar();
$total=0;
$molienda=0;
$analisis=0;
$aprobacion=0;
$aprobados=0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIC-CINA</title>
<link href="../css/cuadros.css" rel="stylesheet" type="text/css"  />
<script type="text/javascript" src="../includes/jquery-1.7.1.js"></script>
<script language="javascript">
$(document).ready(function() {

	$(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>

</head>

<body>

<?

$result=mysql_query("Select a.*,b.nombre,b.direccion,b.tipo_cliente,b.tel_fijo,b.correo from tbl_contratos as a 
    INNER JOIN tbl_clientes AS b ON a.id_cliente = b.id and a.id='".$_REQUEST['id']."'");
if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
        
        } 

$row=mysql_fetch_assoc($result);

//busco todos los resultados
$sql="Select res.consecutivo_contrato,ana.id_laboratorio,cat.nombre,res.metodo,res.resultado,res.base_seca,
res.base_fresca,res.incertidumbre, res.incertidumbre_fresca,res.incertidumbre_seca,
res.unidades,res.fecha_aprobacion,res.valor_correjido,ana.id_analisis,ana.id_muestra,cat.acreditado
from tbl_resultados res  Inner join tbl_analisis as ana 
on res.id_analisis=ana.id inner join tbl_categoriasanalisis as cat on ana.id_analisis=cat.id
where
res.consecutivo_contrato='".$row['consecutivo']."'  order by res.id_laboratorio,ana.id_muestra ";
$result2=mysql_query($sql);

if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
        
} 

$ano=substr($row['fecha_ingreso'], 0, 4);
$mes=substr($row['fecha_ingreso'], 5, 2);
$dia=substr($row['fecha_ingreso'], 8, 2);
$horas=substr($row['fecha_ingreso'], 10, 10);
$fechas=$dia."-".$mes."-".$ano." ".$horas;

$result5=mysql_query("Select * from tbl_infmuestras  where cons_contrato='".$row['consecutivo']."'");
$row5=mysql_fetch_assoc($result5);
$v_procedencia=explode(",",$row5['procedencia']);
if(isset($row5['procedencia'])){
    $result6=mysql_query("select p.nombre, c.nombre, d.nombre from tbl_provincias p, tbl_cantones c, tbl_distritos d where p.id='".$v_procedencia[0]."' and c.id='".$v_procedencia[1]."' and d.id='".$v_procedencia[2]."' ");
    $row6=mysql_fetch_array($result6);
}
//datos de muestras oficiales
$result7=mysql_query("Select * from tbl_infoficiales  where cons_contrato='".$row['consecutivo']."'");
$row7=mysql_fetch_assoc($result7);


?>
<div align="center">
<table><tr><td> 
<div class="izq_sup_g"></div>
<div class="cen_sup_g" style="width:1200px;"><div  class="Arial14blanco" align="left" style="float:left; margin-top:18px;">Informe Mag</div><div align="right" ></div> </div>
<div class="der_sup_g" style=" margin-left:1201px;" ></div>
<div class="lineaAzul" style="width:1208px;"></div>
<div class="izq_lat_g" style="height:5000px; "></div>
<div    class="contenido_gm" >
<div id="mainAzulFondo" align="center" style=" width: 1080px; height:auto; " >
<div id="mainBlancoFondo" align="center" style="padding: 20 20 20 20;">
<div align="left" id="Exportar_a_Excel">

<table >
<thead class="Arial14Morado">
    <th>Informe de Ensayo</th>    
</thead>
<tbody>
<tr class="Arial14Azul">
<td>Contrato</td>    
<td>Fecha recepción muestras</td>
</tr>
<tr class="Arial14Negro">
    <td><?=$row['consecutivo']?></td>
    <td><?=$fechas?></td>
</tr>
</tbody>
</table>
<br>
<table>
<thead class="Arial14Morado">
    <th>Información del cliente</th>
</thead>
</tbody>
<tr class="Arial14Azul">
    <td>Nombre solicitante</td>
    <td>Teléfono</td>
    <td>Correo electronico</td>
</tr>
<tr class="Arial14Negro">
    <td><? echo $row['nombre_solicitante']?></td>
    <td><?=$row['tel_fijo']?></td>
    <td><?=$row['correo']?></td>
</tr>
</tbody>
</table>
<br>
<table>
<thead class="Arial14Morado">
    <th>Información de las muestras</th>
</thead>
<tbody class="Arial14Negro">
<tr>
<td>Tipo de muestra:</td><td> <?=utf8_encode($row5['tipo_alimento'])?></td>
</tr>
<tr>
    <td>Nombre o descripción del producto:</td><td><?=utf8_encode($row5['nombre_producto'])?></td>
</tr>
<tr>
    <td>Presentación de la muestra:</td><td><?=utf8_encode($row5['condicion_muestra'])?></td>
</tr>
<tr>
    <td>Fecha de toma de la muestra(s):</td><td><?=utf8_encode($row5['fecha_muestra'])?></td>
</tr>
<tr>
    <td>Proceso de elaboración:</td><td><?=utf8_encode($row5['proceso_elaboracion'])?></td>
</tr>
<tr>
    <td>Parte de la planta/animal que compone:</td><td><?=utf8_encode($row5['parte_planta'])?></td>
<?
if(isset($row5['procedencia'])){
?>
    <tr>
        <td>Procedencia Geográfica:</td><td><?=utf8_encode($row6[0].'-'.$row6[1].'-'.$row6[2])?></td>
    </tr>
<?}else{?>
    <tr>
        <td>Procedencia Geográfica:?></td>
    </tr>
<?}?>
</tr>
<tr>
<td>Importado de:</td><td><?=utf8_encode($row5['importado'])?></td>
</tr>
<tr>
<td>Elaborado por:</td><td><?=utf8_encode($row5['elaborado'])?></td>
</tr>
<tr>
<td>Forma de muestreo utilizada:</td><td><?=utf8_encode($row5['forma_muestreo'])?></td>
</tr>
<tr>
</tbody>
</table>
<br>

<table>
<thead>
<th>INFORMACIÓN DE MUESTRAS OFICIALES</th>
</thead>
<tbody class="Arial14Negro">
<tr>
    <td>Empresa:</td><td><?=utf8_encode($row7['empresa'])?></td>
</tr>
<tr>
    <td>Lisencia DAA :</td><td><?=utf8_encode($row7['lisencia'])?></td>
</tr>
<tr>
    <td>Inspector:</td><td><?echo utf8_encode($row7['inspector'])?></td>
</tr>
<tr>
    <td>Boleta de Campo:</td><td><?=$row7['boleta']?></td>
</tr>
<tr>
    <td>Muestreado en :</td><td><?=utf8_encode($row7['muestreado'])?></td>
</tr>
<tr>
    <td>Fecha de elaboración: </td><td><?=utf8_encode($row7['fecha_elaboracion'])?></td>
</tr>
<tr>
    <td>Fecha de vencimiento: </td><td><?=utf8_encode($row7['fecha_vencimiento'])?></td>
</tr>
</tbody>
</table>    
<div align="center">
<p width="100%" class="Arial24Azul">Resultados</p>
</div>
<br>
<?

//*************************imprimo resultados******************************/
//*************************imprimo resultados******************************/
//*************************imprimo resultados******************************/
echo '<table border="1" style="border: 1px solid black; border-collapse: collapse;" class="Arial14Negro">';
//echo '<table><tr><td>Sergio</td></tr></table>';

$muestra=0;
$v_metodos=array();
while($row2=mysql_fetch_object($result2)){
//echo '<tr><td>Entro</td></tr>';
if ($row2->id_muestra!=$muestra ){
        $cont=0;        
        if($muestra<>0){
            imprime_metodos($v_metodos);       
        }
        $cont++;
        unset($v_metodos);
        $v_metodos=array();     //vector para almacenar los metodos
        $muestra=$row2->id_muestra;             
        $v_metodos[]='  ('.$cont.')'.$row2->metodo;
        imprime_muestra($row['consecutivo'],$muestra);     
        imprime_resultados($row2->fecha_aprobacion,$row2->id_laboratorio,$row2->nombre,$row2->resultado,$row2->incertidumbre,$row2->base_fresca,$row2->incertidumbre_fresca,$row2->base_seca,$row2->incertidumbre_seca,$row2->unidades,$row2->valor_correjido,$row2->acreditado,$cont);        
}else{
        
        $cont++;        
        $v_metodos[]='('.$cont.')'.$row2->metodo;
        imprime_resultados($row2->fecha_aprobacion,$row2->id_laboratorio,$row2->nombre,$row2->resultado,$row2->incertidumbre,$row2->base_fresca,$row2->incertidumbre_fresca,$row2->base_seca,$row2->incertidumbre_seca,$row2->unidades,$row2->valor_correjido,$row2->acreditado,$cont);    
    }


}//end while
imprime_metodos($v_metodos);
echo '</table>';

?>
</div>
<br/>
<form action="reporte_xcel.php" method="post" target="_blank" id="FormularioExportacion">
<p class="Arial10Negro" align="right">Exportar a Excel  <img src="../img/xcel.png" class="botonExcel" width="28" height="28" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>  

</div><!--fin cuadro gris--> 
</div><!--fin cuadro azul--> 



</div><!--fin div de contenido cudro gm-->
<div class="der_lat_g" style="height:5000px; margin-left:1201px;"></div>
<div class="izq_inf_g"></div>
<div class="cen_inf_g" style="width:1200px;"></div>
<div class="der_inf_g" style="margin-left:1201px;"></div>

<div align="center" style=" margin-left:350px;float:left" class="Arial8negro">
Sistema de Control e Informaci&oacute;n.  
</div>
<div align="center" style="float:left" class="Arial8azul">&nbsp;CINA.&nbsp;
</div>
<div align="center" style="float:left" class="Arial8negro">
Versi&oacute;n 1.0
</div>
</td>
</tr>
</table>
</div>
</body>
</html>


<?

function imprime_muestra($consecutivo,$muestra){
        $result3=mysql_query("select nombre_muestra,codigo from tbl_muestras where id_contrato='".$consecutivo."' and  numero_muestra='".$muestra."'  ");
        $row3=mysql_fetch_object($result3);
        echo '<tr class="Arial14Morado"><td>Muestra:</td><td>'.$row3->codigo.' ( '.$row3->nombre_muestra.' )</td><td></td><td></td></tr>';
        echo '<tr class="Arial14Morado"><td>Fecha de resultados:</td><td>Laboratorio:</td><td>An&aacute;lisis:</td><td>Resultado:</td></tr>';        
}


function imprime_resultados($fecha,$laboratorio,$analisis,$resultado,$incertidumbre,$base_fresca,$incertidumbre_fresca,$base_seca,$incertidumbre_seca,$unidades,$valor_correjido,$acreditado,$cont){
        
        echo '<tr><td>'.$fecha.'</td>';
        echo '<td>'.nombre_laboratorio($laboratorio).'</td>';
        echo '<td>'.$analisis.' ('.$cont.')</td>';        
        if ($analisis=="Microscopía"){
            echo '<td>Ver siguiente línea</td></tr>';
            echo '<tr><td>Resultado Microscopía: '.utf8_encode(calcula_resultado($resultado,$incertidumbre,$base_fresca,$incertidumbre_fresca,$base_seca,$incertidumbre_seca,$unidades,$valor_correjido)).'</td></tr>';
        }else{
            echo '<td>'.utf8_encode(calcula_resultado($resultado,$incertidumbre,$base_fresca,$incertidumbre_fresca,$base_seca,$incertidumbre_seca,$unidades,$valor_correjido)).'</td>';
        }

}

function nombre_laboratorio($laboratorio){
    if($laboratorio==1){
        return "Qu&iacute;mica";
    }elseif ($laboratorio==2) {
        return "Microbiolog&iacute;a";
    }else{
        return "Bromatolog&iacute;a";
    }
}

function imprime_metodos($v_metodos){
    $l_metodos=implode(";",$v_metodos);
    $size=strlen($l_metodos);
    echo '<tr class="Arial14Morado"><td>Métodos de referencia:</td><td>'.$l_metodos.'</td><td></td><td></td></tr>';    
}


function calcula_resultado($resultado,$incertidumbre,$base_fresca,$incertidumbre_fresca,$base_seca,$incertidumbre_seca,$unidades,$valor_correjido){
    $r1="";
    $r2="";
    if ($base_fresca<>""){
        
        if ($base_seca<>""){//pregunto si tiene resultado en base seca
            
                if ($valor_correjido<>""){  //pregunto si tiene valor correjido         
                    $resultado="(".utf8_decode($valor_correjido).$incertidumbre_fresca.")".utf8_decode($unidades)." [".utf8_decode($base_seca).$incertidumbre_seca."]".utf8_decode($unidades);  
                    $r1="(".utf8_decode($valor_correjido)." ".$incertidumbre_fresca.") ".utf8_decode($unidades);
                    $r2=" [".utf8_decode($base_seca)." ".$incertidumbre_seca."] ".utf8_decode($unidades);   
                }else{
                    $resultado="(".utf8_decode($base_fresca).$incertidumbre_fresca.")".utf8_decode($unidades)." [".utf8_decode($base_seca).$incertidumbre_seca."]".utf8_decode($unidades);  
                    $r1="(".$base_fresca." ".$incertidumbre_fresca.") ".utf8_decode($unidades);
                    $r2=" [".$base_seca." ".$incertidumbre_seca."] ".utf8_decode($unidades);    
                }
        }else{
                if ($valor_correjido<>""){  //pregunto si tiene valor correjido         
                    $resultado="(".utf8_decode($valor_correjido).$incertidumbre_fresca.")".$unidades." [".utf8_decode($resultado).$incertidumbre."]".utf8_decode($unidades);
                    $r1="(".$valor_correjido." ".$incertidumbre_fresca.") ".$unidades;                          
                }else{
                    $resultado="(".utf8_decode($base_fresca).$incertidumbre_fresca.")".$unidades." [".utf8_decode($resultado).$incertidumbre."]".utf8_decode($unidades);    
                    $r1="(".$base_fresca." ".$incertidumbre_fresca.") ".$unidades;                  
                }
        }// fin base seca linea 458

    }else{
        // no tiene resultado en base fresca    
        if ($base_seca<>""){// pregunto si hay resultado en base seca   
        
            if ($valor_correjido<>""){  
                $resultado="(".$valor_correjido." ".$incertidumbre_seca.") ".utf8_decode($unidades) ;
                $r1=$resultado;
            }else{
                $resultado="(".$base_seca." ".$incertidumbre_seca.") ".utf8_decode($unidades)   ;
                $r1=$resultado;             
            }
        }else{
            if ($valor_correjido<>""){  
                $resultado="(".$valor_correjido." ".$incertidumbre.") ".utf8_decode($unidades)  ;
                $r1=$resultado;             
            }else{
                $resultado="(".$resultado." ".$incertidumbre.") ".utf8_decode($unidades)    ;
                $r1=$resultado;             
            }       
        }//end if resultado base seca
    }//fin base fresca vacio linea 456
    //quito los saltos de linea del final
    $r1 =str_replace("\n", "", $r1);
    $r2 =str_replace("\n", "", $r2);
    return $r1." ".$r2;
}//fin funcion calcula_resultados
?>