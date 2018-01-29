<?
include ("header.php");
//unset($_SESSION['sid']);
?>
<div class="main"><div class="canvas clrfix">
    <h1> <?=LangAdmin::get('authorization_is_required')?>!  </h1> <br/>
    <p></p>
    <?
    if (isset($_POST['login'],$_POST['password'])) {
            echo '<p style="color:red"><strong>'.LangAdmin::get('authorization_error').'!<br />
            '.LangAdmin::get('check_your_username_or_password').'!<br /></strong></p>';
    }
    ?>
    <?
    if (isset($_GET['expired'])) {
        echo '<p style="color:red"><strong>'.LangAdmin::get('session_has_expired_or_is_wrong').'!<br />
            '.LangAdmin::get('need_to_log_in_again').'.<br /></strong></p>';
    }
    ?>
    <?
    if (isset($_SESSION['fatal_error'])) {
        echo '<p style="color:red"><strong>'.$_SESSION['fatal_error'].'!</strong></p>';
    }
    else{
        ?>
        <table class="tauth">
            <form action="index.php" method="post">
                <tr><td><?=LangAdmin::get('your_login')?>:</td>
                    <td><input type="text" name="login" size="32" value="<?=isset($_POST['login'])?htmlspecialchars($_POST['login']):'';?>"/></td>
                </tr>
                <tr><td><?=LangAdmin::get('your_password')?>:</td>
                    <td><input type="password" name="password" size="32" value="<?=isset($_POST['password'])?htmlspecialchars($_POST['password']):'';?>"/></td>
                </tr>
                <tr><td></td><td><input type="submit" value="<?=LangAdmin::get('input')?>" /></td></tr>
            </form>
        </table>
</div></div>
        <?
    }
    ?>

<?
include ("footer.php");
?>

