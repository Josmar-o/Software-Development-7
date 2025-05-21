<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Prestamo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color:rgb(182, 250, 252);
        }
        .form-container {
            background-color: rgb(209, 250, 255);
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
        input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
        }
        .error {
            color: rgb(175, 87, 76);
            font-size: 0.9em;
            margin-top: 5px;
        }
        button {
            background-color:rgb(76, 149, 175);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color:rgb(69, 49, 179);
            transition: ease 0.3s;
        }
        img {
            width: 60%;
            height: auto;
            margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .hidden {
            display: none;
        }
    </style>
    <script>
        function toggleFields() {
            const isExtranjero = document.getElementById('extranjero').checked;
            document.getElementById('cedula-group').classList.toggle('hidden', isExtranjero);
            document.getElementById('nacionalidad-group').classList.toggle('hidden', !isExtranjero);
            document.getElementById('pasaporte-group').classList.toggle('hidden', !isExtranjero);
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h1>Solicitud de Prestamo Interino</h1>
        <img src="logo-bg.png" alt="logo bg">
        <?php
        $errors = [];
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $isExtranjero = isset($_POST["extranjero"]) && $_POST["extranjero"] === "on";

                // Validación del nombre
                if (empty($_POST["nombre"])) {
                    throw new Exception("El nombre es requerido");
                }
                if (!preg_match("/^[a-zA-Z\s]{2,50}$/", $_POST["nombre"])) {
                    throw new Exception("El nombre debe contener solo letras y espacios (2-50 caracteres)");
                }

                if ($isExtranjero) {
                    echo "<script>document.addEventListener('DOMContentLoaded', function() { document.getElementById('extranjero').checked = true; toggleFields(); });</script>";
                    
                    // Validación de la nacionalidad
                    if (empty($_POST["nacionalidad"])) {
                        throw new Exception("La nacionalidad es requerida");
                    }
                    if (!preg_match("/^[a-zA-Z\s]{2,50}$/", $_POST["nacionalidad"])) {
                        throw new Exception("La nacionalidad debe contener solo letras y espacios (2-50 caracteres)");
                    }

                    // Validación del pasaporte
                    if (empty($_POST["pasaporte"])) {
                        throw new Exception("El pasaporte es requerido");
                    }
                    if (!preg_match("/^[a-zA-Z0-9]{5,15}$/", $_POST["pasaporte"])) {
                        throw new Exception("El pasaporte debe contener entre 5 y 15 caracteres alfanuméricos");
                    }
                } else {
                    echo "<script>document.addEventListener('DOMContentLoaded', function() { document.getElementById('extranjero').checked = false; toggleFields(); });</script>";
                    
                    // Validación de la cédula
                    if (empty($_POST["cedula"])) {
                        throw new Exception("La cédula es requerida");
                    }
                    if (!preg_match("/^\d{7,9}$/", $_POST["cedula"])) {
                        throw new Exception("La cédula debe contener entre 7 y 9 dígitos numéricos");
                    }
                }

                // Validación de la edad
                if (empty($_POST["edad"])) {
                    throw new Exception("La edad es requerida");
                }
                if (!filter_var($_POST["edad"], FILTER_VALIDATE_INT, ["options" => ["min_range" => 18, "max_range" => 90]])) {
                    throw new Exception("La edad debe estar entre 18 y 90 años");
                }
                // Validación de la profesión
                if (empty($_POST["profesion"])) {
                    throw new Exception("La profesión es requerida");
                }
                if (!preg_match("/^[a-zA-Z\s]{2,50}$/", $_POST["profesion"])) {
                    throw new Exception("La profesión debe contener solo letras y espacios (2-50 caracteres)");
                }

                
                // Validación de la cantidad de préstamo
                if (empty($_POST["cantidad_prestamo"])) {
                    throw new Exception("La cantidad de préstamo es requerida");
                }
                if (!filter_var($_POST["cantidad_prestamo"], FILTER_VALIDATE_FLOAT, ["options" => ["min_range" => 1000]])) {
                    throw new Exception("La cantidad de préstamo debe ser un número mayor o igual a 1000 USD");
                }

                // Validación del salario neto
                if (empty($_POST["salario_neto"])) {
                    throw new Exception("El salario neto es requerido");
                }
                if (!filter_var($_POST["salario_neto"], FILTER_VALIDATE_FLOAT, ["options" => ["min_range" => 500]])) {
                    throw new Exception("El salario neto debe ser un número mayor o igual a 500 USD");
                }

                // Validación de la provincia
                if (empty($_POST["provincia"])) {
                    throw new Exception("Por favor seleccione una provincia");
                }
                // Validación del correo
                if (empty($_POST["correo"])) {
                    throw new Exception("El correo electrónico es requerido");
                }
                if (!preg_match("/^[a-zA-Z0-9._%+-]+@bancogeneral\.com$/", $_POST["correo"])) {
                    throw new Exception("El correo electrónico debe pertenecer al dominio @bancogeneral.com");
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
                echo "<div style='margin-top: 20px; padding: 20px; background-color:rgb(220, 235, 254); border-radius: 8px; border: 1px solidrgb(21, 36, 97);'>";
                echo "<h3 style='color:rgb(46, 66, 125); margin-bottom: 15px;'>Datos Validados Correctamente:</h3>";
                echo "<div style='display: grid; grid-template-columns: 1fr 1fr; gap: 10px;'>";
                
                $campos = [
                    'nombre' => 'Nombre Completo',
                    'nacionalidad' => 'Nacionalidad',
                    'cedula' => 'Cédula',
                    'pasaporte' => 'Pasaporte',
                    'edad' => 'Edad',
                    'profesion' => 'Profesión',
                    'cantidad_prestamo' => 'Cantidad de Préstamo (USD)',
                    'salario_neto' => 'Salario Neto por Mes (USD)',
                    'provincia' => 'Provincia',
                    'correo' => 'Correo electrónico Institucional:',
                    'telefono' => 'Teléfono'
                    
                ];

                foreach ($campos as $key => $label) {
                    if (!empty($_POST[$key])) {
                        echo "<div style='margin-bottom: 10px;'>";
                        echo "<strong style='color: #333;'>" . $label . ":</strong><br>";
                        echo "<span style='color: #666;'>" . htmlspecialchars($_POST[$key]) . "</span>";
                        echo "</div>";
                    }
                }
                
                if (!$isExtranjero) {
                    unset($campos['nacionalidad']);
                    unset($campos['pasaporte']);
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
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" id="extranjero" name="extranjero" onclick="toggleFields()" <?php echo isset($_POST['extranjero']) ? 'checked' : ''; ?>>
                    Soy extranjero
                </label>
            </div>

            <div class="form-group" id="cedula-group">
                <label for="cedula">Cédula sin guiones:</label>
                <input type="text" id="cedula" name="cedula" value="<?php echo isset($_POST['cedula']) ? htmlspecialchars($_POST['cedula']) : ''; ?>">
            </div>

            <div class="form-group hidden" id="nacionalidad-group">
                <label for="nacionalidad">Nacionalidad:</label>
                <input type="text" id="nacionalidad" name="nacionalidad" value="<?php echo isset($_POST['nacionalidad']) ? htmlspecialchars($_POST['nacionalidad']) : ''; ?>">
            </div>

            <div class="form-group hidden" id="pasaporte-group">
                <label for="pasaporte">Pasaporte:</label>
                <input type="text" id="pasaporte" name="pasaporte" value="<?php echo isset($_POST['pasaporte']) ? htmlspecialchars($_POST['pasaporte']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" min="18" max="90" value="<?php echo isset($_POST['edad']) ? htmlspecialchars($_POST['edad']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="profesion">Profesión:</label>
                <input type="text" id="profesion" name="profesion" value="<?php echo isset($_POST['profesion']) ? htmlspecialchars($_POST['profesion']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="cantidad_prestamo">Cantidad de Préstamo (USD):</label>
                <input type="number" id="cantidad_prestamo" name="cantidad_prestamo" min="1000" step="0.01" value="<?php echo isset($_POST['cantidad_prestamo']) ? htmlspecialchars($_POST['cantidad_prestamo']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="salario_neto">Salario Neto por Mes (USD):</label>
                <input type="number" id="salario_neto" name="salario_neto" min="500" step="0.01" value="<?php echo isset($_POST['salario_neto']) ? htmlspecialchars($_POST['salario_neto']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="provincia">Provincia de Residencia:</label>
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
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico Institucional:</label>
                <input type="email" id="correo" name="correo" value="<?php echo isset($_POST['correo']) ? htmlspecialchars($_POST['correo']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono (507):</label>
                <input type="tel" id="telefono" name="telefono" placeholder="507XXXXXXXX" value="<?php echo isset($_POST['telefono']) ? htmlspecialchars($_POST['telefono']) : ''; ?>">
            </div>

            <button type="submit">Enviar Solicitud</button>
        </form>
    </div>
</body>
</html>
