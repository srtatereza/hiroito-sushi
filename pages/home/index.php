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
				<li><a href="comprobar.php">Inicia Sesion</a></li>
				<li><a href="index.php">Tienda</a></li>
				<li><a href="registro.php">Registrarse</a></li>
			</ul>
		</div>



		<!-- CONTENEDOR DEL CARRUSEL, esta echo con una libreria de Bootstrap -->
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
			// igual que en el home
			session_start();
			require_once("dbcontroller.php");
			$db_handle = new DBController();
			if(!empty($_GET["action"])) {
			switch($_GET["action"]) {
				case "add":
				if(!empty($_POST["cantidad"])) {
					$productByCode = $db_handle->runQuery("SELECT * FROM productos WHERE código='" . $_GET["código"] . "'");
					$itemArray = array($productByCode[0]["código"]=>array('nombre'=>$productByCode[0]["nombre"], 'código'=>$productByCode[0]["código"], 'cantidad'=>$_POST["cantidad"], 'precio'=>$productByCode[0]["precio"], 'imagen'=>$productByCode[0]["imagen"],
					'id_producto'=>$productByCode[0]['id_producto']));
						
				if(!empty($_SESSION["cart_items"])) {
					if(in_array($productByCode[0]["código"],array_keys($_SESSION["cart_items"]))) {
						foreach($_SESSION["cart_items"] as $k => $v) {
							if($productByCode[0]["código"] == $k) {
								if(empty($_SESSION["cart_items"][$k]["cantidad"])) {
									$_SESSION["cart_items"][$k]["cantidad"] = 0;
									}
									$_SESSION["cart_items"][$k]["cantidad"] += $_POST["cantidad"];
									}
							}
					} else {
						$_SESSION["cart_items"] = array_merge($_SESSION["cart_items"],$itemArray);
							}
				} else {
					$_SESSION["cart_items"] = $itemArray;
						}
					}

				break;
				case "remove":
					if(!empty($_SESSION["cart_items"])) {
						foreach($_SESSION["cart_items"] as $k => $v) {
							if($_GET["código"] == $k)
							 unset($_SESSION["cart_items"][$k]);				
							if(empty($_SESSION["cart_items"]))
							 unset($_SESSION["cart_items"]);
						}
					}
				break;
				case "empty":
					unset($_SESSION["cart_items"]);
				break;	
			}
			}
			?>

			<?php
			$product_array = $db_handle->runQuery("SELECT * FROM productos ORDER BY id_producto ASC");
				if (!empty($product_array)) { 
					foreach($product_array as $key=>$value){
			?>
				<div class="product-item">
					<form method="post" action="index.php?action=add&código=<?php echo $product_array[$key]["código"]; ?>">
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



		</div>

		<div class="footer"> 
			<div>
				<div class="contacto">
					&copy; Tereza Franco by 2022.
					<br>Contacto: 632145203.
				</div>
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