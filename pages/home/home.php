<?php
ob_start();
?>

<!doctype html>
<html lang="en">
<head>
    <title>Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../lib/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="../../lib/bootstrap-icons.css" rel="stylesheet">
    <link href="home-styles.css" rel="stylesheet">
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

		<!-- CONTENEDOR DEL CARRUSEL, esta echo con una libreria de Bootstrap  cuenta con 3 imagenes-->
		<div class="banner">
			<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
				<div class="carousel-indicators">
					<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
					<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
					<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
				</div>
				<div class="carousel-inner">
					<div class="carousel-item active" data-bs-interval="3000">
						<img src="imagenes/imagen5.jpg" class="imagenCarrusel" alt="banner">
						<div class="carousel-caption d-none d-md-block"></div>
					</div>
					<div class="carousel-item" data-bs-interval="3000">
						<img src="imagenes/imagencarrusel.jpg" class="imagenCarrusel" alt="banner">
						<div class="carousel-caption d-none d-md-block"></div>
					</div>
					<div class="carousel-item"  data-bs-interval="3000">
						<img src="imagenes/imagen3.jpg" class="imagenCarrusel" alt="banner">
						<div class="carousel-caption d-none d-md-block"></div>
					</div>
				</div>
			</div>
		</div>

		<!-- CONTENEDOR DE LOS PRODUCTOS -->
		<h1 class="bienvenido">Productos</h1>

		<div class="productoCarrito">
			<?php
			// nos crea la sesion o reanuda la actual basada en un identificador de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie
			session_start();

			// Utilizamos el metodo DBController para conectarnos a la base de datos. $db_handle como variable de enlace a la base de datos
			require_once("dbcontroller.php");
			$db_handle = new DBController();

			// si existe una peticion GET con la action rellenada
			if(!empty($_GET["action"])) {
				// pasamos por los diferentes casos de action: add, remove, empty
				switch($_GET["action"]) {
					// caso agregar al carrito
					case "add":
						// si existe una peticion POST con la cantidad rellenada (si no hay cantidad, no entra) 
						if(!empty($_POST["cantidad"])) {
							// ejecutamos la query sobre la table productos para sacar la informacion de los mismos y los metemos en un array
							$productByCode = $db_handle->runQuery("SELECT * FROM productos WHERE código='" . $_GET["código"] . "'");
							$itemArray = array($productByCode[0]["código"]=>array('nombre'=>$productByCode[0]["nombre"], 'código'=>$productByCode[0]["código"], 'cantidad'=>$_POST["cantidad"], 'precio'=>$productByCode[0]["precio"], 'imagen'=>$productByCode[0]["imagen"],
							'id_producto'=>$productByCode[0]['id_producto']));
						
						// si el carrito no esta vacio
						if(!empty($_SESSION["cart_items"])) {
							// y si en el carrito hay uno de los productos del array
							if(in_array($productByCode[0]["código"],array_keys($_SESSION["cart_items"]))) {
								// por cada producto del carrito
								foreach($_SESSION["cart_items"] as $k => $v) {
									// si el producto ya esta en el carrito
									if($productByCode[0]["código"] == $k) {
										// si dicho producto no tiene puesta la cantidad
										if(empty($_SESSION["cart_items"][$k]["cantidad"])) {
											// la ponemos a cero
											$_SESSION["cart_items"][$k]["cantidad"] = 0;
											}
											// si tiene puesta la cantidad, se la sumamos
											$_SESSION["cart_items"][$k]["cantidad"] += $_POST["cantidad"];
											}
									}
							} else {
								// si no lo tiene, lo agregamos
								$_SESSION["cart_items"] = array_merge($_SESSION["cart_items"],$itemArray);
									}
						} else {
							// si el carrito esta vacio, le metemos el producto
							$_SESSION["cart_items"] = $itemArray;
								}
							}
						break;
						
					// caso quitar del carrito
					case "remove":
						// si el carrito no esta vacio
						if(!empty($_SESSION["cart_items"])) {
							// por cada producto del carrito
							foreach($_SESSION["cart_items"] as $k => $v) {
								// vemos si el producto a quitar esta en el carrito, y entonces lo quitamos (limpiamos la variable)
								if($_GET["código"] == $k)
									unset($_SESSION["cart_items"][$k]);		
								// si no hay productos en el carrito, limpiamos la variable
								if(empty($_SESSION["cart_items"]))
									unset($_SESSION["cart_items"]);
							}
						}
						break;

					// caso limpiar carrito
					case "empty":
						// limpiamos la variable
						unset($_SESSION["cart_items"]);
						break;	
				}
			}
			?>

			<?php
			// hacemos una consulta de la tabla productos. utilizamos un if empty() para comprueba si la variable está vacía o no
			$product_array = $db_handle->runQuery("SELECT * FROM productos ORDER BY id_producto ASC");
				if (!empty($product_array)) { 
					// ejecutamos un foreach para recorrer el array he imprimir la informacion de cada productos en una tabla
					foreach($product_array as $key=>$value){
			?>
				<div class="product-item">
					<form method="post" action="home.php?action=add&código=<?php echo $product_array[$key]["código"]; ?>">
						<div class="product-image"><img src="<?php echo $product_array[$key]["imagen"]; ?>"></div>
						<div class="product-title"><?php echo $product_array[$key]["nombre"]; ?> </div>
						<div class="product-ingredientes"><?php echo $product_array[$key]["ingredientes"]; ?></div>

						<div class="cart-action">
			
							<div class="preciotexto">Precio:</div>
							<div class="precio"><?php echo "".$product_array[$key]["precio"]."€"; ?></div>
						
							<input type="text" class="product-cantidad" name="cantidad" value="1" size="2" />
							<input type="submit" value="Agregar al carrito" class="btnAddAction" />
						</div>
					</form>
				</div>
					<?php
						}
					}
					?>
			</div>

			<div class="horaPedir">Tu Carrito esta Vacio , !Hora Pedir! </div>

			<div class="shopping-cart">
				<?php
				// vamos a pintar la tabla del carrito, realizamos un if ( isset ) para verificar si la variable esta definida , y un array $_session que nos guardar información a través de los requests
				if(isset($_SESSION["cart_items"])){
					$total_cantidad = 0;
					$total_price = 0;
				?>	
				<div><a class ="vaciar" href="home.php?action=empty">Vaciar Carrito</a></div>

				<table class="tbl-cart">
					<tbody>
						<tr>
							<th>Nombre</th>
							<th>Cantidad</th>
							<th>Precio Unidad</th>
							<th>Precio</th>
							<th>Remove</th>
						</tr>	
						<?php		
						// para cada producto que agregamos al carrito, sacamos la cantidad, el precio y calculamos el producto
						foreach($_SESSION["cart_items"] as $item){
							$item_price = $item["cantidad"]*$item["precio"];
						?>
							<tr>
								<td><img src="<?php echo $item["imagen"]; ?>" class="cart-item-image" /><?php echo $item["nombre"]; ?></td>
								<td><?php echo $item["cantidad"]; ?></td>
								<td><?php echo $item["precio"]."$ "; ?></td>
								<td><?php echo number_format($item_price,2)."$ "; ?></td>
								<td><a href="home.php?action=remove&código=<?php echo $item["código"]; ?>" class="btnRemoveAction"><img src="imagenes/icon-delete.png" class="eliminar" alt="Remove Item" /></a></td>
							</tr>
								<?php
								// cantidad y calculo del producto
								$total_cantidad += $item["cantidad"];
								$total_price += ($item["precio"]*$item["cantidad"]);
							}
								?>
							<tr>
								<td align="right">Total:</td>
								<td align="right"><?php echo $total_cantidad; ?></td> 
								<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
								<td>
									<form method="post">
										<input type="submit" name="comprar" class="comprar" value="Comprar"/>
									</form>
								</td>
							</tr>
					</tbody>
				</table>
				<?php
				} else {
					?>
					<?php 
					}
				?>

				<?php
				// random para crear un numero de pedido aleatorio y para evitar colisiones en la bbdd
				function randomNumber($length) {
					$result = '';
					for($i = 0; $i < $length; $i++) {
						$result .= mt_rand(0, 9);
					}
					return $result;
				}

				// al dar a comprar
				if(array_key_exists('comprar', $_POST)) {
					$cart_items = $_SESSION["cart_items"];
					$id_pedido = randomNumber(12);
					$fecha_hoy = date("Y-m-d");

					// sacamos el id del cliente con el email de la sesion
					$id_cliente = $db_handle -> runQuery("SELECT id_cliente FROM clientes WHERE email = '" . $_SESSION["email"] .  "'");

					// para cada producto del carrito, creamos una nueva fila con el numero del pedido, el id del cliente y el id del producto en bbdd
					foreach ($cart_items as $key=>$item) {
						$query = "
						INSERT INTO `pedidos` (`id_pedido`, `fecha`, `id_cliente`, `id_producto`) 
						VALUES (
							'" . $id_pedido . "', 
							'" . $fecha_hoy . "', 
							'" . $id_cliente[0]['id_cliente'] . "', 
							'" . $item['id_producto'] . "'
						)";

						$db_handle -> runQueryNoFetch($query);
					}

				}
				?>
			</div>

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
		

		<script src="../../lib/bootstrap.bundle.min.js"></script>
		<!-- Minified JS library -->

	</div>
</body>
</html>