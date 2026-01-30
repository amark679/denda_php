<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Produktua Eguneratu</title>
</head>
<body>
<?php if ($produktua): ?>
	<h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a> &gt;</p>
    <h2>Produktua Eguneratu</h2>

	<?php if (!empty($mezua)): ?>
    <p style="color:red; font-weight:bold;"><?= $mezua ?></p>
	<?php endif; ?>

    <form method="post" action="index.php">
        <input type="hidden" name="id" value="<?= $produktua->getId() ?>">

        <p>
            <label for="id_kategoria"><b>Kategoria:</b></label><br>
            <select name="id_kategoria" id="id_kategoria" >
                <?php foreach ($kategoriak as $kat): ?>
                    <option value="<?= $kat->getKategoria_id() ?>"
                        <?= $kat->getKategoria_id() == $produktua->getId_Kategoria() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($kat->getIzena()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="marka"><b>Marka:</b></label><br>
            <input type="text" name="marka" id="marka" 
                   value="<?= htmlspecialchars($produktua->getMarka()) ?>" >
        </p>

        <p>
            <label for="modeloa"><b>Modeloa:</b></label><br>
            <input type="text" name="modeloa" id="modeloa" 
                   value="<?= htmlspecialchars($produktua->getModeloa()) ?>" >
        </p>

        <p>
            <label for="prezioa"><b>Prezioa (€):</b></label><br>
            <input type="number" step="0.01" name="prezioa" id="prezioa" 
                   value="<?= htmlspecialchars($produktua->getPrezioa()) ?>" >
        </p>
		<?php 
			$n = $produktua->getNobedadeak();
			$n = ($n === null) ? 0 : (int)$n;
		?>
		<p>
		<b>Nobedadea:</b><br>
            <input type="radio" id="nobedadeak_bai" name="nobedadeak" value="1"
				<?= $n === 1 ? 'checked' : '' ?>>
			<label for="nobedadeak_bai">Bai</label>

			<input type="radio" id="nobedadeak_ez" name="nobedadeak" value="0"
				<?= $n === 0 ? 'checked' : '' ?>>
			<label for="nobedadeak_ez">Ez</label>
        </p>
		<p>
		<?php
		// Obtener valor original
		$desk_raw = $produktua->getDeskontuak();

		// Caso 1: valor vacío → 0
		if ($desk_raw === "" || $desk_raw === null) {
			$deskontua_edit = 0;

		// Caso 2: si el valor es un decimal entre 0 y 1 → viene de BD (ej: 0.10)
		} elseif (is_numeric($desk_raw) && $desk_raw > 0 && $desk_raw <= 1) {
			$deskontua_edit = $desk_raw * 100;

		// Caso 3: si ya es un porcentaje válido → dejarlo tal cual (ej: 10, 20.5)
		} elseif (is_numeric($desk_raw) && $desk_raw > 1 && $desk_raw <= 100) {
			$deskontua_edit = $desk_raw;

		// Caso 4: si es un decimal pequeño (ej: 0.0012) → interpretarlo como error → normalizar a 0%
		} else {
			$deskontua_edit = 0;
}

		?>
            <label for="deskontuak"><b>Deskontua (%):</b></label><br>
            <input type="number" step="0.01" name="deskontuak" id="deskontuak" 
                   value="<?= $deskontua_edit ?>" min="0" max="100" >
        </p>

        <button type="submit">Eguneratu</button>
    </form>
	<?php else: ?>
	<p>Ez da produktua aurkitu.</p>
	<?php endif; ?>
</body>
</html>
