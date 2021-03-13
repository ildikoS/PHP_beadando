<?php
require_once('menu.php');
require_once('lista.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Főoldal</title>
</head>
<body>

<?php if($admin): ?>
    <?php adminFunctions() ?>
<?php elseif($bejelentkezve): ?>
    <?php kijelentkezes() ?>
<?php else: ?>
    <?php bejelentkezes() ?>
<?php endif ?>

<section>
    <div class="container">
        <p>A Nemzeti Koronavírus Depó (NemKoViD - Mondj nemet a koronavírusra!)
             központi épületében különböző időpontokban oltásokat szervez.</p>
    </div>
</section>

<?php lista($bejelentkezve) ?>

<?php footer() ?>
</body>
</html>