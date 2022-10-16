<!DOCTYPE html>
<html lang="es">

<head>
    <title>Nombre de mi página</title>

    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <link rel="stylesheet" href="style.css" type="text/css">

</head>

<body>
    
<h1>Bienvenido</h1>

<div class="container">
    <!-- Creamos un formulario para realizar el login en el sitio web. -->


<?php
$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
if (!empty($product_array)) { 
    foreach($product_array as $key=>$value){
?>
    <div class="product-item">
        <form method="post" action="home.php?action=add&código=<?php echo $product_array[$key]["código"]; ?>">
        <div class="product-image"><img src="<?php echo $product_array[$key]["imagen"]; ?>"></div>
        <div class="product-title"><?php echo $product_array[$key]["nombre"]; ?> </div>
        <div class="product-ingredientes"><?php echo $product_array[$key]["ingredientes"]; ?></div>

        <div class="cart-action">

        <div class="Precio"><?php echo "Precio:  ".$product_array[$key]["precio"]."$"; ?></div>
        <input type="text" class="product-cantidad" name="cantidad" value="1" size="2" /><input type="submit" value="Agregar al carrito" class="btnAddAction" />
        </div>
        </form>
    </div>
<?php
    }
}
?>


</body>

</html>
