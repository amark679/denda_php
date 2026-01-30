
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Produktua Ezabatu</title>
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
		.ezabatu{
			display:flex;
			gap: 5px; 
			
		}
    </style>
</head>
<body>

<?php if ($produktua): ?>

	<h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a> &gt;</p>
    <h2>Produktua Ezabatu</h2>

    <table>
        <tr>
            <th>Kategoria</th>
            <td><?= $kategoria ? $kategoria->getIzena() : 'Ezezaguna' ?></td>
        </tr>
        <tr>
            <th>Marka</th>
            <td><?= $produktua->getMarka() ?></td>
        </tr>
        <tr>
            <th>Modeloa</th>
            <td><?= $produktua->getModeloa() ?></td>
        </tr>
        <tr>
            <th>Prezioa</th>
            <td><?= $produktua->getPrezioa() ?> €</td>
        </tr>
        <tr>
            <th>Deskontua</th>
            <td><?= $produktua->getDeskontuak() * 100 ?>%</td>
        </tr>
    </table>

    <br>

	<div class="ezabatu">
    <form method="post" action="index.php">
        <input type="hidden" name="id" value="<?= $produktua->getId() ?>">
        <button type="submit">Ezabatu</button>
    </form>
	<form method="post" action="..">
        <input type="hidden" name="id" value="<?= $produktua->getId() ?>">
        <button type="submit">Ez ezabatu</button>
    </form>
	</div>

<?php else: ?>
    <?php 
	 header("Location: id_baliogabea.php");
        exit;
	?>
	 
<?php endif; ?>

</body>
</html>
