<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Txapelketa barnea</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="orokorra.css">
    <link rel="stylesheet" href="txapelketa_barnea.css">
</head>

<img>
<?php
include_once "navbar.php";
include_once "konexioa.php";

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id <= 0) {
    header("Location: txapelketak.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM txapelketak WHERE id = ?");
$stmt->execute([$id]);
$txap = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$txap) {
    header("Location: txapelketak.php");
    exit;
}

$mezua = "";
$errorea = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["izena"], $_POST["abizena"], $_POST["bikotekidea"])) {
    $izena = trim($_POST["izena"]);
    $abizena = trim($_POST["abizena"]);
    $bikotekidea = trim($_POST["bikotekidea"]);

    if ($izena && $abizena && $bikotekidea) {
        $mezua = "Inskripzioa ongi bidali da!";
    } else {
        $errorea = "Mesedez bete eremu guztiak.";
    }
}
?>


<div class="detaile">
    <form action="txapelketa_barnea.php"></form>
    <div class="hero-section">
        <img class="banderaArg" src="<?= $txap["argazkia"]; ?>"></img>
        <div class="hero-overlay">
            <div class="hero-content">
                <a href="txapelketak.php" class="atzera-botoia">← Atzera</a>
                <?php
                $egoera = $txap['egoera'];
                ?>
                <p class="egoera"><?= $txap["egoera"]; ?></p>
                <h1 class="txapelketa_izena"><?= $txap['izena'] ?></h1>
            </div>
        </div>
    </div>
    </form>

    <div class="detaile-edukia">
        <div class="info-zutabea">
            <h2 class="sekzio-titulua">Txapelketaren datuak</h2>

            <div class="info-karta">
                <div class="info-errenkada">
                    <span class="info-ikurra">📍</span>
                    <div>
                        <p class="info-etiketa">Lekua</p>
                        <p class="info-balioa"><?= $txap['herria'] ?> — <?= $txap['tokia'] ?></p>
                    </div>
                </div>

                <div class="info-errenkada">
                    <span class="info-ikurra">📅</span>
                    <div>
                        <p class="info-etiketa">Data</p>
                        <p class="info-balioa"><?= $txap['data'] ?></p>
                    </div>
                </div>

                <div class="info-errenkada">
                    <span class="info-ikurra">🃏</span>
                    <div>
                        <p class="info-etiketa">Bikote kantitatea</p>
                        <p class="info-balioa"><?= $txap['bikote_kant'] ?> bikote</p>
                    </div>
                </div>

                <!--hemen saria xml-ana in behar da.
                <?php if (!empty($txap['saria'])): ?>
                    <div class="info-errenkada">
                        <span class="info-ikurra">🏆</span>
                        <div>
                            <p class="info-etiketa">Saria</p>
                            <p class="info-balioa"><?= htmlspecialchars($txap['saria']) ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                -->
            </div>

            <?php if (!empty($txap['deskribapena'])): ?>
                <div class="deskribapena-karta">
                    <h3>Deskribapena</h3>
                    <p><?= $txap['deskribapena'] ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="inskripzio-zutabea">
            <div class="inskripzio-karta <?= $egoera !== 'Izen ematen' ? 'itxita' : '' ?>">

                <?php if ($egoera === 'Izen ematen'): ?>
                    <h2 class="sekzio-titulua">Inskribatu</h2>
                    <p class="inskripzio-azalpena">Bete beheko formularioa txapelketan parte hartzeko.</p>

                    <?php if ($mezua): ?>
                        <div class="mezua-arrakasta"><?= $mezua ?></div>
                    <?php endif; ?>
                    <?php if ($errorea): ?>
                        <div class="mezua-errorea"><?= $errorea ?></div>
                    <?php endif; ?>

                    <div class="formularioa">
                        <input type="hidden" name="txapelketa_id" value="<?= $id ?>">

                        <div class="eremu-taldea">
                            <label for="izena">Izena</label>
                            <input type="text" id="izena" name="izena" placeholder="Zure izena" required>
                        </div>

                        <div class="eremu-taldea">
                            <label for="abizena">Abizena</label>
                            <input type="text" id="abizena" name="abizena" placeholder="Zure abizena" required>
                        </div>

                        <div class="eremu-taldea">
                            <label for="bikotekidea">Bikotekidearen izena</label>
                            <input type="text" id="bikotekidea" name="bikotekidea" placeholder="Bikotekidearen izena"
                                required>
                        </div>

                        <button class="inskribatu-botoia" id="inskribatu-btn" type="button">
                            Inskribatu orain
                        </button>
                    </div>

                <?php elseif ($egoera === 'Amaituta'): ?>
                    <div class="inskripzio-itxita">
                        <span class="itxita-ikurra">🏁</span>
                        <h3>Txapelketa amaituta</h3>
                        <p>Txapelketa hau jada amaituta dago. Beste txapelketa batzuk ikus ditzazkezu.</p>
                        <a href="txapelketak.php" class="beste-txap-botoia">Txapelketa guztiak ikusi</a>
                    </div>

                <?php else: ?>
                    <div class="inskripzio-itxita">
                        <span class="itxita-ikurra">⏳</span>
                        <h3>Jolasten ari da</h3>
                        <p>Txapelketa hau jadanik hasita dago eta inskripzioak itxita daude.</p>
                        <a href="txapelketak.php" class="beste-txap-botoia">Beste txapelketa bat bilatu</a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modal">
    <div class="modal-kaxoa">
        <h3>Inskripzioa berretsi</h3>
        <p>Ziur zaude txapelketa honetan inskribatu nahi duzula?</p>
        <div class="modal-botoiak">
            <button class="modal-ezeztatu" id="modal-ezeztatu">Ezeztatu</button>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="izena" id="modal-izena">
                <input type="hidden" name="abizena" id="modal-abizena">
                <input type="hidden" name="bikotekidea" id="modal-bikotekidea">
                <input type="hidden" name="txapelketa_id" value="<?= $id ?>">
                <button type="submit" class="modal-berretsi">Inskribatu</button>
            </form>
        </div>
    </div>
</div>

<?php
include_once "konexioa.php";
?>

<script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U="
    crossorigin="anonymous"></script>
<script src="egoeraKoloreak.js"></script>
<script>
    $("#inskribatu-btn").on("click", function () {
        var izena = $("#izena").val().trim();
        var abizena = $("#abizena").val().trim();
        var bikotekidea = $("#bikotekidea").val().trim();

        if (!izena || !abizena || !bikotekidea) {
            alert("Mesedez bete ereemu guztiak.");
            return;
        }

        $("#modal-izena").val(izena);
        $("#modal-abizena").val(abizena);
        $("#modal-bikotekidea").val(bikotekidea);

        $("#modal").addClass("aktibo");
    });

    $("#modal-ezeztatu").on("click", function () {
        $("#modal").removeClass("aktibo");
    });

    $("#modal").on("click", function (e) {
        if ($(e.target).is("#modal")) {
            $("#modal").removeClass("aktibo");
        }
    });
</script>
</body>

</html>