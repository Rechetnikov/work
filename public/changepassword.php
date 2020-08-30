<div id="authorization">
    <form method='post'>
        <input type="hidden" name="action" value="updatepassword" />
        <table>
            <tr>
                <td>
                    <label>Старый пароль:</label>
                </td>
                <td style="padding-left: 10px;">
                    <input class="form-control" type="password" name="old_password" value = "" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Новый пароль:</label>
                </td>
                <td style="padding-left: 10px;">
                    <input class="form-control" type="password" name="new_password" value = "" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Повторить пароль:</label>
                </td>
                <td style="padding-left: 10px;">
                    <input class="form-control" type="password" name="retry_password" value = "" />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <br /><input type="submit" value = "Изменить" />
                </td>
            </tr>
        </table>
    </form>
</div>