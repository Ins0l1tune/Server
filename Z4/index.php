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
    setcookie('gender_error', '', 100000);
    // Выводим сообщение.
    $messages['gender'] = 'Заполните пол';
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
    $messages['superpower'] = 'Нелегальная сверхспособность';
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
  $superpower = empty($_COOKIE['superpower_v']) ? array() : json_decode($_COOKIE['superpower_v'], true);
  $values['bio'] = empty($_COOKIE['bio_v']) ? '' : $_COOKIE['bio_v'];
  $values['usercheck'] = empty($_COOKIE['usercheck_v']) ? '' : $_COOKIE['usercheck_v'];

  // Включаем содержимое файла form.php.
  // В нем будут доступны переменные $messages, $errors и $values для вывода 
  // сообщений, полей с ранее заполненными данными и признаками ошибок.
  include('form.php');
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Проверяем ошибки.
  $errors = FALSE;
  if (empty($_POST['fio'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('fio_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('fio_value', $_POST['fio'], time() + 30 * 24 * 60 * 60);
  }



  if ($errors) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  }
  else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('fio_error', '', 100000);
    // TODO: тут необходимо удалить остальные Cookies.
  }

  // Сохранение в БД.
  // ...

  // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');

  // Делаем перенаправление.
  header('Location: index.php');
}
if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}