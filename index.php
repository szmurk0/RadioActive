<html>
<header>
    <img class='logo' src="img/RadioActive_logoB.png" alt="Logo HereBox"/>
    <div class="menu">
        <button class='menubutton btn-animate btn btn-success' type="button"><a href="index.php" style="color: white; text-decoration: none;">Strona Główna</a></button>
        <button class='menubutton btn-animate btn btn-success' type="button"><a href="dane.html" style="color: white; text-decoration: none;">Działaj!</a></button>
        <button class='menubutton btn-animate btn btn-success' type="button"><a href="kontakt.php" style="color: white; text-decoration: none;">Kontakt</a></button>        <p>Website made by: szmurk0 <3</p>
    </div>
</header>
</html>
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

$queryRoles = "SELECT * FROM usersra WHERE useridUSERS = $userId";
$resultRoles = $conn->query($queryRoles);

if ($resultRoles) {

    if ($resultRoles->num_rows > 0) {
        $userRoles = $resultRoles->fetch_assoc();

         // Wyświetl różne bloki w zależności od uprawnień
         if ($userRoles['ROLE_s_budowlanka'] == 1 || $userRoles['ROLE_s_ekonomik'] == 1 || $userRoles['ROLE_s_norwid'] == 1 || $userRoles['ROLE_s_zeg'] == 1) {
            echo "<div class='widget widget2a '>";
            echo "<center><p class='heading'>Lista zadań</p></center>";
        
            // Pobierz zadania z bazy danych i wyświetl
            $queryTasks = "SELECT t.*, a.user_id AS assigned_user_id FROM tasksra t
                LEFT JOIN user_task_access a ON t.idTASKS = a.task_id AND a.user_id = $userId";
            $resultTasks = $conn->query($queryTasks);
        
            if ($resultTasks) {
                if ($resultTasks->num_rows > 0) {
                    while ($row = $resultTasks->fetch_assoc()) {
                        echo "<div class='task'>";
                        echo "<input type='checkbox' class='custom-control-input' id='task{$row['idTASKS']}' name='task{$row['idTASKS']}' data-task-id='{$row['idTASKS']}'";
                        echo "&copy;";
                        if ($row['assigned_user_id'] == $userId) {
                            echo " checked";
                        }
                        echo ">";
                        echo "<label class='custom-control-label custom-checkbox-label' for='task{$row['idTASKS']}'>{$row['nameTASKS']}</label>";
                        echo "</div>";
                    }                    
                } else {
                    echo "Brak zadań dostępnych dla tego użytkownika.";
                }

            } else {
                echo "Błąd zapytania: " . $conn->error;
            }
        
            echo "</div>";
            echo "<br></br>";
        }

        if ($userRoles['ROLE_s_budowlanka'] == 1 || $userRoles['ROLE_s_ekonomik'] == 1 || $userRoles['ROLE_s_norwid'] == 1 || $userRoles['ROLE_s_zeg'] == 1) {
            echo "<div class='widget widget2b'>";
            echo "<center><p class='heading'>Panel dnia • <span id='currentDate'></span></p></center>";
        
            // Pobierz dane z panelu dnia przypisane do użytkownika
            $queryPanelData = "SELECT pd.* FROM paneldatara pd
                JOIN user_paneldata_access upa ON pd.idPANELDATA = upa.paneldata_id
                WHERE upa.user_id = $userId";
            $resultPanelData = $conn->query($queryPanelData);
        
            if ($resultPanelData) {
                if ($resultPanelData->num_rows > 0) {
                    while ($row = $resultPanelData->fetch_assoc()) {
                        echo "<div class='panel-data'>";
                        echo "<p>{$row['namePANELDATA']}</p>";
                        echo "<p>{$row['contentPANELDATA']}</p>";
                        echo "</div>";
                    }
                } else {
                    echo "Brak danych z panelu dnia przypisanych dla tego użytkownika.";
                }
            } else {
                echo "Błąd zapytania: " . $conn->error;
            }
        
            echo "</div>"; // połączenie między useridUSERS oraz useridTASK
        }
        

        echo "<div class='widget widget2a'>";
        echo "<center><p class='heading'>Prześlij plik</p></center>";
        echo "<form id='uploadForm' action='upload.php' method='post' enctype='multipart/form-data'>";
        echo "<center><input type='file' name='file' id='fileInput' required><br>";
        echo "<br><textarea name='description' placeholder='Dodaj opis (opcjonalne)'></textarea><br><br>";
        echo "<button type='submit' class='btn-animate btn btn-success'>Prześlij</button></center>";
        echo "</form>";
        echo "<p id='uploadStatus'></p>";
        echo "</div>";

        if ($userRoles['ROLE_s_budowlanka'] == 1 || $userRoles['ROLE_s_ekonomik'] == 1 || $userRoles['ROLE_s_norwid'] == 1 || $userRoles['ROLE_s_zeg'] == 1) {
            echo "<div class='widget widget1'>";
            echo "<center><p class='heading'>Baza plików do pobrania</p></center>";

            $queryFiles = "SELECT f.* FROM filesra f
                JOIN file_user_access a ON f.idFILES = a.file_id
                WHERE a.user_id = $userId OR f.forwhoFILES LIKE '%$userId%'";
            $resultFiles = $conn->query($queryFiles);

            if ($resultFiles) {
                if ($resultFiles->num_rows > 0) {
                    while ($row = $resultFiles->fetch_assoc()) {
                        echo "<div class='file'>";
                        echo "<p>Nazwa pliku: " . (isset($row['nameFILES']) ? $row['nameFILES'] : 'Brak nazwy') . "</p>";
                        echo "<p>Opis: " . (isset($row['descriptionFILES']) ? $row['descriptionFILES'] : 'Brak opisu') . "</p>";
                        echo "<p>Plik: <a href='" . $row['fileFILES'] . "' target='_blank'>Pobierz plik</a></p>";
                        echo "</div>";
                        echo "<hr>";
                    }
                } else {
                    echo "Brak plików dostępnych dla tego użytkownika.";
                }
            } else {
                echo "Błąd zapytania: " . $conn->error;
            }

            
            echo "</div>";
        }

    } else {
        // Użytkownik nie ma przypisanych ról
        echo "";
    }
} else {
    echo "Błąd zapytania: " . $conn->error;
}

