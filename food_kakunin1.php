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
$sid = session_id();
$sql = "SELECT food.food_id, name,price,qty,qty*price as total
      FROM food_cart inner join food ON food_cart.id =food.id
      WHERE session_id=?";

$stmt = $pdo->prepare($sql);
$stmt->execute(array($sid));
$array = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <title>ご注文内容の確認</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>はにゃ・ドッグフードショップ</title>
    <link href="./css/common.css" rel="stylesheet" type="text/css">
    <link href="./css/contact.css" rel="stylesheet" type="text/css">
</head>

<body>
    <a href="book_category.php">TOP</a>
    <p>ご注文内容の確認</p>
    <p>・オーダー</p>
    <table>
        <tr>
            <th>商品名</th>
            <th>単価</th>
            <th>個数</th>
            <th>金額</th>
            <th>&nbsp;</th>
        </tr>
        <?php
        $total_price = 0;

        foreach($array as $row){
            echo"<tr>";
            echo"<td>{$row['name']}</td>\n";
            echo"<td>{$row['price']}</td>\n";
            echo"<td>{$row['qty']}</td>\n";
            echo"<td>{$row['total']}円</td>\n";
            echo "<td><input type=\"button\" onClick=\"document.location='food_cart_delete.php?food_id={$row["food_id"]}'\" value=\"消除\"></td>\n";
            echo "</tr>\n";
            // $total_price+=$total;
            $total_price +=$row["total"];
        }
        ?>

    </table>
    <?php
    // echo "<p>合計金額：&yen;" . $total_price. "</p>";
    echo"<p>合計金額：&yen;".number_format($total_price)."</p>";
    ?>
   <p>・配送先</P>
    <p>郵便番号：<?=$_SESSION["postal"]?></P>
    <p>住所：<?=$_SESSION["address"]?></P>
    <p>電話番号：<?=$_SESSION["tel"]?></P>
    <p>・支払方法</P>
    <p>
    <?php
    if($_POST["delivery"]=='bank'){
        echo'<p>銀行振り込み</p>';
    }else if($_POST["delivery"]=='credit'){
        echo'<p>クレジットカード支払い</p>';
    }
    ?></p>
    <form method="POST" action="food_order_add.php">
    <input type="button" onclick="history.back()" value="修正">
    <input type="submit" value="注文確定">
    </form>
  <!-- <input type="button" onclick="location.href='./food_kakunin2.php'" value="注文確認">
    <input type="button" onclick="location.href='food_first.php'" value="戻る">   -->

</body>

</html>