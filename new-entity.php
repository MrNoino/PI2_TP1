<?php

session_start();

include_once("./lib/utils.php");
include_once("./lib/controller/ManageEntities.php");

is_first_time();

redirect_login("food_saver_admin_id", "admin.php", false);

chooseLang();

$langFiles = getLangFiles("admin-nav", "new-entity");

foreach($langFiles as $langFile){

    include_once($langFile);

}

if(isset($_POST["add"])) {

    if(isset($_POST["name"], $_POST["description"], $_POST["address"], $_POST["phone_number"], $_POST["email"], $_POST["password"])){

        $entity = new Entity(name: $_POST["name"], description: $_POST["description"], address: $_POST["address"], phone_number: $_POST["phone_number"], email: $_POST["email"], password: $_POST["password"]);
        
        $manageEntities = new ManageEntities(false);
        
        $inserted = $manageEntities->insertEntity($entity);

    }

}

?>

<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $new_entity_title; ?></title>

    <link rel="icon" type="image/x-icon" href="./resources/assets/logo.jpeg">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha385-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./resources/styles/standart.css"/>
</head>
<body>

    <?php include_once("resources/layouts/admin-navbar.php"); ?>

    <main class="container mb-5">

        <div class="row justify-content-center mt-3">

            <div class="col text-center">

                <h2 class="text-primary"><?php echo $new_entity_label ?></h2>

            </div>

        </div>

        <?php

            if(isset($inserted)){

                echo '<div class="row justify-content-center mt-3">
                        <div class="col text-center">';
            
                if($inserted){

                    displayAlert($success_label, "resources/assets/success.svg", "success");
    
                }else{
    
                    displayAlert($unsuccess_label, "resources/assets/warning.svg", "danger");
    
                }
                        
                        
                echo '</div>
                    </div>';

            }

            

        ?>

        <form class="needs-validation" method="POST">

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
                    <label for="input_logo" class="form-label"><?php echo $logo_label; ?></label>
                    <input type="file" class="form-control shadow" id="input_logo" name="logo" required>
                </div>

            </div>

            <div class="row g-3 justify-content-center mt-2">

                <div class="col-12 col-md-8 col-lg-6">
                    <label for="input_address" class="form-label"><?php echo $address_label; ?></label>
                    <textarea class="form-control shadow" id="input_address" name="address" rows="4" placeholder="<?php echo $address_placeholder; ?>" required></textarea>
                </div>

            </div>

            <div class="row g-3 justify-content-center mt-2">

                <div class="col-12 col-md-8 col-lg-6">
                    <label for="input_phone_number" class="form-label"><?php echo $phone_number_label; ?></label>
                    <input type="text" class="form-control shadow" id="input_phone_number" name="phone_number" pattern="[0-9]{9}" minlength="9" maxlength="9" inputmode="numeric" placeholder="<?php echo $phone_number_placeholder; ?>" required>
                </div>

            </div>

            <div class="row g-3 justify-content-center mt-2">

                <div class="col-12 col-md-8 col-lg-6">
                    <label for="input_email" class="form-label"><?php echo $email_label; ?></label>
                    <input type="email" class="form-control shadow" id="input_email" name="email" placeholder="<?php echo $email_placeholder; ?>" required>
                </div>

            </div>

            <div class="row g-3 justify-content-center mt-3">

                <div class="col-12 col-md-5 col-lg-3 text-center">
                    <input class="btn btn-primary w-100 shadow" name="add" type="submit" value="<?php echo $add_entity_label; ?>"/>
                </div>

            </div>

        </form>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha385-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq56cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./resources/js/utils.js"></script>
</body>
</html>