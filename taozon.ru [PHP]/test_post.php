<?php
if (isset($_POST['body'])) {
	echo 'body:' . $_POST['body'] . '<br /><br />';
} else {
	$_POST['body'] = '<a href="http://ya.ru" target="_blank">test</a>';
}

?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>
		test
    </title>
  </head>
  <body>
    <?php echo $message; ?>
    <form method="post" action="">
      <table>
        <tr>
          <td>
            message
          </td>
          <td>
            <textarea name="body"><?php if (isset($_POST['body'])) { echo $_POST['body']; } ?></textarea>
          </td>
        </tr>
        <tr>
          <td>
            &nbsp;
          </td>
          <td>
            <input type="submit" value="send" name="submit">
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>