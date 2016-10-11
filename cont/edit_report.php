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


$rs2 = mysqli_query($link, "SELECT * FROM `srm_sto_report` WHERE id_work='$work_id' AND id_sto='$my_id' AND ( status='0' OR status='1')");
$kol_report = mysqli_num_rows($rs2);
if($kol_report > 0) {
while($row = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
      $id = $row['id'];
}

mysqli_query($link, "UPDATE `srm_sto_report` SET `url_video`='$url_video', `text`='$text', `commet`='$comment', `servises`='$servises', `uid`='$uid' WHERE id_work='$work_id' AND id_sto='$my_id'");

      $data['result'] = array(
          'status' => 'ok',
          'do' => 'go_url',
          'url' => '/edit_report/'.$id,
          'text' => 'Отчет обновлен',
      );
} else {
      $data['error'] = array(
          'text' => 'Изменение недоступно',
      );
}
echo json_encode($data, JSON_NUMERIC_CHECK);
?>
