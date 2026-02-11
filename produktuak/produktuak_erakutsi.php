<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktuak - PescaNova</title>
    <link rel="stylesheet" href="../css/index.css"> 
    <link rel="stylesheet" href="../css/buscador.css"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
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
            <li><a href="../katalogoa/index.php">Katalogoa</a></li>
            <li><a href="../gehiago/gehiago.html">Gehiago</a></li>
            <li><a href="../kontaktua/kontaktua.php">Kontaktua</a></li>
            <li><a href="../produktuak/index.php">Produktuak</a></li>
        </ul>
    </nav>

    <main>
        <section class="products-section">
            <div class="section-header">
                <h2>Katalogoa</h2>
                <div class="separator"></div>
            </div>

            <div class="filtro-wrapper">
                <input type="text" id="buscador-categoria" placeholder="Bilatu produktuak..." autocomplete="off">
            </div>

            <div class="product-grid" id="lista-productos">
                
                <?php if (!empty($produktuak)): ?>
                    <?php foreach ($produktuak as $p): ?>
                        
                        <article class="product-card producto-card">
                            <div class="img-wrapper">
                                <img src="../img/<?= htmlspecialchars($p['irudia']) ?>" alt="<?= htmlspecialchars($p['marka']) ?>">
                            </div>
                            
                            <div class="card-content">
                                <h3><?= htmlspecialchars($p['marka']) ?></h3>
                                <p class="model"><?= htmlspecialchars($p['modeloa']) ?></p>

                                <?php 
                                    // Cálculos de precio (igual que antes)
                                    $prezioa = floatval($p['prezioa']);
                                    $desk = floatval($p['deskontuak']); 
                                    $finala = $prezioa - ($prezioa * $desk);
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
                                
                                <a href="../katalogoa/index.php?action=produktua&id=<?= $p['id'] ?>" class="btn-view">Ikusi produktua</a>
                            </div>
                        </article>

                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="empty-msg">Ez dago produkturik une honetan.</p>
                <?php endif; ?>

            </div>

            <p id="sin-resultados">Ez da produkturik aurkitu bilaketa honekin.</p>

        </section>
    </main>

    <script>
        $(document).ready(function() {
            // Detectar cuando se escribe en el input
            $('#buscador-categoria').on('keyup', function() {
                var valor = $(this).val().toLowerCase();
                var contador = 0;

        
                $('.producto-card').each(function() {
                    
                    var textoTarjeta = $(this).text().toLowerCase();

                    
                    if (textoTarjeta.indexOf(valor) > -1) {
                        $(this).fadeIn(200); 
                        contador++;
                    } else {
                        $(this).fadeOut(200); 
                    }
                });

                
                setTimeout(function() {
                    
                    var visibles = $('.producto-card:visible').length;
                    if (visibles === 0) {
                        $('#sin-resultados').show();
                    } else {
                        $('#sin-resultados').hide();
                    }
                }, 250);
            });
        });
    </script>
</body>
</html>