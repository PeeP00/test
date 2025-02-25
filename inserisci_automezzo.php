<?php
include "config.php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targa = $_POST['targa'];
    $marca = $_POST['marca'];
    $modello = $_POST['modello'];
    $filiale_codice = $_POST['filiale_codice'];

    $sql_insert = "INSERT INTO Automezzo (targa, marca, modello, filiale_codice) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("sssi", $targa, $marca, $modello, $filiale_codice);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Errore nell'inserimento: " . $stmt->error;
    }
    $stmt->close();
}

$sql_filiali = "SELECT codice, citta, indirizzo FROM Filiale";
$result_filiali = $conn->query($sql_filiali);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserisci Nuovo Automezzo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Inserisci Nuovo Automezzo</h1>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Targa</label>
                <input type="text" class="form-control" name="targa" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Marca</label>
                <input type="text" class="form-control" name="marca" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Modello</label>
                <input type="text" class="form-control" name="modello" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Filiale</label>
                <select class="form-control" name="filiale_codice" required>
                    <option value="">Seleziona una filiale</option>
                    <?php while ($row = $result_filiali->fetch_assoc()) { ?>
                        <option value="<?php echo $row['codice']; ?>">
                            <?php echo $row['citta']." - ".$row['indirizzo']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Inserisci</button>
            <a href="index.php" class="btn btn-secondary">Annulla</a>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
