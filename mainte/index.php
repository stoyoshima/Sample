<?php

require 'db_connection.php';

//ユーザー入力あり、SQLインジェクション対策
$sql = 'select * from contacts where id= :id';
$stmt = $pdo -> prepare($sql);
$stmt -> bindValue('id', 2, PDO::PARAM_INT);
$stmt -> execute();

$result = $stmt -> fetchall();

echo "\n";
var_dump($result);

//トランザクション　どこか1つの処理で上手くいかなかったら最初に戻る
$pdo -> beginTransaction();

try{
    $stmt = $pdo -> prepare($sql);
    $stmt -> bindValue('id', 2, PDO::PARAM_INT);
    $stmt -> execute();

    $pdo -> commit();
}catch(PDOException $e){
    $pdo -> rollback();
}

?>

