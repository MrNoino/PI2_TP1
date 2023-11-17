<?php

session_start();

include_once("./lib/controller/ManageAdmins.php");
include_once("./lib/utils.php");

is_first_time();

chooseLang();

if(isset($_SESSION["food_saver_lang"])){

    if(file_exists("resources/i18n/". $_SESSION["food_saver_lang"] ."/admin.php")){

        include_once("resources/i18n/". $_SESSION["food_saver_lang"] ."/admin.php");

    }else{

        include_once("resources/i18n/pt-PT/admin.php");

    }

//senao
}else{

    include_once("resources/i18n/pt-PT/admin.php");

}

/*

Nome: a655785622e834
Nome de Utilizador: a655785622e834
Palavra Passe: 4qTu#bkzmKrK

*/

$manageAdmins = new ManageAdmins();

if(isset($_POST["login"])){

    if(isset($_POST["username"], $_POST["password"])){

        $id = $manageAdmins->login($_POST["username"], $_POST["password"]);

        if($id > 0){

            $_SESSION["food_saver_admin_id"] = $id;

        }

    }

}

redirect_login("food_saver_admin_id", "entities.php");

$current_url = getCurrentURLWithoutLang();

?>

<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $admin_title; ?></title>

    <link rel="icon" type="image/x-icon" href="./resources/assets/logo.jpeg">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./resources/styles/standart.css"/>
</head>
<body>

    <header class="d-flex justify-content-end p-2">

        <a class="m-1" href="<?php echo $current_url . "lang=pt-PT";?>"><img src="resources/assets/portugal.svg" height="20"/></a>
        <a class="m-1" href="<?php echo $current_url . "lang=en-US";?>"><img src="resources/assets/usa.svg" height="20"/></a>

    </header>

    <main class="container mb-5">

        <div class="row justify-content-center mt-3">

            <div class="col-12 col-md-8 col-lg-6 text-center">

                <img src="./resources/assets/logo.jpeg" class="rounded mx-auto size-inherit" alt="<?php echo $logo_alt; ?>">

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
                    <label for="input_username" class="form-label"><?php echo $username_label; ?></label>
                    <input type="text" class="form-control shadow <?php echo (isset($id) && $id == -1 ? "is-invalid": ""); ?>" id="input_username" name="username" placeholder="<?php echo $username_placeholder; ?>" required>
                </div>

            </div>
            <div class="row g-3 justify-content-center mt-2 align-items-end">
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="input_password" class="form-label"><?php echo $pwd_label; ?></label>
                    <div class="input-group">
                        <input id="input_password" type="password" class="form-control d-inline shadow <?php echo (isset($id) && $id == -1 ? "is-invalid": ""); ?>" name="password" placeholder="<?php echo $pwd_placeholder; ?>" required>
                        <button id="toggle_show_password" onclick="toggleShowPassword('input_password', 'toggle_show_password_img')" type="button" class="btn btn-outline-secondary bg-transparent shadow  float-end p-1"><img id="toggle_show_password_img" class="changed_image" src="./resources/assets/eye.svg" height="35"></button>
                        <?php

                            if(isset($id) && $id == -1) {

                                echo '<div class="invalid-feedback">
                                        '. $invalid_login_label .'
                                    </div>';

                            }

                        ?>
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
    <script type="text/javascript" src="./resources/js/utils.js"></script>
</body>
</html>