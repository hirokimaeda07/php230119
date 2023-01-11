<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>商品情報削除</title>
</head>

<?php require 'admin-menu.php'; ?>

<body>

<p>商品情報削除のページ</p>


<table>
<tr><th>商品番号</th><th>商品名</th><th>価格</th><th></th></tr>

<?php

include('../functions.php');
$pdo = connect_to_db();

foreach ($pdo->query('select * from product') as $row) {
	echo '<tr>';
	echo '<td>', $row['id'], '</td>';
	echo '<td>', $row['name'], '</td>';
	echo '<td>', $row['price'], '</td>';
	echo '<td>';
	echo '<a href="delete-output.php?id=', $row['id'], '">削除</a>';
	echo '</td>';
	echo '</tr>';
	echo "\n";
}
?>
</table>

</body>
</html>

