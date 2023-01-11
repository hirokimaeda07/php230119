<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<?php require 'admin-menu.php'; ?>

<body>

<p>商品を追加します。</p>
<form action="insert-output.php" method="post">
商品名<input type="text" name="name">
価格<input type="text" name="price">
<input type="submit" value="追加">
</form>


</body>
</html>