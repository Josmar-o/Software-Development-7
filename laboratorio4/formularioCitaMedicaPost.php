<?php
$mensaje = '';
$clase_mensaje = '';
$errores = [];
$campos = ['nombre', 'apellido', 'email', 'telefono', 'fecha', 'hora', 'medico', 'motivo'];
$datos = array_fill_keys($campos, '');

$formulario_enviado = ($_SERVER['REQUEST_METHOD'] === 'POST');

if ($formulario_enviado) {
    // Validación de datos
    foreach ($campos as $campo) {
        $datos[$campo] = trim($_POST[$campo] ?? '');
        if ($campo !== 'motivo' && empty($datos[$campo])) {
            $errores[$campo] = ucfirst($campo) . ' es obligatorio';
        }
    }

    if (!empty($datos['email']) && !filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'Ingrese un email válido';
    }

    if (!empty($datos['telefono']) && !preg_match('/^[0-9]+$/', $datos['telefono'])) {
        $errores['telefono'] = 'El teléfono solo debe contener números';
    }

    if (empty($errores)) {
        $mostrar_confirmacion = true;
    } else {
        $mensaje = 'Por favor, corrija los errores en el formulario.';
        $clase_mensaje = 'error-mensaje';
        $mostrar_confirmacion = false;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cita Médica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color:'white' ;
        }
        .reserva-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
        }
        h1 { text-align: center; color: #2c3e50; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input, select, textarea {
            width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;
        }
        .error { color: #e74c3c; font-size: 0.9em; }
        .mensaje {
            padding: 10px; border-radius: 4px; margin-bottom: 20px;
        }
        .exito { background: #d4edda; color: #155724; }
        .error-mensaje { background: #f8d7da; color: #721c24; }
        .botones {
            display: flex; justify-content: space-between; margin-top: 20px;
        }
        button, .boton {
            padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;
        }
        button[type="submit"] { background: #2c3e50; color: #fff; }
        button[type="reset"] { background: #95a5a6; color: #fff; }
        .boton-volver { background: #7f8c8d; color: #fff; text-decoration: none; text-align: center; }
        .dato-item {
            margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #eee;
        }
        .dato-label {
            font-weight: bold; color: #2c3e50;
        }
    </style>
</head>
<body>

    <?php if ($mostrar_confirmacion ?? false): ?>
        <!-- Vista de confirmación -->
        <div class="reserva-container">
            <h1>Confirmación de Cita Médica</h1>
            <p>Su cita ha sido programada con éxito. Estos son los detalles:</p>
            
            <div class="datos-reserva">
                <div class="dato-item">
                    <span class="dato-label">Nombre completo:</span>
                    <?= htmlspecialchars($datos['nombre']) ?> <?= htmlspecialchars($datos['apellido']) ?>
                </div>
                
                <div class="dato-item">
                    <span class="dato-label">Email:</span>
                    <?= htmlspecialchars($datos['email']) ?>
                </div>
                
                <div class="dato-item">
                    <span class="dato-label">Teléfono:</span>
                    <?= htmlspecialchars($datos['telefono']) ?>
                </div>
                
                <div class="dato-item">
                    <span class="dato-label">Fecha y hora:</span>
                    <?= htmlspecialchars($datos['fecha']) ?> a las <?= htmlspecialchars($datos['hora']) ?>
                </div>
                
                <div class="dato-item">
                    <span class="dato-label">Médico:</span>
                    <?= match($datos['medico']) {
                        'dr_garcia' => 'Dr. García - Cardiología',
                        'dra_martinez' => 'Dra. Martínez - Pediatría',
                        'dr_rodriguez' => 'Dr. Rodríguez - Traumatología',
                        default => $datos['medico']
                    } ?>
                </div>
                
                <?php if (!empty($datos['motivo'])): ?>
                <div class="dato-item">
                    <span class="dato-label">Motivo de consulta:</span>
                    <?= nl2br(htmlspecialchars($datos['motivo'])) ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="botones">
                <a href="formularioCitaMedica.php" class="boton boton-volver">Nueva Cita</a>
            </div>
        </div>

    <?php else: ?>
        <!-- Vista del formulario -->
        <div class="reserva-container">
            <h1>Solicitud de Cita Médica</h1>

            <?php if ($mensaje): ?>
                <div class="mensaje <?= $clase_mensaje ?>"><?= $mensaje ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <?php
                $labels = [
                    'nombre' => 'Nombre',
                    'apellido' => 'Apellido',
                    'email' => 'Email',
                    'telefono' => 'Teléfono',
                    'fecha' => 'Fecha de la cita',
                    'hora' => 'Hora de la cita'
                ];

                foreach ($labels as $campo => $label) {
                    echo "<div class='form-group'>
                            <label for='$campo'>$label:</label>
                            <input type='" . ($campo === 'email' ? 'email' : 
                                            ($campo === 'fecha' ? 'date' : 
                                            ($campo === 'hora' ? 'time' : 'text'))) . "'
                                   id='$campo' name='$campo' value='" . htmlspecialchars($datos[$campo]) . "' required>";
                    if (isset($errores[$campo])) {
                        echo "<span class='error'>{$errores[$campo]}</span>";
                    }
                    echo "</div>";
                }
                ?>

                <div class="form-group">
                    <label for="medico">Médico:</label>
                    <select id="medico" name="medico" required>
                        <option value="">Seleccione un médico</option>
                        <option value="dr_garcia" <?= $datos['medico'] === 'dr_garcia' ? 'selected' : '' ?>>Dr. García - Cardiología</option>
                        <option value="dra_martinez" <?= $datos['medico'] === 'dra_martinez' ? 'selected' : '' ?>>Dra. Martínez - Pediatría</option>
                        <option value="dr_rodriguez" <?= $datos['medico'] === 'dr_rodriguez' ? 'selected' : '' ?>>Dr. Rodríguez - Traumatología</option>
                    </select>
                    <?php if (isset($errores['medico'])): ?>
                        <span class="error"><?= $errores['medico'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="motivo">Motivo de la consulta:</label>
                    <textarea id="motivo" name="motivo" rows="4"><?= htmlspecialchars($datos['motivo']) ?></textarea>
                </div>

                <div class="botones">
                    <button type="submit">Solicitar Cita</button>
                    <button type="reset">Limpiar</button>
                    <a class="boton boton-volver">Volver</a>
                </div>
            </form>
        </div>
    <?php endif; ?>
</body>
</html>