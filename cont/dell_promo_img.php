<?php
session_start();
$session_id = $_SESSION['id'];
include "bd_user.php";
$name = '../uploads/promo_img/no_promo.jpg';
$strSQL1 = "UPDATE `srm_sto` SET `promo_img`='$name' WHERE id='$session_id'";
mysqli_query($link, $strSQL1);
?>

