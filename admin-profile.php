<?php

session_start();

include_once("./lib/utils.php");
include_once("./lib/controller/ManageOffers.php");

is_first_time();

redirect_login("food_saver_admin_id", "admin.php", false);

chooseLang();

$langFiles = getLangFiles("admin-nav", "admin-profile");

foreach($langFiles as $langFile){

    include_once($langFile);

}

?>

<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $admin_profile_title; ?></title>

    <link rel="icon" type="image/x-icon" href="./resources/assets/logo.jpeg">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha385-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./resources/styles/standart.css"/>
</head>
<body>

    <?php include_once("resources/layouts/admin-navbar.php"); ?>

    <main class="container mb-5">

        <div class="row justify-content-center mt-3">

            <div class="col text-center">

                <h2 class="text-primary"><?php echo $profile_label ?></h2>

            </div>

        </div>

        <div class="row g-3 justify-content-center mt-2">

            <form class="needs-validation" method="POST">

                <div class="row g-3 justify-content-center mt-2 align-items-end">
                    <div class="col-12 col-md-8 col-lg-6">
                        <label for="input_current_password" class="form-label"><?php echo $current_pwd_label; ?></label>
                        <div class="input-group">
                            <input id="input_current_password" type="password" class="form-control d-inline shadow" name="current_password" placeholder="<?php echo $current_pwd_placeholder; ?>" required>
                            <button id="toggle_show_current_password" onclick="toggleShowPassword('input_current_password', 'toggle_show_current_password_img')" type="button" class="btn btn-outline-secondary bg-transparent shadow float-end p-1"><img id="toggle_show_current_password_img" class="changed_image" src="./resources/assets/eye.svg" height="35"></button>
                        </div>
                    </div>
                </div>

                <div class="row g-3 justify-content-center mt-2 align-items-end">
                    <div class="col-12 col-md-8 col-lg-6">
                        <label for="input_new_password" class="form-label"><?php echo $new_pwd_label; ?></label>
                        <div class="input-group">
                            <input id="input_new_password" type="password" class="form-control d-inline shadow" name="new_password" placeholder="<?php echo $new_pwd_placeholder; ?>" required>
                            <button id="toggle_show_new_password" onclick="toggleShowPassword('input_new_password', 'toggle_show_new_password_img')" type="button" class="btn btn-outline-secondary bg-transparent shadow float-end p-1"><img id="toggle_show_new_password_img" class="changed_image" src="./resources/assets/eye.svg" height="35"></button>
                        </div>
                    </div>
                </div>

                <div class="row g-3 justify-content-center mt-3">

                    <div class="col-12 col-md-5 col-lg-3 text-center">
                        <input class="btn btn-warning w-100 shadow" name="update" type="submit" value="<?php echo $update_label; ?>"/>
                    </div>

                </div>

            </form>


        </div>

    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha385-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq56cDfL" crossorigin="anonymous"></script>
<script type="text/javascript" src="./resources/js/utils.js"></script>
</body>
</html>