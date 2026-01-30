<?php
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/kategoriak/kategoria.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/kategoriak/kategoria_db.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/produktuak/produktua.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/produktuak/produktua_db.php');

use com\leartik\daw24amma\kategoriak\Kategoria;
use com\leartik\daw24amma\kategoriak\KategoriaDB;
use com\leartik\daw24amma\produktuak\Produktua;
use com\leartik\daw24amma\produktuak\ProduktuaDB;

$mezua = "";
$produktua = null;

// 🔐 admin dela berifikatu
if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != "admin") {
    header("location: ../index.php");
    exit;
}

// POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {

    $id = (int)($_POST['id'] ?? 0);
    $id_kategoria = (int)($_POST['id_kategoria'] ?? 0);
    $marka = trim($_POST['marka'] ?? '');
    $modeloa = trim($_POST['modeloa'] ?? ''); 
    $prezioa = trim($_POST['prezioa'] ?? '');
    $nobedadeak = $_POST['nobedadeak'] ?? null; 
    $deskontuak = trim($_POST['deskontuak'] ?? '');
    
    // ❗ PREZIOA, MARKA ETA NOBEDADEAREN BALIDAZIOA
    if ($marka === '' || $prezioa === '' || $nobedadeak === null) {
        $mezua = " Marka, prezioa edo nobedadea ezin dira hutsik egon.";

        $produktua = new Produktua($id, $id_kategoria, $marka, $modeloa, $prezioa, $nobedadeak, $deskontuak);
        $kategoriak = KategoriaDB::selectKategoriak();

        include('produktua_aldatu.php');
        exit;
    }

    // PREZIOAREN BALIDAZIOA
    if (!is_numeric($prezioa) || floatval($prezioa) < 0) {
        $mezua = "Prezioa ez da baliozkoa. Idatzi zenbaki positibo bat.";

        $produktua = new Produktua($id, $id_kategoria, $marka, $modeloa, $prezioa, $nobedadeak, $deskontuak);
        $kategoriak = KategoriaDB::selectKategoriak();

        include('produktua_aldatu.php');
        exit;
    }
    
    // 🟢 DESKONTUAREN BALIDAZIOA (MODIFICADO)
    

    if ($deskontuak === "") {
        $deskontuak = 0; // si está vacío, lo tratamos como 0
    }

    if (!is_numeric($deskontuak) || floatval($deskontuak) < 0 || floatval($deskontuak) > 100) {
        $mezua = "❌ Deskontua ez da baliozkoa. Idatzi 0 eta 100 artean.";

        $produktua = new Produktua($id, $id_kategoria, $marka, $modeloa, $prezioa, $nobedadeak, $deskontuak);
        $kategoriak = KategoriaDB::selectKategoriak();
        include('produktua_aldatu.php');
        exit;
    }

   
    $deskontuak = floatval($deskontuak) / 100;
    

    // 🟩 Datos correctos → actualizar
    $produktua = new Produktua($id, $id_kategoria, $marka, $modeloa, floatval($prezioa), $nobedadeak, $deskontuak);
    $emaitza = ProduktuaDB::updateProduktua($produktua);

    if ($emaitza > 0) {
        include('produktua_aldatu_da.php');
    } else {
        $mezua = "Datuak ez dira zuzenak.";
        $kategoriak = KategoriaDB::selectKategoriak();
        include('produktua_aldatu.php');
    }

    exit;
}


// 🟩 GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: id_baliogabea.php");
    exit;
}

$id = (int)$_GET['id'];
    
try {
    $produktua = ProduktuaDB::selectProduktua($id);
} catch (Exception $e) {
    echo "Errorea DB: " . $e->getMessage();
    exit;
}

if (!$produktua) {
    echo "ID ez da aurkitu. Redirigiendo...";
    header("Location: id_baliogabea.php");
    exit;
}

$kategoriak = KategoriaDB::selectKategoriak();
include('produktua_aldatu.php');
exit;
?>