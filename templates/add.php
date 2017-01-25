
<div><small><?= !$billing ? 'Добавление' : 'Редактирование' ?></small></div>
<hr noshade size='1' color='silver'>
<form id="billing_add" action='/add_edit/<?= $billing['id'] ? : '' ?>' method="post">
    <label>Агентство</label>
    <select name='agency_id' class='input'>
        <?php foreach ($agency as $ag) { ?>
            <option value='<?= $ag['agency_id'] ?>' <?= $billing['agency_id'] == $ag['agency_id'] ? 'selected' : '' ?>><?= $ag['agency_name'] ?></option>
        <?php } ?>
    </select><br>
    <label>Пользователь</label>
    <select name='user_id' class='input'>
        <?php foreach ($users as $u) { ?>
            <option value='<?= $u['user_id'] ?>' <?= $billing['user_id'] == $u['user_id'] ? 'selected' : '' ?>><?= $u['user_name'] ?></option>
        <?php } ?>
    </select><br>
    <label>Сумма</label><input type='text' name='amount' class='input' value="<?= $billing['amount'] ?>">
    <hr noshade size='1' color='silver'>
    <button type="submit" class='button'>OK</button>
    <button type="reset" class='button'>Сброс</button>
    <?php if ($billing) { ?>
        <a href='/delete/<?= $billing['id'] ?>' class='button delete_billing'>Удалить</a>
    <?php } ?>
</form>


