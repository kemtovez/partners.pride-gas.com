<div id="home">
    <!-- ------- MODAL --------- -->
    <!-- ------- HOME ------------ -->
    <?php
    $my_stat_feed_users = 0;
    $my_stat_work_data_start = '---';
    $my_stat_work_data_end = '---';
    $my_stat_work_0 = 0;
    $my_stat_work_1 = 0;
    $my_stat_work_2 = 0;
    $my_stat_work_3 = 0;

$arr_work_data = array();

    $rs_gbo = mysqli_query($link, "SELECT * FROM `srm_works` WHERE `id_sto`='$my_id'");
    while($row_gbo = mysqli_fetch_array($rs_gbo, MYSQLI_ASSOC)) {
        $id_work = $row_gbo['id'];
        $type_work = $row_gbo['type'];
        $rs_gbo_log = mysqli_query($link, "SELECT * FROM `srm_works_data_log` WHERE `id_work`='$id_work' AND `type_work`='4'");
        $kol_rs_gbo_log = mysqli_num_rows($rs_gbo_log);
        if($kol_rs_gbo_log>0) {
            while($row_gbo_log = mysqli_fetch_array($rs_gbo_log, MYSQLI_ASSOC)) {
                if($type_work==0) {
                    $my_stat_work_0 = $my_stat_work_0 + 1;
                }
                if($type_work==1) {
                    $my_stat_work_1 = $my_stat_work_1 + 1;
                }
                if($type_work==2) {
                    $my_stat_work_2 = $my_stat_work_2 + 1;
                }
                if($type_work==3) {
                    $my_stat_work_3 = $my_stat_work_3 + 1;
                }
                $arr_work_data[] = $row_gbo_log['time'];
            }
        }
//---------------------
        $rs_feed = mysqli_query($link, "SELECT * FROM `srm_users_feedback` WHERE `id_work`='$id_work'");
    $kol_rs_feed = mysqli_num_rows($rs_feed);
        $my_stat_feed_users = $my_stat_feed_users + $kol_rs_feed;
    }

    $my_stat_work_all = $my_stat_work_0 + $my_stat_work_1 + $my_stat_work_2 + $my_stat_work_3;
    sort($arr_work_data);
    $my_stat_work_data_start = date('d.m.Y', $arr_work_data[0]);
    rsort($arr_work_data);
    $my_stat_work_data_end = date('d.m.Y', $arr_work_data[0]);

    $my_global_reyting = round($my_global_reyting, 1);
    ?>
    <script>

    </script>
    <div class="area">
        <div class="profile_box1">
            <div class="promo_photo_box">
                <div class="my_promo_photo" style="background: url(<?php echo $my_promo_img; ?>) center no-repeat;">
                    <div class="my_promo_photo_box" id="my_promo_photo_box"></div>
                    <span class="upload_promo_image" id="upload_promo_image"></span>
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
                <div class="statistic_work_box">
                    <div class="left_block">
                        <h3>Выполнено всего заказов (<?php echo $my_stat_work_all; ?>)</h3>
                        <div class="statistic_work_data"> с <span><?php echo $my_stat_work_data_start; ?></span> по <span><?php echo $my_stat_work_data_end; ?></span></div>
                        <ul>
                            <li>Установок (<?php echo $my_stat_work_0; ?>)</li>
                            <li>ТО (<?php echo $my_stat_work_1; ?>)</li>
                            <li>Гарант. обслуживания (<?php echo $my_stat_work_2; ?>)</li>
                            <li>Ремонт (<?php echo $my_stat_work_3; ?>)</li>
                        </ul>
                    </div>
                    <div class="right_block">
                        <h3>Отзывы от клиентов (<?php echo $my_stat_feed_users; ?>)</h3>
                        <p>Количество обслуживаемых авто в день:<span><?php echo $my_limit_in_day; ?></span></p>
                    </div>
                </div>
            </div>
        </div>
