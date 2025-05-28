<?php

use core\App;
use core\Database;


//dd("yesssssssssss");
$db  = App::resolve(Database::class);


$email = $_POST['email'];
$password = $_POST['password'];

$erorrs = [];

if (! Validator::email($email)) {
    $erorrs['email'] = "not a valid email ";
}
if (! Validator::string($password, 8, 255)) {
    $erorrs['password'] = "password is too short password ";
}

if (! empty($erorrs)) {
    require 'views/registertion/create_view.php';
}





$user =  $db->query(
    'select * from users where email = :email',
    ['email' => $email]
)->fetch();


if ($user) {
    header("Location: /");
}


try {
    require "controlers/parts/image_loader.php"; 


   
    $db->query(
        'INSERT INTO users (name , email , password ,role ,photo) VALUES (:username ,:email , :password , :admin ,:photo);',
        [
            'username' => $_POST['name'],
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'admin' => 'listener' ,
            'photo' => $filenamenew
        ]
    );
   
    $user['password']=$password;
    logIn($user);
} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(500);
}


header("Location: /");
die();
