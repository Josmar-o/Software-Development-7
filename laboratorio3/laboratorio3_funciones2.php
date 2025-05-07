<?php

print"Programa que calcula los detalles de un parrafo \n";

$texto = readline("Ingresa un párrafo de texto: ");


if (empty(trim($texto))) {
    echo "El texto no puede estar vacío.\n";
    exit;
}

$cantidad_palabras = str_word_count($texto);
$cantidad_caracteres = strlen($texto);

// Obtener la fecha (se usa funciones de date time)
$fecha_actual = date("d/m/Y H:i:s");


// Se usa Funciones de manipulación de cadenas
$resumen = strtoupper("Resumen del texto:\nPalabras: $cantidad_palabras\nCaracteres: $cantidad_caracteres\nFecha de análisis: $fecha_actual\n");

echo "\n$resumen";


?>