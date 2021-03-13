<?php

require_once('datafunctions.php');
$otherPage;

$elkuldve = isset($_GET['elkuldve']);
if($elkuldve){
    $found = false;
    deleteApplying($_SESSION['id']);
}

function lista($bejelentkezve){ 
    $appointments = appointments();
    
    $found = false;
    if($bejelentkezve && alreadyApplied($_SESSION['id'])){
        $found = true;
        foreach($appointments as $appointment){
            if(in_array($_SESSION['id'], $appointment->users)){
                $_SESSION['nap'] = $appointment->date;
                $_SESSION['ido'] = $appointment->time;
            }
        }
    }

    foreach($appointments as $appointment){
        if(count(applied_users($appointment->id)) < $appointment->limit){
            $appointment->color = "green";
        }else{
            $appointment->color = "red";
        }
    }

    $currMonth = $_GET['month'] ?? date('m');
    if(intval($currMonth) > 12){
        $currMonth = '01';
    } 
    elseif(intval($currMonth) < 1){
        $currMonth = '12';
    } 
    elseif(intval($currMonth) < 10 && intval($currMonth) >= 1) $currMonth = '0' . $currMonth;

    function getMonth($date){
        $month = explode('-', $date);
        return $month[1];
    }

?>

<?php if($bejelentkezve): ?>
    <?php $otherPage = "apply.php" ?>
<?php else: ?>
    <?php $otherPage = "login.php" ?>
<?php endif ?>


<?php if($found): ?>
    <section style="text-transform: uppercase; font-size: 20px;">
        <p> Foglalás adatai: </p>
            <p>Dátum: <?=$_SESSION['nap']?></p>
            <p>Időpont: <?=$_SESSION['ido']?></p>
    </section>
<?php endif ?>

<section>
    <table>
        <tr>
            <th>Nap</th>
            <th>Időpont</th>
            <th>Szabad/Összes hely</th>
        </tr>
        <?php foreach($appointments as $appointment): ?>
            <?php if(getMonth($appointment->date) == $currMonth): ?>
            <tr style="color: <?=$appointment->color?>">
                    <td><?=$appointment->date?></td>
                    <td><?=$appointment->time?></td>
                    <td><?=count(applied_users($appointment->id))?> / <?=$appointment->limit?></td>
                    <?php if(!$found && $appointment->color != 'red'): ?>
                        <td><a href="<?=$otherPage?>?id=<?=$appointment->id?>">Jelentkezés</a></td>
                    <?php endif ?>
                <?php endif ?>
            </tr>
        <?php endforeach ?>
    </table>
</section>

<?php if($found): ?>
    <form action="">
        <input name="elkuldve" type="hidden" value="igen">
        <input type="submit" value="Időpont lemondása">
    </form>
<?php endif ?>

<section>
    <a href="index.php?month=<?=$currMonth-1?>" class="elozo">Előző hónap</a>
    <a href="index.php?month=<?=$currMonth+1?>" class="kovetkezo">Következő hónap</a>
</section>

<?php } ?>