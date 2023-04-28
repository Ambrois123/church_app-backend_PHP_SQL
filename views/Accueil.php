<?php ob_start(); //ouverture de la fonction temporisation ?>


<?php
$content = ob_get_clean(); //fermeture de la fonction temporisation
$title = "Page d'administration du site";
require "views/assets/Template.php";