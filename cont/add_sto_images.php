<?php
session_start();
include ("../cont/bd_user.php");
$data = array();
$my_id = $_SESSION['id'];

$title = htmlspecialchars($_POST['title']);
$title = mysqli_real_escape_string($link, $title);

$image = htmlspecialchars($_POST['image']);
$image = mysqli_real_escape_string($link, $image);

$thumb = htmlspecialchars($_POST['thumb']);
$thumb = mysqli_real_escape_string($link, $thumb);


      $query0="INSERT INTO `srm_sto_images` (`id_sto`, `title`, `image`, `thumb`)
					VALUES ('$my_id', '$title', '$image', '$thumb')";
      mysqli_query($link, $query0);

      $data['result'] = array(
          'status' => 'ok',
          'do' => 'go_url',
          'url' => '/home',
          'text' => 'Фото добавлено',
      );

echo json_encode($data, JSON_NUMERIC_CHECK);
?>
