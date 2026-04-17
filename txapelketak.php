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
    <link rel="icon" type="image/x-icon" href="Argazkiak/icono.ico" sizes="any">
</head>

<body>
    <?php
    include_once "navbar.php";
    include_once "konexioa.php";

    $egoera = $_GET["egoera"] ?? "";
    $probintzia = $_GET["probintzia"] ?? "";

    $where = "1=1";
    if ($egoera != "") {
        $where .= " AND egoera='$egoera'";
    }
    if ($probintzia != "") {
        $where .= " AND probintzia='$probintzia'";
    }

    $stmt = $pdo->query("SELECT * FROM txapelketak WHERE $where");
    ?>

    <section class="txapelketak">
        <h1>Txapelketa Guztiak</h1>
        <p id="azalpena">Hemen Gipuzkoako mus-eko txapelketa guztiak ikus ditzazkezu!</p>

        <form class="filtroak" action="txapelketak.php" method="get">
            <div class="filtro_barra">
                <select name="egoera">
                    <option value="">-- Egoera --</option>
                    <option value="Amaituta" <?= $egoera === "Amaituta" ? "selected" : ""; ?>>Amaituta</option>
                    <option value="Izen ematen" <?= $egoera === "Izen ematen" ? "selected" : ""; ?>>Izen ematen</option>
                    <option value="Jolasten" <?= $egoera === "Jolasten" ? "selected" : ""; ?>>Jolasten</option>
                </select>
            </div>
            <div class="filtro_barra">
                <select name="probintzia">
                    <option value="">-- Probintzia --</option>
                    <option value="Gipuzkoa" <?= $probintzia === "Gipuzkoa" ? "selected" : ""; ?>>Gipuzkoa</option>
                    <option value="Bizkaia" <?= $probintzia === "Bizkaia" ? "selected" : ""; ?>>Bizkaia</option>
                    <option value="Araba" <?= $probintzia === "Araba" ? "selected" : ""; ?>>Araba</option>
                </select>
            </div>
        </form>

        <div class="txapelketak-grid">
        <?php include_once("txapelketa_kaxa.php"); ?>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-4.0.0.js"
        integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>

    <script>
        $("select").change(function () {
            $("form").submit();
        });
    </script>

    <?php include_once("footer.php"); ?>
</body>

</html>