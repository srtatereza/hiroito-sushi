<!DOCTYPE html>
<html lang="es">

	<head>
		<title>Nombre de mi página</title>
		
		<meta charset="utf-8">
		
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
		
		<style type="text/css">
		</style>
		
	</head>
	
	<body>
		
		<?php
		
		/* En primer lugar, comprobaremos que venimos del formulario de registro y no por entrada directa, en cuyo caso, redirigiríamos al formulario de registro. */
		
		if ( !isset( $_POST['registro'] ) ) {
			header("location: registro.html");
		}
		
		/* Si llegamos aquí es porque existen datos de usuario para registrar. */
		$nombre = $_POST^['nombre'];
		$apellido = $_POST^['apellido'];
		$direccion = $_POST^['direccion'];
		$telefono = $_POST^['telefono'];
		$email = $_POST['email'];
		$contraseña = $_POST['contraseña'];
		
		/* A continuación, encriptamos la contraseña. Lo más sencillo es utilizar el método crypt() Requiere un valor de salt según los requisitos de Blowfish (que es nuestro método de encriptación). Empezaremos por $2y$, seguido de un número entre 04 y 31 y una cadena que hace de salt escrita entre símbolos de dólar ($). */
		$numero = "08";
		$fecha = time();
		$cadena = uniqid((string)$fecha,true);
		$salt = "$2y$" . $numero . "$" . $cadena . "$";
		/* Encriptamos la contraseña. */
		$passEncriptada = crypt($contraseña, $salt);
		?>
		<p>Contraseña Blowfish: <?php echo $passEncriptada; ?></p>
		<?php
		
		/* Ahora, vamos a introducir los datos de usuario y contraseña en la base de datos. */
		
		/* 1. Conexión. */
		try {
			@$conn = mysqli_connect(
				"localhost",
				"root",
				"",
				"hiroito_sushi"
			);
		} catch (Exception $e) {
			?>
			<p>Error: no se pudo conectar a la base de datos.</p>
			<?php
			die();
		}
		
		/* Antes de insertar el registro en la base de datos tendríamos que comprobar que no exista ya un usuario con el mismo nombre. */
		$sqlConsulta = "SELECT * FROM clientes WHERE email = '$email';";
		try {
			@$resultadoUsuario = mysqli_query($conn,$sqlConsulta);
		} catch (Exception $e) {
			?>
			<p>Error: no se pudo ejecutar la consulta.</p>
			<?php
			die();
		}
		
		/* Si ejecutamos la consulta y obtenemos algún registro es porque el usuario ya existe. Tendríamos que parar el proceso. */
		$numeroUsuario = mysqli_num_rows($resultadoUsuario);
		if ( $numeroUsuario > 0 ) {
			/* El usuario ya existe. */
			?>
			<p>No se puede registrar con ese nombre de usuario. Ya existe.</p>
			<p>Volver al <a href="registro.html">registro</a>.</p>
			<?php
			die();∫
		}
		
		/* 2. Consulta INSERT. */
		if($_POST) {
			
		$sql = "INSERT INTO clientes (nombre,apellido,direccion,telefono,email,contraseña) VALUES ('$nombre','$apellido','$direccion', '$telefono','$email','$contraseña');";
		
		/* Ejecuto la consulta. */
		?>
		<?php
		try {
		@$resultado = mysqli_query($conexion,$sql);
		header('Location: registrar.php');
		}
	}  
	{
		?>
			<p>El usuario se registró con éxito.</p>
			<p>Volver al <a href="index.html">login</a>.</p>
			<?php
		} catch (Exception $e) {
			?>
			<p>Error: no se pudo ejecutar la consulta.</p>
			<?php
		}
		
		/* 3. Cierre de la conexión. */
		try {
			@mysqli_close($conn);
		} catch (Exception $e) {
			?>
			<p>Error: no se pudo cerrar la conexión.</p>
			<?php
			die();
		}
		
		?>
		
	</body>
	
</html>