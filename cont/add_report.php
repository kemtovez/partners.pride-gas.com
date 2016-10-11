<?php
session_start();
include ("../cont/bd_user.php");
$data = array();
$my_id = $_SESSION['id'];

$work_id = htmlspecialchars($_POST['work_id']);
$work_id = mysqli_real_escape_string($link, $work_id);

$url_video = htmlspecialchars($_POST['url_video']);
$url_video = mysqli_real_escape_string($link, $url_video);

$text = htmlspecialchars($_POST['text']);
$text = mysqli_real_escape_string($link, $text);

$comment = htmlspecialchars($_POST['comment']);
$comment = mysqli_real_escape_string($link, $comment);

$servises = htmlspecialchars($_POST['servises']);
$servises = mysqli_real_escape_string($link, $servises);

$uid = htmlspecialchars($_POST['uid']);
$uid = mysqli_real_escape_string($link, $uid);

$price = htmlspecialchars($_POST['price']);
$price = mysqli_real_escape_string($link, $price);

$time = time();

$rs2 = mysqli_query($link, "SELECT * FROM `srm_sto_report` WHERE id_work='$work_id'");
$kol_report = mysqli_num_rows($rs2);
if($kol_report==0) {

      $rs = mysqli_query($link, "SELECT * FROM `srm_works` WHERE id='$work_id'");
      while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
            $type = $row['type'];
      }
      if($type!=0 AND $price==0) {
            $status = 4;
            $status2 = 2;
      } else {
            $status = 3;
            $status2 = 0;
      }



      $query0 = "INSERT INTO `srm_sto_report` (`id_work`, `id_sto`, `status`, `url_video`, `text`, `commet`, `servises`, `uid`)
					                VALUES ('$work_id', '$my_id', '$status2', '$url_video', '$text', '$comment', '$servises', '$uid')";
      mysqli_query($link, $query0);

      mysqli_query($link, "UPDATE `srm_works` SET `status`='$status' WHERE id='$work_id'");

      $query1 = "INSERT INTO `srm_works_data_log` (`id_work`, `id_sto`, `type_work`, `time`)
					                      VALUES ('$work_id', '$my_id', '$status', '$time')";
      mysqli_query($link, $query1);

      $data['result'] = array(
          'status' => 'ok',
          'do' => 'go_url',
          'url' => '/work',
          'text' => 'Отчет добавлен',
      );
} else {
      $data['error'] = array(
          'text' => 'Извините, отчет на данный заказ уже есть.',
      );
}
echo json_encode($data, JSON_NUMERIC_CHECK);
?>
