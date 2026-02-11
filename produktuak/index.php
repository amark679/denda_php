<?php

$api_base = "http://localhost/web_garapena_zerbitzari_ingurunean/denda_php/api/produktua";


$busqueda = $_GET['q'] ?? '';
$url = $api_base;


if (!empty($busqueda)) {
    $url .= "?bilatu=" . urlencode($busqueda);
}


$json_produktuak = @file_get_contents($url);
$produktuak = [];

if ($json_produktuak !== false && $json_produktuak != null) {

    $produktuak = json_decode($json_produktuak, true);
}

// Cargamos la vista
include('produktuak_erakutsi.php');
?>