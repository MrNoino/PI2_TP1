<?php

session_start();

include("./lib/model/Admin.php");

if(isset($_SESSION["food_saver_lang"])){

    //verifica se os ficheiros do idioma existem
    //se sim
    if(file_exists("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_nav_". $_SESSION["food_saver_lang"] .".php") && file_exists("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_first-time_". $_SESSION["food_saver_lang"] .".php") && file_exists("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_footer_". $_SESSION["food_saver_lang"] .".php")){

        //importa os ficheiros do idioma escolhido
        //include_once("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_nav_". $_SESSION["food_saver_lang"] .".php");
        include_once("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_first-time_". $_SESSION["food_saver_lang"] .".php");
        //include_once("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_footer_". $_SESSION["food_saver_lang"] .".php");

    //senao
    }else{

        //importa os ficheiros do idioma por defeito
        //include_once("src/languages/pt-PT/i18n_nav_pt-PT.php");
        include_once("src/languages/pt-PT/i18n_first-time_pt-PT.php");
        //include_once("src/languages/pt-PT/i18n_footer_pt-PT.php");

    }

//senao
}else{

    //importa os ficheiros do idioma por defeito
    //include_once("src/languages/pt-PT/i18n_nav_pt-PT.php");
    include_once("src/languages/pt-PT/i18n_first-time_pt-PT.php");
    //include_once("src/languages/pt-PT/i18n_footer_pt-PT.php");

    $admin = new Admin();

    $admin->generateRandomAdmin();

}

?>


<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $first_time_title; ?></title>

    <link rel="icon" type="image/x-icon" href="./src/assets/logo.jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./src/styles/standart.css"/>
</head>
<body>

    <main class="container ">

        <div class="row justify-content-center mt-3">

            <div class="col-12 col-md-8 col-lg-6 text-center">

                <img src="./src/assets/logo.jpeg" class="rounded mx-auto w-inherit" alt="<?php echo $logo_alt; ?>">

            </div>

        </div>

        <div class="row justify-content-center mt-3">

            <div class="col-12 mx-auto text-center">

                <h3 class="text-primary"><?php echo $admin_data_label; ?></h2>

            </div>

        </div>

        <div class="row justify-content-center mt-3">

            <div class="col-12 col-md-6 col-lg-4">

            <ul class="list-group">
                <li class="list-group-item p-3"><strong><?php echo $username_label;?></strong><?php echo $admin->getUsername(); ?></li>
                <li class="list-group-item p-3"><strong><?php echo $password_label;?></strong><?php echo $admin->getPassword(); ?><button type="button" class="btn float-end p-0"><img src="./src/assets/eye.svg" height="25"></button></li>
            </ul>

            </div>

        </div>
    
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>