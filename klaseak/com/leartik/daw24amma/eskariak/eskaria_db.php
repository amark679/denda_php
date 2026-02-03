<?php

namespace com\leartik\daw24amma\eskariak;

use Exception;
use PDO;
use com\leartik\daw24amma\bezeroak\Bezeroa; 

class EskariaDB
{
    // Asegúrate de que la ruta sea correcta. En Windows las barras suelen ser \ o / pero es mejor ser consistente.
    private static $db_path = "sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/zerbitzari_erronka_proba/denda.db";

    private static function getKonexioa() {
        $db = new PDO(self::$db_path);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

    public static function insertEskaria($eskaria) {
        $db = self::getKonexioa(); 

        try {
            // 1. Iniciar Transacción
            $db->beginTransaction();

            // 2. Insertar en Eskariak
            $sql = "INSERT INTO eskariak (izena, abizena, helbidea, herria, postaKodea, probintzia, emaila, data) 
                    VALUES (:izena, :abizena, :helbidea, :herria, :pk, :prob, :email, :data)";
            
            $stmt = $db->prepare($sql);
        
            $bezeroa = $eskaria->getBezeroa();

            $stmt->bindValue(':izena',    $bezeroa->getIzena());
            $stmt->bindValue(':abizena',  $bezeroa->getAbizena());
            $stmt->bindValue(':helbidea', $bezeroa->getHelbidea());
            $stmt->bindValue(':herria',   $bezeroa->getHerria());
            $stmt->bindValue(':pk',       $bezeroa->getPostaKodea());
            $stmt->bindValue(':prob',     $bezeroa->getProbintzia());
            $stmt->bindValue(':email',    $bezeroa->getEmaila());
            $stmt->bindValue(':data',     $eskaria->getData());

            $stmt->execute();

            // Obtener ID generado
            $eskariaId = $db->lastInsertId();

            // 3. Insertar en Detaileak
            $sqlDetalle = "INSERT INTO detaileak (id_eskaria, id_produktua, prezioa, kopurua) 
                           VALUES (:id_eskaria, :id_produktua, :prezioa, :kopurua)";
            
            $stmtDetalle = $db->prepare($sqlDetalle);

            foreach ($eskaria->getDetaileak() as $detailea) {
                
                $produktua = $detailea->getProduktua();

                $prezioaOriginal = $produktua->getPrezioa();
                $deskontua = $produktua->getDeskontuak(); 
                
                $prezioaFinal = $prezioaOriginal * (1 - $deskontua);

                $stmtDetalle->bindValue(':id_eskaria',   $eskariaId);       
                $stmtDetalle->bindValue(':id_produktua', $produktua->getId()); 
                $stmtDetalle->bindValue(':prezioa',      $prezioaFinal);    
                $stmtDetalle->bindValue(':kopurua',      $detailea->getKopurua()); 

                $stmtDetalle->execute();
            }

            // 4. Confirmar cambios
            $db->commit();

            return $eskariaId;

        } catch (Exception $e) {
            
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            echo "<p>Errorea (insertEskaria): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    } // Aquí acaba la función insertEskaria. HABÍA UNA LLAVE EXTRA AQUÍ QUE HE QUITADO.

    public static function selectEskaria($id) {
        try {
            $db = self::getKonexioa();

            $stmt = $db->prepare("SELECT * FROM eskariak WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $eskaria = null;

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              
                $eskaria = new Eskaria();
                $eskaria->setId($row['id']);
                $eskaria->setData($row['data']);

                $bezeroa = new Bezeroa();
                $bezeroa->setIzena($row['izena']);
                $bezeroa->setAbizena($row['abizena']);
                $bezeroa->setHelbidea($row['helbidea']);
                $bezeroa->setHerria($row['herria']);
                $bezeroa->setPostaKodea($row['postaKodea']); 
                $bezeroa->setProbintzia($row['probintzia']);
                $bezeroa->setEmaila($row['emaila']);

                $eskaria->setBezeroa($bezeroa);
            }

            return $eskaria;

        } catch (Exception $e) {
            echo "<p>Salbuespena (selectEskaria): " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    public static function selectEskariak() {
        try {
            $db = self::getKonexioa();

            $stmt = $db->prepare("SELECT * FROM eskariak");
            $stmt->execute();

            $eskariak = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $eskaria = new Eskaria();
                $eskaria->setId($row['id']);
                $eskaria->setData($row['data']);

                $bezeroa = new Bezeroa();
                $bezeroa->setIzena($row['izena']);
                $bezeroa->setAbizena($row['abizena']);
                $bezeroa->setHelbidea($row['helbidea']);
                $bezeroa->setHerria($row['herria']);
                $bezeroa->setPostaKodea($row['postaKodea']);
                $bezeroa->setProbintzia($row['probintzia']);
                $bezeroa->setEmaila($row['emaila']);

                $eskaria->setBezeroa($bezeroa);

                $eskariak[] = $eskaria;
            }

            return $eskariak;

        } catch (Exception $e) {
            echo "<p>Salbuespena (selectEskariak): " . $e->getMessage() . "</p>\n";
            return [];
        }
    }
}
?>