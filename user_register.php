<?php

// SESSION開始
session_start();

//関数ファイル読み込み
require_once('funcs.php');

//ログインチェック・管理者フラグチェック
loginCheck_2();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録</title>
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
  
  <h2 class="title">ユーザー登録</h2>
  
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_insert.php">
  <div class="jumbotron">
    <fieldset>
      <legend>ユーザー情報登録欄</legend>
        <p>ユーザー情報を入力してください</p>
        <label>名前：<input type="text" name="name"></label><br>
        <label>ユーザーID：<input type="text" name="lid"></label><br>
        <label>パスワード：<input type="text" name="lpw"></label><br>
        <label>管理権限：
          <input type="radio" name="kanri_flg" value="0">編集者
          <input type="radio" name="kanri_flg" value="1">管理者
        </label><br>
        <label>ステータス：
          <input type="radio" name="life_flg" value="0">入社
          <input type="radio" name="life_flg" value="1">退社
        </label><br>
        <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<div><a href="user_select.php">ユーザー一覧へ</a></div>


</body>
</html>
