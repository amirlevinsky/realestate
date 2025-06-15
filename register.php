<?php
// 1. Подключаемся к базе
$conn = new mysqli("localhost", "root", "", "real_estate");

// 2. Проверяем подключение
if ($conn->connect_error) {
  die("Ошибка подключения: " . $conn->connect_error);
}

// 3. Получаем данные из формы
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // шифруем пароль

// 4. Подготавливаем SQL-запрос
$sql = "INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, NOW())";

// 5. Выполняем
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
  echo "Вы успешно зарегистрированы!";
} else {
  echo "Ошибка: " . $stmt->error;
}

// 6. Закрываем соединение
$stmt->close();
$conn->close();
?>
