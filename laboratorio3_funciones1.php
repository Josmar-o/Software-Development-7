<?php

print "Programa que calcula la edad \n";

$dia = readline("Ingrese el día de su cumpleaños: ");
$mes = readline("Ingrese el mes de su cumpleaños (1-12): ");
$ano = readline("Ingrese el año de su nacimiento (ej 1990): ");

// Validar que no estén vacíos y que sean numéricos con emptty y isnumeric
if (
    empty(trim($dia)) || !is_numeric($dia) ||
    empty(trim($mes)) || !is_numeric($mes) ||
    empty(trim($ano)) || !is_numeric($ano)
) {
    echo "Todos los campos son obligatorios y deben ser numéricos.\n";
    exit;
}

// Calcular la edad (se usa funciones de date/time)
$fecha_nacimiento = mktime(0, 0, 0, $mes, $dia, $ano);
$fecha_actual = time();

//Calculos
$edad_en_segundos = $fecha_actual - $fecha_nacimiento;
$edad_en_anos = floor($edad_en_segundos / (60 * 60 * 24 * 365.25));
$edad_en_meses = floor(($edad_en_segundos % (60 * 60 * 24 * 365.25)) / (60 * 60 * 24 * 30.44));

// Se usa funciones de manipulación de cadenas
$mensaje = strtoupper("Tienes $edad_en_anos años y $edad_en_meses meses.");
echo $mensaje . "\n";

?>
