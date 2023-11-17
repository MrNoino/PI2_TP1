<?php

session_start();

unset($_SESSION["food_saver_admin_id"]);

header("Location: ./admin.php");