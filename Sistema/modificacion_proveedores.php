<?php 

include"..\include/conexion.php";

if(!empty($_POST)){

$IdProveedor=$_POST['IdProveedor'];
$rut= $_POST['rut'];
$nombre= $_POST['nombre'];
$descripcion= $_POST['descripcion'];

if(isset($_POST['submit'])){
	
	$consulta= pg_query($conexion, "UPDATE PROVEEDORES
	SET rut='$rut', nombre='$nombre', descripcion='$descripcion'
     WHERE Codigo_proveedores=$IdProveedor");
     

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
	
	header('Location: Proveedores.php');
}
$IdProveedor=$_GET['id'];
$sql= pg_query($conexion,"SELECT*FROM PROVEEDORES WHERE codigo_proveedores=$IdProveedor");

$resul=pg_num_rows($sql);
	
	if($resul ==0){
	header('Location: Proveedores.php');
}else{
		while($data = pg_fetch_array($sql)){

        $IdProveedor=$data['codigo_proveedores'];
        $rut= $data['rut'];
        $nombre= $data['nombre'];
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
	<?php include"..\include\header.html" ?>

	<div class="contenedor">
		
	
			
			<form class="formulario" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
				<h2>Modificar Usuario</h2>
				<p class="campo">Campos Obligatorios *</p>
				<div class="contenedor_input">
                <input type="hidden" name="IdProveedor" value="<?php echo $IdProveedor; ?>">
                <input type="text" name="rut" placeholder="Rut *" maxlength="20" id="rut" class="input-pequeño" value="<?php echo $rut; ?>">
				<input type="text" name="nombre" placeholder="Nombre *" maxlength="20" id="nombre" class="input-pequeño"
				value="<?php echo $nombre; ?>">
				<input name="descripcion"  placeholder="Descripción" maxlength="60" id="descripcion" class="area"value="<?php echo $descripcion; ?>" ></input>

 
				<input type="submit" class="btn" name="submit" value="Actualizar" id="btn">
				
				<input type="button" class="cancelar" name="cancelar" value="Cancelar" id="cancelar">
				
				</div>


				<p class="error" id="error"></p>


			</form>

	</div>

</body>
</html>