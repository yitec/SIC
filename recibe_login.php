<?
session_start();
require_once('cnx/conexion.php');
conectar();

$hoy = date("Y/m/d H:i:s"); 

$result = mysql_query("select * from tbl_usuarios where usuario='".$_POST['txt_usuario']."' and pass='".$_POST['txt_pass']."'");
if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
} 


if(mysql_num_rows($result) >=1){
	$row = mysql_fetch_assoc($result);
	$_SESSION['usuario']=$row['id'];
	$_SESSION['nombre_usuario']=$row['nombre']." ".$row['apellidos'];
	$_SESSION['correo']=$row['correo'];
	$v_perfil=array();
	$v_perfil=split(",",$row['id_perfil']);
	$v_reportes=array();
	$v_reportes=split(",",$row['ids_reportes']);	
	$_SESSION['perfil']=$v_perfil;
	$_SESSION['reportes']=$v_reportes;
	$_SESSION['expiracion']=$row['fecha_caducidad'];
	$calidad=verifica_calidad($row['id']);
	if($calidad!=NULL){			
		//echo "entro";
		header("Location:alerta.php?datos=	".$calidad); 
		exit();		
	}else{
		header("Location:menu.php"); 
	exit();
	}
}else{
	header("Location:login.php"); 
	exit();
}

function verifica_calidad($id_usuario){
include ('cnx/Conexion_Calidad.php');
conectarc();
	
	$sql=	"SELECT DATEDIFF(ultima_revision,NOW()) AS diferencia, nombre_archivo  from tbl_archivos  where responsable='".$id_usuario."'";
	$result2=mysql_query($sql);
	if (!$result2) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
	} 
	if(mysql_num_rows($result2) >=1){		
		$var=1;
		while ($row2 = mysql_fetch_object($result2)){			
			if ($var==1){
				$vector_respuesta=$vector_respuesta.$row2->diferencia.'|'.$row2->nombre_archivo.',';
				$var=2;
			}else{
			$vector_respuesta=$vector_respuesta.$row2->diferencia.'|'.$row2->nombre_archivo.',';			
			}			
		}
		//echo $vector_respuesta;
		return $vector_respuesta;
	}

}
?>