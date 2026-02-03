<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/produktua.css">
    <title><?= htmlspecialchars($p->getMarka()) ?></title>
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

<main class="main-content">
    <div class="produktua">

        <a href="index.php?action=kategoria&id=<?= $kategoria_id ?>" class="link">← Atzera</a>

        <img src="../img/<?= htmlspecialchars($p->getIrudia()) ?>" class="irudia">

        <h1 class="marka"><?= htmlspecialchars($p->getMarka()) ?></h1>
        <h2 class="modeloa"><?= htmlspecialchars($p->getModeloa()) ?></h2>

        <hr class="divider">

        <div class="prezioen-gunea">
            <?php if ($desk > 0): ?>
                <p class="prezio-zaharra">Prezioa: <?= number_format($prezioa, 2) ?> €</p>
                <p class="prezio-berria"><?= number_format($finala, 2) ?> €</p>
                <span class="deskontua"><?= intval($desk * 100) ?>% DESKONTUA</span>
            <?php else: ?>
                <p class="prezio-arrunta"><?= number_format($prezioa, 2) ?> €</p>
            <?php endif; ?>
        </div>

        <form action="../saskia/index.php" method="POST" >
            <input type="hidden" name="id" value="<?= $p->getId() ?>">
            <div class="kantitatea-selector" style="margin-bottom: 10px;">
                <label for="kopurua">Kopurua:</label>
                <input type="number" id="kopurua" name="kopurua" value="1" min="1" max="50" style="padding: 5px; width: 60px; text-align: center;">
            </div>
            <button type="submit" name="gehitu" class="btn-agregar">Saskira gehitu</button>
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