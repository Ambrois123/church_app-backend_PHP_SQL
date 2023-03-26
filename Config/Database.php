<?php
abstract class Database 
{
    private static $pdo;

    private static function setConnection()
    {
        self::$pdo = new PDO("mysql:host=localhost;dbname=church_server;charset=utf8", "root","");
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

        // echo "Connexion à la base de données réussie";
    }

    protected function getConnection()
    {
        if(self::$pdo === null){
            self::setConnection();
        }
        return self::$pdo;
    }
}