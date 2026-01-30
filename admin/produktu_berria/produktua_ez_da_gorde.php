<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Albisteak</title>
</head>
<body>

    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a> &gt;</p>
    
    <h2>Produktu berria</h2>
    <p>Produktua ez da gorde</p>

    <table cellspacing="5" cellpadding="5" border="1">
        <tr>
            <td align="right">Marka:</td>
            <td><?php echo $marka ?? ''; ?></td>
        </tr>
        <tr>
            <td align="right">Modeloa:</td>
            <td><?php echo $modeloa ?? ''; ?></td>
        </tr>
        <tr>
            <td align="right">Prezioa:</td>
            <td><?php echo is_numeric($prezioa) ? number_format($prezioa, 2) . " €" : ($prezioa ?? ''); ?></td>
        </tr>
        <tr>
            <td align="right">Kategoria:</td>
            <td><?php echo $id_kategoria ?? ''; ?></td>
        </tr>
		<tr>
            <td align="right">Nobedadea:</td>
            <td><?php echo $nobedadeak ?? ''; ?></td>
        </tr>
		
    </table>

</body>
</html>