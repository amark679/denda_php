<?php


require('../klaseak/com/leartik/daw24amma/produktuak/Produktua.php');
require('../klaseak/com/leartik/daw24amma/produktuak/Produktua_db.php'); 
require('../klaseak/com/leartik/daw24amma/saskia/detailea.php');
require('../klaseak/com/leartik/daw24amma/saskia/saskia.php');
require('../klaseak/com/leartik/daw24amma/bezeroak/Bezeroa.php');
require('../klaseak/com/leartik/daw24amma/eskariak/Eskaria.php');
require('../klaseak/com/leartik/daw24amma/eskariak/Eskaria_db.php');

session_start();

use com\leartik\daw24amma\produktuak\Produktua;
use com\leartik\daw24amma\produktuak\ProduktuaDB; 
use com\leartik\daw24amma\saskia\Detailea;
use com\leartik\daw24amma\saskia\Saskia;
use com\leartik\daw24amma\bezeroak\Bezeroa;
use com\leartik\daw24amma\eskariak\Eskaria;
use com\leartik\daw24amma\eskariak\EskariaDB;


if (!isset($_SESSION['saskia'])) {
   
    $saskia = new Saskia();
    $_SESSION['saskia'] = $saskia;
} else {
    
    $saskia = $_SESSION['saskia'];
}

//Pantaila kontrolatu
$bista = isset($_GET['bista']) ? $_GET['bista'] : 'saskia';

$Aldaketakegon = false;
$errorea = "";


	/************* GEHITU *************/

if (isset($_POST['gehitu'])) {
    
    $id = $_POST['id'];
    $kopurua = $_POST['kopurua'];

    $produktua = ProduktuaDB::selectProduktua($id);


    $detailea = new Detailea();
    $detailea->setProduktua($produktua); 
    $detailea->setKopurua($kopurua);
    $saskia->detaileaGehitu($detailea);


    $_SESSION['saskia'] = $saskia;
	$Aldaketakegon = true;
}

/************* EZABATU *************/

if (isset($_POST['ezabatu'])) {
    $idEliminar = $_POST['id_eliminar'];
    
    $detaileak = $saskia->getDetaileak();
    
    foreach ($detaileak as $det) {
        if ($det->getProduktua()->getId() == $idEliminar) {
           
            $saskia->detaileaEzabatu($det);
            break; 
        }
    }
    
    $_SESSION['saskia'] = $saskia;
	
	$Aldaketakegon = true;
}
/************* EGUNERATU *************/

if (isset($_POST['eguneratu'])) {
    $idActualizar = $_POST['id_eguneratu'];
    $kopuruaBerria = intval($_POST['kopurua_berria']); 

    if ($kopuruaBerria > 0) {
        $detaileak = $saskia->getDetaileak();
        foreach ($detaileak as $det) {
            if ($det->getProduktua()->getId() == $idActualizar) {
                
                $det->setKopurua($kopuruaBerria);
                
                $saskia->detaileaAldatu($det);
                break;
            }
        }
    } else {

    }
    $_SESSION['saskia'] = $saskia;
	
	$Aldaketakegon = true;
}

/********** BEZEROAREN LOGIKA ***********/

if (isset($_POST['gorde_datuak'])) {

 
    $izena      = isset($_POST['izena']) ? trim($_POST['izena']) : "";
    $abizena    = isset($_POST['abizena']) ? trim($_POST['abizena']) : "";
    $helbidea   = isset($_POST['helbidea']) ? trim($_POST['helbidea']) : "";
    $herria     = isset($_POST['herria']) ? trim($_POST['herria']) : "";
    $postaKodea = isset($_POST['postaKodea']) ? trim($_POST['postaKodea']) : "";
    $probintzia = isset($_POST['probintzia']) ? trim($_POST['probintzia']) : "";
    $emaila     = isset($_POST['emaila']) ? trim($_POST['emaila']) : "";

  
    if (empty($izena) || empty($abizena) || empty($helbidea) || empty($herria) || empty($postaKodea) || empty($probintzia)  || empty($emaila)) {
        
        $errorea = "Mesedez, bete derrigorrezko eremu guztiak.";
        $bista = 'datuak'; 
    } 
    elseif (!filter_var($emaila, FILTER_VALIDATE_EMAIL)) {
        $errorea = "Email formatua ez da zuzena.";
        $bista = 'datuak';
    } 
    elseif(!preg_match("/^\d{5}$/", $postaKodea)){
        $errorea = "Posta kodearen formatua ez da zuzena";
        $bista = 'datuak';
    }
    else {
     
        
        
        $bezeroa = new Bezeroa();
        $bezeroa->setIzena($izena);
        $bezeroa->setAbizena($abizena);
        $bezeroa->setHelbidea($helbidea);
        $bezeroa->setHerria($herria);
        $bezeroa->setPostaKodea($postaKodea);
        $bezeroa->setProbintzia($probintzia);
        $bezeroa->setEmaila($emaila);

     
        $eskaria = new Eskaria();
        $eskaria->setData(date('Y-m-d H:i:s'));
        $eskaria->setBezeroa($bezeroa);
        
        //Saskiko detaileak hartu eta eskarira sartzen ditugu
        
        $eskaria->setDetaileak($saskia->getDetaileak());

        // DB-an inserta egin

        $idBerria = EskariaDB::insertEskaria($eskaria);

        if ($idBerria > 0) {
   
            $eskaria->setId($idBerria);
            
            // Eskaria sesioan gorde
            $_SESSION['eskaria_finala'] = $eskaria;

            //Saskia utzitu erosketa amaitu delako
            unset($_SESSION['saskia']); 

            // Laburpen orrira joan
            header("Location: arrakasta.php");
            exit();

        } else {
            // DB errorea
            $errorea = "Arazo bat egon da datuak gordetzerakoan. Saiatu berriro.";
            $bista = 'datuak';
        }
    }
}


if ($Aldaketakegon) {
    header("Location: index.php?bista=saskia"); 
    exit();
}

/******** BISTAREN LOGIKA *********/


switch ($bista) {
    case 'datuak':
        include('bezero_datuak.php');
        break;
    
    case 'laburpena':
        
        include('arrakasta.php');
        break;

    case 'saskia':
    default:
        include('saskia_erakutsi.php'); 
        break;
}

?>