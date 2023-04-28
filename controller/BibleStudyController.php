<?php 

require_once "model/BibleStudyModel.php";
require_once "BaseController.php";

class BibleStudyController  extends BaseController
{
    private $bibleStudyModel;

    public function __construct()
    {
        $this->bibleStudyModel = new BibleStudyModel;    
    }

    public function getBibleStudies()
    {
        $etudes = $this->bibleStudyModel->getBddBibleStudy();

        //mettre en format JSON
        $this->sendJSON($this->formatBibleStudyData($etudes));
        // echo "<pre>";
        // print_r($etudes);
        // echo "</pre>";
        
    }

    public function getBibleStudy($id)
    {
        $etude = $this->bibleStudyModel->getBddOneBibleStudy($id);

        //mettre en format JSON
        $this->sendJSON($etude);
    }

    private function formatBibleStudyData($datas)
    {
        // retravailler les données avant utilisations
        $tab = [];
        foreach($datas as $data){
            $tab[$data["id"]] = [
                "id" => $data['id'],
                "date" => $data['date'],
                "titre" => $data['title'],
                "audio" => URL."public/etudes/".$data['audio'],
                "auteur" => $data['author']
            ];
        }

        return $tab;
    }

    public function DisplayBibleStudy()
    {
        /*Security étant une fonction static, on l'utilise en appelant la classe 
        directement suivi de :: et du nom de la fonction.
        */
        try{
            if (Security::verifAccess()) {

                //Appel de la fonction getBdSermons() du model SermonModel
                $etudes = $this->bibleStudyModel->getBddBibleStudy();
                //print_r($etudes);
                require "views/VisualisationBibleStudy.php";
            }else{
                throw new Exception("Vous n'avez pas les droits d'accès");
                
            }
        }catch(Exception $e){
            $msg = $e->getMessage();
            echo $msg;
        }
        
    }

    public function DeleteBibleStudy()
    {
        try{
            //vérification de l'access
        if (Security::verifAccess()) {
            //récupération de l'id du sermon
            // echo $_POST['sermon_id'];

            //sécurisation de l'injection et transformation en entier
            $idBibleStudy = $this->bibleStudyModel->deleteBddBibleStudy((int)Security::secureHTML($_POST['bibleStudy_id']));

            //Récupération  de l'audio en BDD
                $audio = $this->bibleStudyModel->getBibleStudyAudio($idBibleStudy);

                // fonction unlink() pour supprimer les fichiers
                unlink("public/etudes/".$audio);

                $_SESSION['alert'] = [
                    "type" => "success",
                    "message" => "L'étude biblique' a bien été supprimée"
                ];
                header("Location: ".URL."admin/etudes/visualisation");

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
        $etudes = $this->bibleStudyModel->getBddOneBibleStudy($id);
        // echo "<pre>";
        // print_r($etude);
        // echo "</pre>";
        require "views/updateBibleStudy.php";
    }

    public function updateBibleStudy()
    {
        //vérification de l'access
        try{
            if (Security::verifAccess()) {
            
                $id = (int)Security::secureHTML($_POST['id']);
                $date = Security::secureHTML($_POST['date']);
                $title = Security::secureHTML($_POST['title']);
                $audio = Security::secureHTML($_POST['audio']);
                $author = Security::secureHTML($_POST['author']);
    
                $this->bibleStudyModel->updateBddBibleStudy($id, $date, $title, $audio, $author);
                

                $_SESSION['alert'] = [
                    "type" => "success",
                    "message" => "L'étude a bien été modifiée"
                ];
                    
                    header("Location: ".URL."admin/etudes/visualisation");
    
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
        require_once "views/createBibleStudy.php";
    }

    public function createBibleStudy()
    {

        try{
            //vérification de l'access
        if (Security::verifAccess()) {
            $date = Security::secureHTML($_POST['date']);
            $title = Security::secureHTML($_POST['title']);
            $audio = "";
            //Vérification de l'existence du fichier audio et ajout
            if($_FILES['audio']['size'] > 0){
                $repertoire = "public/etudes/";
                $audio = addBibleAudio($_FILES['audio'], $repertoire);
            }
            $author = Security::secureHTML($_POST['author']);

            $this->bibleStudyModel->createBddBibleStudy($date, $title, $audio, $author);

            $_SESSION['alert'] = [
                "type" => "success",
                "message" => "L'étude a bien été créée"
            ];
                
                header("Location: ".URL."admin/etudes/visualisation");

        }else{
            throw new Exception("Vous n'avez pas les droits d'accès");
            
        }
        }catch(Exception $e){
            $msg = $e->getMessage();
            echo $msg;
        }
    }
  

   

}