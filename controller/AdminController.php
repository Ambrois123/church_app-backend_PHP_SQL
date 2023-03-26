<?php 

require_once "config/Security.php";
require_once "model/AdminModel.php";

class AdminController 
{
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function getPageLogin()
    {
        require_once "views/pageLogin.php";
    }

    public function connexion()
    {
        //accès au site
        /*l= Page_Admin_Eglise
        p= aegt_church_Admin31
        */

        //Vérification des droits d'accès
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $login = Security::secureHTML($_POST['login']);
            $password = Security::secureHTML($_POST['password']);

            //la vérification se fait dans AdminModel.

            if ($this->adminModel->isConnexionValide($login, $password)) {
                $_SESSION['access'] = "admin";

                header("Location: ".URL."admin/accueil");

            } else {
                header("Location: ".URL."admin/login");
            }
        }
    }

    // si la connexion est valide, cette fonction sera appelée.
    public function getAccueilAdmin()
    {
        //fonction verifAccess() dans Security.php. Peut pas accéder à la page d'accueil sans connexion.
        if(Security::verifAccess()){
            require_once "views/Accueil.php";
        }else{
            //si pas de connexion, on redirige vers la page de connexion
            header("Location: ".URL."admin/login");
        }
        
    }

    public function deconnexion()
    {
        //détruit la session
        session_destroy();
        header("Location: ".URL."admin/login");
    }
}