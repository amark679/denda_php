<?php

/*require('../../klaseak/com/leartik/daw24amma/kategoriak/kategoria.php');
require('../../klaseak/com/leartik/daw24amma/kategoriak/kategoria_db.php');*/

require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/kategoriak/kategoria.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/kategoriak/kategoria_db.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/produktuak/produktua.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/produktuak/produktua_db.php');

use com\leartik\daw24amma\kategoriak\Kategoria;
use com\leartik\daw24amma\kategoriak\KategoriaDB;
use com\leartik\daw24amma\produktuak\Produktua;
use com\leartik\daw24amma\produktuak\ProduktuaDB;

$mezua = "";
$kategoria = null;

if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != "admin") {
    header("location: ../index.php");
    exit;
}


// 🟩 POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kategoria_id'])) {
    $kategoria_id = (int)$_POST['kategoria_id'];
    if ($kategoria_id > 0) {
        $emaitza = KategoriaDB::kategoriaDelete($kategoria_id);
        if ($emaitza > 0) {
            include('kategoria_ezabatu_da.php');
        } else {
            $mezua = "Ezabaketan errorea gertatu da.";
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

$kategoria_id = (int)$_GET['id'];

try {
    $kategoria = KategoriaDB::selectKategoria($kategoria_id);
} catch (Exception $e) {
    echo "Errorea DB: " . $e->getMessage();
    exit;
}

// Kategoria ez bada aurkitzn, redirijidu
if (!$kategoria) {
    header("Location: id_baliogabea.php");
    exit;
}

// Dana ondo badago, formularioa sartu
include('kategoria_ezabatu.php');
exit;

?>
