<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kategoria Ezabatu</title>
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
<?php if ($kategoria): ?>
	<h1>Administrazio gunea</h1>
	<p><a href="..">Hasiera</a> &gt;
    <h2>Kategoria Ezabatu</h2>
	
	<table>
        <tr>
            <th>Kategoria ID:</th>
            <td><?= $kategoria->getKategoria_id() ?></td>
        </tr>
        <tr>
            <th>Izena:</th>
            <td><?= $kategoria->getIzena() ?></td>
        </tr>
        <tr>
            <th>Deskribapena:</th>
            <td><?= $kategoria->getDeskribapena() ?></td>
        </tr>
    </table>

	<br>

	<div class="ezabatu">
    <form method="post" action="index.php">
        <input type="hidden" name="kategoria_id" value="<?= $kategoria->getKategoria_id() ?>">
        <button type="submit">Ezabatu</button>
    </form>
	<form method="post" action="..">
	  <input type="hidden" name="kategoria_id" value="<?= $kategoria->getKategoria_id() ?>">
      <button type="submit">Ez Ezabatu</button>
    </form>
	</div>
<?php else: ?>
    <p>Ez da kategoria hautatu edo aurkitu.</p>
<?php endif; ?>
</body>
</html>