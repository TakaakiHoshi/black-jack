
<?php
session_start();
include_once("bj_functions.php");

$cards = $_SESSION["cards"];
$d_hands = $_SESSION["d_hands"];
$p_hands = $_SESSION["p_hands"];
$d_point = total($d_hands);
$p_point = total($p_hands);

while($d_point<17) {
  $d_hands[] = array_shift($cards);
  $d_point = total($d_hands);
}

$_SESSION["cards"] = $cards;
$_SESSION["d_hands"] = $d_hands;
$_SESSION["p_hands"] = $p_hands;

header("Location: bj_judge.php");

?>
