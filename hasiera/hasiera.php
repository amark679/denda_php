<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PescaNova - Arrain-denda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    
    <header class="main-header">
        <div class="logo-container">
            <img class="logoa" src="img/logo.png" alt="PescaNova Logo">
        </div>
        <div class="titulos-centrales"> 
            <h1>PescaNova</h1> 
            <h3>Arrain-denda</h3>       
        </div>         
        <div class="cart-container">
            <a href="saskia" class="zesta-link">
                <img class="zesta" src="img/zesta.png" alt="Saskia">
                <span class="cart-text">Saskia</span>
            </a>
        </div>
    </header>

    <nav class="main-nav">
        <ul>
            <li><a href="">Hasiera</a></li>
            <li><a href="katalogoa/index.php">Katalogoa</a></li>
            <li><a href="gehiago/gehiago.html">Gehiago</a></li>
            <li><a href="kontaktua/kontaktua.php">Kontaktua</a></li>
        </ul>
    </nav>

    <main>
        <div class="hero-banner">
            <img src="img/argazki1.jpg" alt="Pescadería fresca">

        </div>

        <div class="features-section">
            <div class="container">
                <div class="feature-card">
                    <img src="img/pago.png" alt="Pago">
                    <p>Ordainketa fidagarria</p>
                </div>
                <div class="feature-card">
                    <img src="img/envio.png" alt="Envío">
                    <p>24/48 ordutan</p>
                </div>
                <div class="feature-card">
                    <img src="img/devolucion.png" alt="Devolución">
                    <p>Itzultze erraza</p>
                </div>
                <div class="feature-card">
                    <img src="img/gratis.png" alt="Gratis">
                    <p>Bidalketa doan +60€</p>
                </div>
            </div>
        </div>

        <section class="products-section new-arrivals">
            <div class="section-header">
                <h2>Nobedadeak</h2>
                <div class="separator"></div>
            </div>
            
            <div class="product-grid">
                <?php if (count($nobedadeak) > 0): ?>
                    <?php foreach ($nobedadeak as $p): ?>
                        <article class="product-card">
                            <div class="img-wrapper">
                                <img src="img/<?= htmlspecialchars($p['irudia']) ?>" alt="<?= htmlspecialchars($p['marka']) ?>" >
                            </div>
                            <div class="card-content">
                                <h3><?= htmlspecialchars($p['marka']) ?></h3>
                                <p class="model"><?= htmlspecialchars($p['modeloa']) ?></p>
                                <p class="price"><?= number_format($p['prezioa'], 2) ?> €</p>
                                <a href="katalogoa/index.php?action=produktua&id=<?= $p['id'] ?>" class="btn-view">Ikusi produktua</a>       
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="empty-msg">Ez dago nobedadearik momentuz.</p>
                <?php endif; ?>
            </div>
        </section>

        <section class="products-section offers">
            <div class="section-header">
                <h2>Eskaintzak</h2>
                <div class="separator"></div>
            </div>

            <div class="product-grid">
                <?php if (count($deskontuak) > 0): ?>
                    <?php foreach ($deskontuak as $p): ?>
                    <article class="product-card offer-card">
                        <div class="img-wrapper">
                            <img src="img/<?= htmlspecialchars($p['irudia']) ?>" alt="<?= htmlspecialchars($p['marka']) ?>">
                        </div>
                        <div class="card-content">
                            <h3><?= htmlspecialchars($p['marka']) ?></h3>
                            <p class="model"><?= htmlspecialchars($p['modeloa']) ?></p>

                            <?php 
                                $prezioa = floatval($p['prezioa']);
                                $desk = floatval($p['deskontuak']);
                                $finala = round($prezioa * (1 - $desk), 2);
                            ?>

                            <?php if ($desk > 0): ?>
                                <div class="price-container">
                                    <span class="old-price"><?= number_format($prezioa, 2) ?> €</span>
                                    <span class="new-price"><?= number_format($finala, 2) ?> €</span>
                                </div>
                                <div class="discount-badge">-<?= number_format($desk * 100, 0) ?>%</div>
                            <?php else: ?>
                                <p class="price"><?= number_format($prezioa, 2) ?> €</p>
                            <?php endif; ?>
                            
                            <a href="katalogoa/index.php?action=produktua&id=<?= $p['id'] ?>" class="btn-view">Ikusi produktua</a>
                        </div>
                    </article>
                <?php endforeach; ?>
                <?php else: ?>
                    <p class="empty-msg">Ez dago eskaintzarik momentuz.</p>
                <?php endif; ?>
            </div>
        </section>

    </main>
    
    <footer class="main-footer"> 
        <div class="brand-info">
            <h4>🐟 PescaNova</h4>
            <p>&copy; 2025 Eskubide guztiak erreserbatuta.</p>
        </div>
    </footer>
</body>
</html>