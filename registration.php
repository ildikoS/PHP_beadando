<?php
require_once('datafunctions.php');

$hibak = [];
$elkuldve = isset($_POST['elkuldve']);

if($elkuldve){
        if(isset($_POST['user']) && isset($_POST['taj']) && isset($_POST['address']) 
        && isset($_POST['email']) && isset($_POST['pswd']) && isset($_POST['pswd2'])){

        $u = trim($_POST['user']);
        $t = trim($_POST['taj']);
        $a = trim($_POST['address']);
        $e = trim($_POST['email']);
        $p = trim($_POST['pswd']);
        $p2 = trim($_POST['pswd2']);
        
    }

    if(!isset($u) || $u == '' || !substr_count($u, " ") >= 1){
        $hibak['u'] = 'Nem adta meg a teljes nevét! (Legalább 1 szóközt tartalmaznia kell)';
    }

    if(!isset($t) || !preg_match('/^[0-9]{9}$/',$t)){
        $hibak['t'] = 'A TAJ szám formátuma nem megfelelő!';
    }

    if(!isset($a) || $a == ''){
        $hibak['a'] = 'Nem adta meg az értesítési címét!';
    }

    if(!isset($e) || $e == ''){
        $hibak['e'] = 'Nem adta meg az email címét!';
    }elseif(!filter_var($e, FILTER_VALIDATE_EMAIL)){
        $hibak['e'] = 'Az email cím formátuma helytelen!';
    }elseif(emailExists($e)){
        $hibak['e'] = 'Ez az email cím már foglalt!';
    }

    if(!isset($p) || $p == ''){
        $hibak['p'] = 'A jelszó megadása kötelező!';
    }

    if(!isset($p2) || $p2 == ''){
        $hibak['p2'] = 'A jelszó megerősítése kötelező!';
    }elseif($p != $p2){
        $hibak['p2'] = 'A jelszavak nem egyeznek egymással!';
    }

    if(count($hibak) == 0){
        registrate($u, $t, $a, $e, $p);
        header('Location: login.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Regisztráció</title>
</head>
<style>
    span {
        color: red;
    }
</style>
<body>

<?php if($bejelentkezve): ?>
    <?php kijelentkezes() ?>
<?php else: ?>
    <?php bejelentkezes() ?>
<?php endif ?>

<div class="loginDiv">
    <form method="post" novalidate>
        Teljes név: <input name="user" type="text" value="<?= isset($_POST['user']) ? $_POST['user'] : '' ?>"> <br>
        <?php if(isset($hibak['u']) && $elkuldve): ?>
            <span> <?=$hibak['u']?> </span> 
        <?php endif ?> <br>

        TAJ szám: <input name="taj" type="text" value="<?= isset($_POST['taj']) ? $_POST['taj'] : '' ?>"> <br>
        <?php if(isset($hibak['t']) && $elkuldve): ?>
            <span> <?=$hibak['t']?> </span> 
        <?php endif ?> <br>

        Értesítési cím: <input name="address" type="text" value="<?= isset($_POST['address']) ? $_POST['address'] : '' ?>"> <br>
        <?php if(isset($hibak['a']) && $elkuldve): ?>
            <span> <?=$hibak['a']?> </span> 
        <?php endif ?> <br>

        Email-cím: <input name="email" type="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" placeholder="pl. valami@gmail.com"> <br>
        <?php if(isset($hibak['e']) && $elkuldve): ?>
            <span> <?=$hibak['e']?> </span> 
        <?php endif ?> <br>

        Jelszó: <input name="pswd" type="password" value="<?= isset($_POST['pswd']) ? $_POST['pswd'] : '' ?>"> <br>
        <?php if(isset($hibak['p']) && $elkuldve): ?>
            <span> <?=$hibak['p']?> </span> 
        <?php endif ?> <br>

        Jelszó újra: <input name="pswd2" type="password" value="<?= isset($_POST['pswd2']) ? $_POST['pswd2'] : '' ?>"> <br>
        <?php if(isset($hibak['p2']) && $elkuldve): ?>
            <span> <?=$hibak['p2']?> </span> 
        <?php endif ?> <br>

        <input name="elkuldve" type="hidden" value="igen">
        <input type="submit" value="Regisztráció">
    </form>
</div>

<?php footer() ?>

</body>
</html>