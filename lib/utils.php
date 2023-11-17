<?php

include_once("lib/controller/ManageAdmins.php");

function is_email_valid(string $email):bool {
 
    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 

    if (preg_match($regex, $email)) {

        return true;
    
    } else { 

        return false;

    }     

}

function is_first_time(): void{

    $manageAdmins = new ManageAdmins();

    if($manageAdmins->getTotalAdmins() == 0){

        include_once('logout-admin.php');
        include_once('logout-entity.php');

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

function displayAlert(string $message, string $icon_resources = "resources/assets/info.svg", string $type = "success"){

    echo '<div class="alert alert-'. $type .' d-flex align-items-center" role="alert">
            <img src="'. $icon_resources .'" height="25"/>
            <div class="ms-1">
                '. $message .'
            </div>
        </div>';

}

function chooseLang(string $default_lang = "pt-PT"){

    if(isset($_GET["lang"])){

        if (is_dir("resources/i18n/" . $_GET["lang"])){
                
            $_SESSION["food_saver_lang"] = $_GET["lang"];

        }

    }else if(!isset($_SESSION["food_saver_lang"])){

        $lang_list = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);

        $langs = [];

        foreach($lang_list as $l)
            $langs[] = explode(";", $l); 

        $chosen_lang = $default_lang;

        foreach($langs as $l){

            if (is_dir("resources/i18n/" . $l[0])){
                
                $chosen_lang = $l[0]; 
                break;

            }

        }

        $_SESSION["food_saver_lang"] = $chosen_lang;

    }

}

function getLangFiles(string $navbar, string $page, string $default_lang = "pt-PT"){

    if(isset($_SESSION["food_saver_lang"])){

        if(file_exists("resources/i18n/". $_SESSION["food_saver_lang"] ."/". $navbar .".php") && file_exists("resources/i18n/". $_SESSION["food_saver_lang"] ."/". $page .".php")){
    
            $langFiles["nav"] = "resources/i18n/". $_SESSION["food_saver_lang"] ."/". $navbar .".php";
            $langFiles["page"] = "resources/i18n/". $_SESSION["food_saver_lang"] ."/". $page .".php";
    
        }else{
            
            $langFiles["nav"] = "resources/i18n/". $default_lang ."/". $navbar .".php";
            $langFiles["'page'"] = "resources/i18n/". $default_lang ."/". $page .".php";
    
        }
    
    }else{
    
        $langFiles["nav"] = "resources/i18n/". $default_lang ."/". $navbar .".php";
        $langFiles["page"] = "resources/i18n/". $default_lang ."/". $page .".php"; 
    
    }

    return $langFiles;

}

function getCurrentURLWithoutLang(): string{

    $current_url = $_SERVER['PHP_SELF'];

    if (strlen($_SERVER['QUERY_STRING']) > 0){

        $get = $_GET;
        unset($get['lang']);
        $get = http_build_query($get);
        $current_url .= strlen($get) > 0 ? "?" . $get . "&" : "?";

    }else 

        $current_url .= "?";

    return $current_url;

}


?>