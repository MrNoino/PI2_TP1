<?php

session_start();

include_once("./lib/utils.php");
include_once("./lib/controller/ManageOffers.php");

is_first_time();

redirect_login("food_saver_entity_id", "index.php", false);

chooseLang();

$langFiles = getLangFiles("entity-nav", "new-offer");

foreach($langFiles as $langFile){

    include_once($langFile);

}

if(isset($_POST["add"])) {

    if(isset($_POST["name"], $_POST["description"], $_FILES["image"], $_POST["price"])) {

        $file_path = generateFilePath($_FILES["image"], "resources/images/offers/");

        if($file_path && move_uploaded_file($_FILES["image"]["tmp_name"], $file_path["full_path"])){

            $offer = new Offer(entity_id: $_SESSION["food_saver_entity_id"], name: $_POST["name"], description: $_POST["description"], image: $file_path["filename"], price: $_POST["price"]);

            $manageOffers = new ManageOffers(false); 

            $inserted =$manageOffers->insertOffer($offer);


        }

        if(!$inserted){

            unlink($full_path);

        }

    }

}

?>

<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $new_offer_title; ?></title>

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
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $new_offer_label; ?></li>
                    </ol>
                </nav>

            </div>

        </div>

        <div class="row justify-content-center mt-3">

            <div class="col text-center">

                <h2 class="text-primary"><?php echo $new_offer_label ?></h2>

            </div>

        </div>

        <?php

            if(isset($inserted)){

                echo '<div class="row justify-content-center mt-3">
                        <div class="col text-center">';
            
                if($inserted){

                    displayAlert($success_label, "resources/assets/success.svg", "success");
    
                }else{
    
                    displayAlert($unsuccess_label, "resources/assets/close.svg", "danger");
    
                }
                        
                        
                echo '</div>
                    </div>';

            }

            

        ?>

        <form class="needs-validation" method="POST" enctype="multipart/form-data">

            <div class="row g-3 justify-content-center mt-2">

                <div class="col-12 col-md-8 col-lg-6">
                    <label for="input_name" class="form-label"><?php echo $name_label; ?></label>
                    <input type="text" class="form-control shadow" id="input_name" name="name" placeholder="<?php echo $name_placeholder; ?>" required>
                </div>

            </div>

            <div class="row g-3 justify-content-center mt-2">

                <div class="col-12 col-md-8 col-lg-6">
                    <label for="input_description" class="form-label"><?php echo $description_label; ?></label>
                    <textarea class="form-control shadow" id="input_description" name="description" placeholder="<?php echo $description_placeholder; ?>" rows="5" required></textarea>               
                </div>

            </div>

            <div class="row g-3 justify-content-center mt-2">

                <div class="col-12 col-md-8 col-lg-6">
                    <label for="input_image" class="form-label"><?php echo $image_label; ?></label>
                    <input type="file" class="form-control shadow" id="input_image" name="image" accept="image/*" required>
                </div>

            </div>

            <div class="row g-3 justify-content-center mt-2">

                <div class="col-12 col-md-8 col-lg-6">
                    <label for="input_price" class="form-label"><?php echo $price_label; ?></label>
                    <input type="number" class="form-control shadow" id="input_price" step="0.5" name="price" placeholder="<?php echo $price_placeholder; ?>" required>
                </div>

            </div>

            <div class="row g-3 justify-content-center mt-3">

                <div class="col-12 col-md-5 col-lg-3 text-center">
                    <input class="btn btn-primary w-100 shadow" name="add" type="submit" value="<?php echo $add_offer_label; ?>"/>
                </div>

            </div>

        </form>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha385-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq56cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./resources/js/utils.js"></script>
</body>
</html>