<?php
function total($hands) {
  $ace = 0;
  $ttl = 0;

  foreach($hands as $hand) {
    $num = $hand["num"];

    if($num >10) {				// J、Q、Kは10点
      $num = 10;
    } elseif ($num == 1) {			// Aceは11点
      $num = 11;
      $ace = $ace + 1;				// 11点扱いのAceの枚数
    }
    $ttl = $ttl + $num;
    if($ace > 0 && $ttl>21) {
      $ttl = $ttl - 10;
      $ace = $ace - 1;
    }
  }
    return $ttl;
}


function display($hands, $fd) {
  $disp = "";
  $count = 0;
  foreach($hands as $hand) {
  $count = $count + 1;

  if($hand["num"]==1){
    $hand["num"] = "A";
  } elseif ($hand["num"]==11) {
    $hand["num"] = "J";
} elseif ($hand["num"]==12) {
    $hand["num"] = "Q";
} elseif ($hand["num"]==13) {
    $hand["num"] = "K";
}


  if($fd == 1 && $count ==2){

   $card_class = "'card " .
                 substr($hand["suit"],1,strlen($hand["suit"])-2) . "'";
   $disp = $disp . "<img src ='back.jpg' class = {$card_class}>";
 }else{

    $card_class = "'card " .
                  substr($hand["suit"],1,strlen($hand["suit"])-2) . "'";
    $disp = $disp . "<span class = {$card_class}>" . $hand["suit"] .
            "<br>" . $hand["num"]. "</span>";
        }

  }
  return $disp;
}
?>
