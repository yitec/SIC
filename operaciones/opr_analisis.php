<?
session_start();
require_once('../cnx/conexion.php');
require_once('opr_materias.php');
conectar();
$hoy=date("Y-m-d H:i:s");
//guarda un articulo en inventario
$dia=substr($_REQUEST['txt_fecha'], 3, 2);
$ano=substr($_REQUEST['txt_fecha'], 6, 4);
$mes=substr($_REQUEST['txt_fecha'], 0, 2);

$fecha=$ano."-".$mes."-".$dia." ".$_GET['cmb_ini'].":00";

//traslada los analisis de molienda a a laboratorios
if($_REQUEST['opcion']==1)
{
	$result=mysql_query("update tbl_analisis set estado='"."1"."',fecha_molienda='".$hoy."' where id='".$_REQUEST['id']."' ");
	//verifico si ya todos los analisis estan listos
	$result2=mysql_query("SELECT SUM( estado=1 ) AS molienda,COUNT( estado ) AS total FROM tbl_analisis where id_contrato='".$_REQUEST['contrato']."'");
	$row=mysql_fetch_assoc($result2);
	if($row['molienda']==$row['total']){
		mysql_query("update tbl_contratos set estado='"."2"."' where consecutivo='".$_REQUEST['contrato']."'");
	}
	mysql_free_result($result2);
	echo "Exito";	
}

//marca que los analisis se estan trabajando
if($_REQUEST['opcion']==2)
{
	$result=mysql_query("update tbl_analisis set trabajando='"."1"."',fecha_trabajando='".$hoy."' where id='".$_REQUEST['id']."' ");
	echo "Exito";	
}

//ingresa el resultado de un analisis
if($_REQUEST['opcion']==3)
{
	//busco el consecitivo del contrato
	$result2=mysql_query("select id_contrato from tbl_analisis where id='".$_REQUEST['id']."'");
	$row2=mysql_fetch_assoc($result2);
	//los analisis de quimica llevan una preaprobacion de zoologia por eso le pongo estado 2 a los de quimica a los demas 0
	
	if ($_REQUEST['metodo']==""){
		$res=mysql_query("select c.metodo from  tbl_analisis a, tbl_categoriasanalisis c where a.id='".$_REQUEST['id']."' and  c.id=a.id_analisis");
		$r1=mysql_fetch_object($res);
		$metodo=$r1->metodo;	
	}else{
		$metodo=$_REQUEST['metodo'];
	}
	if($_REQUEST['laboratorio']==1){
		if($_REQUEST['rechazado']==1){
			$result=mysql_query("update tbl_resultados set resultado='".utf8_decode($_REQUEST['resultado'])."', incertidumbre='".utf8_decode($_REQUEST['incertidumbre'])."',unidades='".utf8_decode($_REQUEST['unidades'])."',estado='"."2"."' where id_analisis='".$_REQUEST['id']."' ");
		}else{
			$result=mysql_query("insert into tbl_resultados (consecutivo_contrato,id_laboratorio,id_analisis,metodo,incertidumbre,unidades,observaciones_analista,resultado,fecha_ingreso,estado)values('".$row2['id_contrato']."','".$_REQUEST['laboratorio']."','".$_REQUEST['id']."','".$metodo."','".utf8_decode($_REQUEST['incertidumbre'])."','".$_REQUEST['unidades']."','".utf8_decode($_REQUEST['observaciones_analista'])."','".utf8_decode($_REQUEST['resultado'])."','".$hoy."','"."2"."')");
		}
		
	}else{
		if($_REQUEST['rechazado']==1){
			$result=mysql_query("update tbl_resultados set resultado='".utf8_decode($_REQUEST['resultado'])."', incertidumbre='".utf8_decode($_REQUEST['incertidumbre'])."',unidades='".utf8_decode($_REQUEST['unidades'])."',estado='"."0"."' where id_analisis='".$_REQUEST['id']."' ");
		}else{
			$result=mysql_query("insert into tbl_resultados (consecutivo_contrato,id_laboratorio,id_analisis,metodo,incertidumbre,unidades,observaciones_analista,resultado,fecha_ingreso,estado)values('".$row2['id_contrato']."','".$_REQUEST['laboratorio']."','".$_REQUEST['id']."','".$metodo."','".utf8_decode($_REQUEST['incertidumbre'])."','".$_REQUEST['unidades']."','".utf8_decode($_REQUEST['observaciones_analista'])."','".utf8_decode($_REQUEST['resultado'])."','".$hoy."','"."0"."')");
		}
	}
	$result=mysql_query("update tbl_analisis set estado='"."2"."',fecha_analisis='".$hoy."' where id='".$_REQUEST['id']."'");

	
}



