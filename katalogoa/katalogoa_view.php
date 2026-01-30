<?php
require_once('../klaseak/com/leartik/daw24amma/kategoriak/kategoria.php');
require_once('../klaseak/com/leartik/daw24amma/kategoriak/kategoria_db.php');
require_once('../klaseak/com/leartik/daw24amma/produktuak/produktua.php'); // Clase Producto (si existe)
require_once('../klaseak/com/leartik/daw24amma/produktuak/produktua_db.php'); // Clase para acceder a la BD de Productos

use com\leartik\daw24amma\kategoriak\KategoriaDB;
use com\leartik\daw24amma\produktuak\ProduktuaDB;


$kategoria_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);


if (!$kategoria_id) {

    header("Location: katalogoa.php");
    exit();
}


$kategoria = KategoriaDB::selectKategoria($kategoria_id);


$produktuak = ProduktuaDB::selectProduktuakByKategoriaId($kategoria_id);


$kategoria_izena = $kategoria ? htmlspecialchars($kategoria->getIzena()) : 'Kategoria ezezaguna';

?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/view.css">
	<link rel="stylesheet" href="../css/index.css">

    <title>Katalogoa: <?= $kategoria_izena ?></title>
    <style>

    </style>
</head>
<body>
    <header>
        <a href=".."><img class="logoa" src="../img/logo.png" alt="" height="100px"></a>
        <div class="titulos-centrales"> 
            <h1>PescaNova</h1> 
            <h3>Arrain-denda</h3>     
        </div>           
        <img class="zesta" src="../img/zesta.png" alt="" height="120px">
    </header>

   <nav>
		<p><a href=".." style="color:white; text-decoration:none;">Hasiera</a></p>
		<p><a href="katalogoa.php" style="color:white; text-decoration:none;">Katalogoa</a></p>
		<p>Gure buruz</p>
		<p>Kontaktua</p>
	</nav>

<main class="hiru">
    <h2 style="text-align:center;"><?= $kategoria_izena ?> produktuak</h2>
    <hr>
	 <p class="link"><a href="katalogoa.php">&#8592; Atzera</a></p>
    
    <section class="produktuak-section"> 
        <?php if (count($produktuak) > 0): ?>
            <?php foreach ($produktuak as $p): ?>
                <div class="produktua-card">
                    
                    <img src="../img/<?= htmlspecialchars($p->getIrudia()) ?>" alt="<?= htmlspecialchars($p->getMarka()) ?>">
                    
                    <h3><?= htmlspecialchars($p->getMarka()) ?></h3>
                    <p><?= htmlspecialchars($p->getModeloa()) ?></p>

                    <?php 
                        $prezioa = floatval($p->getPrezioa());
                        $desk = floatval($p->getDeskontuak());
                        $finala = round($prezioa * (1 - $desk), 2);
                    ?>

                    <?php if ($desk > 0): ?>
                        <p class="viejo">
                            <?= number_format($prezioa, 2, ',', '.') ?> €
                        </p>
                        <p class="nuevo">
                            <?= number_format($finala, 2, ',', '.') ?> €
                        </p>
                        <p class="deskontua"><?= number_format($desk * 100, 0) ?>% deskontua</p>
                    <?php else: ?>
                        <p><?= number_format($prezioa, 2, ',', '.') ?> €</p>
                    <?php endif; ?>
                    
                    <a href="produktua.php?id=<?= $p->getId() ?>">Ikusi gehiago</a>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Momentuz ez dago produkturik kategoria honetan.</p>
        <?php endif; ?>
    </section>
</main>

<footer class="footer"> 
            <div class="brand-info">
                <h4>🐟 PescaNova</h4>
                <p>&copy; 2025 PescaNova.</p>
            </div>
    </footer>
</body>
</html>