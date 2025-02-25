<?php
include "config.php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

if (isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];
    $sql_delete = "DELETE FROM Automezzo WHERE codice = $delete_id";
    if ($conn->query($sql_delete) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Errore nella cancellazione: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco Automezzi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Elenco Automezzi</h1>
        <a href="inserisci_automezzo.php" class="btn btn-success mb-3">Inserisci Nuovo Automezzo</a>
        <a href="inserisci_filiale.php" class="btn btn-warning mb-3">Inserisci Nuova Filiale</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome Completo</th>
                    <th>Targa</th>
                    <th>Filiale</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT Automezzo.codice, targa, marca, modello, Filiale.codice AS filiale_id, citta, indirizzo 
                        FROM Automezzo 
                        LEFT JOIN Filiale ON Automezzo.filiale_codice = Filiale.codice";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>"
                            . "<td><a href='automezzo.php?id={$row['codice']}'>{$row['marca']} {$row['modello']}</a></td>"
                            . "<td>{$row['targa']}</td>"
                            . "<td><a href='filiale.php?id={$row['filiale_id']}'>{$row['citta']}, {$row['indirizzo']}</a></td>"
                            . "<td>
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='delete_id' value='{$row['codice']}'>
                                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Sei sicuro di voler eliminare questo automezzo?\");'>Elimina</button>
                                </form>
                            </td>"
                            . "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nessun automezzo trovato.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>