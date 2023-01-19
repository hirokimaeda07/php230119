<!-- 顧客一覧ページ -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>顧客一覧</title>
	<link href="../boostrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	

<?php require 'admin-menu.php'; 
include('../functions.php');
$pdo = connect_to_db();
?>

<form action="custmar_all.php" method="post">
	ユーザー検索
	<input type="text" name="keyword">
	<input type="submit" value="検索">
</form>
<hr>


<!-- <?php
if (isset($_REQUEST['command'])) {
	switch ($_REQUEST['command']) {
	case 'insert':
		if (empty($_REQUEST['name']) || 
			!preg_match($_REQUEST['address'])) break;
		$sql=$pdo->prepare('insert into customer values(null,?,?,?,?)');
		$sql->execute(
			[htmlspecialchars($_REQUEST['name']), $_REQUEST['address'], $_REQUEST['login'] , $_REQUEST['password']]);
		break;
	case 'update':
		if (empty($_REQUEST['name']) || 
			!preg_match($_REQUEST['address'])) break;
		$sql=$pdo->prepare(
			'update customer set name=?, address=?, login=?, password=? where id=?');
		$sql->execute(
			[htmlspecialchars($_REQUEST['name']), $_REQUEST['price'], $_REQUEST['login'] , $_REQUEST['password'],	$_REQUEST['id']]);
		break;
	case 'delete':
		$sql=$pdo->prepare('delete from customer where id=?');
		$sql->execute([$_REQUEST['id']]);
		break;
	}
}
foreach ($pdo->query('select * from customer') as $row) {

	echo '<form class="ib" action="custmar_all.php" method="post">';
	echo '<input type="hidden" name="command" value="update">';

	echo '<table>';
	echo '<tr><th>ユーザー名</th><th>住所</th><th>login name</th><th>password</th></tr>';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<div class="td0">';

	echo $row['id'];
	echo '
	<th><input type="text" name="name" value="', $row['name'], '"></th>
	<th><input type="text" name="address" value="', $row['address'], '"></th>
	<th><input type="text" name="login" value="', $row['login'], '"></th>
	<th><input type="text" name="password" value="', $row['password'], '"></th>
	';

	echo '</div> ';
echo '</table>';
	echo '<div class="td2">';
	echo '<input type="submit" value="更新">';
	echo '</div> ';
	echo '</form> ';

	echo '<form class="ib" action="custmar_all.php" method="post">';
	echo '<input type="hidden" name="command" value="delete">';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="submit" value="削除">';
	echo '</form><br>';
	echo "\n";
}

?> -->


<?php
echo '<table class="table table-hover"><thead>';
echo '<tr><th scope="col">id</th>
<th scope="col">ユーザー名</th>
<th scope="col">住所</th>
<th scope="col">login name</th>
<th>password</th></tr></thead>';

//$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'staff', 'password');

//リクエストパラメーターに検索キーワードが含まれるときには、商品の検索を実行。
if (isset($_REQUEST['keyword'])) {
	$sql=$pdo->prepare('select * from customer where name like ?');
	$sql->execute(['%'.$_REQUEST['keyword'].'%']);
} else {
	$sql=$pdo->query('select * from customer');
}
foreach ($sql as $row) {
	$id=$row['id'];
	echo '<tbody><tr>';
	echo '<th scope="row">', $id, '</th>';
	echo '<td>', $row['name'], '</td>';
	echo '<td>', $row['address'], '</td>';
	echo '<td>', $row['login'], '</td>';
	echo '<td>', $row['password'], '</td>';
	echo '</tr><tbody>';
}
echo '</table>';
?>

</body>
</html>