//aprueba el resultado de un analisis
if($_REQUEST['opcion']==4)
{
	$result=mysql_query("select estado from tbl_resultados where id='".$_REQUEST['id']."'");
	$row=mysql_fetch_assoc($result);
	if($row['estado']==1){
		echo 'Error, ya estaba aprobado este análisis, no puede aprobarlo de nuevo';

	}else{

	$result=mysql_query("update tbl_resultados set estado='"."1"."',fecha_aprobacion='".$hoy."',base_fresca='".utf8_decode($_REQUEST['base_fresca'])."',incertidumbre_fresca='".utf8_decode($_REQUEST['incertidumbre_fresca'])."',observaciones_gerente='".utf8_decode($_REQUEST['observaciones_gerente'])."' where id='".$_REQUEST['id']."'");
	$result=mysql_query("Select id_analisis from tbl_resultados where id='".$_REQUEST['id']."'");
	$row=mysql_fetch_assoc($result);
	$result2=mysql_query("update tbl_analisis set estado='"."3"."',fecha_gerentes='".$hoy."' where id='".$row['id_analisis']."'");
	//estas consultas evaluan si ya todos los analisis tienen un resultado y marcan el contrato como completo
	$result3=mysql_query("select COUNT(consecutivo_contrato) as total from tbl_resultados where consecutivo_contrato='".$_REQUEST['contrato']."' and estado='"."1"."'");
	$row3=mysql_fetch_assoc($result3);

	$total_ap=$row3['total'];
	
	
	$result3=mysql_query("select COUNT(id_contrato) as total from tbl_analisis where id_contrato='".$_REQUEST['contrato']."'");
	
	$row3=mysql_fetch_assoc($result3);
	$total_an=$row3['total'];

	if($total_ap==$total_an){
		//echo "Entro";
		$result3=mysql_query("update tbl_contratos set fecha_terminado='".$hoy."', estado='"."4"."' where consecutivo='".$_REQUEST['contrato']."'");
		 		date_default_timezone_set('America/Denver');
       //$dest = "kmadrigal@feednet.ucr.ac.cr";
       $dest  = 'kmadrigal@feednet.ucr.ac.cr' . ', ';
	   $dest .= 'sergio.barrantes@hotmail.com';
       $head = "From: info@siccina.ucr.ac.cr<info@siccina.ucr.ac.cr>\r\n";
	   $asunto = "Contrato Termindado = ".$_REQUEST['contrato'];
	   $email = "info@siccina.ucr.ac.cr";
		$msg="El contrato ".$_REQUEST['contrato']." ha finalizado su proceso, por favor genere el informe";
			   if (mail($dest, $asunto, $msg, $head)) {
      
	   //echo 'Enviado correo';	   
       } else {
       //echo 'error correo';
	   }
	

	}
	//meto los datos de materias primas
	//$materias=actualiza_materias($_REQUEST['id']);
	
	//echo $total_ap."sid ".$total_an;
	echo "Success";
	}
	
	
}//end opcion 4


