<?php
include "config.php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    die("ID filiale non specificato.");
}

$id = (int) $_GET['id'];
$sql = "SELECT * FROM Filiale WHERE codice = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Filiale non trovata.");
}

$filiale = $result->fetch_assoc();

$sql_automezzi = "SELECT * FROM Automezzo WHERE filiale_codice = $id";
$result_automezzi = $conn->query($sql_automezzi);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Filiale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Dettagli Filiale</h1>
        <table class="table table-bordered">
            <tr>
                <th>Codice</th>
                <td><?php echo $filiale['codice']; ?></td>
            </tr>
            <tr>
                <th>Indirizzo</th>
                <td><?php echo $filiale['indirizzo']; ?></td>
            </tr>
            <tr>
                <th>Città</th>
                <td><?php echo $filiale['citta']; ?></td>
            </tr>
            <tr>
                <th>CAP</th>
                <td><?php echo $filiale['cap']; ?></td>
            </tr>
        </table>

        <h2 class="mt-4">Automezzi Associati</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Codice</th>
                    <th>Targa</th>
                    <th>Marca</th>
                    <th>Modello</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_automezzi->num_rows > 0) {
                    while ($row = $result_automezzi->fetch_assoc()) {
                        echo "<tr>"
                            . "<td>{$row['codice']}</td>"
                            . "<td>{$row['targa']}</td>"
                            . "<td>{$row['marca']}</td>"
                            . "<td><a href='veicolo.php?id={$row['codice']}'>{$row['modello']}</a></td>"
                            . "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nessun automezzo trovato.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-primary">Torna all'elenco</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
