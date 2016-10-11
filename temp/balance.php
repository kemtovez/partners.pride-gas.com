<div id="balance_page">
    <div class="area">
        <div class="balanse_heager">
        <h1>История операций:</h1>
            <div class="filter_period">
                <label>Период:</label>
                <input id="periodpickerstart" type="text" />
                <input id="periodpickerend" type="text" />
                <button class="buttons">Отсортировать</button>
            </div>
        </div>
        <div class="add_money">
            <div class="balanse_box">
                <h5>Баланс</h5>
                <p><?php echo $my_balans; ?><span>грн</span></p>
            </div>
            <form method="POST" action="https://www.liqpay.com/api/3/checkout" accept-charset="utf-8">
                <input type="hidden" name="data" value="eyAidmVyc2lvbiIgOiAzLCAicHVibGljX2tleSIgOiAieW91cl9wdWJsaWNfa2V5IiwgImFjdGlvbiIgOiAicGF5IiwgImFtb3VudCIgOiAxLCAiY3VycmVuY3kiIDogIlVTRCIsICJkZXNjcmlwdGlvbiIgOiAiZGVzY3JpcHRpb24gdGV4dCIsICJvcmRlcl9pZCIgOiAib3JkZXJfaWRfMSIgfQ=="/>
                <input type="hidden" name="signature" value="QvJD5u9Fg55PCx/Hdz6lzWtYwcI="/>
               <input type="submit" value="Пополнить баланс" class="buttons green_buttons">
            </form>
        </div>
        <br>
        <table class="table_user_work tables">
            <thead>
            <tr>
                <td>№</td>
                <td>Дата</td>
                <td>Тип операции</td>
                <td>Сумма, грн</td>
                <td>Баланс<br>после операции</td>
                <td>Описание операции</td>
                <td></td>
            </tr>
            </thead>
            <tbody id="balance_list">

            </tbody>
            </table>
    </div>
</div>