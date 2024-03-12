<html lang="en">
<head>
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0; /* Убираем отступы по умолчанию */
            padding: 0;
            background-image: url('/Exam/images/daria-nepriakhina-zoCDWPuiRuA-unsplash.jpg'); /* Замените 'your-background-image.jpg' на путь к вашей фоновой картинке */
            background-size: cover; /* Растягиваем фоновую картинку на весь экран */
            background-position: center; /* Центрируем фоновую картинку */
            text-align: center;
            height: 100vh; /* 100% высоты окна просмотра */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
    display: inline-block;
    text-align: center;
    color: #fff;
    padding: 20px;
    background-color: rgba(22, 22, 22, 0.6); 
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 50px;
}

        label {
            display: block;
            margin-bottom: 8px;
            text-align: center;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border-radius: 8px;
        }

        input[type="submit"] {
            background-color: #55acee;
            color: #fff;
            cursor: pointer;
            border-radius: 8px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
<div class="form-container">
    <form method="post" action="admin_Add_Task.php">
        <h3>Добавление новой задачи</h3>

        <label>ID сотрудника:</label>
        <select name="user_id" required>
            <?php
            // Открываем конфигурационный файл и получаем параметры соединения с БД
            $handle = fopen("task_management.cfg", "r");
            $filestr = fgets($handle, 4096);
            $parts = explode(".", $filestr);
            fclose($handle);

            // Соединяемся с базой данных
            $connection = new mysqli($parts[0], $parts[2], $parts[1], $parts[3]);

            // Получаем список сотрудников из базы данных
            $result = $connection->query("SELECT user_id, username FROM users");

            // Выводим опции для выпадающего списка
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['user_id'] . '">' . $row['username'] . '</option>';
            }

            // Закрываем соединение
            $connection->close();
            ?>
        </select>

        <label for="taskTitle">Название задачи:</label>
        <input type="text" id="taskTitle" name="title" required>

        <label for="startDate">Дата начала задачи:</label>
        <input type="date" id="startDate" name="start_date" required>

        <label for="endDate">Плановая дата окончания задачи:</label>
        <input type="date" id="endDate" name="end_date" required>
        
        <label for="status">Текущий статус задачи:</label>
        <select name="status" required>
            
          
        <option value="pending">pending</option>
            <option value="completed">completed</option>
        </select>

        <input type="submit" value="Выполнить">
    </form>

    <h3>Управление задачами</h3>
  <form method="get" action="admin_task.php">
        <input type="submit" value="К задачам">
    </form> 
    <form method="get" action="validation_user.php">
        <input type="submit" value="Выйти">
    </form> 
</div>
</body>
</html>
