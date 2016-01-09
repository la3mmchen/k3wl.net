<?php

class Helper {
  private $localstore = 'localstore/';

  public function timeago($timestamp) {
     $full = false;
     $now = new DateTime;
     $ago = new DateTime('@'.$timestamp);
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

  public function listUsers() {
    return  preg_replace('/.json/', '',  array_diff(scandir($this->localstore.'pub/'), array('..', '.')));;
  }
}

?>
