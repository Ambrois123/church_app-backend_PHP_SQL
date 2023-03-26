<?php 

require_once "model/SermonModel.php";
require_once "BaseController.php";
require_once "config/Security.php";

class SermonController extends BaseController
{
    private $sermonModel;

    public function __construct()
    {
        $this->sermonModel = new SermonModel();
    }

    public function getSermons()
    {
        $sermons = $this->sermonModel->getBdSermons();

        //mettre au format JSON
        $this->sendJSON($this->formatSermonData($sermons));
        
        // echo "<pre>";
        // print_r($sermons);
        // echo "</pre>";
    }

    public function  getSermon($id)
    {
        $sermon = $this->sermonModel->getBdOneSermon($id);
        
        $this->sendJSON($sermon);

        // echo "<pre>";
        // print_r($sermon);
        // echo "</pre>";
    }

    // private function pour retravailler les données avant de les envoyer en front

    private function formatSermonData($datas)
    {
        $tab =[];
        foreach($datas as $data){
            $tab[$data["id"]] = [
                "id" => $data["id"],
                "image" => URL."public/images/".$data["image"],
                "date" => $data["date"],
                "titre" => $data["title"],
                "resume" => $data["resume"],
                "audio" => URL."public/sermons/".$data["audio"],
                "auteur" => $data["author"]
            ];
        }

        // echo "<pre>";
        // print_r($tab);
        // echo "</pre>";

        return $tab;

    }

    public function DisplaySermons()
    {
        /*Security étant une fonction static, on l'utilise en appelant la classe 
        directement suivi de :: et du nom de la fonction.
        */
        if (Security::verifAccess()) {

            //récupération des données de sermons
            $sermons = $this->sermonModel->getBdSermons();
            //print_r($sermons);
            require "views/VisualisationSermons.php";
        }else{
            throw new Exception("Vous n'avez pas les droits d'accès");
            
        }
    }

    public function DeleteSermon()
    {
        //vérification de l'access
        if (Security::verifAccess()) {
            //récupération de l'id du sermon
            // echo $_POST['sermon_id'];

            //sécurisation de l'injection et transformation en entier
            $this->sermonModel->deleteBdSermon((int)Security::secureHTML($_POST['sermon_id']));
                $_SESSION['alert'] = [
                    "type" => "success",
                    "message" => "Le sermon a bien été supprimé"
                ];
                header("Location: ".URL."admin/sermons/visualisation");

        }else{
            throw new Exception("Vous n'avez pas les droits d'accès");
            
        }

    }

    

    
}
