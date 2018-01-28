<meta charset="windows-1251">
<style>
#feedback-form {
  max-width: 400px;
  padding: 2%;
  border-radius: 3px;
  background: #f1f1f1;
}
#feedback-form [required] {
  width: 100%;
  -moz-box-sizing: border-box; box-sizing: border-box;
  margin-bottom: 2%;
  padding: 2%;
  border: none;
  border-radius: 3px;
  overflow: auto;
  box-shadow: 0 -1px 0 rgba(0,0,0,.05) inset, 0 1px 2px rgba(0,0,0,.2) inset, 0 0 transparent;
}
#feedback-form [required]:hover {
  box-shadow: 0 0 0 1px #7eb4ea inset, 0 1px 2px rgba(0,0,0,.2) inset, 0 0 transparent;
}
#feedback-form [required]:focus {
  outline: none;
  box-shadow: 0 0 0 1px #7eb4ea inset, 0 1px 2px rgba(0,0,0,.2) inset, 0 0 4px rgba(35,146,243,.5);
  transition: .2s linear;
}
#feedback-form [type="submit"] {
  padding: 2%;
  border: none;
  border-radius: 3px;
  box-shadow: 0 0 0 1px rgba(0,0,0,.2) inset;
  background: #669acc;
  color: #fff;
}
#feedback-form [type="submit"]:hover {
  background: #5c90c2;
}
#feedback-form [type="submit"]:focus {
  box-shadow: 0 1px 1px #fff, inset 0 1px 2px rgba(0,0,0,.8), inset 0 -1px 0 rgba(0,0,0,.05);
}
</style>

<form action="http://uralsb.ru/mail/send.php" method="POST" id="feedback-form">
<input type="hidden" name="to" value="prodlenka.28@bk.ru" >
<input type="hidden" name="from" value="perezvonimne@prodlenka28.ru" >
<input type="hidden" name="sbj" value="Заявка с сайта prodlenka28.ru" >
<input type="hidden" name="fields" value="4" >
Ваше имя *:
<input type="text" name="f1" required placeholder="Как Вас зовут" x-autocompletetype="name">
Ваш телефон *:
<input type="phone" name="f2" required placeholder="Номер телефона" x-autocompletetype="phone">
Удобное время для звонка:
<input type="text" name="f3" required placeholder="8:00 или с 8 до 12" x-autocompletetype="phoроne">
Комментарий:
<textarea name="f4" placeholder="Ваш комментарий" required rows="3"></textarea>
<input type="submit" value="отправить заявку">
</form>