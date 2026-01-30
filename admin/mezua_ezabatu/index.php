<?php
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/mezuak/mezua.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/mezuak/mezua_db.php');

use com\leartik\daw24amma\mezuak\Mezua;
use com\leartik\daw24amma\mezuak\MezuaDB;


$mezua1 = "";
$mezua = null;

if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != "admin") {
    header("location: ../index.php");
    exit;
}


// 🟩 POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    if ($id > 0) {
        $emaitza = MezuaDB::mezuaDelete($id);
        if ($emaitza > 0) {
            include('mezua_ezabatu_da.php');
        } else {
            $mezua1 = "Ezabaketan errorea gertatu da.";
            include('kategoria_ez_da_ezabatu.php');
        }
        exit;
    }
}

// 🟩 GET 
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // ID no existe o no es numérico → redirigir
    header("Location: id_baliogabea.php");
    exit;
}

$id = (int)$_GET['id'];

try {
    $mezua = MezuaDB::selectMezua($id);
} catch (Exception $e) {
    echo "Errorea DB: " . $e->getMessage();
    exit;
}

// Kategoria ez bada aurkitzn, redirijidu
if (!$mezua) {
    header("Location: id_baliogabea.php");
    exit;
}

// Dana ondo badago, formularioa sartu
include('mezua_ezabatu.php');
exit;

?>
