<?php

session_start();

include_once("./lib/utils.php");

is_first_time();

redirect_login("food_saver_entity_id", "offers.php");

if(isset($_SESSION["food_saver_lang"])){

    //verifica se os ficheiros do idioma existem
    //se sim
    if(file_exists("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_nav_". $_SESSION["food_saver_lang"] .".php") && file_exists("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_index_". $_SESSION["food_saver_lang"] .".php") && file_exists("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_footer_". $_SESSION["food_saver_lang"] .".php")){

        //importa os ficheiros do idioma escolhido
        //include_once("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_nav_". $_SESSION["food_saver_lang"] .".php");
        include_once("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_index_". $_SESSION["food_saver_lang"] .".php");
        //include_once("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_footer_". $_SESSION["food_saver_lang"] .".php");

    //senao
    }else{

        //importa os ficheiros do idioma por defeito
        //include_once("src/languages/pt-PT/i18n_nav_pt-PT.php");
        include_once("src/languages/pt-PT/i18n_index_pt-PT.php");
        //include_once("src/languages/pt-PT/i18n_footer_pt-PT.php");

    }

//senao
}else{

    //importa os ficheiros do idioma por defeito
    //include_once("src/languages/pt-PT/i18n_nav_pt-PT.php");
    include_once("src/languages/pt-PT/i18n_index_pt-PT.php");
    //include_once("src/languages/pt-PT/i18n_footer_pt-PT.php");

}

?>

<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $index_title; ?></title>

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

            <div class="col text-center">

                <h2 class="text-primary"><?php echo $login_label ?></h2>

            </div>

        </div>

        <form class="needs-validation">

            <div class="row g-3 justify-content-center mt-2">

                <div class="col-12 col-md-6 col-lg-4">
                    <label for="email" class="form-label"><?php echo $email_label; ?></label>
                    <input type="email" class="form-control shadow " id="email" name="email" placeholder="<?php echo $email_placeholder; ?>" required>
                </div>

            </div>
            <div class="row g-3 justify-content-center mt-2 align-items-end">
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="password" class="form-label"><?php echo $pwd_label; ?></label>
                    <div class="input-group">
                        <input id="input_password" type="password" class="form-control d-inline shadow" id="pwd" name="password" placeholder="<?php echo $pwd_placeholder; ?>" required>
                        <button id="toggle_show_password" type="button" class="btn btn-outline-secondary bg-transparent shadow  float-end p-1"><img id="toggle_show_password_img" class="changed_image" src="./src/assets/eye.svg" height="35"></button>
                    </div>
                </div>
            </div>

            <div class="row g-3 justify-content-center mt-3">

                <div class="col-12 col-md-4 col-lg-3 text-center">
                    <button class="btn btn-primary w-100 shadow" type="submit"><?php echo $login_label; ?></button>
                </div>

            </div>

        </form>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./src/js/utils.js"></script>
</body>
</html>