// Zamknij połączenie z bazą danych
$conn->close();
?>



<!DOCTYPE html>
<html>

<div>
     <div class="wave"></div>
     <div class="wave"></div>
     <div class="wave"></div>
</div>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">    
    <link rel="stylesheet" type="text/css" href='styleRA.css'/>
    <title>RadioActive • panel</title>
    <link rel="icon" type="image/x-icon" href="img/RadioActive_iconW.png">
</head>
<body style='background-image: linear-gradient(to bottom right, rgb(0, 106, 255), burlywood);'>

<!--<header>
    <img class='logo' src="img/RadioActive_logoB.png" alt="Logo HereBox"/>
    <div class="menu">
        <button class='menubutton btn-animate btn btn-success' type="button" onclick="alert('Wszystko to wina UCB!!!')">Dane</button>
        <button class='menubutton btn-animate btn btn-success' type="button" onclick="alert('Wszystko to wina UCB!!!')">Pomoc</button>
    </div>
</header>-->

<main>
    
    <div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

</main>



<script src="upload.js"></script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<script>
    // Obsługa zapamiętywania stanu checkboxów
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                localStorage.setItem(checkbox.id, checkbox.checked);
            });

            // Przywracanie stanu z localStorage
            const storedValue = localStorage.getItem(checkbox.id);
            if (storedValue !== null) {
                checkbox.checked = (storedValue === 'true');
            }
        });

        // Ustaw aktualną datę w formacie dzień, miesiąc, rok
        const currentDateElement = document.getElementById('currentDate');
        const currentDate = new Date();
        const day = addLeadingZero(currentDate.getDate());
        const month = addLeadingZero(currentDate.getMonth() + 1); // Miesiące w obiekcie Date są numerowane od 0 do 11
        const year = currentDate.getFullYear();
        currentDateElement.textContent = `${day}.${month}.${year}`;
    });

    // Funkcja dodająca zero przed liczbą, jeśli jest mniejsza niż 10
    function addLeadingZero(number) {
        return number < 10 ? `0${number}` : number;
    }
</script>



</body>
</html>
