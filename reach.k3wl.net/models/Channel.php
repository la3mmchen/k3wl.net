<?php

class Channel {

  public $ChannelId = 0;
  public $ChannelName = "";
  public $ChannelDetails = "";
  public $ChannelLastUpdate = 0;
  public $ChannelActive = false;
  public $ChannelType = "";

  public function __construct() {
      $a = func_get_args();
      $i = func_num_args();
      if (method_exists($this,$f='__construct'.$i)) {
          call_user_func_array(array($this,$f),$a);
      }
  }

  public function __construct1($input) {
      if (isset($input->ChannelId))
        $this->ChannelId = $input->ChannelId;
      if (isset($input->ChannelName))
        $this->ChannelName = $input->ChannelName;
      if (isset($input->ChannelDetails))
        $this->ChannelDetails = $input->ChannelDetails;
     if (isset($input->ChannelLastUpdate))
        $this->ChannelLastUpdate = $input->ChannelLastUpdate;
      if (isset($input->ChannelActive))
        $this->ChannelActive = $input->ChannelActive;
      if (isset($input->ChannelType))
        $this->ChannelType = $input->ChannelType;
  }

  public function __construct2($a1,$a2) {
      echo('__construct with 2 params called: '.$a1.','.$a2.PHP_EOL);
  }

  public function __construct3($a1,$a2,$a3) {
      echo('__construct with 3 params called: '.$a1.','.$a2.','.$a3.PHP_EOL);
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
