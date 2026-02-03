<?php

require_once('../klaseak/com/leartik/daw24amma/kategoriak/kategoria.php');
require_once('../klaseak/com/leartik/daw24amma/kategoriak/kategoria_db.php');
require_once('../klaseak/com/leartik/daw24amma/produktuak/produktua.php');
require_once('../klaseak/com/leartik/daw24amma/produktuak/produktua_db.php');

use com\leartik\daw24amma\kategoriak\KategoriaDB;
use com\leartik\daw24amma\produktuak\ProduktuaDB;

$action = isset($_GET['action']) ? $_GET['action'] : 'home';
$id = isset($_GET['id']) ? filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) : 0;


switch ($action) {
    
    // CASO 1: Kategoria bateko porduktuak ikusi
    case 'kategoria':
        if (!$id) {
            header("Location: index.php?action=error");
            exit();
        }

        
        $kategoria = KategoriaDB::selectKategoria($id);
        $produktuak = ProduktuaDB::selectProduktuakByKategoriaId($id);

       
        if (!$kategoria) {
            header("Location: index.php?action=error");
            exit();
        }

        $kategoria_izena = htmlspecialchars($kategoria->getIzena());
        
        
        include 'katalogoa_view.php';
        break;

    // CASO 2: Produktua bera ikusi
    case 'produktua':
        if (!$id) {
            header("Location: index.php?action=error");
            exit();
        }

     
        $p = ProduktuaDB::selectProduktua($id);

        
        if (!$p) {
            header("Location: index.php?action=error");
            exit();
        }

      
        $kategoria_id = $p->getId_kategoria();
        $prezioa = floatval($p->getPrezioa());
        $desk = floatval($p->getDeskontuak());
        $finala = round($prezioa * (1 - $desk), 2);

        
        include 'produktua.php';
        break;

    // CASO 3: Errorea: ID baliogabea
    case 'error':
        include 'id_baliogabea.php';
        break;

    // CASO POR DEFECTO: Katalogoa.php erakutsiko du
    default: 
        $kategoriak = KategoriaDB::selectKategoriak();
        include 'katalogoa.php';
        break;
}
?>