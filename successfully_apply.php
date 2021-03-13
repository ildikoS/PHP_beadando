<?php
require_once('menu.php');
require_once('datafunctions.php');

if(!$bejelentkezve){
    header('Location: login.php');
    die;
}

applying($_GET['id'],$_SESSION['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Jelentkezés</title>
</head>
<style>
    p{
        color: green;
        text-transform: uppercase;
    }
</style>
<body>

<?php if($bejelentkezve): ?>
    <?php kijelentkezes() ?>
<?php else: ?>
    <?php bejelentkezes() ?>
<?php endif ?>

<p> Sikeres jelentkezés! </p>

<?php footer() ?>
</body>
</html>