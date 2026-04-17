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
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link rel="icon" type="image/x-icon" href="Argazkiak/icono.ico" sizes="any">
    <style>
    .slider {
        width: 300px;
        margin: auto;
    }
    .slick-slide {
        height: 230px;
    }
    .slick-prev:before,
    .slick-next:before {
        color: black;
        font-size: 40px;
    }
    .bigarrenzatia{
        margin-top: 30px;
    }
    .txapelketa_bakoitza{
        background-color: #222222;
    }
    @media (min-width: 768px) {
        .slider { width: 85%; max-width: 700px; }
        .slick-slide { height: auto; padding: 0 6px; }
        .slick-list { padding: 0 !important; }
    }
    @media (min-width: 1024px) {
        .slider { width: 90%; max-width: 900px; }
    }
    </style>
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
            <img src="Argazkiak/fondo.jpg" alt="">
            <div class="hasiera">
                <div class="txapelketa_akt_karta">
                    <div class="kutxa-edukia slider">
                        <?php
                        $stmt = $pdo->prepare("SELECT * FROM txapelketak WHERE egoera in ('izen ematen', 'jolasten')");
                        $stmt->execute();
                        ?>
                        <?php include_once("txapelketa_kaxa.php"); ?>
                    </div>
                </div>
            </div>
        </div>
        <section class="informazioa">
            <div class="historia">
                <h2>Euskal Herriko Mus Federazioa</h2>
                <p>La federación nació en 2002, cuando la asociación Iparra Hegoa comenzó a organizar el primer Campeonato de Mus de Euskal Herria. El objetivo inicial era que jugadores de los siete territorios vascos compitieran juntos como pueblo, algo que no existía hasta entonces. Con el tiempo, el campeonato fue creciendo y se vio la necesidad de crear una estructura propia. Así se fundó formalmente la Euskal Herriko Mus Federazioa, representada por delegados de los siete territorios.</p>
                <img src="Argazkiak/ikurrina.jpg">
            </div>
            <div class="helburuak">
                <h2>Helburuak</h2>
                <ul>
                    <li>Representar a Euskal Herria ante el mundo en el juego del mus, al ser el juego de mesa más extendido en el territorio</li>
                    <li>No sustituir los campeonatos locales existentes, sino potenciarlos.</li>
                    <li>Reivindicar la identidad vasca a través del mus como patrimonio cultural vivo.</li>
                </ul>
                <img src="Argazkiak/karta.jpg">
            </div>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.6.0.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script>
    $(document).ready(function(){
        $('.slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 99999,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
   </script>
    <?php include_once("footer.php"); ?>