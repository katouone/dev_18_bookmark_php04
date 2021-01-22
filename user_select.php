<?php

// SESSION開始
session_start();

//関数ファイル読み込み
require_once('funcs.php');

//ログインチェック・管理者フラグチェック
loginCheck_2();

//1.  DB接続します
$pdo = db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT* FROM php04_user_table");
$status = $stmt->execute();

//３．データ表示
$view2=[];
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view2[] = $result;
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ユーザー一覧表示</title>
<!-- <link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet"> -->
<style>
div { 
  padding: 10px;
  font-size: 16px;
}

table{
  text-align: center;
  border-collapse:  collapse;
  margin: auto;
}

th,td{
  border: solid 1px black;
  padding: 10px;
}

table th {
  color: #0066ff;
  background: #99ccff;
}

.table_content{
  max-width: 500px;
}

</style>

</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <h2 class="title">ユーザー一覧</h2>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

<table>
  <!-- 表の１行目（列のタイトル） -->
  <tr>
    <th>ID</th>
    <th>ユーザー名</th>
    <th>ユーザーID</th>
    <th>パスワード</th>
    <th>管理権限</th>
    <th>ステータス</th>
    <th>更新</th>
    <th>削除</th>
  </tr>

  <!-- 表の2行目以降 -->
  <?php 
      for( $j =0; $j< count($view2); $j++){
  ?>
    <tr>
      <td><?php echo h($view2[$j]['id']); ?></td>
      <td><?php echo h($view2[$j]['name']); ?></td>
      <td><?php echo h($view2[$j]['lid']); ?></td>
      <td><?php echo h($view2[$j]['lpw']); ?></td>
      <td>
        <?php 
            if(h($view2[$j]['kanri_flg']==1)){
              echo '管理者';
            }else {
              echo '編集者';
            }
        ?>
      </td>
      <td>
        <?php 
            if(h($view2[$j]['life_flg']=='0')){
              echo '入社';
            }else{
              echo '退社'; 
            }
        ?>
      </td>
      <td><?php echo '<a href=user_update_view.php?id='.h($view2[$j]['id']).'>更新</a>'; ?></td>
      <td><?php echo '<a href=user_delete.php?id='.h($view2[$j]['id']).'>削除</a>'; ?></td>
    </tr>
  <?php
  }
  ?>
</table>


<form method="post" action="user_search.php">
  <div class="jumbotron">
    <fieldset>
      <legend>検索</legend>
        <label>ユーザー名：<input type="text" name="name"></label><br>
        <label>ユーザーID：<input type="text" name="lid"></label><br>
        <input type="submit" value="検索">
    </fieldset>
  </div>
</form>

<div><a href="user_register.php">ユーザー登録へ</a></div>

<div><a href="select.php">データ一覧へ</a></div>

<!-- Main[End] -->
</body>
</html>