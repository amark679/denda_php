<?php
if (!isset($errorea)) { 
        $errorea = ""; 
    }
	
$feedback = ""; 


if (isset($_GET['egoera'])) {
    
    if ($_GET['egoera'] == 'ondo') {
        $feedback = "<div style='color: white; background-color: #1a838f; padding: 10px; text-align: center; margin-bottom: 10px;'>Mezua ondo bidali da! Eskerrik asko.</div>";
    } 
    elseif ($_GET['egoera'] == 'errorea') {
        $feedback = "<div style='color: white; background-color: red; padding: 10px; text-align: center; margin-bottom: 10px;'>Arazo bat egon da. Saiatu berriro.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="../css/index.css">
	<link rel="stylesheet" href="../css/kontaktua.css">
	
</head>
<body>
	<header>
        <a href=".."><img class="logoa" src="../img/logo.png" alt="" height="100px"></a>
        <div class="titulos-centrales"> 
            <h1>PescaNova</h1> 
            <h3>Arrain-denda</h3>       
        </div>         
        <a href="../saskia/index.php"><img class="zesta" src="../img/zesta.png" alt="" height="120px"></a>
    </header>

    <nav>
    <p><a href=".." style="color:white; text-decoration:none;">Hasiera</a></p>
    <p><a href="../katalogoa/index.php" style="color:white; text-decoration:none;">Katalogoa</a></p>
    <p><a href="../gehiago/gehiago.html" style="color:white; text-decoration:none;">Gehiago</a></p>
    <p><a href="../kontaktua/kontaktua.php" style="color:white; text-decoration:none;">Kontaktua</a></p>
</nav>


<hr>

<main>
		<h2 style="text-align: center">Kontaktua</h2>
		<hr>
        <div class="kontaktu-container">
            
            <div class="info-box">
                <h2>Harremanetarako Datuak</h2>
                <p>Zalantzarik baduzu edo gurekin harremanetan jarri nahi baduzu, hemen gaituzu.</p>
                <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
                
                <div class="dato">
                    <strong>📍 Helbidea:</strong>
                    <span>Xemein Hiribidea, 19-17, 48270<br>Markina-Xemein, Bizkaia</span>
                </div>

                <div class="dato">
                    <strong>📞 Telefonoa:</strong>
                    <span>94 625 11 22</span>
                </div>

                <div class="dato">
                    <strong>📧 Emaila:</strong>
                    <span>info@pescanova.eus</span>
                </div>

                <div class="dato">
                    <strong>🕒 Ordutegia:</strong>
                    <span>
                        Al-Or: 08:00 - 14:00<br>
                        Arratsaldez: 17:00 - 20:00<br>
                        Larunbatetan: 09:00 - 13:00
                    </span>
                </div>
            </div>

            <div class="form-box">
			
			<?php echo $feedback; ?>
			<?php if (!empty($errorea)): ?>
				<div style='color: white; background-color: orange; padding: 10px;'>
					<?php echo $errorea; ?>
				</div>
			<?php endif; ?>
						
                <h2>Bidaliguzu mezu bat</h2>
                <form action="mezua_gorde.php" method="POST">
                    <div class="form-group">
                        <label for="izena">Izena:</label>
                        <input type="text" id="izena" name="izena" placeholder="Zure izena">
                    </div>

                    <div class="form-group">
                        <label for="emaila">Posta Elektronikoa:</label>
                        <input type="email" id="emaila" name="emaila" placeholder="adibidea@email.com">
                    </div>
					
                    <div class="form-group">
                        <label for="mezua">Mezua:</label>
                        <textarea id="mezua" name="mezua" rows="5" placeholder="Idatzi hemen zure galdera..."></textarea>
                    </div>

                    <button type="submit" class="bidali-btn">Bidali Mezua</button>
                </form>
            </div>

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
