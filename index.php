<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rfid_data";

// Adatbázis kapcsolat létrehozása
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Kapcsolódási hiba: " . $conn->connect_error);
}

// Az összes beolvasott kártya megjelenítése
$sql = "SELECT * FROM cards ORDER BY timestamp DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <title>RFID Beolvasás</title>
</head>
<body>
  <h1>RFID Kártya Beolvasás</h1>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Kártya ID</th>
      <th>Időbélyeg</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["card_id"] . "</td><td>" . $row["timestamp"] . "</td></tr>";
      }
    } else {
      echo "<tr><td colspan='3'>Nincs bejegyzés</td></tr>";
    }
    ?>
  </table>
</body>
</html>

<?php
$conn->close();
?>
