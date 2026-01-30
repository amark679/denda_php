<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mezua Eguneratu</title>
    <style>
        table { border-collapse: collapse; }
        td { padding: 8px; vertical-align: top; }
        input[type="text"] { width: 300px; } /* Ancho de los inputs */
		tr {border: 1px solid black;}
		.gris{background-color: #5555;}
    </style>
</head>
<body>

<?php if ($mezua): ?>
    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a> &gt;</p>
    <h2>Mezua Eguneratu</h2>
    
    <?php if (!empty($mezua1)): ?> <p style="color:red;"><?= $mezua1 ?></p>
    <?php endif; ?>

    <form method="post" action="index.php">
        <input type="hidden" name="id" value="<?= $mezua->getId() ?>">
        
        <table>
            <tr>
                <td><label for="izena"><b>Izena:</b></label></td>
                <td>
                    <input type="text" name="izena" id="izena" value="<?= htmlspecialchars($mezua->getIzena()) ?>">
                </td>
            </tr>

            <tr>
                <td><label for="email"><b>Email:</b></label></td>
                <td>
                    <input type="text" name="email" id="email" value="<?= htmlspecialchars($mezua->getEmail()) ?>">
                </td>
            </tr>

            <tr>
                <td><label for="mezua"><b>Mezua:</b></label></td>
                <td>
                    <input type="text" name="mezua" id="mezua" value="<?= htmlspecialchars($mezua->getMezua()) ?>">
                </td>
            </tr>

            <tr>
                <td><label for="erantzuna"><b>Erantzuna:</b></label></td>
                <td>
                    <input type="checkbox" name="erantzuna" id="erantzuna" value="1" <?= ($mezua->getErantzuna() == 1) ? 'checked' : '' ?>>
                    <span style="font-size: 0.9em; color: #555;">Markatu eginda badago</span>
                </td>
            </tr>
            
            <tr class="gris">
                <td></td> <td>
                    <button type="submit">Eguneratu</button>
                </td>
            </tr>
        </table>
        </form>

<?php else: ?>
    <p>Ez da mezua hautatu edo aurkitu.</p>
<?php endif; ?>

</body>
</html>