//rechazar el resultado de un analisis
if($_REQUEST['opcion']==5)
{
	$result=mysql_query("select estado from tbl_resultados where id='".$_REQUEST['id']."'");
	$row=mysql_fetch_assoc($result);
	if($row['estado']==1){
		echo 'Error, ya estaba aprobado este análisis, no puede rechazar un resultado que ya habia aprobado';

	}else{
	
	$result=mysql_query("Select id_analisis from tbl_resultados where id='".$_REQUEST['id']."'");
	$row=mysql_fetch_assoc($result);
	if($_REQUEST['rechazar']==2){
		echo "entro";
		$result2=mysql_query("update tbl_analisis set estado='"."2"."',trabajando='"."0"."',fecha_rechazado='".$hoy."', observaciones='".$_REQUEST['observaciones_gerente']."' where id='".$row['id_analisis']."'");	
		$result=mysql_query("update tbl_resultados set observaciones_gerente='".utf8_decode($_REQUEST['observaciones_gerente'])."', estado='"."2"."' where id='".$_REQUEST['id']."' ");
	}else{
		$result2=mysql_query("update tbl_analisis set estado='"."1"."',trabajando='"."0"."',fecha_rechazado='".$hoy."', observaciones='".$_REQUEST['observaciones_gerente']."' where id='".$row['id_analisis']."'");
		$result=mysql_query("update tbl_resultados set estado='"."1"."' where id='".$_REQUEST['id']."' ");
	}
	if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		}
	echo "Success";	
	}

}

//modifica el resultado de un analisis
if($_REQUEST['opcion']==6)
{
	$result2=mysql_query("update tbl_resultados set valor_resultado='".$_REQUEST['resultado']."',base_fresca='".$_REQUEST['fresca']."',base_seca='".$_REQUEST['seca']."',incertidumbre='".$_REQUEST['incertidumbre']."',unidades='".$_REQUEST['unidades']."',observaciones='".$_REQUEST['observaciones']."' where id='".$_REQUEST['id']."'");
	

}


//aprueba el resultado de la preaprobacion de quimica
if($_REQUEST['opcion']==7)
{
	$result=mysql_query("update tbl_resultados	set estado='"."0"."',  observaciones_gerente='".$_REQUEST['txt_observaciones_gerente']."',base_seca='".$_REQUEST['txt_seca']."',incertidumbre_seca='".utf8_decode($_REQUEST['txt_incertidumbre_seca'])."',base_fresca='".$_REQUEST['txt_fresca']."',incertidumbre_fresca='".utf8_decode($_REQUEST['txt_incertidumbre_fresca'])."'  where id='".$_REQUEST['id']."'");
	
}

//cambia todos los analisis de una muestra en molienda 
if($_REQUEST['opcion']==8)
{
	$result=mysql_query("update tbl_analisis set estado='"."1"."',fecha_molienda='".$hoy."' where id_contrato='".$_REQUEST['contrato']."' and id_muestra='".$_REQUEST['muestra']."' and estado='"."0"."' ");
	
	//verifico si ya todos los analisis estan listos
	$result2=mysql_query("SELECT SUM( estado=1 ) AS molienda,Count( estado ) AS total FROM tbl_analisis where id_contrato='".$_REQUEST['contrato']."'");
	$row=mysql_fetch_assoc($result2);
	if($row['molienda']==$row['total']){
		mysql_query("update tbl_contratos set estado='"."2"."' where consecutivo='".$_REQUEST['contrato']."'");
	}
	mysql_free_result($result2);
	echo "Exito";
	
}




//cargo las categorias de muestras en mantenimiento de analisis
if($_REQUEST['opcion']==9)
{
	$result=mysql_query("select * from tbl_subcatmuestras where id_categoria='".$_REQUEST['id']."' ");
	while ($row=mysql_fetch_assoc($result))
	{
		$resultado=$resultado.$row['id'].",".utf8_encode($row['nombre'])."|"	;
	}
	echo $resultado;
}

//creo un nuevo tipo de analisis
if($_REQUEST['opcion']==10)
{

	$result=mysql_query("insert into tbl_categoriasanalisis (ids_categoriaMuestra,id_laboratorio,nombre,metodo,acreditado,precio)values('".$_REQUEST['categoria']."','".$_REQUEST['laboratorio']."','".utf8_decode($_REQUEST['nombre'])."','".$_REQUEST['metodo']."','".$_REQUEST['acreditado']."','".$_REQUEST['precio']."')");
	if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	}else{echo "Exito";} 
	
	$result=mysql_query("insert into tbl_nombresanalisis (id_laboratorio,nombre,estado)values('".$_REQUEST['laboratorio']."','".utf8_decode($_REQUEST['nombre'])."','"."1"."')");
	
	
	
	desconectar();
}


