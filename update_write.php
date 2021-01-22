<?php

require_once('funcs.php');


//1. POSTデータ取得
$name = $_POST['name'];
$country = $_POST['country'];
$scene = $_POST['scene'];
$type = $_POST['type'];
$content = $_POST['content'];
$url = $_POST['url'];
$id = $_POST['id'];

//2. DB接続します

$pdo = db_conn();

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare("UPDATE php04_needs_table SET
    name = :name,
    country = :country,
    scene = :scene,
    type = :type,
    content = :content,
    url = :url,
    indate = sysdate()
WHERE id = :id;
");

//  2. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':country', $country, PDO::PARAM_STR);
$stmt->bindValue(':scene', $scene, PDO::PARAM_STR);
$stmt->bindValue(':type', $type, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後

if($status==false){
    //*エラー処理
    sql_error($stmt);
}else{
    //**リダイレクト
    redirect('select.php');
}

?>