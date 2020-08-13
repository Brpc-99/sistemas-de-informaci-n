<?php

include "..\include/conexion.php";
session_start();

$sql_ventas = pg_query($conexion, "SELECT COUNT(*) AS total_ventas FROM VENTAS"); /*Total de todos los ventass*/
$result_ventas = pg_fetch_array($sql_ventas);
$total_ventas = $result_ventas['total_ventas'];
$por_pagina = 5;


if (empty($_GET['pagina'])) {

    $pagina = 1;
    
} else {
	$pagina = $_GET['pagina'];
}
$numerador = $pagina;

$desde = ($pagina - 1) * $por_pagina;
$total_paginas = ceil($total_ventas / $por_pagina);


if (isset($_GET['vendedor'])) {
    $nom_v = $_GET['vendedor'];
}else if(isset($_GET['fecha_desde']) && isset($_GET['fecha_hasta']) && !isset($_GET['vendedor'])){ 
	$date1 = $_GET['fecha_desde'];
	$date2 = $_GET['fecha_hasta'];
}else if(isset($_GET['fecha_desde']) && isset($_GET['fecha_hasta']) && isset($_GET['vendedor'])){
    $nom_v = $_GET['vendedor'];
    $date1 = $_GET['fecha_desde'];
	$date2 = $_GET['fecha_hasta'];
}
/*CONSULTAS*/
if (isset($_GET['vendedor']) && !empty($_GET['vendedor']) && !empty($_GET['fecha_desde']) && !empty($_GET['fecha_hasta']) && $date1 <= $date2) {
	$consulta = "SELECT V.Codigo_venta,U.Nombre, V.Fecha, V.Valor_total, P.nombre_Producto, C.Cantidad
FROM VENTAS V, USUARIOS U, CONTIENE C, PRODUCTOS P
WHERE V.Codigo_usuario = U.Codigo_usuario
AND V.Codigo_venta = C.Codigo_venta
AND C.Codigo_producto = P.Codigo_producto
AND U.nombre = '$nom_v'
AND V.Fecha BETWEEN '$date1' AND '$date2'
limit $por_pagina offset $desde; ";
} else if (isset($_GET['vendedor']) && !empty($_GET['vendedor']) && empty($_GET['fecha_desde']) && empty($_GET['fecha_hasta'])) {
	$consulta = "SELECT V.Codigo_venta,U.Nombre, V.Fecha, V.Valor_total, P.nombre_Producto, C.Cantidad
	FROM VENTAS V, USUARIOS U, CONTIENE C, PRODUCTOS P
	WHERE V.Codigo_usuario = U.Codigo_usuario
	AND V.Codigo_venta = C.Codigo_venta
	AND C.Codigo_producto = P.Codigo_producto
	AND U.nombre = '$nom_v'
	limit $por_pagina offset $desde; ";
} else if (isset($_GET['vendedor']) && empty($_GET['vendedor']) && !empty($_GET['fecha_desde']) && !empty($_GET['fecha_hasta'])) {
	$consulta = "SELECT V.Codigo_venta,U.Nombre, V.Fecha, V.Valor_total, P.nombre_Producto, C.Cantidad
	FROM VENTAS V, USUARIOS U, CONTIENE C, PRODUCTOS P
	WHERE V.Codigo_usuario = U.Codigo_usuario
	AND V.Codigo_venta = C.Codigo_venta
	AND C.Codigo_producto = P.Codigo_producto
	AND V.Fecha BETWEEN '$date1' AND '$date2'
	limit $por_pagina offset $desde; ";
} else {
	$consulta = "SELECT V.Codigo_venta,U.Nombre, V.Fecha, V.Valor_total, P.nombre_Producto, C.Cantidad
	FROM VENTAS V, USUARIOS U, CONTIENE C, PRODUCTOS P
	WHERE V.Codigo_usuario = U.Codigo_usuario
	AND V.Codigo_venta = C.Codigo_venta
	AND C.Codigo_producto = P.Codigo_producto	
	limit $por_pagina offset $desde; ";
}
if (!$resul = pg_query($conexion, $consulta)) {
	die;
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Lista de Ventas</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="..\imagenes\icono.ico">
    <link rel="stylesheet" type="text/css" href="..\include\estilo_header.css">
    <link rel="stylesheet" type="text/css" href="..\Sistema\estilo\estilo_usuario.css">
    <link rel="stylesheet" type="text/css" href="..\iniciar sesion\estilo\font.css">
    <link rel="stylesheet" type="text/css" href="..\Sistema\estilo\estilo_footer_ventas.css">
</head>

<body>
    <?php include "..\include\header.php"; ?>
  
    <div class="filtro">
        <h2>Lista de Ventas</h2>

        <form action="Lista de ventas.php" method="get" class="form_search">
            <input type="text" name="vendedor" id="busqueda" placeholder="Vendedor">
            <label>Desde</label>
            <input type="date" name="fecha_desde">
            <label>Hasta</label>
            <input type="date" name="fecha_hasta">
            <input type="submit" name="" value="Filtrar" class="btn">
        </form>
    </div>
    <table>
        <tr class="encabezado">
            <td>Código</td>
            <td>Usuario</td>
            <td>Fecha</td>
            <td>Nombre Producto</td>
            <td>Cantidad</td>
            <td>Valor Total</td>

        </tr>

        <?php
		if (!isset($_GET['vendedor']) || empty($_GET['vendedor'])) {
			$totalperiodo = 0;

			while ($mostrar = pg_fetch_array($resul)) {
				$totalperiodo = $totalperiodo + $mostrar['valor_total'];
				$prod = $mostrar['nombre'];
				$cod = $mostrar['codigo_venta'];
		?>
        <tr class="muestras">
            <td><?php echo $mostrar['codigo_venta'] ?></td>
            <td><?php echo $mostrar['nombre'] ?></td>
            <td><?php echo $mostrar['fecha'] ?></td>
            <td><?php echo $mostrar['nombre_producto'] ?></td>
            <td><?php echo $mostrar['cantidad'] ?></td>
            <td><?php echo "$" . $mostrar['valor_total'] ?></td>
        </tr>

        <?php
			}
			?>

    </table>
    <div style="padding-top: 30px;">
        <table style="width: 200px;">
            <tr class="encabezado">
                <td style="width:50px">Total período</td>
                <td bgcolor="white"><?php echo "$" . $totalperiodo ?></td>
            </tr>
        </table>
    </div>
    <?php } else {
			$totalperiodo = 0;
			while ($mostrar = pg_fetch_array($resul)) {

				$totalperiodo = $totalperiodo + $mostrar['valor_total'];
				$prod = $mostrar['nombre'];
				$cod = $mostrar['codigo_venta'];
	?>
    <tr class="muestras">
        <td><?php echo $mostrar['codigo_venta'] ?></td>
        <td><?php echo $mostrar['nombre'] ?></td>
        <td><?php echo $mostrar['fecha'] ?></td>
        <td><?php echo $mostrar['nombre_producto'] ?></td>
        <td><?php echo $mostrar['cantidad'] ?></td>
        <td><?php echo "$" . $mostrar['valor_total'] ?></td>
    </tr>
    <?php } ?>
    </table>

    <div style="padding-top: 30px;">
        <table style="width: 200px;">
            <tr class="encabezado">
                <td style="width:50px">Total período</td>
                <td bgcolor="white"><?php echo "$" . $totalperiodo ?></td>
            </tr>
        </table>
        <?php } ?>
        <div class="paginador">
            <ul>
                <li><a href="?pagina=1">|<< </a></li>
                <li><?php if($numerador==1){
                    echo '<li ><a  href="?pagina=' . ($numerador) . '">';
                }else{
                    echo '<li ><a  href="?pagina=' . ($numerador-1) . '">';
                }
                    ?><< </a></li> 
				<?php
					for ($i = 1; $i <= $total_paginas; $i++) {
						if ($i == $pagina) {
							echo '<li class="pageSelected">' . $i . '</li>';
						} else {
							echo '<li ><a  href="?pagina=' . $i . '">' . $i . '</a></li>';
						}
					}
				?>
				<li><?php if($numerador==$total_paginas){
                    echo '<li ><a  href="?pagina=' . ($numerador) . '">';
                }else{
                    echo '<li ><a  href="?pagina=' . ($numerador+1) . '">';
                }
                    ?> >></a></li>
                <li><?php echo '<li ><a  href="?pagina=' . ($total_paginas) . '">' ?>>|</a></li>
            </ul>
        </div>
        <footer>

            <div class="iconos">

                <div class="siguenos">
                    <p>Síguenos en: </p>
                </div>
                <span class="icon-facebook"><a href="https://es-la.facebook.com/"></a></span>
                <span class="icon-twitter"></span>
                <span class="icon-instagram"></span>

            </div>

            <div class="contacto">
                <div class="gmail">
                    <p>Contáctenos en: Copito@gmail.com</p>
                </div>
            </div>
        </footer>


</body>

</html>