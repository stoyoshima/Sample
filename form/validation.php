<?php function validation($request){
    $errors = [];

    if(empty($request['your_name']) || 20 < mb_strlen($request['your_name'])){
        $errors[] = '氏名は必須です。20文字以内で入力してください。';
    } 

    if(empty($request['tel']) || !preg_match('/^[0-9]{3}-[0-9]{4}-[0-9]{4}$|^[0-9]{11}$/', $request['tel'])){
        $errors[] = '携帯電話番号は必須です。半角数字かつハイフン無しで入力してください。';
    }

    if(empty($request['day'])){
        $errors[] = '日付を選択してください。';
    }

    if(empty($request['time'])){
        $errors[] = '見学希望時間を選択してください。';
    }

    return $errors;
};
?>