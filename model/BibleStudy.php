<?php  

require_once "config/Database.php";

class BibleStudy extends Database
{
    private $bibleStudy_id;
    private $bibleStudy_date;
    private $bibleStudy_title;
    private $bibleStudy_author;

    public function __construct($bibleStudy_id, $bibleStudy_date, $bibleStudy_title, $bibleStudy_author)
    {
        $this->bibleStudy_id = $bibleStudy_id;
        $this->bibleStudy_date = $bibleStudy_date;
        $this->bibleStudy_title = $bibleStudy_title;
        $this->bibleStudy_author = $bibleStudy_author;
    }

    public function getBibleStudyId() {return $this->bibleStudy_id;}
    public function setBibleStudyId($bibleStudy_id) {$this->bibleStudy_id = $bibleStudy_id;}

    public function getBibleStudyDate() {return $this->bibleStudy_date;}
    public function setBibleStudyDate($bibleStudy_date) {$this->bibleStudy_date = $bibleStudy_date;}

    public function getBibleStudyTitle() {$this->bibleStudy_title;}
    public function setBibleStudyTitle($bibleStudy_title) {return $this->bibleStudy_title = $bibleStudy_title;}

    public function getBibleStudyAuthor() {return $this->bibleStudy_author;}
    public function setBibleStudyAuthor($bibleStudy_author) {return $this->bibleStudy_author = $bibleStudy_author;}
}