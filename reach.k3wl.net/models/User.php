<?php

class User {

  public $isAuthed = false;
  public $UserId = 0;
  public $UserName = "";
  public $UserPassword = "";
  public $UserChannels = array();
  public $UserPublic = false;
  private $localFile = "";

  public function __construct() {

  }

  public function exists($name) {
      $this->UserName = $name;
      return $this->findUser();
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
      if ($this->UserName != "" && $this->findUser()) {
          $localObject = json_decode(file_get_contents($this->localFile));
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

  public function findUser() {
    if (file_exists('localstore/'.$this->UserName.'.json')) {
      $this->localFile = 'localstore/'.$this->UserName.'.json';
      return true;
    }
    else if (file_exists('localstore/pub/'.$this->UserName.'.json')) {
      $this->localFile = 'localstore/pub/'.$this->UserName.'.json';
      return true;
    }
    else if (file_exists('localstore/priv/'.$this->UserName.'.json')) {
      $this->localFile = 'localstore/priv/'.$this->UserName.'.json';
      return true;
    }
    else
        return false;
  }

  public function setLocalFile() {
    if ($this->UserPublic)
        $this->localFile = 'localstore/pub/'.$this->UserName.'.json';
    else
      $this->localFile = 'localstore/priv/'.$this->UserName.'.json';

    return true;
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
    file_put_contents($this->localFile, json_encode($this));
    $this->isAuthed = true;
  }

  public function isAuthed() {
    return $this->isAuthed;
  }

  public function goingPublic() {
    if (file_exists($this->localFile)) {
      rename($this->localFile, 'localstore/pub/'.$this->UserName.'.json');
    return true;
    }
    return false;
  }

  public function goingPrivate() {
    if (file_exists($this->localFile)) {
      rename($this->localFile, 'localstore/priv/'.$this->UserName.'.json');
    return true;
    }
    return false;
  }
}

?>
