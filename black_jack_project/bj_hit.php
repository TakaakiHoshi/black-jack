
<?php
session_start();
include_once("bj_functions.php");

$cards = $_SESSION["cards"];
$d_hands = $_SESSION["d_hands"];
$p_hands = $_SESSION["p_hands"];
$money = $_SESSION["money"];
$bet = $_SESSION["bet"];

$p_hands[] = array_shift($cards);			// プレイヤ1枚追加
$_SESSION["cards"] = $cards;
$_SESSION["d_hands"] = $d_hands;
$_SESSION["p_hands"] = $p_hands;

$d_point = total($d_hands);
$p_point = total($p_hands);

if($p_point>21){
  header("Location: bj_judge.php");
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
