<div id="home">
    <!-- ------- MODAL --------- -->
    <!-- ------- HOME ------------ -->
    <?php
    $my_global_reyting = 4.5;
    $my_reyting1 = 4.5;
    $my_reyting2 = 2;
    $my_reyting3 = 3.8;

    $my_reyting_in_ukraine = 4;
    $my_reyting_in_region = 2;
    ?>
    <div class="area">
        <div class="profile_box1">
            <div class="promo_photo_box">
                <div class="my_promo_photo" style="background: url(/uploads/promo_img/<?php echo $my_promo_img; ?>) center no-repeat;">
                    <span class="upload_promo_image"></span>
                    <span class="dell_promo_image"></span>
                </div>
                <a href="/edit_profile" class="edit_profile_url">Редактировать информацию о СТО</a>
                <a href="//pride-gas.com/sto/<?php echo $my_id; ?>" class="show_profile_url">Просмотреть профиль СТО на сайте</a>
                <hr>
            </div>
            <div class="raytings_and_balance_box">
              <div class="raytings_and_balance">
                  <div class="left_block">
                      <h3>Рейтинг:<span><?php echo $my_global_reyting; ?></span></h3>
                      <div class="my_global_reyting rayting_line">
                          <span></span>
                          <p style="width: <?php echo $my_global_reyting * 20; ?>%;"></p>
                          <b></b>
                      </div>
                      <div class="rayt_parametr">
                          <label>Оценка параметру 1</label>
                          <div class="my_reyting my_reyting1 rayting_line">
                              <span></span>
                              <p style="width: <?php echo $my_reyting1 * 20; ?>%;"></p>
                              <b></b>
                          </div>
                          <label>Оценка параметру 2</label>
                          <div class="my_reyting my_reyting2 rayting_line">
                              <span></span>
                              <p style="width: <?php echo $my_reyting2 * 20; ?>%;"></p>
                              <b></b>
                          </div>
                          <label>Оценка параметру 3</label>
                          <div class="my_reyting my_reyting3 rayting_line">
                              <span></span>
                              <p style="width: <?php echo $my_reyting3 * 20; ?>%;"></p>
                              <b></b>
                          </div>
                      </div>
                      <hr>
                     <div class="reyting_in_area">
                         <p><span><?php echo $my_reyting_in_ukraine; ?></span> в Украине</p>
                         <p><span><?php echo $my_reyting_in_region; ?></span> в регионе</p>
                     </div>
                  </div>
                  <div class="right_block">
                      <div class="balanse_box">
                          <h5>Баланс</h5>
                          <p><?php echo $my_balans; ?><span>грн</span></p>
                      </div>
                      <a href="/send_base" class="buttons blue_buttons">Рассылка по базе</a>
                      <a href="/add_user" class="buttons green_buttons">Добавить нового клиента и отчёт проделанной работе</a>
                  </div>
              </div>
            </div>
        </div>



