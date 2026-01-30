<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Albisteak</title>
</head>
<body>

    <h1>Produktuen administrazio gunea</h1>
    <p><a href="..">Hasiera</a> &gt;</p>

    <h2>Kategoria berria</h2>
    <p><?php echo $mezua ?? ''; ?></p>
    
    <form action="index.php" method="post">
        <p>
            <label for="izena">Izena</label>
            <input type="text" id="izena" name="izena" size="50" maxlength="255" value="<?php echo $izena ?? ''; ?>">
        </p>

        <p>
            <label for="deskribapena">Deskribapena</label>
            <input type="text" id="deskribapena" name="deskribapena" maxlength="255><?php echo $deskribapena ?? ''; ?>">
        </p>
        
        <p>
            <input type="submit" name="gorde" value="Gorde">
        </p>
    </form>

</body>
</html>