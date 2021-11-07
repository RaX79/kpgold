<?php
/*
    Страница редактирования пользователя.
    Содержит форму для редактирования существующих пользователей.
    Включает "голову", воводит сообщения, записанные в глобальный массив SESSION, "подвал".
    Форма заполнена данными о выбранном пользователе.
*/
    //Запускаем сессию
    session_start();
    require_once("dbconnect.php");
    require_once("head.php");
    require_once("session_messages.php");

// Проверяем, что пришел ID редактируемого пользователя и делаем запрос в БД.
    if(isset($_GET["userid"]) && !empty($_GET["userid"])){
        $reduser = true;
        $strSQL = "SELECT firstName,secondName,lastName,birth,sex,unit FROM users WHERE id=".$_GET["userid"];
        $rs = mysqli_query($mysqli, $strSQL);
        $row = mysqli_fetch_array($rs);
        if(!$rs){
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка чтения данных редактируемого пользователя</p>";
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        // Отправляем пользователя обратно с сообщением об ошибке
        $_SESSION["error_messages"] .= "<p class='mesage_error'>Не правильно введен идентефикатор редактируемого пользователя.</p>";
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    }
?>

 
        <div id="form_register">
            <h2>Форма изменения пользователя</h2>
            <form action="reguser.php?userid=<?php echo $_GET["userid"]; ?>" method="post" name="form_register">
                <table>
                    <tbody><tr>
                        <td> Фамилия: </td>
                        <td>
                            <input value="<?php echo $row['lastName'] ?>" type="text" name="last_name" required="required">
                        </td>
                    </tr>
                    <tr>
                        <td> Имя: </td>
                        <td>
                            <input value="<?php echo $row['firstName'] ?>" type="text" name="first_name" required="required">
                        </td>
                    </tr>
                    <tr>
                        <td> Отчество: </td>
                        <td>
                            <input value="<?php echo $row['secondName'] ?>" type="text" name="second_name" required="required">
                        </td>
                    </tr>
                    <tr>
                        <td> Дата рождения: </td>
                        <td>
                            <input value="<?php echo $row['birth'] ?>" type="date" name="birth" required="required"><br>
                        </td>
                    </tr>
                    <tr>
                        <td> Пол: </td>
                        <td>  <input <?php if($row['sex']) echo 'checked'; ?> type="radio" name="sex" value="men" />Мужской </td>
                        <td>  <input <?php if(!$row['sex']) echo 'checked'; ?> type="radio" name="sex" value="women" />Женский </td>
                    </tr>
                    <tr>
                        <td> Подразделение: </td>
                        <td>
                            <select name="unit">
                            <?
                                $strSQLunit = "SELECT unitName FROM units"; // запрос
                                $rs_unit = mysqli_query($mysqli, $strSQLunit);
                                while($row_unit = mysqli_fetch_array($rs_unit)) {
                                    $u = $row_unit['unitName'];
                                    $selected_u = $row['unit'];
                                    if ($u != $selected_u) {
                                        echo "<option value='".$u."'>".$u."</option>";
                                    } else {
                                        echo "<option selected value='".$u."'>".$u."</option>";
                                    }
                                }
                            ?>
                            </select>
                        </td>
                    </tr> 
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="btn_submit_register" value="Изменить">
                        </td>
                    </tr>
                </tbody></table>
            </form>
        </div>

<?php
    //Подключение подвала
    require_once("foot.php");
?>