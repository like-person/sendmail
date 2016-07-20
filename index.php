<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>Форма обратной связи</title>
	
	<link rel="stylesheet" href="css/styles.css">
    <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
	<script src="js/scripts.js" ></script>
</head>
<body>
	<form action="sendmail.php" method="post">
	    <div class="form">
            <h1>Форма обратной связи</h1>
            <div class="desc">Поля помеченные * обязательны к заполнению</div>
            <label class="required">ФИО*<input type="text" value="" name="name" required></label>
            <label class="required">Телефон*<input type="text" value="" name="phone" required></label>
            <label class="required">E-mail*<input type="email" value="" name="email" required></label>
	        <label>Комментарий<textarea name="comment" id="" cols="30" rows="7"></textarea></label>
	        <input type="submit" name="button" value="Отправить">
	        <div class="message"></div>
	    </div>
	</form>
</body>
</html>