<table class="detail_sto_table">
    <thead>
    <tr>
        <td>Адрес:</td>
        <td>Контакты:</td>
        <td>График работы:</td>
        <td>Предоставляемые услуги:</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <p><?php echo $my_region; ?></p>
            <p><?php echo $my_sity; ?></p>
            <p><?php echo $my_street; ?></p>
        </td>
        <td>
            <p><?php echo $my_tel1; ?></p>
            <p><?php echo $my_tel2; ?></p>
            <p><?php echo $my_tel3; ?></p>
            <p><?php echo $my_email; ?></p>
        </td>
        <td>
            <p>пн-пт <?php echo $my_work_day1; ?></p>
            <p>сб <?php echo $my_work_day2; ?></p>
            <p>вс <?php echo $my_work_day3; ?></p>
        </td>
        <td>
            <?php
            echo list_sto_service($my_servises);
            ?>
        </td>
    </tr>
    </tbody>
</table>
<hr>
        <div class="sto_photo_box">
            <h3>Фото СТО:</h3>
            <div class="sto_photo_block">
                <?php
                $rs1 = mysqli_query($link, "SELECT * FROM `srm_sto_images` WHERE id_sto='$my_id'");
                while($row1 = mysqli_fetch_array($rs1, MYSQLI_ASSOC)) {
                    $id_image = $row1['id'];
                    $image1 = $row1['image1'];
                    $thumb1 = $row1['thumb1'];
                    ?>
                <div class="sto_photo">
                    <div class="my_sto_photo_box" id="img_sto_photo1"></div>
                    <h4>Внешний вид СТО</h4>
                    <a rel="fancybox" href="<?php echo $row1['image1']; ?>">
                        <img src="<?php echo $row1['thumb1']; ?>">
                    </a>
                    <span class="update_img_sto_photo" id="update_img_sto_photo1"></span>
                </div>
                    <div class="sto_photo">
                        <div class="my_sto_photo_box" id="img_sto_photo2"></div>
                        <h4>Боксы</h4>
                        <a rel="fancybox" href="<?php echo $row1['image2']; ?>">
                            <img src="<?php echo $row1['thumb2']; ?>">
                        </a>
                        <span class="update_img_sto_photo" id="update_img_sto_photo2"></span>
                    </div>
                    <div class="sto_photo">
                        <div class="my_sto_photo_box" id="img_sto_photo3"></div>
                        <h4>Боксы</h4>
                        <a rel="fancybox" href="<?php echo $row1['image3']; ?>">
                            <img src="<?php echo $row1['thumb3']; ?>">
                        </a>
                        <span class="update_img_sto_photo" id="update_img_sto_photo3"></span>
                    </div>
                    <div class="sto_photo">
                        <div class="my_sto_photo_box" id="img_sto_photo4"></div>
                        <h4>Боксы</h4>
                        <a rel="fancybox" href="<?php echo $row1['image4']; ?>">
                            <img src="<?php echo $row1['thumb4']; ?>">
                        </a>
                        <span class="update_img_sto_photo" id="update_img_sto_photo4"></span>
                    </div>
                    <div class="sto_photo">
                        <div class="my_sto_photo_box" id="img_sto_photo5"></div>
                        <h4>Приёмка</h4>
                        <a rel="fancybox" href="<?php echo $row1['image5']; ?>">
                            <img src="<?php echo $row1['thumb5']; ?>">
                        </a>
                        <span class="update_img_sto_photo" id="update_img_sto_photo5"></span>
                    </div>
                    <div class="sto_photo">
                        <div class="my_sto_photo_box" id="img_sto_photo6"></div>
                        <h4>Команда</h4>
                        <a rel="fancybox" href="<?php echo $row1['image6']; ?>">
                            <img src="<?php echo $row1['thumb6']; ?>">
                        </a>
                        <span class="update_img_sto_photo" id="update_img_sto_photo6"></span>
                    </div>
                    <div class="sto_photo">
                        <div class="my_sto_photo_box" id="img_sto_photo7"></div>
                        <h4>Фото с авто в работе</h4>
                        <a rel="fancybox" href="<?php echo $row1['image7']; ?>">
                            <img src="<?php echo $row1['thumb7']; ?>">
                        </a>
                        <span class="update_img_sto_photo" id="update_img_sto_photo7"></span>
                    </div>
                    <div class="sto_photo">
                        <div class="my_sto_photo_box" id="img_sto_photo8"></div>
                        <h4>Фото с авто в работе</h4>
                        <a rel="fancybox" href="<?php echo $row1['image8']; ?>">
                            <img src="<?php echo $row1['thumb8']; ?>">
                        </a>
                        <span class="update_img_sto_photo" id="update_img_sto_photo8"></span>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        </div>
    </div>

