<?php

session_start();

include_once("./lib/utils.php");
include_once("./lib/controller/ManageEntities.php");

is_first_time();

redirect_login("food_saver_admin_id", "admin.php", false);

chooseLang();

$langFiles = getLangFiles("admin-nav", "update-entity");

foreach($langFiles as $langFile){

    include_once($langFile);

}

if(isset($_GET["id"])){

    $manageEntities = new ManageEntities(true);

    $entity = $manageEntities->getEntity($_GET["id"]);

}

if(isset($_POST["update"], $_GET["id"])) {

    if(isset($_POST["name"], $_POST["description"], $_POST["address"], $_POST["phone_number"], $_POST["email"])){

        if(isset($_FILES["logo"])){

            $file_path = generateFilePath($_FILES["logo"], "resources/images/entities/");

        }

        if(isset($file_path) && move_uploaded_file($_FILES["logo"]["tmp_name"], $file_path["full_path"])){

            $old_image = $entity->getLogo();
            $entity = new Entity(id: $_GET["id"], name: $_POST["name"], description: $_POST["description"], logo: $file_path["filename"], address: $_POST["address"], phone_number: $_POST["phone_number"], email: $_POST["email"]);

        }else{

            $entity = new Entity(id: $_GET["id"], name: $_POST["name"], description: $_POST["description"], address: $_POST["address"], phone_number: $_POST["phone_number"], email: $_POST["email"]);

        }

        $updated = $manageEntities->updateEntity($entity);

        if(!$updated){

            unlink($full_path);

        }else if($updated && !empty($old_image)){

            unlink("resources/images/entities/" . $old_image);

        }

        $entity = $manageEntities->getEntity($_GET["id"]);

    }

}

?>

<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $update_entity_title ?></title>

    <link rel="icon" type="image/x-icon" href="./resources/assets/logo.jpeg">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha385-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./resources/styles/standart.css"/>
</head>
<body>

    <?php
        include_once("resources/layouts/admin-navbar.php");
    ?>

    <main class="container mb-5">

        <div class="row justify-content-center mt-3">

            <div class="col text-center">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="entities.php"><?php echo $entities_label; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $update_entity_label . (isset($entity) ? " - ". $entity->getName() : ""); ?></li>
                    </ol>
                </nav>

            </div>

        </div>

        <div class="row justify-content-center mt-3">

            <div class="col text-center">
    
                <h2 class="text-primary"><?php echo $update_entity_label . (isset($entity) ? " - ". $entity->getName() : "") ?></h2>

            </div>

        </div>

        <?php

        if(isset($updated)){

            echo '<div class="row justify-content-center mt-3">
                    <div class="col text-center">';

            if($updated){

                displayAlert($success_label, "resources/assets/success.svg", "success");

            }else{

                displayAlert($unsuccess_label, "resources/assets/close.svg", "danger");

            }
                    
                    
            echo '</div>
                </div>';

        }

        if(isset($entity)){

            echo '<form class="needs-validation" method="POST" enctype="multipart/form-data">

                    <div class="row g-3 justify-content-center mt-2">

                        <div class="col-12 col-md-8 col-lg-6">
                            <label for="input_name" class="form-label">'. $name_label .'</label>
                            <input type="text" class="form-control shadow" id="input_name" name="name" value="'. $entity->getName() .'" placeholder="'. $name_placeholder .'" required>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center mt-2">

                        <div class="col-12 col-md-8 col-lg-6">
                            <label for="input_description" class="form-label">'. $description_label .'</label>
                            <textarea class="form-control shadow" id="input_description" name="description" placeholder="'. $description_placeholder .'" rows="5" required>'. $entity->getDescription() .'</textarea>               
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center mt-2">

                        <div class="col-12 col-md-8 col-lg-6">
                            <label for="input_logo" class="form-label">'. $logo_label .'</label>
                            <input type="file" class="form-control shadow" id="input_logo" accept="image/*" name="logo">
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center mt-2">

                        <div class="col-12 col-md-8 col-lg-6">
                            <label for="input_address" class="form-label">'. $address_label .'</label>
                            <textarea class="form-control shadow" id="input_address" name="address" rows="4" placeholder="'. $address_placeholder .'" required>'. $entity->getAddress() .'</textarea>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center mt-2">

                        <div class="col-12 col-md-8 col-lg-6">
                            <label for="input_phone_number" class="form-label">'. $phone_number_label .'</label>
                            <input type="tel" class="form-control shadow" id="input_phone_number" name="phone_number"  value="'. $entity->getPhoneNumber() .'" pattern="[0-9]{9}" minlength="9" maxlength="9" inputmode="numeric" placeholder="'. $phone_number_placeholder .'" required>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center mt-2">

                        <div class="col-12 col-md-8 col-lg-6">
                            <label for="input_email" class="form-label">'. $email_label .'</label>
                            <input type="email" class="form-control shadow" id="input_email" name="email"  value="'. $entity->getEmail() .'" placeholder="'. $email_placeholder .'" required>
                        </div>

                    </div>

                    <div class="row g-3 justify-content-center mt-2">

                        <div class="col-12 col-md-8 col-lg-6">
                            <label class="form-label">'. $status_label .'</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="active" role="switch" id="input_status" '. ($entity->isActive() ? "checked" : "") .'>
                                <label class="form-check-label" for="input_status">'. $active_label .'</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 justify-content-center mt-3">

                        <div class="col-12 col-md-5 col-lg-3 text-center">
                            <input class="btn btn-info text-white w-100 shadow" name="update" type="submit" value="'. $update_entity_label .'"/>
                        </div>

                    </div>

                </form>';

        }else{

            displayAlert($no_entity_label, "resources/assets/warning.svg", "warning");

        }



        ?>

        

    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha385-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq56cDfL" crossorigin="anonymous"></script>
<script type="text/javascript" src="./resources/js/utils.js"></script>
</body>
</html>