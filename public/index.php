<div id="authorization">
    <table>
        <tr>
            <td  colspan="3">
                <label>ID:</label> <?=$_SESSION['AUTH']['id']?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <label>Email:</label> <?=$_SESSION['AUTH']['email']?>
            </td>
        </tr> 
        <tr>
            <td colspan="3">
                <label>Логин:</label> <?=$_SESSION['AUTH']['login']?>
            </td>
        </tr> 
        <tr>
            <td><label>ФИО:</label></td>
            <td><input class="form-control" id='fio' type="text" value="<?=$_SESSION['AUTH']['fio']?>" /></td>
            <td>
                <button class="btn btn-info" rel="<?=$_SESSION['AUTH']['id']?>" id='edit_fio'>Изменить</button>
            </td>
        </tr> 
    </table>
</div>


