<div id="authorization">
    <form method='post'>
        <input type="hidden" name="action" value="adduser" />
        <table class='registr'>
            <tr>
                <td style="padding-left: 10px;">
                    <input class="form-control" type="text" name="login" placeholder="Логин *" value = "<?=(isset($old['login']) ? $old['login'] : '')?>" /><br />
                </td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">
                    <input class="form-control" type="text" name="email" placeholder="E-mail *" value = "<?=(isset($old['email']) ? $old['email'] : '')?>" /><br />
                </td>
            </tr>

            <tr>
                <td style="padding-left: 10px;">
                    <input class="form-control" type="fio" name="fio" placeholder="ФИО *" value = "<?=(isset($old['fio']) ? $old['fio'] : '')?>" /><br />
                </td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">
                    <input class="form-control" type="password" name="password" placeholder="Пароль *" value = "" /><br />
                </td>
            </tr>
            <tr>
                <td style="padding-left: 10px;">
                    <input class="form-control" type="password" name="retry_password" placeholder="Повторить пароль *" value = "" /><br />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <br /><input type="submit" value = "Добавить" />
                </td>
            </tr>
        </table>
    </form>
</div>