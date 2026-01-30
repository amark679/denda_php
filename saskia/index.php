<?php


require('../klaseak/com/leartik/daw24amma/produktuak/Produktua.php');
require('../klaseak/com/leartik/daw24amma/produktuak/Produktua_db.php'); 
require('../klaseak/com/leartik/daw24amma/saskia/detailea.php');
require('../klaseak/com/leartik/daw24amma/saskia/saskia.php');

session_start();

use com\leartik\daw24amma\produktuak\Produktua;
use com\leartik\daw24amma\produktuak\ProduktuaDB; 
use com\leartik\daw24amma\saskia\Detailea;
use com\leartik\daw24amma\saskia\Saskia;



if (!isset($_SESSION['saskia'])) {
   
    $saskia = new Saskia();
    $_SESSION['saskia'] = $saskia;
} else {
    
    $saskia = $_SESSION['saskia'];
}

$Aldaketakegon = false;


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
if ($Aldaketakegon) {

    header("Location: index.php"); 
    exit();
}


include('saskia_erakutsi.php');

?>