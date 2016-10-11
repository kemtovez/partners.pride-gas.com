<div id="page_im">
    <div class="area">
        <h1>Чаты:</h1>
        <div class="shuse_cat_chat">
            <button class="active_chat" data="1">Региональный</button>
            <button data="2">Общий</button>
        </div>
        <div class="chat_box">
        </div>
        <div class="add_chat_im">
            <textarea id="text_im" class="input_text" plaseholder="Введите сообщение..."></textarea>
            <input type="hidden" name="cat_chat" value="<?php echo $cat; ?>">
            <button class="buttons send_im_btn">Отправить</button>
        </div>
    </div>
</div>