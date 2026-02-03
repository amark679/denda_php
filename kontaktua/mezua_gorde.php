<?php
require('../klaseak/com/leartik/daw24amma/mezuak/mezua.php');
require('../klaseak/com/leartik/daw24amma/mezuak/mezua_db.php');

use com\leartik\daw24amma\mezuak\Mezua;
use com\leartik\daw24amma\mezuak\MezuaDB;

$feedback = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   //Datuak kargatu
    $izena = isset($_POST['izena']) ? trim($_POST['izena']) : "";
    $email = isset($_POST['emaila']) ? trim($_POST['emaila']) : "";
    $testua = isset($_POST['mezua']) ? trim($_POST['mezua']) : "";
	
	$errorea = "";
	
	//Utzik ez daudela ikusi
	if (empty($izena) || empty($email) || empty($testua)) {
        $errorea = "Mesedez, bete eremu guztiak (Izena, Emaila eta Mezua).";
    }
    // emaila komprobatu
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorea = "Email formatua ez da zuzena (adibidez: izena@zerbitzaria.com).";
    }

    
    if (!empty($errorea)) {
        
        
		include('kontaktua.php');
        exit();
    }
	//Mezua sortu
    $mezuaObj = new Mezua();
    
    $mezuaObj->setIzena($izena);
    $mezuaObj->setEmail($email);
    $mezuaObj->setMezua($testua);
    
    //Erantzuna gestionatu
    $mezuaObj->setErantzuna(""); 

    //Klaseari deitu ordetzeko
    $emaitza = MezuaDB::insertMezua($mezuaObj);

    if ($emaitza == 1) {
		
		header("Location: kontaktua.php?egoera=ondo");
		exit(); 
	} else {
		
		header("Location: kontaktua.php?egoera=errorea");
		
	}
}
?>