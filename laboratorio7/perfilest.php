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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color:rgb(229, 183, 222);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #fff;
            font-weight: bold;  
        }
        p{
            label {
            display: block;
            margin-bottom: 5px;
            color:rgb(255, 255, 255);
            font-weight: bold;  
        }
        }
        
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #681A5D;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .panel {
            max-width: 700px;
            border: 1px solid #ccc;
            padding: 15px;
            margin: 0 auto;
            background-color: #681A5D;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h1>Perfil</h1>
    <img src="logoutp.png" alt="">
    <form method="POST">
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="career">Carrera:</label>
            <select id="career" name="career" >
                <option value="Licenciatura en Ingeniería de Sistemas de Información" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería de Sistemas de Información') ? 'selected' : ''; ?>>Licenciatura en Ingeniería de Sistemas de Información</option>
                <option value="Licenciatura en Ingeniería de Sistemas de Información Gerencial" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería de Sistemas de Información Gerencial') ? 'selected' : ''; ?>>Licenciatura en Ingeniería de Sistemas de Información Gerencial</option>
                <option value="Licenciatura en Ingeniería de Sistemas y Computación" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería de Sistemas y Computación') ? 'selected' : ''; ?>>Licenciatura en Ingeniería de Sistemas y Computación</option>
                <option value="Licenciatura en Ingeniería de Software" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería de Software') ? 'selected' : ''; ?>>Licenciatura en Ingeniería de Software</option>
                <option value="Licenciatura en Ciberseguridad" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ciberseguridad') ? 'selected' : ''; ?>>Licenciatura en Ciberseguridad</option>
                <option value="Licenciatura en Ciencias de la Computación" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ciencias de la Computación') ? 'selected' : ''; ?>>Licenciatura en Ciencias de la Computación</option>
                <option value="Licenciatura en Desarrollo y Gestión de Software" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Desarrollo y Gestión de Software') ? 'selected' : ''; ?>>Licenciatura en Desarrollo y Gestión de Software</option>
                <option value="Licenciatura en Informática Aplicada a la Educación" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Informática Aplicada a la Educación') ? 'selected' : ''; ?>>Licenciatura en Informática Aplicada a la Educación</option>
                <option value="Licenciatura en Redes Informáticas" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Redes Informáticas') ? 'selected' : ''; ?>>Licenciatura en Redes Informáticas</option>
                <option value="Técnico en Informática para la Gestión Empresarial" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Técnico en Informática para la Gestión Empresarial') ? 'selected' : ''; ?>>Técnico en Informática para la Gestión Empresarial</option>
                <option value="Licenciatura en Ingeniería en Administración de Proyectos de Construcción" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería en Administración de Proyectos de Construcción') ? 'selected' : ''; ?>>Licenciatura en Ingeniería en Administración de Proyectos de Construcción</option>
                <option value="Licenciatura en Ingeniería Ambiental" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Ambiental') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Ambiental</option>
                <option value="Licenciatura en Ingeniería Civil" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Civil') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Civil</option>
                <option value="Licenciatura en Ingeniería Geológica" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Geológica') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Geológica</option>
                <option value="Licenciatura en Ingeniería Geomática" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Geomática') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Geomática</option>
                <option value="Licenciatura en Ingeniería Marítima Portuaria" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Marítima Portuaria') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Marítima Portuaria</option>
                <option value="Licenciatura en Dibujo Automatizado" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Dibujo Automatizado') ? 'selected' : ''; ?>>Licenciatura en Dibujo Automatizado</option>
                <option value="Licenciatura en Edificaciones" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Edificaciones') ? 'selected' : ''; ?>>Licenciatura en Edificaciones</option>
                <option value="Licenciatura en Operaciones Marítimas y Portuarias" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Operaciones Marítimas y Portuarias') ? 'selected' : ''; ?>>Licenciatura en Operaciones Marítimas y Portuarias</option>
                <option value="Licenciatura en Saneamiento y Ambiente" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Saneamiento y Ambiente') ? 'selected' : ''; ?>>Licenciatura en Saneamiento y Ambiente</option>
                <option value="Licenciatura en Topografía" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Topografía') ? 'selected' : ''; ?>>Licenciatura en Topografía</option>
                <option value="Licenciatura en Ingeniería Eléctrica" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Eléctrica') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Eléctrica</option>
                <option value="Licenciatura en Ingeniería Eléctrica y Electrónica" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Eléctrica y Electrónica') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Eléctrica y Electrónica</option>
                <option value="Licenciatura en Ingeniería Electromecánica" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Electromecánica') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Electromecánica</option>
                <option value="Licenciatura en Ingeniería Electrónica y Telecomunicaciones" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Electrónica y Telecomunicaciones') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Electrónica y Telecomunicaciones</option>
                <option value="Técnico en Ingeniería con especialización en Electrónica Biomédica" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Técnico en Ingeniería con especialización en Electrónica Biomédica') ? 'selected' : ''; ?>>Técnico en Ingeniería con especialización en Electrónica Biomédica</option>
                <option value="Técnico en Ingeniería con especialización en Sistemas Eléctricos" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Técnico en Ingeniería con especialización en Sistemas Eléctricos') ? 'selected' : ''; ?>>Técnico en Ingeniería con especialización en Sistemas Eléctricos</option>
                <option value="Técnico en Ingeniería con especialización en Telecomunicaciones" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Técnico en Ingeniería con especialización en Telecomunicaciones') ? 'selected' : ''; ?>>Técnico en Ingeniería con especialización en Telecomunicaciones</option>
                <option value="Licenciatura en Ingeniería Industrial" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Industrial') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Industrial</option>
                <option value="Licenciatura en Ingeniería Logística y Cadena de Suministro" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Logística y Cadena de Suministro') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Logística y Cadena de Suministro</option>
                <option value="Licenciatura en Ingeniería Mecánica Industrial" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Mecánica Industrial') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Mecánica Industrial</option>
                <option value="Licenciatura en Ingeniería en Seguridad Industrial e Higiene Ocupacional" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería en Seguridad Industrial e Higiene Ocupacional') ? 'selected' : ''; ?>>Licenciatura en Ingeniería en Seguridad Industrial e Higiene Ocupacional</option>
                <option value="Licenciatura en Gestión Administrativa" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Gestión Administrativa') ? 'selected' : ''; ?>>Licenciatura en Gestión Administrativa</option>
                <option value="Licenciatura en Gestión de la Producción Industrial" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Gestión de la Producción Industrial') ? 'selected' : ''; ?>>Licenciatura en Gestión de la Producción Industrial</option>
                <option value="Licenciatura en Logística y Transporte Multimodal" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Logística y Transporte Multimodal') ? 'selected' : ''; ?>>Licenciatura en Logística y Transporte Multimodal</option>
                <option value="Licenciatura en Mercadeo y Negocios Internacionales" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Mercadeo y Negocios Internacionales') ? 'selected' : ''; ?>>Licenciatura en Mercadeo y Negocios Internacionales</option>
                <option value="Licenciatura en Recursos Humanos y Gestión de la Productividad" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Recursos Humanos y Gestión de la Productividad') ? 'selected' : ''; ?>>Licenciatura en Recursos Humanos y Gestión de la Productividad</option>
                <option value="Licenciatura en Ingeniería Aeronáutica" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Aeronáutica') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Aeronáutica</option>
                <option value="Licenciatura en Ingeniería de Energía y Ambiente" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería de Energía y Ambiente') ? 'selected' : ''; ?>>Licenciatura en Ingeniería de Energía y Ambiente</option>
                <option value="Licenciatura en Ingeniería de Mantenimiento" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería de Mantenimiento') ? 'selected' : ''; ?>>Licenciatura en Ingeniería de Mantenimiento</option>
                <option value="Licenciatura en Ingeniería Mecánica" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Mecánica') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Mecánica</option>
                <option value="Licenciatura en Ingeniería Naval" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Naval') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Naval</option>
                <option value="Licenciatura en Administración de Aviación" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Administración de Aviación') ? 'selected' : ''; ?>>Licenciatura en Administración de Aviación</option>
                <option value="Licenciatura en Administración de Aviación con opción a vuelo (Piloto)" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Administración de Aviación con opción a vuelo (Piloto)') ? 'selected' : ''; ?>>Licenciatura en Administración de Aviación con opción a vuelo (Piloto)</option>
                <option value="Licenciatura en Mecánica Automotriz" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Mecánica Automotriz') ? 'selected' : ''; ?>>Licenciatura en Mecánica Automotriz</option>
                <option value="Licenciatura en Mecánica Industrial" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Mecánica Industrial') ? 'selected' : ''; ?>>Licenciatura en Mecánica Industrial</option>
                <option value="Licenciatura en Refrigeración y Aire Acondicionado" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Refrigeración y Aire Acondicionado') ? 'selected' : ''; ?>>Licenciatura en Refrigeración y Aire Acondicionado</option>
                <option value="Licenciatura en Soldadura" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Soldadura') ? 'selected' : ''; ?>>Licenciatura en Soldadura</option>
                <option value="Técnico en Despacho de Vuelo" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Técnico en Despacho de Vuelo') ? 'selected' : ''; ?>>Técnico en Despacho de Vuelo</option>
                <option value="Técnico en Ingeniería de Mantenimiento de Aeronaves con especialización en Motores y Fuselajes" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Técnico en Ingeniería de Mantenimiento de Aeronaves con especialización en Motores y Fuselajes') ? 'selected' : ''; ?>>Técnico en Ingeniería de Mantenimiento de Aeronaves con especialización en Motores y Fuselajes</option>
                <option value="Licenciatura en Ingeniería en Alimentos" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería en Alimentos') ? 'selected' : ''; ?>>Licenciatura en Ingeniería en Alimentos</option>
                <option value="Licenciatura en Ingeniería Forestal" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Ingeniería Forestal') ? 'selected' : ''; ?>>Licenciatura en Ingeniería Forestal</option>
                <option value="Licenciatura en Comunicación Ejecutiva Bilingüe" <?php echo (isset($_SESSION['career']) && $_SESSION['career'] === 'Licenciatura en Comunicación Ejecutiva Bilingüe') ? 'selected' : ''; ?>>Licenciatura en Comunicación Ejecutiva Bilingüe</option>
            </select></div>
        <div class="form-group">
            <label for="semester">Semestre:</label>
            <input type="text" id="semester" name="semester" value="<?php echo isset($_SESSION['semester']) ? $_SESSION['semester'] : ''; ?>">
        </div>
        <button type="submit" name="save">Guardar</button>
        <button type="submit" name="delete_name">Eliminar Nombre</button>
        <button type="submit" name="delete_career">Eliminar Carrera</button>
        <button type="submit" name="delete_semester">Eliminar Semestre</button>
        <button type="submit" name="destroy_session">Destruir Sesión</button>
    </form>

    <?php if (!empty($_SESSION)): ?>
        <div class="panel">
            <h2 style="color: #fff; font-weight: bold;">Datos Guardados</h2>
            <p style="color: #fff; font-weight: bold;">Nombre:<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'No definido'; ?></p>
            <p style="color: #fff; font-weight: bold;">Carrera: <?php echo isset($_SESSION['career']) ? $_SESSION['career'] : 'No definido'; ?></p>
            <p style="color: #fff; font-weight: bold;">Semestre:<?php echo isset($_SESSION['semester']) ? $_SESSION['semester'] : 'No definido'; ?></p>
        </div>
    <?php endif; ?>
</body>
</html>