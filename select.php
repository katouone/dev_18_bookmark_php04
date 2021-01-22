<?php

// SESSION開始
session_start();

//関数ファイル読み込み
require_once('funcs.php');

//ログインチェック
// ログインしていない場合は、フラグとして変数$logoutに1を渡す
if(!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid']!= session_id()){
    $logout=1;
//ログインが成功している場合は、新たにセッションidを付与する
} else {
    $login=1;
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
}

// echo $logout;

//DB接続
$pdo = db_conn();

//データ取得SQL作成
$stmt = $pdo->prepare("SELECT* FROM php04_needs_table");
$status = $stmt->execute();

//データ表示
$view=[];
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error);

}else if($logout == 1){
  //logout状態の場合
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    //格納するデータを制限
    $view[] = [
      'id'=>$result['id'], 
      'name'=>'-',
      'country'=>$result['country'],
      'scene'=>'-',
      'type'=>'-',
      'content'=>'（ログイン後に表示されます）',
      'url'=>'',
      'indate'=>'',
      'lat'=>$result['lat'],
      'lng'=>$result['lng']
    ];
    // echo '<br>';
    // var_dump($view) ;
  }
}else {
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view[] = $result;
  }

} 

// var_dump($_SESSION);
// echo '<br>';
// var_dump($view);
// $view[0]['user_id'];

// 配列をJSONデータにして、JSに渡す
$json_array = json_encode($view);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>一覧表示</title>
  <!-- <link rel="stylesheet" href="css/range.css">
  <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <style>


    html, body {
            height: 100%;
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
      color: #FF9800;
      background: #fff5e5;
    }

    .table_content{
      max-width: 500px;
    }

    .result_area { 
      padding: 10px;
      font-size: 16px;
    }

    #myMap {
      height: 90%;

    }
    #maparea {
      height: 60%;
      width: 80%;
      margin: auto;
    }


  </style>

  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script defer
  src="https://maps.googleapis.com/maps/api/js?key=Your_API_key&callback=initMap&libraries=&v=weekly">
  </script>


</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <h2 class="title">データ一覧</h2>
</header>

<?php
if($logout==1){
  echo '<a href="login.php">ログイン</a>';
}else{
  echo '<a href="logout.php">ログアウト</a>';
}

?>

<!-- Head[End] -->

<!-- Main[Start] -->

<div id="maparea">
    <div id="myMap"></div>
</div>

