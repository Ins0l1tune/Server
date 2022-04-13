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
		<form action="" method="POST">
			<div class="form-field">
				<label for="user-name">Имя</label>
				<br />
				<input type="text" name="user-name" id="user-name">
				<br />
			</div>
			<div class="form-field">
				<label for="user-email">E-mail</label>
				<br />
				<input type="email" name="user-email" id="user-email">
				<br />
			</div>
			<div class="form-field">
				<label for="user-birth">Год рождения</label>
				<select name="user-birth[]" class="select-dropdown">
					<?php
					$options = array();
					for ($i = 1922; $i <= 2022; $i++) {
						$options[] = $i;
					}
					foreach ($options as $option) {
					?>
						<option value=<?php echo $option; ?>>
							<?php echo $option; ?>
						</option>
					<?php
					}
					?>
				</select>
			</div>
			<div class="form-field">
				<span>Пол:</span>
				<br>
				<input type="radio" checked="checked" name="gender" id="user-male">
				<label for="user-male">Мужской</label>
				<input type="radio" name="gender" id="user-female">
				<label for="user-female">Женский</label>
			</div>
			<div class="form-field">
				<span>Кол-во конечностей:</span>
				<br>
				<input type="radio" name="user-l" id="user-l-2">
				<label for="user-l-2">2</label>
				<input type="radio" checked="checked" name="user-l" id="user-l-4">
				<label for="user-l-4">3</label>
				<input type="radio" name="user-l" id="user-l-8">
				<label for="user-l-8">4</label>
			</div>
			<div class="form-field">
				<select multiple="superpowers">
					<option value="1">Бессмертие</option>
					<option value="2">Прохождение сквозь стены</option>
					<option value="3">Левитация</option>
					<option value="4">Невидимость</option>
					<option value="5">Пирокинез</option>
					<option value="0">Нет/Нет в списке</option>
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
				<input type="submit" id="user-submit">
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