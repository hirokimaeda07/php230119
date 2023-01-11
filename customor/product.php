<!-- 商品一覧ページ -->

<?php require 'menu.php'; 
include('../functions.php');
$pdo = connect_to_db();
?>

<form action="product.php" method="post">
	商品検索
	<input type="text" name="keyword">
	<input type="submit" value="検索">
</form>
<hr>

<?php
echo '<table>';
echo '<tr><th>商品番号</th><th>商品名</th><th>価格</th></tr>';

//$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'staff', 'password');

//リクエストパラメーターに検索キーワードが含まれるときには、商品の検索を実行。
if (isset($_REQUEST['keyword'])) {
	$sql=$pdo->prepare('select * from product where name like ?');
	$sql->execute(['%'.$_REQUEST['keyword'].'%']);
} else {
	$sql=$pdo->query('select * from product');
}
foreach ($sql as $row) {
	$id=$row['id'];
	echo '<tr>';
	echo '<td>', $id, '</td>';
	echo '<td>';
	echo '<a href="detail.php?id=', $id, '">', $row['name'], '</a>';
	echo '</td>';
	echo '<td>', $row['price'], '</td>';
	echo '</tr>';
}
echo '</table>';
?>

