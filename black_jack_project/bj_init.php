
<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

$money = $_SESSION["money"];
if (!isset($money) || $money<0) {
  $money = 1000;
  $_SESSION["money"] = $money;
}
if(isset($_SESSION["init_message"])) {
  $init_message = $_SESSION["init_message"];
  $_SESSION["init_message"] = null;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ブラック・ジャック</title>
<link rel="stylesheet" type="text/css" href="bjpr4_style.css">
</head>
<body>
<h2>ブラック・ジャック</h2>

<?php

print <<<document
<div>{$init_message}</div>
あなたの現在の所持金は{$money}ドルです。
ゲームを開始するには、所持金の範囲内でかける金額を入力して、「ディール」ボタンを押してください。　
<form action="bj_deal.php" method="get">
  <input type="text" name="bet" size=10>ドル　
  <input type="submit" value="ディール">
</form>

document;
?>
</body>
</html>
