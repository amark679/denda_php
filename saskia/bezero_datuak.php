<?php
if (isset($_SESSION['saskia'])) {
    $saskia = $_SESSION['saskia'];
    $detaileak = $saskia->getDetaileak();
} else {
    $detaileak = [];
}
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PescaNova</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/bezero_datuak.css"> 

</head>
<body>
    <header>
        <a href=".."><img class="logoa" src="../img/logo.png" alt="" height="100px"></a>
        <div class="titulos-centrales"> 
            <h1>PescaNova</h1>      
        </div>         
    </header>

      <nav>
        <p><a href="index.php" style="color:white; text-decoration:none;">Hasiera</a></p>
        <p><a href="../katalogoa/katalogoa.php" style="color:white; text-decoration:none;">Katalogoa</a></p>
        <p><a href="../gehiago/gehiago.html" style="color:white; text-decoration:none;">Gehiago</a></p>
        <p><a href="../kontaktua/kontaktua.php" style="color:white; text-decoration:none;">Kontaktua</a></p>
    </nav>

    <main>
        <div class="summary-container">
            <h3 class="summary-title">Erosketaren Laburpena</h3>
            
                <table class="summary-table">
                    <thead>
                        <tr>
                            <th>Produktua</th>
                            <th>Kop.</th>
                            <th style="text-align:right;">Prezioa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totala = 0;
                        foreach ($detaileak as $det): 
                            $prod = $det->getProduktua();
                            
                            $lineaTotal = $det->getGuztira();
                            $totala += $lineaTotal;
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($prod->getMarka()) . " " . htmlspecialchars($prod->getModeloa()) ?></td>
                            <td><?= $det->getKopurua() ?></td>
                            <td style="text-align:right;"><?= number_format($lineaTotal, 2) ?> €</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="summary-total">
                    Guztira: <?= number_format($totala, 2) ?> €
                </div>
        </div>
        <div class="form-container">
            <h2>Bezeroaren Datuak</h2>
            <hr><br>
            
            <form action="index.php" method="POST">
                <?php if (!empty($errorea)): ?>
                    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border: 1px solid #f5c6cb; border-radius: 4px;">
                        <?= $errorea ?>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="izena">Izena:</label>
                    <input type="text" id="izena" name="izena" required>
                </div>

                <div class="form-group">
                    <label for="abizena">Abizena:</label>
                    <input type="text" id="abizena" name="abizena" required>
                </div>

                <div class="form-group">
                    <label for="emaila">Emaila:</label>
                    <input type="email" id="emaila" name="emaila" required>
                </div>

                <div class="form-group">
                    <label for="helbidea">Helbidea:</label>
                    <input type="text" id="helbidea" name="helbidea" required>
                </div>

                <div class="form-group">
                    <label for="herria">Herria:</label>
                    <input type="text" id="herria" name="herria" required>
                </div>

                <div class="form-group">
                    <label for="probintzia">Probintzia:</label>
                    <input type="text" id="probintzia" name="probintzia" required>
                </div>

                <div class="form-group">
                    <label for="postakodea">Posta Kodea:</label>
                    <input type="text" id="postaKodea" name="postaKodea" title="5 digituko kodea" required>
                </div>

                <br>
                <button type="submit" name="gorde_datuak" class="btn-gorde">Jarraitu</button>
            </form>
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