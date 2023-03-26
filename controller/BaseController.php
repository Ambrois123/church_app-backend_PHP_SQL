<?php 

//fonction pour mettre les données au format JSON
abstract class BaseController 
{
    
    protected  function sendJSON($info){
        
        //pour éviter les problèmes de CORS
        header("Access-Control-Allow-Origin: *");//laissser l'étoile signifie que tout le monde peut accéder à l'API
        header("Content-Type: Application/json");
        echo json_encode($info);
    }

    protected function sendNotFound(){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: Application/json");
        header("HTTP/1.1 404 Not Found");
        exit();

    }
}