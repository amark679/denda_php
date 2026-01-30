<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
  </head>
  <body>
    <p>Produktuak</p>
    <ul>
    <?php for ($i=0; $i < count($produktuak) ; $i++) { ?>
        <li><?php echo $produktuak[$i]->getMarka() ?>
			<?php echo  $produktuak[$i]->getModeloa()?>
            [<a href="produktua_aldatu/?id=<?php echo $produktuak[$i]->getId() ?>">aldatu</a>]
            [<a href="produktua_ezabatu/index.php?id=<?php echo $produktuak[$i]->getId() ?>">ezabatu</a>]
        </li>
    <?php } ?>
    </ul>
    <form action="produktu_berria/" method="post">
      <p><input type="submit" value="Produktu berria"></p>
    </form>
	<hr>
  </body>
</html>
