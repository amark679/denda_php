<?php

	$db_path = 'C:\Users\lai2\Desktop\Markatzeko lenguaiak\htdocs\web_garapena_zerbitzari_ingurunean\zerbitzari_erronka_proba\denda.db';


try {
    $db = new PDO("sqlite:$db_path");
    
    // Configurar PDO para que lance excepciones y evitar errores silenciosos
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // jasotako eskaria albiste bat eskuratzeko bada
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // ID-a balidatu: zenbakia izan behar du
            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(['error' => 'IDa baliogabea da. Zenbakia izan behar du.']);
                exit;
            }

            // albistearen datuak berreskuratzeko kontsulta exekutatu
            $stmt = $db->prepare("SELECT * FROM produktuak2 WHERE id=?");
			$stmt->execute([$id]);

            // albistea existitzen bada
            if ($erregistroa = $stmt->fetch()) {
                // albistearen datuak array baten gorde
                $produktua= array();
                $produktua['marka'] = $erregistroa['marka'];
                $produktua['modeloa'] = $erregistroa['modeloa'];
				$produktua['prezioa'] = $erregistroa['prezioa'];
				$produktua['id_kategoria'] = $erregistroa['id_kategoria'];
				$produktua['nobedadeak'] = $erregistroa['nobedadeak'];
				$produktua['irudia'] = $erregistroa['irudia'];
				$produktua['deskontuak'] = $erregistroa['deskontuak'];
				
				
                // array-a json formatura bihurtu eta bezeroarengana bidali
                echo json_encode($produktua, JSON_UNESCAPED_UNICODE);
            } else {
                // Albistea ez da aurkitu
                http_response_code(404); // Not Found
                echo json_encode(['error' => 'Ez da aurkitu ' . $id . ' IDa duen albisterik.']);
            }
            // bestela, jasotako eskaria albiste guztiak eskuratzeko bada
        } else {

            // albisteen datuak berreskuratzeko kontsulta exekutatu
            $sql = 'SELECT * FROM produktuak2';
			$params = [];
			
			$mota = $_GET['mota'] ?? null;
			
			if ($mota === 'nobedadeak') {
                $sql .= " WHERE nobedadeak = 1";
            } elseif ($mota === 'deskontuak') {
                $sql .= " WHERE deskontuak > 0";
            }
           
            $sql .= " ORDER BY id";
			
            $erregistroak = $db->prepare($sql);
            $erregistroak->execute($params);

            // albisteak existitzen badira
            if ($erregistroa = $erregistroak->fetch()) {
                // albisteen datuak array baten gorde
                $produktuak = array();
                $i = 0;
                do {
                    $produktuak[$i]['id'] = (int)$erregistroa['id'];
                    $produktuak[$i]['marka'] = $erregistroa['marka'];
                    $produktuak[$i]['modeloa'] = $erregistroa['modeloa'];
					$produktuak[$i]['prezioa'] = $erregistroa['prezioa'];
					$produktuak[$i]['id_kategoria'] = $erregistroa['id_kategoria'];
					$produktuak[$i]['nobedadeak'] = $erregistroa['nobedadeak'];
					$produktuak[$i]['irudia'] = $erregistroa['irudia'];
					$produktuak[$i]['deskontuak'] = $erregistroa['deskontuak'];
                    $i = $i + 1;
                } while ($erregistroa = $erregistroak->fetch());

                // albisteen bilduma json formatura bihurtu eta bezeroarengana bidali
                echo json_encode($produktuak, JSON_UNESCAPED_UNICODE);
            }
        }
    }
	// ======================================
    // POST → Insertatu
    // ======================================
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		
		//JSON eskuratu
		$input = json_decode(file_get_contents("php://input"), true);
		
        $marka = $input['marka'];
        $modeloa = $input['modeloa'];
        $prezioa = $input['prezioa'];
		$id_kategoria = $input['id_kategoria'];
        $nobedadeak = $input['nobedadeak'];
        $irudia = $input['irudia'];
		$deskontuak = $input['deskontuak'];
		
		

        $sql = "INSERT INTO produktuak2 (marka, modeloa, prezioa, id_kategoria, nobedadeak, irudia, deskontuak)
                VALUES ('$marka', '$modeloa', '$prezioa', '$id_kategoria', '$nobedadeak', '$irudia', '$deskontuak')";
        
        if ($db->exec($sql)) {
            echo json_encode(['mezua' => 'Albistea sortu da']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Errorea sartzerakoan']);
        }
    }

    // ======================================
    // PUT → Aldatu
    // ======================================
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    
    $datos = json_decode(file_get_contents("php://input"), true);

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'ID de producto no válido o faltante.']);
        exit;
    }
    $id = $_GET['id'];
    
    $setClauses = [];
    
    // Función de ayuda para escapar datos en PDO
    // Esto es solo para corregir el error de sintaxis; en producción, usa bindParam/bindValue.
    $escape = function($value) use ($db) {
        return $db->quote($value);
    };

    if (isset($datos['marka'])) {
        $setClauses[] = "marka=" . $escape($datos['marka']);
    }
    
    if (isset($datos['modeloa'])) {
        $setClauses[] = "modeloa=" . $escape($datos['modeloa']);
    }

    // Y así sucesivamente para todos los campos...
    if (isset($datos['prezioa'])) {
        $setClauses[] = "prezioa=" . $escape($datos['prezioa']);
    }
    if (isset($datos['id_kategoria'])) {
        $setClauses[] = "id_kategoria=" . $escape($datos['id_kategoria']);
    }
    if (isset($datos['nobedadeak'])) {
        $setClauses[] = "nobedadeak=" . $escape($datos['nobedadeak']);
    }
    if (isset($datos['irudia'])) {
        $setClauses[] = "irudia=" . $escape($datos['irudia']);
    }
    if (isset($datos['deskontuak'])) {
        $setClauses[] = "deskontuak=" . $escape($datos['deskontuak']);
    }

    if (empty($setClauses)) {
        http_response_code(400);
        echo json_encode(['error' => 'No se proporcionaron datos para actualizar']);
        exit;
    }

    $setStatement = implode(', ', $setClauses);
    $sql = "UPDATE produktuak2 SET $setStatement WHERE id=$id";

    if ($db->exec($sql)) {
        // ...
    } else {
        // ...
    }
}

    // ======================================
    // DELETE → Ezabatu
    // ======================================
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        parse_str(file_get_contents("php://input"), $_DELETE);

        $id = $_GET['id'];

        $sql = "DELETE FROM produktuak2 WHERE id=$id";

        if ($db->exec($sql)) {
            echo json_encode(['mezua' => 'Albistea ezabatuta']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Errorea ezabatzerakoan']);
        }
    }
} catch (Exception $e) {
    echo null;
}
?>