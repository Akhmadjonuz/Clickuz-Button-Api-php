<?php
if (isset($_GET['payment_status'])) {
    if ($_GET['payment_status'] <= 0) {
       header('Location: https://example.com/click.php?message=Ошибка оплаты');
    }elseif ($_GET['payment_status'] == 1) {
        header('Location: https://example.com/click.php?message=Платёж находится в обработке');
    }elseif ($_GET['payment_status'] == 2 and isset($_GET['payment_id'])) {
        header('Location: https://example.com/click.php?message=Платёж успешно проведён');
    }else {
        header('Location: https://example.com/click.php?message=Ошибка оплаты');
    }
} 
