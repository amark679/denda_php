<?php

namespace com\leartik\daw24amma\eskariak;

use Exception;
use PDO;

class EskariaDB
{
    // Ruta a tu base de datos
    private const DB_PATH = "sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/zerbitzari_erronka/denda.db";

    /**
     * Selecciona una Eskaria por su ID
     */
    public static function selectEskaria($id) {
        try {
            $db = new PDO(self::DB_PATH);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Solo seleccionamos por id
            $stmt = $db->prepare("SELECT * FROM eskariak WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $eskaria = null;

            if ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $eskaria = new Eskaria();
                
                // Asignamos el ID recuperado
                $eskaria->setId($erregistroa['id']);
                
                // Como has dicho que son el mismo, asignamos el mismo ID al bezeroa
                $eskaria->setBezeroa($erregistroa['id']); 
                
                $eskaria->setData($erregistroa['data']);
            }

            return $eskaria;

        } catch (Exception $e) {
            echo "<p>Salbuespena (selectEskaria): " . $e->getMessage() . "</p>\n";
            return null;
        }
    }

    /**
     * Selecciona todas las Eskarias
     */
    public static function selectEskariak() {
        try {
            $db = new PDO(self::DB_PATH);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $db->prepare("SELECT * FROM eskariak");
            $stmt->execute();

            $eskariak = array();

            while ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $eskaria = new Eskaria();
                $eskaria->setId($erregistroa['id']);
                
                // Bezeroa es igual al ID
                $eskaria->setBezeroa($erregistroa['id']);
                
                $eskaria->setData($erregistroa['data']);

                $eskariak[] = $eskaria;
            }

            return $eskariak;

        } catch (Exception $e) {
            echo "<p>Salbuespena (selectEskariak): " . $e->getMessage() . "</p>\n";
            return [];
        }
    }

    /**
     * Inserta una nueva Eskaria
     * IMPORTANTE: Aquí debemos insertar el ID manualmente porque dijiste que coincide con el cliente.
     */
    public static function insertEskaria($eskaria) {
        try {
            $db = new PDO(self::DB_PATH);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Insertamos 'id' y 'data'. 
            // NO usamos autoincrement porque el ID viene dado (es el del cliente).
            $sql = 'INSERT INTO eskariak (id, data) VALUES (:id, :data)';
            
            $stmt = $db->prepare($sql);

            // Obtenemos valores
            // Usamos getId() o getBezeroa(), ya que son lo mismo
            $idVal = $eskaria->getId(); 
            $dataVal = $eskaria->getData();
            
            $stmt->bindValue(':id', $idVal, PDO::PARAM_INT);
            $stmt->bindValue(':data', $dataVal, PDO::PARAM_STR);

            $emaitza = $stmt->execute();

            return $emaitza ? 1 : 0;

        } catch (Exception $e) {
            echo "<p>Errorea (insertEskaria): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    /**
     * Actualiza una Eskaria existente
     */
    public static function updateEskaria($eskaria) {
        try {
            $db = new PDO(self::DB_PATH);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Solo actualizamos la fecha, porque el ID es la clave primaria y no suele cambiar
            $sql = 'UPDATE eskariak SET data = :data WHERE id = :id';
            
            $stmt = $db->prepare($sql);

            $dataVal = $eskaria->getData();
            $id = $eskaria->getId();

            $stmt->bindValue(':data', $dataVal, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $emaitza = $stmt->execute();

            return $emaitza ? 1 : 0;

        } catch (Exception $e) {
            echo "<p>Errorea (updateEskaria): " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }

    /**
     * Elimina una Eskaria por ID
     */
    public static function deleteEskaria($id) {
        try {
            $db = new PDO(self::DB_PATH);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'DELETE FROM eskariak WHERE id = :id';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->rowCount();

        } catch (Exception $e) {
            echo "<p>Errorea ezabatzean: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }
}
?>