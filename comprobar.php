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
		
		/* Como siempre, comprobar que venimos del formulario de login y si no, redirigir a él. */
		if ( !isset( $_POST['registrado'] ) ) {
			header("location: index.html");
		}
		
		/* Si llegamos aquí es porque procedemos del formulario de logueado. */
		$email = $_POST['email'];
		$passFormulario = $_POST['contraseña'];
		
		/* 1. Conexión a la base de datos. */
		try {
			@$conn = mysqli_connect(
				"localhost",
				"root",
				"",
				"hiroito_sushi" 
			);
		} catch (Exception $e) {
			?>
			<p>Error: no se pudo conectar con la base de datos.</p>
			<?php
			die();
		}
		
		/* 2. Consultamos a la base de datos. Vamos a intentar recuperar la contraseña del usuario. Si la consulta devolviese un conjunto vacío, significaría que ni siquiera el usuario existe y tendríamos que actuar en consecuencia. */
		$sql = "SELECT contraseña FROM clientes WHERE email='$email';";
		/* Ejecuto la consulta. */
		try {
			@$resultado = mysqli_query($conn, $sql);
		} catch (Exception $e) {
			?>
			<p>Error: no se pudo ejecutar la consulta.</p>
			<?php
			die();
		}
		
		/* Comprobamos el número de resultados de la consulta. */
		$numeroResultados = mysqli_num_rows($resultado);
		if ( $numeroResultados == 0 ) {
			/* El usuario no existe en la base de datos. */
			?>contraseña
			<p>Error: el usuario no existe en la base de datos.</p>
			<p>Volver al <a href="index.html">login</a>.</p>
			<?php
			die();
		}
		
		/* Si estamos aquí es porque se ha recuperado una contraseña para el usuario. Ahora, tenemos que leerla y compararla con la contraseña especificada en el formulario para ver si está permitido el acceso del usuario. */
		
		/* Recordad que el resultado de la consulta está formado por un solo registro con un solo campo que es la contraseña. */
		$registro = mysqli_fetch_assoc($resultado);
		$passBD = $registro['contraseña'];
		
		/* Sólo nos quedaría comprobar que ambas contraseña son iguales. Para ello, necesitamos la función contraseña_verify. */
		if ( contraseña_verify($passFormulario, $passBD) ) {
			?>
			<p>La contraseña es correcta. Acceso permitido.</p>
			<?php
		} else {
			?>
			<p>La contraseña no es correcta. Inténtalo de nuevo.</p>
			<p>Volver al <a href="index.html">login</a>.</p>
			<?php
		}
		
		?>
		
	</body>
	
</html>