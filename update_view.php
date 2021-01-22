<?php

// SESSION開始
session_start();

//関数ファイル読み込み
require_once('funcs.php');

//ログインチェック
loginCheck();

//DB接続、データ引き取り
$pdo = db_conn();
$id=$_GET['id'];

//データ取得
$stmt = $pdo->prepare("SELECT * FROM php04_needs_table WHERE id= ".$id);
$status = $stmt->execute();

//データ表示
if ($status == false) {
    sql_error($status);
} else {
    $row = $stmt->fetch(); 
}

//情報のタイプのデータ表示のための場合わけ
if($row['type']=="困りごと"){
    $type1 ="checked"; $type2=""; $type3="";
}else if($row['type']=="驚いたこと"){
    $type1 =""; $type2="checked"; $type3="";
}else {
    $type1 =""; $type2=""; $type3="checked";
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
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
  
  <h2 class="title">データ更新</h2>
  
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="update_write.php">
  <div class="jumbotron">
    <fieldset>
      <legend>入力欄</legend>
        <p>海外での気づきについて入力してください</p>
        <label>記入者名：<input type="text" name="name" value="<?= $row['name'];?>"></label><br>
        <label>国・地域名：<input type="text" name="country" value="<?php echo $row['country'];?>"></label><br>
        <label>場面：<input type="text" name="scene" value="<?php echo $row['scene']; ?>"></label><br>
        <label>情報のタイプ：
          <input type="radio" name="type" value="困りごと" <?php echo $type1; ?>>困りごと
          <input type="radio" name="type" value="驚いたこと" <?php echo $type2; ?>>驚いたこと
          <input type="radio" name="type" value="その他" <?php echo $type3; ?>>その他
        </label><br>
        <label>内容<textArea name="content" rows="4" cols="40"><?php echo $row['content'];?></textArea></label><br>
        <label>参考URL：<input type="text" name="url" value="<?php echo $row['url'];?>"></label><br>
        <input type="hidden" name="id" value="<?php echo $row['id']?>" >
        <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<div><a href="select.php">データ一覧へ</a></div>

</body>
</html>
