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
    // Проверка, содержит ли имя только буквы и пробелы
    if (!preg_match('/([а-яА-ЯЁёa-zA-Z ]+)$/u', $user_name)) {
      $nameErr = "Разрешена только буквенные символы!";
      $errors = TRUE;
    }
  }

  if (empty($_POST["user-email"])) {
    // Проверка, на пустоту поля
    $emailErr = "Email обязателен!";
    $errors = TRUE;
  } else {
    // Проверка, правильно ли сформирован адрес электронной почты
    if (!preg_match('/[\w]+@[a-zA-Z]+\.[a-zA-Z]+/i', $email)) {
      $emailErr = "Неверный формат электронной почты";
      $errors = TRUE;
    }
  }

  if (empty($_POST["year"])) 
    // Проверка, на пустоту поля
    $yErr = "Указание года рождения - обязательно!";
    $errors = TRUE;
  } else {
    // Проверка на иные символы в поле даты рождения
    if (!preg_match('/\d+/', $year)) {
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
    $comment = "-";
  }

  if ($errors) {
    // При наличии ошибок - выводим их и завершаем работу скрипта.
    print('Error : ' . $nameErr);
    print('Error : ' . $emailErr);
    print('Error : ' . $yErr);
    print('Error : ' . $genderErr);
    print('Error : ' . $lErr);
    print('Error : ' . $SPErr);
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

//$назв.пер. = strtolower($_POST['что-то']); преобразование стр. в нижний регистр
