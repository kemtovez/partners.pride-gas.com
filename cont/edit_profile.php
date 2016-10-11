<?php
session_start();
$data = array();
include ("../cont/bd_user.php");
$my_id = $_SESSION['id'];

if (isset($_POST['table'])) {
    $table = htmlspecialchars($_POST['table']);
    $table = mysqli_real_escape_string($link, $table);
    if($table=='users' OR $table=='servises') {
        $name = htmlspecialchars($_POST['name']);
        $name = mysqli_real_escape_string($link, $name);

        $value = htmlspecialchars($_POST['value']);
        $value = mysqli_real_escape_string($link, $value);

        mysqli_query($link, "UPDATE `srm_sto` SET `$name`='$value' WHERE id='$my_id'");

        $data['result'] = array(
            'status' => 'ok',
            'do' => 'go_url',
            'url' => '/edit_profile',
            'text' => 'Сохранено',
        );
    };
} else {

$name = htmlspecialchars($_POST['name']);
$name = mysqli_real_escape_string($link, $name);

$street = htmlspecialchars($_POST['street']);
$street = mysqli_real_escape_string($link, $street);

$email = htmlspecialchars($_POST['email']);
$email = mysqli_real_escape_string($link, $email);

$pass = htmlspecialchars($_POST['pass']);
$pass = mysqli_real_escape_string($link, $pass);

$tel1 = htmlspecialchars($_POST['tel1']);
$tel1 = mysqli_real_escape_string($link, $tel1);

$tel2 = htmlspecialchars($_POST['tel2']);
$tel2 = mysqli_real_escape_string($link, $tel2);

$tel3 = htmlspecialchars($_POST['tel3']);
$tel3 = mysqli_real_escape_string($link, $tel3);

$work_day1 = htmlspecialchars($_POST['work_day1']);
$work_day1 = mysqli_real_escape_string($link, $work_day1);

$work_day2 = htmlspecialchars($_POST['work_day2']);
$work_day2 = mysqli_real_escape_string($link, $work_day2);

$work_day3 = htmlspecialchars($_POST['work_day3']);
$work_day3 = mysqli_real_escape_string($link, $work_day3);

$chek = 0;
if($email=='') {
    $chek = 1;
    $data['error'] = array(
        'text' => 'Поле почты не может быть пустое',
    );
};
if($pass=='') {
    $chek = 1;
    $data['error'] = array(
        'text' => 'Поле пароля не может быть пустое',
    );
};

if($chek==0) {
    mysqli_query($link, "UPDATE `srm_sto` SET `name`='$name', `street`='$street', `email`='$email', `pass`='$pass', `tel1`='$tel1', `tel2`='$tel2', `tel3`='$tel3', `work_day1`='$work_day1', `work_day2`='$work_day2', `work_day3`='$work_day3' WHERE id='$my_id'");

    $data['result'] = array(
        'status' => 'ok',
        'do' => 'go_url',
        'url' => '/edit_profile',
        'text' => 'Сохранено',
    );
}
}
echo json_encode($data, JSON_NUMERIC_CHECK);

?>
