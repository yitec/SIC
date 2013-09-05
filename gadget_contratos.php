<?
session_start();
include('cnx/conexion.php');
conectar();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script>
setTimeout("location.reload()", 300000);

</script>
<style>
body{
	background:no-repeat url(img/background_gadget.png);


}
.Stylo1{
	font-family:Arial;
	font-size:10px;
	color:#0C3;
	font-weight:bold;
	
	
}
.Stylo2{
	font-family:Arial;
	font-size:10px;
	color: #CF0;
	font-weight:bold;	
	
}

</style>
</head>

<?
$_SESSION['intentos']=$_SESSION['intentos']+1;
$result=mysql_query("select max(id) as id  from tbl_contratos where estado='"."4"."' ");
if (!$result) {//si da error que me despliegue el error del query
       echo $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query ejecutado: ' . $query;
		
		} 

if (mysql_num_rows($result)>=1){
	
	$row=mysql_fetch_assoc($result);
	$result2=mysql_query("select id,consecutivo  from tbl_gadget ");
	$row2=mysql_fetch_assoc($result2);
	if($row['id']>$row2['id']){
		$result3=mysql_query("select consecutivo  from tbl_contratos where id='".$row['id']."' ");
		$row3=mysql_fetch_assoc($result3);
		echo '<div class="Stylo1" style="margin-left:10px; margin-top:10px;">Nuevo = '.$row3['consecutivo'].'&nbsp;&nbsp;<img src="img/alert.png" /> </div>';	
		mysql_query("update tbl_gadget set id='".$row['id']."',consecutivo='".$row3['consecutivo']."'");
	}else{
		echo '<div class="Stylo1" style=" margin-left:10px; margin-top:10px;">Último = '.$row2['consecutivo'].'&nbsp;&nbsp;<img src="img/alert_verde.png" /> </div>';	
		
	}

}//end if num rows


/*
if (!isset ($_SESSION['ultimo'])){

	$_SESSION['ultimo']=$row['id'];
	$result2=mysql_query("select consecutivo  from tbl_contratos where id='".$row['id']."' ");
	$row2=mysql_fetch_assoc($result2);
	$_SESSION['consecutivo']="Último = ".$row2['consecutivo'];
	
}
}


if($row['id']>$_SESSION['ultimo']){

		$result2=mysql_query("select consecutivo  from tbl_contratos where id='".$row['id']."' ");
		$row2=mysql_fetch_assoc($result2);
		$_SESSION['consecutivo']="Nuevo = ".$row2['consecutivo'];
		echo '<br><br<div class="Stylo2"> Nuevo = '.$row2['consecutivo'].'&nbsp;&nbsp;<img src="img/alert.png" /></div>';	
		$_SESSION['ultimo']=$row['id'];
			$estado="Nuevo";
		

}
if ($_SESSION['intentos']>0)	{	
		echo '<br><br><div class="Stylo1">'.$_SESSION['consecutivo'].'&nbsp;&nbsp;<img src="img/alert_verde.png" /> </div>';
		echo '<br>'.$_SESSION['intentos'];
}
if ($_SESSION['intentos']==0)	{	
		echo '<br><br<div class="Stylo2"> Nuevo = '.$row2['consecutivo'].'&nbsp;&nbsp;<img src="img/alert.png" /></div>';	
}

*/
desconectar();
?>
<body>

</body>
</html>