<?php
/*
    "Голова" сайта.
    Содержит объявление кодировки и "шапку" сайта.
*/
header('Content-Type: text/html; charset=utf-8'); // указываем кодировку
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Тестовое задание для АО "Ксеньевский Прииск"</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
        <div id="header">
            <h2>Тестовое задание для АО "Ксеньевский Прииск"</h2>

            <a href="/index.php">Создание пользователя</a>
            <a href="/users.php">Редактирование пользователей</a>
 
             <div class="clear"></div>
        </div>