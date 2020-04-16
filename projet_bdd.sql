-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 16 avr. 2020 à 15:19
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
-- Base de données :  `projet_bdd`
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
(4, 'nom', 'prenom', 'femme', '', '', 45, 'non', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `client_seance`
--

CREATE TABLE `client_seance` (
  `Id_client` int(11) NOT NULL,
  `Id_seance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `profession_client`
--

CREATE TABLE `profession_client` (
  `Id_profession` varchar(255) NOT NULL,
  `Id_client` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `psy`
--

CREATE TABLE `psy` (
  `Id_psy` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE `seance` (
  `Id_seance` int(11) NOT NULL,
  `Id_psy` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Heure` time NOT NULL,
  `Prix` int(11) NOT NULL,
  `Moyen_paiement` varchar(255) NOT NULL,
  `Remarques` text NOT NULL,
  `Nombre_client` int(11) NOT NULL,
  `Note_anxiete` int(11) NOT NULL
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
-- Index pour la table `client_seance`
--
ALTER TABLE `client_seance`
  ADD PRIMARY KEY (`Id_client`,`Id_seance`),
  ADD KEY `Seance_Client_Seance` (`Id_seance`);

--
-- Index pour la table `profession_client`
--
ALTER TABLE `profession_client`
  ADD PRIMARY KEY (`Id_profession`,`Id_client`),
  ADD KEY `Client_Profession_Client` (`Id_client`);

--
-- Index pour la table `psy`
--
ALTER TABLE `psy`
  ADD PRIMARY KEY (`Id_psy`);

--
-- Index pour la table `seance`
--
ALTER TABLE `seance`
  ADD PRIMARY KEY (`Id_seance`),
  ADD KEY `Spy_Seance` (`Id_psy`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `Id_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `psy`
--
ALTER TABLE `psy`
  MODIFY `Id_psy` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `seance`
--
ALTER TABLE `seance`
  MODIFY `Id_seance` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client_seance`
--
ALTER TABLE `client_seance`
  ADD CONSTRAINT `Client_Client_Seance` FOREIGN KEY (`Id_client`) REFERENCES `client` (`Id_Client`),
  ADD CONSTRAINT `Seance_Client_Seance` FOREIGN KEY (`Id_seance`) REFERENCES `seance` (`Id_seance`);

--
-- Contraintes pour la table `profession_client`
--
ALTER TABLE `profession_client`
  ADD CONSTRAINT `Client_Profession_Client` FOREIGN KEY (`Id_client`) REFERENCES `client` (`Id_Client`);

--
-- Contraintes pour la table `seance`
--
ALTER TABLE `seance`
  ADD CONSTRAINT `Spy_Seance` FOREIGN KEY (`Id_psy`) REFERENCES `psy` (`Id_psy`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
