<?php
include ('../cnx/conexion_activos.php');

$hoy=date("Y-m-d H:i:s");

/*****************************************************************************************************************
Accion:Ejecuta todas las operaciones sobre activos
Parametros: Vector con lista de parametros segun metodo
/****************************************************************************************************************/
conectara();
$metodo=$_POST['metodo'];
$parametros=$_POST['parametros'];
$usr = new Activos;
$usr->$metodo($parametros,$hoy);


class Activos{

	function guarda_activo($parametros){
				
		$v_datos=explode("|",$parametros);	
		
		//Esta variable obtiene el nuevo id insertado en activos
		$id_activo = 0;
		//Esta variable indica si es un insert o un update   0 -> insert    1 -> Update
		$tipo_query = $v_datos[0]; 

		$result=mysql_query("SELECT 1 FROM tbl_activos WHERE placa = '" . $v_datos[9] . "'" ,$_SESSION['conectact']);
		
		//si da error que me despliegue el error del query   
		if (!$result) {    		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
		}else{
			if(mysql_num_rows($result)>= 1){
				$jsondata['resultado'] = 'EXISTE';
			}else{				
				
				$result=mysql_query("insert into tbl_activos(activo,descripcion,modelo,serie,fecha_creacion,placa,precio,documento,fecha_modificacion,prestamo,oaf,factura)values('" . utf8_decode($v_datos[1]) . "','" . utf8_decode($v_datos[8]) . "','" . $v_datos[6] . "','" . $v_datos[7] . "',NOW(), '" . $v_datos[9] . "'," .  $v_datos[10]  . ",'" . $v_datos[11] . "', NOW()," . $v_datos[14]  . "," .  $v_datos[15]  .  ",'" .  $v_datos[16] . "');" , $_SESSION['conectact']);
								 
				if(!$result){
					$jsondata['resultado'] = "insert into tbl_activos(activo,descripcion,modelo,serie,fecha_creacion,placa,precio,documento,fecha_modificacion)values('" . utf8_decode($v_datos[1]) . "','" . utf8_decode($v_datos[8]) . "','" . $v_datos[6] . "','" . $v_datos[7] . "',NOW(), '" . $v_datos[9] . "'," .  $v_datos[10]  . ",'" . $v_datos[11] . "', NOW());" ;//'Query invalido: ' . mysql_error() ;
				}else{
					
					$result=mysql_query("select id_activos from tbl_activos where activo = '" . $v_datos[1] . "';",$_SESSION['conectact']);
	
					if(mysql_num_rows($result)>0){

						while ($row=mysql_fetch_object($result)){
							$id_activo = $row->id_activos; 
						}

						//SI SE SELECCIONO ESTADO
						if($v_datos[2]!=0){							
							$result=mysql_query("insert into tbl_activo_estado (id_activo,id_estado)values(" . $id_activo . "," . $v_datos[2] . ")",$_SESSION['conectact']);
							if(!$result){
								$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
							}
						}

						//SI SE SELECCIONO UBICACION
						if($v_datos[3]!=0){
							$result=mysql_query("insert into tbl_ubicacion_activo(id_activo,id_ubicacion)values(" . $id_activo . "," . $v_datos[3] . ")",$_SESSION['conectact']);
							if(!$result){
								$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
							}
						}
						
						//SI SE SELECCIONO CATEGORIA
						if($v_datos[4]!=0){
							$result=mysql_query("insert into tbl_activo_categoria (id_activo,id_categoria)values(" . $id_activo . "," . $v_datos[4] . ")",$_SESSION['conectact']);
							if(!$result){
								$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
							}
						}					
						
						//SI SE SELECCIONO  MARCA
						if($v_datos[5]!=0){
							$result=mysql_query("insert into tbl_marca_activo(id_activo,id_marca)values(" . $id_activo . "," . $v_datos[5] . ")",$_SESSION['conectact']);
							if(!$result){
								$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
							}
						}
						
						//SI SE SELECCIONO  RESPONSABLE
						if($v_datos[13]!=0){
							$result=mysql_query("insert into tbl_responsable(id_activo,id_persona)values(" . $id_activo . "," . $v_datos[13] . ")",$_SESSION['conectact']);
							if(!$result){
								$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
							}
						}
						
						
					}
					
				
				}
			
			}

		}
		
		if($jsondata['resultado']==""){
			mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se crea el activo:" . $v_datos[1] .  "-Placa:" . $v_datos[9] . "',NOW(),'ACTIVOS','" . $v_datos[12] . "')",$_SESSION['conectact']);
			
			$jsondata['resultado']="Success";
		}
		
		echo json_encode($jsondata);
		
	}

