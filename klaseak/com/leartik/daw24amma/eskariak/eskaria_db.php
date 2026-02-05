<?php

namespace com\leartik\daw24amma\eskariak;

use Exception;
use PDO;
use com\leartik\daw24amma\bezeroak\Bezeroa; 
use com\leartik\daw24amma\produktuak\Produktua;
use com\leartik\daw24amma\saskia\Detailea;

class EskariaDB
{
    // Asegúrate de que la ruta sea correcta. En Windows las barras suelen ser \ o / pero es mejor ser consistente.
    //private static $db_path = "sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/denda_php/denda.db";

    private static $db_path = "sqlite:C:\\xampp\\htdocs\\web_garapena_zerbitzari_ingurunean\\denda_php\\denda.db";


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
    }

    public static function selectEskaria($id) {
        try {
            $db = self::getKonexioa();

            // Eskaria eta bezeroa
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

                // -------------------------------------------------------------
                // 2. Produktuak rekuperatu Detaileetatik
                // -------------------------------------------------------------

                $sql_det = "SELECT d.kopurua, d.prezioa as prezioa_pagado, p.id, p.marka, p.modeloa 
                            FROM detaileak d 
                            JOIN produktuak2 p ON d.id_produktua = p.id 
                            WHERE d.id_eskaria = :id";
                
                $stmt_det = $db->prepare($sql_det);
                $stmt_det->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt_det->execute();

                $lista_detalles = [];

                while ($row_det = $stmt_det->fetch(PDO::FETCH_ASSOC)) {

                    $prod = new \com\leartik\daw24amma\produktuak\Produktua(); 
                    $prod->setId($row_det['id']);
                    $prod->setMarka($row_det['marka']);
                    $prod->setModeloa($row_det['modeloa']);
                    $prod->setPrezioa($row_det['prezioa_pagado']);
                    $prod->setDeskontuak(0);

                  
                    $detailea = new \com\leartik\daw24amma\saskia\Detailea();
                    $detailea->setProduktua($prod);
                    $detailea->setKopurua($row_det['kopurua']);

                    $lista_detalles[] = $detailea;
                }


                $eskaria->setDetaileak($lista_detalles);
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

    public static function deleteEskaria($id) {
        $db = self::getKonexioa();

        try {
            // 1. Hasieratu transakzioa (segurtasuna bermatzeko)
            $db->beginTransaction();

            // 2. Lehenengo: Detaileak ezabatu (Haurrak)
            // Agian zure base datuak "ON DELETE CASCADE" dauka, baina hobe da eskuz egitea ziurtatzeko.
            $sqlDet = "DELETE FROM detaileak WHERE id_eskaria = :id";
            $stmtDet = $db->prepare($sqlDet);
            $stmtDet->bindValue(':id', $id, PDO::PARAM_INT);
            $stmtDet->execute();

            // 3. Ondoren: Eskaria bera ezabatu (Gurasoa)
            $sqlMain = "DELETE FROM eskariak WHERE id = :id";
            $stmtMain = $db->prepare($sqlMain);
            $stmtMain->bindValue(':id', $id, PDO::PARAM_INT);
            $stmtMain->execute();

            // 4. Aldaketak baieztatu
            $db->commit();

            return true; // Ondo ezabatu da

        } catch (Exception $e) {
            // Zerbait gaizki badoa, atzera egin (desegin aldaketak)
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            echo "<p>Errorea (deleteEskaria): " . $e->getMessage() . "</p>\n";
            return false;
        }
    }
}
?>