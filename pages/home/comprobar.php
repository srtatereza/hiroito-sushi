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
    <div class="login">
        <form action="comprobar.php" method="POST">
            <label>
                E-mail
            </label>
            <input type="email" name="registrado[email]" required autocomplete="off" placeholder="Tu email..."/>
            <label>
                Contraseña
            </label>
            <input type="contraseña" name="registrado[contraseña]" required autocomplete="off" placeholder="Tu contraseña..."/>

            <button type="submit" class="boton-blanco">enviar</button>
        </form>
    </div>

    <?php if (isset($_GET['mensaje'])) { ?>
<p>Acceso permitido. <a href="home.php">entrar</a>.</p>
<p>
    <?php } ?>



    <div class="register">
        <span>
            <span>¿Todavía no eres usuario?</span>
            <a href="registro.php">Regístrate</a>
        </span>
    </div>
</div>

<?php

/* Como siempre, comprobar que venimos del formulario de login y si no, redirigir a él. */
if (!isset($_POST)) {
    header("location: registro.php");
}
$email = $_POST['registrado']['email'] ?? '';
$contraseña = $_POST['registrado']['contraseña'] ?? '';

/* Si llegamos aquí es porque procedemos del formulario de logueado. */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /* 1. Conexión a la base de datos. */
    try {
        include "conexion.php";
        @$conexion = mysqli_connect($host, $usuario, $pass, $nombreBD);
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
        include "conexion.php";
        @$resultado = mysqli_query(@$conexion, $sql);
    } catch (Exception $e) {
        ?>
        <p>Error: no se pudo ejecutar la consulta.</p>
        <?php
        die();
    }

    /* Comprobamos el número de resultados de la consulta. */
    $numeroResultados = mysqli_num_rows($resultado);
    if ($numeroResultados == 0) {
        /* El usuario no existe en la base de datos. */
        ?>
        <p>Error: el usuario no existe en la base de datos.</p>
        <p>Volver al <a href="comprobar.php">login</a>.</p>
        <?php
        die();
    }

    /* Si estamos aquí es porque se ha recuperado una contraseña para el usuario. Ahora, tenemos que leerla y compararla con la contraseña especificada en el formulario para ver si está permitido el acceso del usuario. */

    /* Recordad que el resultado de la consulta está formado por un solo registro con un solo campo que es la contraseña. */

    $registro = mysqli_fetch_assoc($resultado);
    $passBD = $registro['contraseña'];

    /* Sólo nos quedaría comprobar que ambas contraseña son iguales. Para ello, necesitamos la función contraseña_verify. */
    if (password_verify($contraseña, $passBD)) {
        header('Location: comprobar.php?mensaje=1');
        ?>
        <?php
    } else {
        ?>
        <p>La contraseña no es correcta. Inténtalo de nuevo.</p>
        <p>Volver al <a href="comprobar.php">login</a>.</p>
        <?php
    }
}

?>

</body>

</html>
