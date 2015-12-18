<?php

class User {

  public $isAuthed = false;
  public $UserId = 0;
  public $UserName = "";
  public $UserPassword = "";

  public function __construct() {
      $this->UserPassword = "lala";
  }

  public function auth($pass) {
      if ($pass == $this->UserPassword) {
        $this->isAuthed = true;
        return $this->isAuthed;
      }
      return $this->isAuthed;
  }

  public function setName($string) {
      $this->UserName = $string;
      return true;
  }

  public function isAuthed() {
    return $this->isAuthed;
  }
}

?>
