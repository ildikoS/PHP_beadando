<?php
require_once('datafunctions.php');

$hiba = '';
$elkuldve = isset($_POST['elkuldve']);

if($elkuldve){
    if(isset($_POST['email']) && isset($_POST['pswd']) && trim($_POST['email']) != '' && trim($_POST['pswd']) != ''){
        if(emailExists($_POST['email']) && properDatas($_POST['email'], $_POST['pswd'])){
            setDatas($_POST['email']);
            header('Location: index.php');
        }else if(!emailExists($_POST['email'])){
            $hiba = 'Nem létezik ilyen felhasználónév!';
        }else if(!properDatas($_POST['email'], $_POST['pswd'])){
            $hiba = 'Rosszul megadott jelszó!';
        }else{
            $hiba = 'Egyéb hiba!';
        }
    }else{
        $hiba = 'Nem adott meg email címet, vagy jelszót!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Bejelentkezés</title>
</head>
<body>

<?php if($bejelentkezve): ?>
    <?php kijelentkezes() ?>
<?php else: ?>
    <?php bejelentkezes() ?>
<?php endif ?>

<div class="loginDiv">
    <?php if($elkuldve): ?>
        <?php if(strlen($hiba) > 0): ?>
            <p style="color: red;"><?=$hiba?></p>
        <?php endif ?>
    <?php endif ?>

    <form method="post" novalidate>
        Email: <input name="email" type="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>"> <br>
        Jelszó: <input name="pswd" type="password" value="<?= isset($_POST['pswd']) ? $_POST['pswd'] : '' ?>"> <br>
        
        <input name="elkuldve" type="hidden" value="igen">
        <input type="submit" value="Bejelentkez">
    </form>
</div>

<?php footer() ?>

</body>
</html>