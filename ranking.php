<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Txapelketak</title>
    <link rel="stylesheet" href="orokorra.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="ranking.css">
    <link rel="stylesheet" href="footer.css">
</head>

<body>
    <?php 
    include_once "navbar.php"; 
    include_once "konexioa.php";
    ?>
    <?php
    $stmt = $pdo->query("SELECT * from ranking_osoa");
    ?>

    <div class="container">
        <h1>Ranking Orokorrak</h1>
        <p class="deskribapena">Jokalari eta bikote guztien sailkapena puntu metatuen arabera.</p>
        <div class="table-scroll">
            <table>
            <thead>
                <tr>
                    <th>POS.</th>
                    <th>JOKALARIA</th>
                    <th>HERRIA</th>
                    <th>JOKATUTAKOAK</th>
                    <th>IRABAZITAKOAK</th>
                    <th>GALDUTAKOAK</th>
                </tr>
            </thead>
            <tbody>
                <?php $zenb = 1; ?>
                <?php foreach ($stmt as $jokalariak): ?>
                <tr>
                    <td class="pos"><?= $zenb; ?></td>
                    <td class="jokalaria"><?= $jokalariak['jokalari_izena'] ?></td>
                    <td class="herria"><?= $jokalariak['herria'] ?></td>
                    <td class="zenbaki"><?= $jokalariak['jokatutako_partidak'] ?></td>
                    <td class="zenbaki"><?= $jokalariak['irabazitako_partidak'] ?></td>
                    <td class="zenbaki"><?= $jokalariak['galdutako_partidak'] ?></td>
                </tr>
                <?php $zenb = $zenb + 1; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
    <?php include_once "footer.php"; ?>