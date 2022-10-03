<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu</title>
    <link href="home-styles.css" rel="stylesheet">
    <link href="../../lib/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="../../lib/bootstrap-icons.css" rel="stylesheet">
</head>


<body>  

    <?php
    $productos = array(
        array (
            'id_producto' => "1",
            'ruta' => "imagenes/imagen1.jpg",
			'ingredientes'=> "Atun,Aguacate,arroz,queso crema,salsa de la casa",
        ),
        array ( 
            'id_producto' => "2",
            'ruta' => "imagenes/imagen2.jpg",
			'ingredientes'=> "Tempurizado salmon, queso crema, aguacate, tobico, salsa de anguila",
        ),
        array (
            'id_producto' => "3",
            'ruta' => "imagenes/imagen3.jpg",
			'ingredientes'=> "Salmon, aguacate, topping de salmon",
		),
        array (
            'id_producto' => "4",
            'ruta' => "imagenes/imagen4.jpg",
			'ingredientes'=> "Langostino rebozado, salmon, queso crema, aguacate, topping de aguacate con salsa tigger",
		),
        array (
            'id_producto' => "5",
            'ruta' => "imagenes/imagen5.jpg",
			'ingredientes'=> "Roll envuelto en arroz de sushi, queso crema, vegetales tempura, aguacate, salmon, salsa de la casa, cebollino",
		),
        array (
            'id_producto' => "6",
            'ruta' => "imagenes/imagen6.jpg",
			'ingredientes'=> "Roll envuelto en arroz de sushi, queso crema, aguacate, salmon rebozado flameado, salsa de la casa, cebollino.",
		),
    );


try {
    include "conexion.php";
    @$conexion = mysqli_connect($host, $usuario, $pass, $nombreBD);
} catch (Exception $e) {
    ?>
    <p>Error: no se pudo conectar con la base de datos.</p>
    <?php
    die();
}
    /* Ejecuto la consulta. */

    $sql = "SELECT * FROM productos;"; 
    
    try {
        include "conexion.php";
        @$resultado = mysqli_query(@$conexion, $sql);
    } catch (Exception $e) {
        ?>
        <p>Error: no se pudo ejecutar la consulta.</p>
        <?php
        die();
    }

while ($row = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {
    foreach($productos as $indice => $producto) {	
        if ($producto['id_producto'] == $row['id_producto']) {
            $productos[$indice]['nombre'] = $row['nombre'];
            $productos[$indice]['precio'] = $row['precio'];
        }
    }
}

	?> 

    <div class="productos">
    <?php
			foreach($productos as $indice => $producto) {	
			?>	
			<div class="producto">
				<div class="contenedor-productor" 
					onmouseover="onImageMouseover(this)"
					onmouseout="onImageMouseout(this)">
					<img class="imagen" src="<?php echo $producto['ruta'];?>">
					<div><?php echo $producto['ingredientes']?></div>
				</div>
				<div>
					<p><?php echo $producto['nombre'];?></p>
				</div>
				<div>
					<div>
						<span><?php echo $producto['precio'];?></span>
					</div>
				</div>
                <div>
                    <button id="mas">Anadir</button>
                    <input min='0' type="text" id="input"></input>
                    <button id="menos">Quitar</button>
                </div>
                <div>
                    <button class="carrito">agregar al carrito</button>
                </div>
			</div>
			<?php
			}
			?>

</div>

<script> 
const botonMas = document.getElementById("mas");
    botonMas.addEventListener("click", metodoMas);
    const botonMenos = document.getElementById("menos");
    botonMenos.addEventListener("click", metodoMenos);

function metodoMas(e) {
    const campo = document.getElementById('input');
    console.log(campo);
    campo.value++;
}
function metodoMenos(e) {
    const campo = document.getElementById('input');
    if(campo.value > 0) campo.value--;
}

</script>

<script src="lib/bootstrap.bundle.min.js"></script>
</body>

