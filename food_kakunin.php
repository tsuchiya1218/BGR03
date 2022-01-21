
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
session_start();

$sql="SELECT postal,address,tel FROM login_user WHERE name='yanagi'";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$array = $stmt->fetchAll();
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
    <p>配送先選択</p>
    <form method="POST" action="food_payment.php">
    <p><input type="radio" name="delivery" value="home" checked>ユーザの住所に配送</p>
    <input type="hidden" name="homepostal" value="<?=$array[0]['postal']?>">
    <input type="hidden" name="homeaddress" value="<?=$array[0]['address']?>">
    <input type="hidden" name="hometel" value="<?=$array[0]['tel']?>">
    <p>郵便番号：<?=$array[0]['postal']?></p>
    <p>住所：<?=$array[0]['address']?></p>
    <p>電話番号：<?=$array[0]['tel']?></p>
    <p><input type="radio" name="delivery" value="other" checked>配送先を新たに指定</p>
    <p>郵便番号：<input type="number" name="postal" size="10"> <small>※ハイフンなし</p>
    <p>住所：<input type="text" name="address" size="40"></p>
    <p>氏名：<input type="text" name="name" size="20"></p>
    <p>電話番号：<input type="number" name="tel" size="20"> <small>※ハイフンなし</p>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="次へ">
</body>

</html>

</html>