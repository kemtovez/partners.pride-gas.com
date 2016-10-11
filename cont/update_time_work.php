<?php
session_start();
include ("../cont/bd_user.php");
$data = array();
$my_id = $_SESSION['id'];

$work_id = htmlspecialchars($_POST['id']);
$work_id = mysqli_real_escape_string($link, $work_id);

$time = htmlspecialchars($_POST['data']);
$time = mysqli_real_escape_string($link, $time);

$time = strtotime($time);


mysqli_query($link, "UPDATE `srm_works` SET `time`='$time' WHERE id='$work_id' AND id_sto='$my_id'");

      $data['result'] = array(
          'status' => 'ok',
          'text' => 'Дата обновлена',
      );

echo json_encode($data, JSON_NUMERIC_CHECK);
?>
