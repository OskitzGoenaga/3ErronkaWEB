<?php foreach ($stmt as $txapelketak): ?>
    <div class="txapelketa_bakoitza">
        <?php
        $estiloa = "";
        if ($txapelketak["egoera"] == "Izen Ematen") {
            $estiloa = "IzenEmaten";
        } else if ($txapelketak["egoera"] == "Amaituta") {
            $estiloa = "Amaituta";
        } else {
            $estiloa = "Jolasten";
        }
        ?>

        <div class="kaxa_goialdea">
            <div class="kaxa_ezkerraldea">
                <p class="egoera <?= $estiloa ?>"><?= $txapelketak["egoera"]; ?></p>
                <a class="titulu_txap" href="txapelketa_barnea.php?id=<?= $txapelketak['id']; ?>"><?= $txapelketak["izena"]; ?></a>
            </div>
            <img class="kaxa_argazkia" src="<?= $txapelketak['argazkia'] ?>" alt="">
        </div>
        <div class="bigarrenzatia">
        <div class="kokalekua">
            <p>📍 <?= $txapelketak["herria"]; ?> - <?= $txapelketak["tokia"] ?></p>
            <p>📅 <?= $txapelketak["data"]; ?></p>
        </div>

        <div class="linea"></div>
        <p>Bikote kantitatea: <?= $txapelketak["bikote_kant"]; ?></p>
        </div>
    </div>
<?php endforeach; ?>