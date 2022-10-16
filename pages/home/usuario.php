<!doctype html>
<html lang="en">
<head>
    <title>Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="home-styles.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&family=Roboto:ital,wght@1,400&display=swap" rel="stylesheet">
</head>

<body>  


 <!-- CONTENEDOR CENTRAL-->
 <div class="contenedorCentral">

 		<div class="menu">
				<img src="imagenes/logo2.png" alt="logo" class="logo">
			<ul class="menu-content">
				<li><a href="usuario.php">Mi Usuario</a></li>
				<li><a href="home.php">Productos</a></li>
				<li><a href="pedidos.php">Mis Pedidos</a></li>
				<li><a href="cerrar.php">Cerrar sesion</a></li>
			</ul>
		</div>
      


	<?php
	session_start();
	$email = $_SESSION['email'];

	require_once("dbcontroller.php");
    $db_handle = new DBController();

	$sql = "SELECT clientes.id_cliente , clientes.nombre , clientes.apellido , clientes.direccion , clientes.telefono , clientes.email , clientes.contraseña FROM clientes WHERE email='$email';";
	$resultado = $db_handle->runQueryNoFetch($sql);

	/* Lectura de la información en un array. */
	while ( $registro = mysqli_fetch_assoc($resultado) ) {
		$cliente=array();
		$cliente['nombre'] = $registro['nombre'];
		$cliente['apellido'] = $registro['apellido'];
		$cliente['direccion'] = $registro['direccion'];
		$cliente['email'] = $registro['email'];
		$cliente['telefono'] = $registro['telefono'];
		$cliente['contraseña'] = $registro['contraseña'];

	}
	?>

	<h1 class="bienvenido1">Mis Datos</h1>
				<!-- El formulario del update. -->
				<form action="usuario.php" method="POST" class="principal" >
					<!-- Tenemos que pasar como campos ocultos los id de persona-->
					<label>Nombre
					</label>
						<input type="text" name="nombre" 
						value="<?php echo $cliente['nombre']; ?>"; />

					<label>Apellido
					</label>
						<input type="text" name="apellido" 
						value="<?php echo $cliente['apellido']; ?>"; />
					

					<label>Direccion
					</label>
						<input type="text" name="direccion" 
						value="<?php echo $cliente['direccion']; ?>"; />
					

					<label>Telefono
					</label>
						<input type="number" name="telefono" 
						value="<?php echo $cliente['telefono']; ?>"; />
					

					<label>Email
					</label>
						<input type="text" name="email" 
						value="<?php echo $cliente['email']; ?>"; />
					

					<label>Contraseña
					</label>
						<input type="password" name="contraseña" 
						value="<?php echo $cliente['contraseña']; ?>"; />
				</form>


		<div class="footer"> 
			<div>
				<p>
					&copy; Tereza Franco by 2022.
					<br>Contacto: 632145203.
				</p>
			</div>	
			
			<div class="iconos">
				<a href="https://www.facebook.com" target="_blank"><img src="imagenes/facebook.png" alt="logo" class="icono"></a>

				<a href="https://www.instagram.com/hiroito_sushi/" target="_blank"><img src="imagenes/instagram.png" alt="logo" class="icono"></a>
			</div>
		</div>		

	</div>
	
</body>
</html>
