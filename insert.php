<?php

require_once('funcs.php');


//POSTデータ取得
$name = $_POST['name'];
$country = $_POST['country'];
$scene = $_POST['scene'];
$type = $_POST['type'];
$content = $_POST['content'];
$url = $_POST['url'];
$user_id = $_POST['user_id'];


//以下は出典元のページを引用してGeocordingを実施（https://www.mkbtm.jp/?p=1436）
//ーーーーーーーーーーーーーここからーーーーーーーーーーーーーーーーー

//住所を入れて緯度経度を求める。国・地域名をエンコード。
$myKey = "Your_API_key";
$address = urlencode($country);

$mapurl = "https://maps.googleapis.com/maps/api/geocode/json?&address=" . $address . "+CA&key=" . $myKey ;

$contents= file_get_contents($mapurl);
$jsonData = json_decode($contents,true);

// echo $jsonData[0];
// var_dump ($jsonData);

$lat = $jsonData["results"][0]["geometry"]["location"]["lat"];
$lng = $jsonData["results"][0]["geometry"]["location"]["lng"];

// print("lat=$lat\n");
// print("lng=$lng\n");


//ーーーーーーーーーーーーーここまでーーーーーーーーーーーーーーーーー



//DB接続
$pdo = db_conn();

//データ登録SQL作成
// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO php04_needs_table(id, name, country, scene, type, content, url, indate, lat, lng, user_id)VALUES(NULL, :name, :country, :scene, :type, :content, :url, sysdate(), :lat, :lng, :user_id)");

//  2. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':country', $country, PDO::PARAM_STR);
$stmt->bindValue(':scene', $scene, PDO::PARAM_STR);
$stmt->bindValue(':type', $type, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lat', $lat, PDO::PARAM_STR); 
$stmt->bindValue(':lng', $lng, PDO::PARAM_STR); 
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT); 

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
