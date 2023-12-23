<?php namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
class StudentSearch 
{ private $student; 
    public function getStudent(): ?Student 
    { return $this->student; }
     public function setStudent(?Student $student): self
      { $this->student = $student;
        return $this;
    }
}