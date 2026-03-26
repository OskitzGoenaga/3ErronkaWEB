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
                    <option>Bidasoa</option>
                    <option>Donostialdea</option>
                    <option>Debabarrena</option>
                    <option>Debagoiena</option>
                    <option>Goierri</option>
                    <option>Tolosaldea</option>
                    <option>Urola Kosta</option>
                    <option>Urola Garaia</option>
                </select>
            </div>
        </div>
        <?php foreach ($stmt as $txapelketak): ?>
            <div class="txapelketa_bakoitza">
                <p class="egoera"><?= $txapelketak["egoera"]; ?></p>
                <a class="titulu_txap" href="txapelketa_barnea.php?id=<?= $txapelketak['id']; ?>"><?= $txapelketak["izena"]; ?></a>
                <div class="kokalekua">
                    <p>📍 Lekua:
                        <span><?= $txapelketak["herria"]; ?> - <?= $txapelketak["tokia"] ?></span>
                    </p>
                    <p>📅 Data: <?= $txapelketak["data"]; ?></p>
                </div>
                <div class="linea"></div>
                <p>Bikote kantitatea: <?= $txapelketak["bikote_kant"]; ?></p>
            </div>
        <?php endforeach; ?>
    </section>

    
    <script src="https://code.jquery.com/jquery-4.0.0.js"
        integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <script src="egoeraKoloreak.js"></script>

</body>

</html>
>>>>>>> 1a05c247bfaa2467a1ce635d2a02ea6b3f1f5177
