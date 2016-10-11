<?php
session_start();
include ("../cont/bd_user.php");
$data = array();
$my_id = $_SESSION['id'];

$id_work = htmlspecialchars($_POST['id_work']);
$id_work = mysqli_real_escape_string($link, $id_work);

$type_work = htmlspecialchars($_POST['type_work']);
$type_work = mysqli_real_escape_string($link, $type_work);

$time = time();

// Balance
$rs3 = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$my_id'");
while($row3 = mysqli_fetch_array($rs3, MYSQLI_ASSOC)) {
      $balans = $row3['balans'];
}

// СТО Принял заявку
if($type_work==2) {

      $rs = mysqli_query($link, "SELECT * FROM `srm_works` WHERE id='$id_work'");
      while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
            $id_sto = $row['id_sto'];
            $type = $row['type'];
            $id_user = $row['id_user'];
      }

      if($type=='0') {
            $new_balans = $balans - setting('price0');
      }
      if($type=='1') {
            $new_balans = $balans - setting('price1');
      }
      if($type=='2') {
            $new_balans = $balans - setting('price2');
      }
      if($type=='3') {
            $new_balans = $balans - setting('price3');
      }

      if( $new_balans > 0 ) {
            if ($id_sto == $my_id) {
                  $query0 = "INSERT INTO `srm_works_data_log` (`id_work`, `id_sto`, `type_work`, `time`)
					                      VALUES ('$id_work', '$id_sto', '$type_work', '$time')";
                  mysqli_query($link, $query0);

                  mysqli_query($link, "UPDATE `srm_works` SET `status`='$type_work' WHERE id='$id_work'");
                  echo 'Заявка принята';

                  mysqli_query($link, "UPDATE `srm_sto` SET `balans`='$new_balans' WHERE id='$id_sto'");
                  echo 'Баланс обновлен';

                  $query1 = "INSERT INTO `srm_sto_money_log` (`id_sto`, `bulo`, `stalo`, `type`, `id_work`, `time`)
					                                VALUES ('$id_sto', '$balans', '$new_balans', '$type', '$id_work', '$time')";
                  mysqli_query($link, $query1);

                  mysqli_query($link, "UPDATE `srm_users` SET `sto_id`='$id_sto' WHERE id='$id_user'");
                  echo 'Пользователь привязан к СТО';

            } else {
                  echo 'Это не ваш заказ';
            }
      } else {
            echo 'Нет денег';
      }
};
// СТО Отказал в заявке
if($type_work==0) {
      $rs = mysqli_query($link, "SELECT * FROM `srm_works` WHERE id='$id_work'");
      while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
            $id_sto = $row['id_sto'];
      }
      $query0 = "INSERT INTO `srm_works_data_log` (`id_work`, `id_sto`, `type_work`, `time`)
					                      VALUES ('$id_work', '$id_sto', '$type_work', '$time')";
      mysqli_query($link, $query0);
      mysqli_query($link, "UPDATE `srm_works` SET `status`='$type_work', `id_sto`='' WHERE id='$id_work'");
};


?>
