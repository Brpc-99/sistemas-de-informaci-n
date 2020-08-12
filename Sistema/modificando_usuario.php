<?php 

include"..\include/conexion.php";
session_start();
if($_SESSION['rol']!=1)
{
	echo $_SESSION['rol'];
	header("Location: Usuario.php");
}


if(!empty($_POST)){

$iduser=$_POST['idusuario'];
$nombre= $_POST['nombre'];
$apellido= $_POST['apellido'];
$usuario= $_POST['usuario'];
$clave= $_POST['clave'];
$correo= $_POST['correo'];
$palabra_segura= $_POST['palabra_segura'];
$codigo= $_POST['codigo_rol'];



if(isset($_POST['submit'])){

	
	$consulta= pg_query($conexion, "UPDATE USUARIOS
	SET nombre='$nombre', apellido='$apellido', correo='$correo', usuario='$usuario', clave='$clave',
	respuesta_de_seguridad='$palabra_segura',
	cod_rol=$codigo
	 WHERE codigo_usuario=$iduser");

if(!$consulta){
echo '<script>
	alert("Error");
	window.history.go(-1);
	</script>';
}else{
	echo '<script>
	alert("Registro actualizado exitosamete");
	window.history.go(-1);
	</script>';
}

}


}
//motrar datos
if(empty($_GET['id'])){
	
	header('Location: Usuario.php');
}
$iduser=$_GET['id'];
$sql= pg_query($conexion,"SELECT*FROM USUARIOS WHERE codigo_usuario=$iduser");

$resul=pg_num_rows($sql);
	
	if($resul ==0){
	header('Location: Usuario.php');
}else{
		while($data = pg_fetch_array($sql)){

		$iduser= $data['codigo_usuario'];
		$nombre= $data['nombre'];
		$apellido= $data['apellido'];
		$usuario= $data['usuario'];
		$clave= $data['clave'];
		$correo= $data['correo'];
		$palabra_seguras= $data['respuesta_de_seguridad'];

	}
	


}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Modificar Usuario</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="..\imagenes\icono.ico">
	<link rel="stylesheet" type="text/css" href="..\include\estilo_header.css">
	<link rel="stylesheet" type="text/css" href="estilo\registrar_usuario.css">
</head>
<body>
	<?php include"..\include\header.php"; ?>

	<div class="contenedor">
		
	
			
			<form class="formulario" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
				<h2>Modificar Usuario</h2>
				<p class="campo">Campos Obligatorios *</p>
				<div class="contenedor_input">
				<input type="hidden" name="idusuario" value="<?php echo $iduser; ?>">	
				<input type="text" name="nombre" placeholder="Nombre *" maxlength="20" id="nombre" class="input-pequeño"
				value="<?php echo $nombre; ?>">
				<input type="text" name="apellido" placeholder="Apellido" maxlength="20" id="apellido" class="input-pequeño"
				value="<?php echo $apellido; ?>">
				<br>
				<input type="tex" name="usuario" placeholder="Usuario *" maxlength="15" id="usuario" class="input-pequeño"
				value="<?php echo $usuario; ?>">
				<input type="password" name="clave" placeholder="Clave *" maxlength="15" id="clave" class="input-pequeño"
				value="<?php echo $clave; ?>">
				<br>
				<input type="email" name="correo" placeholder="Correo *" maxlength="40" id="correo" class="input_grande"
				value="<?php echo $correo; ?>">
				<br>
				<input type="text" name="palabra_segura" placeholder="Palabra de Seguridad *" maxlength="10" id="palabra_segura" class="input_grande"
				value="<?php echo $palabra_seguras; ?>">
				<br>
				<select name="codigo_rol" class="rol">
					<option value="1">Administrador </option>
					<option value="2">Vendedor </option>
				</select>
				<br>
				<input type="submit" class="btn" name="submit" value="Actualizar" id="btn">
				
				<input type="button" class="cancelar" name="cancelar" value="Cancelar" id="cancelar">
				
				</div>


				<p class="error" id="error"></p>


			</form>







	</div>
<script src="js\registro_usuario.js"></script>
</body>
</html>