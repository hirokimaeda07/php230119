<!-- お気に入り登録の画面 -->

<?php session_start(); ?>
<?php require 'menu.php'; 
include('../functions.php');
$pdo = connect_to_db();
?>

<?php
//お気に入りは、ログインしている必要あり。
if (isset($_SESSION['customer'])) {
	//$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8','staff', 'password');
	
	//favorite　テーブルに登録
	//ログインしていたら、insertで	sqlを実行
	$sql=$pdo->prepare('insert into favorite values(?,?)');
	//上記?は、顧客番号と商品番号
	$sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
	echo 'お気に入りに商品を追加しました。';
	echo '<hr>';
	require 'favorite.php';
} else {
	echo 'お気に入りに商品を追加するには、ログインしてください。';
}
?>

