<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">    
    <link rel="stylesheet" type="text/css" href='stylePanel.css'/>
    <title>RadioActive • Panel</title>
    <link rel="icon" type="image/x-icon" href="img/RadioActive_iconW.png">
</head>
<body style='background-image: linear-gradient(to bottom right, rgb(0, 106, 255), burlywood);'>

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbRA";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = intval($_SESSION['user_id']);

// Pobierz listę użytkowników
$queryUsers = "SELECT * FROM usersra";
$resultUsers = $conn->query($queryUsers);

// Pobierz listę zadań
$queryTasks = "SELECT * FROM tasksRA";
$resultTasks = $conn->query($queryTasks);
?>

<!-- Wyświetlanie listy użytkowników z checkboxami -->
<div class="widget">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Wybierz użytkowników:</h2>
        <?php
        $resultUsers->data_seek(0);
        while ($row = $resultUsers->fetch_assoc()) {
            echo "<input type='checkbox' name='users[]' value='{$row['useridUSERS']}'>{$row['loginUSERS']}<br>";
        }
        ?>
        <br>
        <h2>Przypisz zadanie:</h2>
        <label for="task_id">ID zadania:</label>
        <input type="text" name="task_id">
        <br>
        <h2>Dostępne zadania:</h2>
        <?php
        $resultTasks->data_seek(0);
        while ($row = $resultTasks->fetch_assoc()) {
            $taskId = $row['idTASKS'];
            $taskName = $row['nameTASKS'];

            echo "ID zadania: $taskId, Nazwa: $taskName<br>";
        }
        ?>
        <br>
        <button type="submit" name="assignUsersAndTasks">Przypisz użytkowników i zadania</button>
    </form>
</div>

<?php
// Obsługa przypisywania zadań do użytkowników
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['assignUsersAndTasks'])) {
    $selectedUsers = isset($_POST['users']) ? $_POST['users'] : [];
    $taskId = isset($_POST['task_id']) ? intval($_POST['task_id']) : 0;

    if ($taskId > 0) {
        foreach ($selectedUsers as $selectedUserId) {
            $selectedUserId = intval($selectedUserId);

            // Sprawdź, czy istnieje już taki wpis
            $checkQuery = "SELECT * FROM user_task_access WHERE user_id = $selectedUserId AND task_id = $taskId";
            $checkResult = $conn->query($checkQuery);

            if ($checkResult->num_rows == 0) {
                // Jeśli nie istnieje, dodaj nowy wpis
                $query = "INSERT INTO user_task_access (user_id, task_id) VALUES ($selectedUserId, $taskId)";
                $conn->query($query);
            } else {
                // Jeśli istnieje, możesz podjąć odpowiednie działania, na przykład wyświetlić komunikat
                echo "Taki wpis już istnieje!";
            }
        }
    } else {
        echo "Podaj poprawne ID zadania!";
    }
}
?>



</body>
</html>

<?php
$conn->close();
?>
