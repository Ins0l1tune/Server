<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
    print('Спасибо, результаты сохранены.');
  }
  // Включаем содержимое файла form.php.
  include('form.php');
  // Завершаем работу скрипта.
  exit();
}

$errors = FALSE;
if (empty($_POST['user-name'])) {
  print('Заполните имя.<br/>');
  $errors = TRUE;
} else if (empty($_POST['user-email'])) {
  print('Заполните e-mail.<br/>');
  $errors = TRUE;
} else if (!preg_match("/[a-z0-9]+@[a-z0-9]+\.[a-z]+/i", $_POST['e-mail'])) {
  print('Введите корректный e-mail.<br/>');
  $errors = TRUE;
} else if (empty($_POST['user-birth'])) {
  print('Заполните дату рождения.<br/>');
  $errors = TRUE;
} else if (empty($_POST['gender'])) {
  print('Заполните пол.<br/>');
  $errors = TRUE;
} else if (empty($_POST['user-l'])) {
  print('Заполните число конечностей.<br/>');
  $errors = TRUE;
} else if (empty($_POST['bio'])) {
  print('Заполните биографию.<br/>');
  $errors = TRUE;
} else if (empty($_POST['user-policy'])) {
  print('Согласитесь с контрактом.<br/>');
  $errors = TRUE;
}

if ($errors) {
  // При наличии ошибок завершаем работу скрипта.
  exit();
}

//Переменные с формы:
$user_name = $_POST['user-name'];
$usere_mail = strtolower($_POST['user-email']);
$user_birth = $_POST['user-birth'];
$gender = $_POST['gender'];
$user_l = $_POST['user-l'];
$superpowers = implode(',', $_POST['superpower']);
$bio = $_POST['bio'];
//Параметры для подключения
$user = 'u47480';
$pass = '6816416';

try {
	//Подключение к базе данных. Подготовленный запрос. Не именованные метки.
	$db = new PDO('mysql:host=localhost;dbname=u47480', $user,$pass, array(PDO::ATTR_PERSISTENT => true));
  $db->exec("setnames utf8");

  $stmt = $db->prepare("INSERT INTO form (user_name, user_mail, user_birt, gender, user_l, superpowers, bio) VALUES (:user_name, :user_mail, :user_birt, :gender, :user_l, :superpowers, :bio);");
  $stmt -> execute([
    'name' => $name,
    'user-name' => $user_name,
    'user-email' => $user_email,
    'user-birth' => $user_birth,
    'gender' => $gender,
    'user_l' => $user_l,
    'superpowers' => $superpowers,
    'bio' => $bio
  ]);
  $id = $db->lastInsertId();
  echo "Данные успешно сохранены." . $id;
}
catch(PDOException $e){
  //Если есть ошибка соединения, выводим её:
  print('Error : ' . $e->getMessage());
  exit();
}