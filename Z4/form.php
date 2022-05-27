<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Задание 4</title>
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
  	<?php
	if (!empty($messages)) {
		print('<div id="messages">');
		// Выводим все сообщения.
		foreach ($messages as $message) {
			print($message);
		}
		print('</div>');
	} 
	?>
  <!-- Выводим форму отмечая элементы с ошибками классом error и задавая начальные значения элементов ранее сохраненными. -->
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
        <input type="text" name="username" id="user-name" <?php if ($errors['username']) {print 'class="error"';} ?>
         value="<?php print $errors['username'] ? $messages['username'] : $values['username']; ?>" />
        <br />
      </div>
      <div class="form-field">
        <label for="user-email">E-mail</label>
        <br />
        <input type="email" name="user_email" id="user-email" <?php if ($errors['user_email']) {print 'class="error"';} ?>
         value="<?php print $errors['user_email'] ? $messages['user_email'] : $values['user_email']; ?>" />
        <br />
      </div>
      <div class="form-field">
        <label>Год рождения
          <p <?php if ($errors['years']) {print 'class="error"';} ?> > <?php if ($messages['years']) print $messages['years']; ?> </p>
        </label>
				<?php // Устанавливаем первый и последний год диапазона:
				$yearArray = range(1920, 2050);
				?>
				<select name="years" class="select-dropdown">
					<option value="">Выберите год</option>
					<?php
					//Перебора массива (создаются пункты списка (года с 1920 по 2050)):
					foreach ($yearArray as $year) {
						echo '<option ' . $selected . ' value="' . $year . '">' . $year . '</option>';
					}
          if (strval($year) == $values['years']) {
            print 'selected';
          }
					?>
        </select>
      </div>
      <div class="form-field">
        <span>Пол:</span>
        <br>
        <p <?php if ($errors['gender']) {print 'class="error"';} ?>>
          <?php if ($messages['gender']) print $messages['gender']; ?>
        </p>
        <input type="radio" checked="checked" name="gender" id="user-male" value="М">
        <label for="user-male">Мужской</label>
        <input type="radio" name="gender" id="user-female" value="Ж">
        <label for="user-female">Женский</label>
      </div>
      <div class="form-field">
        <span>Кол-во конечностей:</span>
        <br>
        <p <?php if ($errors['userl']) {print 'class="error"';} ?>>
          <?php if ($messages['userl']) print $messages['userl']; ?>
        </p>

        <input type="radio" name="userl" id="user-l-2" value="2" 
        <?php if ($errors['userl']) {print 'class="error"';} 
        else 
          if ($values['userl'] == 2) {print 'checked';} ?>>
        <label for="user-l-2">2</label>

        <input type="radio" name="userl" id="user-l-3" value="3" 
        <?php if ($errors['userl']) {print 'class="error"';} 
        else
          if ($values['userl'] == 3) {print 'checked';} ?>>
        <label for="user-l-3">3</label>

        <input type="radio" checked="checked" name="userl" id="user-l-4" value="4" 
        <?php if ($errors['userl']) {print 'class="error"';} 
        else 
          if ($values['userl'] == 4) {print 'checked';} ?>>
        <label for="user-l-4">4</label>

      </div>
      <div class="form-field">
        <span>Сверхспособности</span>
				<br>
        <p <?php if ($errors['superpower']) {print 'class="error"';} ?> >
          <?php if ($messages['superpower']) print $messages['superpower']; ?> 
        </p>
        <select multiple size="4" name="superpower[]" class="select-list">
          <option value="Бессмертие" <?php if (in_array("Бессмертие", $superpower)) {print 'selected';} ?>>
          Бессмертие</option>
          <option value="Прохождение сквозь стены" <?php if (in_array("Прохождение сквозь стены", $superpower)) {print 'selected';} ?>>
          Прохождение сквозь стены</option>
          <option value="Левитация" <?php if (in_array("Левитация", $superpower)) {print 'selected';} ?>>
          Левитация</option>
          <option value="Невидимость" <?php if (in_array("Невидимость", $superpower)) {print 'selected';} ?>>
          Невидимость</option>
          <option value="Пирокинез" <?php if (in_array("Пирокинез", $superpower)) {print 'selected';} ?>>
          Пирокинез</option>
          <option value="Отсутствуют" <?php if (in_array("Отсутствуют", $superpower)) {print 'selected';} ?>>
          Нет в списке</option>
        </select>
      </div>
      <div class="form-field">
        <span>Биография:</span>
        <br>
        <textarea name="bio" cols="30" rows="10" style="resize: none;" <?php if ($errors['bio']) {print 'class="error"';} ?> > 
          <?php if ($messages['bio']) {print $messages['bio'];} else {print $values['bio'];} ?>
        </textarea>
      </div>
      <div class="form-field">
        <label class="field-name">
          <p <?php if ($errors['usercheck']) {print 'class="error"';} ?> > 
            <?php if ($messages['usercheck']) {print $messages['usercheck'];} ?> 
          </p>
        </label>
        <input type="checkbox" name="usercheck" id="user-policy" <?php if ($errors['usercheck']) {print 'class="error"';} ?> <?php if ($values['usercheck']) {print 'usercheck';} ?> >
        <label for="user-policy">С <a href="#">контрактом</a> ознакомлен</label>
      </div>
      <div class="form-field">
        <input type="submit" class="submit" id="user-submit" value="ok" >
        <p style="color:forestgreen;">
          <?php if ($messages['data_saved']) {print $messages['data_saved'];} ?>
        </p> 
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