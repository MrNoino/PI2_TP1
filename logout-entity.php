<?php

session_start();

unset($_SESSION["food_saver_entity_id"]);

header("Location: ./index.php");