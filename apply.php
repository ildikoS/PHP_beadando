<?php
require_once('menu.php');
require_once('datafunctions.php');

$hiba = '';
$elkuldve = isset($_POST['elkuldve']);

if($elkuldve){
    if(!isset($_POST['adatkezeles']) || $_POST['adatkezeles'] != 'igen'){
        $hiba = 'Az adatkezelési szabályzat elfogadása kötelező!';
    }else{
        header('Location: successfully_apply.php?id=' . $_GET['id']);
    }
}

setdate($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Jelentkezés</title>
</head>
<body>

<?php if($bejelentkezve): ?>
    <?php kijelentkezes() ?>
<?php else: ?>
    <?php bejelentkezes() ?>
<?php endif ?>

<section>
    <?php if($elkuldve): ?>
        <?php if(strlen($hiba) > 0): ?>
            <p style="color: red;"><?=$hiba?></p>
        <?php endif ?>
    <?php endif ?>

    <form class="loginDiv" method="post">
        <ul>
            <li>Dátum: <?=$_SESSION['nap']?></li>
            <li>Időpont: <?=$_SESSION['ido']?></li>
            <li>Név: <?=$_SESSION['user']?></li>
            <li>Lakcím: <?=$_SESSION['address']?></li>
            <li>TAJ szám: <?=$_SESSION['taj']?></li>
        </ul>
        <p>Elfogadja a jelentkezéssel járó kötelezettségeket?<input type="checkbox" name="adatkezeles" value="igen"></p> <br>
        
        <input name="elkuldve" type="hidden" value="igen">
        <input type="submit" value="Jelentkezés megerősítése">
    </form>
</section>

<?php footer() ?>

</body>
</html>