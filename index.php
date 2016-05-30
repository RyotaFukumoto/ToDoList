<?php
try{
  $dsn = 'mysql:dbname=todoDB;host=localhost;charset=utf8';
  $user = 'root';
  $password = '';

  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  print('接続できてる');
  $db = NULL;
}catch(PDOException $e){
  die('エラー');
}

if(isset($_GET['add'])){
  $text = $_GET['memo'];
  $text = htmlspecialchars($text, ENT_QUOTES);
  $sql = 'INSERT INTO ToDoList (text) VALUE(:text)';
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':text', $text, PDO::PARAM_STR);
  $stmt->execute();

  $dbh = null;

  unset($text);
}else if(isset($_GET['delete'])){

}
?>


<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>PHPサンプル</title>
</head>
<body>
  <div class="container">
    <form action="" method="GET">
    <input type="text"id="memo" name="memo" value="" />
    <input type="submit" name="add" id="add" value="追加" />
  </div>
</form>
<HR>


</body>
</html>
