<?php 
	include"..\include/conexion.php";

	session_start();
if($_SESSION['rol']!=1)
{
	echo $_SESSION['rol'];
	header("Location: Usuario.php");
}


		if(!empty($_POST)){
			$idusuario=$_POST['idusuario'];
			$query_delete=pg_query($conexion, "DELETE FROM USUARIOS where codigo_usuario=$idusuario");

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

			header("Location: Usuario.php");

		}else{

			$idusuario=$_REQUEST['id'];
			$query= pg_query($conexion,"SELECT u.nombre, u.apellido,u.usuario FROM USUARIOS u 
			Where u.codigo_usuario='$idusuario'");

			$result=pg_num_rows($query);

			if($result >0){

				while ($data=pg_fetch_array($query)) {
				
					$nombre=$data['nombre'];
					$apellido=$data['apellido'];
					$usuario=$data['usuario'];
				}
			}else{

				header("Location: Usuario.php");
			}
		}


 ?> 


<!DOCTYPE html>
<html>
<head>
	<title>Eliminar Usuario</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="..\imagenes\icono.ico">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_header.css">
	<link rel="stylesheet" type="text/css" href="estilo\estilo_eliminar_usuario.css">
</head>
<body>
	<?php include"..\include\header.php"; ?>

	<section>
		
		<div class="delete">
			<h2>¿Está seguro que desea eliminar el registro?</h2>
			<p>Nombre: <span><?php echo $nombre; ?></span></p>
			<p>Apellido: <span><?php echo $apellido; ?></span></p>
			<p>Usuario: <span><?php echo $usuario; ?></span></p>

			<form action="" method="post">
				<input type="hidden" name="idusuario" value="<?php echo $idusuario ?>">
				<input type="submit" name="submit" value="Aceptar" class="btn">
				<a href="Usuario.php" class="btn2">Cancelar</a>
				
			</form>
		</div>
	</section>

</body>
</html>