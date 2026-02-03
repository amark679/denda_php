<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/view.css">
    <link rel="stylesheet" href="../css/index.css">
    <title>Katalogoa: <?= $kategoria_izena ?></title>
</head>
<body>
    <header>
        <a href=".."><img class="logoa" src="../img/logo.png" alt="" height="100px"></a>
        <div class="titulos-centrales"> 
            <h1>PescaNova</h1> 
            <h3>Arrain-denda</h3>     
        </div>           
        <a href="../saskia/index.php" class="zesta-link">
            <img class="zesta" src="../img/zesta.png" alt="" height="120px">
        </a>
    </header>

   <nav>
        <p><a href=".." style="color:white; text-decoration:none;">Hasiera</a></p>
        <p><a href="index.php" style="color:white; text-decoration:none;">Katalogoa</a></p>
        <p><a href="../gehiago/gehiago.html" style="color:white; text-decoration:none;">Gehiago</a></p>
        <p><a href="../kontaktua/kontaktua.php" style="color:white; text-decoration:none;">Kontaktua</a></p>
    </nav>

<main class="hiru">
    <h2 style="text-align:center;"><?= $kategoria_izena ?> produktuak</h2>
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
                    
                    <a href="index.php?action=produktua&id=<?= $p->getId() ?>">Ikusi gehiago</a>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Momentuz ez dago produkturik kategoria honetan.</p>
        <?php endif; ?>
    </section>
</main>

<footer class="footer"> 
    <div class="brand-info">
        <h4>🐟 PescaNova</h4>
        <p>&copy; 2025 PescaNova.</p>
    </div>
</footer>
</body>
</html>