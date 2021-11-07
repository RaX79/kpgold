<?php
/*
	Главная страница.
	Содержит форму для добавления новых пользователей.
	Включает "голову", воводит сообщения, записанные в глобальный массив SESSION, "подвал".
*/
	//Запускаем сессию
	session_start();
	require_once("dbconnect.php");
	require_once("head.php");
	require_once("session_messages.php");
?>
	<div id="form_register">
		<h2>Форма добавления пользователя</h2>
		<form action="reguser.php" id="form_register" method="post" name="form_register">
			<table>
				<tbody>
					<tr>
						<td>Фамилия:</td>
						<td><input name="last_name" required="required" type="text"></td>
					</tr>
					<tr>
						<td>Имя:</td>
						<td><input name="first_name" required="required" type="text"></td>
					</tr>
					<tr>
						<td>Отчество:</td>
						<td><input name="second_name" required="required" type="text"></td>
					</tr>
					<tr>
						<td>Дата рождения:</td>
						<td><input name="birth" required="required" type="date"><br></td>
					</tr>
					<tr>
						<td>Пол:</td>
						<td><input name="sex" type="radio" value="men">Мужской</td>
						<td><input name="sex" type="radio" value="women">Женский</td>
					</tr>
					<tr>
						<td>Подразделение:</td>
						<td><select name="unit">
							<?php
								$strSQL = "SELECT unitName FROM units";
								$rs = mysqli_query($mysqli, $strSQL);
								while($row = mysqli_fetch_array($rs)) {
									$u = $row['unitName'];
									echo "<option value='".$u."'>".$u."</option>";
								}
							?>
						</select></td>
					</tr>
					<tr>
						<td colspan="2"><input name="btn_submit_register" type="submit" value="Добавить"></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<?php
		//Подключение подвала
		require_once("foot.php");
	?>