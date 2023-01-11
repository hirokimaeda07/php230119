<!-- ログイン画面 -->

<!-- require　で外部のphpファイルを読込み -->
<?php require 'menu.php'; ?>

<form action="login-output.php" method="post">
  ログイン名<input type="text" name="login"><br>
  パスワード<input type="password" name="password"><br>
<input type="submit" value="ログイン">
</form>

