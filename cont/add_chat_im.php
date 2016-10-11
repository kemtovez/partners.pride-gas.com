<?php
session_start();
include ("../cont/bd_user.php");
$my_id = $_SESSION['id'];

$rs = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$my_id'");
while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
      $name = $row['name'];
      $region = $row['region'];
}

$text = htmlspecialchars($_POST['text']);
$text = mysqli_real_escape_string($link, $text);

$cat = htmlspecialchars($_POST['cat']);
$cat = mysqli_real_escape_string($link, $cat);

$time = time();

if($text!='') {

      $query0 = "INSERT INTO `srm_chat` (`id_user`, `name_user`, `text`, `cat`, `region`, `data`)
					             VALUES ('$my_id', '$name', '$text', '$cat', '$region', '$time')";
      mysqli_query($link, $query0);
      echo 'Сообщение отправлено';
} else {
      echo 'Сообщение не может быть пустым';
}

?>
