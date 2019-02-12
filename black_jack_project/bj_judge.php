
<?php
session_start();
include_once("bj_functions.php");

$cards = $_SESSION["cards"];
$d_hands = $_SESSION["d_hands"];
$p_hands = $_SESSION["p_hands"];
$money = $_SESSION["money"];
$bet = $_SESSION["bet"];

$d_point = total($d_hands);
$p_point = total($p_hands);

if($p_point > 21) {
	$p_message = "バーストであなた負け";
	$dividend = $bet * (-1);
} elseif($d_point > 21) {
	$p_message = "ディーラーのバーストであなたの勝ち";
	$dividend = $bet;
} elseif($p_point ==21 && count($p_hands)==2) {
	$p_message = "ブラックジャックであなたの勝ち";
	$dividend = $bet * 1.5;
}elseif($d_point ==21 && count($d_hands)==2) {
	$p_message = "ディーラーのブラックジャックであなたの負け";
	$dividend = $bet * (-1);
} elseif($p_point > $d_point) {
	$p_message = "あなたの勝ち";
	$dividend = $bet;
} elseif($p_point == $d_point) {
	$p_message = "同点で引き分け";
	$dividend = 0;
} else {
	$p_message = "あなたの負け";
	$dividend = $bet * (-1);
}

$money = $money + $dividend;
$_SESSION["money"] = $money;

if($money==0) {
  $last_message = "あなたの所持金はなくなりました。もうゲームはできません";
  $_SESSION["money"] = -1000;
} else {
  $last_message = <<<here_document
<button onClick="location.href='bj_init.php'">もう一度プレイ</button>
here_document;
}

$d_disp  = display($d_hands, 0);
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
print "ディーラー：" . $d_disp . "　　合計" . $d_point . "<br>";
print "プレイヤー：" . $p_disp . "　　合計" . $p_point . "　　" . "<br>";
print $p_message . "<br>";
print "配当金：" . $dividend . "ドル　　所持金：" . $money . "ドル" . "<br>";
print $last_message;

?>
</body>
</html>
