<?php

include_once("lib/model/Admin.php");

function is_email_valid(string $email):bool {
 
    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 

    if (preg_match($regex, $email)) {

        return true;
    
    } else { 

        return false;

    }     

}

function is_first_time(): void{

    $admin = new Admin();

    if($admin->getTotalAdmins() == 0){

        header("Location: ./first-time.php");

    }

}

function redirect_login(string $session = "food_saver_admin_id", string $page = "admin.php", bool $if_is_logged = true): void{

    if ($if_is_logged && isset($_SESSION[$session])){

        header("Location: ". $page);

    }else if(!$if_is_logged && !isset($_SESSION[$session])){

        header("Location: ". $page);

    }

}



?>