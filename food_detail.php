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
$id = $_GET["id"];

$sql = "SELECT id,name,address,price,food_id,description from food where id =?";
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($id));
    $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;
    $pdo = null;
} catch (PDOException $e) {
    print ":" . $e->getMessage();
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>はにゃ・ドッグフードショップ</title>
    <link href="./css/common.css" rel="stylesheet" type="text/css">
    <link href="./css/contact.css" rel="stylesheet" type="text/css">
</head>

<body>
    <p>Foodの詳細</p>

    <table border="0">
        <tr align="left">
            <th>Food ID</th>
            <?php
            foreach ($array as $value) {
                echo " <td>" . $value["id"] . "</td>\n";
            }
            ?>
        </tr>
        <tr align="left">
            <th>Food 名</th>
            <?php
            foreach ($array as $value) {
                echo " <td>" . $value["name"] . "</td>\n";
            }
            ?>
        </tr>
        <tr align="left">
            <th>address</th>
            <?php
            foreach ($array as $value) {
                echo " <td>" . $value["address"] . "</td>\n";
            }
            ?>
        </tr>
        <tr align="left">
            <th>価格</th>
            <?php
            foreach ($array as $value) {
                echo " <td>" . $value["price"] . "</td>\n";
            }
            ?>
        </tr>
        <tr align="left">
            <th>種類</th>
            <?php
            foreach ($array as $value) {
                echo " <td>" . $value["food_id"] . "</td>\n";
            }
            ?>
        </tr>
        <tr align="left">
            <th>詳細</th>
            <?php
            foreach ($array as $value) {
                echo " <td>" . $value["description"] . "</td>\n";
            }
            ?>
        </tr>
    </table></br>
    <form method="POST" action="food_cart_add.php">
        <input type="hidden" name="id" value="<?= $value["food_id"] ?>">
        個数:<input type="number" name="qty" size="25" required />
        <input type="submit" value="カートに入れる">
    </form></br>
    <input type="button" onclick="location.href='food_category.php'" value="戻る">
</body>

</html>