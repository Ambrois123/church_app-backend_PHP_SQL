<?php 

class CitationModel extends Database
{
    public function getBdCitations()
    {
        $req = "SELECT * FROM citations";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->execute();
        $citations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $citations;
    }

    public function getBdOneCitation($id)
    {
        $req = "SELECT * FROM citations WHERE id = :id";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $citation = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $citation;
    }

    public function deleteBdQuote($id)
    {
        $req = "DELETE FROM citations WHERE id = :id";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

}