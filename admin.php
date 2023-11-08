<?php

session_start();

include_once("./lib/model/Admin.php");
include_once("./lib/utils.php");

if(isset($_SESSION["food_saver_lang"])){

    //verifica se os ficheiros do idioma existem
    //se sim
    if(file_exists("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_nav_". $_SESSION["food_saver_lang"] .".php") && file_exists("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_admin_". $_SESSION["food_saver_lang"] .".php") && file_exists("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_footer_". $_SESSION["food_saver_lang"] .".php")){

        //importa os ficheiros do idioma escolhido
        //include_once("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_nav_". $_SESSION["food_saver_lang"] .".php");
        include_once("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_admin_". $_SESSION["food_saver_lang"] .".php");
        //include_once("src/languages/". $_SESSION["food_saver_lang"] ."/i18n_footer_". $_SESSION["food_saver_lang"] .".php");

    //senao
    }else{

        //importa os ficheiros do idioma por defeito
        //include_once("src/languages/pt-PT/i18n_nav_pt-PT.php");
        include_once("src/languages/pt-PT/i18n_admin_pt-PT.php");
        //include_once("src/languages/pt-PT/i18n_footer_pt-PT.php");

    }

//senao
}else{

    //importa os ficheiros do idioma por defeito
    //include_once("src/languages/pt-PT/i18n_nav_pt-PT.php");
    include_once("src/languages/pt-PT/i18n_admin_pt-PT.php");
    //include_once("src/languages/pt-PT/i18n_footer_pt-PT.php");

}

/*

Nome: randnm654bc5afbd4f9
Nome de Utilizador: randusrnm654bc5afbd4f6
Palavra Passe: 7yOEr$AEpDLH

*/

$admin = new Admin();

if(isset($_POST["login"])){

    if(isset($_POST["username"], $_POST["password"])){

        $id = $admin->login($_POST["username"], $_POST["password"]);

        $_SESSION["food_saver_admin_id"] = $id;

    }

}

redirect_login("food_saver_admin_id", "dashboard.php");

?>

<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $admin_title; ?></title>

    <link rel="icon" type="image/x-icon" href="./src/assets/logo.jpeg">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./src/styles/standart.css"/>
</head>
<body>

    <main class="container mb-5">

        <div class="row justify-content-center mt-3">

            <div class="col-12 col-md-8 col-lg-6 text-center">

                <img src="./src/assets/logo.jpeg" class="rounded mx-auto w-inherit" alt="<?php echo $logo_alt; ?>">

            </div>

        </div>

        <div class="row justify-content-center mt-3">

            <div class="col text-center">

                <h2 class="text-primary"><?php echo $admin_label ?></h2>

            </div>

        </div>

        <form class="needs-validation" method="POST">

            <div class="row g-3 justify-content-center mt-2">

                <div class="col-12 col-md-6 col-lg-4">
                    <label for="email" class="form-label"><?php echo $username_label; ?></label>
                    <input type="text" class="form-control shadow " id="username" name="username" placeholder="<?php echo $username_placeholder; ?>" required>
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
                    <input class="btn btn-primary w-100 shadow" type="submit" name="login" value="<?php echo $login_label; ?>" />
                </div>

            </div>

        </form>

        <div class="row g-3 justify-content-center mt-2">

            <div class="col-12 col-md-6 col-lg-4 text-center">
                
                <label><?php echo $is_entity_label; ?></label> <a href="./index.php"><?php echo $entity_login_label; ?></a>

            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./src/js/utils.js"></script>
</body>
</html>