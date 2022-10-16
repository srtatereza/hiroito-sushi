<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Nombre de mi página</title>

    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
    <link href="home.css" rel="stylesheet">

</head>

<body>
    
<h1 class="bienvenido">Bienvenido</h1>
 <!-- Creamos un formulario para realizar el login en el sitio web. -->
        <form action="comprobar.php" method="POST" class="principal">
            <label>
                E-mail
            </label>
            <input type="email" name="registrado[email]" required autocomplete="off" placeholder="Tu email..."/>
            
            <label>
                password
            </label>
            <input id ="password" type="password" name="registrado[password]" required autocomplete="off" placeholder="Tu password..."/>
            
            <button class="mostrarContraseña" type="button" onclick="mostrarContrasena()">Mostrar password</button>

            <button type="submit" class="enviar">enviar</button>
        </form>


    <div class="register">
             <p>¿Todavía no eres usuario?
                 <a href="registro.php">Regístrate</a>
            </p>
    </div>
</div>

<?php

/* Como siempre, comprobar que venimos del formulario de login y si no, redirigir a él. */
if (!isset($_POST)) {
    header("location: registro.php");
}
$email = $_POST['registrado']['email'] ?? '';
$password = $_POST['registrado']['password'] ?? '';

/* Si llegamos aquí es porque procedemos del formulario de logueado. */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /* 1. Conexión a la base de datos. */
    require_once("dbcontroller.php");
    $db_handle = new DBController();

    /* 2. Consultamos a la base de datos. Vamos a intentar recuperar la password del usuario. Si la consulta devolviese un conjunto vacío, significaría que ni siquiera el usuario existe y tendríamos que actuar en consecuencia. */
    $sql = "SELECT contraseña FROM clientes WHERE email='$email';";
    @$resultado = $db_handle -> runQueryNoFetch($sql);

    /* Comprobamos el número de resultados de la consulta. */
    $numeroResultados = mysqli_num_rows($resultado);
    if ($numeroResultados == 0) {
        /* El usuario no existe en la base de datos. */
        ?>
        <p>El usuario no existe.</p>
        <?php
        die();
    }

    /* Si estamos aquí es porque se ha recuperado una password para el usuario. Ahora, tenemos que leerla y compararla con la password especificada en el formulario para ver si está permitido el acceso del usuario. */

    /* Recordad que el resultado de la consulta está formado por un solo registro con un solo campo que es la password. */

    $registro = mysqli_fetch_assoc($resultado);
    $passBD = $registro['contraseña'];

    /* Sólo nos quedaría comprobar que ambas password son iguales. Para ello, necesitamos la función password_verify. */
    if (password_verify($password, $passBD)) {
        session_start();
        $_SESSION['email'] = $email;
        unset($_SESSION["cart_items"]);
        header('Location: home.php');
        ?>
        <?php
        ob_start();
    } else {
        ?>
        <p>La password no es correcta. Inténtalo de nuevo.</p>
        <?php
    }
}

?>

<script>
  function mostrarContrasena(){
      var tipo = document.getElementById("password");
      console.log(tipo)
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }
</script>

</body>

</html>
