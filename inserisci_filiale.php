<?php
include "config.php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $indirizzo = $_POST['indirizzo'];
    $citta = $_POST['citta'];
    $cap = $_POST['cap'];

    $sql_insert = "INSERT INTO Filiale (indirizzo, citta, cap) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("sss", $indirizzo, $citta, $cap);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Errore nell'inserimento: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserisci Nuova Filiale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Inserisci Nuova Filiale</h1>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Indirizzo</label>
                <input type="text" class="form-control" name="indirizzo" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Città</label>
                <input type="text" class="form-control" name="citta" required>
            </div>
            <div class="mb-3">
                <label class="form-label">CAP</label>
                <input type="text" class="form-control" name="cap" required>
            </div>
            <button type="submit" class="btn btn-primary">Inserisci</button>
            <a href="index.php" class="btn btn-secondary">Annulla</a>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>