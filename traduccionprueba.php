<?php
require 'functions.php';

$texto = "Asunto: Hubo una pelea donde abas personas salieron heridas";
$traduccion = traducirTexto($texto);
echo "Traducción: $traduccion";
