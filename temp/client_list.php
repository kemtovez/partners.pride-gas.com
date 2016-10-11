<?php
session_start();
//SELECT * FROM `srm_works` WHERE id IN (SELECT id_work FROM `srm_works_data_log` WHERE type_work='0')
//SELECT * FROM `srm_works_data_log` WHERE id_work IN (SELECT id FROM `srm_works` WHERE id_sto='1') AND type_work='4'
//SELECT * FROM `srm_works` WHERE id IN (SELECT id_work FROM `srm_works_data_log` WHERE type_work='4') AND id_sto='1'

//load_clients('garant_book='+$garant_book+'&uid='+$uid+'&type=1');
//load_clients('type=2');

include ("../cont/bd_user.php");
$data = array();
$my_id = $_SESSION['id'];
$type = htmlspecialchars($_POST['type']);
$type = mysqli_real_escape_string($link, $type);
if($type==2) {
    $rs = mysqli_query($link, "SELECT * FROM `srm_users` WHERE sto_id='$my_id'");
    while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
        $user_id = $row['id'];
        $sto_id = $row['sto_id'];
        $rs1 = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$sto_id'");
        while($row1 = mysqli_fetch_array($rs1, MYSQLI_ASSOC)) {
            $sto_name = $row1['name'];
        };
        $rs2 = mysqli_query($link, "SELECT * FROM `srm_users_cars` WHERE id_user='$user_id' AND is_main='1'");
        while($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
            $type_car = $row2['type_car'];
            $model_car = $row2['model_car'];
            $uid = $row2['uid'];
        }


        ?>
        <tr>
            <td><?php echo '<a href="/client/'.$user_id.'">'.$row['name'].'</a>'; ?></td>
            <td><?php echo $sto_name; ?></td>
            <td><?php echo $type_car.' '.$model_car; ?></td>
            <td><?php echo $uid; ?></td>
            <td><?php echo $row['tel']; ?></td>
            <td><?php echo $row['email']; ?></td>
        </tr>
        <?php
    }
};
if($type==1) {
    $garant_book = htmlspecialchars($_POST['garant_book']);
    $garant_book = mysqli_real_escape_string($link, $garant_book);

    $uid = htmlspecialchars($_POST['uid']);
    $uid = mysqli_real_escape_string($link, $uid);

    if($garant_book!='' AND $uid!='') {
        $zapros = "SELECT * FROM `srm_users_cars` WHERE `garant_book` LIKE '%$garant_book%' AND `uid` LIKE'%$uid%'";
    };
    if($garant_book=='' AND $uid!='') {
        $zapros = "SELECT * FROM `srm_users_cars` WHERE `uid` LIKE '%$uid%'";
    };
    if($garant_book!='' AND $uid=='') {
        $zapros = "SELECT * FROM `srm_users_cars` WHERE `garant_book` LIKE '%$garant_book%'";
    };

    $rs = mysqli_query($link, $zapros);
    while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
        $id_user = $row['id_user'];
        $rs1 = mysqli_query($link, "SELECT * FROM `srm_users` WHERE id='$id_user'");
        while($row1 = mysqli_fetch_array($rs1, MYSQLI_ASSOC)) {
            $sto_id = $row1['sto_id'];
            $user_name = $row1['name'];
            $user_tel = $row1['tel'];
            $email = $row1['email'];
        };
        $rs2 = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$sto_id'");
        while($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
            $sto_name = $row2['name'];
        };
        if($sto_id!=$my_id) {
            $user_tel = '';
            $email = '';
        }
        ?>
        <tr>
            <td><?php echo '<a href="/client/'.$user_id.'">'.$user_name.'</a>'; ?></td>
            <td><?php echo $sto_name; ?></td>
            <td><?php echo $row['type_car'].' '.$row['model_car']; ?></td>
            <td><?php echo $row['uid']; ?></td>
            <td><?php echo $user_tel; ?></td>
            <td><?php echo $email; ?></td>
        </tr>
        <?php
    }
}
//-------------------------