<div class="result_area">
  <table>

  <!-- 書き方パターンその１ -->
    <!-- 表の１行目（列のタイトル） -->
    <tr>
      <th>ID</th>
      <th>投稿者</th>
      <th>国・地域名</th>
      <th>場面</th>
      <th>情報のタイプ</th>
      <th>内容</th>
      <th>参考URL</th>
      <th>投稿日時</th>
      <?php 
        //ログインされている場合はは、更新・削除のタイトルを表示する
        if ($login=='1'){
          echo '<th>更新</th>';
          echo '<th>削除</th>';
        }
      ?>
    </tr>

    <!-- 表の2行目以降 -->
    <?php 
        for( $j =0; $j< count($view); $j++){
    ?>
      <tr>
        <td><?php echo h($view[$j]['id']); ?></td>
        <td><?php echo h($view[$j]['name']); ?></td>
        <td><?php echo h($view[$j]['country']); ?></td>
        <td><?php echo h($view[$j]['scene']); ?></td>
        <td><?php echo h($view[$j]['type']); ?></td>
        <td class="table_content"><?php echo h($view[$j]['content']); ?></td>
        <td>
          <?php //URLが空欄の場合は、LINK表示をしない
            if(h($view[$j]['url']=='')){
              echo '';
            }else{
              echo '<a href='.h($view[$j]['url']).' target="_blank">Link</a>'; 
            }
          ?>
        </td>
        <td><?php echo h($view[$j]['indate']); ?></td>

        <?php 
          //管理者の場合は、更新・削除を全て表示する
          if ($login==1 && $_SESSION['kanri_flg']=='1'){
            echo '<td><a href=update_view.php?id='.h($view[$j]['id']).'>更新</a></td>';
            echo '<td><a href=delete.php?id='.h($view[$j]['id']).'>削除</a></td>';
          //編集者の場合は、自分で登録した情報に限って更新・削除を表示する
          }else if($login==1 && $_SESSION['id']==$view[$j]['user_id']){
            echo '<td><a href=update_view.php?id='.h($view[$j]['id']).'>更新</a></td>';
            echo '<td><a href=delete.php?id='.h($view[$j]['id']).'>削除</a></td>';
          }else if($login==1){
            echo '<td></td><td></td>';
          }
        ?>

      </tr>
    <?php
    }
    ?>

  <!-- 書き方パターンその２ -->
    <!-- 表の１行目（列のタイトル） -->
    <?php
    // echo'
    // <tr>
    //   <th>ID</th>
    //   <th>投稿者</th>
    //   <th>国・地域名</th>
    //   <th>場面</th>
    //   <th>情報のタイプ</th>
    //   <th>内容</th>
    //   <th>参考URL</th>
    //   <th>投稿日時</th>
    //   <th>更新</th>
    //   <th>削除</th>
    // </tr>';
    ?>

    <!-- 表の2行目以降 -->
    <?php 
    //     for( $j =0; $j< count($view); $j++){
    
    //   echo 
    //   '<tr>'
    //     .'<td>'.h($view[$j]['id']).'</td>'
    //     .'<td>'.h($view[$j]['name']).'</td>'
    //     .'<td>'.h($view[$j]['country']).'</td>'
    //     .'<td>'.h($view[$j]['scene']).'</td>'
    //     .'<td>'.h($view[$j]['type']).'</td>'
    //     .'<td class="table_content">'.h($view[$j]['content']).'</td>'
    //     .'<td>';
         
    //       if(h($view[$j]['url']=='')){
    //         echo '';
    //       }else{
    //         echo '<a href='.h($view[$j]['url']).' target="_blank">Link</a>'; 
    //       }
        
    //     echo '</td>';
    //     echo '<td>'.h($view[$j]['indate']).'</td>'
    //     .'<td><a href=update_view.php?id='.h($view[$j]['id']).'>更新</a></td>'
    //     .'<td><a href=delete.php?id='.h($view[$j]['id']).'>削除</a></td>'
    //   .'</tr>';
    // }
    ?>

  </table>
  
  <?php
  //ログイン状態の時は検索エリアとデータ登録へのリンクを出す。ログアウト時は出さない
  if($login==1){
    echo '
    <form method="post" action="search.php">
      <div class="jumbotron">
        <fieldset>
          <legend>検索</legend>
            <label>記入者名：<input type="text" name="name"></label><br>
            <label>国・地域名：<input type="text" name="country"></label><br>
            <input type="submit" value="検索">
        </fieldset>
      </div>
    </form>

    <div><a href="register.php">データ登録へ</a></div>
    ';
  }

    //管理者（flg＝1）の場合は、ユーザー一覧へのリンクを表示
  if($_SESSION['kanri_flg']== '1' ){
    echo'
    <div><a href="user_select.php">ユーザー一覧へ</a></div>
    ';
  }
  ?>

</div>



<!-- Main[End] -->

<script>
  // phpから配列を受け取る
  let js_ary = <?php echo $json_array?>


    console.log(js_ary);
    console.log(js_ary.length);
    console.log(js_ary[0]['lat']);

    // 最初の地図の中心を東京にするため、ロケーションを設定
    const Tokyo = { lat: 35.68, lng: 139.77 };

    // 地図を作成
    function initMap() {
        map = new google.maps.Map(document.getElementById("myMap"), {
            center: Tokyo,
            zoom: 2,
        });

        for(let i=0 ; i<js_ary.length;i++ ){

            let place = { lat: Number(js_ary[i]['lat'] ), lng: Number(js_ary[i]['lng'])};

            console.log(place);

            let marker = new google.maps.Marker({
                position: place,
                map,
                label: js_ary[i]['id'],
            });
        }
    }

</script>


</body>
</html>
