<?php

session_start();

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


?>


<!DOCTYPE html>
<html lang="<?php echo (isset($_SESSION["food_saver_lang"]) ? substr($_SESSION["food_saver_lang"], 0, 2) : "pt") ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $admin_title; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./src/styles/standart.css"/>
</head>
<body>

    <form class="row g-3 needs-validation" novalidate>
        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">First name</label>
            <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
            <div class="valid-feedback">
            Looks good!
            </div>
        </div>
        <div class="col-md-4">
            <label for="validationCustom02" class="form-label">Last name</label>
            <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
            <div class="valid-feedback">
            Looks good!
            </div>
        </div>
        <div class="col-md-4">
            <label for="validationCustomUsername" class="form-label">Username</label>
            <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend">@</span>
            <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
            <div class="invalid-feedback">
                Please choose a username.
            </div>
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationCustom03" class="form-label">City</label>
            <input type="text" class="form-control" id="validationCustom03" required>
            <div class="invalid-feedback">
            Please provide a valid city.
            </div>
        </div>
        <div class="col-md-3">
            <label for="validationCustom04" class="form-label">State</label>
            <select class="form-select" id="validationCustom04" required>
            <option selected disabled value="">Choose...</option>
            <option>...</option>
            </select>
            <div class="invalid-feedback">
            Please select a valid state.
            </div>
        </div>
        <div class="col-md-3">
            <label for="validationCustom05" class="form-label">Zip</label>
            <input type="text" class="form-control" id="validationCustom05" required>
            <div class="invalid-feedback">
            Please provide a valid zip.
            </div>
        </div>
        <div class="col-12">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">
                Agree to terms and conditions
            </label>
            <div class="invalid-feedback">
                You must agree before submitting.
            </div>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>