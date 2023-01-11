<!-- 会員登録の画面 -->
<!-- 既に会員登録されていた場合、登録情報が表示され、修正が可能となる -->

<?php session_start(); ?>
<?php require 'menu.php'; ?>

<?php
//顧客名、住所、ログイン名、パスワードを保存する変数で、空の文字列を代入
$name=$address=$login=$password='';

//セッションデータに、顧客情報が登録されてるか確認（重複チェック）
if (isset($_SESSION['customer'])) {
	$name=$_SESSION['customer']['name'];
	$address=$_SESSION['customer']['address'];
	$login=$_SESSION['customer']['login'];
	$password=$_SESSION['customer']['password'];
}

//inputタグを生成
echo '<p>新規登録の方は、必要情報を入力してください。</p>';
echo '<p>登録済みの方は、修正したい項目があれば訂正してください。</p>';
echo '<form action="customer-output.php" method="post">';
echo '<table>';
echo '<tr><td>お名前</td><td>';
echo '<input type="text" name="name" value="', $name, '">';
echo '</td></tr>';
echo '<tr><td>ご住所</td><td>';
echo '<input type="text" name="address" value="', $address, '">';
echo '</td></tr>';
echo '<tr><td>ログイン名</td><td>';
echo '<input type="text" name="login" value="', $login, '">';
echo '</td></tr>';
echo '<tr><td>パスワード</td><td>';
echo '<input type="password" name="password" value="', $password, '">';
echo '</td></tr>';
echo '</table>';
echo '<input type="submit" value="確定">';
echo '</form>';
?>
