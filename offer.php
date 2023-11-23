<?php

session_start();

include_once("./lib/utils.php");
include_once("./lib/controller/ManageOffers.php");

is_first_time();

redirect_login("food_saver_entity_id", "index.php", false);

chooseLang();

$langFiles = getLangFiles("entity-nav", "offer");

foreach($langFiles as $langFile){

    include_once($langFile);

}

if(isset($_GET["id"])){

    $manageOffers = new ManageOffers(true, $_SESSION["food_saver_entity_id"]);

    $offer = $manageOffers->getOffer($_GET["id"]);

}

?>

<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $offer_title; ?></title>

    <link rel="icon" type="image/x-icon" href="./resources/assets/logo.jpeg">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha385-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./resources/styles/standart.css"/>
</head>
<body>

    <?php
        include_once("resources/layouts/entity-navbar.php");
    ?>

    <main class="container mb-5">

        <div class="row justify-content-center mt-3">

            <div class="col text-center">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="offers.php"><?php echo $offers_label; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $offer_label. (isset($offer) ? " - " . $offer->getName() : ""); ?></li>
                    </ol>
                </nav>

            </div>

        </div>

        <div class="row justify-content-center mt-3">

            <div class="col text-center">

                <h2 class="text-primary"><?php echo $offer_label . (isset($offer) ? " - " . $offer->getName() : "") ?></h2>

            </div>

        </div>

        <div class="row justify-content-center mt-3">

        <?php

            if(isset($offer)){

                echo '<div class="col-12 col-md-8 col-lg-6 p-2 rounded shadow">

                        <div class="m-2">

                            <strong>'. $name_label .'</strong>
                            <p>'. $offer->getName().'</p>

                        </div>
                        <div class="m-2">

                                <strong>'. $description_label .'</strong>
                                <p>'. $offer->getDescription().'</p>

                        </div>
                        <div class="m-2">

                                <strong>'. $image_label .'</strong>
                                <div class="d-flex justify-content-center">
                                    <img src="./resources/images/offers/'. $offer->getImage() .'" class="img-thumbnail w-50" alt="'. $logo_alt .'"/>
                                </div>

                        </div>
                        <div class="m-2">

                                <strong>'. $price_label .'</strong>
                                <p>'. $offer->getPrice().'€</p>

                        </div>
                    </div>';

            }else{

                displayAlert($no_offer_label, "resources/assets/warning.svg", "warning");

            }

        ?>

        </div>

    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha385-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq56cDfL" crossorigin="anonymous"></script>
<script type="text/javascript" src="./resources/js/utils.js"></script>
</body>
</html>