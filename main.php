<?php
session_start();
$usuario=$_SESSION['usuario'];
echo "<h2>Bienvenido ". $usuario ." al video club</h2>";