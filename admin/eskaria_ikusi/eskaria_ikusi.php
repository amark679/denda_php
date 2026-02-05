<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Eskaria Ikusi</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h1, h2 { color: #333; }
        
        /* Estilo para tablas */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        
        /* Estilo específico para la tabla de productos */
        .prod-table th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .total-row { font-weight: bold; background-color: #e8e8e8; }
        
        /* Botones */
        .btn { padding: 8px 15px; text-decoration: none; background-color: #555; color: white; border-radius: 4px; }
        .btn:hover { background-color: #333; }
        .btn-gorde {
            background-color: #c43636;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <p><a href=".." class="btn">&laquo; Atzera zerrendara</a></p>

    <h1>Eskariaren Xehetasunak (ID: <?= $eskaria->getId() ?>)</h1>
    <p><strong>Data:</strong> <?= $eskaria->getData() ?></p>

    <hr>

    <?php $bezeroa = $eskaria->getBezeroa(); ?>
    
    <h2>👤 Bezeroaren Datuak</h2>
    <table>
        <tr>
            <th style="width: 150px;">Izena eta Abizena:</th>
            <td><?= htmlspecialchars($bezeroa->getIzena() . " " . $bezeroa->getAbizena()) ?></td>
        </tr>
        <tr>
            <th>Emaila:</th>
            <td><?= htmlspecialchars($bezeroa->getEmaila()) ?></td>
        </tr>
        <tr>
            <th>Helbidea:</th>
            <td>
                <?= htmlspecialchars($bezeroa->getHelbidea()) ?><br>
                <?= htmlspecialchars($bezeroa->getPostakodea()) ?> - <?= htmlspecialchars($bezeroa->getHerria()) ?> (<?= htmlspecialchars($bezeroa->getProbintzia()) ?>)
            </td>
        </tr>
    </table>

    <br>

    <h2>🛒 Erositako Produktuak</h2>
    <table class="prod-table">
        <thead>
            <tr>
                <th>Produktua</th>
                <th class="text-right">Prezioa (Unit)</th>
                <th class="text-right">Kopurua</th>
                <th class="text-right">Guztira</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $detaileak = $eskaria->getDetaileak();
            $totalaOsoa = 0;

            if (!empty($detaileak)): 
                foreach ($detaileak as $det):
                    $prod = $det->getProduktua();
                    
                  
                    $kopurua = (int)$det->getKopurua();

                    $prezioaUnitario = $prod->getPrezioa() * (1 - $prod->getDeskontuak()); 
                    $totalLinea = $prezioaUnitario * $kopurua;
                    
                    $totalaOsoa += $totalLinea;
            ?>
                <tr>
                    <td>
                        <b><?= htmlspecialchars($prod->getMarka()) ?></b> <?= htmlspecialchars($prod->getModeloa()) ?>
                    </td>
                    <td class="text-right"><?= number_format($prezioaUnitario, 2) ?> €</td>
                    <td class="text-right"><?= $kopurua ?></td>
                    <td class="text-right"><?= number_format($totalLinea, 2) ?> €</td>
                </tr>
            <?php endforeach; ?>
            
            <tr class="total-row">
                <td colspan="3" class="text-right">ESKARIA GUZTIRA:</td>
                <td class="text-right"><?= number_format($totalaOsoa, 2) ?> €</td>
            </tr>

            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Ez dago produkturik eskari honetan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        
    </table>
    <form method="post" action="index.php?id=<?= $eskaria->getId() ?>">
		<input type="hidden" name="id" value="<?= $eskaria->getId() ?>">
        <button type="submit">Ezabatu eskaria</button>
    </form>

</body>
</html>