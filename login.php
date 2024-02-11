<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbRA";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["identyfikatorDostepu"]) && isset($_POST["haslo"])) {
        $identyfikatorDostepu = $_POST["identyfikatorDostepu"];
        $haslo = $_POST["haslo"];

        $identyfikatorDostepu = mysqli_real_escape_string($conn, $identyfikatorDostepu);
        $haslo = mysqli_real_escape_string($conn, $haslo);

        $query = "SELECT * FROM usersra WHERE loginUSERS = '$identyfikatorDostepu' AND passwordUSERS = '$haslo'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            $_SESSION['user_id'] = $userData['useridUSERS']; // Przypisanie ID użytkownika do sesji

            header("Location: index.php");
            exit();
        } else {
            header("Location: login_err.php");
        }

    } else {
        echo "Brak danych w formularzu.";
    }
}

$conn->close();
?>
