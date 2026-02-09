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
$produktua = null;
$kategoria = null;

if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != "admin") {
    header("location: ../index.php");
    exit;
}

// 🟩 CASO 1: Si viene por GET (mostrar la categoría antes de borrar)
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $produktua = ProduktuaDB::selectProduktua($id);
	
    if ($produktua) {
        $kategoria = KategoriaDB::selectKategoria($produktua->getId_kategoria());
    } else {
        header("Location: id_baliogabea.php");
        exit;
    }
}

// 🟩 CASO 2: Si viene por POST (confirmación y eliminación)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    if ($id > 0) {
        $emaitza = ProduktuaDB::deleteProduktua($id);
        if ($emaitza > 0) {
            include('produktua_ezabatu_da.php');
        } else {
            $mezua = "Ezabaketan errorea gertatu da.";
            include('produktua_ez_da_ezabatu.php');
        }
        exit;
    }
}
include('produktua_ezabatu.php');
?>
