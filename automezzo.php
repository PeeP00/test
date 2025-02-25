<?php
include('config.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    die("ID veicolo non specificato.");
}

$id = (int) $_GET['id'];
$sql = "SELECT Automezzo.*, Filiale.citta, Filiale.indirizzo 
        FROM Automezzo 
        LEFT JOIN Filiale ON Automezzo.filiale_codice = Filiale.codice 
        WHERE Automezzo.codice = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Veicolo non trovato.");
}

$veicolo = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Veicolo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Dettagli Veicolo</h1>
        <table class="table table-bordered">
            <tr>
                <th>Codice</th>
                <td><?php echo $veicolo['codice']; ?></td>
            </tr>
            <tr>
                <th>Targa</th>
                <td><?php echo $veicolo['targa']; ?></td>
            </tr>
            <tr>
                <th>Marca</th>
                <td><?php echo $veicolo['marca']; ?></td>
            </tr>
            <tr>
                <th>Modello</th>
                <td><?php echo $veicolo['modello']; ?></td>
            </tr>
            <tr>
                <th>Filiale</th>
                <td><a href='filiale.php?id=<?php echo $veicolo['filiale_codice']; ?>'><?php echo $veicolo['citta']; ?></a></td>
            </tr>
        </table>
        <a href="index.php" class="btn btn-primary">Torna all'elenco</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
