<div id="add_user">
    <div class="area">
        <h1>Добавление клиента в сеть:</h1>
        <div class="step1">
            <h3>Шаг 1. Добавление клиента</h3>
            <form action="../cont/add_user.php"  method="POST" class="add_user_form">
                <input type="hidden" name="id_sto" value="<?php echo $my_id; ?>">
                <div class="groups group">
                    <p>
                        <label for="type_car">Имя:</label>
                        <input type="text" name="name" class="input_text" value="">
                    </p>
                    <p>
                        <label for="type_car">Телефон:</label>
                        <input type="text" name="tel" class="input_text" value="">
                    </p>
                    <p>
                        <label for="type_car">E-mail:</label>
                        <input type="text" name="email" class="input_text" value="">
                    </p>
                </div>
                <div class="groups group2">
                    <p>
                        <label for="type_car">VIN код:</label>
                        <input type="text" name="uid" class="input_text" value="">
                    </p>
                    <p>
                        <label for="type_car">Марка авто:</label>
                        <input type="text" name="type_car" class="input_text" value="">
                    </p>
                    <p>
                        <label for="type_car">Модель авто:</label>
                        <input type="text" name="model_car" class="input_text" value="">
                    </p>
                </div>
                <button class="buttons yelow_buttons" type="submit">Сохранить</button>
            </form>
        </div>
        <!-- -------------------------------------- -->
        <div class="step2">
            <h3>Шаг 2. Добавление работы</h3>
            <form action="../cont/add_work.php"  method="POST" class="add_work_form">
                <input type="hidden" name="id_sto" value="<?php echo $my_id; ?>">
                <input type="hidden" name="id_user" value="">
                <input type="hidden" name="id_car" value="">
                <input type="hidden" name="status" value="2">
                <div class="list_servises_settings">
                    <div class="radio_box">
                        <input type="radio" value="0" name="type" id="type0">
                        <label for="type0"></label>
                    </div>
                    <p>ГБО (Отчет пройдет модерацию администратором)</p>
                </div>
                <div class="list_servises_settings">
                    <div class="radio_box">
                        <input type="radio" value="1" name="type" id="type1">
                        <label for="type1"></label>
                    </div>
                    <p>Техническое обслуживание</p>
                </div>
                <div class="list_servises_settings">
                    <div class="radio_box">
                        <input type="radio" value="2" name="type" id="type2">
                        <label for="type2"></label>
                    </div>
                    <p>Гарантийное обслуживание</p>
                </div>
                <div class="list_servises_settings">
                    <div class="radio_box">
                        <input type="radio" value="3" name="type" id="type3">
                        <label for="type3"></label>
                    </div>
                    <p>Ремонт</p>
                </div>
                <div class="groups group">
                    <p>
                        <label for="type_car">Гарантия: (лет)</label>
                        <input type="text" name="garant" class="input_text" value="3">
                    </p>
                    </div>
                <button class="buttons yelow_buttons" type="submit">Сохранить</button>
            </form>
        </div>
        <div class="step3">
            <h3>Шаг 3. Оформление отчета</h3>
            <a href="/add_report/" class="buttons yelow_buttons">Оформить отчет</a>
            </div>
    </div>
</div>