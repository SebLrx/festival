<?php
    include_once(__DIR__ . '\..\models\represente.php');

    $artistes = new Represente();

        $tabArtistes = $artistes->readArtistes("nomArtiste");
    if (isset($_GET["tri"])) {
        $tabArtistes = $artistes->readArtistes($_GET["tri"]);
    }
?>
<div>
    <table>
        <tr>
            <th><a href="<?= htmlspecialchars('?page=afficherArtistes&tri=nomArtiste') ?>">Artistes</a></th>
            <th><a href="<?= htmlspecialchars('?page=afficherArtistes&tri=nomGenre') ?>">Genres musicaux</a></th>
        </tr>
        <?php
            foreach ($tabArtistes as $key => $value) {
        ?>
        <tr>
            <td><?=$value["nomArtiste"]?></td>
            <td><?=$value["nomGenre"]?></td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>