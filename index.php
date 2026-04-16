<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EuskalMus</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="orokorra.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="txapelketa_kaxa.css">
    <link rel="icon" type="image/x-icon" href="Argazkiak/icono.ico" sizes="any">
</head>

<body>
    <?php
    include_once("navbar.php");
    include_once("konexioa.php");
    ?>
    <main>
        <div class="hasiera">
            <div class="sarrera">
                <div class="tituloa">🏆 2026eko Txapelketa Denboraldia</div>
                <h1 class="herriz-herri">
                    Mus Txapelketak <br> Herriz Herri!
                </h1>
                <p class="deskribapena">
                    Inguruko mus txapelketa guztiak leku bakarrean. Jarraitu emaitzak, ikusi rankinga eta izena eman
                    zure hurrengo txapelketarako.
                </p>
                <div class="estatistikak">
                    <?php
                    $stmt = $pdo->prepare("SELECT COUNT(id) AS total, COUNT(DISTINCT herria) as total2 FROM txapelketak");
                    $stmt->execute();
                    $txap = $stmt->fetch(PDO::FETCH_ASSOC);

                    $stmt = $pdo->prepare("SELECT COUNT(id) AS total FROM jokalariak");
                    $stmt->execute();
                    $jok = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div>
                        <span><?= $txap["total"]; ?></span>
                        <span>TXAPELKETA AKTIBO</span>
                    </div>
                    <div>
                        <span><?= $jok["total"]; ?></span>
                        <span>JOKALARI ERREGISTRATU</span>
                    </div>
                    <div>
                        <span><?= $txap["total2"]; ?></span>
                        <span>HERRI PARTE HARTZEN</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="txapelketa_akt">
            <div class="hasiera">
                <h2 class="txapelketa_akt_tituloa">Txapelketa Aktiboak</h2>
                <div class="txapelketa_akt_karta">
                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM txapelketak WHERE egoera in ('izen ematen', 'jolasten')");
                    $stmt->execute();
                    ?>
                   <?php include_once("txapelketa_kaxa.php"); ?>
                </div>
            </div>
        </div>
    </main>

    <?php include_once("footer.php"); ?>