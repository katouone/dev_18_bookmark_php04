<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn() 

function db_conn(){
    try {
        $db_name = "php04_kadai";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "root";      //パスワード
        $db_host = "localhost"; //DBホスト
        $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}


//SQLエラー関数：sql_error($stmt)

function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: ". $file_name);
    exit();
}

//ログインチェック

function loginCheck(){
    if(!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid']!= session_id()){
        exit('LOGIN ERROR!');
    } else {
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}

//ログインチェック(パターン２)：管理フラグが１かどうかを判定するところまで含めたチェック

function loginCheck_2(){
    if(!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid']!= session_id()){
        exit('LOGIN ERROR!');
    } else if($_SESSION['kanri_flg']!=='1'){
        var_dump($_SESSION);
        echo '<br>';
        exit('編集権限がありません');
    }else{
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}