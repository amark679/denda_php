<?php
if (!isset($_SESSION['saskia'])) {
    $detaileak = [];
} else {
    $saskia = $_SESSION['saskia'];
    $detaileak = $saskia->getDetaileak();
}
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saskia - PescaNova</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/index.css">   <link rel="stylesheet" href="../css/saskia.css">  <style>
        .input-qty { width: 50px; text-align: center; padding: 3px; }
        .form-inline { display: inline-flex; align-items: center; gap: 5px; justify-content: center; }
        .btn-update { background-color: #ffc107; border: none; padding: 5px; cursor: pointer; border-radius: 3px; }
        .btn-delete { background-color: #dc3545; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 3px; }
    </style>
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
            <a href="index.php" class="zesta-link">
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
        </ul>
    </nav>

    <main>
        <div class="saskia-container">
            <h2>Zure Saskia</h2>
            <hr>

            <?php if (empty($detaileak)): ?>
                
                <div style="margin: 50px;">
                    <p>Zure saskia hutsik dago.</p>
                    <br>
                    <a href="../katalogoa/index.php" class="btn-jarraitu">Erosketak egiten jarraitu</a>
                </div>

            <?php else: ?>

                <table class="saskia-table">
                    <thead>
                        <tr>
                            <th>Irudia</th>
                            <th>Produktua</th>
                            <th>Marka</th>
                            <th>Prezioa</th>
                            <th>Kopurua</th>
                            <th>Guztira</th>
                            <th>Ezabatu</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totalaGlobal = 0;
                        
                        // EL BUCLE FOREACH EMPIEZA AQUÍ, DENTRO DE TBODY
                        foreach ($detaileak as $det): 
                            $prod = $det->getProduktua();
                            
                            $prezioa = $prod->getPrezioa();
                            $desk = $prod->getDeskontuak();
                            
                            // Calculamos precio unitario visual
                            if ($desk > 0) {
                                $prezioUnitarioFinal = $prezioa * (1 - $desk);
                            } else {
                                $prezioUnitarioFinal = $prezioa;
                            }

                            // Subtotal (Detailea::getGuztira() ya debe tener el descuento aplicado)
                            $subtotal = $det->getGuztira();
                            $totalaGlobal += $subtotal;
                        ?>
                        <tr>
                            <td>
                                <img src="../img/<?= htmlspecialchars($prod->getIrudia()) ?>" alt="img" height="50">
                            </td>
                            <td><?= htmlspecialchars($prod->getModeloa()) ?></td>
                            <td><?= htmlspecialchars($prod->getMarka()) ?></td>
                            
                            <td>
                                <?php if ($desk > 0): ?>
                                    <br>
                                    
                                        <?= number_format($prezioUnitarioFinal, 2) ?> €
                                    
                                    
                                <?php else: ?>
                                    <?= number_format($prezioa, 2) ?> €
                                <?php endif; ?>
                            </td>

                            <td>
                                <form action="index.php" method="POST" class="form-inline">
                                    <input type="hidden" name="id_eguneratu" value="<?= $prod->getId() ?>">
                                    <input type="number" name="kopurua_berria" value="<?= $det->getKopurua() ?>" min="1" max="50" class="input-qty">
                                    <button type="submit" name="eguneratu" class="btn-update" title="Eguneratu kopurua">↻</button>
                                </form>
                            </td>

                            <td><?= number_format($subtotal, 2) ?> €</td>
                            
                            <td>
                                <form action="index.php" method="POST">
                                    <input type="hidden" name="id_eliminar" value="<?= $prod->getId() ?>">
                                    <button type="submit" name="ezabatu" class="btn-delete" title="Ezabatu produktua">X</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                </table>

                <div class="totala">
                    Ordaintzeko guztira: <?= number_format($totalaGlobal, 2) ?> €
                </div>

                <div style="margin-top: 30px;">
                    <a href="../katalogoa/" class="btn-jarraitu">Erosketak egiten jarraitu</a>
                    <a href="index.php?bista=datuak" class="btn-pagar">Ordainketa egin</a>
                </div>

            <?php endif; ?>
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