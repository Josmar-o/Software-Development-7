<?php
$mensaje = '';
$clase_mensaje = '';
$errores = [];
$campos = ['nombre', 'apellido', 'email', 'telefono', 'fecha_entrada', 'fecha_salida', 'tipo_habitacion', 'huespedes'];
$datos = array_fill_keys($campos, '');
$mostrar_confirmacion = false;

if (!empty($_GET)) {
    foreach ($campos as $campo) {
        $datos[$campo] = trim($_GET[$campo] ?? '');
        if ($campo !== 'huespedes' && empty($datos[$campo])) {
            $errores[$campo] = ucfirst(str_replace('_', ' ', $campo)) . ' es obligatorio';
        }
    }

    if (!empty($datos['email']) && !filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'Ingrese un email válido';
    }

    if (!empty($datos['fecha_entrada']) && !empty($datos['fecha_salida']) && $datos['fecha_entrada'] >= $datos['fecha_salida']) {
        $errores['fecha_salida'] = 'La fecha de salida debe ser posterior a la de entrada';
    }
    
    if (!empty($datos['huespedes']) && $datos['huespedes'] <= 0) {
        $errores['huespedes'] = 'El número de huéspedes debe ser al menos 1';
    }
    
    if (!empty($datos['telefono']) && !preg_match('/^[0-9]+$/', $datos['telefono'])) {
        $errores['telefono'] = 'El teléfono solo debe contener números';
    }

    if (empty($errores)) {
        $mostrar_confirmacion = true;
    } else {
        $mensaje = 'Por favor, corrija los errores en el formulario.';
        $clase_mensaje = 'error-mensaje';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $mostrar_confirmacion ? 'Confirmación de Reserva' : 'Solicitud de Reserva de Hotel' ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: 'white';
        }
        .reserva-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 'none';
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

<?php if ($mostrar_confirmacion): ?>
    <!-- Vista de Confirmación -->
    <div class="reserva-container">
        <h1>Confirmación de Reserva</h1>
        <div class="mensaje exito">¡Reserva de hotel solicitada con éxito!</div>
        
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
                <span class="dato-label">Fechas de estadía:</span>
                Del <?= htmlspecialchars($datos['fecha_entrada']) ?> al <?= htmlspecialchars($datos['fecha_salida']) ?>
            </div>
            
            <div class="dato-item">
                <span class="dato-label">Tipo de habitación:</span>
                <?= match($datos['tipo_habitacion']) {
                    'individual' => 'Individual',
                    'doble' => 'Doble',
                    'suite' => 'Suite',
                    'familiar' => 'Familiar',
                    default => htmlspecialchars($datos['tipo_habitacion'])
                } ?>
            </div>
            
            <div class="dato-item">
                <span class="dato-label">Número de huéspedes:</span>
                <?= htmlspecialchars($datos['huespedes']) ?>
            </div>
        </div>
        
        <div class="botones">
            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="boton boton-volver">Nueva Reserva</a>
        </div>
    </div>

<?php else: ?>
    <!-- Vista del Formulario -->
    <div class="reserva-container">
        <h1>Reserva de Hotel</h1>

        <?php if ($mensaje): ?>
            <div class="mensaje <?= $clase_mensaje ?>"><?= $mensaje ?></div>
        <?php endif; ?>

        <form method="get" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <?php
            $labels = [
                'nombre' => 'Nombre',
                'apellido' => 'Apellido',
                'email' => 'Email',
                'telefono' => 'Teléfono',
                'fecha_entrada' => 'Fecha de entrada',
                'fecha_salida' => 'Fecha de salida'
            ];

            foreach ($labels as $campo => $label) {
                echo "<div class='form-group'>
                        <label for='$campo'>$label:</label>
                        <input type='" . ($campo === 'email' ? 'email' : 
                                        ($campo === 'fecha_entrada' || $campo === 'fecha_salida' ? 'date' : 'text')) . "'
                               id='$campo' name='$campo' value='" . htmlspecialchars($datos[$campo]) . "' required>";
                if (isset($errores[$campo])) {
                    echo "<span class='error'>{$errores[$campo]}</span>";
                }
                echo "</div>";
            }
            ?>
            
            <div class='form-group'>
                <label for='huespedes'>Número de huéspedes:</label>
                <input type='number' id='huespedes' name='huespedes' 
                       value='<?= htmlspecialchars($datos['huespedes'] ?? '1') ?>' 
                       min='1' max='10'>
                <?php if (isset($errores['huespedes'])): ?>
                    <span class='error'><?= $errores['huespedes'] ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="tipo_habitacion">Tipo de habitación:</label>
                <select id="tipo_habitacion" name="tipo_habitacion" required>
                    <option value="">Seleccione un tipo</option>
                    <option value="individual" <?= $datos['tipo_habitacion'] === 'individual' ? 'selected' : '' ?>>Individual</option>
                    <option value="doble" <?= $datos['tipo_habitacion'] === 'doble' ? 'selected' : '' ?>>Doble</option>
                    <option value="suite" <?= $datos['tipo_habitacion'] === 'suite' ? 'selected' : '' ?>>Suite</option>
                    <option value="familiar" <?= $datos['tipo_habitacion'] === 'familiar' ? 'selected' : '' ?>>Familiar</option>
                </select>
                <?php if (isset($errores['tipo_habitacion'])): ?>
                    <span class="error"><?= $errores['tipo_habitacion'] ?></span>
                <?php endif; ?>
            </div>

            <div class="botones">
                <button type="submit">Solicitar Reserva</button>
                <button type="reset">Limpiar</button>
                <a  class="boton boton-volver">Volver</a>
            </div>
        </form>
    </div>
<?php endif; ?>

</body>
</html>