<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>商品情報の更新ページ</title>
</head>

<?php require 'admin-menu.php'; ?>

<body>

<p>商品情報の更新ページ</p>

<div class="th0">商品番号</div>
<div class="th1">商品名</div>
<div class="th1">価格</div>

<?php
include('../functions.php');
$pdo = connect_to_db();

foreach ($pdo->query('select * from product') as $row) {
	echo '<form action="update-output.php" method="post">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<div class="td0">', $row['id'], '</div> ';
	echo '<div class="td1">';
	echo '<input type="text" name="name" value="', $row['name'], '">';
	echo '</div> ';
	echo '<div class="td1">';
	echo ' <input type="text" name="price" value="', $row['price'], '">';
	echo '</div> ';
	echo '<div class="td2"><input type="submit" value="更新"></div>';
	echo '</form>';
	echo "\n";
}
?>



<div class="th0">商品番号</div>
<div class="th1">商品名</div>
<div class="th1">価格</div>

</body>
</html>
