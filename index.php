<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EuskalMus</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="orokorra.css">
</head>

<body>
    <?php
    include_once("navbar.php");
    ?>
    <main>
        <div class="sarrera">
            <div class="tituloa">🏆 2026eko Txapelketa Denboraldia</div>
            <h1 class="herriz-herri">
                Mus Txapelketak <br> Herriz Herri
            </h1>
            <p class="deskribapena">
                Inguruko mus txapelketa guztiak leku bakarrean. Jarraitu emaitzak, ikusi rankinga eta izena eman zure
                hurrengo txapelketarako.
            </p>
            <div class="estatistikak">
                <div class="est-aktibo">
                    <span class="zenbakia">24</span><br>
                    <span class="azalpena">Txapelketa aktibo</span>
                </div>
                <div class="est-jokalari">
                    <span class="zenbakia">312</span><br>
                    <span class="azalpena">Jokalari erregistratu</span>
                </div>
                <div class="est-herri">
                    <span class="zenbakia">18</span><br>
                    <span class="azalpena">Herri parte hartzen</span>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div>FOOTERRA</div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // Menuaren botoia sakatzean menua ireki/itxi
        $(".menu-botoia").click(function (e) {
            e.stopPropagation();
            $(".menu-botoia").toggleClass("irekita");
            $(".menu-desplegablea").toggleClass("irekita");
        });

        // Edozein tokitan klik egitean menu itxi
        $(document).click(function () {
            $(".menu-botoia").removeClass("irekita");
            $(".menu-desplegablea").removeClass("irekita");
        });

        // Menuaren barruan klik egitean ez itxi
        $(".menu-desplegablea").click(function (e) {
            e.stopPropagation();
        });
    </script>
</body>

</html>