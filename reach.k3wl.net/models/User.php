<?php

class User {

  public $isAuthed = false;
  public $UserId = 0;
  public $UserName = "";
  public $UserPassword = "";
  public $UserChannels = array();
  public $UserPublic = false;

  public function __construct() {
      #$this->UserPassword = "lala";
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
      $this->loadFromLocalStore();
      return true;
  }

  public function loadFromLocalStore() {
      if ($this->UserName != "" && file_exists('localstore/'.$this->UserName.'.json')) {
          $localObject = json_decode(file_get_contents('localstore/'.$this->UserName.'.json'));
          $this->UserId = $localObject->UserId;
          $this->UserPassword = $localObject->UserPassword;
          $this->UserChannels = $localObject->UserChannels;
          $this->UserPublic = $localObject->UserPublic;
      }
  }

  public function toggleChannel($channel) {
      if (isset($this->UserChannels->$channel->active) && $this->UserChannels->$channel->active) {
        $this->UserChannels->$channel->active = false;
        $this->UserChannels->$channel->lastupdate = time();
      }
      elseif (isset($this->UserChannels->$channel->active)){
        $this->UserChannels->$channel->active = true;
        $this->UserChannels->$channel->lastupdate = time();
      }
      $this->writeChanges();
  }

  private function writeChanges() {
    unset($this->isAuthed);
    file_put_contents('localstore/'.$this->UserName.'.json', json_encode($this));
  }

  public function isAuthed() {
    return $this->isAuthed;
  }
}

?>
