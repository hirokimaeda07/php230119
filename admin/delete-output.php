<!-- 商品情報削除後の画面 -->
<?php require 'admin-menu.php'; ?>

<?php
include('../functions.php');
$pdo = connect_to_db();

$sql=$pdo->prepare('delete from product where id=?');
if ($sql->execute([$_REQUEST['id']])) {
	echo '削除に成功しました。';
} else {
	echo '削除に失敗しました。';
}
?>

