<?php

require_once(__DIR__ . '\..\models\artiste.php');
require_once(__DIR__ . '\..\models\represente.php');
require_once(__DIR__ . '\..\models\heberge.php');
require_once(__DIR__ . '\..\models\genreMusical.php');
require_once(__DIR__ . '\..\models\scene.php');

$artiste = new Artiste();
$genre = new Represente();
$scene = new Heberge();
$listeGenre = new GenreMusical();
$listeScene = new Scene();

$artistes = $artiste->getAllArtiste();

if (isset($_GET["artiste"])) {
  $genre->setIdArtiste($_GET["artiste"]);
  $scene->setIdArtiste($_GET["artiste"]);

  $genres = $genre->getArtistGenres();
  $scenes = $scene->getArtistScenes();
}

if (isset($_GET["method"])) {
  if ($_GET["method"] === "insert") {
    $artiste->setNomArtiste($_POST["nomArtiste"]);
    $result = $artiste->createArtiste();
    
    if ($result === true) {
      header('Location: ' . $_SERVER['PHP_SELF'] . '?page=festival&artiste=inserted');
    } else {
      header('Location: ' . $_SERVER['PHP_SELF'] . '?page=festival&artiste=error');
    }
  }
  
  if ($_GET["method"] === "delete") {
    $artiste->setIdArtiste($_GET["artiste"]);
    $result = $artiste->deleteArtiste();
  
    if ($result === true) {
      header('Location: ' . $_SERVER['PHP_SELF'] . '?page=festival&artiste=deleted');
    } else {
      header('Location: ' . $_SERVER['PHP_SELF'] . '?page=festival&artiste=error');
    }
  }

  if ($_GET["method"] === "update") {
    var_dump($_POST);

    // if (isset($_POST["nomArtiste"])) {
    //   $artiste->setIdArtiste($_GET["artiste"]);
    //   $artiste->setNomArtiste($_POST["nomArtiste"]);

    //   $result = $artiste->updateArtiste();
    // }

    // if (isset($_POST["genreMusicaux"])) {
    //   $genre->setIdArtiste($_GET["artiste"]);
    //   $genre->setIdGenreMusical($_POST["genreMusicaux"]);

    //   $result = $genre->updateGenre();
    // }

    // if (isset($_POST["scene"])) {
    //   $listeScene->setIdScene($_POST["scene"]);

    //   $result = $listeScene->updateScene();
    // }

    // if (isset($_POST["datePassage"])) {
    //   $scene->setIdArtiste($_GET["artiste"]);
    //   $scene->setDatePassage($_POST["datePassage"]);

    //   $result = $scene->updateDatePassage();
    // }

    // if ($result === true) {
    //   header('Location: ' . $_SERVER['PHP_SELF'] . '?page=festival&artiste=updated');
    // } else {
    //   header('Location: ' . $_SERVER['PHP_SELF'] . '?page=festival&artiste=error');
    // }
  }
}

if (isset($_GET["type"])) {
  if ($_GET["type"] === "modifier" || $_GET["type"] === "afficher") {
    $artiste->setIdArtiste($_GET["artiste"]);

    $editArtiste = $artiste->getArtiste();
  }
}

?>

