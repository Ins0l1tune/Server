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
    print('Результаты сохранены!');
  }
  // Включаем содержимое файла form.php.
  include('form.php');
  // Завершаем работу скрипта.
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//Переменные формы:
$user_name = $_POST['user-name'];
$usere_mail = strtolower($_POST['user-email']);
$year = $_POST['year'];
$gender = $_POST['gender'];
$user_l = $_POST['user-l'];
$superpowers = implode(',', $_POST['superpower']);
$bio = $_POST['bio'];

$errors = FALSE;
  // Проверка, на пустоту поля
  if (empty($_POST["user-name"])) {
    $nameErr = "Укажите своё имя!";
    $errors = TRUE;
  } else {
    $user_name = test_input($_POST["user-name"]);
    // Проверка, содержит ли имя только буквы и пробелы
    if (!preg_match("/^[a-яA-Я ]$/", $user_name)) {
      $nameErr = "Разрешена только кирилица и пробелы!";
      $errors = TRUE;
    }
  }

  if (empty($_POST["user-email"])) {
    // Проверка, на пустоту поля
    $emailErr = "Email обязателен!";
    $errors = TRUE;
  } else {
    $email = test_input($_POST["user-email"]);
    // Проверка, правильно ли сформирован адрес электронной почты
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Неверный формат электронной почты";
      $errors = TRUE;
    }
  }

  if (empty($_POST["year"])) {
    // Проверка, на пустоту поля
    $yErr = "Указание года рождения - обязательно!";
    $errors = TRUE;
  } else {
    $year = test_input($_POST["year"]);
    // Проверка на иные символы в поле даты рождения
    if (!preg_match("/^\d+$/", $year)) {
      $yErr = "Попали посторонние символы";
      $errors = TRUE;
    }
  }

  if (empty($_POST["gender"])) {
    // Проверка, на пустоту поля
    $genderErr = "Пол обязателен";
    $errors = TRUE;
  }

  if (empty($_POST["user-l"])) {
    // Проверка, на пустоту поля
    $lErr = "Выбор обязателен! Если у вас отсутствуют конечности, тогда вы нам не подходите.";
    $errors = TRUE;
  }

  if (empty($_POST["superpowers"])) {
    // Проверка, на пустоту поля
    $SPErr = "Выбор из предложенного списка обязателен";
    $errors = TRUE;
  }

  if (empty($_POST["bio"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["bio"]);
  }

  if ($errors) {
    // При наличии ошибок - выводим их и завершаем работу скрипта.
    print('Error : ' . $nameErr->getMessage());
    print('Error : ' . $emailErr->getMessage());
    print('Error : ' . $yErr->getMessage());
    print('Error : ' . $genderErr->getMessage());
    print('Error : ' . $lErr->getMessage());
    print('Error : ' . $SPErr->getMessage());
    exit();
  }

//Параметры для подключения
$user = 'u47480'; $pass = '6816416';

try {
	//Подключение к базе данных. Подготовленный запрос. Не именованные метки.
	$db = new PDO('mysql:host=localhost;dbname=u47480', $user,$pass, array(PDO::ATTR_PERSISTENT => true));
  $db->exec("setnames utf8");

  $stmt = $db->prepare("INSERT INTO form (user_name, user_mail, user_birt, gender, user_l, superpowers, bio) VALUES (:user_name, :user_mail, :user_birt, :gender, :user_l, :superpowers, :bio);");
  $stmt -> execute(['user-name' => $user_name,'user-email' => $user_email, 'year' => $user_birth,'gender' => $gender,'user_l' => $user_l,'superpower' => $superpowers,'bio' => $bio]);
  $id = $db->lastInsertId();
  echo "Данные успешно сохранены." . $id;
}
catch(PDOException $e){
  //Если есть ошибка соединения, выводим её:
  print('Error : ' . $e->getMessage());
  exit();
}
}