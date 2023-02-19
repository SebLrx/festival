-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 19 fév. 2023 à 10:11
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `festival`
--

-- --------------------------------------------------------

--
-- Structure de la table `artiste`
--

CREATE TABLE `artiste` (
  `idArtiste` int(11) NOT NULL,
  `nomArtiste` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `artiste`
--

INSERT INTO `artiste` (`idArtiste`, `nomArtiste`) VALUES
(2, 'Musicien 2'),
(3, 'Musicien 3'),
(7, 'test 0'),
(8, 'Missi'),
(9, 'Musicien test');

-- --------------------------------------------------------

--
-- Structure de la table `billet`
--

CREATE TABLE `billet` (
  `idBillet` int(11) NOT NULL,
  `nomBillet` varchar(50) NOT NULL,
  `dateAchat` datetime NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `idCommande` int(11) NOT NULL,
  `idPaiement` int(11) NOT NULL,
  `idPrix` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `idCommande` int(11) NOT NULL,
  `dateCommande` datetime NOT NULL,
  `statusCommande` varchar(50) NOT NULL,
  `numeroCommande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `creer`
--

CREATE TABLE `creer` (
  `idUser` int(11) NOT NULL,
  `idMessage` int(11) NOT NULL,
  `Expediteur` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `idPrix` int(11) NOT NULL,
  `prix` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `festival`
--

CREATE TABLE `festival` (
  `idFestival` int(11) NOT NULL,
  `nomFestival` varchar(100) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `festival`
--

INSERT INTO `festival` (`idFestival`, `nomFestival`, `dateDebut`, `dateFin`) VALUES
(1, 'Un vestival génial', '2023-01-01', '2023-01-31');

-- --------------------------------------------------------

--
-- Structure de la table `genremusical`
--

CREATE TABLE `genremusical` (
  `idGenre` int(11) NOT NULL,
  `nomGenre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `genremusical`
--

INSERT INTO `genremusical` (`idGenre`, `nomGenre`) VALUES
(1, 'classique'),
(4, 'jazz'),
(2, 'pop'),
(3, 'rock');

-- --------------------------------------------------------

--
-- Structure de la table `heberge`
--

CREATE TABLE `heberge` (
  `idArtiste` int(11) NOT NULL,
  `idScene` int(11) NOT NULL,
  `datePassage` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `heberge`
--

INSERT INTO `heberge` (`idArtiste`, `idScene`, `datePassage`) VALUES
(2, 1, '2023-02-13 12:32:06');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `idMessage` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `typeMessage` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `idPaiement` int(11) NOT NULL,
  `nomCarte` varchar(100) NOT NULL,
  `dateExpiration` date NOT NULL,
  `numéroCarte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `possede`
--

CREATE TABLE `possede` (
  `idUser` int(11) NOT NULL,
  `idGenre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `represente`
--

CREATE TABLE `represente` (
  `idGenre` int(11) NOT NULL,
  `idArtiste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `represente`
--

INSERT INTO `represente` (`idGenre`, `idArtiste`) VALUES
(2, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `idRole` int(11) NOT NULL,
  `nomRole` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`idRole`, `nomRole`) VALUES
(3, 'artiste'),
(1, 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `scene`
--

CREATE TABLE `scene` (
  `idScene` int(11) NOT NULL,
  `nomScene` varchar(50) NOT NULL,
  `idFestival` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `scene`
--

INSERT INTO `scene` (`idScene`, `nomScene`, `idFestival`) VALUES
(1, 'Scene 1', 1),
(2, 'Scene 2', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUser` int(11) NOT NULL,
  `mailUser` varchar(150) NOT NULL,
  `mdpUser` varchar(100) NOT NULL,
  `adresseUser` varchar(50) NOT NULL,
  `nomUser` varchar(50) NOT NULL,
  `prenomUser` varchar(50) NOT NULL,
  `idRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUser`, `mailUser`, `mdpUser`, `adresseUser`, `nomUser`, `prenomUser`, `idRole`) VALUES
(1, 'bod.dupond@user.com', 'password', '1 rue de londre', 'dupon', 'bob', 1),
(6, 'bod.dupond@test.com', '$2y$10$UFkv1lv4orYAitVQPwcWvOKtzs3C4gohtWfhM3pSzRg', '123 rue de la fleur', 'bob', 'dupond', 1),
(11, 'test2@test.com', '$2y$10$VU6uyQsJAKmRDxoE5v6iDO7h6B0U7UNGSyOyEoTCcBMjszR.fFRQG', '10 rue des testss', 'test2', 'test22', 1),
(12, 'test@test.com', '$2y$10$CIPif0E4FbHRMrGdWmQZne9oj8IWfrtmc7GJnqkF0Jk7xhH24KHLq', '10 rue des tests', 'test', 'testman', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artiste`
--
ALTER TABLE `artiste`
  ADD PRIMARY KEY (`idArtiste`);

--
-- Index pour la table `billet`
--
ALTER TABLE `billet`
  ADD PRIMARY KEY (`idBillet`),
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `idPaiement` (`idPaiement`),
  ADD KEY `idPrix` (`idPrix`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`);

--
-- Index pour la table `creer`
--
ALTER TABLE `creer`
  ADD PRIMARY KEY (`idUser`,`idMessage`),
  ADD KEY `idMessage` (`idMessage`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`idPrix`);

--
-- Index pour la table `festival`
--
ALTER TABLE `festival`
  ADD PRIMARY KEY (`idFestival`);

--
-- Index pour la table `genremusical`
--
ALTER TABLE `genremusical`
  ADD PRIMARY KEY (`idGenre`),
  ADD UNIQUE KEY `nomGenre` (`nomGenre`);

--
-- Index pour la table `heberge`
--
ALTER TABLE `heberge`
  ADD PRIMARY KEY (`idArtiste`,`idScene`),
  ADD KEY `heberge_ibfk_2` (`idScene`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idMessage`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`idPaiement`);

--
-- Index pour la table `possede`
--
ALTER TABLE `possede`
  ADD PRIMARY KEY (`idUser`,`idGenre`),
  ADD KEY `possede_ibfk_2` (`idGenre`);

--
-- Index pour la table `represente`
--
ALTER TABLE `represente`
  ADD PRIMARY KEY (`idGenre`,`idArtiste`),
  ADD KEY `represente_ibfk_2` (`idArtiste`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idRole`),
  ADD UNIQUE KEY `nomRole` (`nomRole`);

--
-- Index pour la table `scene`
--
ALTER TABLE `scene`
  ADD PRIMARY KEY (`idScene`),
  ADD UNIQUE KEY `nomScene` (`nomScene`),
  ADD KEY `idFestival` (`idFestival`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `mailUser` (`mailUser`),
  ADD KEY `idRole` (`idRole`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artiste`
--
ALTER TABLE `artiste`
  MODIFY `idArtiste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `billet`
--
ALTER TABLE `billet`
  MODIFY `idBillet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `idPrix` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `festival`
--
ALTER TABLE `festival`
  MODIFY `idFestival` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `genremusical`
--
ALTER TABLE `genremusical`
  MODIFY `idGenre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `idPaiement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `scene`
--
ALTER TABLE `scene`
  MODIFY `idScene` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `billet`
--
ALTER TABLE `billet`
  ADD CONSTRAINT `billet_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`),
  ADD CONSTRAINT `billet_ibfk_2` FOREIGN KEY (`idPaiement`) REFERENCES `paiement` (`idPaiement`),
  ADD CONSTRAINT `billet_ibfk_3` FOREIGN KEY (`idPrix`) REFERENCES `facture` (`idPrix`),
  ADD CONSTRAINT `billet_ibfk_4` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`idUser`);

--
-- Contraintes pour la table `creer`
--
ALTER TABLE `creer`
  ADD CONSTRAINT `creer_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`idUser`),
  ADD CONSTRAINT `creer_ibfk_2` FOREIGN KEY (`idMessage`) REFERENCES `message` (`idMessage`);

--
-- Contraintes pour la table `heberge`
--
ALTER TABLE `heberge`
  ADD CONSTRAINT `heberge_ibfk_1` FOREIGN KEY (`idArtiste`) REFERENCES `artiste` (`idArtiste`) ON DELETE CASCADE,
  ADD CONSTRAINT `heberge_ibfk_2` FOREIGN KEY (`idScene`) REFERENCES `scene` (`idScene`) ON DELETE CASCADE;

--
-- Contraintes pour la table `possede`
--
ALTER TABLE `possede`
  ADD CONSTRAINT `possede_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`idUser`) ON DELETE CASCADE,
  ADD CONSTRAINT `possede_ibfk_2` FOREIGN KEY (`idGenre`) REFERENCES `genremusical` (`idGenre`) ON DELETE CASCADE;

--
-- Contraintes pour la table `represente`
--
ALTER TABLE `represente`
  ADD CONSTRAINT `represente_ibfk_1` FOREIGN KEY (`idGenre`) REFERENCES `genremusical` (`idGenre`) ON DELETE CASCADE,
  ADD CONSTRAINT `represente_ibfk_2` FOREIGN KEY (`idArtiste`) REFERENCES `artiste` (`idArtiste`) ON DELETE CASCADE;

--
-- Contraintes pour la table `scene`
--
ALTER TABLE `scene`
  ADD CONSTRAINT `scene_ibfk_1` FOREIGN KEY (`idFestival`) REFERENCES `festival` (`idFestival`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
