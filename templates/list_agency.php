<?php
$f_except = array('billing_id');
?>
<a href='/red_cells' class='button'>Задание 2</a>
<a href='/fibonachchi' class='button'>Задание 3</a>
<hr noshade size='1' color='silver'>
<form id="agency_list" action='' method="post">
    <label>От</label><input type='text' name='date_from' class='input date-pick' value="<?= $input_val['date_from'] ?>">
    <label>До</label><input type='text' name='date_to' class='input date-pick' value="<?= $input_val['date_to'] ?>">
    <div style='clear:both'></div>
    <label>Нет данных по биллингу</label><input name='no_data' type='checkbox' value='1' <?= $input_val['no_data'] ? 'checked' : '' ?>><br>
    <label>Нулевая сумма</label><input name='amount_null' type='checkbox' value='1' <?= $input_val['amount_null'] ? 'checked' : '' ?>>
    <hr noshade size='1' color='silver'>
    <button type="submit" class='button'>Поиск</button>
    <button type="reset" class='button'>Сброс</button>
    <a href='/import' class='button'>Импорт</a>
    <button type='button' class='button add-billing'>Добавить</button>
</form>
<div class='container'>
    <?php //var_dump($sql);?>
    <table class = 'agency'>
        <thead>
            <tr>
                <th>Наименование сети</th>
                <th>Наименование агенства</th>
                <th>Сумма</th>
                <th>Дата</th>
                <th>Пользователь</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($agency as $r) {
                ?>
                <tr data-billing-id='<?= $r['billing_id'] ?>' class='<?= $r['billing_id'] ? '' : 'no-billing' ?>'>
                    <?php
                    foreach ($r as $k => $f) {

                        if (in_array($k, $f_except))
                            continue;
                        echo "<td>" . ($f ? : '-') . "</td>";
                    }
                    ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

