<div id="edit_profile">
    <div class="area">
        <h1>Редактирование профиля</h1>
        <form action="../cont/edit_profile.php"  method="POST" class="ajax_form edit_sto_form">
            <input type="hidden" name="id_user" value="<?php echo $my_id; ?>">
            <div class="groups group">
                <p>
                    <label for="type_car">Название СТО:</label>
                    <input type="text" name="name" class="input_text" value="<?php echo $my_name; ?>">
                </p>
                <p>
                    <label for="type_car">Регион:</label>
                    <input type="text" name="region" class="input_text" disabled value="<?php echo $my_region; ?>">
                </p>
                <p>
                    <label for="type_car">Город:</label>
                    <input type="text" name="sity" class="input_text" disabled value="<?php echo $my_sity; ?>">
                </p>
                <p>
                    <label for="type_car">Адрес:</label>
                    <input type="text" name="street" class="input_text" value="<?php echo $my_street; ?>">
                </p>
                <p>
                    <label for="type_car">Почта:</label>
                    <input type="text" name="email" class="input_text" value="<?php echo $my_email; ?>">
                </p>
                <p>
                    <label for="type_car">Пароль:</label>
                    <input type="text" name="pass" class="input_text" value="<?php echo $my_pass; ?>">
                </p>
            </div>
            <div class="groups group2">
                <p>
                    <label for="type_car">Телефон:</label>
                    <input type="text" name="tel1" class="input_text" value="<?php echo $my_tel1; ?>">
                </p>
                <p>
                    <label for="type_car">Телефон:</label>
                    <input type="text" name="tel2" class="input_text" value="<?php echo $my_tel2; ?>">
                </p>
                <p>
                    <label for="type_car">Телефон:</label>
                    <input type="text" name="tel3" class="input_text" value="<?php echo $my_tel3; ?>">
                </p>
                <p>
                    <label for="type_car">Количество авто в день:</label>
                    <input type="text" name="limit_in_day" class="input_text" value="<?php echo $my_limit_in_day; ?>">
                </p>
                <p>
                    <label for="type_car">График работы [пн-пт]:</label>
                    <input type="text" name="work_day1" class="input_text" value="<?php echo $my_work_day1; ?>">
                </p>
                <p>
                    <label for="type_car">График работы [сб]:</label>
                    <input type="text" name="work_day2" class="input_text" value="<?php echo $my_work_day2; ?>">
                </p>
                <p>
                    <label for="type_car">График работы [вс]:</label>
                    <input type="text" name="work_day3" class="input_text" value="<?php echo $my_work_day3; ?>">
                </p>
            </div>
            <button class="buttons yelow_buttons" type="submit">Сохранить</button>
        </form>
        <hr>
        <div class="servises_settings">
            <h3>Управление услугами:</h3>

                <?php
                $rs_ser = mysqli_query($link, "SELECT * FROM `srm_sto_services`");
                while($row_ser = mysqli_fetch_array($rs_ser, MYSQLI_ASSOC)) {
                    $id_ser = $row_ser['id'];
                    $name_ser = $row_ser['name'];
                    $title_ser = $row_ser['title'];
                    $is_act = substr_count($my_servises, $title_ser);
                    echo '<div class="list_servises_settings">';
                    if($is_act > 0) {
                        echo '<div class="checkbox_box"><input type="checkbox" value="1" name="'.$title_ser.'" id="ser_'.$title_ser.'" checked /><label for="ser_'.$title_ser.'"></label></div><p><b>'.$name_ser.'</b></p>';
                    } else {
                        echo '<div class="checkbox_box"><input type="checkbox" value="1" name="'.$title_ser.'" id="ser_'.$title_ser.'" /><label for="ser_'.$title_ser.'"></label></div><p>'.$name_ser.'</p>';
                    }
                    echo ' </div>';
                }
                ?>
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
        </div>
    </div>
</div>