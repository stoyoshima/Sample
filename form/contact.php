<?php 

//バリデーション(検証)
require 'validation.php';

//csrf攻撃
session_start();

//クリックジャッキング攻撃
header('X-FRAME-OPTISON:DENY');

//XSS攻撃
function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$pageFlag = 0;
//バリデーション(エラー表示)
$errors = validation($_POST);

if(!empty($_POST['btn_confirm']) && empty($errors)){
    $pageFlag = 1;
}

if(!empty($_POST['btn_submit'])){
    $pageFlag = 2;
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../form/contact.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yomogi&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<header class="header1">
    <div class="header">
        <div class="header-title">
            <h1 class="h1">
                <span style="color: rgb(255 150 152 / 64%)">太</span>
                <span style="color: #fff271">子</span>
                <span style="color: #bae9eb">堂</span>
                <span style="color: rgb(255 150 152 / 64%)">保</span>
                <span style="color: #bae9eb">育</span>
                <span style="color: #fff271">園</span>
            </h1>
            <a href="" class="saiyou">◂採用情報</a>
        </div>
        <div class="header-list">
            <ul class="header-list01">
                <a href="index.html"><li><img src="../images/icons8-ばら-40.png" alt="">保育園紹介</li></a>
                <a href="time schedule.html"><li><img src="../images/icons8-ナッツ-40.png" alt="">保育園の一日</li></a>
                <a href="gyouji.html"><li><img src="../images/icons8-チェリー-40.png" alt="">年間行事</li></a>
                <a href="http://localhost/Sample/form/contact.php"><li><img src="../images/icons8-オークリーフ-40.png" alt="">保育園見学</li></a>
            </ul>
        </div>
    </div>
</header>

    <div class="main-title-g">
        <h1>保育園見学申し込み</h1>
    </div>




<!-- 入力画面 -->
<?php if($pageFlag === 0) : ?>
    <!-- csrf攻撃 合言葉作り-->
    <?php if(!isset($_SESSION['csrfToken'])){
        $csrfToken = bin2hex(random_bytes(32));
        $_SESSION['csrfToken'] = $csrfToken;
    }
    $token = $_SESSION['csrfToken'];
    ?>
    <!-- エラー表示 -->
    <?php if(!empty($errors) && !empty($_POST['btn_confirm'])) : ?>
        <?php echo '<ul>' ;?>
            <?php foreach($errors as $error){
                echo '<li>' . $error . '</li>';
            }?>
        <?php echo '</ul>' ;?>
    <?php endif; ?>

    <form method="POST" action="contact.php" class="form-box">
        <div class="fm-box">
            <div class="fm01">
                <div class="name1">          
                    <div class="deta">
                        <span class="his">必須</span>お名前
                    </div>
                    <div class="input_box">
                        <input class="input" type="text" name="your_name" placeholder="太子堂はなこ" value="<?php if(isset($_POST['your_name'])){echo h($_POST['your_name']);} ?>">
                    </div>
                </div>
            </div>
            <div class="fm02">
                <div class="name1">
                    <div class="deta">
                        <span class="his">必須</span>電話番号
                    </div>
                    <div class="input_box">
                        <input class="input" type="text" name="tel" placeholder="08043215678" value="<?php if(isset($_POST['tel'])){echo h($_POST['tel']);} ?>">
                    </div>
                </div>
            </div>
            <div class="fm02">
                <div class="name1">
                    <div class="deta">
                        <span class="his">必須</span>見学希望日時
                    </div>
                    <div class="input_box">
                        <input class="input" type="date" name="day" value="2022-08-10"<?php if(isset($_POST['day'])){echo h($_POST['day']);} ?>>
                        <select class="input" name="time">
                            <option value="">選択してください</option>
                            <option value="10:00~11:00" 
                                <?php if(isset($_POST['time']) && $_POST['time'] === '10:00~11:00' ){ echo 'selected'; } ?>>10:00~11:00</option>
                            <option value="15:00~16:00" 
                                <?php if(isset($_POST['time']) && $_POST['time'] === '15:00~16:00'){echo 'selected';}?>>15:00~16:00</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="fm02">
                <div class="name1">
                    <div class="deta">
                        <span class="his">必須</span>お子様年齢
                    </div>
                    <div class="input_box">
                        <label>
                            <input type="checkbox" name="ages[]" value="1歳">1歳
                        </label>
                        <label>
                            <input type="checkbox" name="ages[]" value="0歳">0歳
                        </label>
                        <label>
                            <input type="checkbox" name="ages[]" value="2歳">2歳
                        </label>
                        <label>
                            <input type="checkbox" name="ages[]" value="3歳">3歳
                        </label>
                        <label>
                            <input type="checkbox" name="ages[]" value="4歳">4歳
                        </label>
                        <label>
                            <input type="checkbox" name="ages[]" value="5歳">5歳
                        </label>
                        <label>
                            <input type="checkbox" name="ages[]" value="妊娠中">妊娠中
                        </label>
                        <label>
                            <input type="checkbox" name="ages[]" value="その他">その他
                            <p>※現在、妊娠中または見学のみの方はその他を選択してください</p>
                        </label>
                    </div>
                </div>
            </div>
            <div class="fm03">
                <div class="name1">
                    <div class="deta">
                        <span class="hisx">任意</span>ご相談
                    </div>
                    <div class="input_box">
                        <textarea name="contact" id="" cols="30" rows="3" ><?php if(isset($_POST['contact'])){echo h($_POST['contact']);} ?></textarea>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <input type="submit" name="btn_confirm" value="確認する" class="botton-k">
                <input type="hidden" name="csrf" value="<?php echo $token?>">
            </div>
        </div>
    </form>
<?php endif ; ?>


<!-- 確認画面 -->
<?php if($pageFlag === 1) : ?>
    <?php if($_POST['csrf'] === $_SESSION['csrfToken']):?>
        <form method="POST" action="contact.php">
            <div class="fm-box">
                <div class="fm01">
                    お名前【 <?php echo h($_POST['your_name']) ; ?>】
                   
                    <input type="hidden" name="your_name" value="<?php echo h($_POST['your_name']) ; ?>">
                    <br>
                </div>
                <div class="fm01">
                    電話番号【 <?php echo h($_POST['tel']) ; ?>】
                   
                    <input type="hidden" name="tel" value="<?php echo h($_POST['tel']) ; ?>">
                    <br>
                </div>
                <div class="fm01">
                    見学希望日【<?php echo h($_POST['day']) ; ?>】
                    
                    <input type="hidden" name="day" value="<?php echo h($_POST['day']) ; ?>">
                    <br>
                </div>
                <div class="fm01">
                    見学希望時間【<?php 
                    if($_POST['time'] === '10:00~11:00'){echo '10:00~11:00';}
                    if($_POST['time'] === '15:00~16:00'){echo '15:00~16:00';}
                    ?>】
                    
                    <input type="hidden" name="time" value="<?php echo h($_POST['time']) ; ?>">
                    
                    <br>
                </div>
                <div class="fm01">
                    お子様の年齢【 <?php
                        $ages = '';
                        $agesCount = 0;
                        foreach($_POST['ages'] as $age){
                        if($agesCount > 0){
                            $ages .= ',';
                        }
                        $ages .= $age;
                        $agesCount++;
                        }
                        echo $ages;
        
                        $age = [];
                        $age[] = $ages;
                        ?>   】
                   
                   <!-- <?php var_dump($age);?> -->
                   <input type="hidden" name="ages" value="<?php echo $ages ; ?>">
                   <br>
                </div>
                <div class="fm01">
                    ご相談内容【<?php echo h($_POST['contact']) ; ?>】
                        
                    
                    <input type="hidden" name="contact" value="<?php echo h($_POST['contact']) ; ?>">
                </div>
                <div class="bottom">
                    <input type="submit" name="btn_submit" value="送信する" class="botton-k" style=padding: right 30px;>
                    <input type="submit" name="back" value="戻る" class="botton-b">
                    <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']); ?>">
                </div>
            </div>
        </form>
    <?php endif ; ?>
<?php endif ; ?>


<!-- 完了画面 -->
<?php if($pageFlag === 2) : ?>
    <?php if($_POST['csrf'] === $_SESSION['csrfToken']) :?>  
        <?php require '../mainte/insert.php';
        insertContact($_POST);
        ?>
         <div class="fm-box">
            <div class="fm01">
                予約が完了しました<br>
                キャンセルや日程変更の際には、ご連絡ください
            </div>
        </div>
        <?php unset($_SESSION['csrfToken']) ;?>  
    <?php endif ; ?>
<?php endif ; ?>


<div class="fotter-title">
        <h1 class="h1">
            <span style="color: rgb(255 150 152 / 64%)">太</span>
                    <span style="color: #fff271">子</span>
                    <span style="color: #bae9eb">堂</span>
                    <span style="color: rgb(255 150 152 / 64%)">保</span>
                    <span style="color: #bae9eb">育</span>
                    <span style="color: #fff271">園</span>
        </h1>
    </div>
    <div class="list">
        <div class="fotter-list01">
            <ul>
                <li>〒157-00◇◇</li>
                <li>東京都世田谷区太子堂〇〇◇</li>
                <li>ＴＥＬ 03-000-000</li>
            </ul>
        </div>
        <div class="fotter-list02">
            <ul>
                <a href="index.html"><li>保育園紹介</li></a>
                <a href="time schedule.html"><li>保育園の一日</li></a>
                <a href="gyouji.html"><li>年間行事</li></a>
                <a href="http://localhost/Sample/form/contact.php"><li>保育園見学</li></a>
            </ul>
        </div>
    </div>
    <div class="fotter"></div>
    
</body>
</html>
