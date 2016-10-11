<?php
$data = array();
if (isset($_POST['url'])) {
 $url = htmlspecialchars($_POST['url']);
 if (file_exists($url)) {
  // ../uploads/add_report/2/1475332143_thumb.jpg

  $img_name_arr = explode("/", $url);
  $dir = $img_name_arr[2]; // add_report
  $sub_dir = $img_name_arr[3]; // 2
  $name = $img_name_arr[4]; //1475332143_thumb.jpg
  $img_name_arr2 = explode("_thumb.jpg", $name);
  $full_name = $img_name_arr2[0];

  unlink('../uploads/'.$dir.'/'.$sub_dir.'/'.$full_name.'.jpg');
  unlink($url);
  $data['result'] = array(
      'status' => 'ok',
      'text' => 'Файл удален',
  );
 } else {
  $data['error'] = array(
      'text' => 'Файл не существует',
  );
 }
} else {
 $data['error'] = array(
     'text' => 'Недостаточно данных',
 );
}
echo json_encode($data, JSON_NUMERIC_CHECK);
?>

