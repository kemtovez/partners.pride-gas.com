<?php
session_start();
if (isset($_SESSION['id'])){
    $my_id = $_SESSION['id'];
    $tek_time = time();
    mysqli_query($link, "UPDATE `srm_sto` SET `chat_in`='$tek_time' WHERE id='$my_id'");

    require_once($_SERVER['DOCUMENT_ROOT']."/cont/info.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/temp/header.php");

if (file_exists($_SERVER['DOCUMENT_ROOT']."/temp/headers/".$params[0]."-header.php")) {
    require_once($_SERVER['DOCUMENT_ROOT']."/temp/headers/".$params[0]."-header.php");
};


    require_once($_SERVER['DOCUMENT_ROOT']."/temp/top_block.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/temp/".$params[0].".php");
    require_once($_SERVER['DOCUMENT_ROOT']."/temp/footer_block.php");
} else {
    require_once($_SERVER['DOCUMENT_ROOT']."/modules/login.php");
}
