<?php
// Verificar si existe la cookie
if (!isset($_COOKIE["usuario_nombre"])) {
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Cookie no encontrada</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: rgb(182, 250, 252);
                padding: 50px;
                text-align: center;
            }
            a {
                color: rgb(76, 149, 175);
                text-decoration: none;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <h2>No hay ninguna cookie activa.</h2>
        <p><a href='prestamolab6.php'>Volver al formulario</a></p>
    </body>
    </html>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
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
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: white;
            margin: 10px 0;
            padding: 10px;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            color: #555;
        }
        button {
            background-color: rgb(76, 149, 175);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            margin-top: 30px;
        }
        button:hover {
            background-color: rgb(69, 49, 179);
            transition: ease 0.3s;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido, <?php echo htmlspecialchars($_COOKIE["usuario_nombre"]); ?>!</h1>
        <p style="text-align: center;">Gracias por enviar tu solicitud.</p>

        <h2>Cookies disponibles:</h2>
        <ul>
            <?php
            foreach ($_COOKIE as $clave => $valor) {
                echo "<li><strong>$clave:</strong> " . htmlspecialchars($valor) . "</li>";
            }
            ?>
        </ul>

        <form action="cerrar_sesion.php" method="post">
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>
</body>
</html>
