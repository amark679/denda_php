

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
$kategoria = null;

// Admin baimena egiaztatu
if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != "admin") {
    header("location: ../index.php");
    exit;
}
$izena_value = "";
$deskribapena_value = "";

// POST 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kategoria_id'])) {
	
    $kategoria_id = (int)$_POST['kategoria_id'];
    $izena_berria = trim($_POST['izena']);
    $deskribapena_berria = trim($_POST['deskribapena']);
	
	
	$izena_value = $izena_berria;
    $deskribapena_value = $deskribapena_berria;

    if ($kategoria_id > 0 && !empty($izena_berria) && !empty($deskribapena_berria)) {
		
        $emaitza = KategoriaDB::kategoriaUpdate($kategoria_id, $izena_berria, $deskribapena_berria);

        if ($emaitza > 0) {
			
            include('kategoria_aldatu_da.php'); // Mensaje de éxito
			exit;
			
        } 
		
		$mezua = "Eguneraketan errorea gertatu da.";
		
    }
		
		$mezua = "Eremu guztiak bete behar dira";
		
        include('kategoria_aldatu.php');
        exit;
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

// Si no se encuentra la categoría, redirigir
if (!$kategoria) {
    header("Location: id_baliogabea.php");
    exit;
}

$izena_value = $kategoria->getIzena();
$deskribapena_value = $kategoria->getDeskribapena();

// Si todo está bien, incluir el formulario
include('kategoria_aldatu.php');
exit;


?>
