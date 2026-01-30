<?php
$api_base = "http://localhost/web_garapena_zerbitzari_ingurunean/zerbitzari_erronka_proba/api/produktua";

// Nobedadeak
$json_nobedadeak = file_get_contents("$api_base/?mota=nobedadeak");
$nobedadeak = [];
if ($json_nobedadeak != null) {
    $nobedadeak = json_decode($json_nobedadeak, true);
    $nobedadeak = array_slice($nobedadeak, 0, 10);
}

// Eskaintzak
$json_deskontuak = file_get_contents("$api_base/?mota=deskontuak");
$deskontuak = [];
if ($json_deskontuak != null) {
    $deskontuak = json_decode($json_deskontuak, true);
    $deskontuak = array_slice($deskontuak, 0, 10);
}
include ('hasiera.php');
?>