/*


if (isset($_POST['cat'])) {
    $cat = htmlspecialchars($_POST['cat']);
    $cat = mysqli_real_escape_string($link, $cat);
} else {
    $cat = 1;
};
$i = 0;


$rs = mysqli_query($link, "SELECT * FROM `srm_works` WHERE status='$cat' AND id_sto='$my_id'");

while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
    $i++;
if($row['type']=='0') {
    $text_type = 'Установка ГБО';
};
    if($row['type']=='1') {
        $text_type = 'Техническое обслуживание';
    };
    if($row['type']=='2') {
        $text_type = 'Гарантийное обслуживание';
    };
    if($row['type']=='3') {
        $text_type = 'Ремонт';
    };

    if($row['price']!='') {
        $price_text = $row['price'].' грн';
    } else {
        $price_text = '';
    }
//--------------------
    $id_car = $row['id_car'];
    $time_work = $row['time'];
    $rs0 = mysqli_query($link, "SELECT * FROM `srm_users_cars` WHERE id='$id_car'");
    while($row0 = mysqli_fetch_array($rs0, MYSQLI_ASSOC)) {
        $type_car = $row0['type_car'];
        $model_car = $row0['model_car'];
        $year_car = $row0['year_car'];
        $type_motor = $row0['type_motor'];
        $size_motor = $row0['size_motor'];
    }
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $text_type; ?></td>
        <td><?php echo $type_car.' '.$model_car.', '.$year_car.', '.$type_motor.', '.$size_motor;  ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $$price_text; ?></td>
        <td><?php
            //$time_work
            echo '<p>Желаемая дата установки: '.date('d.m.Y H:i', $time_work).'</p>';
            //--------------------
            $id_work = $row['id'];
            $rs1 = mysqli_query($link, "SELECT * FROM `srm_works_data_log` WHERE id_work='$id_work' ORDER BY `id` ASC");
            while($row1 = mysqli_fetch_array($rs1, MYSQLI_ASSOC)) {
                $type_work = $row1['type_work'];
                $time_work = $row1['time'];
                if($type_work==1){
                    echo '<p>Заяка отправлена в СТО:<br>'.date('d.m.Y H:i', $time_work).'</p>';
                }
                if($type_work==2){
                    echo '<p>СТО приняла заявку:<br>'.date('d.m.Y H:i', $time_work).'</p>';
                }
                if($type_work==3){
                    echo '<p>СТО отправила отчет на проверку:<br>'.date('d.m.Y H:i', $time_work).'</p>';
                }
                if($type_work==4){
                    echo '<p>Заявка выполнена:<br>'.date('d.m.Y H:i', $time_work).'</p>';
                }
            }
            //---------------
            ?></td>
        <td><?php
            if($cat==1) {
            echo '<button class="buttons green_buttons give_work" data="'.$id_work.'" type="2">Принять</button>
            <button class="buttons white_buttons give_work" data="'.$id_work.'" type="0">Отклонить</button>';
            };
            if($cat==2 OR $cat==3) {
                $rs2 = mysqli_query($link, "SELECT * FROM `srm_sto_report` WHERE id_work='$id_work'");
                $kol_report = mysqli_num_rows($rs2);
                if($kol_report>0) {
                    while ($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
                        $status_report = $row2['status'];
                        if ($status_report == '0') {
                            echo '<button class="buttons green_buttons edit_report" data="' . $row2['id'] . '">Изменить отчет</button>';
                        };
                        if ($status_report == '1') {
                            echo '<button class="buttons green_buttons edit2_report" data="' . $row2['id'] . '">Доработать отчет</button>';
                        };

                    };
                } else {
                    echo '<button class="buttons green_buttons add_report" data="'.$id_work.'">Написать отчет</button>';
                }
            };
            if($cat==4) {
                echo '<button class="buttons green_buttons show_report" data="'.$id_work.'">Просмотреть отчет</button>';
            };
            ?></td>
    </tr>
    <?php
}
*/
?>