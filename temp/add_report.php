<div id="add_report">
    <div class="area">
<?php

if (isset($params[1])){
    $dir = $params[0];
    $id_work = $params[1];
    $rs = mysqli_query($link, "SELECT * FROM `srm_works` WHERE id='$id_work' AND `id_sto`='$my_id'");
    $kol_work = mysqli_num_rows($rs);
    if($kol_work > 0) {
        while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
            $garant = $row['garant'];
            $type = $row['type'];
            $id_user = $row['id_user'];
            $price = $row['price'];
        }

    $rs2 = mysqli_query($link, "SELECT * FROM `srm_users_cars` WHERE is_main='1' AND `id_user`='$id_user'");
    $kol_cars = mysqli_num_rows($rs2);
    if($kol_work > 0) {
        while ($row2 = mysqli_fetch_array($rs2, MYSQLI_ASSOC)) {
            $uid = $row2['uid'];
        }
    } else {
        $rs3 = mysqli_query($link, "SELECT * FROM `srm_users` WHERE `id`='$id_user'");
        while ($row3 = mysqli_fetch_array($rs3, MYSQLI_ASSOC)) {
            $uid = $row3['uid'];
        }
    }

        if($type==0) {
            echo '<h1>Отчет по установке оборудования</h1>';
        };
        if($type==1) {
            echo '<h1>Отчет по техническому обслуживанию</h1>';
        };
        if($type==2) {
            echo '<h1>Отчет по гарантийному обслуживанию</h1>';
        };
        if($type==3) {
            echo '<h1>Отчет по ремонту</h1>';
        };
    if($type==4) {
        echo '<h1>Отчет по Новому добавленному пользователю</h1>';
    };
        $rand = time();
            ?>
        <script>
            jQuery(document).ready(function ($)  {
                var upload_mg_to_report = {
                    uploadUrl:'../cont/report_img_save_to_file.php',
                    uploadData:{
                        "dir":"<?php echo $params[0]; ?>",
                        "sub_dir":"<?php echo $params[1]; ?>"
                    },
                    cropUrl:'../cont/report_img_crop_to_file.php',
                    cropData:{
                        "dir":"<?php echo $params[0]; ?>",
                        "sub_dir":"<?php echo $params[1]; ?>"
                    },
                    customUploadButtonId:'upload_mg_to_report',
                    modal:true,
                    onAfterImgUpload: function(){
                        console.log($(this)[0].imgUrl);
                        $val = $('.uploads_img').children('input[name="image_string"]').val();
                        $('.uploads_img').children('input[name="image_string"]').val($val+$(this)[0].imgUrl+';');
                    },
                    onAfterImgCrop:	function(test){
                        $html = '<div class="box_one_img"><img src="'+test.url+'"><span class="dell_box_one_img" data="'+test.url+'"></span></div>';
                        $('.line_upload_photo').append($html);
                        alertify.success('Файл загружен');
                    },
                };
                var upload_img_to_report = new Croppic('upload_mg_to_report_form', upload_mg_to_report);
            });
        </script>
            <div class="sto_report sto_report_type_<?php echo $type; ?>">
                <input type="hidden" value="<?php echo $id_work; ?>" name="work_id">
                <input type="hidden" value="<?php echo $price; ?>" name="price">
                <?php
                if($type==0) {
                ?>
                <div class="uploads_img">
                    <input type="hidden" name="image_string">
                    <div class="left_side">
                        Загрузите фото (2-7 штук):
                    </div>
                    <div class="right_side">
                        <button id="upload_mg_to_report" class="buttons">Загрузить фото</button>
                        <div class="upload_mg_to_report_form" id="upload_mg_to_report_form"></div>
                        <div class="line_upload_photo">
                            <?php
                           // echo dirname(__DIR__);
                            $image_url = '../uploads/'.$params[0].'/'.$params[1].'/';
                            $image_url_system = dirname(__DIR__).'/uploads/'.$params[0].'/'.$params[1].'/';

                            if(!is_dir($image_url_system)) {
                                mkdir($image_url_system) ;
                            };

                            $files = scandir($image_url_system, 1);
                            foreach ($files as $img) {
                                $is_not_full = substr_count($img, '_thumb.jpg');
                                if($is_not_full > 0) {
                                    echo '<div class="box_one_img"><img src="'.$image_url.$img.'"><span class="dell_box_one_img" data="'.$image_url.$img.'"></span></div>';
                                }
                            };
                            ?>
                        </div>
                    </div>
                </div>
                <div class="uploads_video">
                    <div class="left_side">
                        Ссылка на видео:
                    </div>
                    <div class="right_side">
                        <input type="text" name="url_video" class="input_text" value="">
                    </div>
                </div>
                <hr>
                <div class="text_block">
                    <div class="left_side">
                        Предистория (для сайта):
                    </div>
                    <div class="right_side">
                        <textarea name="text" placeholder="Введите текст" class="input_text"></textarea>
                        <p><b>Например:</b> Клиент обратился с проблемой большого расхода топлива. Долго не мог подобрать нужную комплектацию и сомневался стоит ли на Гелик устанавливать газ, не будет ли это "глупо". Мы подобрали для него оптимальный набор, показали преимущества установки ....</p>
                    </div>
                </div>
                <?php };
                if($type==4) {
                ?>
                <div class="text_block">
                    <div class="left_side">
                        VIN код
                    </div>
                    <div class="right_side">
                        <input type="text" name="uid" class="input_text" value="<?php echo $uid; ?>">
                    </div>
                </div>
                <?php }; ?>
                <div class="text_block">
                    <div class="left_side">
                        Комментарий к заказу:
                    </div>
                    <div class="right_side">
                        <textarea name="comment" placeholder="Введите текст" class="input_text"></textarea>
                        <p><b>Например:</b> Неадекват, сильно придирался дополнительно покрасили крыло</p>
                    </div>
                </div>
                <hr>
        <?php
        if($type==0) {
            if ($garant != '') { ?>
                <div class="left_min_side">
                    Гарантия:
                </div>
                <div class="right_min_side">
                    <?php echo $garant . ' года'; ?>
                </div>
                <?php
            }
        }
                ?>
                <h3>Дополнительные услуги:</h3>
                <?php
                $rs_ser = mysqli_query($link, "SELECT * FROM `srm_sto_services`");
                while($row_ser = mysqli_fetch_array($rs_ser, MYSQLI_ASSOC)) {
                    $id_ser = $row_ser['id'];
                    $name_ser = $row_ser['name'];
                    $title_ser = $row_ser['title'];
                    $is_garant_ser = $row_ser['is_garant'];
                    echo '<div class="add_list_servises_settings">';
                    if($is_garant_ser > 0) {
                        echo '<div class="checkbox_box"><input type="checkbox" value="1" name="'.$title_ser.'" id="ser_'.$title_ser.'" /><label for="ser_'.$title_ser.'"></label></div><p><b>'.$name_ser.'</b></p><div class="input_show">Гарантия: <input type="text" class="input_text" placeholder="2" name="garant_'.$title_ser.'"><span>месяцев</span></div>';
                    } else {
                        echo '<div class="checkbox_box"><input type="checkbox" value="1" name="'.$title_ser.'" id="ser_'.$title_ser.'" /><label for="ser_'.$title_ser.'"></label></div><p>'.$name_ser.'</p>';
                    }
                    echo ' </div>';
                }
                ?>
                <hr>
                <button class="buttons yelow_buttons add_report_submit">Отправить</button>
            </div>
            <?php

    }
} else {
    ?>
    <div class="notification_box red_notification_box">
        <p>Ошибка. Номер заказа не найден</p>
    </div>
<?php }
?>
    </div>
</div>
