<?php

class User {

  public $isAuthed = false;
  public $UserId = 0;
  public $UserName = "";
  public $UserPassword = "";
  public $UserChannels = array();
  public $UserPublic = false;

  public function __construct() {

  }

  public function exists($name) {
      return file_exists('localstore/'.$name.'.json');
  }

  public function auth($pass) {
      if (password_verify($pass, $this->UserPassword)) {
        $this->isAuthed = true;
        return $this->isAuthed;
      }
      return $this->isAuthed;
  }

  public function setName($string) {
      $this->UserName = $string;
      return $this->loadFromLocalStore();
  }

  public function createUser() {

    return true;
  }

  public function loadFromLocalStore() {
      if ($this->UserName != "" && file_exists('localstore/'.$this->UserName.'.json')) {
          $localObject = json_decode(file_get_contents('localstore/'.$this->UserName.'.json'));
          $this->UserId = $localObject->UserId;
          $this->UserPassword = $localObject->UserPassword;
          if (isset($localObject->UserChannels)) $this->UserChannels = $localObject->UserChannels;
          if (isset($localObject->UserPublic)) {
            $this->UserPublic = $localObject->UserPublic;
          }
          else {
            $this->UserPublic = false;
          }
          return true;
      }
      else
        return false;

  }

  public function toggleChannel($channel) {
      $arrayPos;
      $ChannelObject;
      foreach ($this->UserChannels as $i => $value) {
        if (preg_match('/'.$channel.'/', $value)) {
          $ChannelObject = json_decode($value);
          if ($ChannelObject->ChannelActive) {
            $ChannelObject->ChannelActive = false;
          }
          else {
            $ChannelObject->ChannelActive = true;
          }
          $ChannelObject->ChannelLastUpdate = time();
          $arrayPos = $i;
          break;
        }
      }
      $this->UserChannels[$i] = json_encode($ChannelObject);
      $this->writeChanges();
  }

  public function deleteChannel($channel) {
      $arrayPos;
      $ChannelObject;
      foreach ($this->UserChannels as $i => $value) {
        if (preg_match('/'.$channel.'/', $value)) {
          $arrayPos = $i;
          break;
        }
      }
      unset($this->UserChannels[$i]);
      $this->writeChanges();
  }

  public function writeChanges() {
    unset($this->isAuthed);
    file_put_contents('localstore/'.$this->UserName.'.json', json_encode($this));
    $this->isAuthed = true;
  }

  public function isAuthed() {
    return $this->isAuthed;
  }
}

?>
