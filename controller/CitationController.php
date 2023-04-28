<?php 

require_once "model/CitationModel.php";

require_once "BaseController.php";

class CitationController extends BaseController
{
    private $citationModel;

    public function __construct()
    {
        $this->citationModel = new CitationModel();
    }

    public function getCitations()
    {
        $citations = $this->citationModel->getBdCitations();

        //mettre au format JSON

        $this->sendJSON($this->formatCitationData($citations));

        // echo "<pre>";
        // print_r($citations);
        // echo "</pre>";
    }

    public function getCitation($id)
    {
        $citation = $this->citationModel->getBdOneCitation($id);

        $this->sendJSON($citation);

        // echo "<pre>";
        // print_r($citation);
        // echo "</pre>";
    }

    // private function pour retravailler les données avant de les envoyer en front

    private function formatCitationData($datas)
    {
        $tab =[];
        foreach ($datas as $data) {
            $tab[$data["id"]] = [
                "id" => $data["id"],
                "citation" => $data["quotes"],
                "auteur" => $data["author"]
            ];
        }

        // echo "<pre>";
        // print_r($tab);
        // echo "</pre>";

        return $tab;
    }

    public function DisplayQuotes()
    {
        /*Security étant une fonction static, on l'utilise en appelant la classe
        directement suivi de :: et du nom de la fonction.
        */
        if (Security::verifAccess()) {
            //récupération des données de citation
            $quotes = $this->citationModel->getBdCitations();
            // print_r($quotes);
            require "views/VisualisationCitations.php";
        } else {
            throw new Exception("Vous n'avez pas les droits d'accès");
        }
    }

    public function DeleteQuote()
    {
        //Vérification des droits d'accès avant suppression
        if (Security::verifAccess()) {
            echo $_POST['quote_id'];
            
            $this->citationModel->deleteBdQuote($_POST['quote_id']);

            $_SESSION['alert'] = [
                "type" => "success",
                "message" => "La citation a bien été supprimée"
            ];
            header("Location: ".URL."admin/citations/visualisation");

        } else {
            throw new Exception("Vous n'avez pas les droits d'accès");
        }
    }

    public function getUpdatePage($id)
    {
        $quotes = $this->citationModel->getBdOneCitation($id);

        // echo "<pre>";
        // print_r($quotes);
        // echo "</pre>";
        require_once "views/updateCitation.php";
    }

    public function UpdateQuote()
    {
        //Vérification des droits d'accès avant suppression
        if (Security::verifAccess()) {

            $id = (int)Security::secureHTML($_POST['id']);
            $quote = Security::secureHTML($_POST['quote']);
            $author = Security::secureHTML($_POST['author']);

            $this->citationModel->updateBdQuote($id, $quote, $author);


            $_SESSION['alert'] = [
                "type" => "success",
                "message" => "La citation a bien été modifiée"
            ];

            header("Location: ".URL."admin/citations/visualisation");

        } else {
            throw new Exception("Vous n'avez pas les droits d'accès");
        }
    }

    // public function createQuote()
    // {
    //     try{
    //         //vérification de l'access
    //     if (Security::verifAccess()) {
    //         //récupération de l'id du sermon
    //         // echo $_POST['sermon_id'];

    //         //sécurisation de l'injection et transformation en entier
            
    //         require_once "views/createCitation.php";

    //     }else{
    //         throw new Exception("Vous n'avez pas les droits d'accès");
            
    //     }
    //     }catch(Exception $e){
    //         $msg = $e->getMessage();
    //         echo $msg;
    //     }
    // }

    public function getPageCreation()
    {
        require_once "views/createCitation.php";
    }

    public function createQuotation()
    {
        try{
            //vérification de l'access
        if (Security::verifAccess()) {

            $citation = Security::secureHTML($_POST['quote']);
            $author = Security::secureHTML($_POST['author']);

            $this->citationModel->createBdQuote($citation, $author);

            $_SESSION['alert'] = [
                "type" => "success",
                "message" => "La citation a bien été créée"
            ];
                
                header("Location: ".URL."admin/citations/visualisation");

        }else{
            throw new Exception("Vous n'avez pas les droits d'accès");
            
        }
        }catch(Exception $e){
            $msg = $e->getMessage();
            echo $msg;
        }
    }


}