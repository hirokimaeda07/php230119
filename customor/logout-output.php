<!-- ログアウト完了時の画面 -->

<?php session_start(); ?>
<?php require 'menu.php'; ?>

<?php
//isset で現在ログインしてるか確認
if (isset($_SESSION['customer'])) {
	//unset で、ログインしていたらログアウト
	//unset で、顧客情報が格納された$_SESSION['customer']を削除
	unset($_SESSION['customer']);
	echo 'ログアウトしました。';
} else {
	echo 'すでにログアウトしています。';
}
?>