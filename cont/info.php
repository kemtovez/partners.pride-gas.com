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
}
