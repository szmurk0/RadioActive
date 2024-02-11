<?php
// Połączenie z bazą danych
$servername = "localhost";
$username = "nazwa_uzytkownika";
$password = "haslo";
$dbname = "dbra";

$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pobranie danych z żądania POST
$taskId = $_POST['taskId'];
$isChecked = $_POST['isChecked'];

// Aktualizacja wartości kolumny isdoneTASKS w tabeli tasksra
$queryUpdateTaskStatus = "UPDATE tasksra SET isdoneTASKS = '$isChecked' WHERE idTASKS = $taskId";

// Obsługa błędów i odpowiedź JSON
$response = [];

if ($conn->query($queryUpdateTaskStatus) === TRUE) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = $conn->error;
}

// Zakończenie połączenia
$conn->close();

// Zwrócenie odpowiedzi w formacie JSON
echo json_encode($response);
?>
