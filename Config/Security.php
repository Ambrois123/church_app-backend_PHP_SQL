<?php 

//Fonction pour la sécurité des accès

class Security 
{
    //fonction pour sécuriser les données
    public static function secureHTML($string)
    {
        /*On peut aussi utiliser htmlspecialchars() pour la sécurité<div 
        mais htmlentites est à privilégier: site: https://christianelagace.com/php/htmlspecialchars-ou-htmlentities-pour-se-proteger-contre-certaines-attaques-xss/
        */
        return htmlentities($string);
    }

    //fonction pour vérifier les accès

    public static function verifAccess()
    {
        return (!empty($_SESSION['access']) && $_SESSION['access'] === "admin");
    }
}