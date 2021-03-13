<?php
require_once('menu.php');
require_once('storage.php');

session_start();
$bejelentkezve = isset($_SESSION['email']);
$admin = "";

if($bejelentkezve){
    $admin = $_SESSION['email'] == "admin@nemkovid.hu";
}

function users(){
    $datas = new Storage(new JsonIO('users.json'));
    return $datas;
}

function emailExists($email){
    $user = users();
    $findEmail = $user->findOne(['email' => $email]);
    return isset($findEmail);
}

function properDatas($email, $pswd){
    $user = users();
    $findUser = $user->findOne(['email' => $email]);
    return password_verify($pswd, $findUser['pswd']);
}

function setDatas($email){
    $user = users();
    $findUser = $user->findOne(['email' => $email]);
    $_SESSION['user'] = $findUser['name'];
    $_SESSION['taj'] = $findUser['taj'];
    $_SESSION['address'] = $findUser['address'];
    $_SESSION['email'] = $findUser['email'];
    $_SESSION['id'] = $findUser['id'];
}

function registrate($user, $taj, $address, $email, $pswd){
    $datas = new Storage(new JsonIO('users.json'));

    $user = [
        "name" => $user,
        "taj" => $taj,
        "address" => $address,
        "email" => $email,
        "pswd" => password_hash($pswd, PASSWORD_DEFAULT)
    ];

    $id = $datas->add($user);
    $user['id'] = $id;
}

function appointments(){
    $appointments = json_decode(file_get_contents('appointments.json'));
    return $appointments;
}

function setdate($id){
    $date = appointments();
    if(isset($date->$id)){
        $_SESSION['nap'] = $date->$id->date;
        $_SESSION['ido'] = $date->$id->time;
        $_SESSION['capacity'] = $date->$id->limit;
    }else{
        return;
    }
}

function applied_users($id){
    $date = appointments();
    if(isset($date->$id)){
        return $date->$id->users;
    }else{
        return [];
    }
}

function applying($id, $userid){
    $date = appointments();
    if(!isset($date->$id)) return;

    if(!in_array($userid, $date->$id->users)){
        $date->$id->users[] = $userid;
    }
    
    file_put_contents('appointments.json', json_encode($date, JSON_PRETTY_PRINT));
}

function alreadyApplied($userid){
    $dates = appointments();
    $applied = false;
    foreach($dates as $date){
        if(in_array($userid, $date->users)) $applied = true;
    }
    return $applied;
}

function save_new_date($d,$t,$c){
    $dates = new Storage(new JsonIO('appointments.json'));

    $date = [
        "date" => $d,
        "time" => $t,
        "limit" => $c,
        "users" => []
    ];

    $id = $dates->add($date);
    $date['id'] = $id;
}

function deleteApplying($userid){
    $filethreating = new Storage(new JsonIO('appointments.json'));
    $dates = $filethreating->findAll();

    foreach($dates as $date){
        $i=0;
        $id = $date['id'];
        foreach($date['users'] as $u){
            if($u === $userid){
                array_splice($date['users'], $i, 1);
            }else{
                $i++;
            }
        }
        $filethreating->update($id, $date);
    }

}

?>