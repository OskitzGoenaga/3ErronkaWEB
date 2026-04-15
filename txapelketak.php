<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Txapelketak</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="txapelketak.css">
    <link rel="stylesheet" href="orokorra.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="txapelketa_kaxa.css">

</head>

<body>
    <?php
    include_once "navbar.php";
    include_once "konexioa.php";

    $stmt = $pdo->query("Select * from txapelketak");
    ?>

    <section class="txapelketak">
        <h1>Txapelketa Guztiak</h1>
        <p id="azalpena">Hemen Gipuzkoako mus-eko txapelketa guztiak ikus ditzazkezu!</p>
        <div class="filtroak">
            <div class="filtro_barra">
                <select>
                    <option>Guztiak</option>
                    <option>Amaituta</option>
                    <option>Izen ematen</option>
                    <option>Jolasten</option>
                </select>
            </div>
            <div class="filtro_barra">
                <select>
                    <option>Guztiak</option>
                    <option>Gipuzkoa</option>
                    <option>Bizkaia</option>
                    <option>Araba</option>
                </select>
            </div>
        </div>
        <?php include_once("txapelketa_kaxa.php"); ?>
    </section>


    <script src="https://code.jquery.com/jquery-4.0.0.js"
        integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    
    <?php include_once("footer.php"); ?>
