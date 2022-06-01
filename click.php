<?php
date_default_timezone_set('Asia/Tashkent');

$keys = array(
    "merchant_id" => "", //clickuz mutaxasislaridan olinadi
    "service_id" => "", //merchant.click.uz/home/service orqali olasiz
    "merchant_user_id" => "", //clickuz mutaxasislaridan olinadi
    "secret_key" => "", // merchant.click.uz/home/service orqali olasiz
    "transID" => "", //pul tushishi kerak bo'lgan mijoz id raqami yoki logini
);


$merchantID = $keys['merchant_id'];
$merchantUserID = $keys['merchant_user_id'];
$serviceID = $keys['service_id'];
$transID = $keys['transID'];
$transAmount = number_format(1000, 2, '.', '');
$returnURL = "https://example.com/check.php"; //natijani qaytarish uchun url
?>
<!DOCTYPE html>

<head>
    <title>Click.uz</title>
    <style>
        .click_logo {
            padding: 4px 10px;
            cursor: pointer;
            color: #fff;
            line-height: 190%;
            font-size: 13px;
            font-family: Arial;
            font-weight: bold;
            text-align: center;
            border: 1px solid #037bc8;
            text-shadow: 0px -1px 0px #037bc8;
            border-radius: 4px;
            background: #27a8e0;
            background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzI3YThlMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMxYzhlZDciIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
            background: -webkit-gradient(linear, 0 0, 0 100%, from(#27a8e0), to(#1c8ed7));
            background: -webkit-linear-gradient(#27a8e0 0%, #1c8ed7 100%);
            background: -moz-linear-gradient(#27a8e0 0%, #1c8ed7 100%);
            background: -o-linear-gradient(#27a8e0 0%, #1c8ed7 100%);
            background: linear-gradient(#27a8e0 0%, #1c8ed7 100%);
            box-shadow: inset 0px 1px 0px #45c4fc;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#27a8e0', endColorstr='#1c8ed7', GradientType=0);
            -webkit-box-shadow: inset 0px 1px 0px #45c4fc;
            -moz-box-shadow: inset 0px 1px 0px #45c4fc;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
        }

        .click_logo i {
            background: url(https://m.click.uz/static/img/logo.png) no-repeat top left;
            width: 30px;
            height: 25px;
            display: block;
            float: left;
        }
    </style>
</head>

<body>
    <? echo '<form action="" id="click_form" method="post" target="_blank">
     <button type="submit" name="send_true" class="click_logo"><i></i>Оплатить через CLICK</button>                         
</form>'; ?>

</body>

</html>


<?
if (strlen($_GET['message']) > 0) {
    echo $_GET['message'];
}
    
 
if (isset($_POST['send_true'])) {
    header("Location: https://my.click.uz/services/pay?amount=" . $transAmount . "&merchant_id=" . $merchantID . "&merchant_user_id=" . $merchantUserID . "&service_id=" . $serviceID . "&transaction_param=" . $transID . "&return_url=" . $returnURL);
}