	function actualiza_activo($parametros){
		$v_datos=explode("|",$parametros);	
		
		//primero se actualiza en la tabla activos
		
		
		$result=mysql_query("SELECT 1 FROM tbl_activos WHERE placa = '" . $v_datos[9] . "' and  ID_ACTIVOS <> " . $v_datos[0] ,$_SESSION['conectact']);
		
		//si da error que me despliegue el error del query   
		if (!$result) {    		
				$jsondata['resultado'] = 'Query invalido: ' . mysql_error() ;
		}else{
			if(mysql_num_rows($result)>= 1){
				$jsondata['resultado'] = 'EXISTE';
		}else{
		
		
		
		
		
		
		$result=mysql_query("update tbl_activos set 
			activo = '" . utf8_decode($v_datos[1]) . "' , 
			descripcion = '" . utf8_decode($v_datos[8]) . "' , 
			modelo ='" . $v_datos[6] . "' ,  
			serie ='" . $v_datos[7] . "', 
			placa='" . $v_datos[9] . "', 
			precio= " . $v_datos[10] . " , 
			fecha_modificacion = NOW() , 
			documento = '" . $v_datos[11] . "', 
			prestamo = " .	$v_datos[14]  . " ,	
			oaf = " . $v_datos[15]  . " ,
			factura = '" . $v_datos[16]  . "'  where id_activos = " .  $v_datos[0]  ,$_SESSION['conectact']);
									 
		if(!$result){
			$jsondata['resultado'] = 'Query invalido 1: ' . mysql_error() ;
		}else{
			
			//Se procede a verificar el estado
			if($v_datos[2]!=0){
				$result=mysql_query("SELECT 1 FROM tbl_activo_estado WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
									 
				if($result){
					if(mysql_num_rows($result)>0){
						//se procede a hacer update
						$result=mysql_query("update tbl_activo_estado set id_estado = " . $v_datos[2] . " WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
						if(!$result){
							$jsondata['resultado'] = 'Query invalido 3: ' . mysql_error() ;
						}
					}else{
						//se procede a hacer insert
						$result=mysql_query("insert into tbl_activo_estado (id_activo,id_estado)values(" . $v_datos[0] . "," . $v_datos[2] . ")",$_SESSION['conectact']);;
						if(!$result){
							$jsondata['resultado'] = 'Query invalido 4: ' . mysql_error() ;
						}
					}
				
				}else{
					$jsondata['resultado'] = 'Query invalido 2: ' . mysql_error() ;
				}
			}else{
				//hace delete a la relacion
				$result=mysql_query("DELETE FROM tbl_activo_estado WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
				if(!$result){
					$jsondata['resultado'] = 'Query invalido 5: ' . mysql_error() ;
				}
			}
			//FIN de verificar el estado
			
			
			
			//Se procede a verificar el ubicacion
			if($v_datos[3]!=0){
				
				$result=mysql_query("SELECT 1 FROM tbl_ubicacion_activo WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
									 
				if($result){

					if(mysql_num_rows($result)>0){
						//se procede a hacer update
						$result=mysql_query("update tbl_ubicacion_activo set id_ubicacion = " . $v_datos[3] . " WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
						if(!$result){
							$jsondata['resultado'] = 'Query invalido 3: ' . mysql_error() ;
						}
					}else{
						//se procede a hacer insert
						$result=mysql_query("insert into tbl_ubicacion_activo (id_activo,id_ubicacion)values(" . $v_datos[0] . "," . $v_datos[3] . ")",$_SESSION['conectact']);;
						if(!$result){
							$jsondata['resultado'] = 'Query invalido 4: ' . mysql_error() ;
						}
					}
				
				}else{
					$jsondata['resultado'] = 'Query invalido 2: ' . mysql_error() ;
				}
			}else{
				//hace delete a la relacion
				$result=mysql_query("DELETE FROM tbl_ubicacion_activo WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
				if(!$result){
					$jsondata['resultado'] = 'Query invalido 5: ' . mysql_error() ;
				}
			}
			//FIN de verificar ubicacion
			
			
			//Se procede a verificar categoria
			if($v_datos[4]!=0){
			
	
				
				$result=mysql_query("SELECT 1 FROM tbl_activo_categoria WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
									 
				if($result){
					if(mysql_num_rows($result)>0){
						//se procede a hacer update
						$result=mysql_query("update tbl_activo_categoria set id_categoria = " . $v_datos[4] . " WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
						if(!$result){
							$jsondata['resultado'] = 'Query invalido 3: ' . mysql_error() ;
						}
					}else{
						//se procede a hacer insert
						$result=mysql_query("insert into tbl_activo_categoria (id_activo,id_categoria)values(" . $v_datos[0] . "," . $v_datos[4] . ")",$_SESSION['conectact']);;
						if(!$result){
							$jsondata['resultado'] = 'Query invalido 4: ' . mysql_error() ;
						}
					}
				
				}else{
					$jsondata['resultado'] = 'Query invalido 2: ' . mysql_error() ;
				}
			}else{
				//hace delete a la relacion
				$result=mysql_query("DELETE FROM tbl_activo_categoria WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
				if(!$result){
					$jsondata['resultado'] = 'Query invalido 5: ' . mysql_error() ;
				}
			}
			//FIN de verificar categoria
			
			
			//Se procede a verificar marca
			if($v_datos[5]!=0){
				$result=mysql_query("SELECT 1 FROM tbl_marca_activo WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
									 
				if($result){
					if(mysql_num_rows($result)>0){
						//se procede a hacer update
						$result=mysql_query("update tbl_marca_activo set id_marca = " . $v_datos[5] . " WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
						if(!$result){
							$jsondata['resultado'] = 'Query invalido 3: ' . mysql_error() ;
						}
					}else{
						//se procede a hacer insert
						$result=mysql_query("insert into tbl_marca_activo (id_activo,id_marca)values(" . $v_datos[0] . "," . $v_datos[5] . ")",$_SESSION['conectact']);;
						if(!$result){
							$jsondata['resultado'] = 'Query invalido 4: ' . mysql_error() ;
						}
					}
				
				}else{
					$jsondata['resultado'] = 'Query invalido 2: ' . mysql_error() ;
				}
			}else{
				//hace delete a la relacion
				$result=mysql_query("DELETE FROM tbl_marca_activo WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
				if(!$result){
					$jsondata['resultado'] = 'Query invalido 5: ' . mysql_error() ;
				}
			}
			//FIN de verificar marca
			
			
			//Se procede a verificar responsable
			if($v_datos[13]!=0){
				$result=mysql_query("SELECT 1 FROM tbl_responsable WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
									 
				if($result){
					if(mysql_num_rows($result)>0){
						//se procede a hacer update
						$result=mysql_query("update tbl_responsable set id_persona = " . $v_datos[13] . " WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
						if(!$result){
							$jsondata['resultado'] = 'Query invalido 3: ' . mysql_error() ;
						}
					}else{
						//se procede a hacer insert
						$result=mysql_query("insert into tbl_responsable (id_activo,id_persona)values(" . $v_datos[0] . "," . $v_datos[13] . ")",$_SESSION['conectact']);;
						if(!$result){
							$jsondata['resultado'] = 'Query invalido 4: ' . mysql_error() ;
						}
					}
				
				}else{
					$jsondata['resultado'] = 'Query invalido 2: ' . mysql_error() ;
				}
			}else{
				//hace delete a la relacion
				$result=mysql_query("DELETE FROM tbl_responsable WHERE id_activo =" . $v_datos[0] ,$_SESSION['conectact']);
				if(!$result){
					$jsondata['resultado'] = 'Query invalido 5: ' . mysql_error() ;
				}
			}
			//FIN de verificar responsable			
			
			
			
			
			
			
			
			
			
			
			
		}
		
		if($jsondata['resultado']==""){
			mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se actualizo el activo:" . $v_datos[1] .  "-Placa:" . $v_datos[9] . "',NOW(),'ACTIVOS','" . $v_datos[12] . "')",$_SESSION['conectact']);
			$jsondata['resultado']="Success";
		}
		
		
	}
	}
	echo json_encode($jsondata);
	}
	
	function elimina_activo($parametros){
		
		$resultado ="";
		$v_datos=explode("|",$parametros);
		
		
		$result=mysql_query("select 1 from tbl_pedido WHERE id_activo = " . $v_datos[0] ,$_SESSION['conectact']);
		if ($result) { 
			if(mysql_num_rows($result)>0){
				echo "EXISTE";
				die();
			}
		}
		
		$result=mysql_query("select activo,placa from tbl_activos WHERE id_activos = " . $v_datos[0] ,$_SESSION['conectact']);
		while($row = mysql_fetch_array($result))
		{
			mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se elimino el activo:" . $row[0] .  "-Placa:" .$row[1]  . "',NOW(),'ACTIVOS','" . $v_datos[1] . "')",$_SESSION['conectact']);
		
		}

		
		
		$result=mysql_query("DELETE FROM tbl_activos WHERE id_activos = " . $v_datos[0] ,$_SESSION['conectact']);
		if (!$result) { 
			$resultado = "DELETE FROM tbl_activos WHERE id_activos = " . $v_datos[0] ;
		}else{
		
			$result=mysql_query("DELETE FROM tbl_activo_categoria  WHERE id_activo = " . $v_datos[0],$_SESSION['conectact']);
			if (!$result) { 
				$resultado = "DELETE FROM tbl_activo_categoria  WHERE id_activo = " . $v_datos[0];
			}else{
			
				$result=mysql_query("DELETE FROM tbl_marca_activo  WHERE id_activo = " . $v_datos[0],$_SESSION['conectact']);
				if (!$result) { 
					$resultado = "DELETE FROM tbl_marca_activo  WHERE id_activo = " . $v_datos[0];
				}else{					
					$result=mysql_query("DELETE FROM tbl_ubicacion_activo  WHERE id_activo =" . $v_datos[0],$_SESSION['conectact']);
					if (!$result) { 
						$resultado = "DELETE FROM tbl_ubicacion_activo  WHERE id_activo =" . $v_datos[0];
					}else{
						$result=mysql_query("DELETE FROM tbl_responsable  WHERE id_activo =" . $v_datos[0],$_SESSION['conectact']);
						if (!$result) { 
							$resultado = "DELETE FROM tbl_responsable  WHERE id_activo =" . $v_datos[0] ;
						}
					}
				}
			}
		}	

		
		if($resultado==""){	
			echo "Success";
		}else{
			echo $resultado;
		}
		
		
	}
	
	function busqueda_activo($parametros){
		
		
		$v_datos=explode("|",$parametros);
		$where = $v_dato[0];
			
		$select =  "SELECT ACT.ID_ACTIVOS,ACT.Activo,marc.marca,ACT.modelo,ACT.placa FROM  tbl_activos as ACT
					LEFT OUTER JOIN tbl_marca_activo as MarcAct ON MarcAct.id_activo = ACT.id_activos
					LEFT OUTER JOIN tbl_marca as marc		 	ON MarcAct.id_marca = marc.id_marca ";
		
		if($v_datos[0] != ""){
			$where = "where ACT.Activo like '%" . $v_datos[0] . "%'";
		}
		
		if($v_datos[1] != ""){
			if($where==""){
				$where = "where marc.marca like '%" . $v_datos[1] . "%'";
			}else{
				$where .= " AND marc.marca like '%" . $v_datos[1] . "%'";
			}
		}
		
		if($v_datos[2] != ""){
			if($where==""){
				$where = "where ACT.placa like '%" . $v_datos[2] . "%'";
			}else{
				$where .= " AND ACT.placa like '%" . $v_datos[2] . "%'";
			}
		}
		
		$select = $select . $where;

		
		$result=mysql_query($select ,$_SESSION['conectact']);
		if (!$result) {
			$mensaje = "ERROR"; 
		}else{
			if(mysql_num_rows($result)>0){
				
				$table='
				<div class="Tabla_Lista" >
	            <table>
                    <tr>
                        <td>
                           Editar
                        </td>
                        <td >
                            Activo
                        </td>
                        <td>
                           Marca
                        </td>
						<td>
                           Placa
                        </td>
						<td>
                           Eliminar
                        </td>
                    </tr>';
					
				while($row = mysql_fetch_array($result))
				{
				
					
					$table .='
					 <tr>
						<td style="width:10%" align="center">
							<div>
								<a class="lnk_grid" href="../activos/nuevo_archivo.php?USS_FX=' . $row[0] . '">Sel.</a>
							</div>
						</td>
                        <td align="center">' .
                           utf8_encode($row[1]) .
                        '</td>
                        <td align="center">' .
                           utf8_encode($row[2]) .
                        '</td>
                        <td align="center">' .
                             $row[4] .
                        '</td>
						<td style="width:10%" style align="center">
							<a id="myLink" href="javascript:Eliminar_activo(' .  $row[0]  . ');">
									<img src="../img/delete.png" alt="delete" height="19" width="19">
							</a>
                        </td>
                    </tr>';
					
				}
				
				$table = $table . '</div</table>';
				
				$mensaje= (string)$table;
				
			}else{
				$mensaje= (string)"NADA"; 
			}
		}
		
		
		echo (string)$mensaje;
	}
	
	
	
	
	
	
	function guardar_ubicacion($parametros){
	
		$v_datos=explode("|",$parametros);
		
		$result=mysql_query("SELECT 1 FROM tbl_ubicacion WHERE ubicacion like '%" . $v_datos[0] . "%'" ,$_SESSION['conectact']);
									 
		if($result){
			if(mysql_num_rows($result)>0){
				$jsondata['resultado']="EXISTE";
			}else{
				$result=mysql_query("insert into tbl_ubicacion(ubicacion,descripcion)values('" . utf8_decode($v_datos[0]) ."','" . utf8_decode($v_datos[1]) . "')"  ,$_SESSION['conectact']);
				if(!$result){
					$jsondata['resultado']='Query invalido : ' . mysql_error() ;
				}
			}
		}else{
			$jsondata['resultado']='Query invalido : ' . mysql_error() ;
		}
	
	
		if($jsondata['resultado']==""){
			mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se crea la ubicacion:" . $v_datos[0] . "',NOW(),'UBICACION','" . $v_datos[2] . "')",$_SESSION['conectact']);
			$jsondata['resultado']="Success";
		}
		
		echo json_encode($jsondata);
	}
	
	function actualizar_ubicacion($parametros){
	
		$v_datos=explode("|",$parametros);
	
		$result=mysql_query("update tbl_ubicacion set ubicacion = '" . utf8_decode($v_datos[1]) ."' , descripcion = '" . utf8_decode($v_datos[2]) ."'   where id_ubicacion =" . $v_datos[0] ,$_SESSION['conectact']);
		if(!$result){
			$jsondata['resultado']='Query invalido : ' . mysql_error() ;
		}
		
	
		if($jsondata['resultado']==""){
			mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se actualiza la ubicacion:" . $v_datos[1] . "',NOW(),'UBICACION','" . $v_datos[3] . "')",$_SESSION['conectact']);
			$jsondata['resultado']="Success";
		}
		
		echo json_encode($jsondata);
	}
	
	
	function eliminar_ubicacion($parametros){
		
		$v_datos=explode("|",$parametros);
		
		$result=mysql_query("SELECT 1 FROM tbl_ubicacion_activo WHERE id_ubicacion like " . $v_datos[0] ,$_SESSION['conectact']);
		if($result){
			if(mysql_num_rows($result)>0){
				$jsondata['resultado']="EXISTE";
			}else{
			
				$result=mysql_query("select ubicacion from tbl_ubicacion WHERE id_ubicacion = " . $v_datos[0] ,$_SESSION['conectact']);
				while($row = mysql_fetch_array($result))
				{
					mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se elimino la ubicacion:" . $row[0] . "',NOW(),'UBICACION','" . $v_datos[1] . "')",$_SESSION['conectact']);
		
				}
			
				$result=mysql_query("delete from tbl_ubicacion where id_ubicacion = " . $v_datos[0] ,$_SESSION['conectact']);
				if(!$result){
					$jsondata['resultado']='Query invalido : ' . mysql_error() ;
				}
			}
		}
	
		if($jsondata['resultado']==""){
				$jsondata['resultado']="Success";
		}
		
		echo json_encode($jsondata);
	}
	
	
	function busqueda_ubicacion($parametros){
		
		
		$v_datos=explode("|",$parametros);
		//$where = $v_dato[0];
			
		$select =  "SELECT * from tbl_ubicacion ";
		
		if($v_datos[0] != ""){
			$where = "where ubicacion like '%" . $v_datos[0] . "%'";
		}
		
		if($v_datos[1] != ""){
			if($where==""){
				$where = "where descripcion like '%" . $v_datos[1] . "%'";
			}else{
				$where .= " AND descripcion like '%" . $v_datos[1] . "%'";
			}
		}
		
		
		$select = $select . $where;
		
		$result=mysql_query($select ,$_SESSION['conectact']);
		if (!$result) {
			$mensaje = "ERROR"; 
		}else{
			if(mysql_num_rows($result)>0){
				
				$table .= '
				<div class="Tabla_Lista" >
                <table>
                    <tr>
                        <td>
                           Editar
                        </td>
                        <td >
                            Ubicacion
                        </td>
                        <td>
                           Descripcion
                        </td>
						<td>
                           Eliminar
                        </td>
                    </tr>';
					
				while($row = mysql_fetch_array($result))
				{
					$table .= '
					 <tr>
						<td style="width:10%" align="center">
							<div>
								<a class="lnk_grid" href="../activos/lista_ubicacion.php?USS_FX=E_' . $row[0] . '">Sel.</a>
							</div>
						</td>
                        <td align="center">' .
                           utf8_encode($row[1]) .
                        '</td>
                        <td align="center">' .
                           utf8_encode($row[2]) .
                        '</td>
                        
						<td style="width:10%" style align="center">
							<a id="myLink" href="../activos/lista_ubicacion.php?USS_FX=D_' . $row[0] . '">
									<img src="../img/delete.png" alt="delete" height="19" width="19">
							</a>
                        </td>
                    </tr>';
				}
				
				$table .= '
				</table>
				</div';
				
				$table = $table . '</div</table>';
				
				$mensaje= (string)$table;
				
			}else{
				$mensaje= (string)"NADA"; 
			}
		}
		
		
		echo (string)$mensaje;
	}
	
		
	
		
	function guardar_categoria($parametros){
	
		$v_datos=explode("|",$parametros);
	
		$result=mysql_query("SELECT 1 FROM tbl_categoria WHERE categoria like '%" . $v_datos[0] . "%'" ,$_SESSION['conectact']);
									 
		if($result){
			if(mysql_num_rows($result)>0){
				$jsondata['resultado']="EXISTE";
			}else{
				$result=mysql_query("insert into tbl_categoria(categoria,descripcion)values('" . utf8_decode($v_datos[0]) ."','" . utf8_decode($v_datos[1]) . "')"  ,$_SESSION['conectact']);
				if(!$result){
					$jsondata['resultado']='Query invalido : ' . mysql_error() ;
				}
			}
		}else{
			$jsondata['resultado']='Query invalido : ' . mysql_error() ;
		}
	
	
		if($jsondata['resultado']==""){
			mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se creo la categoria:" . $v_datos[0] . "',NOW(),'CATEGORIA','" . $v_datos[2] . "')",$_SESSION['conectact']);
			$jsondata['resultado']="Success";
		}
		
		echo json_encode($jsondata);
	}
	
	function actualizar_categoria($parametros){
	
		$v_datos=explode("|",$parametros);
	
		$result=mysql_query("update tbl_categoria set categoria = '" . utf8_decode($v_datos[1]) ."' , descripcion = '" . utf8_decode($v_datos[2]) ."'   where id_categoria =" . $v_datos[0] ,$_SESSION['conectact']);
		if(!$result){
			$jsondata['resultado']='Query invalido : ' . mysql_error() ;
		}
		
	
		if($jsondata['resultado']==""){
			mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se actualiza la categoria:" . $v_datos[1] . "',NOW(),'CATEGORIA','" . $v_datos[3] . "')",$_SESSION['conectact']);
			$jsondata['resultado']="Success";
		}
		
		echo json_encode($jsondata);
	}
	
	
	function eliminar_categoria($parametros){
		
		$v_datos=explode("|",$parametros);
		
		$result=mysql_query("SELECT 1 FROM tbl_activo_categoria WHERE id_categoria like " . $v_datos[0] ,$_SESSION['conectact']);
		if($result){
			if(mysql_num_rows($result)>0){
				$jsondata['resultado']="EXISTE";
			}else{
			
				$result=mysql_query("select categoria from tbl_categoria WHERE id_categoria = " . $v_datos[0] ,$_SESSION['conectact']);
				while($row = mysql_fetch_array($result))
				{
					mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se elimino la categoria:" . $row[0] . "',NOW(),'CATEGORIA','" . $v_datos[1] . "')",$_SESSION['conectact']);
		
				}
			
			
				$result=mysql_query("delete from tbl_categoria where id_categoria = " . $v_datos[0] ,$_SESSION['conectact']);
				if(!$result){
					$jsondata['resultado']='Query invalido : ' . mysql_error() ;
				}
			}
		}
	
		if($jsondata['resultado']==""){
			$jsondata['resultado']="Success";
		}
		
		echo json_encode($jsondata);
	}
	
	
	function busqueda_categoria($parametros){
		
		
		$v_datos=explode("|",$parametros);
		$where = $v_dato[0];
			
		$select =  "SELECT * from tbl_categoria ";
		
		if($v_datos[0] != ""){
			$where = "where categoria like '%" . $v_datos[0] . "%'";
		}
		
		if($v_datos[1] != ""){
			if($where==""){
				$where = "where descripcion like '%" . $v_datos[1] . "%'";
			}else{
				$where .= " AND descripcion like '%" . $v_datos[1] . "%'";
			}
		}
		
		
		$select = $select . $where;
		
		$result=mysql_query($select ,$_SESSION['conectact']);
		if (!$result) {
			$mensaje = "ERROR"; 
		}else{
			if(mysql_num_rows($result)>0){
				
				$table .= '
				<div class="Tabla_Lista" >
                <table>
                    <tr>
                        <td>
                           Editar
                        </td>
                        <td >
                            Categoria
                        </td>
                        <td>
                           Descripcion
                        </td>
						<td>
                           Eliminar
                        </td>
                    </tr>';
					
				while($row = mysql_fetch_array($result))
				{
					$table .= '
					 <tr>
						<td style="width:10%" align="center">
							<div>
								<a class="lnk_grid" href="../activos/lista_categoria.php?USS_FX=E_' . $row[0] . '">Sel.</a>
							</div>
						</td>
                        <td align="center">' .
                           utf8_encode($row[1]) .
                        '</td>
                        <td align="center">' .
                           utf8_encode($row[2]) .
                        '</td>
                        
						<td style="width:10%" style align="center">
							<a id="myLink" href="../activos/lista_categoria.php?USS_FX=D_' . $row[0] . '">
									<img src="../img/delete.png" alt="delete" height="19" width="19">
							</a>
                        </td>
                    </tr>';
				}
				
				$table .= '
				</table>
				</div';
				
				$table = $table . '</div</table>';
				
				$mensaje= (string)$table;
				
			}else{
				$mensaje= (string)"NADA"; 
			}
		}
		
		
		echo (string)$mensaje;
	}
	
	
	
	
	
	
	
	
			
	function guardar_marca($parametros){
	
		$v_datos=explode("|",$parametros);
	
		$result=mysql_query("SELECT 1 FROM tbl_marca WHERE marca like '%" . $v_datos[0] . "%'" ,$_SESSION['conectact']);
									 
		if($result){
			if(mysql_num_rows($result)>0){
				$jsondata['resultado']="EXISTE";
			}else{
				$result=mysql_query("insert into tbl_marca(marca,descripcion)values('" . utf8_decode($v_datos[0]) ."','" . utf8_decode($v_datos[1]) . "')"  ,$_SESSION['conectact']);
				if(!$result){
					$jsondata['resultado']='Query invalido : ' . mysql_error() ;
				}
			}
		}else{
			$jsondata['resultado']='Query invalido : ' . mysql_error() ;
		}
	
	
		if($jsondata['resultado']==""){
			mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se creo la marca:" . $v_datos[0] . "',NOW(),'MARCA','" . $v_datos[2] . "')",$_SESSION['conectact']);
			$jsondata['resultado']="Success";
		}
		
		echo json_encode($jsondata);
	}
	
	
	function actualizar_marca($parametros){
	
		$v_datos=explode("|",$parametros);
	
		$result=mysql_query("update tbl_marca set marca = '" . utf8_decode($v_datos[1]) ."' , descripcion = '" . utf8_decode($v_datos[2] )."'   where id_marca =" . $v_datos[0] ,$_SESSION['conectact']);
		if(!$result){
			$jsondata['resultado']='Query invalido : ' . mysql_error() ;
		}
		
	
		if($jsondata['resultado']==""){
			mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se actualiza la marca:" . $v_datos[1] . "',NOW(),'MARCA','" . $v_datos[3] . "')",$_SESSION['conectact']);
			$jsondata['resultado']="Success";
		}
		
		echo json_encode($jsondata);
	}
	
	
	
	function eliminar_marca($parametros){
		
		$v_datos=explode("|",$parametros);
		
		$result=mysql_query("SELECT 1 FROM tbl_marca_activo WHERE id_marca like " . $v_datos[0] ,$_SESSION['conectact']);
		if($result){
			if(mysql_num_rows($result)>0){
				$jsondata['resultado']="EXISTE";
			}else{
			
			
			   $result=mysql_query("select marca from tbl_marca WHERE id_marca = " . $v_datos[0] ,$_SESSION['conectact']);
				while($row = mysql_fetch_array($result))
				{
					mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se elimino la marca:" . $row[0] . "',NOW(),'MARCA','" . $v_datos[1] . "')",$_SESSION['conectact']);
		
				}
			
			
				$result=mysql_query("delete from tbl_marca where id_marca = " . $v_datos[0] ,$_SESSION['conectact']);
				if(!$result){
					$jsondata['resultado']='Query invalido : ' . mysql_error() ;
				}
			}
		}
	
		if($jsondata['resultado']==""){
			$jsondata['resultado']="Success";
		}
		
		echo json_encode($jsondata);
	}
	
	
	function busqueda_marca($parametros){
		
		
		$v_datos=explode("|",$parametros);
		$where = $v_dato[0];
			
		$select =  "SELECT * from tbl_marca ";
		
		if($v_datos[0] != ""){
			$where = "where marca like '%" . $v_datos[0] . "%'";
		}
		
		if($v_datos[1] != ""){
			if($where==""){
				$where = "where descripcion like '%" . $v_datos[1] . "%'";
			}else{
				$where .= " AND descripcion like '%" . $v_datos[1] . "%'";
			}
		}
		
		
		$select = $select . $where;
		
		$result=mysql_query($select ,$_SESSION['conectact']);
		if (!$result) {
			$mensaje = "ERROR"; 
		}else{
			if(mysql_num_rows($result)>0){
				
				$table .= '
				<div class="Tabla_Lista" >
                <table>
                    <tr>
                        <td>
                           Editar
                        </td>
                        <td >
                            Marca
                        </td>
                        <td>
                           Descripcion
                        </td>
						<td>
                           Eliminar
                        </td>
                    </tr>';
					
				while($row = mysql_fetch_array($result))
				{
					$table .= '
					 <tr>
						<td style="width:10%" align="center">
							<div>
								<a class="lnk_grid" href="../activos/lista_marca.php?USS_FX=E_' . $row[0] . '">Sel.</a>
							</div>
						</td>
                        <td align="center">' .
                           utf8_encode($row[1]) .
                        '</td>
                        <td align="center">' .
                           utf8_encode($row[2]) .
                        '</td>
                        
						<td style="width:10%" style align="center">
							<a id="myLink" href="../activos/lista_marca.php?USS_FX=D_' . $row[0] . '">
									<img src="../img/delete.png" alt="delete" height="19" width="19">
							</a>
                        </td>
                    </tr>';
				}
				
				$table .= '
				</table>
				</div';
				
				$table = $table . '</div</table>';
				
				$mensaje= (string)$table;
				
			}else{
				$mensaje= (string)"NADA"; 
			}
		}
		
		
		echo (string)$mensaje;
	}

	
	
	
	function guardar_persona($parametros){
	
		$v_datos=explode("|",$parametros);
		$resultado ="";
		$result=mysql_query("SELECT 1 FROM tbl_persona WHERE nombre like '" . $v_datos[0] . "%'" ,$_SESSION['conectact']);
									 
		if($result){
			if(mysql_num_rows($result)>0){
				$resultado=(string)"EXISTE";
			}else{
				$result=mysql_query("insert into tbl_persona(nombre,identificacion,tipo,descripcion,fecha_creacion,email)
				values('" . utf8_decode($v_datos[0]) ."','" . $v_datos[1] . "','" . $v_datos[2] . "','" . utf8_decode($v_datos[3]). "',NOW(),'" . $v_datos[5] . "')"  ,$_SESSION['conectact']);
				if(!$result){
					$resultado=(string)'FALLO';
				}
			}
		}else{
			$resultado=(string)'FALLO';
		}
	
	
		if($resultado==""){
			mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se creo a la persona:" . $v_datos[0] . "',NOW(),'PERSONAL','" . $v_datos[4] . "')",$_SESSION['conectact']);
			echo (string)"Success";
		}else{	
			echo (string)$resultado;
		}
	}
	
	function actualizar_persona($parametros){
	
		$v_datos=explode("|",$parametros);
		
		$resultado ="";
		$result=mysql_query("select nombre from tbl_persona where nombre like '%" . $v_datos[1] . "%'  and id_persona <> " . $v_datos[0]  ,$_SESSION['conectact']);
		if($result){
			if(mysql_num_rows($result)>0){
				$resultado='EXISTE';
			}else{
				$result=mysql_query("update tbl_persona set nombre = '" . utf8_decode($v_datos[1]) ."' , identificacion = '" . $v_datos[2] ."' , tipo = " .  $v_datos[3] . " , email = '" . $v_datos[6]  . 
								"', descripcion = '" . utf8_decode($v_datos[4]) . "' where id_persona =" . $v_datos[0] ,$_SESSION['conectact']);
				if(!$result){
						$resultado='Query invalido : ' . mysql_error() ;
				}
			}
		}else{
			$resultado='Query invalido : ' . mysql_error() ;
		}
	
		if($resultado==""){
			mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se actualizo a la persona:" . $v_datos[1] . "',NOW(),'PERSONAL','" . $v_datos[5] . "')",$_SESSION['conectact']);
			$resultado="Success";
		}
		
		echo (string)$resultado;
	}
	

	function eliminar_persona($parametros){
		
		$v_datos=explode("|",$parametros);
		
		$resultado="";
		$result=mysql_query("SELECT 1 FROM tbl_pedido WHERE id_personal = " . $v_datos[0] ,$_SESSION['conectact']);
		if($result){
			if(mysql_num_rows($result)>0){
				$resultado="EXISTE";
			}else{
			
				$result=mysql_query("select nombre from tbl_persona WHERE id_persona = " . $v_datos[0] ,$_SESSION['conectact']);
				while($row = mysql_fetch_array($result))
				{
					mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se elimino a la persona:" . $row[0] . "',NOW(),'PERSONAL','" . $v_datos[1] . "')",$_SESSION['conectact']);
		
				}
			
				$result=mysql_query("delete from tbl_persona where id_persona = " . $v_datos[0] ,$_SESSION['conectact']);
				if(!$result){
					$resultado='Query invalido : ' . mysql_error() ;
				}
			}
		}
	
		if($resultado==""){
			$resultado="Success";
		}
		
		echo (string)$resultado;
	}
		
	
	function busqueda_persona($parametros){
		
		
		$v_datos=explode("|",$parametros);
		$where = "";
		$table ="";	
		$select =  "SELECT * from tbl_persona ";
		$mensaje="";
		$tipo="";
		
		
		if($v_datos[0] != ""){
			$where = "where nombre like '%" . $v_datos[0] . "%'";
		}
		
		if($v_datos[1] != ""){
			if($where==""){
				$where = "where identificacion like '%" . $v_datos[1] . "%'";
			}else{
				$where .= " AND identificacion like '%" . $v_datos[1] . "%'";
			}
		}
		
		
		$select = $select . $where;
				
		
		$result=mysql_query($select ,$_SESSION['conectact']);
		if (!$result) {
			$mensaje = "ERROR"; 
		}else{

			if(mysql_num_rows($result)>0){
				
				$table .= '
				<div class="Tabla_Lista" >
                <table>
                    <tr>
                        <td>
                           Editar
                        </td>
                        <td >
                            Nombre
                        </td>
                        <td>
                          Identificaci&oacute;n
                        </td>
						<td>
                           Tipo
                        </td>
						<td>
                           Eliminar
                        </td>
                    </tr>';

				while($row = mysql_fetch_array($result))
				{
				
					if($row[5] ==1){
						$tipo="interno";
					}else{
						$tipo="externo";
					}
				
					$table .= '
					  <tr>
						<td style="width:10%" align="center">
							<div>
								<a class="lnk_grid" href="../activos/nuevo_persona.php?USSP=E_' . $row[0] . '">Sel.</a>
							</div>
						</td>
                        <td align="center">' .
                           utf8_encode($row[1]) .
                        '</td>
                        <td align="center">' .
                           $row[2] .
                        '</td>
                        <td align="center">' .
						    $tipo .
                        '</td>
						<td style="width:10%" style align="center">
							<a id="myLink" href="../activos/nuevo_persona.php?USSP=D_' . $row[0] . '">
									<img src="../img/delete.png" alt="delete" height="19" width="19">
							</a>
                        </td>
                    </tr>';
					
				}

				$table .= '</table></div>';
				
				$mensaje= (string)$table;
				
			}else{
				$mensaje= (string)"NADA"; 
			}

		}
		
		
		echo (string)$mensaje;
		
	}	
	
	
	
	
	
	function pedido_guardar($parametros){
			
		$v_datos=explode("|",$parametros);	
		
		$select="SELECT 1 FROM tbl_pedido AS PED
				 INNER JOIN tbl_activos AS ACT 		ON ACT.ID_ACTIVOS =  PED.ID_ACTIVO
				 INNER JOIN tbl_persona AS PER		ON PER.ID_PERSONA =  PED.ID_PERSONAL
				 WHERE ACT.ID_ACTIVOS = " . $v_datos[0];
		
		
		$result=mysql_query($select ,$_SESSION['conectact']);
		if (!$result) {
			$jsondata['resultado'] = "ERROR"; 
		}else{
			if(mysql_num_rows($result)>0){
				$jsondata['resultado'] = "EXISTE"; 
			}else{
				$select="insert into tbl_pedido(id_activo,id_personal,descripcion,fecha_pedido,activo)
												values(" . $v_datos[0] . "," . $v_datos[1]  . ",'" . $v_datos[2] . "','" . $v_datos[3] . "'," . 0 . ")";
			
				$result=mysql_query($select ,$_SESSION['conectact']);
				if (!$result) {
					$jsondata['resultado'] = "ERROR";
				}			
			}		
		}
		
		if($jsondata['resultado']==""){
				
				
				mysql_query("UPDATE tbl_activos set prestamo = 1 where ID_ACTIVOS =" . $v_datos[0],$_SESSION['conectact']);
				
				
				$select="SELECT ACT.ACTIVO,PER.NOMBRE,PER.EMAIL FROM tbl_pedido AS PED
				 INNER JOIN tbl_activos AS ACT 		ON ACT.ID_ACTIVOS =  PED.ID_ACTIVO
				 INNER JOIN tbl_persona AS PER		ON PER.ID_PERSONA =  PED.ID_PERSONAL
				 WHERE ACT.ID_ACTIVOS = " . $v_datos[0] . " AND PER.ID_PERSONA = " . $v_datos[1];
				
				$result=mysql_query($select ,$_SESSION['conectact']);
				while($row = mysql_fetch_array($result))
				{
					if($row[2]!=""){
						$subject = "Solicitud de activo:";
						$message = $v_datos[0];
						mail($row[2],"Nuevo Pendiente.",$subject, $message);	
					}
					mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se agrego peticion del activo:" . $row[0] . "  a la persona:" . $row[1] . "',NOW(),'PETICION','" . $v_datos[4] . "')",$_SESSION['conectact']);
		
				}
			
			
			//mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se creo  la peticion:" . $row[0] . "',NOW(),'PETICION','" . $v_datos[4] . "')",$_SESSION['conectact']);
			$jsondata['resultado']="Success";
		}
		
		echo json_encode($jsondata);
	
	}
	
	function pedido_actualizar($parametros){
			
		$v_datos=explode("|",$parametros);	
		
		$select="SELECT 1 FROM tbl_pedido AS PED
				 INNER JOIN tbl_activos AS ACT 		ON ACT.ID_ACTIVOS =  PED.ID_ACTIVO
				 INNER JOIN tbl_persona AS PER		ON PER.ID_PERSONA =  PED.ID_PERSONAL
				 WHERE ACT.ID_ACTIVOS = " . $v_datos[1]  .  " AND PED.ID_PEDIDO <> " . $v_datos[0];
		
		
		$result=mysql_query($select ,$_SESSION['conectact']);
		if (!$result) {
			$jsondata['resultado'] = "ERROR"; 
		}else{
			
			if(mysql_num_rows($result)>0){
				$jsondata['resultado'] = "EXISTE"; 
			}else{
				$select="UPDATE tbl_pedido SET id_activo = " . $v_datos[1] . ", id_personal =" . $v_datos[2] . ", descripcion ='" . $v_datos[3] . "', fecha_pedido ='" . $v_datos[4] . "', 	activo =" . $v_datos[5] . " WHERE ID_PEDIDO = " . $v_datos[0];
				
				
				
				
				$result=mysql_query($select ,$_SESSION['conectact']);
				if (!$result) {
					$jsondata['resultado'] = "ERROR";
				}			
			}
						
		}
		
		if($jsondata['resultado']==""){
				
				mysql_query("UPDATE tbl_activos set prestamo = 1 where ID_ACTIVOS =" . $v_datos[0],$_SESSION['conectact']);
				
				
				$select="SELECT ACT.ACTIVO,PER.NOMBRE,PER.EMAIL FROM tbl_pedido AS PED
				 INNER JOIN tbl_activos AS ACT 		ON ACT.ID_ACTIVOS =  PED.ID_ACTIVO
				 INNER JOIN tbl_persona AS PER		ON PER.ID_PERSONA =  PED.ID_PERSONAL
				 WHERE ACT.ID_ACTIVOS = " . $v_datos[1] . " AND PER.ID_PERSONA = " . $v_datos[2];
				
				$result=mysql_query($select ,$_SESSION['conectact']);
				while($row = mysql_fetch_array($result))
				{
				
					if($row[2]!=""){
						$subject = "Solicitud de activo:";
						$message = $v_datos[0];
						mail($row[2],"Nuevo Pendiente.",$subject, $message);	
					}
				
					mysql_query("insert into tbl_historico_activos(detalle,fecha,opcion,usuario)values('Se actualizo peticion del activo:" . $row[0] . "  a la persona:" . $row[1] . "',NOW(),'PERSONAL','" . $v_datos[6] . "')",$_SESSION['conectact']);
		
				}		
				
				
		
				$jsondata['resultado']="Success";
		}
		
		echo json_encode($jsondata);
	
	}
		
	function eliminar_pedido($parametros){
		
		$v_datos=explode("|",$parametros);	
		
		$result=mysql_query("delete from tbl_pedido where id_pedido = " . $v_datos[0] ,$_SESSION['conectact']);
		if(!$result){
			$jsondata['resultado'] = "ERROR"; //mysql_error() ;
		}
	
		if($jsondata['resultado']==""){
		
			
		
			$jsondata['resultado']="Success";
			
		}
		
		echo json_encode($jsondata);
	}
	
	
	
	
	function busqueda_pedido($parametros){
		
		
		$v_datos=explode("|",$parametros);
		$where = $v_dato[0];
			
		$select =  "SELECT PED.ID_PEDIDO, ACT.ACTIVO,PER.NOMBRE,DATE_FORMAT(PED.FECHA_PEDIDO,'%d/%m/%Y') AS FECHA_PEDIDO,PED.ACTIVO FROM tbl_pedido AS PED
					INNER JOIN tbl_activos AS ACT 		ON ACT.ID_ACTIVOS =  PED.ID_ACTIVO
					INNER JOIN tbl_persona AS PER		ON PER.ID_PERSONA =  PED.ID_PERSONAL";
					
		if($v_datos[0] != ""){
			$where = " where PER.NOMBRE like '%" . $v_datos[0] . "%'";
		}
		
		if($v_datos[1] != ""){
			if($where==""){
				$where = " where ACT.ACTIVO like '%" . $v_datos[1] . "%'";
			}else{
				$where .= " AND ACT.ACTIVO like '%" . $v_datos[1] . "%'";
			}
		}
		
		if($v_datos[2] != ""){
		
			$fecha=explode(" ",$v_datos[2]);
		
			if($where==""){
				$where = " where PED.FECHA_PEDIDO >= '" . $fecha[0] . " 00:00' AND PED.FECHA_PEDIDO <= '" . $fecha[0] . " 23:59'";
			}else{
				$where .= " AND PED.FECHA_PEDIDO >= '" . $fecha[0] . " 00:00' AND PED.FECHA_PEDIDO <= '" . $fecha[0] . " 23:59'";
			}
		}
		
		if($v_datos[3] != ""){
			if($where==""){
				$where = " where PED.ACTIVO = " . $v_datos[3] ;
			}else{
				$where .= " AND PED.ACTIVO = " . $v_datos[3] ;
			}
		}
		
		$select = $select . $where . " order by PED.ACTIVO";
		
		$result=mysql_query($select ,$_SESSION['conectact']);
		if (!$result) {
			$mensaje = mysql_error();//"ERROR"; 
		}else{
			if(mysql_num_rows($result)>0){
				
				$table .= '
				<div class="Tabla_Lista" >
                <table>
                    <tr>
                        <td style="width:10%">
                           Editar
                        </td>
                        <td style="width:16%" >
                            Activo
                        </td>
                        <td style="width:16%">
                          Responsable
                        </td>
						<td style="width:16%">
                           Fecha de Petici&oacute;n
                        </td>
						<td style="width:16%">
                           Estado de Petici&oacute;n
                        </td>
						<td style="width:10%">
                           Eliminar
                        </td>
                    </tr>';
					
				while($row = mysql_fetch_array($result))
				{
					if($row[4] ==0){
						$tipo='  <img src="../img/alert.png" alt="delete" height="19" width="19"> </br> Pendiente';
					}elseif($row[4] ==1){
						$tipo='<img src="../img/alert_verde.png" alt="delete" height="19" width="19"> </br> Aprobado';
					}elseif($row[4] ==2){
						$tipo='<img src="../img/eliminar_negro.png" alt="delete" height="19" width="19"> </br> Rechazada';
					}
				
					$table .= '
					 <tr>
						<td style="display:none">
							<input type="hidden" name="ID_' . $row[0] . '" id="ID_' . $row[0] . '" value="' . $row[0] . '">
						</td>
						<td style="width:10%" align="center">
							<div>
								<a class="lnk_grid" href="../activos/nuevo_pedido.php?USSP=E_' . $row[0] . '"><img src="../img/pencil.png" alt="delete" height="19" width="19"></a>
							</div>
						</td>
                        <td align="center">' .
                           utf8_encode($row[1]) .
                        '</td>
                        <td align="center">' .
                           utf8_encode($row[2]) .
                        '</td>
                        <td align="center">' .
						    utf8_encode($row[3]) .
                        '</td>
						 <td align="center">' .
						    $tipo . 
                        '</td>
						<td style="width:10%" style align="center">
							<a id="myLink" href="../activos/nuevo_pedido.php?USSP=D_' . $row[0] . '">
									<img src="../img/delete.png" alt="delete" height="19" width="19">
							</a>
                        </td>
                    </tr>';
				}
				
				$table .= '
				</table>
				</div';
				
								
				$mensaje= (string)$table;
				
			}else{
				$mensaje= (string)"NADA"; 
			}
		}
		
		
		echo (string)$mensaje;
	}
	
	
	
	
}//end class



?>