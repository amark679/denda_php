<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Albisteak</title>
</head>
<body>
	<h1>Administrazioa gunea</h1>
	<p><?php echo $mezua ?></p>
	<p><a href="..">← Web orrira itzuli </a></p>
	<form action="index.php" method="post">
    <p>
    <label for="erabiltzailea">Erabiltzaile-izena</label>
    <input type="text" id="erabiltzailea" name="erabiltzailea" />
    </p>
    <p>
    <label for="pasahitza">Pasahitza</label>
    <input type="password" id="pasahitza" name="pasahitza" />
    </p>
    <p>
    <input type="submit" name="sartu" value="Sartu" />
    </p>
    </form>