<?php 

require_once "config/Database.php";

require_once "model/Sermons.php";

class SermonModel extends Database
{
    
    public function getBdSermons()
    {
        $req = "SELECT * FROM sermons ORDER BY date DESC";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->execute();
        $sermons = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $sermons;
    }

    public function getBdOneSermon($id)
    {
        $req = "SELECT * FROM sermons WHERE id = :id";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $sermon = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $sermon;
    }

    public function deleteBdSermon($id)
    {
        $req = "DELETE FROM sermons WHERE id = :id";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    

    
}