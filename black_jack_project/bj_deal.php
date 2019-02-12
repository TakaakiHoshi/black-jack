<?php
session_start();
include_once("bj_functions.php");

$money = $_SESSION["money"];
$bet = $_GET["bet"];
if($bet<=0 || $bet>$money) {
  $_SESSION["init_message"] = "所持金の範囲内で賭けてください";
  header("Location: bj_init.php");
} else {
  $_SESSION["bet"] = $bet;
}

$cards = array();
$suits = array("&spades;", "&hearts;", "&diams;", "&clubs;");

$d_hands = array();
$p_hands = array();

foreach($suits as $suit) {		// カードの生成
  for($i=1; $i<=13; $i=$i+1) {
    $cards[] = array("suit" => $suit, "num" => $i);
  }
}
shuffle($cards);

$d_hands[] = array_shift($cards);
$d_hands[] = array_shift($cards);
$p_hands[] = array_shift($cards);
$p_hands[] = array_shift($cards);
$_SESSION["cards"] = $cards;
$_SESSION["d_hands"] = $d_hands;
$_SESSION["p_hands"] = $p_hands;

$d_point = total($d_hands);
$p_point = total($p_hands);

if($p_point==21 || $d_point==21){
  header("Location: bjpr4_judge.php");
}
$d_disp  = display($d_hands, 1);
$p_disp  = display($p_hands, 0);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ブラック・ジャック</title>
<link rel="stylesheet" type="text/css" href="bjpr4_style.css">
</head>
<body>
<?php
print "ディーラー：" . $d_disp . "<br>";
print "プレイヤー：" . $p_disp . "　　合計" . $p_point . "<br>";
print "現在の所持金：" . $money . "ドル　　賭け金：" . $bet . "ドル<br>";
?>
<button onClick="location.href='bj_hit.php'">ヒット</button>
<button onClick="location.href='bj_stand.php'">スタンド</button>

</body>
</html>
