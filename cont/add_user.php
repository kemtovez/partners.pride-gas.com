<?php
session_start();
include ("../cont/bd_user.php");
$data = array();
$id_sto = $_SESSION['id'];
//         $data = 'step=1&id_sto='+$id_sto+'&name='+$name+'&tel='+$tel+'&email='+$email+'&uid='+$uid+'&type_car='+$type_car+'&model_car='+$model_car;

$step = htmlspecialchars($_POST['step']);
$step = mysqli_real_escape_string($link, $step);
$chek = 0;
if($step==1) {
      $pass = uniqid();

      $name = htmlspecialchars($_POST['name']);
      $name = mysqli_real_escape_string($link, $name);

      $tel = htmlspecialchars($_POST['tel']);
      $tel = mysqli_real_escape_string($link, $tel);

      $email = htmlspecialchars($_POST['email']);
      $email = mysqli_real_escape_string($link, $email);

      $uid = htmlspecialchars($_POST['uid']);
      $uid = mysqli_real_escape_string($link, $uid);

      $type_car = htmlspecialchars($_POST['type_car']);
      $type_car = mysqli_real_escape_string($link, $type_car);

      $model_car = htmlspecialchars($_POST['model_car']);
      $model_car = mysqli_real_escape_string($link, $model_car);

      if($name=='') {
            $chek = 1;
            $data['error'] = array(
                'text' => 'Введите имя нового пользователя',
            );
      };
      if($tel=='') {
            $chek = 1;
            $data['error'] = array(
                'text' => 'Введите телефон нового пользователя',
            );
      };
      if($email=='') {
            $chek = 1;
            $data['error'] = array(
                'text' => 'Введите почту нового пользователя',
            );
      };
      if($uid=='') {
            $chek = 1;
            $data['error'] = array(
                'text' => 'Введите VIN код нового пользователя',
            );
      };
      if($type_car=='') {
            $chek = 1;
            $data['error'] = array(
                'text' => 'Введите марку авто нового пользователя',
            );
      };
      if($model_car=='') {
            $chek = 1;
            $data['error'] = array(
                'text' => 'Введите модель авто нового пользователя',
            );
      };

      if($chek==0) {

            $rs0 = mysqli_query($link, "SELECT * FROM `srm_users` WHERE email='$email'");
            $kol_users = mysqli_num_rows($rs0);
            if($kol_users==0) {
                  $rs = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$id_sto'");
                  while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
                        $region = $row['region'];
                        $sity = $row['sity'];
                  }

                  $query0 = "INSERT INTO `srm_users` (`name`, `tel`, `email`, `uid`, `pass`, `region`, `sity`, `sto_id`)
					                VALUES ('$name', '$tel', '$email', '$uid', '$pass', '$region', '$sity', '$id_sto')";
                  mysqli_query($link, $query0);

                  $id_user = mysqli_insert_id($link);

                  $query = "INSERT INTO `srm_users_cars` (`id_user`, `uid`, `type_car`, `model_car`, `is_main`)
					                       VALUES ('$id_user', '$uid', '$type_car', '$model_car', '1')";
                  mysqli_query($link, $query);

                  $id_car = mysqli_insert_id($link);


                  $data['result'] = array(
                      'status' => 'ok',
                      'id_user' => $id_user,
                      'id_car' => $id_car,
                      'text' => 'Пользователь и его машина добавлены',
                  );

            } else {
                  $data['error'] = array(
                      'text' => 'Данная почта уже закреплена за другим пользователем',
                  );
            }

      }
      echo json_encode($data, JSON_NUMERIC_CHECK);
};
//$data = 'step=2&id_sto='+$id_sto+'&id_user='+$id_user+'&id_car='+$id_car+'&status='+$status+'&type='+$type+'&garant='+$garant;
if($step==2) {
      $time = time();

      $id_user = htmlspecialchars($_POST['id_user']);
      $id_user = mysqli_real_escape_string($link, $id_user);

      $id_car = htmlspecialchars($_POST['id_car']);
      $id_car = mysqli_real_escape_string($link, $id_car);

      $status = htmlspecialchars($_POST['status']);
      $status = mysqli_real_escape_string($link, $status);

      $type = htmlspecialchars($_POST['type']);
      $type = mysqli_real_escape_string($link, $type);

      if($type==0) {
            $name = 'Установка ГБО';
      };
      if($type==1) {
            $name = 'Техническое обслуживание';
      };
      if($type==2) {
            $name = 'Гарантийное обслуживание';
      };
      if($type==3) {
            $name = 'Ремонт';
      };


      $garant = htmlspecialchars($_POST['garant']);
      $garant = mysqli_real_escape_string($link, $garant);

      if($type=='') {
            $chek = 1;
            $data['error'] = array(
                'text' => 'Выберите тип работы',
            );
      };
      if($chek==0) {

            $rs = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$id_sto'");
            while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
                  $region = $row['region'];
                  $sity = $row['sity'];
            }

            $query0 = "INSERT INTO `srm_works` (`id_user`, `id_car`, `id_sto`, `type`, `status`, `name`, `sity`, `garant`, `price`, `time`)
					                   VALUES ('$id_user', '$id_car', '$id_sto', '$type', '$status', '$name', '$sity', '$garant', '0', '$time')";
            mysqli_query($link, $query0);
            $id_work = mysqli_insert_id($link);

            $query00="INSERT INTO `srm_works_data_log` (`id_work`, `id_sto` `type_work`, `time`)
					                        VALUES ('$id_work', '$id_sto', '2', '$time')";
            mysqli_query($link, $query00);

            $data['result'] = array(
                'status' => 'ok',
                'id_work' => $id_work,
                'text' => 'Заявка на работу добавлена',
            );

}
      echo json_encode($data, JSON_NUMERIC_CHECK);
}
?>
