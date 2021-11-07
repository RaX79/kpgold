<?php
/*
	Страница со списком пользователей
	Содержит таблицу со всеми пользователями и JS скрипт для удобной сортировки по столбцам.
	В таблицу включены ссылки для редактирования и удаления пользователей.
	Включает "голову", воводит сообщения, записанные в глобальный массив SESSION, "подвал".	
*/
    	//Запускаем сессию
	session_start();
	require_once("dbconnect.php");
	require_once("head.php");
	require_once("session_messages.php");

//формируем таблицу
?>
<table class='table_sort'>
	<thead>
	<tr>
		<th>id</th>
		<th>Имя</th>
		<th>Отчество</th>
		<th>Фамилия</th>
		<th>Дата рождения</th>
		<th>Пол</th>
		<th>Подразделение</th>
	</tr>
	</thead>
	<tbody>
<?php
	// запрос для получения массива всех пользователей
    $strSQL = "SELECT id,firstName,secondName,lastName,birth,sex,unit FROM users";
	$rs = mysqli_query($mysqli, $strSQL);

	// В цикле выводим всех пользователей
	while($row = mysqli_fetch_array($rs)) {
		$id = $row['id']; // Читаем ID в переменную, потому что в таблице это поле используется более одного раза
		
		?>
		<tr>
		<?php
 		
 		echo "<td >".$id."</td>";
 		echo "<td >".$row['firstName']."</td>";
 		echo "<td >".$row['secondName']."</td>";
 		echo "<td >".$row['lastName']."</td>";
 		echo  "<td >".$row['birth']."</td>";
 		if($row['sex']) $sex="М";else $sex="Ж"; 
 		echo  "<td >".$sex."</td>";
 		echo  "<td >".$row['unit']."</td>";
 		echo  "<td ><a href='../reduser.php?userid=".$id."'>Редактировать</a></td>";
 		echo  "<td ><a href='../deluser.php?userid=".$id."'>Удалить</a></td>";
 		echo  "</tr>";
	}
	?>
	</tbody>
</table>

<script type="text/javascript">
	/*
	JS скрипт, не использует сторонних библиотек.
	Сортирует таблицы с классом table_sort.
	Событие - клик на заголовок таблицы (thead).
	Сортируемые поля внутри tbody.
	Сортирует столбцы таблицы по алфавиту ru, en, по возрастанию/убыванию чисел.
	*/
	document.addEventListener('DOMContentLoaded', () => {

    const getSort = ({ target }) => {
        const order = (target.dataset.order = -(target.dataset.order || -1));
        const index = [...target.parentNode.cells].indexOf(target);
        const collator = new Intl.Collator(['en', 'ru'], { numeric: true });
        const comparator = (index, order) => (a, b) => order * collator.compare(
            a.children[index].innerHTML,
            b.children[index].innerHTML
        );
        
        for(const tBody of target.closest('table').tBodies)
            tBody.append(...[...tBody.rows].sort(comparator(index, order)));

        for(const cell of target.parentNode.cells)
            cell.classList.toggle('sorted', cell === target);
    };
    
    document.querySelectorAll('.table_sort thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));
    
});
</script>
<?php 
	require_once("foot.php");
?>