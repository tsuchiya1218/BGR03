<?php
//データベースに接続する
try {
    $server_name = "10.42.129.3";    // サーバ名
    $db_name = "20jy0142";    // データベース名(自分の学籍番号を入力)

    $user_name = "20jy0142";    // ユーザ名(自分の学籍番号を入力)
    $user_pass = "20jy0142";    // パスワード(自分の学籍番号を入力)

    // データソース名設定
    $dsn = "sqlsrv:server=$server_name;database=$db_name";

    // PDOオブジェクトのインスタンス作成
    $pdo = new PDO($dsn, $user_name, $user_pass);

    // PDOオブジェクトの属性の指定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "接続エラー!: " . $e->getMessage();
    exit();
}
$sql = "SELECT food_id,food_name from dog_food";
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;
    $pdo = null;
} catch (PDOException $e) {
    print ":" . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>はにゃ・ドッグフードショップ</title>
    <link href="./css/common.css" rel="stylesheet" type="text/css">
    <link href="./css/contact.css" rel="stylesheet" type="text/css">
   
</head>

<body>
        <div class="header">
            <div class="logo">
                <link rel="stylesheet" type="text/css" href="./css/header.css" />
                <h1>はにゃ・ドッグフードショップ</h1>
               <!-- <a href=""></a><img src="./img/header dog.jpg" style="width: 1200px;height:250px" alt="logo" class="logoimg">-->
            </div>
           
            <nav>
                <ul>
                    <?php
                    foreach ($array as $value) {
                        echo "<tr>\n";
                        echo " <td>" . "<a href='food_List.php?category_id=" . $value["food_id"] . "'>" . $value["food_name"] . "</a>" . "</td>\n";
                        echo "</tr>\n";
                    }
                    ?>
                    <a id="card" href="food_cart.php">カード</a> 
                </ul>
                <!--<form method="get" action="#" class="search_container">
				<input type="text" size="50" placeholder="　キーワード検索">
				<input type="submit" value="検索">
			  </form>-->
                <body>
                    <div id="particle-canvas"></div>
                </body>
            </nav>
            <div class="menu-photo">
                <p>スタッフおすすめ</p>
                <img src="./img/1.jpg" alt="maguro" width="250">
                <img src="./img/2.jpg" alt="maguro" width="250">
                <img src="./img/3.jpg" alt="maguro" width="250">
                <img src="./img/4.jpg" alt="maguro" width="250">

            </div>
    <footer class="footer-content">

        <p><small>&copy;Copyright © THANKS LEE TAKAHASI ZHENG YAO.</small>
        <p>
    </footer>
</body>

</html>