<?php
namespace com\leartik\daw24amma\produktuak;

use Exception;
use PDO;

class ProduktuaDB
{
    public static function selectProduktuak() {
		
    try {
        $db = new PDO("sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/zerbitzari_erronka/denda.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepared statement (aunque no tiene parámetros, es buena práctica)
        $stmt = $db->prepare("SELECT * FROM produktuak2");
        $stmt->execute();

        $produktuak = array();
        while ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produktua = new Produktua();
            $produktua->setId($erregistroa['id']);
            $produktua->setId_kategoria($erregistroa['id_kategoria']);
            $produktua->setMarka($erregistroa['marka']);
            $produktua->setModeloa($erregistroa['modeloa']);
            $produktua->setPrezioa($erregistroa['prezioa']);
			$produktua->setNobedadeak($erregistroa['nobedadeak']);
			$produktua->setIrudia($erregistroa['irudia']); 
			$produktua->setDeskontuak($erregistroa['deskontuak']);
            $produktuak[] = $produktua;
        }

        return $produktuak;

    } catch (Exception $e) {
        echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
        return null;
    }
	}

	public static function selectProduktua($id){
		
    try {
        $db = new PDO("sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/zerbitzari_erronka/denda.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepared statement con parámetro
        $stmt = $db->prepare("SELECT * FROM produktuak2 WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $produktua = null;
        if ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produktua = new Produktua();
            $produktua->setId($erregistroa['id']);
            $produktua->setId_kategoria($erregistroa['id_kategoria']);
            $produktua->setMarka($erregistroa['marka']);
            $produktua->setModeloa($erregistroa['modeloa']);
            $produktua->setPrezioa($erregistroa['prezioa']);
			$produktua->setNobedadeak($erregistroa['nobedadeak']);
			$produktua->setIrudia($erregistroa['irudia']); 
			$produktua->setDeskontuak($erregistroa['deskontuak']);
        } 

        return $produktua;

    } catch (Exception $e) {
        echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
        return null;
    }
	}
	public static function selectProduktuakByKategoriaId(int $kategoria_id): array
    {
        $produktuak = array();
        
        try {
            // Usando tu método de conexión a SQLite
            $db = new PDO("sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/zerbitzari_erronka/denda.db");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Sentencia SQL: Seleccionar de 'produktuak2' donde 'id_kategoria' coincide.
            $sql = "SELECT * FROM produktuak2 WHERE id_kategoria = :kategoria_id";

            $stmt = $db->prepare($sql);
            
            // Vincular el ID de la categoría de forma segura
            $stmt->bindValue(':kategoria_id', $kategoria_id, PDO::PARAM_INT);
            
            $stmt->execute();

            // Mapear los resultados
            while ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $produktua = new Produktua();
                $produktua->setId($erregistroa['id']);
                $produktua->setId_kategoria($erregistroa['id_kategoria']);
                $produktua->setMarka($erregistroa['marka']);
                $produktua->setModeloa($erregistroa['modeloa']);
                $produktua->setPrezioa($erregistroa['prezioa']);
                $produktua->setNobedadeak($erregistroa['nobedadeak']);
                $produktua->setIrudia($erregistroa['irudia']); 
                $produktua->setDeskontuak($erregistroa['deskontuak']);
                
                $produktuak[] = $produktua;
            }

            return $produktuak;

        } catch (Exception $e) {
            echo "<p>Errorea (selectProduktuakByKategoriaId): " . $e->getMessage() . "</p>\n";
            return $produktuak; // Devuelve un array vacío si hay error
        }
    }
	
   public static function insertProduktua($produktua) {
    try {
        // Conexión a la base de datos SQLite
        $db = new PDO("sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/zerbitzari_erronka/denda.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtener valores del objeto
        $id_kategoria = $produktua->getId_Kategoria();
        $marka = $produktua->getMarka();
        $modeloa = $produktua->getModeloa();
        $prezioa = $produktua->getPrezioa();
        $nobedadeak = $produktua->getNobedadeak();
		$deskontuak = $produktua->getDeskontuak();

        
       

        // Sentencia SQL preparada
        $sql = 'INSERT INTO produktuak2 (id_kategoria, marka, modeloa, prezioa, nobedadeak, deskontuak)
                VALUES (:id_kategoria, :marka, :modeloa, :prezioa, :nobedadeak, :deskontuak)';

        $stmt = $db->prepare($sql);

        // Enlazar parámetros
        $stmt->bindValue(':id_kategoria', $id_kategoria, PDO::PARAM_INT);
        $stmt->bindValue(':marka',        $marka,        PDO::PARAM_STR);
        $stmt->bindValue(':modeloa',      $modeloa,      PDO::PARAM_STR);
        $stmt->bindValue(':prezioa',      $prezioa,      PDO::PARAM_STR); 
        $stmt->bindValue(':nobedadeak',   $nobedadeak,   PDO::PARAM_INT);
		$stmt->bindValue(':deskontuak', $deskontuak, PDO::PARAM_STR);

        // Ejecutar sentencia
        $emaitza = $stmt->execute();

        return $emaitza ? 1 : 0;

    } catch (Exception $e) {
        echo "<p>Errorea: " . $e->getMessage() . "</p>\n";
        return 0;
    }
}
	public static function deleteProduktua($id){
													
    try {
        // Conexión a la base de datos SQLite
        $db = new PDO("sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/zerbitzari_erronka/denda.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Sentencia preparada
        $sql = 'DELETE FROM produktuak2 WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // Ejecutar y devolver número de filas afectadas
        $stmt->execute();

        // rowCount() devuelve cuántas filas se eliminaron (0 si no existía)
        return $stmt->rowCount();

    } catch (Exception $e) {
        echo "<p>Errorea ezabatzean: " . $e->getMessage() . "</p>\n";
        return 0;
    }
	}
	public static function updateProduktua($produktua) {
    try {
        // Konexioa datu-basera (SQLite)
        $db = new PDO("sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/zerbitzari_erronka/denda.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL eguneraketa prestatua
        $sql = 'UPDATE produktuak2 
                SET id_kategoria = :id_kategoria,
                    marka = :marka,
                    modeloa = :modeloa,
                    prezioa = :prezioa,
                    nobedadeak = :nobedadeak,
					deskontuak = :deskontuak 
                WHERE id = :id';

        $stmt = $db->prepare($sql);

        // Parametroak lotu
        $stmt->bindValue(':id_kategoria', $produktua->getId_Kategoria(), PDO::PARAM_INT);
        $stmt->bindValue(':marka',        $produktua->getMarka(),       PDO::PARAM_STR);
        $stmt->bindValue(':modeloa',      $produktua->getModeloa(),     PDO::PARAM_STR);
        $stmt->bindValue(':prezioa',      $produktua->getPrezioa(),     PDO::PARAM_STR);
        $stmt->bindValue(':nobedadeak',   $produktua->getNobedadeak(),  PDO::PARAM_INT);
        $stmt->bindValue(':id', $produktua->getId(), PDO::PARAM_INT);
		$deskontuaDecimal = $produktua->getDeskontuak();
		$stmt->bindValue(':deskontuak', $deskontuaDecimal, PDO::PARAM_STR);

		
        // Sententzia exekutatu
        $emaitza = $stmt->execute();

        // Itzuli emaitza
        return $emaitza ? 1 : 0;

    } catch (Exception $e) {
        echo "<p>Errorea: " . $e->getMessage() . "</p>\n";
        return 0;
    }
}


}
?>
