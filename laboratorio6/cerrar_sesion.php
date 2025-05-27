<?php
$cookie_existe = isset($_COOKIE["usuario_nombre"]);

if ($cookie_existe) {
    // Eliminar la cookie estableciendo el tiempo de expiración en el pasado
    setcookie("usuario_nombre", "", time() - 3600);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sesión cerrada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(182, 250, 252);
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }
        .container {
            background-color: rgb(209, 250, 255);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        p {
            color: #555;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: rgb(76, 149, 175);
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: rgb(69, 49, 179);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sesión cerrada</h1>
        <?php if ($cookie_existe): ?>
            <p>Tu sesión ha sido cerrada correctamente. La cookie ha sido eliminada.</p>
        <?php else: ?>
            <p>No hay ninguna cookie activa que eliminar.</p>
        <?php endif; ?>
        <a href="prestamolab6.php">Volver al formulario</a>
    </div>
</body>
</html>
