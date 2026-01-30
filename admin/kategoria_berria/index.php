<?php
// Incluir y usar clases
require('../../klaseak/com/leartik/daw24amma/kategoriak/kategoria.php');
require('../../klaseak/com/leartik/daw24amma/kategoriak/kategoria_db.php');
use com\leartik\daw24amma\kategoriak\Kategoria;
use com\leartik\daw24amma\kategoriak\KategoriaDB;

// Verificar si el usuario es administrador
if (isset($_COOKIE['erabiltzailea']) && $_COOKIE['erabiltzailea'] == "admin") {
    $admin = true;
} else {
    $admin = false;
}

if ($admin == true) {
    if (isset($_POST['gorde'])) {
        // Recoger y limpiar los datos del POST
        $izena = $_POST['izena'];
        $deskribapena = $_POST['deskribapena'];
	
        // Validación básica de campos no vacíos
        if (strlen($izena) > 0 && strlen($deskribapena) > 0) {
            
            // Crear el objeto Albistea y setear los valores
            $kategoria = new Kategoria();
            $kategoria->setIzena($izena);
            $kategoria->setDeskribapena($deskribapena);


            if (KategoriaDB::insertKategoria($kategoria) > 0) {
                include('kategoria_gorde_da.php');
            } else {
                include('kategoria_ez_da_gorde.php');
            }
        } else {
            $mezua = "Eremu guztiak bete behar dira";
            include('kategoria_berria.php');
        }
    } else {
        // Inicialización de variables si se accede por GET
        $izena = "";
        $deskribapena = "";
        $mezua = "";
        include('kategoria_berria.php');
    }
} else {
    // Redirigir si no es administrador (y la lógica no ha terminado antes)
    header("location: ../index.php"); // <-- Asumo que faltaba el ; aquí
}

?>