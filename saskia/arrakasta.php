<?php

require('../klaseak/com/leartik/daw24amma/bezeroak/Bezeroa.php');
require('../klaseak/com/leartik/daw24amma/eskariak/Eskaria.php');

session_start();

use com\leartik\daw24amma\eskariak\Eskaria;
use com\leartik\daw24amma\bezeroak\Bezeroa;


if (!isset($_SESSION['eskaria_finala'])) {
    header("Location: index.php");
    exit();
}


$eskaria = $_SESSION['eskaria_finala'];
$bezeroa = $eskaria->getBezeroa();

?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eskerrik Asko! - PescaNova</title>
    <link rel="stylesheet" href="../css/index.css">
    <style>
        .confirmation-box {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
            padding: 40px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9fff9; /* Verde muy clarito */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .check-icon {
            color: #28a745;
            font-size: 50px;
            margin-bottom: 20px;
        }
        .btn-home {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-home:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <a href=".."><img class="logoa" src="../img/logo.png" alt="" height="100px"></a>
        <div class="titulos-centrales"> 
            <h1>PescaNova</h1> 
      
        </div>         
    </header>

    <main>
        <div class="confirmation-box">
            <div class="check-icon">✓</div>
            
            <h1>Eskerrik asko, <?= htmlspecialchars($bezeroa->getIzena()) ?>!</h1>
            
            <p>Zure erosketa ondo burutu da.</p>
            <br>
            <p><strong>Data:</strong> <?= $eskaria->getData() ?></p>
            
            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
            
            <p>Mezu bat bidali dizugu honako helbidera:</p>
            <p style="color: #555;"><strong><?= htmlspecialchars($bezeroa->getEmaila()) ?></strong></p>

            <br>
            <a href="../katalogoa/index.php" class="btn-home">Jarraitu erosketak egiten</a>
        </div>
    </main>

    <footer class="footer"> 
        <div class="brand-info">
            <h4>🐟 PescaNova</h4>
            <p>&copy; 2025 PescaNova.</p>
        </div>
    </footer>
</body>
</html>