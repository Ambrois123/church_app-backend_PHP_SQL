<?php 

require_once "config/Database.php";
class Sermons extends Database
{
    private $id;
    private $title;
    private $date;
    private $resume;
    private $audio;
    private $author;

    public function __construct($id, $title, $date, $resume, $audio, $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->resume = $resume;
        $this->audio = $audio;
        $this->author = $author;
    }

    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}

    public function getTitle(){return $this->title;}
    public function setTitle($title){$this->title = $title;}

    public function getDate(){return $this->date;}
    public function setDate($date){$this->date = $date;}

    public function getResume(){return $this->resume;}
    public function setResume($resume){$this->resume = $resume;}

    public function getAudio(){return $this->audio;}
    public function setAudio($audio){$this->audio = $audio;}

    public function getAuthor(){return $this->author;}
    public function setAuthor($author){$this->author = $author;}
    
}