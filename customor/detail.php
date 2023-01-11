<!-- 商品詳細画面 -->

<?php require 'menu.php';
include('../functions.php');
$pdo = connect_to_db();
?>

<?php
//$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8','staff', 'password');

	//商品番号の商品情報を取得
	$sql=$pdo->prepare('select * from product where id=?');

	$sql->execute([$_REQUEST['id']]);
foreach ($sql as $row) {
	echo '<p><img alt="image" width="250px" src="image/' , $row['id'], '.jpg"></p>';

	//カートに追加ボタンを選択すると、cart-insert.phpが実行
	echo '<form action="cart-insert.php" method="post">';
	echo '<p>商品番号：', $row['id'], '</p>';
	echo '<p>商品名：', $row['name'], '</p>';
	echo '<p>価格：', $row['price'], '</p>';
	//セレクトボックス。1～10個
	echo '<p>個数：<select name="count">';
	for ($i=1; $i<=10; $i++) {
		echo '<option value="', $i, '">', $i, '</option>';
	}
	echo '</select></p>';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="hidden" name="name" value="', $row['name'], '">';
	echo '<input type="hidden" name="price" value="', $row['price'], '">';
	echo '<p><input type="submit" value="カートに追加"></p>';
	echo '</form>';
	echo '<p><a href="favorite-insert.php?id=', $row['id'], 
		'">お気に入りに追加</a></p>';
}
?>