<div class="container mx-auto pt-10">
  <h2 class="text-3xl font-bold">Liste de tout les artistes</h2>

  <div class="my-6">
    <a href="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=festival&artiste=add') ?>">
      <button class="bg-black text-white px-6 py-3 hover:shadow-lg duration-300">Ajouter un artiste</button>
    </a>
  
    <?php 
      if (isset($_GET["artiste"])) {
        if ($_GET["artiste"] == "add") {
    ?>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=festival&method=insert') ?>" method="post" class="my-2 flex gap-4">
      <div class="flex items-center gap-1">
        <label for="nomArtiste">Nom de l'artiste</label>
        <input type="text" name="nomArtiste" id="nomArtiste" class="border">
      </div>
  
      <button type="submit" class="border px-6 hover:shadow-lg duration-300">Ajouter</button>
    </form>
    
    <?php }} ?>

    <?php 
      if (isset($_GET["artiste"])) {
        if ($_GET["artiste"] == "inserted") {
    ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-2" role="alert">
        <strong class="font-bold">L'artiste a bien été ajouté !</strong>
      </div>
    <?php }
      if ($_GET["artiste"] == "deleted") {
    ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-2" role="alert">
        <strong class="font-bold">L'artiste a bien été supprimé !</strong>
      </div>
    <?php } ?>
    <?php 
      if ($_GET["artiste"] == "error") {
    ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-2" role="alert">
        <strong class="font-bold">Une erreur est survenue !</strong>
      </div>
    <?php }} ?>
  </div>

  <div class="grid grid-cols-2 gap-4">
    <ul class="flex flex-col gap-4 w-full overflow-y-auto">
      <?php
        foreach ($artistes as $key => $value) {
      ?>
        <li class="flex flex-row items-center gap-4">
          <a href="<?= htmlspecialchars('?page=festival&artiste=' . $value["idArtiste"] . '&type=afficher') ?>" class="hover:underline hover:underline-offset-4 <?php if (isset($_GET['type'])) {
            if ($_GET['type'] == "afficher" || $_GET['type'] == "modifier") {
              if ($editArtiste['idArtiste'] == $value["idArtiste"]) {
                echo "underline underline-offset-4";
              }
            }
          } ?>">
            <?= htmlspecialchars($value["nomArtiste"]) ?>
          </a>
          <a href="<?= htmlspecialchars('?page=festival&artiste=' . $value["idArtiste"] . '&type=modifier') ?>" class="border px-6 py-3 hover:shadow-lg duration-300">Modifier</a>
          <a href="<?= htmlspecialchars('?page=festival&artiste=' . $value["idArtiste"]  . '&type=supprimer&method=delete') ?>" class="border px-6 py-3 hover:shadow-lg duration-300">Supprimer</a>
        </li>
      <?php
        }
      ?>
    </ul>
    <div class="bg-black/10 px-10 py-10 w-full">
      <h2 class="text-xl font-bold mb-4">
        <?php 
          if (isset($_GET["type"])) {
            switch($_GET["type"]) {
              case "afficher":
                echo "Informations de l'artiste";
                break;
              case "modifier":
                echo "Modification de l'artiste";
                break;
              default:
                echo "Aucun artiste sélectionné";
            }
          } else {
            echo "Aucun artiste sélectionné";
          }
        ?>
      </h2>

      <div>
          <?php
            if (isset($_GET["type"])) {
              if ($_GET["type"] === "afficher") {
          ?>
          <div class="mb-4">
            <span class="text-lg">Nom :</span>
            <span class="text-lg"><?= htmlspecialchars($editArtiste['nomArtiste']) ?></span>
          </div>
          <div class="mb-4">
            <h3 class="text-lg">Genre musicaux :</h3>
            <ul class="list-disc list-inside">
            <?php
              foreach ($genres as $key => $value) {
            ?>
              <li><?= htmlspecialchars($value['nomGenre']) ?></li>
            <?php } ?>
            </ul>
          </div>
          <div>
            <h3 class="text-lg">Perfome sur les scènes suivantes :</h3>
            <ul class="list-disc list-inside">
            <?php
              if (isset($_GET["artiste"])) {
                foreach ($scenes as $key => $value) {
            ?>
              <li>Nom : <?= htmlspecialchars($value['nomScene']) ?> | Date : <?= htmlspecialchars($value['datePassage']) ?></li>
            <?php }} ?>
            </ul>
          </div>
          <?php } ?>

          <!-- Modification de l'artiste -->
          <?php
            if ($_GET["type"] === "modifier") {
          ?>
            <form action="<?= htmlspecialchars('?page=festival&artiste=' . $_GET["artiste"] . '&type=modifier&method=update') ?>" method="post">

              <div>
                <label for="nomArtiste">Nom de l'artiste</label>
                <input type="text" name="nomArtiste" id="nomArtiste" class="border" value="<?= htmlspecialchars($editArtiste['nomArtiste']) ?>">
              </div>

              <div class="mb-4">
                <h3>Modifer les genres musicaux</h3>
                <?php 
                  foreach ($genres as $key => $value) { 
                ?>
                  <label for="<?= htmlspecialchars($value['nomGenre']) ?>"><?= htmlspecialchars($value['nomGenre']) ?></label>
                  <select name="genreMusicaux/<?= htmlspecialchars($value['idGenre']) ?>" id="<?= htmlspecialchars($value['nomGenre']) ?>">
                    <?php 
                      foreach ($listeGenre->getAllGenres() as $key => $valueGenre) { 
                    ?>
                      <option value="<?= htmlspecialchars($valueGenre['idGenre']) ?>" <?= htmlspecialchars($valueGenre['idGenre']) === htmlspecialchars($value['idGenre']) ? "selected" : "" ?>>
                        <?= htmlspecialchars($valueGenre['nomGenre']) ?>
                      </option>
                    <?php } ?>
                  </select>
                  <?php } ?>
              </div>
                
              <h3>Modifier les scenes</h3>
              <div class="mb-4 flex flex-col gap-2">
                <?php 
                  foreach ($scenes as $key => $value) {
                ?>
                  <div>
                    <label for="<?= htmlspecialchars($value['nomScene']) ?>">Joue sur la scene : <?= htmlspecialchars($value['nomScene']) ?></label>
                    <select name="<?= htmlspecialchars($value['idScene']) ?>" id="<?= htmlspecialchars($value['nomScene']) ?>">
                    <?php
                        foreach ($listeScene->getAllScenes() as $key => $valueScene) {
                      ?>
                        <option value="<?= htmlspecialchars($valueScene['idScene']) ?>">
                          <?= htmlspecialchars($valueScene['nomScene']) ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div>
                    <h3>Modifier la date de passage</h3>
                    <label for="datePassage">Date de passage : <?= htmlspecialchars($value["datePassage"]) ?></label>
                    <input type="datetime-local" name="datePassage" id="datePassage" value="<?= htmlspecialchars($value["datePassage"]) ?>">
                  </div>
                <?php } ?>
              </div>

              <button type="submit" class="border border-black px-6 py-3 hover:shadow-md duration-300">Modifier</button>
            </form>
          <?php }} ?>
      </div>
    </div>
  </div>
</div>