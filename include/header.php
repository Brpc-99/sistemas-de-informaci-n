<?php 
//session_start();
if(empty($_SESSION['active']))
{
header("location: ..\iniciar sesion\iniciar_sesion.html");
} 

?>

<header>
<div class="contenedor">
	<h1>Sistema Electrónico de Gestión de Farmacia</h1>
		<div class="logo">
			<img src="..\imagenes\logo_1.png">
		</div>
		<div class="menu">
		<nav>
			<ul class="subnav">
				<li><a href="..\Sistema\inicio_nuevo.php">Inicio</a></li>
				<li><a href="..\Sistema\Usuario.php">Usuario</a></li>
				<li><a href="..\Sistema\producto.php">Producto</a>
				<ul>
				<li><a href="..\Sistema\categoria.php">Categoría</a></li>
				
				</ul>
				</li>
				<li><a href="..\Sistema\Proveedores.php">Proveedores</a></li>
					<li><a href="..\Sistema\venta.php">Venta</a>
						<ul>
							<li><a href="..\Sistema\Lista de ventas.php">Lista</a></li>

						</ul>
					</li>
			</ul>

		</nav>
		</div>
			<div class="sesion">
				<div class="sesion_logo">
			<img class="img_sesion" src="..\imagenes\usuario.png">
			    </div>
			    <div class="cerrar">
			    	<p>Bienvenido: <?php echo $_SESSION['nombre'] ?></p>
			    <a href="..\Sistema\cerrar_sesion.php">Cerrar Sesión</a>
			    </div>
			   
			</div>
 		</div>
</header>