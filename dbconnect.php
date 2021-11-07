<?php
/*
	Файл используется для подключения базы данных
*/
	$server = "localhost";
	$username = "root"; // Пользователь бд
	$password = "";
	$database = "kpgold"; // Имя базы данных

	// Подключаемся к бд
	$mysqli = new mysqli($server, $username, $password, $database);

	// Проверяем подключение
	if ($mysqli->connect_errno) {
		die('Ошибка подключения к БД: '. $mysqli->connect_errno.'<br>'.$$mysqli->connect_error.'<br>');
	}

	// Устанавливаем кодировку подключения
    $mysqli->set_charset('utf8');
 
    // Адрес (URL) сайта
    //$address_site = "http://kpgold.test";