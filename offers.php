<?php

session_start();

include_once("./lib/utils.php");

is_first_time();

if(isset($_SESSION["food_saver_lang"])){

    //verifica se os ficheiros do idioma existem
    //se sim
    if(file_exists("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_nav_". $_SESSION["food_saver_lang"] .".php") && file_exists("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_offers_". $_SESSION["food_saver_lang"] .".php") && file_exists("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_footer_". $_SESSION["food_saver_lang"] .".php")){

        //importa os ficheiros do idioma escolhido
        //include_once("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_nav_". $_SESSION["food_saver_lang"] .".php");
        include_once("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_offers_". $_SESSION["food_saver_lang"] .".php");
        //include_once("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_footer_". $_SESSION["food_saver_lang"] .".php");

    //senao
    }else{

        //importa os ficheiros do idioma por defeito
        //include_once("src/languages/pt-PT/i18n_nav_pt-PT.php");
        include_once("src/languages/pt-PT/i18n_offers_pt-PT.php");
        //include_once("src/languages/pt-PT/i18n_footer_pt-PT.php");

    }

//senao
}else{

    //importa os ficheiros do idioma por defeito
    //include_once("src/languages/pt-PT/i18n_nav_pt-PT.php");
    include_once("src/languages/pt-PT/i18n_offers_pt-PT.php");
    //include_once("src/languages/pt-PT/i18n_footer_pt-PT.php");

}

redirect_login("food_saver_entity_id", "index.php", false);

?>

<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $offers_title; ?></title>

    <link rel="icon" type="image/x-icon" href="./src/assets/logo.jpeg">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./src/styles/standart.css"/>
</head>
<body>

    <a href="./logout-admin.php">Logout</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>