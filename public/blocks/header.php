<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
    <?php foreach ($config['styles'] AS $style):?>
        <link rel="stylesheet" href="<?=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http').'://' . $_SERVER['HTTP_HOST']."/".$style?>">
    <?php endforeach;?>
    <?php foreach ($config['scripts'] AS $script):?>
        <script type="application/javascript" src="<?=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http').'://' . $_SERVER['HTTP_HOST']."/".$script?>"></script>
    <?php endforeach;?>
</head>
<body>
    <div id="container">
        <?php if(!empty($_SESSION['error'])):?>
            <div class="alert alert-danger" role="alert"><?=$_SESSION['error']?></div>
        <?php endif;?>

        <?php if(!empty($_SESSION['info'])):?>
            <div class="alert alert-success" role="alert"><?=$_SESSION['info']?></div>
        <?php endif;?>
        <div id="container_header">
            <div id="logout_header">
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <h1 class="container_title"><?=$title?></h1>
                        </td>
                        <td style="width: 1%;">
                            <?php if(isset($_SESSION['AUTH']['auth'])):?>
                                <?php if(!isset($_REQUEST['action']) OR $_REQUEST['action'] != 'changepassword'): ?>
                                    <form method="get">
                                        <input type="hidden" name="action" value="changepassword" />
                                        <input type="submit" value="Смена пароля" />
                                    </form>
                                <?php else:?>
                                    <form method="get">
                                        <input type="hidden" name="action" value="changepassword" />
                                        <input type="button" onclick="window.location.href = '/'" value="Назад" />
                                    </form>
                                <?php endif;?>
                            <?php else:?>
                                <?php if(isset($_REQUEST['action']) AND $_REQUEST['action'] == 'registration'):?> 
                                    <input type="button" onclick="window.location.href = '/'" value="Назад" />
                                <?php endif;?>
                            <?php endif;?>
                        </td>
                        <td style="width: 1%; padding-left: 10px;">
                            <?php if(isset($_SESSION['AUTH']['auth'])):?>
                                <form method="post">
                                    <input type="hidden" name="action" value="logout" />
                                    <input type="submit" value="Выход" />
                                </form>
                            <?php endif;?>
                        </td>
                    <tr>
                </table>
            </div>
        </div>