<?php

require_once('funcs.php');


//1. POSTデータ取得
$name = $_POST['name'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];
$life_flg = $_POST['life_flg'];
$id = $_POST['id'];

// echo $id;
// echo '<br>';
// echo $name;
// echo '<br>';
// echo $lid;
// echo '<br>';
// echo $kanri_flg;
// echo '<br>';
// echo $life_flg;
// echo '<br>';

//2. DB接続します

$pdo = db_conn();

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare("UPDATE php04_user_table SET
    name = :name,
    lid = :lid,
    lpw = :lpw,
    kanri_flg = :kanri_flg,
    life_flg = :life_flg 
WHERE id = :id;
");
// WHEREの前にコンマが入っていたのでエラーが出続ける結果に。。。それを見つけるのに苦労しました。。。。。

//  2. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);  
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後

if($status==false){
    //*エラー処理
    sql_error($stmt);
}else{
    //**リダイレクト
    redirect('user_select.php');
}

?>