<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalogoa - PescaNova</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/katalogoa.css">
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

    <main>
        
        <div class="section-header" style="margin-top: 40px;">
            <h2>Kategoriak</h2>
            <div class="separator"></div>
        </div>

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
                                
                                <a href="index.php?action=kategoria&id=<?= $k->getKategoria_id() ?>" class="btn-view" style="margin-top:10px; display:inline-block;">
                                    Ikusi produktuak
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </main>

    <footer class="main-footer"> 
        <div class="brand-info">
            <h4>🐟 PescaNova</h4>
            <p>&copy; 2025 PescaNova. Eskubide guztiak erreserbatuta.</p>
        </div>
    </footer>

</body>
</html>