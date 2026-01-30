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
        <img class="zesta" src="../img/zesta.png" alt="" height="120px">
    </header>

    <nav>
    <p><a href=".." style="color:white; text-decoration:none;">Hasiera</a></p>
    <p><a href="katalogoa.php" style="color:white; text-decoration:none;">Katalogoa</a></p>
    <p>Gure buruz</p>
    <p>Kontaktua</p>
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
                <h2>Bidaliguzu mezu bat</h2>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="izena">Izena:</label>
                        <input type="text" id="izena" name="izena" placeholder="Zure izena" required>
                    </div>

                    <div class="form-group">
                        <label for="emaila">Posta Elektronikoa:</label>
                        <input type="email" id="emaila" name="emaila" placeholder="adibidea@email.com" required>
                    </div>
					
                    <div class="form-group">
                        <label for="mezua">Mezua:</label>
                        <textarea id="mezua" name="mezua" rows="5" placeholder="Idatzi hemen zure galdera..." required></textarea>
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
