<?php

const DB_HOST = 'mysql:dbname=contact_php;host=127.0.0.1;charset=utf8';
// const DB_USER = 'root';
// const DB_PASSWORD = "";
const DB_USER = 'taishidou';
const DB_PASSWORD = 'password123';


try{
    $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD,[
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    // echo '接続成功';

} catch(PDOException $e){
    echo '見学予約が正常にできませんでした。<br>
          再度、ご予約をお願いいたします。' . $e->getMessage() . "\n";
    exit();
}



?>