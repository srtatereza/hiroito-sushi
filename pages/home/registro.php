<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Registro de usuarios</title>

    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
    <link href="home.css" rel="stylesheet">

</head>

<body>

<h1 class="bienvenido">Registro de usuario</h1>

<form action="registro.php" method="POST" class="principal">
    <label>
        Nombre
    </label>
    <input  type="text" name="registrado[nombre]" required autocomplete="off" placeholder="Tu nombre..."/>
    
    <label>
        Apellidos
    </label>
    <input type="text" name="registrado[apellido]" required autocomplete="off" placeholder="Tus apellidos..."/>
   
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
    <input type="password" name="registrado[contraseña]" required autocomplete="off" placeholder="Tu contraseña..."/>

    <button type="submit" class="enviar">enviar</button>
</form>
<?php if (isset($_GET['mensaje'])) { ?>
<p>Usuario REGISTRADO con éxito. <a href="comprobar.php">Iniciar Sesion</a>.</p>
<p>
    <?php } ?>

<div class="conoce">Conoce Mis Productos . <a href="index.php">Tienda</a></div>

</body>
</html>




<?php

/* En primer lugar, comprobaremos que venimos del formulario de registro y no por entrada directa, en cuyo caso, redirigiríamos al formulario de registro. */
if (!isset($_POST)) {
    header("location: registro.php");
}


/* Si llegamos aquí es porque existen datos de usuario para registrar. */

$nombre = $_POST['registrado']['nombre'] ?? '';
$apellido = $_POST['registrado']['apellido'] ?? '';
$direccion = $_POST['registrado']['direccion'] ?? '';
$telefono = $_POST['registrado']['telefono'] ?? '';
$email = $_POST['registrado']['email'] ?? '';
$password = $_POST['registrado']['contraseña'] ?? '';

/* A continuación, encriptamos la contraseña. Lo más sencillo es utilizar el método crypt() Requiere un valor de salt según los requisitos de Blowfish (que es nuestro método de encriptación). Empezaremos por $2y$, seguido de un número entre 04 y 31 y una cadena que hace de salt escrita entre símbolos de dólar ($). */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = "08";
    $fecha = time();
    $cadena = uniqid((string)$fecha, true);
    $salt = "$2y$" . $numero . "$" . $cadena . "$";
    /* Encriptamos la contraseña. */
    $passEncriptada = crypt($password, $salt);

    /* Ahora, vamos a introducir los datos de usuario y contraseña en la base de datos. */
    require_once("dbcontroller.php");
    $db_handle = new DBController();

    /* Antes de insertar el registro en la base de datos tendríamos que comprobar que no exista ya un usuario con el mismo nombre. */
    $sqlConsulta = "SELECT * FROM clientes WHERE email = '$email';";

    /* Si ejecutamos la consulta y obtenemos algún registro es porque el usuario ya existe. Tendríamos que parar el proceso. */
    $numeroUsuario = $db_handle -> numRows($sqlConsulta);

    if ($numeroUsuario > 0) {
        /* El usuario ya existe. */
        ?>
        <p>No se puede registrar con ese nombre de usuario. Ya existe.</p>
        <?php
        die();
    }

    /* 2. Ejecución de la consulta. */
    /* Primero, preparamos la consulta. */
    if ($_POST) {
        $sql = "INSERT INTO clientes (nombre,apellido,direccion,telefono,email,contraseña) VALUES ('$nombre','$apellido','$direccion', '$telefono','$email','$passEncriptada');";

        /* Ejecuto la consulta. */
        @$resultado = $db_handle -> runQueryNoFetch($sql);
        header('Location: registro.php?mensaje=1');
    }
}

?>
