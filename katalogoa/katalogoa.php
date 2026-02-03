<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/katalogoa.css">
    <link rel="stylesheet" href="../css/index.css">
    <title>Katalogoa</title>
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

    <h2 style="text-align:center;">Kategoriak</h2>
    <hr>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($kategoriak as $k): ?>
                <div class="col">
                    <div class="card kategoria">
                        <img src="../img/<?= htmlspecialchars($k->getImg()) ?>"
                             class="kategoria-img mx-auto mt-3"
                             alt="<?= htmlspecialchars($k->getIzena()) ?>">

                        <div class="card-body">
                            <h3 class="card-title"><?= htmlspecialchars($k->getIzena()) ?></h3>
                            <p class="card-text"><?= htmlspecialchars($k->getDeskribapena()) ?></p>
                            
                            <a href="index.php?action=kategoria&id=<?= $k->getKategoria_id() ?>">
                                Ikusi produktuak
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <footer class="footer"> 
        <div class="brand-info">
            <h4>🐟 PescaNova</h4>
            <p>&copy; 2025 PescaNova.</p>
        </div>
    </footer>
</body>
</html>