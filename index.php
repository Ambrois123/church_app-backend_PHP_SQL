<?php 

session_start();

define("URL", str_replace("index.php", "",(isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

//chargement des classes
require_once "controller/SermonController.php";
require_once "controller/CitationController.php";
require_once "controller/AdminController.php";
require_once "controller/BibleStudyController.php";


//instantiation  des classes 
$sermonController = new SermonController();
$citationController = new CitationController();
$adminController = new AdminController();
$bibleStudyController = new BibleStudyController();



try{
    if(empty($_GET['page'])){
        throw new Exception("La page n'existe pas");

    }else  {
    $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
    if(empty($url[0])) throw new Exception("La page n'existe pas");

    switch($url[0]){
        case "sendMail" : require "views/SendMail.php";
            break;
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
            if(empty($url[1])) throw new Exception("Identifiant du sermon manquant"); 
            $citationController->getCitation($url[1]);
            break;
        case "admin" : 
            if(empty($url[1])) throw new Exception("La page n'existe pas");
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
                    if(empty($url[2])) throw new Exception("La page n'existe pas");
                        switch($url[2]){
                            case "visualisation" : $sermonController->DisplaySermons();
                                break;
                            case "suppression" : $sermonController->DeleteSermon();
                                break;
                            case "modification" : $sermonController->getUpdatePage($url[3]);
                                break;
                            case "validateModif" : $sermonController->updateSermon();
                                break;
                            case "creation" : $sermonController->getPageCreation();
                                break;
                            case "validationCreation" : $sermonController->createSermon();
                                break;
                            default: throw new Exception("La page n'existe pas");
                        }
                        break;
                case "citations" :
                    if(empty($url[2])) throw new Exception("La page n'existe pas");
                        switch($url[2]){
                            case "visualisation" : $citationController->DisplayQuotes();
                                break;
                            case "suppression" : $citationController->DeleteQuote();
                                break;
                            case "modification" : $citationController->getUpdatePage($url[3]);
                                break;
                            case "validationModification" : $citationController->UpdateQuote();
                                break;
                            case "creation" : $citationController->getPageCreation();
                                break;
                            case "validationCreation" : $citationController->createQuotation();
                                break;
                            default: throw new Exception("La page n'existe pas");
                        }
                        break;
                case "etudes" :
                    if(empty($url[2])) throw new Exception("La page n'existe pas");
                        switch($url[2]){
                            case "visualisation" : $bibleStudyController->DisplayBibleStudy();
                                break;
                            case "suppression" : $bibleStudyController->deleteBibleStudy();
                                break;
                            case "modification" : $bibleStudyController->getUpdatePage($url[3]);
                                break;
                            case "validationModif" : $bibleStudyController->updateBibleStudy();
                                break;
                            case "creation" : $bibleStudyController->getPageCreation();
                                break;
                            case "validationCreation" : $bibleStudyController->createBibleStudy();
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
}catch(Exception $e){
    $msg = $e->getMessage();
    echo $msg;
    echo "</br>";
    echo "<a href='".URL."admin/login'>Retour à la page de Login</a>";
}