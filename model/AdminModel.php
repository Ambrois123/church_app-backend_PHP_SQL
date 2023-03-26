<?php 

require_once "config/Database.php";

class AdminModel extends Database
{
    //Récupération pwd en base de données
    private function getPassword($login)
    {
        $req = "SELECT * FROM administrateur WHERE login = :login";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $admin['password'];
    }

    //Vérification de la validité de la connexion: si pwd en BD est = à pwd saisi
    public function isConnexionValide($login,$password)
    {
        $passwordBd = $this->getPassword($_POST['login']);
        return password_verify($password, $passwordBd);
    }
    
}