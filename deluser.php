<?php
	
	/*
	Страница удаления пользователя.
	Получает id пользователя и удаляет запись из базы данных.
	*/

	//Запускаем сессию
    session_start();
    //Добавляем файл подключения к БД
    require_once("dbconnect.php");
    $_SESSION["error_messages"] = '';
    $_SESSION["success_messages"] = '';

    if(isset($_GET["userid"]) && !empty($_GET["userid"])){
    	$userid = $_GET["userid"];
    	$query = "DELETE FROM Users WHERE id = '$userid'";
    	$result_query_insert = $mysqli->query($query);
    }

	if(!$result_query_insert){
		$_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на удаление пользователя</p>";
		header("HTTP/1.1 301 Moved Permanently");
    	header("Location: ".$_SERVER['HTTP_REFERER']);
    	exit();
	} else {
		$_SESSION["success_messages"] = "<p class='success_message'>Пользователь удален</p>";
		header("HTTP/1.1 301 Moved Permanently");
    	header("Location: ".$_SERVER['HTTP_REFERER']);
    	exit();
	}
	/* Завершение запроса */
	$result_query_insert->close();

	//Закрываем подключение к БД
	$mysqli->close();