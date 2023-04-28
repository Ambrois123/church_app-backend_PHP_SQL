<?php 

require_once "config/Database.php";

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

    public function updateBdSermon($id, $image, $date, $title, $resume, $audio, $author)
    {
        $req = "UPDATE sermons
        SET image = :image, date = :date, title = :title, resume = :resume, audio = :audio, author = :author
        WHERE id = :id"; 
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $stmt->bindValue(":date", $date, PDO::PARAM_STR);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":resume", $resume, PDO::PARAM_STR);
        $stmt->bindValue(":audio", $audio, PDO::PARAM_STR);
        $stmt->bindValue(":author", $author, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function createBdSermon($image, $date, $title, $resume, $audio, $author)
    {
        $req = "INSERT INTO sermons (image, date, title, resume, audio, author)
        VALUES (:image, :date, :title, :resume, :audio, :author)";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $stmt->bindValue(":date", $date, PDO::PARAM_STR);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":resume", $resume, PDO::PARAM_STR);
        $stmt->bindValue(":audio", $audio, PDO::PARAM_STR);
        $stmt->bindValue(":author", $author, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

        return $this->getConnection()->lastInsertId();
    }

    //fonction sql pour récupérer l'image pour supprimer l'image
    // public function getSermonImage($idSermon)
    // {
    //     $req = "SELECT image FROM sermons WHERE id = :id";
    //     $stmt = $this->getConnection()->prepare($req);
    //     $stmt->bindValue(":id", $idSermon, PDO::PARAM_INT);
    //     $stmt->execute();
    //     $image= $stmt->fetch(PDO::FETCH_ASSOC);
    //     $stmt->closeCursor();
    //     return $image['image'];
    // }

    //fonction sql pour récupérer l'audio pour supprimer l'audio
    public function getSermonAudio($idSermon)
    {
        $req = "SELECT audio FROM sermons WHERE id = :id";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":id", $idSermon, PDO::PARAM_INT);
        $stmt->execute();
        $audio = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $audio['audio'];
    }
    



    

}

    