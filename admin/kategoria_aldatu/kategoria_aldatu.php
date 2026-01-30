<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kategoria Eguneratu</title>
</head>
<body>

	<h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a> &gt;</p>
    <h2>Kategoria Eguneratu</h2>
	
	<?php if (!empty($mezua)): ?>
    <p style="color:red;"><?= $mezua ?></p>
	<?php endif; ?>

    <form method="post" action="index.php">
        <input type="hidden" name="kategoria_id" value="<?= htmlspecialchars($kategoria_id) ?>">

        <p>
            <label for="izena"><b>Izena:</b></label><br>
            <input type="text" name="izena" id="izena" value="<?= htmlspecialchars($izena_value) ?>">
        </p>

        <p>
            <label for="deskribapena"><b>Deskribapena:</b></label><br>
            <textarea name="deskribapena" id="deskribapena" rows="4" cols="40"><?= htmlspecialchars($deskribapena_value) ?></textarea>
        </p>

        <button type="submit">Eguneratu</button>
    </form>
</body>
</html>
