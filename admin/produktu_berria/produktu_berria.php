<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Produktuen berria</title>
</head>
<body>

    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a> &gt;</p>

    <h2>Produktu berria</h2>

    <?php if (!empty($mezua)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($mezua); ?></p>
    <?php endif; ?>

    <form action="index.php" method="post">
        <p>
            <label for="marka">Marka</label><br>
            <input type="text" id="marka" name="marka" size="50" maxlength="255"
                   value="<?php echo htmlspecialchars($marka ?? ''); ?>">
        </p>

        <p>
            <label for="modeloa">Modeloa</label><br>
            <input type="text" id="modeloa" name="modeloa" maxlength="255"
                   value="<?php echo htmlspecialchars($modeloa ?? ''); ?>">
        </p>

        <p>
            <label for="prezioa">Prezioa</label><br>
            <input type="number" id="prezioa" name="prezioa" step="0.01" min="0"
                   value="<?php echo htmlspecialchars($prezioa ?? ''); ?>">
        </p>

       <p>
		<label for="id_kategoria">Kategoria:</label><br>
		<select name="id_kategoria" id="id_kategoria" >
			<?php foreach ($kategoriak as $kat): ?>
				<option value="<?= $kat->getKategoria_id() ?>"
					<?= ($kat->getKategoria_id() == $id_kategoria) ? 'selected' : '' ?>>
					<?= htmlspecialchars($kat->getIzena()) ?>
				</option>
			<?php endforeach; ?>
		</select>
	</p>

        <p>
            <label for="nobedadea">Nobedadea</label><br>
            <input type="radio" id="nobedadeak_bai" name="nobedadeak" value="1"
                   <?php if (isset($nobedadeak) && $nobedadeak == 1) echo 'checked'; ?>>
            <label for="nobedadeak_bai">BAI</label>

            <input type="radio" id="nobedadeak_ez" name="nobedadeak" value="0"
                   <?php if (!isset($nobedadeak) || $nobedadeak == 0) echo 'checked'; ?>>
            <label for="nobedadeak_ez">EZ</label>
        </p>
		
		<p>
            <label for="deskontuak">Deskontua</label><br>
            <input type="number" id="deskontuak" name="deskontuak" min="0" max="100"
                   value="<?php echo htmlspecialchars($deskontuak ?? ''); ?>">
        </p>
        <p>
            <input type="submit" name="gorde" value="Gorde">
        </p>
    </form>

</body>
</html>
