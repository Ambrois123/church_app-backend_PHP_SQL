<?php 

session_start();

define("URL", str_replace("index.php", "",(isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

//chargement des classes
require_once "controller/SermonController.php";
require_once "controller/CitationController.php";
require_once "controller/AdminController.php";


//instantiation  des classes 
$sermonController = new SermonController();
$citationController = new CitationController();
$adminController = new AdminController();



try{
    if(empty($_GET['page'])){
        throw new Exception("La page n'existe pas");

    }else  {
    $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
    if(empty($url[0])) throw new Exception("La page n'existe pas");

    switch($url[0]){
        case "sermons" : 
            $sermonController->getSermons();
            break;
        case "sermon" : 
            if(empty($url[1])) throw new Exception("Identifiant du sermon manquant");
            $sermonController->getSermon($url[1]); 
            break;
        case "citations" : 
            $citationController->getCitations();
            break;
        case "citation" : 
            $citationController->getCitation($url[1]);
            break;
        case "admin" : 
            switch ($url[1]) {
                case "login" : $adminController->getPageLogin();
                    break;
                case "connexion" : $adminController->connexion();
                    break;
                case "accueil" : $adminController->getAccueilAdmin();
                    break;
                case "deconnexion" : $adminController->deconnexion();
                    break;
                case "sermons" :
                        switch($url[2]){
                            case "visualisation" : $sermonController->DisplaySermons();
                                break;
                            case "validationSup" : $sermonController->DeleteSermon();
                                break;
                            case "valideModif" : echo "valideModif";
                                break;
                            case "creation" : echo "creation";
                                break;
                            case "valideCreation" : echo "valideCreation";
                                break;
                            default: throw new Exception("La page n'existe pas");
                        }
                        break;
                case "citations" :
                        switch($url[2]){
                            case "visualisation" : $citationController->DisplayQuotes();
                                break;
                            case "validationSup" : $citationController->DeleteQuote();
                                break;
                            case "validationModif" : $citationController->UpdateQuote();
                                break;
                            case "creation" : echo "creation";
                                break;
                            case "validationCreation" : echo "valideCreation";
                                break;
                            default: throw new Exception("La page n'existe pas");
                        }
                        break;
                        default: throw new Exception("La page n'existe pas");
            }
            break;
        default: throw new Exception("La page n'existe pas");
            
        }

    }
}catch(PDOException $e){
    $msg = $e->getMessage();
    echo $msg;
}