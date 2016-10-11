<header>
    <div class="area">
        <a class="logo" href="/home"></a>
        <div class="menu_box">
            <h3>Добро пожаловать, <?php echo $my_name; ?><a href="exit">Выйти</a><p>Техподдержка: +38 (066) 777 50 89</p></h3>
            <ul>
                <li><a href="/home">Профиль СТО</a></li>
                <li><a href="/work">Заказы<?php if($kol_wait_work>0) echo '<b>+'.$kol_wait_work.'</b>'; ?></a></li>
                <li><a href="/calendar">Расписание</a></li>
                <li><a href="/im">Сообщения<?php if($kol_im>0) echo '<b>+'.$kol_im.'</b>'; ?></a></li>
                <li><a href="/clients">База клиентов</a></li>
                <li><a href="/balance">Баланс</a></li>
            </ul>
        </div>
    </div>
</header>