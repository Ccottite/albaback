<?php
error_reporting(E_ERROR | E_PARSE);

$mysqli = new mysqli("localhost", "root", "", "alba");
if ($mysqli->connect_errno) {
    echo "Error al conectarse con My SQL debido al error" . $mysqli->connect_error;
};


session_start();

$correo = $_POST['correo'];
$password = $_POST['password'];

$usuarios = $mysqli->query("SELECT * FROM usuarios Where correo='" . $correo . "' AND password='" . $password . "'");
if ($usuarios->num_rows == 1) :
    $datos = $usuarios->fetch_assoc();

    $_SESSION['usuario'] = $datos;

    if ($datos['rol_id'] == true) {
        switch ($datos['rol_id']) {
            case 1;
                echo ("<script> window.location='CRUD/views/admin.php'; </script>");
                break;

            case 2;
                echo ("<script> window.location='CRUD/views/secretaria_admin.php'; </script>");
                break;

            case 3;
                echo ("<script> window.location='CRUD/views/usuarios_admin.php'; </script>");
                break;

            default:
        }
    } else {
        echo "<div></div>";
    }



else :

//si no se ejecuta, te muestra que hay un error
endif;

$mysqli->close();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/loginstyle.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,600,0,0" />
    <link rel="shortcut icon" href="img/ALBA_WEB_ELEMENTS-01.png" type="image/x-icon">
    <title>Alba - Entrar o registrarse</title>
</head>

<body>

    <div class="login-card-container">
        <div class="login-card">
            <div class="login-card-logo">
                <img src="img/ALBA_WEB_ELEMENTS-01.png" alt="logo">
            </div>
            <div class="login-card-header">
                <h1>Inicia Sesión</h1>
                <div>recuerda colocar los datos correctos</div>
            </div>
            <form class="login-card-form" action="" method="POST">
                <div class="form-item">
                    <span class="form-item-icon material-symbols-rounded"></span>
                    <input type="text" placeholder="Correo" id="emailForm" name="correo" autofocus required>
                </div>
                <div class="form-item">
                    <span class="form-item-icon material-symbols-rounded"></span>
                    <input type="password" placeholder="Contraseña" id="passwordForm" name="password" required>
                </div>
                <div class="form-item-other">
                    <div class="checkbox">
                        <input type="checkbox" id="rememberMeCheckbox" checked>
                        <label for="rememberMeCheckbox">Recordame</label>
                    </div>
                    <a href="#">Olvide mi contraseña</a>
                </div>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <div class="login-card-footer">
                ¿No tienes una cuenta? <a href="#">Registrate</a>
            </div>
        </div>
    </div>

</body>

</html>