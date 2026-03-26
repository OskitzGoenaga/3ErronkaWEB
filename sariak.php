<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sariak — EuskalMus</title>
    <link rel="stylesheet" href="orokorra.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="sariak.css">
    <link rel="stylesheet" href="footer.css">
</head>

<body>
    <?php include_once "navbar.php"; ?>

    <main>
        <div class="sariak">

            <div class="sariak-header">
                <h1 class="sariak-titulua">🏅 Sariak</h1>
                <p class="sariak-azpititulua">Txapelketa bakoitzeko sariak</p>
            </div>

            <?php
            $xmlFitxategia = "./XML/sariak.xml";

            $xml = simplexml_load_file($xmlFitxategia);

            ?>

            <?php foreach ($xml->txapelketa as $txapelketa): ?>

                <?php $txapelketaIzena = $txapelketa['izena']; ?>

                <div class="txapelketa-blokea">
                    <h2 class="txap-izena"><?= $txapelketaIzena; ?></h2>
                    <div class="sariak-zerrenda">

                        <?php foreach ($txapelketa->sariak->saria as $saria): ?>
                            <?php

                            $posizioa = $saria->posizioa;
                            $deskribapena = $saria->deskribapena;


                            // Posizioaren araberako ikonoa eta klasea
                            if ($posizioa == "1") {
                                $ikonoa = "🥇";
                                $klasea = "saria-1";
                            } elseif ($posizioa == "2") {
                                $ikonoa = "🥈";
                                $klasea = "saria-2";
                            } elseif ($posizioa == "3") {
                                $ikonoa = "🥉";
                                $klasea = "saria-3";
                            } else {
                                $ikonoa = "🏅";
                                $klasea = "saria-txikia";
                            }

                            ?>
                            <div class="saria-karta <?= $klasea; ?>">
                                <div class="saria-ikonoa"><?= $ikonoa; ?></div>
                                <div class="saria-info">
                                    <div class="saria-posizioa"><?= $posizioa; ?>. postua</div>
                                    <div class="saria-deskribapena"><?= $deskribapena; ?></div>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include_once "footer.php"; ?>
