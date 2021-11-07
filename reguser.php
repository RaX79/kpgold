<?php
/*
	Страница регистрации пользователей.
	Получает данные из форм index.php и reduser.php, проверяет введенные данные на корректность и записывает в базу данных, либо возвращает на предыдущую страницу с сообщением об ошибке.
*/
    //Запускаем сессию
    session_start();
 
    //Добавляем файл подключения к БД
    require_once("dbconnect.php");
 
    //Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
    $_SESSION["error_messages"] = '';
 
    //Объявляем ячейку для добавления успешных сообщений
    $_SESSION["success_messages"] = '';
    

	//Проверяем была ли отправлена форма.
    if(isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])){
 		// Проверяем пришедшие в форме данные и записываем в переменные
 		$first_name = check_names("first_name", "имя");
 		$second_name = check_names('second_name', 'отчество');
 		$last_name = check_names('last_name','фамилия');
 		$birth = validate_date('birth', 'дата рождения');
 		$unit = check_names('unit','подразделение');

 		// определяем пол: мужчина - правда, женщина - нет
 		if(isset($_POST["sex"]) && !empty($_POST["sex"])) {
 			$s = $_POST["sex"];
 			if ($s == "men") { $sex = true;	}
 			else { $sex = false; }
 		} else {
 			//если поле пустое, возвращаем пользователя обратно с сообщением об ошибке
 			$_SESSION["error_messages"] .= '<p class="mesage_error">Поле "пол" не заполнено</p>';
 			return_back();
 		}

 		// Запрос на добавления пользователя в БД

 		// Если получили ID пользователя, которого надо редактировать, выполняем запрос на редактирование
 		// иначе записываем как нового пользователя
 		if(isset($_GET["userid"]) && !empty($_GET["userid"])){
 			$userid = $_GET['userid'];
 			// Для удобства запрос записан в переменную
 			$upd_query = "UPDATE users SET firstName = '$first_name', secondName = '$second_name', lastName = '$last_name', birth = '$birth', sex = '$sex', unit = '$unit' WHERE id = '$userid'";
 			$result_query_insert = $mysqli->query($upd_query);
 		} else {
			$result_query_insert = $mysqli->query("INSERT INTO `users` (firstName, secondName, lastName, birth, sex, unit) VALUES ('".$first_name."', '".$second_name."', '".$last_name."', '".$birth."', '".$sex."', '".$unit."')");
		}

		// Если ошибок нет, возвращаем с сообщением об успехе, иначе возвращаем с сообщением об ошибке
		if(!$result_query_insert){
    		$_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на добавления пользователя в БД</p>";
    		return_back();
		} else {
    		$_SESSION["success_messages"] = "<p class='success_message'>Пользователь добавлен</p>";
 			return_back();
		}
    }else{
         exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");
    }


/*
	Пользовательская функция.
	Выполняет проверку строки в массиве POST на существование, на пустоту, обрезает лишние символы и возврщает строку, либо отправляет пользователя обратно с сообщением об ошибке 
	Принимает два параметра: 
		1. Имя переменной в массиве POST.
		2. Понятное человеку название переменной для включения в сообщение об ошибке.
*/
function check_names($chk_name, $field_name) {
	if(isset($_POST[$chk_name])){
		//Обрезаем пробелы с начала и с конца строки
   		$the_name = trim($_POST[$chk_name]);
   		//Проверяем переменную на пустоту
   		if(!empty($the_name)){
       		// Для безопасности, преобразуем специальные символы в HTML-сущности
        	$the_name = htmlspecialchars($the_name, ENT_QUOTES);
        	return $the_name;
   		} else { // Имя пустое
       		$_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите ".$field_name."</p>";
       		return_back();
		}
	} else { // Имя не пришло
		$_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле ".$field_name."</p>";
		return_back();
	}
}

/*
	Пользовательская функция.
	Выполняет проверку даты из массива POST на правильность. Правильным считается формат Y-m-d.
	Принимает два параметра:
		1. Имя переменной в массиве POST.
		2. Понятное человеку название переменной для включения в сообщение об ошибке.
*/
function validate_date($date, $field_name) {
	if(isset($_POST[$date])){
		if(!empty($_POST[$date])){
			// обрезаем лишнее регулярным выражением
			$d = preg_replace('/[^0-9\-]/u', '', trim($_POST[$date])); 
			//разбиваем дату в массив
			$date_arr = explode('-', $d);
			//если дата введена в корректном формате Y-m-d
			if(checkdate($date_arr[1], $date_arr[2], $date_arr[0])) {
				return $d; // возвращаем 
			} else {
				$_SESSION["error_messages"] .= 'Дата введена не корректно!';
				return_back();
			}
		} else { // поле пустое
        	$_SESSION["error_messages"] .= "<p class='mesage_error'>Поле ".$field_name." пустое</p>";
         	return_back();
    	}
    } else { // Дата не пришла
   		$_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле ".$field_name."</p>";
   		return_back();
	} 
}

/*
	Пользовательская функция.
	Определяет, откуда пришел пользователь, возвращает пользователя на предыдущую страницу и останавливает скрипт.
	Пояснение: в данном случае проще выполнить одной строкой, чем каждый раз писать, пусть и три строки. 
*/
function return_back() {
	header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}