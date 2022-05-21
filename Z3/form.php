<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Задание 3</title>
	<link rel="stylesheet" href="style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
	<header>
		<div class="container">
			<img src="logo.svg" width="115" height="115" alt="Лого">
			<p class="title"> <b>Прогресс</b> <br>
				<small class="title_sub">Научно-исследовательский институт </small>
			</p>
		</div>
	</header>
	<nav>
		<div class="container">
			<ul class="nav-list">
				<li class="nav-list__item"><a href="#">Главная</a></li>
				<li class="nav-list__item"><a href="#">Направления</a></li>
				<li class="nav-list__item"><a href="#">Проекты</a></li>
				<li class="nav-list__item"><a href="#">Контакты</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<h2>Заявка на сотрудничество</h2>
		<form action="index.php" method="POST">
			<div class="form-field">
				<label for="user-name">Имя</label>
				<br />
				<input type="text" name="username" id="user-name">
				<br />
			</div>
			<div class="form-field">
				<label for="user-email">E-mail</label>
				<br />
				<input type="email" name="user_email" id="user-email">
				<br />
			</div>
			<div class="form-field">
				<label>Год рождения</label>
				<?php // устанавливаем первый и последний год диапазона 
				$yearArray = range(1920, 2050);
				?>
				<select name="years" class="select-dropdown">
					<option value="">Выберите год</option>
					<?php
					foreach ($yearArray as $year) {
						echo '<option ' . $selected . ' value="' . $year . '">' . $year . '</option>';
					}
					?>
				</select>
			</div>
			<div class="form-field">
				<span>Пол:</span>
				<br>
				<input type="radio" checked="checked" name="gender" id="user-male" value="М">
				<label for="user-male">Мужской</label>
				<input type="radio" name="gender" id="user-female" value="Ж">
				<label for="user-female">Женский</label>
			</div>
			<div class="form-field">
				<span>Кол-во конечностей:</span>
				<br>
				<input type="radio" name="userl" id="user-l-2" value="2">
				<label for="user-l-2">2</label>
				<input type="radio" name="userl" id="user-l-3" value="3">
				<label for="user-l-3">3</label>
				<input type="radio" checked="checked" name="userl" id="user-l-4" value="4">
				<label for="user-l-4">4</label>
			</div>
			<div class="form-field">
				<select multiple size="4" name="superpower[]" class="select-list">
					<option value="Бессмертие">Бессмертие</option>
					<option value="Прохождение сквозь стены">Прохождение сквозь стены</option>
					<option value="Левитация">Левитация</option>
					<option value="Невидимость">Невидимость</option>
					<option value="Пирокинез">Пирокинез</option>
					<option value="Нет в списке">Нет в списке</option>
				</select>
			</div>
			<div class="form-field">
				<span>Биография:</span>
				<br>
				<textarea name="bio" cols="30" rows="10" style="resize: none;"></textarea>
			</div>
			<div class="form-field">
				<input type="checkbox" name="user-policy" id="user-policy">
				<label for="user-policy">С <a href="#">контрактом</a> ознакомлен</label>
			</div>
			<div class="form-field">
				<input type="submit" id="user-submit" value="ok">
			</div>
		</form>
	</div>
	<footer>
		<div class="container">
			<span class="title_sub">2021 - НИИ "Прогресс"</span>
		</div>
	</footer>
</body>

</html>