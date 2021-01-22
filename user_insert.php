<?php

require_once('funcs.php');


//1. POSTデータ取得
$name = $_POST['name'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];
$life_flg = $_POST['life_flg'];

//2. DB接続します

$pdo = db_conn();

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO php04_user_table(id, name, lid, lpw, kanri_flg, life_flg)VALUES(NULL, :name, :lid, :lpw, :kanri_flg, :life_flg)");

//  2. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);  

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後

if($status==false){
  //*エラー処理
  sql_error($stmt);
}else{
  //**リダイレクト
  redirect('user_register.php');
}


?>