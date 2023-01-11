<?php require 'admin-menu.php'; ?>

<?php
//DB接続
include('../functions.php');
$pdo = connect_to_db();

$sql=$pdo->prepare('insert into product values(null, ?, ?)');
if (empty($_REQUEST['name'])) {
	echo '商品名を入力してください。';
} else
if (!preg_match('/^[0-9]+$/', $_REQUEST['price'])) {
	echo '価格を整数で入力してください。';
} else
if ($sql->execute(
	[htmlspecialchars($_REQUEST['name']), $_REQUEST['price']]
)) {
	echo '追加に成功しました。';
} else {
	echo '追加に失敗しました。';
}
?>

