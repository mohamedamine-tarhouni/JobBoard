-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 27 sep. 2023 à 17:51
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
-- Base de données : `jobboard_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cities`
--

INSERT INTO `cities` (`id`, `city`) VALUES
(1, 'Paris'),
(2, 'Bordeaux'),
(3, 'Nantes'),
(4, 'Lyon'),
(5, 'Marseille');

-- --------------------------------------------------------

--
-- Structure de la table `contracts`
--

CREATE TABLE `contracts` (
  `id` int(11) NOT NULL,
  `contract_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contracts`
--

INSERT INTO `contracts` (`id`, `contract_type`) VALUES
(1, 'CDI'),
(2, 'CDD'),
(3, 'Alternance'),
(4, 'Stage'),
(5, 'Temps plein'),
(6, 'Temps partiel'),
(7, 'Job étudiant');

-- --------------------------------------------------------

--
-- Structure de la table `enterprises`
--

CREATE TABLE `enterprises` (
  `id` int(11) NOT NULL,
  `enterprise_name` varchar(255) DEFAULT 'Nouvelle Entreprise',
  `enterprise_image` longtext DEFAULT NULL,
  `enterprise_description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `enterprises`
--

INSERT INTO `enterprises` (`id`, `enterprise_name`, `enterprise_image`, `enterprise_description`) VALUES
(3, 'SubSkill', NULL, 'une entreprise'),
(4, 'COLLAB APP', NULL, 'Une entreprise de la PropTech(Property Technologie)'),
(5, 'Societe générale', NULL, 'Une banque française'),
(6, 'Boursorama', NULL, 'Une banque française'),
(7, 'Ubisoft', NULL, 'Une entreprise de développement des jeux vidéos'),
(8, 'Rockstar Games', NULL, 'Une entreprise de développement des jeux vidéos'),
(9, 'Eiffage', NULL, 'Une entreprise de la PropTech(Property Technologie)');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `jobs`
--

INSERT INTO `jobs` (`id`, `job_type`) VALUES
(1, 'Programmation'),
(2, 'Administration'),
(3, 'Marketing'),
(4, 'UI/UX Design'),
(5, 'Cyber Sécurité'),
(6, 'Infra');

-- --------------------------------------------------------

--
-- Structure de la table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `offer_title` varchar(255) NOT NULL,
  `offer_description` longtext NOT NULL,
  `city` int(11) DEFAULT NULL,
  `reference` varchar(255) NOT NULL,
  `created_at` text DEFAULT NULL,
  `updated_at` text DEFAULT NULL,
  `contract_type` int(11) DEFAULT NULL,
  `job_type` int(11) DEFAULT NULL,
  `enterprise_id` int(11) NOT NULL,
  `offer_image` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `offers`
--

INSERT INTO `offers` (`id`, `offer_title`, `offer_description`, `city`, `reference`, `created_at`, `updated_at`, `contract_type`, `job_type`, `enterprise_id`, `offer_image`) VALUES
(38, 'Administrateur réseaux', 'Infrastructure du site', 1, 'XnS0JjRg0DJuklurA3kF', '26/09/2023 à 12:01', NULL, 3, 6, 3, NULL),
(39, 'Gameplay programmer', 'Développement des mécanismes du jeux en utilisant Unity <br />\r\nLe candidat doit avoir une connaissance en Unity et C#', 3, 'Mb0hWEz9ET16jS3SIRaK', '26/09/2023 à 22:11', NULL, 5, 1, 3, NULL),
(40, 'Développeur java', 'test edit', 4, 'c5A53aEcvKx0eQ7R42Bq', '26/09/2023 à 23:11', '26/09/2023 à 23:11', 1, 2, 5, NULL),
(41, 'Développeur web ', 'Expérience avec le framework Laravel avec une connaissance en PHP et MySQL', 2, '8VDTDDSqFUsi7MTzDYOR', '26/09/2023 à 21:11', '27/09/2023 à 13:02', 5, 1, 5, NULL),
(45, 'Chef de projet UX/UI', 'Chef de projet pour le département de l&#039;équipe design', 1, 'RmkTedC9eGe7US0ju8MI', '27/09/2023 à 14:38', NULL, 1, 1, 5, 'https://images.unsplash.com/photo-1573495612522-9e401cc84a4f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w1MDgyNjN8MHwxfHNlYXJjaHwxfHxJVHxlbnwwfHx8fDE2OTU4MTQyNjB8MA&ixlib=rb-4.0.3&q=80&w=1080');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `image` longtext DEFAULT NULL,
  `enterprise_id` int(11) DEFAULT NULL,
  `password` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `mail`, `username`, `image`, `enterprise_id`, `password`) VALUES
(6, 'medaminetarhouni21@gmail.com', 'Midouch', NULL, 3, '$2y$10$oUFoGhct/QHZZoo8U7NaV.WofOiaOMK5v470jBjN4rjOyhdw4wA6q'),
(7, 'amine@test.com', 'Midouch22', NULL, 3, '$2y$10$lzSG3tw3YDwyzuoVdUoN/uSnz9mkUAy1gFJ2IIaqrKMN.UF/zFWlO'),
(8, 'dede@gmail.com', 'dede', NULL, 5, '$2y$10$P3W/cwZQBeieAz18KKxwmurNNO0nNjW7Y2I5KsT7Kex2ZEzc7suqK');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `enterprises`
--
ALTER TABLE `enterprises`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_ibfk_1` (`job_type`),
  ADD KEY `contract_type` (`contract_type`),
  ADD KEY `city` (`city`),
  ADD KEY `enterprise_id` (`enterprise_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ibfk_1` (`enterprise_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `enterprises`
--
ALTER TABLE `enterprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`job_type`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_ibfk_2` FOREIGN KEY (`contract_type`) REFERENCES `contracts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_ibfk_3` FOREIGN KEY (`city`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_ibfk_4` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`enterprise_id`) REFERENCES `enterprises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
