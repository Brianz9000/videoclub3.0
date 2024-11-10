<?php
// Inicializamos un array para almacenar los mensajes de error
$errors = [];

// Verificamos si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizamos los datos recibidos (importante para prevenir inyecciones)
    $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
    $contra = $_POST['contra']; // Asumimos que la contraseña no necesita ser sanitizada en este caso, pero es recomendable encriptada

    // Validamos los datos
    if (empty($usuario)) {
        $errors[] = 'El campo usuario es obligatorio';
    }
    if (empty($contra)) {
        $errors[] = 'El campo contrasena es obligatorio';
    }

    // Si no hay errores, procedemos a la autenticación (aquí deberías comparar con una base de datos)
    if (empty($errors)) {
        if (($usuario=="admin" && $contra=="admin") || ($usuario=="usuario" && $contra=="usuario") ) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['contra'] = $contra;
            header('Location: main.php');
            exit;
        }else{
            $errors[] = '<h3> login invalido</h3>';
        }
    }
}

// Si hay errores, redireccionamos al formulario con los errores y los valores previos
header('Location: index.php?error='
    . implode(',', $errors) . '&usuario='
    . urlencode($usuario) . '&contra='
    . urlencode($contra));
exit;