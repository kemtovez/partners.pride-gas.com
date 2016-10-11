<?php
$id_user = $params[1];
$rs0 = mysqli_query($link, "SELECT * FROM `srm_users` WHERE id='$id_user'");
while ($row0 = mysqli_fetch_array($rs0, MYSQLI_ASSOC)) {
    $name_user = $row0['name'];
    $sity_user = $row0['sity'];
    $tel_user = $row0['tel'];
    $email_user = $row0['email'];
    $sto_id = $row0['sto_id'];
}
if($sto_id==$my_id) {
    $contacts = $tel_user.'<br>'.$email_user;
} else {
    $contacts = 'Недоступно';
};
$rs00 = mysqli_query($link, "SELECT * FROM `srm_users_cars` WHERE id_user='$id_user' AND `is_main`='1'");
while ($row00 = mysqli_fetch_array($rs00, MYSQLI_ASSOC)) {
    $type_car = $row00['type_car'];
    $model_car = $row00['model_car'];
    $type_motor = $row00['type_motor'];
    $uid = $row00['uid'];
}
?>
<div id="client_page">
    <div class="area">
        <h1>Основная информация:</h1>
        <div class="global_info">
            <div class="left_side">
              <label>Имя клиента</label>
                <p><?php echo $name_user; ?></p>
                <label>Город</label>
                <p><?php echo $sity_user; ?></p>
                <label>Дата рождения</label>
                <p><?php echo $data_bd; ?></p>
                <label>Контакты</label>
                <p><?php echo $contacts; ?></p>
            </div>
            <div class="right_side">
                <label>Марка и модель авто</label>
                <p><?php echo $type_car.' '.$model_car; ?></p>
                <label>Тип двигателя</label>
                <p><?php echo $type_motor; ?></p>
                <label>VIN код</label>
                <p><?php echo $uid; ?></p>
            </div>
        </div>
        <h1>История оказания услуг:</h1>
        <table class="table_user_work tables">
            <thead>
            <tr>
                <td>Дата</td>
                <td>Название услуги</td>
                <td>Исполнитель</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php
            $rs = mysqli_query($link, "SELECT * FROM `srm_works` WHERE id_user='$id_user' ORDER BY `id` DESC");
            while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
                $id_work = $row['id'];
                $id_sto = $row['id_sto'];
                $type_work = $row['type'];
                $name_work = $row['name'];
                $need_post_work = $row['need_post'];
                $garant = $row['garant'];
                $status_work = $row['status'];

                $rs2 = mysqli_query($link, "SELECT * FROM `srm_works_data_log` WHERE id_work='$id_work' ORDER BY `time` DESC LIMIT 0,1");
                while ($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
                    $data_last_work = date('d.m.y', $row2['time']);
                    $time_last_work = $row2['time'];

                }
                $rs3 = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$id_sto'");
                while ($row3 = mysqli_fetch_array($rs3, MYSQLI_ASSOC)) {
                    $name_sto = $row3['name'];
                    $street_sto = $row3['street'];
                    $tel1_sto = $row3['tel1'];
                    $tel2_sto = $row3['tel2'];
                    $tel3_sto = $row3['tel3'];
                }
                $dates_end = date('d.m.Y', strtotime('+'.$garant.' years', $time_last_work));

                $servises = array();
                $commet = '';
                $rs4 = mysqli_query($link, "SELECT * FROM `srm_sto_report` WHERE id_work='$id_work'");
                while ($row4 = mysqli_fetch_array($rs4, MYSQLI_ASSOC)) {
                    $servises = data_service($row4['servises'], $time_last_work);
                    $commet = $row4['commet'];
                }
                echo '<tr>';
                echo '<td>'.$data_last_work.'</td>';
                echo '<td>'.$name_work.'</td>';
                echo '<td>'.$name_sto.'</td>';
                echo '<td><button class="buttons detail_btn detail_work_table" data="'.$id_work.'">Детальнее</button></td>';
                echo '</tr>';
                echo '<tr class="hidden_data" id="hidden_data_'.$id_work.'"><td COLSPAN=6>';
                ?>
                <div class="work_info">
                    <div class="user_data">
                        <ul>
                            <li>
                                <label>Дата</label>
                                <p><span><?php echo $data_last_work; ?></span></p>
                            </li>
                            <li>
                                <label>Название услуги</label>
                                <p><span><?php echo $name_work; ?></span>
                            </li>
                            <li>
                                <label>Исполнитель (партнёр)</label>
                                <p><span><?php echo $name_sto; ?></span>
                            </li>
                            <li>
                                <label>Гарантия услуги</label>
                                <p>
                                    <?php
                                    if($type_work==0) {
                                        $str_data_end = strtotime($dates_end);
                                        $tek_data = time();
                                        $last_time = ($str_data_end - $tek_data)/ (60 * 60 * 24);
                                        echo '<span>Осталось '.round($last_time).' дн.</span>';
                                    }
                                    ?>
                                </p>
                            </li>
                            <li>
                                <label>Другие услуги в рамках данного обслуживания:</label>
                                <ul>
                                    <?php
                                        foreach ($servises as $arr) {
                                            if ($arr['data'] == '0') {
                                                echo '<li>' . $arr['name'] . '</li>';
                                            } else {
                                                echo '<li>' . $arr['name'] . ' (гарантия до ' . date('d.m.Y', $arr['data']) . ')</li>';
                                            };
                                        };
                                    ?>
                                </ul>
                            </li>
                            <li>
                                <label>Комментарий исполнителя после обслуживания:</label>
                                <p><?php echo $commet; ?></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
                echo '</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>