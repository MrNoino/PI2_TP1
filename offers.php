<?php

session_start();

include_once("./lib/utils.php");
include_once("./lib/controller/ManageOffers.php");

is_first_time();

chooseLang();

$langFiles = getLangFiles("entity-nav", "offers");

foreach($langFiles as $langFile){

    include_once($langFile);

}

redirect_login("food_saver_entity_id", "index.php", false);

$manageOffers = new ManageOffers(true, $_SESSION["food_saver_entity_id"]);

if(isset($_POST["delete"])){

    if(isset($_POST["id"])){

        $deleted = $manageOffers->deleteOffer($_POST["id"]);

    }

}

?>

<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $offers_title; ?></title>

    <link rel="icon" type="image/x-icon" href="./resources/assets/logo.jpeg">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./resources/styles/standart.css"/>
</head>
<body>

    <?php
        include_once("resources/layouts/entity-navbar.php");
    ?>

    <main class="container mb-5">

        <div class="row justify-content-center mt-3">

            <div class="col text-center">

                <h2 class="text-primary"><?php echo $offers_list_label ?></h2>

            </div>

        </div>

        <?php

            if(isset($deleted)){

                echo '<div class="row justify-content-center mt-3">

                        <div class="col-12">';

                if($deleted){

                    displayAlert($success_label, "resources/assets/success.svg", "success");

                }else{

                    displayAlert($unsuccess_label, "resources/assets/close.svg", "danger");

                }

                echo '</div>
                    </div>';

            }

        ?>

        <div class="row justify-content-end mt-3">

            <div class="col-12 text-end">

                <a class="btn btn-success text-center" href="./new-offer.php">
                    <?php echo $add_offer_label; ?>
                </a>

            </div>

        </div>

        <div class="row justify-content-center mt-3">

            <ul class="list-group col-12">

            <?php

                $offers = $manageOffers->getOffers(date("Y-m-d"));

                if(count($offers) > 0){

                    foreach($offers as $offer){

                        echo '<div class="list-group-item d-flex justify-content-between">
                        <a href="offer.php?id='. $offer->getId() .'" class="w-100 text-decoration-none text-black">
                            <div class="h-100 d-flex align-items-center">
                            
                                <span>'. $offer->getName() .'</span>
                            </div>
                        </a>
                            
                        <div class="h-100 d-flex align-items-center justify-content-end">
                            <a class="btn btn-info m-1" href="update-offer.php?id='. $offer->getId() .'">
                                <img class="mb-1" src="./resources/assets/edit.svg" height="25"/>
                            </a>
                            <input type="hidden" name="id" value="'. $offer->getId() .'"/>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger" onclick="changeModal('. $offer->getId().',\''. $offer->getName() .'\')">
                                <img class="" src="./resources/assets/trash.svg" height="25"/>
                            </button>
                        </div>
                        
                    </div>';
    
                    }

                }else{

                    displayAlert($no_offers_label, "resources/assets/warning.svg", "warning");

                }

                

            ?>
            </ul>

        </div>

    </main>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    
        <div class="modal-dialog modal-dialog-centered">

            <form class="modal-content" method="POST">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?php  echo $modal_title; ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <?php echo $are_you_sure_to_delete_label; ?>:
                    <label id="offer_name"></label>
                    <input type="hidden" id="offer_id" name="id" />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php  echo $close_label; ?></button>
                    <button type="submit" id="btn_delete" name="delete" class="btn btn-danger"><?php  echo $confirm_label; ?></button>
                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./resources/js/utils.js"></script>
    <script type="text/javascript" src="./resources/js/entities.js"></script>
</body>
</html>