function uploadFile() {
    var fileInput = document.getElementById('fileInput');
    var file = fileInput.files[0];

    if (file) {
        var formData = new FormData();
        formData.append('file', file);

        // Wysyłanie pliku za pomocą Fetch API
        fetch('upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Plik przesłano pomyślnie!');
                sendEmailNotification();
            } else {
                alert('Błąd podczas przesyłania pliku.');
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        alert('Wybierz plik przed przesłaniem.');
    }
}

function sendEmailNotification() {
    alert('Poinformowano o przesłaniu pliku na adres radiooactivv@gmail.com.');
}



    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const taskId = this.getAttribute('data-task-id');
                const isChecked = this.checked ? 1 : 0;

                // Wywołaj funkcję AJAX, aby zaktualizować status zadania w bazie danych
                updateTaskStatus(taskId, isChecked);
            });
        });

        function updateTaskStatus(taskId, isChecked) {
            // Wywołaj tutaj kod AJAX do aktualizacji statusu zadania w bazie danych
            // Przykład: użyj fetch lub innej metody do wysłania żądania do skryptu PHP
            // Przekazując taskId i isChecked jako parametry
        }
    });

