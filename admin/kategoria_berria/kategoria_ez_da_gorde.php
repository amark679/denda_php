<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Albisteak</title>
</head>
<body>

    <h1>Administrazio gunea</h1>
    <p><a href="..">Hasiera</a> &gt;</p>
    
    <h2>Kategoria berria</h2>
    <p>Kategoria ez da gorde</p>

    <table cellspacing="5" cellpadding="5" border="1">
        <tr>
            <td align="right">Izena:</td>
            <td><?php echo $izena ?? ''; ?></td>
        </tr>
        <tr>
            <td align="right">Deskribapena:</td>
            <td><?php echo $deskribapena ?? ''; ?></td>
        </tr>
       
    </table>

</body>
</html>