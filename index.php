<?php
session_start();
if (isset($_SESSION["usuario"])) {
    header("location:main.php");
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Videoclub</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php
    if (isset($_GET['error']) != null) {
        $errores = explode(",", $_GET['error']);
        $usuario = urldecode($_GET['usuario']);
        $contra = urldecode($_GET['contra']);

    }
    ?>
    <form action="login.php" method="post">
        <h1>Login Videoclub</h1>
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" value="<?php echo $usuario ?? ''; ?>">
        <label for="contrase">Contraseña:</label>
        <input type="password" name="contra" id="contra" value="<?php echo $contra ?? ''; ?>">
        </small></p>
        <?php
        if (isset($_GET['error']) != null) {

            foreach ($errores as $error) {
                echo "<p ><small style='color: red;text-align: left;'>" . $error . "</small></p>";
            }
        }
        ?>
        <input type="submit" id="btnSubmit" name="submit" value="Iniciar Sesión">
    </form>
    </body>
    </html>
    <?php
}
?>