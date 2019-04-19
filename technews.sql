-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 18 avr. 2019 à 17:02
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `technews`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spotlight` tinyint(1) NOT NULL,
  `special` tinyint(1) NOT NULL,
  `date_cretion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `categorie_id`, `membre_id`, `titre`, `slug`, `contenu`, `featured_image`, `spotlight`, `special`, `date_cretion`) VALUES
(1, 1, 1, 'Notre-Dame de Paris : pourra-t-on la reconstruire en 5 ans ?', 'notre-dame-de-paris-pourra-t-on-la-reconstruire-en-5-ans', '<p>Bâtie en presque 200 ans, la cathédrale Notre-Dame de Paris se prépare à un chantier pharaonique pour retrouver son éclat. Mais quand pouvoir débuter les travaux ? Pour le moment, l\'heure est au diagnostic. La structure a été fragilisée par les tonnes d\'eau déversée pour éteindre l\'incendie. Il faudra ensuite démonter l\'immense échafaudage.</p>', '19113767.jpg', 1, 0, '2019-04-17 14:19:12'),
(2, 1, 1, '\"Reconstruire Notre-Dame en cinq années\": quelles contraintes le délai avancé par Emmanuel Macron impose-t-il?', 'reconstruire-notre-dame-en-cinq-annees-quelles-contraintes-le-delai-avance-par-emmanuel-macron-impose-t-il', '<p>Redonner à Notre-Dame sa silhouette d\'origine en cinq ans : c\'est l\'objectif colossal que s\'est engagé à tenir le président de la République, mardi 16 avril. Au lendemain de l\'incendie qui a ravagé la cathédrale, cette annonce a surpris plusieurs spécialistes étant donné l\'ampleur de la tâche. \"C\'est inenvisageable de livrer un tel chantier dans cinq ans, estime Rémi Desalbres, le président de l\'association des Architectes du patrimoine auprès de franceinfo. A moins d\'utiliser des techniques et des manières de procéder qui seraient une nouvelle plaie faite à Notre-Dame.\"</p>', '19122455.jpg', 1, 0, '2019-04-18 08:06:07'),
(3, 3, 1, 'Audiences radio : France Inter détrône RTL et devient la radio la plus écoutée de France', 'audiences-radio-france-inter-detrone-rtl-et-devient-la-radio-la-plus-ecoutee-de-france', '<p>C\'est une grande première pour la station publique. France Inter est devenue la première radio de France depuis le début de l\'année 2019, devant RTL, selon les chiffres d\'audiences publiés jeudi 18 avril par Médiamétrie. De son côté, Europe 1 s\'est de nouveau effondrée.</p>', '19124919.jpg', 1, 0, '2019-04-18 08:07:38'),
(4, 4, 1, 'Notre-Dame de Paris : le monde de la culture se mobilise pour la reconstruction', 'notre-dame-de-paris-le-monde-de-la-culture-se-mobilise-pour-la-reconstruction', '<p>Le roman de Victor Hugo \"Notre-Dame de Paris\", publié en 1831, est devenu numéro un des ventes de livres sur internet depuis l\'incendie qui a ravagé lundi la cathédrale. </p>', '19123351.jpg', 0, 0, '2019-04-18 08:10:27'),
(5, 5, 1, 'Foot : Liverpool et Tottenham se qualifient pour les demi-finales de la Ligue des champions', 'foot-liverpool-et-tottenham-se-qualifient-pour-les-demi-finales-de-la-ligue-des-champions', '<p>Tout droit vers les demi-finales ! Liverpool et Tottenham se sont qualifiés pour les demi-finales de la Ligue des champions, mercredi 17 avril. Après leur victoire 2-0 au match aller, les coéquipiers de Mohamed Salah ont facilement battu le FC Porto 1 à 4. Les Reds affronteront le FC Barcelone au prochain tour.</p>', '19123863.jpg', 1, 0, '2019-04-18 08:12:35');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `slug`) VALUES
(1, 'Politique', 'politique'),
(3, 'Economie', 'economie'),
(4, 'Culture', 'culture'),
(5, 'Sport', 'Sport');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_inscription` datetime NOT NULL,
  `derniere_connexion` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `prenom`, `nom`, `email`, `password`, `date_inscription`, `derniere_connexion`, `roles`) VALUES
(1, 'Hugo', 'LIEGEARD', 'hugo@technews.com', 'test', '2019-04-17 14:19:12', NULL, 'a:1:{i:0;s:11:\"ROLE_AUTEUR\";}');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190417122703', '2019-04-17 12:29:30'),
('20190417124122', '2019-04-17 12:41:34');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_23A0E66BCF5E72D` (`categorie_id`),
  ADD KEY `IDX_23A0E666A99F74A` (`membre_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_497DD634989D9B62` (`slug`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F6B4FB29E7927C74` (`email`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E666A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`),
  ADD CONSTRAINT `FK_23A0E66BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
