<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuotelista</title>
</head>
<body>
    
    <?php include('asetukset.php'); ?>

    <h2>Tuotelista</h2>

    <?php
    $sql = "SELECT * FROM tuotteet WHERE hinta > ?";
    #echo $sql;

    // Valmistellaan SQL-lause ja lähetetään palvelimelle odottamaan käyttöä
    $stmt = $pdo->prepare($sql);

    // Bind
    /*
    // Vaihtoehto 1
    $hinta = $_GET['h'];
    $stmt -> bindParam(1,$hinta,PDO::PARAM_INT);
        
    // Ajetaan SQL-lause
    $stmt->execute();
    */

    // Vaihtoehto 2
    $hinta = $_GET['h'];
    $stmt->execute([$hinta]);

    // Haetaan kaikki rivit
    $rivit = $stmt -> fetchAll();

    echo '
    <table border="1">
        <tr>
            <th>Nimi</th>
            <th>Hinta</th>
        <tr>
    ';

    foreach( $rivit as $rivi ) {
        echo '<tr>';
            echo '<td>' . $rivi['nimi'] . '</td>';
            echo '<td>' . $rivi['hinta'] . '</td>';
        echo '<tr>';
    }

    echo '</table>'; 

    // Suljetaan yhteys asettamalla pdo-objekti tyhjäksi
    $pdo->connection = null;

    ?>


</body>
</html>