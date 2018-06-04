<?php
  /* Принимаем данные из формы */
  include("connection.php");// Подключается к базе данных
  $name = $_POST["name"];
  $email = $_POST["email"];
  $subject = $_POST["subject"];
  $message = $_POST["message"];
  $page_id = $_POST["page_id"];
  $name = htmlspecialchars($name);// Преобразуем спецсимволы в HTML-сущности
  $message = htmlspecialchars($message);// Преобразуем спецсимволы в HTML-сущности
  $request = "INSERT INTO contact ( name, email, subject, message, page_id) VALUES 
  ( '".$name."', '".$email."','".$subject."', '".$message."',  '".$page_id."')";// Добавляем комментарий в таблицу
mysql_query($request);
mysql_close($con);
header("Location: index.php");
?>