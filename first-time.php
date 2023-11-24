<?php

session_start();

include_once("lib/utils.php");
include_once("./lib/controller/ManageAdmins.php");

chooseLang();

if(isset($_SESSION["food_saver_lang"])){

    if(file_exists("resources/i18n/". $_SESSION["food_saver_lang"] ."/first-time.php") ){

        include_once("resources/i18n/". $_SESSION["food_saver_lang"] ."/first-time.php");
        
    }else{

        include_once("resources/i18n/pt-PT/first-time.php");

    }

//senao
}else{

    include_once("resources/i18n/pt-PT/first-time.php");

}

$current_url = getCurrentURLWithoutLang();

$manageAdmins = new ManageAdmins();

if($manageAdmins->getTotalAdmins() > 0){

    header("Location: ./admin.php");

}

$admin = $manageAdmins->generateRandomAdmin();

?>


<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $first_time_title; ?></title>

    <link rel="icon" type="image/x-icon" href="./resources/assets/logo.jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./resources/styles/standart.css"/>
</head>
<body>

    <header class="d-flex justify-content-end p-2">

        <a href="<?php echo $current_url . "lang=pt-PT";?>"><img <?php echo ($_SESSION["food_saver_lang"] == "pt-PT" ? 'class="ps-1 pe-1 border border-primary-subtle"' : ""); ?> src="resources/assets/portugal.svg" height="20"/></a>
        <a href="<?php echo $current_url . "lang=en-US";?>"><img <?php echo ($_SESSION["food_saver_lang"] == "en-US" ? 'class="ps-1 pe-1 border border-primary-subtle"' : ""); ?> src="resources/assets/usa.svg" height="20"/></a>

    </header>

    <main class="container ">

        <div class="row justify-content-center mt-3">

            <div class="col-12 col-md-8 col-lg-6 text-center">

                <img src="./resources/assets/logo.jpeg" class="rounded mx-auto size-inherit" alt="<?php echo $logo_alt; ?>">

            </div>

        </div>

        <div class="row justify-content-center mt-3">

            <div class="col-12 mx-auto text-center">

                <h3 class="text-primary"><?php echo $admin_data_label; ?></h2>

            </div>

        </div>

        <div class="row justify-content-center mt-3">

            <div class="col-12 col-md-6 col-lg-4">

                <ul class="list-group shadow">
                    <li class="list-group-item p-3"><strong><?php echo $name_label;?></strong><?php echo $admin["name"]; ?></li>
                    <li class="list-group-item p-3"><strong><?php echo $username_label;?></strong><?php echo $admin["username"]; ?></li>
                    <li class="list-group-item p-3"><strong><?php echo $password_label;?></strong><?php echo $admin["pwd"]; ?></li>
                </ul>

            </div>

        </div>
    
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>