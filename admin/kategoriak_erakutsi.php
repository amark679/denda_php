<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
  </head>
  <body>
    <h1>Administrazio gunea</h1>
    <p>Kategoriak</p>
    <ul>
    <?php for ($i=0; $i < count($kategoriak) ; $i++) { ?>
        <li><?php echo $kategoriak[$i]->getIzena() ?>
            [<a href="kategoria_aldatu/?id=<?php echo $kategoriak[$i]->getKategoria_id() ?>">aldatu</a>]
            [<a href="kategoria_ezabatu/index.php?id=<?php echo $kategoriak[$i]->getKategoria_id(); ?>">Ezabatu</a>]
        </li>
    <?php } ?>
    </ul>
    <form action="kategoria_berria/" method="post">
      <p><input type="submit" value="Kategoria berria"></p>
    </form>
	<hr>

  </body>
</html>
