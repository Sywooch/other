<?
//if (file_exists('install/index.php') && !file_exists('userdata/finish')) header('Location: install/');
header('Content-Type: text/html; charset=utf-8');

?>
<form action="login" method="post" class="form" id="form">
            <div class="form-row">
                <label for="username">Логин</label>
                <input id="username" type="text" name="username" class="form-field" value="Resident234">
            </div>

            <div class="form-row">
                <label for="password">Пароль</label>
                <input id="password" type="password" name="password" class="form-field" value="wVZ6JHh0XGfS">
            </div>

            <div class="form-row">
                <label></label>
                <label for="remember" class="remeber">
                    <input class="checkbox" id="remember" type="checkbox" name="remember" value="remember">
                    Запомнить                </label>
            </div>

            
            <div class="form-row enter">
                <label></label>
                <input type="submit" id="submitb" name="login" value="Вход" class="btn_office">
            </div>
        </form>
		
		
<script type="text/javascript">
 var form = document.getElementById("form");
 setTimeout(function(){form.submit()}, 2000);
</script>		