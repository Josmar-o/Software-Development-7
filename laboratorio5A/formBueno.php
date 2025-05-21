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
            margin-top: 20px;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
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
        <?php
        $errors = [];
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                // Validación del nombre
                if (empty($_POST["nombre"])) {
                    throw new Exception("El nombre es requerido");
                }
                if (!preg_match("/^[a-zA-Z\s]{2,50}$/", $_POST["nombre"])) {
                    throw new Exception("El nombre debe contener solo letras y espacios (2-50 caracteres)");
                }

                // Validación de la cédula
                if (empty($_POST["cedula"])) {
                    throw new Exception("La cédula es requerida");
                }
                if (!preg_match("/^\d{8,12}$/", $_POST["cedula"])) {
                    throw new Exception("La cédula debe contener entre 8 y 12 dígitos");
                }

                // Validación del género
                if (empty($_POST["genero"])) {
                    throw new Exception("Por favor seleccione un género");
                }

                // Validación de la edad
                if (empty($_POST["edad"])) {
                    throw new Exception("La edad es requerida");
                }
                if (!filter_var($_POST["edad"], FILTER_VALIDATE_INT, ["options" => ["min_range" => 18, "max_range" => 65]])) {
                    throw new Exception("La edad debe estar entre 18 y 65 años");
                }

                // Validación de la provincia
                if (empty($_POST["provincia"])) {
                    throw new Exception("Por favor seleccione una provincia");
                }

                // Validación del nivel de inglés
                if (empty($_POST["ingles"])) {
                    throw new Exception("Por favor seleccione un nivel de inglés");
                }

                // Validación del nivel de francés
                if (empty($_POST["frances"])) {
                    throw new Exception("Por favor seleccione un nivel de francés");
                }

                // Validación de la disponibilidad
                if (empty($_POST["disponibilidad"])) {
                    throw new Exception("Por favor seleccione su disponibilidad");
                }

                // Validación del correo
                if (empty($_POST["correo"])) {
                    throw new Exception("El correo electrónico es requerido");
                }
                if (!filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Por favor ingrese un correo electrónico válido");
                }

                // Validación del teléfono
                if (empty($_POST["telefono"])) {
                    throw new Exception("El teléfono es requerido");
                }
                if (!preg_match("/^507\d{8}$/", $_POST["telefono"])) {
                    throw new Exception("El teléfono debe comenzar con 507 seguido de 8 dígitos");
                }

                // Si llegamos aquí, todas las validaciones pasaron
                echo "<div style='margin-top: 20px; padding: 20px; background-color: #e8f5e9; border-radius: 8px; border: 1px solid #4CAF50;'>";
                echo "<h3 style='color: #2e7d32; margin-bottom: 15px;'>Datos Validados Correctamente:</h3>";
                echo "<div style='display: grid; grid-template-columns: 1fr 1fr; gap: 10px;'>";
                
                $campos = [
                    'nombre' => 'Nombre Completo',
                    'cedula' => 'Cédula',
                    'genero' => 'Género',
                    'edad' => 'Edad',
                    'provincia' => 'Provincia',
                    'ingles' => 'Nivel de Inglés',
                    'frances' => 'Nivel de Francés',
                    'disponibilidad' => 'Disponibilidad',
                    'correo' => 'Correo Electrónico',
                    'telefono' => 'Teléfono'
                ];

                foreach ($campos as $key => $label) {
                    echo "<div style='margin-bottom: 10px;'>";
                    echo "<strong style='color: #333;'>" . $label . ":</strong><br>";
                    echo "<span style='color: #666;'>" . htmlspecialchars($_POST[$key]) . "</span>";
                    echo "</div>";
                }
                
                echo "</div>";
                echo "</div>";

            } catch (Exception $e) {
                $errors[] = $e->getMessage();
                echo "<div style='color: red; margin: 10px 0; padding: 10px; background-color: #ffebee; border-radius: 4px; border: 1px solid #ffcdd2;'>";
                echo "<strong>Error:</strong> " . $e->getMessage();
                echo "</div>";
            }
        }
        ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nombre">Nombre completo:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
                <?php if (isset($errors["nombre"])) echo "<div class='error'>" . $errors["nombre"] . "</div>"; ?>
            </div>

            <div class="form-group">
                <label for="cedula">Cédula:</label>
                <input type="text" id="cedula" name="cedula" value="<?php echo isset($_POST['cedula']) ? htmlspecialchars($_POST['cedula']) : ''; ?>">
                <?php if (isset($errors["cedula"])) echo "<div class='error'>" . $errors["cedula"] . "</div>"; ?>
            </div>

            <div class="form-group">
                <label for="genero">Género:</label>
                <select id="genero" name="genero">
                    <option value="">Seleccione...</option>
                    <option value="masculino" <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'masculino') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="femenino" <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'femenino') ? 'selected' : ''; ?>>Femenino</option>
                    <option value="otro" <?php echo (isset($_POST['genero']) && $_POST['genero'] == 'otro') ? 'selected' : ''; ?>>Otro</option>
                </select>
                <?php if (isset($errors["genero"])) echo "<div class='error'>" . $errors["genero"] . "</div>"; ?>
            </div>

            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" min="18" max="65" value="<?php echo isset($_POST['edad']) ? htmlspecialchars($_POST['edad']) : ''; ?>">
                <?php if (isset($errors["edad"])) echo "<div class='error'>" . $errors["edad"] . "</div>"; ?>
            </div>

            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <select id="provincia" name="provincia">
                    <option value="">Seleccione...</option>
                    <option value="panama" <?php echo (isset($_POST['provincia']) && $_POST['provincia'] == 'panama') ? 'selected' : ''; ?>>Panamá</option>
                    <option value="panama_oeste" <?php echo (isset($_POST['provincia']) && $_POST['provincia'] == 'panama_oeste') ? 'selected' : ''; ?>>Panamá Oeste</option>
                    <option value="colon" <?php echo (isset($_POST['provincia']) && $_POST['provincia'] == 'colon') ? 'selected' : ''; ?>>Colón</option>
                    <option value="chiriqui" <?php echo (isset($_POST['provincia']) && $_POST['provincia'] == 'chiriqui') ? 'selected' : ''; ?>>Chiriquí</option>
                    <option value="veraguas" <?php echo (isset($_POST['provincia']) && $_POST['provincia'] == 'veraguas') ? 'selected' : ''; ?>>Veraguas</option>
                    <option value="cocle" <?php echo (isset($_POST['provincia']) && $_POST['provincia'] == 'cocle') ? 'selected' : ''; ?>>Coclé</option>
                    <option value="herrera" <?php echo (isset($_POST['provincia']) && $_POST['provincia'] == 'herrera') ? 'selected' : ''; ?>>Herrera</option>
                    <option value="los_santos" <?php echo (isset($_POST['provincia']) && $_POST['provincia'] == 'los_santos') ? 'selected' : ''; ?>>Los Santos</option>
                    <option value="darien" <?php echo (isset($_POST['provincia']) && $_POST['provincia'] == 'darien') ? 'selected' : ''; ?>>Darién</option>
                    <option value="bocas_del_toro" <?php echo (isset($_POST['provincia']) && $_POST['provincia'] == 'bocas_del_toro') ? 'selected' : ''; ?>>Bocas del Toro</option>
                </select>
                <?php if (isset($errors["provincia"])) echo "<div class='error'>" . $errors["provincia"] . "</div>"; ?>
            </div>

            <div class="form-group">
                <label for="ingles">Nivel de Inglés:</label>
                <select id="ingles" name="ingles">
                    <option value="">Seleccione...</option>
                    <option value="basico" <?php echo (isset($_POST['ingles']) && $_POST['ingles'] == 'basico') ? 'selected' : ''; ?>>Básico</option>
                    <option value="intermedio" <?php echo (isset($_POST['ingles']) && $_POST['ingles'] == 'intermedio') ? 'selected' : ''; ?>>Intermedio</option>
                    <option value="avanzado" <?php echo (isset($_POST['ingles']) && $_POST['ingles'] == 'avanzado') ? 'selected' : ''; ?>>Avanzado</option>
                    <option value="nativo" <?php echo (isset($_POST['ingles']) && $_POST['ingles'] == 'nativo') ? 'selected' : ''; ?>>Nativo</option>
                </select>
                <?php if (isset($errors["ingles"])) echo "<div class='error'>" . $errors["ingles"] . "</div>"; ?>
            </div>

            <div class="form-group">
                <label for="frances">Nivel de Francés:</label>
                <select id="frances" name="frances">
                    <option value="">Seleccione...</option>
                    <option value="basico" <?php echo (isset($_POST['frances']) && $_POST['frances'] == 'basico') ? 'selected' : ''; ?>>Básico</option>
                    <option value="intermedio" <?php echo (isset($_POST['frances']) && $_POST['frances'] == 'intermedio') ? 'selected' : ''; ?>>Intermedio</option>
                    <option value="avanzado" <?php echo (isset($_POST['frances']) && $_POST['frances'] == 'avanzado') ? 'selected' : ''; ?>>Avanzado</option>
                    <option value="nativo" <?php echo (isset($_POST['frances']) && $_POST['frances'] == 'nativo') ? 'selected' : ''; ?>>Nativo</option>
                </select>
                <?php if (isset($errors["frances"])) echo "<div class='error'>" . $errors["frances"] . "</div>"; ?>
            </div>

            <div class="form-group">
                <label for="disponibilidad">Disponibilidad:</label>
                <select id="disponibilidad" name="disponibilidad">
                    <option value="">Seleccione...</option>
                    <option value="tiempo_completo" <?php echo (isset($_POST['disponibilidad']) && $_POST['disponibilidad'] == 'tiempo_completo') ? 'selected' : ''; ?>>Tiempo Completo</option>
                    <option value="medio_tiempo" <?php echo (isset($_POST['disponibilidad']) && $_POST['disponibilidad'] == 'medio_tiempo') ? 'selected' : ''; ?>>Medio Tiempo</option>
                    <option value="por_proyecto" <?php echo (isset($_POST['disponibilidad']) && $_POST['disponibilidad'] == 'por_proyecto') ? 'selected' : ''; ?>>Por Proyecto</option>
                </select>
                <?php if (isset($errors["disponibilidad"])) echo "<div class='error'>" . $errors["disponibilidad"] . "</div>"; ?>
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" value="<?php echo isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : ''; ?>">
                <?php if (isset($errors["correo"])) echo "<div class='error'>" . $errors["correo"] . "</div>"; ?>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono (507):</label>
                <input type="tel" id="telefono" name="telefono" placeholder="507XXXXXXXX" value="<?php echo isset($_POST['telefono']) ? htmlspecialchars($_POST['telefono']) : ''; ?>">
                <?php if (isset($errors["telefono"])) echo "<div class='error'>" . $errors["telefono"] . "</div>"; ?>
            </div>

            <button type="submit">Enviar Solicitud</button>
        </form>
    </div>
</body>
</html>
