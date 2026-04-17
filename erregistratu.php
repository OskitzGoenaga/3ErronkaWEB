<?php
session_start();
require 'konexioa.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $sql = "SELECT * FROM jokalariak WHERE emaila = :em OR pasahitza = :pas OR telefonoa = :te";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':em' => $_POST["email"],
        ':pas' => $_POST["pasahitza"],
        ':te' => $_POST["telefonoa"]
    ]);

    if ($stmt->rowCount() != 0) {
        // Gorde errore mezua session-en eta bideratu
        $_SESSION['errorea'] = "Email, telefonoa edo pasahitza hori jada sartuta dago!";
        header("Location: erregistratu.php?error=1");
        exit;
    } else {
        $jokalariak = "INSERT INTO jokalariak (id, izena, abizena, emaila, pasahitza, telefonoa, herria) VALUES (null, :iz, :ab, :em, :pas, :tel, :her)";
        $stmt = $pdo->prepare($jokalariak);
        $stmt->execute([
            ':iz' => $_POST["izena"],
            ':ab' => $_POST["abizena"],
            ':em' => $_POST["email"],
            ':pas' => $_POST["pasahitza"],
            ':tel' => $_POST["telefonoa"],
            ':her' => $_POST["herria"]
        ]);

        if ($stmt) {
            $_SESSION['id'] = $pdo->lastInsertId();
            $_SESSION['izena'] = $_POST['izena'];
            header("Location: index.php?ok=1");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erregistratu</title>
    <link rel="stylesheet" href="orokorra.css" />
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="Argazkiak/icono.ico" sizes="any">
    <style>
        body { background-color: var(--color-orokorra); }
        #testua { color: var(--color-laugarrena); padding-bottom: 0px 30px 30px 30px; }
        .formularioa { text-align: center; width: 80%; margin: 120px auto; background-color: var(--color-bigarrena); padding: 50px 0px; border-radius: 20px; border-top: 5px solid var(--color-hirugarrena); }
        .formularioa>h1 { font-size: 40px; color: var(--color-txuria); padding: 0px 30px 0px 30px; }
        .formularioa>form>label { color: var(--color-txuria); }
        .formularioa>form>input { border-radius: 7px; border: 1px solid var(--color-bigarrena); padding: 10px 30px; background-color: var(--color-laugarrena); }
        .formularioa>a { text-decoration: none; color: var(--color-txuria); }
        .formularioa>form>#saioaBtn { margin: 20px; background-color: var(--color-hirugarrena); color: var(--color-orokorra); padding: 10px 30px; border-radius: 5px; font-weight: bold; border: var(--color-bigarrena); }
    </style>
</head>
<body>
    <div class="formularioa">
        <h1>SORTU KONTUA</h1><br>
        <p id="testua">Txapelketetan inskribatzeko kontua behar duzu!</p>

        <form action="erregistratu.php" method="POST">
            <label>Izena:</label><br>
            <input type="text" name="izena" required><br><br>
            <label>Abizena:</label><br>
            <input type="text" name="abizena" required><br><br>
            <label>Email:</label><br>
            <input type="email" name="email" required><br><br>
            <label>Pasahitza:</label><br>
            <input type="password" name="pasahitza" required><br><br>
            <label>Telefonoa:</label><br>
            <input type="text" name="telefonoa" required><br><br>
            <label>Herria:</label><br>
            <input type="text" name="herria" required><br><br>
            <button type="submit" name="bidali" id="saioaBtn">ERREGISTRATU</button>
        </form>

        <a href="hasiSaioa.php">Jadanik kontua duzu?</a>
    </div>
</body>
</html>

<?php if (isset($_GET['error']) && isset($_SESSION['errorea'])): ?>
    <script>
        alert("<?= $_SESSION['errorea'] ?>");
    </script>
    <?php unset($_SESSION['errorea']); ?>
<?php endif; ?>

<?php if (isset($_GET['ok'])): ?>
    <script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <script>
        alert("Erregistratu zara!");
    </script>
<?php endif; ?>