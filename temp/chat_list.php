<?php
session_start();
include ("../cont/bd_user.php");
$data = array();
$my_id = $_SESSION['id'];

$rs = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$my_id'");
while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
    $region = $row['region'];
}


if (isset($_POST['cat'])) {
    $cat = htmlspecialchars($_POST['cat']);
    $cat = mysqli_real_escape_string($link, $cat);
} else {
    $cat = 1;
};

$login = time() - 300;
if($cat==1) {
    $sql1 = "SELECT * FROM `srm_chat` WHERE `region`='$region' AND cat='1'";
    $sql2 = "SELECT * FROM `srm_sto` WHERE `chat_in` > '$login'";
} else {
    $sql1 = "SELECT * FROM `srm_chat` WHERE cat='2'";
    $sql2 = "SELECT * FROM `srm_sto` WHERE `chat_in` > '$login'";
};
?>
<div class="chat_body">
    <div class="chat_log">
        <h3>Сообщения:</h3>
        <?php
        $rs1 = mysqli_query($link, $sql1);
        while($row1 = mysqli_fetch_array($rs1, MYSQLI_ASSOC)) {
           ?>
            <div class="chat_msng">
                <span><?php echo date('d.m.Y', $row1['data']);; ?></span>
                <h3><?php echo $row1['name_user']; ?>:</h3>
                <p><?php echo $row1['text']; ?></p>

            </div>
        <?php
        }
        ?>
    </div>
    <div class="login_users">
        <h3>СТО онлайн:</h3>
        <?php
        $rs2 = mysqli_query($link, $sql2);
        while($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
            echo '<p>'.$row2['name'].'</p>';
        }
        ?>
    </div>

</div>
