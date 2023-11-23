<?php

include_once("lib/utils.php");

$current_url = getCurrentURLWithoutLang();

?>

<header>

    <nav class="navbar navbar-dark bg-primary" data-bs-theme="light">

        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="resources/assets/logo.jpeg" alt="Logo" width="30" height="30" class="d-inline-block align-text-top img-thumbnail">
                Food Saver
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu" aria-controls="menu">
                <span class="d-flex align-items-center"><img class="m-0 p-0" src="resources/assets/menu.svg" height="30"/><label class="mb-1">Menu</label></span>
            </button>
            <div class="offcanvas offcanvas-start black" data-bs-scroll="true" tabindex="-1" id="menu" aria-labelledby="menuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="menuLabel">Food Saver - Menu</h5>
                    <div>
                        <a href="<?php echo $current_url . "lang=pt-PT";?>"><img <?php echo ($_SESSION["food_saver_lang"] == "pt-PT" ? 'class="ps-1 pe-1 border border-primary-subtle"' : ""); ?> src="resources/assets/portugal.svg" height="20"/></a>
                        <a href="<?php echo $current_url . "lang=en-US";?>"><img <?php echo ($_SESSION["food_saver_lang"] == "en-US" ? 'class="ps-1 pe-1 border border-primary-subtle"' : ""); ?> src="resources/assets/usa.svg" height="20"/></a>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="entities.php"><?php echo $entities_label; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin-profile.php"><?php echo $profile_label; ?></a>
                        </li>
                    </ul>
                </div>
                <div class="p-2 d-flex justify-content-end">

                    <a class="btn btn-danger" href="logout-admin.php">
                        <span class="d-flex align-items-center"><img src="resources/assets/exit.svg" height="30"/><?php echo $logout_label; ?><label class="mb-1"></label></span>
                    </a>

                </div>
            </div>
        </div>
    </nav>

</header>