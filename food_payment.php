<?php
session_cache_limiter('none');
session_start();
$del_type=$_POST["delivery"];
if($del_type=="home"){
    $_SESSION["postal"]=$_POST["homepostal"];
    $_SESSION["address"]=$_POST["homeaddress"];
    $_SESSION["tel"]=$_POST["hometel"];
}else{
    $_SESSION["postal"]=$_POST["postal"];
    $_SESSION["address"]=$_POST["address"];
    $_SESSION["tel"]=$_POST["tel"];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>支払方法選択</title>
    <link href="./css/common.css" rel="stylesheet" type="text/css">
    <link href="./css/contact.css" rel="stylesheet" type="text/css">
</head>
<body>
    <p>支払方法選択</p>
    <form method="POST" action="food_kakunin1.php">
    <p><input type="radio" name="delivery" value="bank" checked>銀行振り込み</P>
    <p><input type="radio" name="delivery" value="credit">クレジットカード支払い</P>
    <p>カード番号<input type="number" name="cardnum"><small>ハイフンなし</small></P>
    <p>有効期限<input type="number" name="limitdate"><small>月2桁西暦下2桁で入力</small></P>
    <p>カード名義<input type="text" name="name" size="20"></P>

    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="選択">
    </form>
</body>
</html>