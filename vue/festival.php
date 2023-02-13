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
    $artiste->setIdArtiste($_GET["delete"]);
    $result = $artiste->deleteArtiste();
  
    if ($result === true) {
      header('Location: ' . $_SERVER['PHP_SELF'] . '?page=festival&artiste=deleted');
    } else {
      header('Location: ' . $_SERVER['PHP_SELF'] . '?page=festival&artiste=error');
    }
  }
}

if (isset($_GET["type"])) {
  if ($_GET["type"] === "modifier" || $_GET["type"] === "afficher") {
    if (isset($_GET["edit"])) {
      $editArtiste = $artiste->getArtiste();
    }
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
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=festival&artiste=insert') ?>" method="post" class="my-2 flex gap-4">
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
          <a href="<?= htmlspecialchars('?page=festival&artiste=' . $value["idArtiste"] . 'type=modifier&method=delete') ?>" class="border px-6 py-3 hover:shadow-lg duration-300">Modifier</a>
          <a href="<?= htmlspecialchars('?page=festival&artiste=' . $value["idArtiste"]  . 'type=supprimer') ?>" class="border px-6 py-3 hover:shadow-lg duration-300">Supprimer</a>
        </li>
      <?php
        }
      ?>
    </ul>
    <div class="bg-black/10 px-10 py-20 w-full">
      <h2 class="text-xl font-bold">
        <?php 
          if (isset($_GET["type"])) {
            switch($_GET["type"]) {
              case "afficher":
                "Informations du musicien";
                break;
              case "modifier":
                "Modification du musicien";
                break;
              default:
                "Aucun musicien sélectionné";
            }
          } else {
            echo "Aucun musicien sélectionné";
          }
        ?>
      </h2>
      <div>
        <form action="<?= htmlspecialchars('?page=festival&artiste=edit&edit=' . $value["idArtiste"]) ?>" method="post">
          <?php
            if (isset($_GET["type"])) {
              if ($_GET["type"] === "afficher") {
          ?>
          <div>
            <span class="text-lg">Nom :</span>
            <span class="text-lg"><?= htmlspecialchars($editArtiste['nomArtiste']) ?></span>
          </div>
          <span class="text-lg">Genre musicaux :</span>
          <ul class="list-disc list-inside mb-10">
          <?php
            foreach ($genres as $key => $value) {
          ?>
            <li><?= htmlspecialchars($value['nomGenre']) ?></li>
          </ul>
          <?php }}
            if ($_GET["type"] === "modifier") {
          ?>
            <h3>Ajouter un genre musical</h3>
            <select name="genreMusicaux" id="genreMusicaux">
              <?php foreach ($listeGenre->getAllGenres() as $key => $value) { ?>
                <option value="<?= htmlspecialchars($value['idGenre']) ?>"><?= htmlspecialchars($value['nomGenre']) ?></option>
                <?php } ?>
              </select>
              
            <h3>Ajouter une scene</h3>
            <select name="scene" id="scene">
              <?php foreach ($listeScene->getAllScenes() as $key => $value) { ?>
                <option value="<?= htmlspecialchars($value['idScene']) ?>"><?= htmlspecialchars($value['nomScene']) ?></option>
              <?php } ?>
            </select>
              
            <h3>Ajouter une date</h3>
            <input type="date" name="datePassage" id="datePassage">
          <?php }} ?>
          <button type="submit" class="border px-6 py-3 hover:shadow-lg duration-300">Modifier</button>
        </form>
        
        <div class="w-full">
          <span class="text-lg">Perfome sur les scènes suivantes :</span>
          <ul class="flex flex-col divide-y">
          <?php
            if (isset($_GET["artiste"])) {
              foreach ($scenes as $key => $value) {
          ?>
            <li>Nom de la scene : <?= htmlspecialchars($value['datePassage']) ?> | Date de le performance : <?= htmlspecialchars($value['datePassage']) ?></li>
          <?php }} ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>