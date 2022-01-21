
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

$sid=session_id();
$id=$_POST["id"];
$qty=$_POST["qty"];

if(!($qty>0)){
    $qty=1;
}

$cartSql="SELECT COUNT(*) AS cnt FROM food_cart WHERE session_id=? AND id=?";

$stmt = $pdo->prepare($cartSql);
$stmt->execute(array($sid,$id));
$array = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($array[0]["cnt"]>=1){
    $usql = "UPDATE food_cart SET qty=? WHERE session_id=? AND id=?";

    $stmt = $pdo->prepare($usql);
    $stmt->execute(array($qty,$sid,$id));
    
    header('Location:food_cart.php');
    exit();
}else{
    $sql = "INSERT INTO food_cart(session_id,id,qty) VALUES(?,?,?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($sid,$id,$qty));
    
    header('Location:food_cart.php');
}
header('Location:food_cart.php');

?>


