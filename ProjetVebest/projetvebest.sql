-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 17 août 2021 à 09:04
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetvebest`
--
CREATE DATABASE IF NOT EXISTS `projetvebest` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `projetvebest`;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `idEt` int(2) NOT NULL,
  `nomEtu` varchar(50) NOT NULL,
  `prenEtu` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`idEt`, `nomEtu`, `prenEtu`, `email`, `contact`, `pays`) VALUES
(1, 'yede', 'Hermane', 'yede@gmail.com', '+2550759697175', 'Abobo'),
(2, 'Ehounou', 'marc', 'admin@gmail.com', '078000000', 'AdzopÃ©'),
(3, 'KonÃ©', 'Ibrahim', 'yede@gmail.com', '+2550759697175', 'BouakÃ©'),
(4, 'kouamÃ©', 'hermane', 'hermaine@gmail.com', '077175695', 'Abobo'),
(7, 'Koffi', 'herzard', 'herzard@gmail.com', '+2550576695935', 'Abidjan'),
(8, 'Yed', 'Marie ', 'yede@gmail.com', '+2550576695935', 'Abobo'),
(9, 'dede', 'gggb', 'abc@gmail.com', '+2550576695935', 'AdzopÃ©');

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `idIns` int(11) NOT NULL,
  `dateIns` varchar(50) NOT NULL,
  `idMat` varchar(50) NOT NULL,
  `libInscript` varchar(50) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `idEt` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`idIns`, `dateIns`, `idMat`, `libInscript`, `periode`, `idEt`) VALUES
(6, '2021-07-01', '3', 'SoldÃ©', '4 moi', 4),
(3, '2021-07-20', '1', 'SoldÃ©', '7 AOUT - 5 MAI', 2),
(4, '2021-07-13', '2', 'SoldÃ©', '4 mois', 2),
(5, '2021-07-28', '3', 'SoldÃ©', '2 mois', 8);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `idMat` int(2) NOT NULL,
  `libMat` varchar(50) NOT NULL,
  `nbHmat` int(50) NOT NULL,
  `idP` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`idMat`, `libMat`, `nbHmat`, `idP`) VALUES
(2, 'MONTAGE VIDEO', 40, 2),
(3, 'INFOGRAPHIE', 30, 1);

-- --------------------------------------------------------

--
-- Structure de la table `professeurs`
--

CREATE TABLE `professeurs` (
  `idP` int(11) NOT NULL,
  `nomP` varchar(50) NOT NULL,
  `prenomP` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `professeurs`
--

INSERT INTO `professeurs` (`idP`, `nomP`, `prenomP`, `email`, `contact`) VALUES
(1, 'Diplo', 'HervÃ©', 'DiploHerve@gmail.com', '+2550759697175'),
(2, 'Yoa', 'Zack', 'Zack@gmail.com', '078000000'),
(4, 'Yed', 'Magellan', 'yede@gmail.com', '+2550576695935');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `etat` int(11) NOT NULL,
  `role` varchar(25) NOT NULL DEFAULT 'USER',
  `photo` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`iduser`, `login`, `mdp`, `etat`, `role`, `photo`) VALUES
(1, 'admin', '0000', 1, 'ADMIN', 'IMG_20171116_091650.jpg'),
(2, 'user', '0000', 1, 'USER', 'yed.jpg'),
(3, 'admin1', '0000', 0, 'USER', 'logo.jpg'),
(4, 'user1', '0000', 1, 'USER', 'FB_IMG_1581454652689.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`idEt`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`idIns`),
  ADD KEY `idEt` (`idEt`),
  ADD KEY `idMat` (`idMat`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`idMat`);

--
-- Index pour la table `professeurs`
--
ALTER TABLE `professeurs`
  ADD PRIMARY KEY (`idP`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `idEt` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `idIns` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `idMat` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `professeurs`
--
ALTER TABLE `professeurs`
  MODIFY `idP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