//desactivo un analisis desde el mantenimiento de analisis
if($_REQUEST['opcion']==11)
{
	$result=mysql_query("select monto_total from tbl_contratos where consecutivo='".$_REQUEST['contrato']."' ");
	$row=mysql_fetch_assoc($result);
	$total=$row['monto_total']-$_REQUEST['precio'];
	$result2=mysql_query("delete from tbl_analisis where id='".$_REQUEST['id']."' ");
	$result2=mysql_query("delete from tbl_resultados where id_analisis='".$_REQUEST['id']."' ");
	$result2=mysql_query("update tbl_contratos set monto_total='".$total."' where consecutivo='".$_REQUEST['contrato']."' ");	
//	$result=mysql_query("update tbl_analisis set estado='4' where id='".$_REQUEST['id']."' ");
	echo $total;	
}


//cargo las categorias de muestras en mantenimiento de analisis
if($_REQUEST['opcion']==12)
{
	$cant=0;
	$result=mysql_query("select * from tbl_categoriasanalisis where ids_categoriamuestra='".$_REQUEST['id']."' and id_laboratorio='".$_REQUEST['laboratorio']."' order by nombre ");
	while ($row=mysql_fetch_assoc($result))
	{
		if ($cant==0){
			$resultado=$row['id'].",".utf8_encode($row['nombre'])."|"	;
		}else{
			$resultado=$resultado.$row['id'].",".utf8_encode($row['nombre'])."|"	;
		}
		$cant++;
	}
	echo $resultado;
}


//cargo el precio de cada analisis
if($_REQUEST['opcion']==13)
{
	$result=mysql_query("select precio,metodo from tbl_categoriasanalisis where ids_categoriamuestra='".$_REQUEST['id']."' and id_laboratorio='".$_REQUEST['laboratorio']."'  and  id='".$_REQUEST['analisis']."' order by nombre ");
	while ($row=mysql_fetch_assoc($result))
	{
		$resultado=$row['precio']."|".$row['metodo']	;
	}
	echo $resultado;
}

//modifico el precio de un analisis
if($_REQUEST['opcion']==14)
{
	$result=mysql_query("update tbl_categoriasanalisis set precio = '".$_REQUEST['precio']."', metodo = '".$_REQUEST['metodo']."' where ids_categoriamuestra='".$_REQUEST['id']."' and id_laboratorio='".$_REQUEST['laboratorio']."'  and  id='".$_REQUEST['analisis']."' ");
	
}


//Creo un nuevo tipo de muestra
if($_REQUEST['opcion']==15)
{
	$result=mysql_query("Insert into tbl_subcatmuestras(id_categoria,nombre,estado) values ('".$_REQUEST['categoria']."','".utf8_decode($_REQUEST['nombre'])."','"."1"."')");
	
}


//Marco todos los analisis de un contrato procesados en molienda
if($_REQUEST['opcion']==16)
{
	$result=mysql_query("update tbl_analisis set estado=1,fecha_molienda='".$hoy."' where id_contrato='".$_REQUEST['contrato']."' and estado=0");
	$result=mysql_query("update tbl_contratos set estado=2 where consecutivo='".$_REQUEST['contrato']."' ");
	if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	}else{
		echo "Exito";
	}

}

//Eliminar un analisis
if($_REQUEST['opcion']==17)
{
	$result=mysql_query("delete from tbl_categoriasanalisis  where id='".$_REQUEST['analisis']."'");
	if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	}else{
		echo "Exito";
	}

}

//Eliminar un analisis
if($_REQUEST['opcion']==18)
{
	$result=mysql_query("update tbl_muestras set nombre_muestra='".$_REQUEST['nombre']."'  where id='".$_REQUEST['id']."'");
	if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
	}else{
		echo "Exito";
	}

}








?>
