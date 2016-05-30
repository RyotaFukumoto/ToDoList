<?php

$errors = array();

if(isset($_POST['submit'])){

    $memo = $_POST['memo'];


    $memo = htmlspecialchars($memo, ENT_QUOTES);

    if(count($errors) === 0){

        $dsn = 'mysql:dbname=todoDB;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';

        $dbh = new PDO($dsn, $user, $password);
        $dbh->query('SET NAMES utf8');
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $sql = 'INSERT INTO ToDoList ( memo) VALUES ( ?, 0)';
        $stmt = $dbh->prepare($sql);


        $stmt->bindValue(1, $memo, PDO::PARAM_STR);

        $stmt->execute();

        $dbh = null;

        unset($memo);
    }
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
  <form action="" method="post">
  <input type="text"id="memo" name="memo" value="" />
</div>
  <input type="submit" value="送信" />
</form>
<HR>


</body>
</html>
