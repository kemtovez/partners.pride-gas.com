<?php
session_start();
include ("../cont/bd_user.php");
include ("../cont/settings.php");
$data = array();
$my_id = $_SESSION['id'];
if (isset($_POST['time'])) {
    $time = htmlspecialchars($_POST['time']);
    $time = mysqli_real_escape_string($link, $time);
};
if($time==1) {
    $base = "SELECT * FROM `srm_sto_money_log` WHERE id_sto='$my_id' ORDER BY `id` DESC";
} else {
    //1.02.2004-2.02.2005

    $arr_time = explode("-", $time);

    $dat1 = strtotime($arr_time[0]);
    $dat2 = strtotime($arr_time[1]);

    if($dat1<dat2) {
        $start = $dat2;
        $end = $dat1;
    };
    if($dat1>dat2) {
        $start = $dat1;
        $end = $dat2 + 86399;
    }

        $base = "SELECT * FROM `srm_sto_money_log` WHERE id_sto='$my_id'  AND (`time` BETWEEN $start AND $end) ORDER BY `id` DESC";
}
echo $base;
$i = 0;
            $rs = mysqli_query($link, $base);
            while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
                $i++;
                $id_pay = $row['id'];
                $bulo = $row['bulo'];
                $stalo = $row['stalo'];
                $type = $row['type'];
                $id_work = $row['id_work'];
                $time = $row['time'];

                if($type==0) {
                    $text_work = 'ГБО';
                };
                if($type==1) {
                    $text_work = 'ТО';
                };
                if($type==2) {
                    $text_work = 'Гарант. обслуживание';
                };
                if($type==3) {
                    $text_work = 'Ремонт';
                };
                if($type==4) {
                    $text_work = 'другое';
                };

                if($bulo > $stalo) {
                    $text_type = 'Оплата комиссии';
                    $money = $bulo - $stalo;
                    $text = 'Оплата за '.$text_work;
                } else {
                    $text_type = 'Пополнение баланса';
                    $money = $stalo - $bulo;
                    $text = 'Пополнение баланса через LiqPay';
                };

                $rs2 = mysqli_query($link, "SELECT * FROM `srm_works_data_log` WHERE id_work='$id_work' ORDER BY `time` DESC LIMIT 0,1");
                while ($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
                    $data_last_work = date('d.m.y', $row2['time']);
                    $time_last_work = $row2['time'];

                }
                $servises = array();
                $commet = '';

                $rs4 = mysqli_query($link, "SELECT * FROM `srm_sto_report` WHERE id_work='$id_work'");
                while ($row4 = mysqli_fetch_array($rs4, MYSQLI_ASSOC)) {
                    $servises = data_service($row4['servises'], $time_last_work);
                    $commet = $row4['commet'];
                }


                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.date('d.m.Y', $time).'</td>';
                echo '<td>'.$text_type.'</td>';
                echo '<td>'.$money.'</td>';
                echo '<td>'.$stalo.'</td>';
                echo '<td>'.$text.'</td>';
                echo '<td><button class="buttons detail_btn detail_work_table" data="'.$id_pay.'">Детальнее</button></td>';
                echo '</tr>';
                echo '<tr class="hidden_data" id="hidden_data_'.$id_pay.'"><td COLSPAN=7>';
                ?>
                <div class="work_info">
                    <div class="user_data">
                        <ul>
                            <li>
                                <label>Дата</label>
                                <p><span><?php echo date('d.m.Y', $time); ?></span></p>
                            </li>
                            <li>
                                <label>Тип операции</label>
                                <p><span><?php echo $text_type; ?></span>
                            </li>
                            <li>
                                <label>Сумма, грн</label>
                                <p><span><?php echo $money; ?></span>
                            </li>
                            <li>
                                <label>Название услуги</label>
                                <p><span><?php echo $text; ?></span>
                            </li>
                            <?php
                            if($text != 'Пополнение баланса через LiqPay') {
                                ?>
                                <li>
                                    <label>Исполнитель (партнёр)</label>
                                    <p><span><?php echo $my_name; ?></span>
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
                                <?php
                            }
                            ?>

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