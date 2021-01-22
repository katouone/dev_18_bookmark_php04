<?php
// SESSION開始
session_start();

//関数ファイル読み込み
require_once('funcs.php');

//ログインチェック
loginCheck();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
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
  
  <h2 class="title">データ登録</h2>
  
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insert.php">
  <div class="jumbotron">
    <fieldset>
      <legend>入力欄</legend>
        <p>海外での気づきについて入力してください</p>
        <label>記入者名：<input type="text" name="name" value="<?= $_SESSION['name']?>"></label><br>
        <label>国・地域名：<input type="text" name="country"></label><br>
        <label>場面：<input type="text" name="scene"></label><br>
        <label>情報のタイプ：
          <input type="radio" name="type" value="困りごと">困りごと
          <input type="radio" name="type" value="驚いたこと">驚いたこと
          <input type="radio" name="type" value="その他">その他
        </label><br>
        <label>内容<textArea name="content" rows="4" cols="40"></textArea></label><br>
        <label>参考URL：<input type="text" name="url"></label><br>
        <input type="hidden" name="user_id" value="<?= $_SESSION['id']?>">
        <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<div><a href="select.php">データ一覧へ</a></div>


</body>
</html>
