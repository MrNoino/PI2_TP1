<?php

session_start();

include_once("./lib/utils.php");
include_once("./lib/controller/ManageEntities.php");

is_first_time();

redirect_login("food_saver_admin_id", "admin.php", false);

chooseLang();

$langFiles = getLangFiles("admin-nav", "entities");

foreach($langFiles as $langFile){

    include_once($langFile);

}

$manageEntities = new ManageEntities(true);

?>

<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $entities_title; ?></title>

    <link rel="icon" type="image/x-icon" href="./resources/assets/logo.jpeg">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./resources/styles/standart.css"/>
</head>
<body>

    <?php include_once("resources/layouts/admin-navbar.php"); ?>

    <main class="container mb-5">

        <div class="row justify-content-center mt-3">

            <div class="col text-center">

                <h2 class="text-primary"><?php echo $entities_list_label ?></h2>

            </div>

        </div>

        <div class="row justify-content-end mt-3">

            <div class="col-12 text-end">

                <a class="btn btn-success text-center" href="./new-entity.php">
                    <?php echo $add_entity_label; ?>
                </a>

            </div>

        </div>

        <div class="row justify-content-center mt-3">

            <?php
            
                $entities = $manageEntities->getEntities();

                if(count($entities) > 0){

                    echo '<div class="list-group col-12">';

                    foreach($entities as $entity){

                        echo '<div class="list-group-item d-flex justify-content-between">
                                <a href="entity.php?id='. $entity->getId() .'" class="w-100 text-decoration-none text-black">
                                    <div class="h-100 d-flex align-items-center">
                                        <span>'. $entity->getName() .'</span>
                                    </div>
                                </a>
                                
                                <div class="h-100 d-flex align-items-center">
                                    <a class="btn btn-info" href="update-entity.php?id='. $entity->getId() .'">
                                        <img class="mb-1" src="./resources/assets/edit.svg" height="25"/>
                                    </a>
                                </div>
                                
                            </div>';

                    }

                    echo '</div>';

                }else{

                    echo '<div class="col-12">';

                    displayAlert($no_entities_label, "resources/assets/warning.svg", "warning");

                    echo '</div>';

                }

            ?>
            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./resources/js/utils.js"></script>
</body>
</html>