<?php 

include"..\include/conexion.php";
session_start();

if(!empty($_POST)){

$iduser=$_POST['idusuario'];
$nombre= $_POST['nombre'];
$descripcion= $_POST['descripcion'];




if(isset($_POST['btn'])){

	
	$consulta= pg_query($conexion, "UPDATE CATEGORIAS
	SET Nombre_categoria='$nombre', Descripcion='$descripcion'
	 WHERE Codigo_categoria=$iduser");

if(!$consulta){
echo '<script>
	alert("Error");
	window.history.go(-1);
	</script>';
}else{
	echo '<script>
	alert("Registro actualizado exitosamente");
	window.history.go(-1);
	</script>';
}

}


}
//motrar datos
if(empty($_GET['id'])){
	
	header('Location: categoria.php');
}
$iduser=$_GET['id'];
$sql= pg_query($conexion,"SELECT*FROM CATEGORIAS WHERE Codigo_categoria=$iduser");

$resul=pg_num_rows($sql);
	
	if($resul ==0){
	header('Location: categoria.php');
}else{
		while($data = pg_fetch_array($sql)){

		$iduser= $data['codigo_categoria'];
		$nombre= $data['nombre_categoria'];
		$descripcion= $data['descripcion'];

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
	<link rel="stylesheet" type="text/css" href="estilo\registrar_categoria.css">
</head>
<body>
	<?php include"..\include\header.php";?>

	<div class="contenedor">
		
	
			
			<form class="formulario" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
					<h2>Registrar Categoría</h2>
				<p class="campo">Campos Obligatorios *</p>
				<div class="contenedor_input">

				<input type="hidden" name="idusuario" value="<?php echo $iduser; ?>">	
				<input type="text" name="nombre" placeholder="Nombre *" maxlength="20" id="nombre" class="input-pequeño" value="<?php echo $nombre ?>">
				<input name="descripcion" id="descripcion" class="area" autofocus="" maxlength="60" placeholder="Descripción" value="<?php echo $descripcion ?>" >
		
				<input type="submit" class="btn" name="btn" value="Aceptar" id="btn">
				
				<input type="button" class="cancelar" name="cancelar" value="Cancelar" id="cancelar">
				
				</div>


				<p class="error" id="error"></p>


			</form>







	</div>
<script src="js\registrar_categoria.js"></script>
</body>
</html>