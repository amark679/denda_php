<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
  </head>
  <body>
    <p>Eskariak</p>
    <ul>
    <?php 
        foreach ($eskariak as $eskaria) {

            $bezeroa = $eskaria->getBezeroa();
    ?>

        <li><?php echo $bezeroa->getIzena() ?>
			<?php echo  $bezeroa->getAbizena()?>
            <?php echo " || " . $eskaria->getData() ?>
            [<a href="eskaria_ikusi/index.php?id=<?= $eskaria->getId() ?>">ikusi</a>]
        </li>
    <?php } ?>
    </ul>
	    <p><a href="irten.php">Sesiotik irten</a></p>
  </body>
</html>
