<?php
session_start();
//SELECT * FROM `srm_works` WHERE id IN (SELECT id_work FROM `srm_works_data_log` WHERE type_work='0')
//SELECT * FROM `srm_works_data_log` WHERE id_work IN (SELECT id FROM `srm_works` WHERE id_sto='1') AND type_work='4'
//SELECT * FROM `srm_works` WHERE id IN (SELECT id_work FROM `srm_works_data_log` WHERE type_work='4') AND id_sto='1'
include ("../cont/bd_user.php");
$data = array();
$my_id = $_SESSION['id'];
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
?>