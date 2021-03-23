-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 23 mars 2021 à 17:56
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `immo`
--

-- --------------------------------------------------------

--
-- Structure de la table `contratLocation`
--

CREATE TABLE `contratLocation` (
  `idContrat` int(11) NOT NULL,
  `idMaison` int(11) NOT NULL,
  `idLocataire` int(11) NOT NULL,
  `codeContrat` varchar(50) NOT NULL,
  `titreContrat` varchar(255) NOT NULL,
  `termesContrat` varchar(255) NOT NULL,
  `debutContrat` date NOT NULL,
  `finContrat` date NOT NULL,
  `caution` float NOT NULL,
  `avance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contratLocation`
--

INSERT INTO `contratLocation` (`idContrat`, `idMaison`, `idLocataire`, `codeContrat`, `titreContrat`, `termesContrat`, `debutContrat`, `finContrat`, `caution`, `avance`) VALUES
(1, 2, 1, 'ctr1', 'Contrat de bail', 'termes', '2021-03-31', '2021-05-31', 140000, 240000);

-- --------------------------------------------------------

--
-- Structure de la table `locataire`
--

CREATE TABLE `locataire` (
  `idLocataire` int(11) NOT NULL,
  `nomLocataire` varchar(255) NOT NULL,
  `telLocataire` varchar(255) NOT NULL,
  `emailLocataire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `locataire`
--

INSERT INTO `locataire` (`idLocataire`, `nomLocataire`, `telLocataire`, `emailLocataire`) VALUES
(1, 'Aladji', '96547812', 'alad@gmail.com'),
(2, 'dodji', '96547812', 'dod@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `maison`
--

CREATE TABLE `maison` (
  `idMaison` int(11) NOT NULL,
  `idProp` int(11) NOT NULL,
  `codeMaison` varchar(50) NOT NULL,
  `nomMaison` varchar(255) NOT NULL,
  `quartier` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `maison`
--

INSERT INTO `maison` (`idMaison`, `idProp`, `codeMaison`, `nomMaison`, `quartier`, `ville`) VALUES
(1, 1, 'Kpota45b', 'Esig', 'Kpota', 'lome'),
(2, 2, 'Adkp45b', 'fiohonou', 'Adakpamé', 'lome'),
(3, 2, 'dbkj500', 'attiviHouse', 'Dabadacondji', 'lome');

-- --------------------------------------------------------

--
-- Structure de la table `proprietaire`
--

CREATE TABLE `proprietaire` (
  `idProp` int(11) NOT NULL,
  `nomProp` varchar(255) NOT NULL,
  `prenomProp` varchar(255) NOT NULL,
  `telProp` varchar(255) NOT NULL,
  `emailProp` varchar(255) NOT NULL,
  `adresseProp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `proprietaire`
--

INSERT INTO `proprietaire` (`idProp`, `nomProp`, `prenomProp`, `telProp`, `emailProp`, `adresseProp`) VALUES
(1, 'Mum', 'jeane', '90106759', 'mum@gmail.com', 'Rue 256 dbkj'),
(2, 'Soeurette', 'dede', '99561281', 'soeur@gmail.com', 'Rue 525 marcory');

-- --------------------------------------------------------

--
-- Structure de la table `reglementLoyer`
--

CREATE TABLE `reglementLoyer` (
  `idReglement` int(11) NOT NULL,
  `idContrat` int(11) NOT NULL,
  `dateReg` date NOT NULL,
  `montantReg` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reglementLoyer`
--

INSERT INTO `reglementLoyer` (`idReglement`, `idContrat`, `dateReg`, `montantReg`) VALUES
(2, 1, '2021-04-05', 25000);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contratLocation`
--
ALTER TABLE `contratLocation`
  ADD PRIMARY KEY (`idContrat`),
  ADD KEY `FK_REG` (`idMaison`),
  ADD KEY `FK_LOC` (`idLocataire`);

--
-- Index pour la table `locataire`
--
ALTER TABLE `locataire`
  ADD PRIMARY KEY (`idLocataire`);

--
-- Index pour la table `maison`
--
ALTER TABLE `maison`
  ADD PRIMARY KEY (`idMaison`),
  ADD KEY `maison_ibfk_1` (`idProp`);

--
-- Index pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  ADD PRIMARY KEY (`idProp`);

--
-- Index pour la table `reglementLoyer`
--
ALTER TABLE `reglementLoyer`
  ADD PRIMARY KEY (`idReglement`),
  ADD KEY `FK_cont` (`idContrat`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contratLocation`
--
ALTER TABLE `contratLocation`
  MODIFY `idContrat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `locataire`
--
ALTER TABLE `locataire`
  MODIFY `idLocataire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `maison`
--
ALTER TABLE `maison`
  MODIFY `idMaison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  MODIFY `idProp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reglementLoyer`
--
ALTER TABLE `reglementLoyer`
  MODIFY `idReglement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contratLocation`
--
ALTER TABLE `contratLocation`
  ADD CONSTRAINT `FK_LOC` FOREIGN KEY (`idLocataire`) REFERENCES `locataire` (`idLocataire`),
  ADD CONSTRAINT `FK_REG` FOREIGN KEY (`idMaison`) REFERENCES `maison` (`idMaison`);

--
-- Contraintes pour la table `maison`
--
ALTER TABLE `maison`
  ADD CONSTRAINT `maison_ibfk_1` FOREIGN KEY (`idProp`) REFERENCES `proprietaire` (`idProp`);

--
-- Contraintes pour la table `reglementLoyer`
--
ALTER TABLE `reglementLoyer`
  ADD CONSTRAINT `FK_cont` FOREIGN KEY (`idContrat`) REFERENCES `contratLocation` (`idContrat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
