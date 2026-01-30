<?php
// Incluir y usar clases
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/kategoriak/kategoria.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/kategoriak/kategoria_db.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/produktuak/produktua.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/produktuak/produktua_db.php');

use com\leartik\daw24amma\kategoriak\Kategoria;
use com\leartik\daw24amma\kategoriak\KategoriaDB;
use com\leartik\daw24amma\produktuak\Produktua;
use com\leartik\daw24amma\produktuak\ProduktuaDB;



// Verificar si el usuario es administrador
if (isset($_COOKIE['erabiltzailea']) && $_COOKIE['erabiltzailea'] == "admin") {
    $admin = true;
} else {
    $admin = false;
}

try {
    $kategoriak = KategoriaDB::selectKategoriak(); 
} catch (Exception $e) {
    $kategoriak = []; // Si falla, lista vacía para que no explote el formulario
}

if ($admin == true) {
    if (isset($_POST['gorde'])) {
        // Recoger y limpiar los datos del POST
        $marka = trim($_POST['marka']);
        $modeloa = trim($_POST['modeloa']);
        $prezioa = trim($_POST['prezioa']);
        $id_kategoria = trim($_POST['id_kategoria']);
        $nobedadeak = isset($_POST['nobedadeak']) ? intval($_POST['nobedadeak']) : 0;
		$deskontuak = isset($_POST['deskontuak']) && $_POST['deskontuak'] !== '' ? floatval($_POST['deskontuak']) : 0;
        if (
            strlen($marka) == 0 ||
            strlen($modeloa) == 0 ||
            strlen($prezioa) == 0 ||
            strlen($id_kategoria) == 0
        ) {
            $mezua = "❌ Eremu guztiak bete behar dira.";
            include('produktu_berria.php');
            exit;
        }

        // Validar que el precio sea un número entero positivo
        if (!is_numeric($prezioa) || $prezioa < 0) {
            $mezua = "❌ Prezioa ez da baliozkoa. Idatzi zenbaki oso positibo bat.";
            include('produktu_berria.php');
            exit;
        }
		if (!is_numeric($deskontuak) || $deskontuak < 0) {
            $mezua = "❌ Deskontua ez da baliozkoa. Idatzi zenbaki oso positibo bat.";
            include('produktu_berria.php');
            exit;
        }

		// Validación descuento (solo cuando NO es nobedadea)
		
        // --- ✅ Si todo es correcto ---
        $produktua = new Produktua();
        $produktua->setMarka($marka);
        $produktua->setModeloa($modeloa);
        $produktua->setPrezioa($prezioa);
        $produktua->setId_kategoria($id_kategoria);
        $produktua->setNobedadeak($nobedadeak);
		$produktua->setDeskontuak($deskontuak);
        if (ProduktuaDB::insertProduktua($produktua) > 0) {
            include('produktua_gorde_da.php');
        } else {
            $mezua = "❌ Errorea gertatu da produktua gordetzean.";
            include('produktu_berria.php');
        }

    } else {
        // Inicialización de variables si se accede por GET
        $marka = "";
        $modeloa = "";
        $prezioa = "";
        $id_kategoria = "";
        $nobedadeak = "";
		$deskontuak = 0; 
        $mezua = "";
		
		$produktua = new Produktua();
		
		
        include('produktu_berria.php');
    }
} else {
    // Redirigir si no es administrador
    header("location: ../index.php");
    exit;
}
?>
