<header>
        <nav class="navbar">

            <div class="logoa"><a href="index.php">EuskalMus</a></div>
            
            
            <div class="menu-desplegablea">
                <a href="index.php">Hasiera</a>
                <a href="txapelketak.php">Txapelketak</a>
                <a href="ranking.php">Rankinga</a>
                <a href="sariak.php">Sariak</a>
                <a href="arauak.php">Arauak</a>
                <a href="saioahasi.php" class="menu-saioa">Saioa hasi</a>
                <a href="erregistratu.php" class="menu-erregistratu">Erregistratu</a>
            </div>

            <div class="menu-botoia">
                <img src="Argazkiak/menua.png" alt="menua">
            </div>
        </nav>
</header>
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