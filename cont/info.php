<?php
$id = $_SESSION['id'];
$rs = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$id'");
while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
    $my_id = $row['id'];
    $my_name = $row['name'];
    $my_region = $row['region'];
    $my_sity = $row['sity'];
    $my_street = $row['street'];
    $my_tel1 = $row['tel1'];
    $my_tel2 = $row['tel2'];
    $my_tel3 = $row['tel3'];
    $my_email = $row['email'];
    $my_pass = $row['pass'];
    $my_promo_img = $row['promo_img'];
    $my_limit_in_day = $row['limit_in_day'];
    $my_work_day1 = $row['work_day1'];
    $my_work_day2 = $row['work_day2'];
    $my_work_day3 = $row['work_day3'];
    $my_balans = $row['balans'];
    $my_servises = $row['servises'];
    $my_send_email = $row['send_email'];

    $my_reyting1 = $row['reyting1'];
    $my_reyting2 = $row['reyting2'];
    $my_reyting3 = $row['reyting3'];
    $my_global_reyting = $row['global_reyting'];

    $my_photo1 = $row['photo1'];
    $my_photo2 = $row['photo2'];
    $my_photo3 = $row['photo3'];
    $my_photo4 = $row['photo4'];
    $my_photo5 = $row['photo5'];
    $my_photo6 = $row['photo6'];
    $my_photo7 = $row['photo7'];
    $my_photo8 = $row['photo8'];

    $my_chat_in = $row['chat_in'];
}
$my_reyting_in_ukraine = 0;
$rs0 = mysqli_query($link, "SELECT * FROM `srm_sto` ORDER BY `global_reyting` DESC");
while($row0 = mysqli_fetch_array($rs0, MYSQLI_ASSOC)) {
    $my_reyting_in_ukraine = $my_reyting_in_ukraine + 1;
    if($row0['id']==$my_id) {
        break;
    }
}
//---------------
$my_reyting_in_region = 0;
$rs00 = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE `region`='$my_region' ORDER BY `global_reyting` DESC");
while($row00 = mysqli_fetch_array($rs00, MYSQLI_ASSOC)) {
    $my_reyting_in_region = $my_reyting_in_region + 1;
    if($row00['id']==$my_id) {
        break;
    }
}
//-------------------------
$rs000 = mysqli_query($link, "SELECT * FROM `srm_works` WHERE `id_sto`='$my_id' AND `status`='1'");
$kol_wait_work = mysqli_num_rows($rs000);
//---------------------------

$rs_im = mysqli_query($link, "SELECT * FROM `srm_chat` WHERE `data` > '$my_chat_in'");
$kol_im = mysqli_num_rows($rs_im);
