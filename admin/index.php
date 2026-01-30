<?php
require('../klaseak/com/leartik/daw24amma/produktuak/produktua.php');
require('../klaseak/com/leartik/daw24amma/produktuak/produktua_db.php');
use com\leartik\daw24amma\produktuak\ProduktuaDB;
use com\leartik\daw24amma\produktuak\Produktua;

require('../klaseak/com/leartik/daw24amma/kategoriak/kategoria.php');
require('../klaseak/com/leartik/daw24amma/kategoriak/kategoria_db.php');
use com\leartik\daw24amma\kategoriak\KategoriaDB;
use com\leartik\daw24amma\kategoriak\Kategoria;

require('../klaseak/com/leartik/daw24amma/mezuak/mezua.php');
require('../klaseak/com/leartik/daw24amma/mezuak/mezua_db.php');
use com\leartik\daw24amma\mezuak\MezuaDB;
use com\leartik\daw24amma\mezuak\Mezua;


// administrazio gunean sartzeko baldintzak egiaztatu
$admin = false;

if (isset($_POST['sartu'])) {

    if ($_POST['erabiltzailea'] == "admin" && $_POST['pasahitza'] == "admin") {
        $admin = true;
        setcookie("erabiltzailea", "admin", time() + 86400);
    }

} else if (isset($_COOKIE['erabiltzailea']) && $_COOKIE['erabiltzailea'] == "admin") {

    $admin = true;

}

// administrazioa baimenduta bada albisteen zerrenda erakutsi, bestela hasierako formularioa
if ($admin == true) {
	
	$kategoriak = KategoriaDB::selectKategoriak();
    include('kategoriak_erakutsi.php');

    $produktuak = ProduktuaDB::selectProduktuak();
    include('produktuak_erakutsi.php');
	
	$mezuak = MezuaDB::selectMezuak();
    include('mezuak_erakutsi.php');
	
	
	
	
	

} else {

    if (isset($_POST['sartu'])) {

        $mezua = "Datuak ez dira zuzenak";

    } else {

        $mezua = "";

    }

    include('login.php');

}
?>