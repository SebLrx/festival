<?php

require_once(__DIR__ . '\..\models\artiste.php');
require_once(__DIR__ . '\..\models\represente.php');

$artiste = new Artiste();
$genre = new Represente();

$artistes = $artiste->getAllArtiste();

if (isset($_GET["artiste"])) {
  $genre->setIdArtiste($_GET["artiste"]);

  $genres = $genre->getArtistGenres();
}

?>

<!--  -->

<div>
  <h2>Liste de tout les artistes</h2>

  <div class="flex justify-around outline-dot w-96 border border-black divide-x">
    <ul>
      <?php
        foreach ($artistes as $key => $value) {
      ?>
        <li>
          <a href="<?= htmlspecialchars('?page=artiste&artiste=' . $value["idArtiste"]) ?>">
            <?= $value["nomArtiste"] ?>
          </a>
          <a href="<?= htmlspecialchars('?page=artiste&edit=' . $value["idArtiste"]) ?>">Modifier</a>
          <a href="<?= htmlspecialchars('?page=artiste&delete=' . $value["idArtiste"]) ?>">Supprimer</a>
        </li>
      <?php
        }
      ?>
    </ul>
    <div>
      <span>Informations du musicien</span>
      <div>
      <ul>Genre musicaux : 
        <?php
          if (isset($_GET["artiste"])) {
            foreach ($genres as $key => $value) {
        ?>
          <li><?= $value['nomGenre'] ?></li>
        <?php }} ?>
      </ul>  
      <div>Nombre de morceaux</div>
      </div>
    </div>
  </div>
</div>