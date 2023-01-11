<!-- 商品をカートに追加する画面 -->

<?php session_start(); ?>

<?php require 'menu.php'; ?>

<?php
$id=$_REQUEST['id'];
if (!isset($_SESSION['product'])) {
	$_SESSION['product']=[];
}

//既にカートに商品選択されている場合、個数を合計する処理
$count=0;
//カートに入れた商品と同じ商品があるか確認
if (isset($_SESSION['product'][$id])) {
	//同じ商品がある場合、既存カートの個数を取得し、変数$countに代入
	$count=$_SESSION['product'][$id]['count'];
}

//カートに商品を登録
$_SESSION['product'][$id]=[
	'name'=>$_REQUEST['name'], 
	'price'=>$_REQUEST['price'], 
	'count'=>$count+$_REQUEST['count']
];
echo '<p>カートに商品を追加しました。</p>';
echo '<hr>';
//カート内の商品一覧を表示
require 'cart.php';
?>
