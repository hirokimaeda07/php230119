<!-- お気に入り削除の処理 -->

<?php session_start(); ?>
<?php require 'menu.php';
include('../functions.php');

?>

<?php
if (isset($_SESSION['customer'])) {
	//$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'staff', 'password');
$pdo = connect_to_db();
	$sql=$pdo->prepare(
	//削除はfavoritテーブルから、指定した顧客番号と商品番号の行を削除する
		'delete from favorite where customer_id=? and product_id=?');
	$sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
	echo 'お気に入りから商品を削除しました。';
	echo '<hr>';
} else {
	echo 'お気に入りから商品を削除するには、ログインしてください。';
}
require 'favorite.php';
?>
