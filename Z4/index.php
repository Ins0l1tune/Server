<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Массив для временного хранения сообщений пользователю.
  $messages = array();
  $messages['username'] = '';
  $messages['user_email'] = '';
  $messages['years'] = '';
  $messages['gender'] = '';
  $messages['userl'] = '';
  $messages['superpower'] = '';
  $messages['bio'] = '';
  $messages['usercheck'] = '';
  $messages['data_saved'] = '';

  // Складываем признак ошибок в массив.
  $errors = array();
  $errors['username'] = !empty($_COOKIE['username_err']);
  $errors['user_email'] = !empty($_COOKIE['user_email_err']);
  $errors['years'] = !empty($_COOKIE['years_err']);
  $errors['gender'] = !empty($_COOKIE['gender_err']);
  $errors['userl'] = !empty($_COOKIE['userl_err']);
  $errors['superpower'] = !empty($_COOKIE['superpower_err']);
  $errors['bio'] = !empty($_COOKIE['bio_err']);
  $errors['usercheck'] = !empty($_COOKIE['usercheck_err']);
  $errors['data_saved'] = !empty($_COOKIE['data_saved_err']);

  if ($errors['username'] == '1') {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('username_err', '', 100000);
    // Выводим сообщение.
    $messages['username'] = 'Укажите своё имя!';
  } else if ($errors['username'] == '2') {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('username_err', '', 100000);
    // Выводим сообщение.
    $messages['username'] = 'Разрешены только буквенные символы!';
  }

  if ($errors['user_email'] == '1') {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('user_email_err', '', 100000);
    // Выводим сообщение.
    $messages['user_email'] = 'Email обязателен!';
  } else if ($errors['user_email'] == '2') {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('user_email_err', '', 100000);
    // Выводим сообщение.
    $messages['user_email'] = 'Неверный формат электронной почты! Верный формат: primer85@test.com.';
  }

  if ($errors['years']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('years_err', '', 100000);
    // Выводим сообщение.
    $messages['years'] = 'Выберите год рождения';
  }

  if ($errors['gender']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('gender_err', '', 100000);
    // Выводим сообщение.
    $messages['gender'] = 'Укажите пол';
  }

  if ($errors['userl']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('userl_err', '', 100000);
    // Выводим сообщение.
    $messages['userl'] = 'Заполните число конечностей';
  }

  if ($errors['superpower']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('superpower_err', '', 100000);
    // Выводим сообщение.
    $messages['superpower'] = 'Укажите суперспособность';
  }


  if ($errors['bio']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('bio_err', '', 100000);
    // Выводим сообщение.
    $messages['bio'] = 'Заполните биографию';
  }

  if ($errors['usercheck']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('usercheck_err', '', 100000);
    // Выводим сообщение.
    $messages['usercheck'] = 'Согласитесь';
  }

  if ($errors['data_saved']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save_err', '', 100000);
    $messages['data_saved'] = "Ошибка отправки: " . $_COOKIE['save_err'];
  }


  // Выдаем сообщение об успешном сохранении.
  if (array_key_exists('save', $_GET) && $_GET['save']) {
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages['data_saved'] = 'Спасибо, результаты сохранены.';
  }


  // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  $values['username'] = empty($_COOKIE['username_v']) ? '' : $_COOKIE['username_v'];
  $values['user_email'] = empty($_COOKIE['user_email_v']) ? '' : $_COOKIE['user_email_v'];
  $values['years'] = empty($_COOKIE['years_v']) ? '' : $_COOKIE['years_v'];
  $values['gender'] = empty($_COOKIE['gender_v']) ? '' : $_COOKIE['gender_v'];
  $values['userl'] = empty($_COOKIE['userl_v']) ? '' : $_COOKIE['userl_v'];
  $superpower = empty($_COOKIE['superpower']) ? array() : implode(',', $_POST['superpower']);
  $values['bio'] = empty($_COOKIE['bio_v']) ? '' : $_COOKIE['bio_v'];
  $values['usercheck'] = empty($_COOKIE['usercheck_v']) ? '' : $_COOKIE['usercheck_v'];

  // Включаем содержимое файла form.php.
  // В нем будут доступны переменные $messages, $errors и $values для вывода 
  // сообщений, полей с ранее заполненными данными и признаками ошибок.
  include('form.php');
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //Переменные формы:
  $username = $_POST['username'];
  $user_email = strtolower($_POST['user_email']);
  $years = $_POST['years'];
  $gender = $_POST['gender'];
  $userl = $_POST['userl'];
  $superpower = implode(',', $_POST['superpower']);
  $bio = $_POST['bio'];

  // Проверяем ошибки в поле ИМЕНИ.
  $errors = FALSE;
  if (preg_match('/([а-яА-ЯЁёa-zA-Z ]+)$/u', $_POST['username'])) {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('username_v', $username, time() + 30 * 24 * 60 * 60);
  } else { if (empty($_POST['username'])) {
    // Выдаем куку на день с флажком об ошибке в поле name.
    setcookie('username_err', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    // Выдаем куку на день с флажком об ошибке в поле name.
    setcookie('username_err', '2', time() + 24 * 60 * 60);
    $errors = TRUE;
  }}

  if (preg_match('/[\w]+@[a-zA-Z]+\.[a-zA-Z]+/i', $_POST['user_email'])) {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('user_email_v', $user_email, time() + 30 * 24 * 60 * 60);
  } else { if (empty($_POST['user_email'])) {
    // Выдаем куку на день с флажком об ошибке в поле email.
    setcookie('user_email_err', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    // Выдаем куку на день с флажком об ошибке в поле email.
    setcookie('user_email_err', '2', time() + 24 * 60 * 60);
    $errors = TRUE;
  }}

  // Проверяем ошибки в поле ГР.
  if (empty($years)) {
    // Выдаем куку на день с флажком об ошибке в поле bdate.
    setcookie('years_err', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('years_v', $years, time() + 30 * 24 * 60 * 60);
  }

  // Проверяем ошибки в поле ПОЛ.
  if (empty($gender)) {
    // Выдаем куку на день с флажком об ошибке в поле gender.
    setcookie('gender_err', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('gender_v', $gender, time() + 30 * 24 * 60 * 60);
  }

  // Проверяем ошибки в поле КОНЕЧНОСТИ.
  if (empty($userl)) {
    // Выдаем куку на день с флажком об ошибке в поле limbs.
    setcookie('userl_err', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('userl_v', $userl, time() + 30 * 24 * 60 * 60);
  }

  //Проверяем ошибки в поле СУПЕРСПОСОБНОСТИ
  if (empty($superpower)) {
    // Выдаем куку на день с флажком об ошибке в поле superpowers.
    setcookie('superpower_err', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('superpower_v', $superpower, time() + 30 * 24 * 60 * 60);
  }

  // Проверяем ошибки в поле БИОГРАФИЯ
  if (empty($bio)) {
    // Выдаем куку на день с флажком об ошибке в поле bio.
    setcookie('bio_err', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('bio_v', $bio, time() + 30 * 24 * 60 * 60);
  }

  // Проверяем ошибки CHECKBOX
  if (empty($_POST['usercheck'])) {
    // Выдаем куку на день с флажком об ошибке в поле checkbox.
    setcookie('usercheck_err', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  } else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('usercheck_v', $_POST['usercheck'], time() + 30 * 24 * 60 * 60);
  }


  if ($errors) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  } else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('username_err', '', 100000);
    setcookie('user_email_err', '', 100000);
    setcookie('years_err', '', 100000);
    setcookie('gender_err', '', 100000);
    setcookie('userl_err', '', 100000);
    setcookie('superpower_err', '', 100000);
    setcookie('bio_err', '', 100000);
    setcookie('usercheck_err', '', 100000);
  }

  //Параметры для подключения
  $user = 'u47480';
  $pass = '6816416';

  try {
    //Подключение к базе данных. Подготовленный запрос. Именованные метки.
    $db = new PDO('mysql:host=localhost;dbname=u47480', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
    $stmt1 = $db->prepare("INSERT INTO userform (username, user_email, years, gender, userl, bio) VALUES (:username, :user_email, :years, :gender, :userl, :bio)");
    $stmt1->execute(['username' => $username, 'user_email' => $user_email, 'years' => $years, 'gender' => $gender, 'userl' => $userl, 'bio' => $bio]);
    print_r($stmt1->errorInfo());
    $stmt2 = $db->prepare("INSERT INTO userpowers (superpower) VALUES (:superpower)");
    $stmt2->execute(['superpower' => $superpower]);
    print_r($stmt2->errorInfo());
    $id = $db->lastInsertId();
    echo "Данные успешно сохранены. ID:" . $id;
  } catch (PDOException $e) {
    setcookie('save_error', '$e->getMessage()', 100000);
    header('Location: index.php');
    exit();
  }
  // Делаем перенаправление.
  header('Location: index.php?save=1');
}