<h2><?php echo $my_name; ?><span class="edit_profile"><i class="fa fa-pencil" aria-hidden="true"></i>Редактировать профиль</span></h2>
        <div class="home_info_box">
            <div class="user_data">
                <ul>
                    <li>
                        <label>Телефон:</label>
                        <span name="tel" data="users"><?php echo $my_tel; ?></span>
                    </li>
                    <li>
                        <label>Почта:</label>
                        <span name="email" data="users"><?php echo $my_email; ?></span>
                    </li>
                    <li>
                        <label>Город:</label>
                        <span name="sity" data="users"><?php echo $my_sity; ?></span>
                    </li>
                    <li>
                        <label>Регион:</label>
                        <span name="region" data="users"><?php echo $my_region; ?></span>
                    </li>
                    <li>
                        <label>Марка авто:</label>
                        <span name="type_car" data="users_cars"><?php echo $my_type_car; ?></span>
                    </li>
                    <li>
                        <label>Модель:</label>
                        <span name="model_car" data="users_cars"><?php echo $my_model_car; ?></span>
                    </li>
                    <li>
                        <label>Год:</label>
                        <span name="year_car" data="users_cars"><?php echo $my_year_car; ?></span>
                    </li>
                    <li>
                        <label>Тип двигателя:</label>
                        <span name="type_motor" data="users_cars"><?php echo $my_type_motor; ?></span>
                    </li>
                    <li>
                        <label>Объём двигателя:</label>
                        <span name="size_motor" data="users_cars"><?php echo $my_size_motor; ?></span>
                    </li>
                    <li>
                        <label>Мощность двигателя:</label>
                        <span name="power_motor" data="users_cars"><?php echo $my_power_motor; ?></span>
                    </li>
                    <li>
                        <label>Ваша дата рождения:</label>
                        <span name="data_bd" data="users"><?php echo $my_data_bd; ?></span>
                    </li>
                    <li>
                        <label>Серийный номер гарантийной книжки:</label>
                        <span name="garant_book" data="users_cars"><?php echo $my_garant_book; ?></span>
                    </li>
                </ul>
            </div>
            <div class="sidebar">
                <button class="buttons blue_buttons new_user_in_auto md-trigger" data-modal="modal-1">У авто новый владелец</button>
                <hr>
                <button class="buttons yelow_buttons need_to md-trigger" data-modal="modal-2">Записаться на ТО</button>
                <button class="buttons yelow_buttons need_help md-trigger" data-modal="modal-3">Записаться на обслуживание</button>
                <hr>
                <div class="sale_to">
                    <h3>Ваша скидка на текущее ТО: </h3>
                    <span><?php echo $my_discount; ?>%</span>
                </div>
                <hr>
                <div class="send_settings">
                    <h3>Управление подписками:</h3>
                    <div class="list_send_settings">
                        <?php
                        if($my_send_email=='1') {
                            echo '<div class="checkbox_box"><input type="checkbox" value="1" name="check" id="send_email" checked /><label for="send_email"></label></div><p><b>Подписаться на новостную рассылку</b></p>';
                        } else {
                            echo '<div class="checkbox_box"><input type="checkbox" value="1" name="check" id="send_email" /><label for="send_email"></label></div><p>Подписаться на новостную рассылку</p>';
                        }
                        ?>
                    </div>
                    <div class="list_send_settings">
                        <?php
                        if($my_send_sms=='1') {
                            echo '<div class="checkbox_box"><input type="checkbox" value="1" name="check" id="send_sms" checked /><label for="send_sms"></label></div><p><b>Оповещать меня по SMS об новых услугах</b></p>';
                        } else {
                            echo '<div class="checkbox_box"><input type="checkbox" value="1" name="check" id="send_sms" /><label for="send_sms"></label></div><p>Оповещать меня по SMS об новых услугах</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="users_sto">
            <h3>Прикреплён к СТО:</h3>
            <a href="//pride-gas.com/sto/<?php echo $my_sto_id; ?>"><i class="fa fa-wrench" aria-hidden="true"></i><span><?php echo $my_sto_name; ?></span></a>
            <button class="hate_you md-trigger" data-modal="modal-4"><i class="fa fa-book" aria-hidden="true"></i><span>Книга жалоб и предложений</span></button>
        </div>
        <hr>
         <table class="table_user_work tables">
            <thead>
            <tr>
                <td>Дата</td>
                <td>Статус</td>
                <td>Услуга</td>
                <td>СТО</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php
            $rs = mysqli_query($link, "SELECT * FROM `srm_works` WHERE id_user='$my_id' AND id_car='$my_id_car' ORDER BY `id` DESC");
            while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
                $id_work = $row['id'];
                $id_sto = $row['id_sto'];
                $type_work = $row['type'];
                $name_work = $row['name'];
                $need_post_work = $row['need_post'];
                $status_work = 0;
                $rs2 = mysqli_query($link, "SELECT * FROM `srm_works_data_log` WHERE id_work='$id_work' ORDER BY `time` DESC LIMIT 0,1");
                while ($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
                    $time_last_work = date('d.m.y H:i', $row2['time']);
                    $status_work = $row2['type_work'];
                }
                $rs3 = mysqli_query($link, "SELECT * FROM `srm_sto` WHERE id='$id_sto'");
                while ($row3 = mysqli_fetch_array($rs3, MYSQLI_ASSOC)) {
                    $name_sto = $row3['name'];
                    $street_sto = $row3['street'];
                    $tel1_sto = $row3['tel1'];
                    $tel2_sto = $row3['tel2'];
                    $tel3_sto = $row3['tel3'];
                }
                echo '<tr>';
                echo '<td>'.$time_last_work.'</td>';
                echo '<td><span class="status_work status_work_'.$status_work.'">'.status_work($status_work).'</span> <button data="'.$id_work.'" class="buttons no_opacity_btn ajax_detail_work">Детальнее</button></td>';
                echo '<td>'.$name_work.'</td>';
                echo '<td><b>'.$name_sto.'</b><br>'.$street_sto.'<br>'.$tel1_sto.'<br>'.$tel2_sto.'</td>';
                if($need_post_work==1) {
                    echo '<td><p>Оставить отзыв и получить <b>скидку до 7%</b> на следующее обслуживание</p><a href="/add_post_work/'.$id_work.'" class="buttons min_yelow_buttons add_post_work">Оставить отзыв</a></td>';
                } else {
                    echo '<td></td>';
                }
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>