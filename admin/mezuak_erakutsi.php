<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
  </head>
  <body>
    <p>Mezuak</p>
    <ul>
    <?php for ($i=0; $i < count($mezuak) ; $i++) { ?>
        <li><?php echo $mezuak[$i]->getEmail()?>
			<?php echo  $mezuak[$i]->getMezua()?>
            [<a href="mezua_aldatu/?id=<?php echo $mezuak[$i]->getId() ?>">aldatu</a>]
            [<a href="mezua_ezabatu/index.php?id=<?php echo $mezuak[$i]->getId() ?>">ezabatu</a>]
        </li>
    <?php } ?>
    </ul>
    <hr>

  </body>
</html>
