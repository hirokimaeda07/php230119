<!-- カート内の画面 -->

<?php
//商品が空かどうか確認
if (!empty($_SESSION['product'])) {
	echo '<table>';
	echo '<tr><th>商品番号</th><th>商品名</th>';
	echo '<th>価格</th><th>個数</th><th>小計</th><th></th></tr>';

	$total=0;
	//カートの中身を表示
	foreach ($_SESSION['product'] as $id=>$product) {
		echo '<tr>';
		echo '<td>', $id, '</td>';
		echo '<td><a href="detail.php?id=', $id, '">', 
			$product['name'], '</a></td>';
		echo '<td>', $product['price'], '</td>';
		echo '<td>', $product['count'], '</td>';

		//小計の計算
		$subtotal=$product['price']*$product['count'];
		//合計の計算。合計は、$totalに格納するため、上部で$total=0;にしておく。
		$total+=$subtotal;
		echo '<td>', $subtotal, '</td>';
		echo '<td><a href="cart-delete.php?id=', $id, '">削除</a></td>';
		echo '</tr>';
	}
	echo '<tr><td>合計</td><td></td><td></td><td></td><td>', $total, 
		'</td><td></td></tr>';
	echo '</table>';
} else {
	echo 'カートに商品がありません。';
}
?>
