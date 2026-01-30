
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PescaNova</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header>
        <img class="logoa" src="img/logo.png" alt="" height="100px">
        <div class="titulos-centrales"> 
            <h1>PescaNova</h1> 
            <h3>Arrain-denda</h3>       
        </div>         
        <a href="saskia"><img class="zesta" src="img/zesta.png" alt="" height="120px"><a/>
    </header>

    <nav>
    <p><a href=".." style="color:white; text-decoration:none;">Hasiera</a></p>
    <p><a href="katalogoa/katalogoa.php" style="color:white; text-decoration:none;">Katalogoa</a></p>
    <p><a href="gehiago/gehiago.html" style="color:white; text-decoration:none;">Gehiago</a></p>
    <p>Gure buruz</p>
    <p><a href="kontaktua/kontaktua.php" style="color:white; text-decoration:none;">Kontaktua</a></p>
</nav>

    <main>
        <div class="bat">
            <img src="img/argazki1.jpg" alt="">
        </div>

        <div class="bi">
            <section class="servicios">
                <div class="pago">
                    <p>Ordainketa fidagarria</p>
                    <img src="img/pago.png" alt="" height="50px">
                </div>
                <div class="envio">
                    <p>24/48 ordutan</p>
                    <img src="img/envio.png" alt="" height="70px">
                </div>
                <div class="devolucion">
                    <p>Itzultze erraza</p>
                    <img src="img/devolucion.png" alt="" height="70px">
                </div>
                <div class="gratis">
                    <p>Bidalketa doainak 60€ tik aurrera</p>
                    <img src="img/gratis.png" alt="" height="70px">  
                </div>
            </section>
        </div>

        <!-- 🐟 NOBEDADEAK -->
        <div class="hiruu">
            <h2>Nobedadeak</h2>
            <hr>
            <section class="kategoriak">
                <?php if (count($nobedadeak) > 0): ?>
                    <?php foreach ($nobedadeak as $p): ?>
                        <div class="kategoria">
							<img src="img/<?= htmlspecialchars($p['irudia']) ?>" alt="<?= htmlspecialchars($p['marka']) ?>" >
                            <h3><?= htmlspecialchars($p['marka']) ?></h3>
                            <p><?= htmlspecialchars($p['modeloa']) ?></p>
							<p class="prezioa">Prezioa: <?= number_format($p['prezioa'], 2) ?> €</p>
									
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Ez dago nobedadearik momentuz.</p>
                <?php endif; ?>
            </section>
        </div>

        <!-- 💸 ESKAINTZAK -->
      
<div class="hiru">
    <h2>Eskaintzak</h2>
    <hr>
    <section class="kategoriak">
        <?php if (count($deskontuak) > 0): ?>
            <?php foreach ($deskontuak as $p): ?>
			<div class="kategoria">
				<img src="img/<?= htmlspecialchars($p['irudia']) ?>" alt="<?= htmlspecialchars($p['marka']) ?>">
				<h3><?= htmlspecialchars($p['marka']) ?></h3>
				<p><?= htmlspecialchars($p['modeloa']) ?></p>

				<?php 
					// Float bihurtu eta amaierako prezioa kalkulatu
					$prezioa = floatval($p['prezioa']);
					$desk = floatval($p['deskontuak']);
					$finala = round($prezioa * (1 - $desk), 2);
				?>

				<?php if ($desk > 0): ?>
					<p class="viejo" style="text-decoration: line-through;">
						<?= number_format($prezioa, 2) ?> €
					</p>
					<p class="nuevo" style="color:red; font-weight:bold;">
						<?= number_format($finala, 2) ?> €
					</p>
					<p class="deskontua" style="background-color: #28a745; color: white; padding: 2px 0px; border-radius: 5px; width:40%; margin-top:5px;"><?= number_format($desk * 100, 0) ?>% deskontua</p>
				<?php else: ?>
					<p><?= number_format($prezioa, 2) ?> €</p>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
        <?php else: ?>
            <p>Ez dago eskaintzarik momentuz.</p>
        <?php endif; ?>
    </section>
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




