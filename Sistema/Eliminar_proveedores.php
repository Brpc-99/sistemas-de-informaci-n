<?php 
	include"..\include/conexion.php";

		if(!empty($_POST)){
			$IdProveedor=$_POST['IdProveedor'];
			$query_delete=pg_query($conexion, "DELETE FROM PROVEEDORES where  Codigo_proveedores=$IdProveedor");

			if($query_delete){
		
				echo '<script>
				alert("Eliminado exitosamente");
			window.history.go(-1);
				</script>';
			}else{
				echo '<script>
			alert("Error");
			window.history.go(-1);
			</script>';
			}

		}

		if(empty($_REQUEST['id'])) //para recibir la variable
		{

			header("Location: Proveedores.php");

		}else{

			$IdProveedor=$_REQUEST['id'];
			$query= pg_query($conexion,"SELECT P.Codigo_proveedores, P.Rut, P.Nombre, P.Descripcion FROM PROVEEDORES P 
			Where P.Codigo_proveedores='$IdProveedor'");

			$result=pg_num_rows($query);

			if($result >0){

				while ($data=pg_fetch_array($query)) {
				
                    $codigoP=$data['codigo_proveedores'];
                    $rut= $data['rut'];
					$nombre= $data['nombre'];
        		    $descripcion= $data['descripcion'];
				}
			}else{

				header("Location: Proveedores.php");
			}
		}


 ?> 


<!DOCTYPE html>
<html>
<head>
	<title>Eliminar Proveedor</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="..\imagenes\icono.ico">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_header.css">
	<link rel="stylesheet" type="text/css" href="estilo\estilo_eliminar_usuario.css">
	<link rel="stylesheet" type="text/css" href="..\iniciar sesion\estilo\font.css">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_footer.css">

</head>
<body>
	<?php include"..\include\header.html" ?>

	<section>
		
		<div class="delete">
			<h2>¿Esta seguro que desea eliminar el registro?</h2>
			<p>Código: <span><?php echo $codigoP; ?></span></p>
            <p>Rut: <span><?php echo $rut; ?></span></p>
			<p>Nombre: <span><?php echo $nombre; ?></span></p>
			<p>Descripción: <span><?php echo $descripcion; ?></span></p>

			<form action="" method="post">
				<input type="hidden" name="IdProveedor" value="<?php echo $IdProveedor ?>">
				<input type="submit" name="submit" value="Aceptar" class="btn">
				<a href="Proveedores.php" class="btn2">Cancelar</a>
				
			</form>
		</div>
	</section>
	<footer>
	
	<div class="iconos">

	<div class="siguenos"><p>Síguenos en: </p></div>
	<span class="icon-facebook"><a href="https://es-la.facebook.com/"></a></span>
	<span class="icon-twitter"></span>
	<span class="icon-instagram"></span>

	</div>

	<div class="contacto">
		<div class="gmail"><p >Contáctenos en: Copito@gmail.com</p></div>	

	</div>
</footer>
</body>
</html>