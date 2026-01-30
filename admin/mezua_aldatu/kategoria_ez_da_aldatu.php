<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Aldaketak Hutsegin Du</title>
</head>
<body>

    <h1>Produktuen Administrazio Gunea</h1>
    <p><a href="..">Hasiera</a> &gt; <a href="index.php">Kategoriak</a> &gt;</p>

    <h2>Aldaketak Hutsegin Du</h2>

    <p style="color: red; font-weight: bold;">
        Kategoria ez da aldatu.
    </p>
    
    <p>Arrazoia: 
        <?php echo $mezua ?? 'Errore ezezaguna gertatu da. Begiratu log-ak.'; ?>
    </p>
    
    <p style="margin-top: 20px;">
        <a href="index.php">Itzuli kategorien zerrendara</a>
    </p>

</body>
</html>