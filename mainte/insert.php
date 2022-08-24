<?php

function insertContact($request) {

    require 'db_connection.php';

    $params = [
        'id' => null,
        'your_name' => $request['your_name'],
        'tel' => $request['tel'],
        'day' => $request['day'],
        'time' => $request['time'],
        'ages' => $request['ages'],
        'contact'=> $request['contact'],
        'created_at' => null
    ];

    // var_dump($params);

    $count = 0;
    $columns = '';
    $values = '';

    foreach(array_keys($params) as $key){
        if($count++>0){
            $columns .= ',';
            $values .= ',';
        }

        $columns .= $key;
        $values .= ':'. $key;
    }
 
    $sql = 'insert into contactss('.$columns.')values('.$values.')';
 
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute($params);
 
}

?>


