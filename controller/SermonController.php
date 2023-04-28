<?php 

require_once "./model/SermonModel.php";
require_once "BaseController.php";
require_once "config/Security.php";
require_once "utilities/addAudio.php";

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

    /* private function pour retravailler les données avant de les envoyer en front.
     Ceci me permet de définir la route vers les fichiers image et audio.
    */
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
        try{
            if (Security::verifAccess()) {

                //Appel de la fonction getBdSermons() du model SermonModel
                $sermons = $this->sermonModel->getBdSermons();
                //print_r($sermons);
                require "views/VisualisationSermons.php";
            }else{
                throw new Exception("Vous n'avez pas les droits d'accès");
                
            }
        }catch(Exception $e){
            $msg = $e->getMessage();
            echo $msg;
        }
        
    }

    public function DeleteSermon()
    {
        try{
            //vérification de l'access
        if (Security::verifAccess()) {
            //récupération de l'id du sermon
            // echo $_POST['sermon_id'];

            //sécurisation de l'injection et transformation en entier
            $idSermon = $this->sermonModel->deleteBdSermon((int)Security::secureHTML($_POST['sermon_id']));

            //Récupération  de l'audio en BDD
                $audio = $this->sermonModel->getSermonAudio($idSermon);

                // fonction unlink() pour supprimer les fichiers
                unlink("public/sermons/".$audio);

                $_SESSION['alert'] = [
                    "type" => "success",
                    "message" => "Le sermon a bien été supprimé"
                ];
                header("Location: ".URL."admin/sermons/visualisation");

        }else{
            throw new Exception("Vous n'avez pas les droits d'accès");
            
        }
        }catch(Exception $e){
            $msg = $e->getMessage();
            echo $msg;
        }
        

    }

    public function getUpdatePage($id)
    {
        $sermons = $this->sermonModel->getBdOneSermon($id);
        // echo "<pre>";
        // print_r($sermons);
        // echo "</pre>";
        require "views/updateSermon.php";
    }

    public function updateSermon()
    {
        //vérification de l'access
        try{
            if (Security::verifAccess()) {
            
                $id = (int)Security::secureHTML($_POST['id']);
                $image = Security::secureHTML($_POST['image']);
                $date = Security::secureHTML($_POST['date']);
                $title = Security::secureHTML($_POST['title']);
                $resume = Security::secureHTML($_POST['resume']);
                $audio = Security::secureHTML($_POST['audio']);
                $author = Security::secureHTML($_POST['author']);
    
                $this->sermonModel->updateBdSermon($id, $image, $date, $title, $resume, $audio, $author);
                

                $_SESSION['alert'] = [
                    "type" => "success",
                    "message" => "Le sermon a bien été modifié"
                ];
                    
                    header("Location: ".URL."admin/sermons/visualisation");
    
            }else{
                throw new Exception("Vous n'avez pas les droits d'accès");
                
            }
        }catch(Exception $e){
            $msg = $e->getMessage();
            echo $msg;
        }
        
    }

    public function getPageCreation()
    {
        require_once "views/createSermon.php";
    }

    public function createSermon()
    {

        // $file = $_FILES['audio'];
        // $repertoire ="public/sermons/";
        // $fileAdded = $this->addAudio($file, $repertoire);
        try{
            //vérification de l'access
        if (Security::verifAccess()) {
            $image = "";
            //Vérification de l'existence du fichier image et ajout
            // if($_FILES['image']['size'] > 0){
            //     $repertoire = "public/images/";
            //     $image = addImage($_FILES['image'], $repertoire);
            // }
            $date = Security::secureHTML($_POST['date']);
            $title = Security::secureHTML($_POST['title']);
            $resume = Security::secureHTML($_POST['resume']);
            $audio = "";
            //Vérification de l'existence du fichier audio et ajout
            if($_FILES['audio']['size'] > 0){
                $repertoire = "public/sermons/";
                $audio = addAudio($_FILES['audio'], $repertoire);
            }
            $author = Security::secureHTML($_POST['author']);

            $this->sermonModel->createBdSermon($image, $date, $title, $resume, $audio, $author);

            $_SESSION['alert'] = [
                "type" => "success",
                "message" => "Le sermon a bien été crée"
            ];
                
                header("Location: ".URL."admin/sermons/visualisation");

        }else{
            throw new Exception("Vous n'avez pas les droits d'accès");
            
        }
        }catch(Exception $e){
            $msg = $e->getMessage();
            echo $msg;
        }
    }
  

    

    
}
