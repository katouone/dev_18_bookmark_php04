<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
    <title>ログイン</title>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <h2 class="title">ログイン画面</h2>
    </header>
    <!-- Head[End] -->


    <form name="form1" action="login_act.php" method="post">
        <p>ID:<input type="text" name="lid" /></p> 
        <p>PW:<input type="password" name="lpw" /></p> 
        <input type="submit" value="LOGIN" />
    </form>

    <div><a href="select.php">データ一覧へ</a></div>

</body>

</html>