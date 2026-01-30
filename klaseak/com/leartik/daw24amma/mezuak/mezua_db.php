<?php
namespace com\leartik\daw24amma\mezuak;

require_once(__DIR__ . '/mezua.php');

use com\leartik\daw24amma\produktuak\Produktua;

use Exception;
use PDO;

class MezuaDB
{
    public static function selectMezuak() {
		
    try {
        $db = new PDO("sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/zerbitzari_erronka_proba/denda.db");       
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepared statement (aunque no tiene parámetros, es buena práctica)
        $stmt = $db->prepare("SELECT * FROM mezuak");
        $stmt->execute();

        $mezuak = array();
        while ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $mezua = new Mezua();
            $mezua->setId($erregistroa['id']);
            $mezua->setIzena($erregistroa['izena']);
            $mezua->setEmail($erregistroa['email']);
			$mezua->setMezua($erregistroa['mezua']);
			$mezua->setErantzuna($erregistroa['erantzuna']);
            $mezuak[] = $mezua;
        }

        return $mezuak;

    } catch (Exception $e) {
        echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
        return null;
    }
	}

	public static function selectMezua($id){
    try {
        $db = new PDO("sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/zerbitzari_erronka_proba/denda.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("SELECT * FROM mezuak WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($erregistroa = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $mezua = new Mezua();
            $mezua->setId($erregistroa['id']);
            $mezua->setIzena($erregistroa['izena']);
            $mezua->setEmail($erregistroa['email']);
			$mezua->setMezua($erregistroa['mezua']);
			$mezua->setErantzuna($erregistroa['erantzuna']);
            return $mezua;
        } else {
            return null;
        }

    } catch (Exception $e) {
        echo "<p>Salbuespena: " . $e->getMessage() . "</p>\n";
        return null;
    }
}
	
   public static function insertMezua($mezua){
	   
    try {
        // Conexión a la base de datos SQLite
        $db = new PDO("sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/zerbitzari_erronka_proba/denda.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Sentencia SQL preparada
        $sql = 'INSERT INTO mezuak (izena, email, mezua, erantzuna)
                VALUES (:izena, :email, :mezua, :erantzuna)';

        $stmt = $db->prepare($sql);

        // Enlazar parámetros
        $stmt->bindValue(':id', $mezua->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':izena',      $mezua->getIzena(),     PDO::PARAM_STR);
        $stmt->bindValue(':email',      $mezua->getEmail(),     PDO::PARAM_STR);
		$stmt->bindValue(':mezua',      $mezua->getMezua(),     PDO::PARAM_STR);
        $stmt->bindValue(':erantzuna',      $mezua->getErantzuna(),     PDO::PARAM_STR);
 

        // Ejecutar sentencia
        $emaitza = $stmt->execute();

        return $emaitza ? 1 : 0;

    } catch (Exception $e) {
        echo "<p>Errorea: " . $e->getMessage() . "</p>\n";
        return 0;
    }
	}
	public static function mezuaDelete($id){
	    
        try {
            // Konexioa datu-basera (PDO erabiliz, zure adibidean bezala)
			$db = new PDO("sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/zerbitzari_erronka_proba/denda.db");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Sententzia SQL prestatua: Kategoria IDaren bidez ezabatu
            $sql = 'DELETE FROM mezuak 
                    WHERE id = :id';

            $stmt = $db->prepare($sql);

            // Parametroa lotu: Kategoria IDa
            // Zuzeneko balioa erabili ordez, ezabatu beharreko IDa pasatzen dugu.
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            

            // Sententzia exekutatu
            $emaitza = $stmt->execute();
            
            // Konexioa itxi (aukerazkoa, PHPk saioa amaitzean egiten du, baina praktika ona da)
            $db = null; 

     
            return $emaitza ? 1 : 0;

        } catch (Exception $e) {
            echo "<p>Errorea: " . $e->getMessage() . "</p>\n";
            return 0;
        }
    }
	public static function mezuaUpdate($mezua) {
    try {
        $db = new PDO("sqlite:C:/Users/lai2/Desktop/Markatzeko lenguaiak/htdocs/web_garapena_zerbitzari_ingurunean/zerbitzari_erronka_proba/denda.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 

        $sql = 'UPDATE mezuak
                SET izena = :izena,
                    email = :email,
                    mezua = :mezua,
                    erantzuna = :erantzuna
                WHERE id = :id';

        $stmt = $db->prepare($sql);

      
        $stmt->bindValue(':izena',     $mezua->getIzena(),     PDO::PARAM_STR);
        $stmt->bindValue(':email',     $mezua->getEmail(),     PDO::PARAM_STR);
        $stmt->bindValue(':mezua',     $mezua->getMezua(),     PDO::PARAM_STR);
        

        // Usamos PARAM_INT para asegurar que se guarda como numero (0 o 1)
        $stmt->bindValue(':erantzuna', $mezua->getErantzuna(), PDO::PARAM_INT);
        
        $stmt->bindValue(':id',        $mezua->getId(),        PDO::PARAM_INT);

        $emaitza = $stmt->execute();
        
        // Debug (puedes borrarlo luego)
        // $filasAfectadas = $stmt->rowCount();
        // echo "<p style='color: green;'>DEBUG: Filas Actualizadas: " . $filasAfectadas . "</p>";

        $db = null;

        return $emaitza ? 1 : 0;

    } catch (Exception $e) {
        echo "<p>Errorea: " . $e->getMessage() . "</p>\n";
        return 0;
    }
}


}
?>