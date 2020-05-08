-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 08 mai 2020 à 14:48
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
  `DoB` varchar(255) NOT NULL,
  `Situation` varchar(255) NOT NULL,
  `Couple_avec` int(11) DEFAULT NULL,
  `Moyen_connu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`Id_Client`, `Nom`, `Prenom`, `Genre`, `Email`, `Mdp`, `DoB`, `Situation`, `Couple_avec`, `Moyen_connu`) VALUES
(21, 'Mathieu', 'Cantagrel', 'homme', 'mathieu@test.test', 'oui', '1999-05-06', 'non', 0, 'projet'),
(23, 'Arta', 'Jacke', 'femme', 'jackarta@test.test', 'test', '1976-02-10', 'non', 0, 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `profession`
--

CREATE TABLE `profession` (
  `Id_profession` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `profession`
--

INSERT INTO `profession` (`Id_profession`, `description`) VALUES
(1, 'ingenieur'),
(2, 'militaire'),
(3, 'etudiant'),
(4, 'oui'),
(5, 'professeur'),
(6, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `profession_client`
--

CREATE TABLE `profession_client` (
  `Id_profession` int(11) NOT NULL,
  `Id_client` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `profession_client`
--

INSERT INTO `profession_client` (`Id_profession`, `Id_client`, `Date`) VALUES
(3, 21, '2020-05-01'),
(5, 21, '2020-04-22'),
(6, 23, '2020-05-08');

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
  MODIFY `Id_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `profession`
--
ALTER TABLE `profession`
  MODIFY `Id_profession` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `seance`
--
ALTER TABLE `seance`
  MODIFY `Id_seance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

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
  ADD CONSTRAINT `Seance_client2` FOREIGN KEY (`Id_client2`) REFERENCES `client` (`Id_Client`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `Seance_client3` FOREIGN KEY (`Id_client3`) REFERENCES `client` (`Id_Client`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
