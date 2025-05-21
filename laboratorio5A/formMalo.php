<!DOCTYPE html>
<!-- John Cuprill 8-1012-1333
    Omar Montoya 8-911-614
    Omar Garcia 8-1012-1746
    Johab Avila 8-1003-438
    Josue Moreno 8-1016-1110  -->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Recruitment Form</h1>
        
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nombre">Nombre completo:</label>
                <input type="text" id="nombre" name="nombre">
            </div>

            <div class="form-group">
                <label for="cedula">Cédula:</label>
                <input type="text" id="cedula" name="cedula">
            </div>

            <div class="form-group">
                <label for="genero">Género:</label>
                <input type="text" id="genero" name="genero">
            </div>

            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="text" id="edad" name="edad">
            </div>

            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <input type="text" id="provincia" name="provincia">
            </div>

            <div class="form-group">
                <label for="ingles">Nivel de Inglés:</label>
                <input type="text" id="ingles" name="ingles">
            </div>

            <div class="form-group">
                <label for="frances">Nivel de Francés:</label>
                <input type="text" id="frances" name="frances">
            </div>

            <div class="form-group">
                <label for="disponibilidad">Disponibilidad:</label>
                <input type="text" id="disponibilidad" name="disponibilidad">
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico:</label>
                <input type="text" id="correo" name="correo">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono">
            </div>

            <button type="submit">Enviar Solicitud</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)) {
            echo "<div style='margin-top: 20px; padding: 10px; background-color: #e8f5e9; border-radius: 4px;'>";
            echo "<h3>Datos Enviados:</h3>";
            foreach ($_GET as $key => $value) {
                echo "<p><strong>" . htmlspecialchars($key) . ":</strong> " . htmlspecialchars($value) . "</p>";
            }
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
