<?php

class Channel {

  public $ChannelId = 0;
  public $ChannelName = "";
  public $ChannelDetails = "";
  public $ChannelLastUpdate = 0;
  public $ChannelActive = false;
  public $ChannelType = "";

  public function __construct($input) {
    if (isset($input->id))
      $this->ChannelId = $input->id;
    if (isset($input->name))
      $this->ChannelName = $input->name;
    if (isset($input->details))
      $this->ChannelDetails = $input->details;
   if (isset($input->lastupdate))
      $this->ChannelLastUpdate = $input->lastupdate;
    if (isset($input->active))
      $this->ChannelActive = $input->active;
    if (isset($input->type))
      $this->ChannelType = $input->type;
  }

  public function getIcon() {
    if ($this->ChannelType == "synchron") {
      return '<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>';
    }
    else {
      return '<span class="glyphicon glyphicon-comment" aria-hidden="true"></span>';
    }
  }

  public function updatedAgo() {
     $full = false;
     $now = new DateTime;
     $ago = new DateTime('@'.$this->ChannelLastUpdate);
     $diff = $now->diff($ago);

     $diff->w = floor($diff->d / 7);
     $diff->d -= $diff->w * 7;

     $string = array(
         'y' => 'year',
         'm' => 'month',
         'w' => 'week',
         'd' => 'day',
         'h' => 'hour',
         'i' => 'minute',
         's' => 'second',
     );
     foreach ($string as $k => &$v) {
         if ($diff->$k) {
             $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
         } else {
             unset($string[$k]);
         }
     }

     if (!$full) $string = array_slice($string, 0, 1);
     return $string ? implode(', ', $string) . ' ago' : 'just now';
  }

}

?>
