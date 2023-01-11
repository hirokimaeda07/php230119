<!-- お気に入りを表示 -->

<?php session_start(); ?>
<?php require 'menu.php'; ?>

<?php
echo '<p>お気に入り登録一覧</p>';
require 'favorite.php';
?>
