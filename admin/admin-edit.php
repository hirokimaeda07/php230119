<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../boostrap/css/bootstrap.min.css" rel="stylesheet">
	<title>追加・更新・削除</title>

</head>

<?php require 'admin-menu.php'; ?>

<body>

<table class="table table-hover">
	<thead>
		<tr>
			<th scope="col">商品番号</th>
			<th scope="col">商品名</th>
			<th scope="col">価格</th>
		</tr>
	</thead>

<?php
include('../functions.php');
$pdo = connect_to_db();

if (isset($_REQUEST['command'])) {
	switch ($_REQUEST['command']) {
	case 'insert':
		if (empty($_REQUEST['name']) || 
			!preg_match('/^[0-9]+$/', $_REQUEST['price'])) break;
		$sql=$pdo->prepare('insert into product values(null,?,?)');
		$sql->execute(
			[htmlspecialchars($_REQUEST['name']), $_REQUEST['price']]);
		break;
	case 'update':
		if (empty($_REQUEST['name']) || 
			!preg_match('/^[0-9]+$/', $_REQUEST['price'])) break;
		$sql=$pdo->prepare(
			'update product set name=?, price=? where id=?');
		$sql->execute(
			[htmlspecialchars($_REQUEST['name']), $_REQUEST['price'], 
			$_REQUEST['id']]);
		break;
	case 'delete':
		$sql=$pdo->prepare('delete from product where id=?');
		$sql->execute([$_REQUEST['id']]);
		break;
	}
}
foreach ($pdo->query('select * from product') as $row) {
	echo '<form class="ib" action="admin-edit.php" method="post">';
	echo '<input type="hidden" name="command" value="update">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';

	echo '<tbody><tr>';
	echo '<th scope="row">', $row['id'], '</th>';
	echo '<th scope="row"><input type="text" name="name" value="', $row['name'], '"></th>';
	echo '<th scope="row"><input type="text" name="price" value="', $row['price'], '"></th>';

	echo '<th scope="row"><input type="submit" value="更新"></th>';

	echo '</form> ';

	echo '<form class="ib" action="admin-edit.php" method="post">';
	echo '<input type="hidden" name="command" value="delete">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';

	echo '<th scope="row"><input type="submit" value="削除"></th>';
		echo '</tr> ';

	echo '</form></tbody>';
	echo "\n";
}
?>

<form action="admin-edit.php" method="post">
<input type="hidden" name="command" value="insert">
<tbody><tr>
<th scope="row"></th>
<th scope="row"><input type="text" name="name"></th>
<th scope="row"><input type="text" name="price"></th>
<th scope="row"><input type="submit" value="追加"></th>
</tbody>
</form>
</table>


</body>
</html>