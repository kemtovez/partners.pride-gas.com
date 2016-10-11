<?php
?>
<div id="calendar_page">
    <div class="md-modal md-effect-1 calendar_event_box" id="modal-1">
        <div class="md-content">
            <div class="md-content-header">
                <h3></h3>
                <span class="md-close"><i class="fa fa-times" aria-hidden="true"></i></span>
            </div>
            <div class="md-content-box">
                <div class="user_data_calendar data_table_work">
                    <ul>
                        <li>
                            <label>Дата</label>
                            <p><input type="text" name="data" class="input_text" placeholder="Дата"><span class="update_time_work" data=""><i class="fa fa-check" aria-hidden="true"></i></span></p>
                        </li>
                        <li>
                            <label>Название услуги</label>
                            <p><span id="ajax_name_work"></span></p>
                        </li>
                        <li>
                            <label>Заказчик:</label>
                            <p><span id="ajax_name_user"></span></p>
                        </li>
                        <li>
                            <label>Контакты заказчика:</label>
                            <p><span id="ajax_tel_user"></span></p>
                        </li>
                        <li>
                            <label>Авто:</label>
                            <p><span id="ajax_auto_user"></span></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="area">
        <h1>Календарь</h1>
        <div class="calendar_box">
            <div id="calendar"></div>
        </div>
    </div>
</div>
