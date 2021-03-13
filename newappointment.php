<?php
require_once('datafunctions.php');

$hibak = [];
$elkuldve = isset($_POST['elkuldve']);

if($elkuldve){

    if(isset($_POST['date']) && isset($_POST['time']) && isset($_POST['capacity'])){
        $d = trim($_POST['date']);
        $t = trim($_POST['time']);
        $c = trim($_POST['capacity']);
            
    }

    if(!isset($d) || $d == ''){
        $hibak['d'] = 'Nem adott meg dátumot!';
    }elseif(!validateDate($d)){
        $hibak['d'] = 'Nem valid a dátum!';
    }

    if(!isset($t) || $t == ''){
        $hibak['t'] = 'Nem adott meg dátumot!';
    }elseif(!validateTime($t)){
        $hibak['t'] = 'Nem valid a dátum!';
    }

    if(!isset($c) || $c == ''){
        $hibak['c'] = 'Nem adta meg a helyek számát!';
    }elseif(filter_var($c, FILTER_VALIDATE_INT) === false){
        $hibak['c'] = 'Nem szám formátumú!';
    }elseif($c <= 0){
        $hibak['c'] = 'Negatív vagy nulla értéket adott meg!';
    }

    if(count($hibak) == 0){
        save_new_date($d, $t, $c);
        header('Location: index.php');
    }
}

//függvények
function validateDate($date, $format = 'Y-m-d'){
    $validDate = DateTime::createFromFormat($format, $date);
    return $validDate && $validDate->format($format) == $date;
}

function validateTime($time, $format = 'H:i'){
    $validTime = DateTime::createFromFormat($format, $time);
    return $validTime && $validTime->format($format) == $time;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Új időpont meghirdetése</title>
</head>
<style>
    div span {
        color: red;
    }
    p{
        color: red;
        text-transform: uppercase;
    }
</style>
<body>

<?php if($admin): ?>
    <?php adminFunctions() ?>
<?php elseif($bejelentkezve): ?>
    <?php kijelentkezes() ?>
<?php else: ?>
    <?php bejelentkezes() ?>
<?php endif ?>

<?php if($admin): ?>
    <div class="loginDiv">
        <form method="post" novalidate>
            Dátum: <input name="date" type="text" value="<?= isset($_POST['date']) ? $_POST['date'] : '' ?>" placeholder="2021-12-03"> <br>
            <?php if(isset($hibak['d']) && $elkuldve): ?>
                <span> <?=$hibak['d']?> </span> 
            <?php endif ?> <br>

            Időpont: <input name="time" type="text" value="<?= isset($_POST['time']) ? $_POST['time'] : '' ?>" placeholder="12:00"> <br>
            <?php if(isset($hibak['t']) && $elkuldve): ?>
                <span> <?=$hibak['t']?> </span> 
            <?php endif ?> <br>

            Helyek száma: <input name="capacity" type="text" value="<?= isset($_POST['capacity']) ? $_POST['capacity'] : '' ?>" placeholder="6"> <br>
            <?php if(isset($hibak['c']) && $elkuldve): ?>
                <span> <?=$hibak['c']?> </span> 
            <?php endif ?> <br>

            <input name="elkuldve" type="hidden" value="igen">
            <input type="submit" value="Új időpont felvétele">
        </form>
    </div>
<?php else: ?>
    <p> Az ön számára nem elérhető ez az oldal! </p>
<?php endif ?>



<?php footer() ?>

</body>
</html>