<?php
if (file_exists("lib.php")) {
  include_once("lib.php");
} else {
  echo json_encode(array("error" => "lib.php not found !"));
}
//deafult time zone
date_default_timezone_set('Asia/Tashkent');
//time = YYYY-MM-DD HH:mm:ss
$db = new Mylib();
$key = "YOAsMZeZnqbsLB";
$prepare = "18756";

if ($_POST['action'] == 1) {
  $click_trans = $_POST['click_trans_id'];
  $merchant_trans_id = $_POST['merchant_trans_id'];
  $amount = $_POST['amount'];
  $sign_time = $_POST['sign_time'];
  $service_id = $_POST['service_id'];
  $action = $_POST['action'];
  $error = $_POST['error'];
  $merchant_prepare_id = $_POST['merchant_prepare_id'];
  $md5 = md5($click_trans . $service_id . $key . $merchant_trans_id . $merchant_prepare_id . $amount . $action . $sign_time);


  $db->insert("logs_clickuz", ['click_trans_id' => $click_trans, 'merchant_trans_id' => $merchant_trans_id, 'amount' => $amount, 'sign_time' => $sign_time, 'situation' => $error]);

  $check_user = $db->select("users", ["id" => $merchant_trans_id]);
  $row = mysqli_fetch_assoc($check_user);

  if (strlen($row['id']) > 0) {
    $amount = $amount / 150;
    file_put_contents("log.txt",json_encode($_POST));
    $db->update("users", ['money' => $row['money'] + $amount], ['id' => $row['id']]);
    $db->insert("logs_money", ['id_user' => $row['id'], 'type' => 'plus', 'count' => $amount, 'action' => 'Автоматическая оплата CLICKUZ', 'time' => $sign_time]);

    if ($error == 0) {
      $array = array(
        'click_trans_id' => $click_trans,
        'merchant_trans_id' => $merchant_trans_id,
        'merchant_prepare_id' => $prepare,
        'error' => 0,
        'error_note' => $_POST['error_note']
      );
      echo json_encode($array);
    }
  } else {
    $array = array(
      'click_trans_id' => $click_trans,
      'merchant_trans_id' => $merchant_trans_id,
      'merchant_prepare_id' => $prepare,
      'error' => -9,
      'error_note' => "Do not find a user"
    );
    echo json_encode($array);
  }
}
