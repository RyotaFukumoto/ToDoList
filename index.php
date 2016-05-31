<?php
  try{
    $dsn = 'mysql:dbname=todoDB;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
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
    header( "Location: http://localhost/ToDoList/" );
  }else if(isset($_GET['delete'])){
    $num = $_GET['delete'];
    $sql = 'DELETE FROM ToDoList WHERE id = :num';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':num',$num,PDO::PARAM_INT);
    $stmt->execute();
    $dbh = null;
    header( "Location: http://localhost/ToDoList/" );
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
      <form action="http://localhost/ToDoList" method="GET">
        <input type="text"id="memo" name="memo" value="" />
        <input type="submit" name="add" id="add" value="追加" />
      </form>
    </div>
    <hr>
    <?php
      try{
      $dsn = 'mysql:dbname=todoDB;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn, $user, $password);
      $dbh->query('SET NAMES utf8');
      $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      }catch(PDOException $e){
        die('エラー');
      }
      $sql = 'SELECT id, text FROM ToDoList;';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      echo "<ul>";
      while($task = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<li><div class='container'>";
        echo "<form method='get' action='index.php'>".$task['text']."  ";
        echo "<button type='submit' name='delete' value='".$task['id']."'></button>";
        echo "</form></div></li>";
      }
      echo "</ul>";
    ?>
  </body>
</html>
