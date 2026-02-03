<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mezua Ezabatu</title>
	<style>
        table {
            border-collapse: collapse;
            width: 350px;
        }
        td, th {
            border: 1px solid #555;
            padding: 8px;
        }
        th {
            background: #eee;
            text-align: left;
        }
    </style>
</head>
<body>
<?php if ($mezua): ?>
	<p><a href="..">Hasiera</a> &gt;
    <h2>Mezua Ezabatu</h2>
	
	<table>

        <tr>
            <th>Igorlea:</th>
            <td><?= $mezua->getIzena()?></td>
        </tr>
        <tr>
            <th>Mezua:</th>
            <td><?= $mezua->getMezua() ?></td>
        </tr>
    
    </table>

	<br>

    <form method="post" action="index.php">
		<input type="hidden" name="id" value="<?= $mezua->getId() ?>">
        <button type="submit">Ezabatu</button>
    </form>
<?php else: ?>
    <p>Ez da kategoria hautatu edo aurkitu.</p>
<?php endif; ?>
</body>
</html>