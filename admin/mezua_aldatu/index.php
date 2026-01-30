<?php
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/mezuak/mezua.php');
require_once(__DIR__ . '/../../klaseak/com/leartik/daw24amma/mezuak/mezua_db.php');

use com\leartik\daw24amma\mezuak\Mezua;
use com\leartik\daw24amma\mezuak\MezuaDB;


$mezua1 = "";
$mezua = null;

// Admin baimena egiaztatu
if (!isset($_COOKIE['erabiltzailea']) || $_COOKIE['erabiltzailea'] != "admin") {
    header("location: ../index.php");
    exit;
}
// POST 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
	
	$id = (int)$_POST['id'];
	
    $izena = isset($_POST['izena']) ? trim($_POST['izena']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : ''; 
    $testua = isset($_POST['mezua']) ? trim($_POST['mezua']) : '';
	
	$erantzuna = isset($_POST['erantzuna']) ? 1 : 0;
	
	$mezuaObj = new Mezua();
    $mezuaObj->setId($id);
    $mezuaObj->setIzena($izena);
    $mezuaObj->setEmail($email);
    $mezuaObj->setMezua($testua);
    $mezuaObj->setErantzuna($erantzuna);

    if ($id > 0 ) {
		
        $emaitza = MezuaDB::mezuaUpdate($mezuaObj);

        if ($emaitza > 0) {
            include('mezua_aldatu_da.php'); // Mensaje de éxito
        } else {
            $mezua1 = "Eguneraketan errorea gertatu da.";
            include('mezua_aldatu.php'); // Mensaje de error
        }
        exit;
    } else {
        $mezua1 = "Datuak ez dira zuzenak.";
		
		$mezua = MezuaDB::selectMezua($id);
		
        include('mezua_aldatu.php');
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

// Si no se encuentra la categoría, redirigir
if (!$mezua) {
    header("Location: id_baliogabea.php");
    exit;
}

// Si todo está bien, incluir el formulario
include('mezua_aldatu.php');
exit;


?>
