-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 02 mai 2020 à 18:49
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `psychologue`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `Id_admin` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`Id_admin`, `Email`, `Mdp`) VALUES
(1, 'admin@admin.admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `Id_Client` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Genre` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `Situation` varchar(255) NOT NULL,
  `Couple_avec` int(11) DEFAULT NULL,
  `Moyen_connu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`Id_Client`, `Nom`, `Prenom`, `Genre`, `Email`, `Mdp`, `Age`, `Situation`, `Couple_avec`, `Moyen_connu`) VALUES
(4, 'nom', 'prenom', 'femme', '', '', 45, 'non', 0, ''),
(5, 'test', 'test', 'femme', 'test@test', '', 5, 'non', 0, 'oui'),
(6, 'Jack', 'Arta', 'homme', 'jackarta@test.test', 'oui', 38, 'non', 0, ''),
(7, 'Paul', 'Ogne', 'enfant', 'paulogne@test.test', '', 5, 'non', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `profession`
--

CREATE TABLE `profession` (
  `Id_profession` int(11) NOT NULL,
  `descrition` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `profession_client`
--

CREATE TABLE `profession_client` (
  `Id_profession` int(11) NOT NULL,
  `Id_client` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE `seance` (
  `Id_seance` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  `Prix` int(11) DEFAULT NULL,
  `Moyen_paiement` varchar(255) DEFAULT NULL,
  `Remarques` text DEFAULT NULL,
  `Nombre_client` int(11) NOT NULL,
  `Note_anxiete` int(11) DEFAULT NULL,
  `Id_client1` int(11) NOT NULL,
  `Id_client2` int(11) DEFAULT NULL,
  `Id_client3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `seance`
--

INSERT INTO `seance` (`Id_seance`, `Date`, `Heure`, `Prix`, `Moyen_paiement`, `Remarques`, `Nombre_client`, `Note_anxiete`, `Id_client1`, `Id_client2`, `Id_client3`) VALUES
(46, '2020-05-11', '11:30:00', NULL, NULL, NULL, 3, NULL, 4, 6, 7),
(47, '2020-05-11', '11:00:00', NULL, NULL, NULL, 3, NULL, 4, 6, 7);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id_admin`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Id_Client`),
  ADD KEY `Client_Client` (`Couple_avec`);

--
-- Index pour la table `profession`
--
ALTER TABLE `profession`
  ADD PRIMARY KEY (`Id_profession`);

--
-- Index pour la table `profession_client`
--
ALTER TABLE `profession_client`
  ADD PRIMARY KEY (`Id_profession`,`Id_client`),
  ADD KEY `Client_Profession_Client` (`Id_client`);

--
-- Index pour la table `seance`
--
ALTER TABLE `seance`
  ADD PRIMARY KEY (`Id_seance`),
  ADD KEY `Seance_client1` (`Id_client1`),
  ADD KEY `Seance_client2` (`Id_client2`),
  ADD KEY `Seance_client3` (`Id_client3`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `Id_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `profession`
--
ALTER TABLE `profession`
  MODIFY `Id_profession` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `seance`
--
ALTER TABLE `seance`
  MODIFY `Id_seance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `profession_client`
--
ALTER TABLE `profession_client`
  ADD CONSTRAINT `Client_Profession_Client` FOREIGN KEY (`Id_client`) REFERENCES `client` (`Id_Client`),
  ADD CONSTRAINT `Client_Profession_Profession` FOREIGN KEY (`Id_profession`) REFERENCES `profession` (`Id_profession`);

--
-- Contraintes pour la table `seance`
--
ALTER TABLE `seance`
  ADD CONSTRAINT `Seance_client1` FOREIGN KEY (`Id_client1`) REFERENCES `client` (`Id_Client`),
  ADD CONSTRAINT `Seance_client2` FOREIGN KEY (`Id_client2`) REFERENCES `client` (`Id_Client`),
  ADD CONSTRAINT `Seance_client3` FOREIGN KEY (`Id_client3`) REFERENCES `client` (`Id_Client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
