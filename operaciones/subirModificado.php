<?php
//Como no sabemos cuantos archivos van a llegar, iteramos la variable $_FILES
$ruta="../calidad/archivos/Pendientes/";
$texto=$_POST['texto'];
foreach ($_FILES as $key) {
if($key['error'] == UPLOAD_ERR_OK ){//Verificamos si se subio correctamente
$nombre = utf8_decode($key['name']);//Obtenemos el nombre del archivo
$nocodenombre=$key['name'];//imprimimos el nombre sin codificacion para las tildes
$temporal = $key['tmp_name']; //Obtenemos el nombre del archivo temporal
$tamano= ($key['size'] / 1000)."Kb"; //Obtenemos el tamaño en KB
move_uploaded_file($temporal, $ruta . $nombre); //Movemos el archivo temporal a la ruta especificada
//El echo es para que lo reciba jquery y lo ponga en el div "cargados"
echo  $nocodenombre;
}else{
echo 0;
}
}
?>