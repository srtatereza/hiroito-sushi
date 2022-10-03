<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu</title>
    <link href="home-styles.css" rel="stylesheet">
    <link href="../../lib/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="../../lib/bootstrap-icons.css" rel="stylesheet">54
</head>


<body>  
<!-- Vertically centered modal: https://getbootstrap.com/docs/4.0/components/modal/ -->
<div id="mySidebar" class="sidebar">
    <a class="sidebar-item" href="#" onclick="toggleNav(this)">
        <em class="bi bi-list"></em>
    </a>
    <a class="sidebar-item" href="#">
        <em class="bi bi-house-fill"></em>
        <span class="sidebar-item-text">Home</span>
    </a>
    <a class="sidebar-item" href="#">
        <em class="bi bi-house-fill"></em>
        <span class="sidebar-item-text">Home</span>
    </a>
    <a class="sidebar-item" href="#">
        <em class="bi bi-house-fill"></em>
        <span class="sidebar-item-text">Home</span>
    </a>
    <a class="sidebar-item" href="#">
        <em class="bi bi-house-fill"></em>
        <span class="sidebar-item-text">Home</span>
    </a>
</div>

<div id="main">
    <div class="bloque_login">
        <div class="lenguaje">
            <ul>
                <li><a href="#">ES</a></li>
                <li><a href="#">EN</a></li>
                <li><a href="#">FR</a></li>
            </ul>
        </div>
    </div>

    <div class="banner">
        <img src="imagenes/imagen7.png" alt="Banner">
        <div>
            <button>banner</button>
        </div>
    </div>
    
    <div class="productos">
			<div class ="producto">
				<img src="imagenes/imagen1.jpg" alt="Niguiri">
                <div class="nombre">
                    <p>Niguiri</p>
                    <span>4.80€</span>
                </div>
				<div class="ingredientes">
                    <p>Ingredientes: Atun,Aguacate,arroz,queso crema,salsa de la casa.</p>
                </div>
                    <button id="mas">Anadir</button>
                    <input min='0' type="text" id="input"></input>
                    <button id="menos">Quitar</button>
                <div>
                    <button class="carrito">agregar al carrito</button>
                </div>
            </div>

            <div class ="producto"></div>
				    <img src="imagenes/imagen2.jpg" alt="Futomaki">
					<div class="nombre">
                        <p>Futomaki</p>
                        <span>9.50€</span>
                    </div>
                     <div class="ingredientes">
                        <p>Ingredientes: Tempurizado salmon, queso crema, aguacate, tobico, salsa de anguila.</p>
                    </div>
                    <div>
                        <button id="mas">Anadir</button>
                        <input min='0' type="text" id="input"></input>
                        <button id="menos">Quitar</button>
                    </div>
                    <div>
                    <button class="carrito">agregar al carrito</button>
                    </div>
            <div>

            <div class ="producto">
				<img src="imagenes/imagen3.jpg" alt="Salmon">
                <div class="nombre">
                    <p>Salmon</p>
                    <span>8.50€</span>
                </div>
				 <div class="ingredientes">
                    <p>Ingredientes: Salmon, aguacate, topping de salmon.</p>
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


            <div class ="producto">
				<img src="imagenes/imagen4.jpg" alt="Ebi Abocado">
					<div class="nombre">
                        <p>Ebi Abocado</p>
                        <span>8.50€</span>
                    </div>
                     <div class="ingredientes">
                        <p>Ingredientes: Langostino rebozado, salmon, queso crema, aguacate, topping de aguacate con salsa tigger.</p>
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

            <div class ="producto">
				<img src="imagenes/imagen5.jpg" alt="Brutal Roll">
				<div class="nombre">
                    <p>Brutal Roll</p>
                    <span>11.00€</span>
                </div>
                 <div class="ingredientes">
                    <p>Ingredientes: Roll envuelto en arroz de sushi, queso crema, vegetales tempura, aguacate, salmon, salsa de la casa, cebollino.</p>
                </div>
                    <button id="mas">Anadir</button>
                    <input min='0' type="text" id="input"></input>
                    <button id="menos">Quitar</button>
				</div>
                <button class="carrito">agregar al carrito</button>
			</div>

            <div class ="producto">
				<img src="imagenes/imagen6.jpg" alt="Nella Roll">
				<div class="nombre">
                    <p>Nella Roll</p>
                    <span>11.00€</span>
                </div>
                 <div class="ingredientes">
                    <p>Ingredientes: Roll envuelto en arroz de sushi, queso crema, aguacate, salmon rebozado flameado, salsa de la casa, cebollino.</p>
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
    </div>


    <?php
    $productos = array(
        array (
            'id_producto' => "0",
            'nombre' => "",
            'precio' => 8.50,
            'ruta' => "imagenes/imagen6.jpg",
			'ingredientes'=> "descripcion",
        ),
        array ( 
            'id_producto' => "0",
            'nombre' => "",
            'precio' => 8.50,
            'ruta' => "imagenes/imagen6.jpg",
			'ingredientes'=> "descripcion",
        ),
        array (
            'id_producto' => "0",
            'nombre' => "",
            'precio' => 8.50,
            'ruta' => "imagenes/imagen6.jpg",
			'ingredientes'=> "descripcion",
		),
    );
	
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
						<span><?php echo $producto['precio'];?></span><span><?php echo ($producto['precio']);?></span>
					</div>
				</div>
			</div>
			<?php
			}
			?>


<?php




?>

</div>




<div id="footer">
        <div>
            <p>
				&copy; 2022 by Tereza Franco.
			</p>
		</div>
		<div id="connect">
			<a href="https://freewebsitetemplates.com/go/facebook/" id="facebook" target="_blank">Facebook</a>
			<a href="https://freewebsitetemplates.com/go/twitter/" id="twitter" target="_blank">Twitter</a>
			<a href="https://freewebsitetemplates.com/go/googleplus/" id="googleplus" target="_blank">Google&#43;</a>
			<a href="https://freewebsitetemplates.com/go/pinterest/" id="pinterest" target="_blank">Pinterest</a>
		</div>

</div>

<script>
    /* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
    function toggleNav(elem) {
        const {toggled = false} = elem;
        if (toggled) {
            elem.toggled = false;
            document.getElementById("mySidebar").style.width = "95px";
            document.getElementById("main").style.marginLeft = "95px";
        } else {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            elem.toggled = true;
        }
    }
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

