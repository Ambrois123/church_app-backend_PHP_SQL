<?php  

require_once "config/Database.php";

class BibleStudyModel extends Database
{
    public function getBddBibleStudy()
    {
        $req = "SELECT * FROM biblestudy ORDER BY date DESC";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->execute();
        $bibleStudyDatas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $bibleStudyDatas;

    }

    public function getBddOneBibleStudy($id)
    {
        $req = "SELECT * FROM biblestudy 
        WHERE id = :id";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $oneBibleStudy = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $oneBibleStudy;

    }

    public function deleteBddBibleStudy($id)
    {
        $req = "DELETE FROM biblestudy WHERE id = :id";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function updateBddBibleStudy($id, $date, $title, $audio, $author)
    {
        $req = "UPDATE biblestudy
        SET date = :date, title = :title,  audio = :audio, author = :author
        WHERE id = :id"; 
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":date", $date, PDO::PARAM_STR);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":audio", $audio, PDO::PARAM_STR);
        $stmt->bindValue(":author", $author, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function createBddBibleStudy($date, $title,$audio, $author)
    {
        $req = "INSERT INTO biblestudy (date, title, audio, author)
        VALUES (:date, :title, :audio, :author)";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":date", $date, PDO::PARAM_STR);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":audio", $audio, PDO::PARAM_STR);
        $stmt->bindValue(":author", $author, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

        return $this->getConnection()->lastInsertId();
    }

    //fonction sql pour récupérer l'audio pour supprimer l'audio
    public function getBibleStudyAudio($idBibleStudy)
    {
        $req = "SELECT audio FROM biblestudy WHERE id = :id";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":id", $idBibleStudy, PDO::PARAM_INT);
        $stmt->execute();
        $audio = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $audio['audio'];
    }
    
}