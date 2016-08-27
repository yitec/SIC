<?
session_start();
require_once('cnx/session_activa.php');
require_once('cnx/conexion_compras.php');
conectarc();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel ="stylesheet" href="css/pedidos.css" type="text/css" />
    <link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <link href="css/jquery.pnotify.default.css" rel="stylesheet" type="text/css" />
    <link href="css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css' />
    <title>SIC-CINA</title>
</head>
    <body>
        <table>
        <tbody>
        <?
        $result=mysql_query("select id_pedido,consecutivo, solicitante, seccion, fecha_creacion  from tbl_pedidos where id_pedido='".$_REQUEST["id"]."'");
        $row=mysql_fetch_object($result);
        echo '<thead class="texto_titulo"><td>Detalle pedido</td></thead>
            <tr class="listado"><td >Consecutivo: </td><td>'.$row->consecutivo.'</td></tr>
            <tr class="listado"><td >Solicitante: </td><td>'.utf8_decode($row->solicitante).'</td></tr>
            <tr class="listado"><td >Sección: </td><td>'.utf8_decode($row->seccion).'</td></tr>
            <tr class="listado"><td >Fecha: </td><td>'.$row->fecha_creacion.'</td></tr>
            </tbody></table>';
        echo '<div>-----------------------------------------------------------------------------</div>';
        

        //**************************************Reactivos******************************************/
        
        $result=mysql_query("select * from tbl_reactivos where id_pedido='".$_REQUEST["id"]."'");
        $cont=0;
        if (mysql_num_rows($result)>0){
            while ($row=mysql_fetch_object($result)){
                if ($cont==0){
                    echo '<table><tbody><tr><td class="texto_titulo">Reactivos</td></tr>';
                }else{
                    echo '<table><tbody>';
                }
                echo '<tr class="texto_subtitulo"><td>Cantidad</td><td>Nombre</td><td>Pureza</td><td>Grado</td><td>Presentación</td></tr>';
                echo '<tr class="listado"><td class="td_items" align="center">'.$row->cantidad.'</td><td class="td_items">'.$row->nombre.'</td><td class="td_items">'.$row->pureza.'</td><td class="td_items">'.$row->grado.'</td><td class="td_items">'.$row->pureza.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Almacenamiento</td><td>Similar a marca</td><td>Similar # catálogo</td><td>Plazo entrega</td><td>Proveedores</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->almacenamiento.'</td><td class="td_items">'.$row->similar_marca.'</td><td class="td_items">'.$row->similar_catalogo.'</td><td class="td_items">'.$row->plazo_entrega.'</td><td class="td_items">'.$row->proveedores.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Cotización</td><td>Monto</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->cotizacion.'</td><td class="td_items">'.$row->monto.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Otros</td></tr></tbody></table>';
                echo '<table><tr class="listado"><td class="td_items">'.$row->otros.'</td></tr></table>';
                echo '<table><tr><td><span><span><a class="aprobara" href="#" id="btn_aprobara" tabla="tbl_reactivos" id_articulo="'.$row->id_articulo.'">Aprobar</a></span><span> | 
                        <a class="rechazara" href="#" id="btn_rechazara" tabla="tbl_reactivos" id_articulo="'.$row->id_articulo.'">Rechazar</a></span></td></tr></table>';
                $cont++;
            }
            echo '<div>-----------------------------------------------------------------------------</div>';
        }
        


        //**************************************Gases******************************************/

        $result=mysql_query("select * from tbl_gases where id_pedido='".$_REQUEST["id"]."'");
        $cont=0;
        if (mysql_num_rows($result)>0){
            while ($row=mysql_fetch_object($result)){
                if ($cont==0){
                    echo '<table><tbody><tr><td class="texto_titulo">Gases</td></tr>';
                }else{
                    echo '<table><tbody>';
                }
                echo '<tr class="texto_subtitulo"><td>Cantidad</td><td>Nombre</td><td>Pureza</td><td>Grado</td><td>Presentación</td></tr>';
                echo '<tr class="listado"><td class="td_items" align="center">'.$row->cantidad.'</td><td class="td_items">'.$row->nombre.'</td><td class="td_items">'.$row->pureza.'</td><td class="td_items">'.$row->grado.'</td><td class="td_items">'.$row->pureza.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Plazo</td><td>Proveedores</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->plazo.'</td><td class="td_items">'.$row->proveedores.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Cotización</td><td>Monto</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->cotizacion.'</td><td class="td_items">'.$row->monto.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Otros</td></tr></tbody></table>';
                echo '<table><tr class="listado"><td class="td_items">'.$row->otros.'</td></tr></table>';
                echo '<table><tr><td><span><span><a class="aprobara" href="#" id="btn_aprobara" tabla="tbl_gases" id_articulo="'.$row->id_articulo.'">Aprobar</a></span><span> | 
                        <a class="rechazara" href="#" id="btn_rechazara" tabla="tbl_gases" id_articulo="'.$row->id_articulo.'">Rechazar</a></span></tr></td></table>';
                $cont++;
            }
            echo '<div>-----------------------------------------------------------------------------</div>';
        }
        //**************************************Cristaleria******************************************/

        $result=mysql_query("select * from tbl_cristaleria where id_pedido='".$_REQUEST["id"]."'");
        $cont=0;
        if (mysql_num_rows($result)>0){
            while ($row=mysql_fetch_object($result)){
                if ($cont==0){
                    echo '<table><tbody><tr><td class="texto_titulo">Cristalería</td></tr>';
                }else{
                    echo '<table><tbody>';
                }
                echo '<tr class="texto_subtitulo"><td>Cantidad</td><td>Nombre</td><td>Clase</td><td>Capacidad</td><td>Presentación</td></tr>';
                echo '<tr class="listado"><td class="td_items" align="center">'.$row->cantidad.'</td><td class="td_items">'.$row->nombre.'</td><td class="td_items">'.$row->clase.'</td><td class="td_items">'.$row->capacidad.'</td><td class="td_items">'.$row->presentacion.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Similar a marca</td><td>Similar a # catálogo</td><td>Plazo de entrega</td><td>Proveedores</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->similar_marca.'</td><td class="td_items">'.$row->similar_catalogo.'</td><td class="td_items">'.$row->plazo_entrega.'</td><td class="td_items">'.$row->proveedores.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Cotización</td><td>Monto</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->cotizacion.'</td><td class="td_items">'.$row->monto.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Otros</td></tr></tbody></table>';
                echo '<table><tr class="listado"><td class="td_items">'.$row->otros.'</td></tr></table>';
                echo '<table><tr><td><span><span><a class="aprobara" href="#" id="btn_aprobara" tabla="tbl_cristaleria" id_articulo="'.$row->id_articulo.'">Aprobar</a></span><span> | 
                        <a class="rechazara" href="#" id="btn_rechazara" tabla="tbl_cristaleria" id_articulo="'.$row->id_articulo.'">Rechazar</a></span></tr></td></table>';
                $cont++;
            }
            echo '<div>-----------------------------------------------------------------------------</div>';
        }        
        //**************************************Repuestos******************************************/
        $result=mysql_query("select * from tbl_repuestos where id_pedido='".$_REQUEST["id"]."'");
        $cont=0;
        if (mysql_num_rows($result)>0){
            while ($row=mysql_fetch_object($result)){
                if ($cont==0){
                    echo '<table><tbody><tr><td class="texto_titulo">Repuestos</td></tr>';
                }else{
                    echo '<table><tbody>';
                }
                echo '<tr class="texto_subtitulo"><td>Cantidad</td><td>Nombre repuesto</td><td>Marca equipo</td><td>Modelo equipo</td><td>Número de catálogo</td></tr>';
                echo '<tr class="listado"><td class="td_items" align="center">'.$row->cantidad.'</td><td class="td_items">'.$row->nombre_repuesto.'</td><td class="td_items">'.$row->marca_equipo.'</td><td class="td_items">'.$row->modelo_equipo.'</td><td class="td_items">'.$row->numero_catalogo.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Representante</td><td>Garantía</td><td>Proveedores</td><td>Marca repuesto</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->representante.'</td><td class="td_items">'.$row->garantia.'</td><td class="td_items">'.$row->proveedores.'</td><td class="td_items">'.$row->marca.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Cotización</td><td>Monto</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->cotizacion.'</td><td class="td_items">'.$row->monto.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Otros</td></tr></tbody></table>';
                echo '<table><tr class="listado"><td class="td_items">'.$row->otros.'</td></tr></table>';
                echo '<table><tr><td><span><span><a class="aprobara" href="#" id="btn_aprobara" tabla="tbl_repuestos" id_articulo="'.$row->id_articulo.'">Aprobar</a></span><span> | 
                        <a class="rechazara" href="#" id="btn_rechazara" tabla="tbl_repuestos" id_articulo="'.$row->id_articulo.'">Rechazar</a></span></tr></td></table>';
                $cont++;
            }
            echo '<div>-----------------------------------------------------------------------------</div>';
        }
        //**************************************Equipos******************************************/
        $result=mysql_query("select * from tbl_equipos where id_pedido='".$_REQUEST["id"]."'");
        $cont=0;
        if (mysql_num_rows($result)>0){
            while ($row=mysql_fetch_object($result)){
                if ($cont==0){
                    echo '<table><tbody><tr><td class="texto_titulo">Equipos</td></tr>';
                }else{
                    echo '<table><tbody>';
                }
                echo '<tr class="texto_subtitulo"><td>Nombre</td><td>Representante</td><td>Similar a marca</td><td>Similar a modelo</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->representante.'</td><td class="td_items">'.$row->similar_marca.'</td><td class="td_items">'.$row->similar_modelo.'</td><td class="td_items">'.$row->similar_catalogo.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Plazo</td><td>Garantia fabricante</td><td>Garantia mantenimiento</td><td>Capacitación</td><td>Instalación</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->plazo.'</td><td class="td_items">'.$row->garantia_fab.'</td><td class="td_items">'.$row->garantia_man.'</td><td class="td_items">'.$row->capacitacion.'</td><td class="td_items">'.$row->instalacion.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Lugar de entrega</td><td>Proveedores</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->lugar.'</td><td class="td_items">'.$row->proveedores.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Cotización</td><td>Monto</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->cotizacion.'</td><td class="td_items">'.$row->monto.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Otros</td></tr></tbody></table>';
                echo '<table><tr class="listado"><td class="td_items">'.$row->otros.'</td></tr></table>';
                echo '<table><tr><td><span><span><a class="aprobara" href="#" id="btn_aprobara" tabla="tbl_equipos" id_articulo="'.$row->id_articulo.'">Aprobar</a></span><span> | 
                        <a class="rechazara" href="#" id="btn_rechazara" tabla="tbl_equipos" id_articulo="'.$row->id_articulo.'">Rechazar</a></span></tr></td></table>';
                $cont++;
            }
            echo '<div>-----------------------------------------------------------------------------</div>';
        }
        //**************************************Materiales******************************************/
        $result=mysql_query("select * from tbl_materiales where id_pedido='".$_REQUEST["id"]."'");
        $cont=0;
        if (mysql_num_rows($result)>0){
            while ($row=mysql_fetch_object($result)){
                if ($cont==0){
                    echo '<table><tbody><tr><td class="texto_titulo">Materiales de laboratorio</td></tr>';
                }else{
                    echo '<table><tbody>';
                }
                echo '<tr class="texto_subtitulo"><td>Cantidad</td><td>Nombre</td><td>Similar a meteria</td><td>Similar a # catálogo</td></tr>';
                echo '<tr class="listado"><td class="td_items" aligh="center">'.$row->cantidad.'</td><td class="td_items">'.$row->nombre.'</td><td class="td_items">'.$row->similar_materia.'</td><td class="td_items">'.$row->similar_catalogo.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Plazo</td><td>Proveedores</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->plazo.'</td><td class="td_items">'.$row->proveedores.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Cotización</td><td>Monto</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->cotizacion.'</td><td class="td_items">'.$row->monto.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Otros</td></tr></tbody></table>';
                echo '<table><tr class="listado"><td class="td_items">'.$row->otros.'</td></tr></table>';
                echo '<table><tr><td><span><span><a class="aprobara" href="#" id="btn_aprobara" tabla="tbl_materiales" id_articulo="'.$row->id_articulo.'">Aprobar</a></span><span> | 
                        <a class="rechazara" href="#" id="btn_rechazara" tabla="tbl_materiales" id_articulo="'.$row->id_articulo.'">Rechazar</a></span></tr></td></table>';
                $cont++;
            }
            echo '<div>-----------------------------------------------------------------------------</div>';
        }
        //**************************************Calibraciones******************************************/
        $result=mysql_query("select * from tbl_calibraciones where id_pedido='".$_REQUEST["id"]."'");
        $cont=0;
        if (mysql_num_rows($result)>0){
            while ($row=mysql_fetch_object($result)){
                if ($cont==0){
                    echo '<table><tbody><tr><td class="texto_titulo">Calibraciones</td></tr>';
                }else{
                    echo '<table><tbody>';
                }
                echo '<tr class="texto_subtitulo"><td>Nombre</td><td>Código</td><td>Placa</td><td>Ubicación</td></tr>';
                echo '<tr class="listado"><td class="td_items" >'.$row->nombre.'</td><td class="td_items">'.$row->codigo.'</td><td class="td_items">'.$row->placa.'</td><td class="td_items">'.$row->ubicacion.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Lugar de la calibración</td><td>Proveedores</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->lugar.'</td><td class="td_items">'.$row->proveedores.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Cotización</td><td>Monto</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->cotizacion.'</td><td class="td_items">'.$row->monto.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Otros</td></tr></tbody></table>';
                echo '<table><tr class="listado"><td class="td_items">'.$row->otros.'</td></tr></table>';
                echo '<table><tr><td><span><span><a class="aprobara" href="#" id="btn_aprobara" tabla="tbl_calibraciones" id_articulo="'.$row->id_articulo.'">Aprobar</a></span><span> | 
                        <a class="rechazara" href="#" id="btn_rechazara" tabla="tbl_calibraciones" id_articulo="'.$row->id_articulo.'">Rechazar</a></span></tr></td></table>';
                $cont++;
            }
            echo '<div>-----------------------------------------------------------------------------</div>';
        }
        //**************************************Reparaciones******************************************/
        $result=mysql_query("select * from tbl_reparaciones where id_pedido='".$_REQUEST["id"]."'");
        $cont=0;
        if (mysql_num_rows($result)>0){
            while ($row=mysql_fetch_object($result)){
                if ($cont==0){
                    echo '<table><tbody><tr><td class="texto_titulo">Reparaciones</td></tr>';
                }else{
                    echo '<table><tbody>';
                }
                echo '<tr class="texto_subtitulo"><td>Nombre equipo</td><td>Código</td><td>Placa</td><td>Ubicación</td><td>Proveedores</td></tr>';
                echo '<tr class="listado"><td class="td_items" >'.$row->nombre_equipo.'</td><td class="td_items">'.$row->codigo.'</td><td class="td_items">'.$row->placa.'</td><td class="td_items">'.$row->ubicacion.'</td><td class="td_items">'.$row->proveedores.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Cotización</td><td>Monto</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->cotizacion.'</td><td class="td_items">'.$row->monto.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Otros</td></tr></tbody></table>';
                echo '<table><tr class="listado"><td class="td_items">'.$row->otros.'</td></tr></table>';
                echo '<table><tr><td><span><span><a class="aprobara" href="#" id="btn_aprobara" tabla="tbl_reparaciones" id_articulo="'.$row->id_articulo.'">Aprobar</a></span><span> | 
                        <a class="rechazara" href="#" id="btn_rechazara" tabla="tbl_reparaciones" id_articulo="'.$row->id_articulo.'">Rechazar</a></span></tr></td></table>';
                $cont++;
            }
            echo '<div>-----------------------------------------------------------------------------</div>';
        }

        //**************************************Interlaboratoriales******************************************/
        $result=mysql_query("select * from tbl_interlaboratoriales where id_pedido='".$_REQUEST["id"]."'");
        $cont=0;
        if (mysql_num_rows($result)>0){
            while ($row=mysql_fetch_object($result)){
                if ($cont==0){
                    echo '<table><tbody><tr><td class="texto_titulo">Interlaboratoriales</td></tr>';
                }else{
                    echo '<table><tbody>';
                }
                echo '<tr class="texto_subtitulo"><td>Análisis</td><td>Ronda</td><td>Proveedores</td></tr>';
                echo '<tr class="listado"><td class="td_items" >'.$row->analisis.'</td><td class="td_items">'.$row->ronda.'</td><td class="td_items">'.$row->proveedores.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Cotización</td><td>Monto</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->cotizacion.'</td><td class="td_items">'.$row->monto.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Otros</td></tr></tbody></table>';
                echo '<table><tr class="listado"><td class="td_items">'.$row->otros.'</td></tr></table>';
                echo '<table><tr><td><span><span><a class="aprobara" href="#" id="btn_aprobara" tabla="tbl_interlaboratoriales" id_articulo="'.$row->id_articulo.'">Aprobar</a></span><span> | 
                        <a class="rechazara" href="#" id="btn_rechazara" tabla="tbl_interlaboratoriales" id_articulo="'.$row->id_articulo.'">Rechazar</a></span></tr></td></table>';
                $cont++;
            }
            echo '<div>-----------------------------------------------------------------------------</div>';
        }

        //**************************************Medios******************************************/
        $result=mysql_query("select * from tbl_medios where id_pedido='".$_REQUEST["id"]."'");
        $cont=0;
        if (mysql_num_rows($result)>0){
            while ($row=mysql_fetch_object($result)){
                if ($cont==0){
                    echo '<table><tbody><tr><td class="texto_titulo">Medios</td></tr>';
                }else{
                    echo '<table><tbody>';
                }
                echo '<tr class="texto_subtitulo"><td>Nombre</td><td>Tipo</td><td>Similar a marca</td><td>Similar a # catalogo</td><td>Plazo de entrega</td></tr>';
                echo '<tr class="listado"><td class="td_items" >'.$row->nombre.'</td><td class="td_items">'.$row->tipo.'</td><td class="td_items">'.$row->similar_marca.'</td><td class="td_items">'.$row->similar_catalogo.'</td><td class="td_items" >'.$row->plazo.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Presentación</td><td>Proveedores</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->presentacion.'</td><td class="td_items">'.$row->proveedores.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Cotización</td><td>Monto</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->cotizacion.'</td><td class="td_items">'.$row->monto.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Otros</td></tr></tbody></table>';
                echo '<table><tr class="listado"><td class="td_items">'.$row->otros.'</td></tr></table>';
                echo '<table><tr><td><span><span><a class="aprobara" href="#" id="btn_aprobara" tabla="tbl_medios" id_articulo="'.$row->id_articulo.'">Aprobar</a></span><span> | 
                        <a class="rechazara" href="#" id="btn_rechazara" tabla="tbl_medios" id_articulo="'.$row->id_articulo.'">Rechazar</a></span></tr></td></table>';
                $cont++;
            }
            echo '<div>-----------------------------------------------------------------------------</div>';
        }

        //**************************************Software******************************************/
        $result=mysql_query("select * from tbl_software where id_pedido='".$_REQUEST["id"]."'");
        $cont=0;
        if (mysql_num_rows($result)>0){
            while ($row=mysql_fetch_object($result)){
                if ($cont==0){
                    echo '<table><tbody><tr><td class="texto_titulo">Software</td></tr>';
                }else{
                    echo '<table><tbody>';
                }
                echo '<tr class="texto_subtitulo"><td>Cantidad licencias</td><td>Nombre</td><td>Desarrollador</td><td>Versión</td><td>Proveedores</td></tr>';
                echo '<tr class="listado"><td class="td_items" align="center">'.$row->cantidad.'</td><td class="td_items">'.$row->nombre.'</td><td class="td_items">'.$row->desarrollador.'</td><td class="td_items">'.$row->version.'</td><td class="td_items">'.$row->proveedores.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Cotización</td><td>Monto</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->cotizacion.'</td><td class="td_items">'.$row->monto.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Otros</td></tr></tbody></table>';
                echo '<table><tr class="listado"><td class="td_items">'.$row->otros.'</td></tr></table>';
                echo '<table><tr><td><span><span><a class="aprobara" href="#" id="btn_aprobara" tabla="tbl_software" id_articulo="'.$row->id_articulo.'">Aprobar</a></span><span> | 
                        <a class="rechazara" href="#" id="btn_rechazara" tabla="tbl_software" id_articulo="'.$row->id_articulo.'">Rechazar</a></span></tr></td></table>';
                $cont++;
            }
            echo '<div>-----------------------------------------------------------------------------</div>';
        }        
        //**************************************Capacitaciones******************************************/
        $result=mysql_query("select * from tbl_capacitaciones where id_pedido='".$_REQUEST["id"]."'");
        $cont=0;
        if (mysql_num_rows($result)>0){
            while ($row=mysql_fetch_object($result)){
                if ($cont==0){
                    echo '<table><tbody><tr><td class="texto_titulo">Capacitaciones</td></tr>';
                }else{
                    echo '<table><tbody>';
                }
                echo '<tr class="texto_subtitulo"><td>Proveedor</td><td>Tema</td><td>Fecha</td><td>Proveedores</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->proveedor.'</td><td class="td_items">'.$row->fecha.'</td><td class="td_items">'.$row->proveedores.'</td><td class="td_items">'.$row->proveedores.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Cotización</td><td>Costo</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->cotizacion.'</td><td class="td_items">'.$row->costo.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Otros</td></tr></tbody></table>';
                echo '<table><tr class="listado"><td class="td_items">'.$row->otros.'</td></tr></table>';
                echo '<table><tr><td><span><span><a class="aprobara" href="#" id="btn_aprobara" tabla="tbl_capacitaciones" id_articulo="'.$row->id_articulo.'">Aprobar</a></span><span> | 
                        <a class="rechazara" href="#" id="btn_rechazara" tabla="tbl_capacitaciones" id_articulo="'.$row->id_articulo.'">Rechazar</a></span></tr></td></table>';
                $cont++;
            }
            echo '<div>-----------------------------------------------------------------------------</div>';
        }        

        //**************************************Inscripciones******************************************/
        $result=mysql_query("select * from tbl_inscripciones where id_pedido='".$_REQUEST["id"]."'");
        $cont=0;
        if (mysql_num_rows($result)>0){
            while ($row=mysql_fetch_object($result)){
                if ($cont==0){
                    echo '<table><tbody><tr><td class="texto_titulo">Inscripciones</td></tr>';
                }else{
                    echo '<table><tbody>';
                }
                echo '<tr class="texto_subtitulo"><td>Tema</td><td>Fecha</td><td>Organizadores</td></tr>';
                echo '<tr class="listado"><td class="td_items" >'.$row->tema.'</td><td class="td_items">'.$row->fecha.'</td><td class="td_items">'.$row->organizadores.'</td><td class="td_items">'.$row->version.'</td><td class="td_items">'.$row->proveedores.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Costo</td></tr>';
                echo '<tr class="listado"><td class="td_items">'.$row->costo.'</td></tr>';
                echo '<tr class="texto_subtitulo"><td>Otros</td></tr></tbody></table>';
                echo '<table><tr class="listado"><td class="td_items">'.$row->otros.'</td></tr></table>';
                echo '<table><tr><td><span><span><a class="aprobara" href="#" id="btn_aprobara" tabla="tbl_inscripciones" id_articulo="'.$row->id_articulo.'">Aprobar</a></span><span> | 
                        <a class="rechazara" href="#" id="btn_rechazara" tabla="tbl_inscripciones" id_articulo="'.$row->id_articulo.'">Rechazar</a></span></tr></td></table>';
                $cont++;
            }
            echo '<div>-----------------------------------------------------------------------------</div>';
        }
        //**************************************Materiales refrenecia******************************************/
        $result=mysql_query("select * from tbl_referencias where id_pedido='".$_REQUEST["id"]."'");
        $cont=0;
        if (mysql_num_rows($result)>0){
            while ($row=mysql_fetch_object($result)){
                if ($cont==0){
                    echo '<table><tbody><tr><td class="texto_titulo">Materiales de referencia</td></tr>';
                }else{
                    echo '<table><tbody>';
                }
                echo '<tr class="texto_subtitulo"><td>Tipo</td><td>Presentacion</td><td>Cotización</td><td>Proveedores</td></tr>';
                echo '<tr class="listado"><td class="td_items" >'.$row->tipo.'</td><td class="td_items">'.$row->presentacion.'</td><td class="td_items">'.$row->cotizacion.'</td><td class="td_items">'.$row->proveedores.'</td></tr></table>';
                echo '<table><tr><td><span><span><a class="aprobara" href="#" id="btn_aprobara" tabla="tbl_referencias" id_articulo="'.$row->id_articulo.'">Aprobar</a></span><span> | 
                        <a class="rechazara" href="#" id="btn_rechazara" tabla="tbl_referencias" id_articulo="'.$row->id_articulo.'">Rechazar</a></span></tr></td></table>';
                $cont++;
            }
            echo '<div>-----------------------------------------------------------------------------</div>';
        }
        
        ?>
        
        
    </body>
<script src="includes/jquery-1.8.3.js" type="text/javascript"></script>
<script src="includes/ui/jquery-ui.js"></script>
<script src="includes/jquery.pnotify.js" type="text/javascript"></script> 
<script src="includes/Scripts_Pedidos.js" type="text/javascript"></script> 
<script type="text/javascript" src="includes/jquery.fancybox-1.3.4.pack.js"></script>
</html>