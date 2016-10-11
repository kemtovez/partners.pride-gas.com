<div id="clients_page">
    <div class="area">
        <h1>Найти клиента:</h1>
        <div class="search_clients_box">
            <label>Серийный номер гарантийной книги:</label>
            <p><input type="text" name="garant_book" class="input_text" value=""></p>
            <label>VIN номер:</label>
            <p><input type="text" name="uid" class="input_text" value=""></p>
            <label></label>
            <p><button class="buttons">Найти</button></p>
        </div>
        <div class="right_box">
            <button class="buttons blue_buttons my_clients">Мои клиенты</button>
            <a href="/add_user" class="buttons green_buttons add_new_client">Добавить нового клиента</a>
        </div>
        <hr>
        <div class="clients_table">
        <table>
            <thead>
            <tr>
                <td>Имя</td>
                <td>СТО</td>
                <td>Номер авто</td>
                <td>VIN код</td>
                <td>Телефон</td>
                <td>E-Mail</td>
            </tr>
            </thead>
            <tbody id="clients_list_table"></tbody>
        </table>
        </div>
    </div>
</div>