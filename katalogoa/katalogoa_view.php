<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Katalogoa: <?= $kategoria_izena ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/view.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    
    <header class="main-header">
        <div class="logo-container">
            <a href="..">
                <img class="logoa" src="../img/logo.png" alt="PescaNova Logo">
            </a>
        </div>
        <div class="titulos-centrales"> 
            <h1>PescaNova</h1> 
            <h3>Arrain-denda</h3>       
        </div>          
        <div class="cart-container">
            <a href="../saskia/index.php" class="zesta-link">
                <img class="zesta" src="../img/zesta.png" alt="Saskia">
                <span class="cart-text">Saskia</span>
            </a>
        </div>
    </header>

    <nav class="main-nav">
        <ul>
            <li><a href="..">Hasiera</a></li>
            <li><a href="index.php" class="active">Katalogoa</a></li>
            <li><a href="../gehiago/gehiago.html">Gehiago</a></li>
            <li><a href="../kontaktua/kontaktua.php">Kontaktua</a></li>
        </ul>
    </nav>

    <main class="hiru">
        <h2 style="text-align:center;" class="izena"><?= $kategoria_izena ?> produktuak</h2>
        <hr>
        <p class="link"><a href="index.php">&#8592; Atzera</a></p>
        
        <section class="produktuak-section"> 
            <?php if (count($produktuak) > 0): ?>
                <?php foreach ($produktuak as $p): ?>
                    <div class="produktua-card">
                        
                        <img src="../img/<?= htmlspecialchars($p->getIrudia()) ?>" alt="<?= htmlspecialchars($p->getMarka()) ?>">
                        
                        <h3><?= htmlspecialchars($p->getMarka()) ?></h3>
                        <p><?= htmlspecialchars($p->getModeloa()) ?></p>

                        <?php 
                            // Cálculos visuales para el listado
                            $prezioa_list = floatval($p->getPrezioa());
                            $desk_list = floatval($p->getDeskontuak());
                            $finala_list = round($prezioa_list * (1 - $desk_list), 2);
                        ?>

                        <?php if ($desk_list > 0): ?>
                            <p class="viejo"><?= number_format($prezioa_list, 2, ',', '.') ?> €</p>
                            <p class="nuevo"><?= number_format($finala_list, 2, ',', '.') ?> €</p>
                            <p class="deskontua"><?= number_format($desk_list * 100, 0) ?>% deskontua</p>
                        <?php else: ?>
                            <p><?= number_format($prezioa_list, 2, ',', '.') ?> €</p>
                        <?php endif; ?>
                        
                        <a href="index.php?action=produktua&id=<?= $p->getId() ?>" class="btn-view">Ikusi gehiago</a>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Momentuz ez dago produkturik kategoria honetan.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer class="main-footer"> 
        <div class="brand-info">
            <h4>🐟 PescaNova</h4>
            <p>&copy; 2025 PescaNova. Eskubide guztiak erreserbatuta.</p>
        </div>
    </footer>
</body>
</html>