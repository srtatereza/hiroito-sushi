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

$sql = "SELECT pedidos.id_pedido , pedidos.fecha , pedidos.id_producto, productos.nombre FROM pedidos INNER JOIN productos 
        WHERE pedidos.id_cliente IN (select clientes.id_cliente from clientes where clientes.email='$email') 
        AND pedidos.id_producto = productos.id_producto;";
$resultado = $db_handle -> runQueryNoFetch($sql);

/* Lectura de la información en un array. */
$pedidos=array();
while ( $registro = mysqli_fetch_assoc($resultado) ) {
    $pedido=array();
    $pedido['id_pedido'] = $registro['id_pedido'];
    $pedido['fecha'] = $registro['fecha'];
	$pedido['nombre'] = $registro['nombre'];
    array_push($pedidos, $pedido);
}
?>

<h1 class="bienvenido1">Mis pedidos</h1>
<?php		
	foreach($pedidos as $item) { ?>
    <form action="pedidos.php" method="POST" class="principal" >
    <label>Pedido
        </label>
            <input type="text" name="pedido" 
            value="<?php echo $item['id_pedido']; ?>"; />

        <label>Fecha
        </label>
            <input type="text" name="fecha" 
            value="<?php echo $item['fecha']; ?>"; />

        <label>Producto
        </label>
            <input type="text" name="id_producto" 
            value="<?php echo $item['nombre']; ?>"; />
    </form>
    <?php } ?>

	<div class="propaganda"> 
		<img src="imagenes/propaganda.png" alt="propaganda"  class="propaganda">
	</div>

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
</body>
</html>
