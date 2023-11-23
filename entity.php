<?php

session_start();

include_once("./lib/utils.php");
include_once("./lib/controller/ManageEntities.php");

is_first_time();

redirect_login("food_saver_admin_id", "admin.php", false);

chooseLang();

$langFiles = getLangFiles("admin-nav", "entity");

foreach($langFiles as $langFile){

    include_once($langFile);

}

if(isset($_GET["id"])){

    $manageEntities = new ManageEntities(true);

    $entity = $manageEntities->getEntity($_GET["id"]);

}

?>

<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $entity_title; ?></title>

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
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $entity_label. (isset($entity) ? " - " . $entity->getName() : ""); ?></li>
                    </ol>
                </nav>

            </div>

        </div>

        <div class="row justify-content-center mt-3">

            <div class="col text-center">

                <h2 class="text-primary"><?php echo $entity_label . (isset($entity) ? " - " . $entity->getName() : "") ?></h2>

            </div>

        </div>

        <div class="row justify-content-center mt-3">

        <?php

        if(isset($entity)){

            echo '<div class="col-12 col-md-8 col-lg-6 p-2 rounded shadow">

                    <div class="m-2">

                        <strong>'. $name_label .'</strong>
                        <p>'. $entity->getName().'</p>

                    </div>
                    <div class="m-2">

                            <strong>'. $description_label .'</strong>
                            <p>'. $entity->getDescription().'</p>

                    </div>
                    <div class="m-2">

                            <strong>'. $logo_label .'</strong>
                            <div class="d-flex justify-content-center">
                                <img src="./resources/images/entities/'. $entity->getLogo() .'" class="img-thumbnail w-50" alt="'. $logo_alt .'"/>
                            </div>
                            

                    </div>
                    <div class="m-2">

                            <strong>'. $address_label .'</strong>
                            <p>'. $entity->getAddress().'</p>

                    </div>
                    <div class="m-2">

                            <strong>'. $phone_number_label .'</strong>
                            <p>'. $entity->getPhoneNumber().'</p>

                    </div>
                    <div class="m-2">

                            <strong>'. $email_label .'</strong>
                            <p>'. $entity->getEmail().'</p>

                    </div>
                    <div class="m-2">

                            <strong>'. $status_label .'</strong>
                            <p>'. ($entity->isActive() ? $active_label : $not_active_label) .'</p>

                    </div>
                </div>';

        }else{

            displayAlert($no_entity_label, "resources/assets/warning.svg", "warning");

        }

        ?>

        </div>

    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha385-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq56cDfL" crossorigin="anonymous"></script>
<script type="text/javascript" src="./resources/js/utils.js"></script>
</body>
</html>