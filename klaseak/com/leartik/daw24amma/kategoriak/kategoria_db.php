<?php
namespace com\leartik\daw24amma\kategoriak;

require_once(__DIR__ . '/../produktuak/produktua.php');
require_once(__DIR__ . '/kategoria.php');

use com\leartik\daw24amma\produktuak\Produktua;
use Exception;
use PDO;

class KategoriaDB
{
  
    private static $db_path = "sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/denda_php/denda.db";

    private static function getKonexioa() {
        $db = new PDO(self::$db_path);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }


    public static function selectKategoriak() {
        try {
            
            $db = self::getKonexioa();

            // Prepared statement (aunque no tiene parámetros, es buena práctica)
            $stmt = $db->prepare("SELECT * FROM kategoriak");
            $stmt->execute();

            $kategoriak = array();
            while ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $kategoria = new Kategoria();
                $kategoria->setKategoria_id($erregistroa['kategoria_id']);
                $kategoria->setIzena($erregistroa['izena']);
                $kategoria->setDeskribapena($erregistroa['deskribapena']);
                $kategoria->setImg($erregistroa['img']);
                $kategoriak[] = $kategoria;
            }

            return $kategoriak;

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    public static function selectKategoria($kategoria_id){
        try {
           
            $db = self::getKonexioa();

            
            $stmt_kategoria = $db->prepare("SELECT * FROM kategoriak WHERE kategoria_id = :kategoria_id");
            $stmt_kategoria->bindValue(':kategoria_id', $kategoria_id, PDO::PARAM_INT);
            $stmt_kategoria->execute();

            $kategoria = null;
            if ($erregistroa = $stmt_kategoria->fetch(PDO::FETCH_ASSOC)) {
                $kategoria = new Kategoria();
                $kategoria->setKategoria_id($erregistroa['kategoria_id']);
                $kategoria->setIzena($erregistroa['izena']);
                $kategoria->setDeskribapena($erregistroa['deskribapena']);
                $kategoria->setImg($erregistroa['img']);
              
            } else {
                return null; 
            }


            $sql_produktuak = "
                SELECT id, marka, modeloa, prezioa
                FROM produktuak2 
                WHERE id_kategoria = :kategoria_id
            ";
            $stmt_produktuak = $db->prepare($sql_produktuak);
            $stmt_produktuak->bindValue(':kategoria_id', $kategoria_id, PDO::PARAM_INT);
            $stmt_produktuak->execute();

            $produktuak_lista = [];
            // Iterar sobre los productos y crear objetos Produktu
            while ($erregistroa_prod = $stmt_produktuak->fetch(PDO::FETCH_ASSOC)) {
                $produktua = new Produktua();
                $produktua->setId($erregistroa_prod['id']);
                $produktua->setMarka($erregistroa_prod['marka']);
                $produktua->setModeloa($erregistroa_prod['modeloa']);
                $produktua->setPrezioa($erregistroa_prod['prezioa']);
                
                $produktuak_lista[] = $produktua;
            }

            $kategoria->setProduktuak($produktuak_lista);

            return $kategoria;

        } catch (Exception $e) {
            echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
            return null;
        }
    }
    
    public static function insertKategoria($kategoria){
        try {
  
            $db = self::getKonexioa();

         
            $sql = 'INSERT INTO kategoriak (kategoria_id, izena, deskribapena)
                    VALUES (:kategoria_id, :izena, :deskribapena)';

            $stmt = $db->prepare($sql);

            $stmt->bindValue(':kategoria_id', $kategoria->getKategoria_id(), PDO::PARAM_INT);
            $stmt->bindValue(':izena',        $kategoria->getIzena(),        PDO::PARAM_STR);
            $stmt->bindValue(':deskribapena', $kategoria->getDeskribapena(), PDO::PARAM_STR);
 
           
            $emaitza = $stmt->execute();

            return $emaitza ? 1 : 0;

        } catch (Exception $e) {
            echo "<p>Errorea: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    public static function kategoriaDelete($kategoria_id){
        try {
           
            $db = self::getKonexioa();
            
           
            $db->exec("PRAGMA foreign_keys = ON;");
            
            
            $sql = 'DELETE FROM kategoriak 
                    WHERE kategoria_id = :kategoria_id';

            $stmt = $db->prepare($sql);

            // Parametroa lotu: Kategoria IDa
            $stmt->bindValue(':kategoria_id', $kategoria_id, PDO::PARAM_INT);
            
            // Sententzia exekutatu
            $emaitza = $stmt->execute();
            
            // Konexioa itxi
            $db = null; 

            return $emaitza ? 1 : 0;

        } catch (Exception $e) {
            echo "<p>Errorea: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    public static function kategoriaUpdate($kategoria_id, $izena_berria, $deskribapena_berria) {
        try {
    
            $db = self::getKonexioa();

            // Sententzia SQL prestatua: kategoria eguneratu IDaren arabera
            $sql = 'UPDATE kategoriak
                    SET izena = :izena, deskribapena = :deskribapena
                    WHERE kategoria_id = :kategoria_id';

            $stmt = $db->prepare($sql);

            // Parametroak lotu
            $stmt->bindValue(':izena',        $izena_berria,        PDO::PARAM_STR);
            $stmt->bindValue(':deskribapena', $deskribapena_berria, PDO::PARAM_STR);
            $stmt->bindValue(':kategoria_id', $kategoria_id,        PDO::PARAM_INT);

            // Sententzia exekutatu
            $emaitza = $stmt->execute();

            // Konexioa itxi (aukerazkoa)
            $db = null;

            // Emaitza itzuli (1 = ondo, 0 = errorea)
            return $emaitza ? 1 : 0;

        } catch (Exception $e) {
            echo "<p>Errorea: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }
}
?>