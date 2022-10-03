<?php

/* En primer lugar, comprobaremos que venimos del formulario de registro y no por entrada directa, en cuyo caso, redirigiríamos al formulario de registro. */
if (!isset($_POST)) {
    header("location: registro.php");
}


/* Si llegamos aquí es porque existen datos de usuario para registrar. */
var_dump($_POST);

$nombre = $_POST['registrado']['nombre'] ?? '';
$apellido = $_POST['registrado']['apellido'] ?? '';
$direccion = $_POST['registrado']['direccion'] ?? '';
$telefono = $_POST['registrado']['telefono'] ?? '';
$email = $_POST['registrado']['email'] ?? '';
$contraseña = $_POST['registrado']['contraseña'] ?? '';

/* A continuación, encriptamos la contraseña. Lo más sencillo es utilizar el método crypt() Requiere un valor de salt según los requisitos de Blowfish (que es nuestro método de encriptación). Empezaremos por $2y$, seguido de un número entre 04 y 31 y una cadena que hace de salt escrita entre símbolos de dólar ($). */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = "08";
    $fecha = time();
    $cadena = uniqid((string)$fecha, true);
    $salt = "$2y$" . $numero . "$" . $cadena . "$";
    /* Encriptamos la contraseña. */
    $passEncriptada = crypt($contraseña, $salt);
    ?>
    <p>Contraseña Blowfish: <?php echo $passEncriptada; ?></p>
    <?php

    /* Ahora, vamos a introducir los datos de usuario y contraseña en la base de datos. */

    /* 1. Conexión. */
    try {
        include "conexion.php";
        @$conexion = mysqli_connect($host, $usuario, $pass, $nombreBD);
    } catch (Exception $e) {
        ?>
        <p>Error: no se pudo conectar a la base de datos.</p>
        <?php
        die();
    }

    /* Antes de insertar el registro en la base de datos tendríamos que comprobar que no exista ya un usuario con el mismo nombre. */
    $sqlConsulta = "SELECT * FROM clientes WHERE email = '$email';";
    try {
        @$resultadoEmail = mysqli_query(@$conexion, $sqlConsulta);
    } catch (Exception $e) {
        ?>
        <p>Error: no se pudo ejecutar la consulta.</p>
        <?php
        die();
    }

    /* Si ejecutamos la consulta y obtenemos algún registro es porque el usuario ya existe. Tendríamos que parar el proceso. */
    $numeroUsuario = mysqli_num_rows($resultadoEmail);
    if ($numeroUsuario > 0) {
        /* El usuario ya existe. */
        ?>
        <p>No se puede registrar con ese nombre de usuario. Ya existe.</p>
        <p>Volver al <a href="registro.php">registro</a>.</p>
        <?php
        die();
    }

    /* Ejecuto la consulta. */
    mysqli_set_charset(@$conexion, "utf8");


    /* 2. Ejecución de la consulta. */
    try {
        /* Primero, preparamos la consulta. */
        if ($_POST) {
            $sql = "INSERT INTO clientes (nombre,apellido,direccion,telefono,email,contraseña) VALUES ('$nombre','$apellido','$direccion', '$telefono','$email','$passEncriptada');";

            /* Ejecuto la consulta. */
            include "conexion.php";
            @$resultado = mysqli_query($conexion, $sql);
            header('Location: registro.php?mensaje=1');
        }
        ?>
        <?php
    } catch (Exception $e) {
        ?>
        <p>Error: no se pudo ejecutar la consulta.</p>
        <?php
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Registro de usuarios</title>

    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <link rel="stylesheet" href="style.css" type="text/css">

</head>

<body>
<h1>Registro de usuarios</h1>

<form action="registro.php" method="POST">
    <label>
        Nombre
    </label>
    <input type="text" name="registrado[nombre]" required autocomplete="off" placeholder="Tu nombre..."/>
    <label>
        Apellidos
    </label>
    <input type="text" name="registrado[apellidos]" required autocomplete="off" placeholder="Tus apellidos..."/>
    <label>
        Direccion
    </label>
    <input type="text" name="registrado[direccion]" required autocomplete="off" placeholder="Tu direccion..."/>
    <label>
        Teléfono
    </label>
    <input type="text" name="registrado[telefono]" required autocomplete="off" placeholder="Tu número..."/>
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
<?php if (isset($_GET['mensaje'])) { ?>
<p>Usuario creado con éxito
<p>
    <?php } ?>


    <!-- Un enlace a la página de login. -->
<p>Volver a la página de <a href="comprobar.php">login</a>.</p>
</body>

</html>
