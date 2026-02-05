<?php
// Rutas relativas a las clases (ajusta si tu estructura es diferente)
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/eskariak/eskaria.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/eskariak/eskaria_db.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/bezeroak/bezeroa.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/saskia/detailea.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/produktuak/produktua.php');

use com\leartik\daw24amma\eskariak\EskariaDB;

// 1. Admin baimena egiaztatu
if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != "admin") {
    header("location: ../index.php");
    exit;
}
/****** EZABATU  ******/

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    if ($id > 0) {
        $emaitza = EskariaDB::deleteEskaria($id);
        if ($emaitza > 0) {
            include('eskaria_ezabatu_da.php');
        } else {
            $mezua1 = "Ezabaketan errorea gertatu da.";
            include('eskaria_ez_da_ezabatu.php');
        }
        exit;
    }
}

// 2. ID-a lortu eta balidatu
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../index.php?error=id_baliogabea");
    exit;
}

$id = (int)$_GET['id'];
$eskaria = null;

try {
    // 3. Eskaria kargatu DB-tik
    // Oharra: Ziurtatu EskariaDB::selectEskaria($id) funtzioak 
    // detaileak (produktuak) ere kargatzen dituela!
    $eskaria = EskariaDB::selectEskaria($id);

} catch (Exception $e) {
    echo "Errorea DB: " . $e->getMessage();
    exit;
}

// 4. Eskaria existitzen ez bada, irten
if (!$eskaria) {
    echo "Ez da eskaria aurkitu.";
    exit;
}




// 5. Bista kargatu
include('eskaria_ikusi.php');
exit;
?>