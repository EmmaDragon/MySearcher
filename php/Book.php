<?php

class Book{
    
   public $id;
   public $title;
   public $content = "";
   public $dateModified;
   public $rank;
   
    public function __construct($idetifier,$title,$dateModified,$score) {
     
       $this->id=$idetifier;
       $this->title=$title;
       $this->dateModified=$dateModified;
       $this->rank=$score;
   }
   
   public function printInfoBook()
   {
       echo $this->id." :: ".$this->title." ( ".strval($this->dateModified)." ) [".strval($this->rank)."]";
       echo "<br>";
       
   }
    
    
}

?>

