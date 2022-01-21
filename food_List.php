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
$category_id = $_GET["category_id"];

$sql = "SELECT id,name,address,price,food_id,description,img from food where food_id =?";
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($category_id));
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
    <p>Dog Foodの一覧</p>
    <table border="0">
        <tr>
            <th>Food ID</th>
            <th>Food 名</th>
            <th>price</th>
            <th>    </th>
        </tr>
        <?php

            foreach ($array as $value) {
                echo "<tr>\n";
                echo " <td>" . "<img src=\"./img/".$value['img'].".jpg\" style=\"width: 60px;height:100px\" alt=\"logo\">". "</td>\n";
                echo " <td>" . $value["id"] . "</td>\n";
                echo " <td>" . $value["name"] . "</td>\n";
                echo " <td>" . $value["price"] . "円"."</td>\n";
                echo "<td><input type=\"button\" onClick=\"document.location='food_detail.php?id={$value["id"]}'\" value=\"詳細\"></td>\n";
                echo "</tr>\n";
            }
        ?>
        
    </table>
    <br><input type="button" onclick="location.href='./food_first.php'" value="戻る">
</body>

</html>
