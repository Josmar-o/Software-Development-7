<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['career'] = $_POST['career'];
        $_SESSION['semester'] = $_POST['semester'];
    } elseif (isset($_POST['delete_name'])) {
        unset($_SESSION['name']);
    } elseif (isset($_POST['delete_career'])) {
        unset($_SESSION['career']);
    } elseif (isset($_POST['delete_semester'])) {
        unset($_SESSION['semester']);
    } elseif (isset($_POST['destroy_session'])) {
        session_destroy();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('fachada_utp_2.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 160px;
            z-index: 1000;
        }

        h1 {
            text-align: center;
            color: #5B2C6F;
            background-color: rgba(255, 255, 255, 0.9);
            margin: 0;
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: 40px auto;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #5B2C6F;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px 16px;
            margin: 5px 3px 0 0;
            background-color: #5B2C6F;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4a235a;
        }

        .panel {
            max-width: 600px;
            margin: 20px auto;
            background-color: rgba(91, 44, 111, 0.9);
            padding: 20px;
            border-radius: 10px;
            color: #fff;
        }

        .panel h2 {
            margin-top: 0;
            text-align: center;
        }

        @media (max-width: 600px) {
            .logo {
                width: 120px;
                top: 10px;
                left: 10px;
            }

            form, .panel {
                margin: 20px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<img src="logoutp.png" alt="Logo UTP" class="logo">
<h1>Perfil</h1>

<form method="POST">
    <div class="form-group">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''; ?>">
    </div>
    <div class="form-group">
        <label for="career">Carrera:</label>
        <select id="career" name="career">
            <option value="">Seleccione una carrera</option>
            <?php
            $carreras = [
                "Licenciatura en Ingeniería de Sistemas de Información",
                "Licenciatura en Ingeniería de Sistemas de Información Gerencial",
                "Licenciatura en Ingeniería de Sistemas y Computación",
                "Licenciatura en Ingeniería de Software",
                "Licenciatura en Ciberseguridad",
                "Licenciatura en Ciencias de la Computación",
                "Licenciatura en Desarrollo y Gestión de Software",
                "Licenciatura en Informática Aplicada a la Educación",
                "Licenciatura en Redes Informáticas",
                "Técnico en Informática para la Gestión Empresarial",
                "Licenciatura en Ingeniería Ambiental",
                "Licenciatura en Ingeniería Industrial",
                "Licenciatura en Ingeniería Mecánica",
                "Licenciatura en Ingeniería Electrónica y Telecomunicaciones",
                "Licenciatura en Ingeniería Civil",
                "Licenciatura en Ingeniería Eléctrica"
            ];
            foreach ($carreras as $carrera) {
                $selected = (isset($_SESSION['career']) && $_SESSION['career'] === $carrera) ? 'selected' : '';
                echo "<option value=\"$carrera\" $selected>$carrera</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="semester">Semestre:</label>
        <input type="text" id="semester" name="semester" value="<?php echo isset($_SESSION['semester']) ? htmlspecialchars($_SESSION['semester']) : ''; ?>">
    </div>
    <button type="submit" name="save">Guardar</button>
    <button type="submit" name="delete_name">Eliminar Nombre</button>
    <button type="submit" name="delete_career">Eliminar Carrera</button>
    <button type="submit" name="delete_semester">Eliminar Semestre</button>
    <button type="submit" name="destroy_session">Destruir Sesión</button>
</form>

<?php if (!empty($_SESSION)): ?>
    <div class="panel">
        <h2>Datos Guardados</h2>
        <p>Nombre: <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'No definido'; ?></p>
        <p>Carrera: <?php echo isset($_SESSION['career']) ? htmlspecialchars($_SESSION['career']) : 'No definida'; ?></p>
        <p>Semestre: <?php echo isset($_SESSION['semester']) ? htmlspecialchars($_SESSION['semester']) : 'No definido'; ?></p>
    </div>
<?php endif; ?>

</body>
</html>
