<?php 

class CitationModel extends Database
{
    public function getBdCitations()
    {
        $req = "SELECT * FROM citations";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->execute();
        $quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $quotes;
    }

    public function getBdOneCitation($id)
    {
        $req = "SELECT * FROM citations WHERE id = :id";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $quote = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $quote;
    }

    public function deleteBdQuote($id)
    {
        $req = "DELETE FROM citations WHERE id = :id";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function updateBdQuote($id, $quotes, $author)
    {
        $req = "UPDATE citations
        SET quotes = :quotes, author = :author
        WHERE id = :id";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);  
        $stmt->bindValue(":quotes", $quotes, PDO::PARAM_STR);
        $stmt->bindValue(":author", $author, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function createBdQuote($citation, $author)
    {
        $req = "INSERT INTO citations (quotes, author)
        VALUES (:quotes, :author)";
        $stmt = $this->getConnection()->prepare($req);
        $stmt->bindValue(":quotes", $citation, PDO::PARAM_STR);
        $stmt->bindValue(":author", $author, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

        return $this->getConnection()->lastInsertId();
    }

}