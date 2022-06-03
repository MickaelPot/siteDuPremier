-- phpMyAdmin SQL Dump
-- version 5.0.4deb2ubuntu5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 01 avr. 2022 à 23:51
-- Version du serveur :  8.0.28-0ubuntu0.21.10.3
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sitePremier`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220325094258', '2022-03-27 22:13:51', 24),
('DoctrineMigrations\\Version20220325094604', '2022-03-27 22:13:51', 11),
('DoctrineMigrations\\Version20220328093613', '2022-03-28 11:36:23', 75),
('DoctrineMigrations\\Version20220328094350', '2022-03-28 11:44:03', 96),
('DoctrineMigrations\\Version20220329185054', '2022-03-29 20:50:58', 92),
('DoctrineMigrations\\Version20220330094436', '2022-03-30 11:44:48', 56),
('DoctrineMigrations\\Version20220330125103', '2022-03-30 14:51:17', 115),
('DoctrineMigrations\\Version20220330125315', '2022-03-30 14:53:18', 120),
('DoctrineMigrations\\Version20220330130741', '2022-03-30 15:07:49', 73),
('DoctrineMigrations\\Version20220330191803', '2022-03-30 21:18:16', 62),
('DoctrineMigrations\\Version20220330200656', '2022-03-30 22:07:02', 89),
('DoctrineMigrations\\Version20220331075959', '2022-03-31 10:00:12', 29);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `langage_id` int NOT NULL,
  `auteur_id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chapeau` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `corps` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_signaled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `titre`, `langage_id`, `auteur_id`, `image`, `chapeau`, `corps`, `resume`, `is_signaled`) VALUES
(10, 'Apprendre les div', 10, 21, '/imageformation/avatar.jpg', 'CHapi chapô', '<h1>TItre 1</h1>\r\n\r\n<p>Vrai texte</p>', 'Ceci est un cours', 0),
(11, 'azerty', 10, 21, '/imageformation/avatar.jpg', 'Blabla', '<p>Titre</p>', 'fgezrhtrjtyjy', 0);

-- --------------------------------------------------------

--
-- Structure de la table `image_cours`
--

CREATE TABLE `image_cours` (
  `id` int NOT NULL,
  `formation_id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_file` longblob,
  `updates_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `langage`
--

CREATE TABLE `langage` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `langage`
--

INSERT INTO `langage` (`id`, `nom`) VALUES
(10, 'css');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biographie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `date_naissance`, `pseudo`, `biographie`, `photo`) VALUES
(19, 'admin@admin.fr', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$o506iWWkGNrOx5Dm5WYSJ.ZxGdECeEU1fauRK7BYuycoPkJ4mpyQO', 'admin', 'admin', '2009-01-01', 'administrateur', '<p><strong>Bonjour</strong></p>\r\n\r\n<p>Moi c&#39;est l&#39;administrateur du site</p>', '/imageavatar/avatar.jpg'),
(20, 'test@test.fr', '[\"ROLE_USER\"]', '$2y$13$uZhJKF4pNU.ogC8mqfd8M.hJpffPGzrfYn3HdfMNTrep8pcxpHpFS', 'test', 'test', '1920-01-01', 'test', NULL, '/imageavatar/avatar.jpg'),
(21, 'testt@gmail.com', '[\"ROLE_USER\"]', '$2y$13$dOKE6Vrv9dguI5BaXniheOm8ryFYJ5vYnwzBnRCIdFcL19cmmWUte', 'test', 'Test', '1939-01-01', 'Salut', '<p><strong>Blabla</strong></p>\r\n\r\n<p>Bonjour miam les frites ^&nbsp;</p>', '/imageavatar/avatar.jpg'),
(22, 'lambda@lambda.fr', '[\"ROLE_USER\"]', '$2y$13$O.KZ7.Zrp1RNqTbGJwgzYOzR3ynENDDIQ4OE0.EwLZlExx/3npP0S', 'l', 'l', '1920-01-01', 'lambda', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_404021BF957BB53C` (`langage_id`),
  ADD KEY `IDX_404021BF60BB6FE6` (`auteur_id`);

--
-- Index pour la table `image_cours`
--
ALTER TABLE `image_cours`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_EA8F08355200282E` (`formation_id`);

--
-- Index pour la table `langage`
--
ALTER TABLE `langage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_8D93D64986CC499D` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `image_cours`
--
ALTER TABLE `image_cours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `langage`
--
ALTER TABLE `langage`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `FK_404021BF60BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_404021BF957BB53C` FOREIGN KEY (`langage_id`) REFERENCES `langage` (`id`);

--
-- Contraintes pour la table `image_cours`
--
ALTER TABLE `image_cours`
  ADD CONSTRAINT `FK_EA8F08355200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
