<!-- 会員登録、登録内容修正後の画面 -->

<?php session_start(); ?>
<?php require 'menu.php';
//DB接続
include('../functions.php');
$pdo = connect_to_db();
?>

<?php
//データベースへ接続 ⇒　5行目でDB接続
//$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8','staff', 'password');

if (isset($_SESSION['customer'])) {
	$id=$_SESSION['customer']['id'];
	//login名の重複チェック。ログインしている場合、selecto * ‥で、idが等しくなく、loginが等しいかを探す。
	$sql=$pdo->prepare('select * from customer where id!=? and login=?');
	$sql->execute([$id, $_REQUEST['login']]);
} else {
	//ログインしていない場合、同じlogoin名を使っているか確認。
	$sql=$pdo->prepare('select * from customer where login=?');
	$sql->execute([$_REQUEST['login']]);
}

//上記、重複確認でいずれの場合も検索結果が空なら、下記の処理を行う。
//fetchAll()で、検索結果を配列で返す。検索結果が空なら、空で配列を返す。
if (empty($sql->fetchAll())) {
	//ログインしていた場合
	//更新を行い、ログインしていない場合には、登録。
	if (isset($_SESSION['customer'])) {
		//ログインしている場合、データベースを更新。
		$sql=$pdo->prepare('update customer set name=?, address=?, '.
			'login=?, password=? where id=?');
		
		//上記?に、顧客名、住所、ログイン名、パスワードを指定して、sqlを実行。
		$sql->execute([
			$_REQUEST['name'], $_REQUEST['address'], 
			$_REQUEST['login'], $_REQUEST['password'], $id]);

		//データベース更新終わったら、セッションデータも最新の情報に更新
		$_SESSION['customer']=[
			'id'=>$id, 'name'=>$_REQUEST['name'], 
			'address'=>$_REQUEST['address'], 'login'=>$_REQUEST['login'], 
			'password'=>$_REQUEST['password']];
		echo 'お客様情報を更新しました。';
	} else {
		//ログインしていない場合
		//データベースに情報を登録する。
		$sql=$pdo->prepare('insert into customer values(null,?,?,?,?)');
		
		//上記?に、顧客名、住所、ログイン名、パスワードを指定して、sqlを実行。
		$sql->execute([
			$_REQUEST['name'], $_REQUEST['address'], 
			$_REQUEST['login'], $_REQUEST['password']]);
		echo 'お客様情報を登録しました。';
	}
} else {
	echo 'ログイン名がすでに使用されていますので、変更してください。';
}
?>
