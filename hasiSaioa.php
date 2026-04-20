<?php
// Saioa hasi (session-ak erabiltzeko)
session_start();

// Datu-baseko konexioa kargatu
require 'konexioa.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saioa hasi</title>
    <link rel="stylesheet" href="orokorra.css" />
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="Argazkiak/icono.ico" sizes="any">
    <style>
        body {
            background-color: var(--color-orokorra);
        }

        #testua {
            color: var(--color-laugarrena);
            padding: 0px 30px 30px 30px;
        }

        .formularioa {
            text-align: center;
            width: 80%;
            margin: 120px auto;
            background-color: var(--color-bigarrena);
            padding: 50px 0px;
            border-radius: 20px;
            border-top: 5px solid var(--color-hirugarrena);
        }

        .formularioa>h1 {
            font-size: 40px;
            color: var(--color-txuria);
        }

        .formularioa>form>label {
            color: var(--color-txuria);
        }

        .formularioa>form>input {
            border-radius: 7px;
            border: 1px solid var(--color-bigarrena);
            padding: 10px 30px;
            background-color: var(--color-laugarrena);
        }

        .formularioa>a {
            text-decoration: none;
            color: var(--color-txuria);
        }

        .formularioa>form>#saioaBtn {
            margin: 20px;
            background-color: var(--color-hirugarrena);
            color: var(--color-orokorra);
            padding: 10px 30px;
            border-radius: 5px;
            font-weight: bold;
            border: var(--color-bigarrena);
        }

        @media (min-width: 768px) {
            .formularioa {
                width: 60%;
                max-width: 500px;
            }
        }

        @media (min-width: 1024px) {
            .formularioa {
                width: 40%;
                max-width: 460px;
            }
        }
    </style>
</head>

<body>
    <!-- Login formulario nagusia -->
    <div class="formularioa">

        <h1>SAIOA HASI</h1><br>
        <p id="testua">Txapelketa batean inskribatzeko hasi saioa!</p>

        <!-- Login formularioa: datuak hasiSaioa.php-ra bidaltzen dira -->
        <form action="hasiSaioa.php" method="POST">

            <label>Email:</label><br>
            <input type="email" name="email" required><br><br>

            <label>Pasahitza:</label><br>
            <input type="password" name="pasahitza" required><br><br>

            <button type="submit" id="saioaBtn">SAIOA HASI</button>
        </form>

        <!-- Konturik ez dutenentzat erregistro orrira esteka -->
        <a href="erregistratu.php">Ez duzu kontua? Klikatu hemen</a>
    </div>
</body>

</html>

<?php
// Formularioa bidali denean (POST eskaera)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Formetik jasotako datuak
    $email = $_POST['email'];
    $pasahitza = $_POST['pasahitza'];

    // Jokalaria bilatu datu-basean (prepared statement erabiliz)
    $sql = "SELECT * FROM jokalariak WHERE emaila = :email AND pasahitza = :pasahitza";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':email' => $email,
        ':pasahitza' => $pasahitza
    ]);

    // Emaitza hartu
    $jokalaria = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($jokalaria) {
        // Bezeroa existitzen bada -> datuak sesioan gorde
        $_SESSION['id'] = $jokalaria['id'];
        $_SESSION['izena'] = $jokalaria['izena'];

        // Hasierako orrira bidali
        header("Location: index.php");
        exit();
    } else { ?>
        <!-- Datuak okerrak badira alert bat erakutsi -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>alert("Datu okerrak");</script>
    <?php }
}
?>