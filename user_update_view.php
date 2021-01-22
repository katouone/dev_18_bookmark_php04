<?php

// SESSION開始
session_start();

//関数ファイル読み込み
require_once('funcs.php');

//ログインチェック・管理者フラグチェック
loginCheck_2();

$pdo = db_conn();
$id=$_GET['id'];

//データ取得
$stmt = $pdo->prepare("SELECT * FROM php04_user_table WHERE id= ".$id);
$status = $stmt->execute();

//データ表示
if ($status == false) {
    sql_error($status);
} else {
    $row = $stmt->fetch(); 
}

//データ表示のための場合わけ
//編集者＝’0’、管理者＝’1’
if($row['kanri_flg']=="1"){
  $kanri0 =""; $kanri1="checked"; 
}else{
  $kanri0 ="checked"; $kanri1=""; 
}

//データ表示のための場合わけ
if($row['life_flg']=="0"){
    $life0 ="checked"; $life1=""; 
}else {
    $life0 =""; $life1="checked"; 
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー情報更新</title>
  <style>
  div{
    padding: 10px;
    font-size:16px;
    }
  </style>
</head>
<body>

<!-- Head[Start] -->
<header>
  
  <h2 class="title">ユーザー情報更新</h2>
  
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_update_write.php">
  <div class="jumbotron">
    <fieldset>
      <legend>ユーザー情報登録欄</legend>
        <p>ユーザー情報を入力してください</p>
        <label>名前：<input type="text" name="name" value="<?= $row['name']?>"></label><br>
        <label>ユーザーID：<input type="text" name="lid" value="<?= $row['lid']?>"></label><br>
        <label>パスワード：<input type="text" name="lpw" value="<?= $row['lpw']?>"></label><br>
        <label>管理権限：
          <input type="radio" name="kanri_flg" value="0" <?php echo $kanri0; ?>>編集者
          <input type="radio" name="kanri_flg" value="1" <?php echo $kanri1; ?>>管理者
        </label><br>
        <label>ステータス：
          <input type="radio" name="life_flg" value="0" <?php echo $life0; ?>>入社
          <input type="radio" name="life_flg" value="1" <?php echo $life1; ?>>退社
        </label><br>
        <input type="hidden" name="id" value="<?= $row['id']?>">
        <input type="submit" value="送信">
    </fieldset>
  </div>
</form>


<!-- Main[End] -->

<div><a href="user_select.php">ユーザー一覧へ</a></div>

</body>
</html>
