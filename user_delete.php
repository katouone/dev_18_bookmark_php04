<?php

// SESSION開始
session_start();

//関数ファイル読み込み
require_once('funcs.php');

//ログインチェック・管理者フラグチェック
loginCheck_2();

$pdo = db_conn();
$id=$_GET['id'];

//データSQL作成
$stmt = $pdo->prepare("DELETE FROM php04_user_table WHERE id= :id");

$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute();


//データ処理

if ($status == false) {
    sql_error($status);
} else {
    redirect('user_select.php');
}
?>