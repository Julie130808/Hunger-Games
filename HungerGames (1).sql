-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql-server
-- Généré le : jeu. 30 avr. 2026 à 14:46
-- Version du serveur : 8.4.8
-- Version de PHP : 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `HungerGames`
--

-- --------------------------------------------------------

--
-- Structure de la table `Asso_FAVORITES_GAME`
--

CREATE TABLE `Asso_FAVORITES_GAME` (
  `id_game` int NOT NULL,
  `id_favorites` int NOT NULL
) ENGINE=InnoDB DEFAULT ;

--
-- Déchargement des données de la table `Asso_FAVORITES_GAME`
--

INSERT INTO `Asso_FAVORITES_GAME` (`id_game`, `id_favorites`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ASSO_GAME_CATEGORY`
--

CREATE TABLE `ASSO_GAME_CATEGORY` (
  `id_game` int NOT NULL,
  `id_category` int NOT NULL
) ENGINE=InnoDB DEFAULT ;

--
-- Déchargement des données de la table `ASSO_GAME_CATEGORY`
--

INSERT INTO `ASSO_GAME_CATEGORY` (`id_game`, `id_category`) VALUES
(1, 1),
(3, 1),
(5, 1),
(2, 2),
(6, 2),
(4, 3),
(11, 3),
(7, 4),
(9, 4),
(12, 4),
(8, 5),
(10, 5);

-- --------------------------------------------------------

--
-- Structure de la table `CATEGORY`
--

CREATE TABLE `CATEGORY` (
  `id_category` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT ;

--
-- Déchargement des données de la table `CATEGORY`
--

INSERT INTO `CATEGORY` (`id_category`, `name`, `description`) VALUES
(1, 'Stratégie', 'Jeux de réflexion et de planification'),
(2, 'Famille', 'Jeux accessibles pour tous'),
(3, 'Initiés', 'Jeux pour joueurs intermédiaires'),
(4, 'Ambiance', 'Jeux festifs et conviviaux'),
(5, 'Expert', 'Jeux complexes pour joueurs expérimentés'),
(6, 'Stratégie', 'Jeux de réflexion et de planification'),
(7, 'Famille', 'Jeux accessibles pour tous'),
(8, 'Initiés', 'Jeux pour joueurs intermédiaires'),
(9, 'Ambiance', 'Jeux festifs et conviviaux'),
(10, 'Expert', 'Jeux complexes pour joueurs expérimentés'),
(11, 'Stratégie', 'Jeux de réflexion et de planification'),
(12, 'Famille', 'Jeux accessibles pour tous'),
(13, 'Initiés', 'Jeux pour joueurs intermédiaires'),
(14, 'Ambiance', 'Jeux festifs et conviviaux'),
(15, 'Expert', 'Jeux complexes pour joueurs expérimentés'),
(16, 'Stratégie', 'Jeux de réflexion et de planification'),
(17, 'Famille', 'Jeux accessibles pour tous'),
(18, 'Initiés', 'Jeux pour joueurs intermédiaires'),
(19, 'Ambiance', 'Jeux festifs et conviviaux'),
(20, 'Expert', 'Jeux complexes pour joueurs expérimentés'),
(21, 'Stratégie', 'Jeux de réflexion et de planification'),
(22, 'Famille', 'Jeux accessibles pour tous'),
(23, 'Initiés', 'Jeux pour joueurs intermédiaires'),
(24, 'Ambiance', 'Jeux festifs et conviviaux'),
(25, 'Expert', 'Jeux complexes pour joueurs expérimentés');

-- --------------------------------------------------------

--
-- Structure de la table `COMMENT`
--

CREATE TABLE `COMMENT` (
  `id_comment` int NOT NULL,
  `id_game` int NOT NULL,
  `id_user` int NOT NULL,
  `note` decimal(2,1) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT ;

--
-- Déchargement des données de la table `COMMENT`
--

INSERT INTO `COMMENT` (`id_comment`, `id_game`, `id_user`, `note`, `content`, `created_at`) VALUES
(1, 2, 1, 3.0, 'Bon jeu , assez facile à prendre en main, mais un peu redondant à la longue, toujours sympa entre amis malgré tout.', '2026-03-24 09:55:33'),
(2, 2, 1, 2.0, 'jeu simple et efficace mais trop répétitif', '2026-03-25 15:38:32');

-- --------------------------------------------------------

--
-- Structure de la table `FAVORITES`
--

CREATE TABLE `FAVORITES` (
  `id_favorites` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT ;

--
-- Déchargement des données de la table `FAVORITES`
--

INSERT INTO `FAVORITES` (`id_favorites`, `id_user`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `GAME`
--

CREATE TABLE `GAME` (
  `id_game` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `players` int NOT NULL,
  `duration` int NOT NULL,
  `description` text NOT NULL,
  `détails` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT ;

--
-- Déchargement des données de la table `GAME`
--

INSERT INTO `GAME` (`id_game`, `name`, `image`, `rating`, `players`, `duration`, `description`, `détails`) VALUES
(1, 'Catan', 'https://x.boardgamearena.net/data/gamemedia/catan/box/en_280.png', 4.5, 4, 90, 'Construisez des colonies et des routes sur l\'île de Catan', 'Catan est un jeu de stratégie et de négociation dans lequel les joueurs colonisent une île riche en ressources. En récoltant bois, argile, blé, mouton et minerai, ils construisent routes, colonies et villes. Les échanges entre joueurs sont centraux et rendent chaque partie unique. L\'équilibre entre développement, diplomatie et adaptation aux tirages de dés est essentiel pour l\'emporter.'),
(2, 'Azul', 'https://x.boardgamearena.net/data/gamemedia/azul/box/en_280.png', 2.5, 4, 38, 'Créez de magnifiques mosaïques pour décorer le palais', 'Azul est un jeu abstrait élégant où les joueurs décorent les murs d\'un palais portugais avec des tuiles colorées. À chaque tour, le choix des tuiles influence directement les options des adversaires. Simple à apprendre mais très tactique, Azul demande anticipation et optimisation pour marquer un maximum de points tout en évitant les pénalités de fin de manche.'),
(3, 'Wingspan', 'https://x.boardgamearena.net/data/gamemedia/wingspan/box/en_280.png', 4.6, 5, 55, 'Attirez les plus beaux oiseaux dans votre volière', 'Wingspan est un jeu de stratégie basé sur la construction de moteur, où chaque joueur développe une réserve naturelle accueillant différentes espèces d\'oiseaux. Chaque carte possède un pouvoir unique inspiré du monde réel. Le jeu mêle gestion de ressources, planification à long terme et thème très immersif, le tout servi par une direction artistique soignée.'),
(4, '7 Wonders', 'https://x.boardgamearena.net/data/gamemedia/sevenwonders/box/en_280.png', 4.4, 7, 30, 'Développez votre civilisation à travers les âges', '7 Wonders est un jeu de draft rapide et dynamique dans lequel les joueurs dirigent une civilisation antique. À travers trois âges, ils développent leur économie, leur puissance militaire, leurs sciences et leurs merveilles. Toutes les actions se déroulent simultanément, garantissant un rythme fluide et une excellente jouabilité, même à nombreux joueurs.'),
(5, 'Pandemic', 'https://x.boardgamearena.net/data/gamemedia/pandemic/box/en_280.png', 4.5, 4, 45, 'Coopérez pour sauver l\'humanité de maladies mortelles', 'Pandemic est un jeu coopératif tendu où les joueurs incarnent des experts luttant contre la propagation de maladies à l\'échelle mondiale. Chaque rôle possède des capacités spécifiques, et la victoire dépend d\'une coordination parfaite. La pression monte à mesure que les épidémies se multiplient, obligeant le groupe à prendre des décisions difficiles et urgentes.'),
(6, 'Ticket to Ride', 'https://x.boardgamearena.net/data/gamemedia/tickettoride/box/en_280.png', 4.3, 5, 45, 'Construisez des routes de train à travers le pays', 'Ticket to Ride est un jeu accessible et convivial dans lequel les joueurs construisent des lignes de chemin de fer reliant différentes villes. En collectant des cartes de couleurs et en complétant des objectifs secrets, chacun cherche à optimiser son réseau. Le jeu offre un savant mélange de tactique, de blocage léger et de planification.'),
(7, 'Loup-Garou', '/HungerGames/assets/images/les-loups-garous-de-thiercelieux-p-image-78125-grande.webp', 4.6, 18, 45, 'Un village paisible est menacé par des loups-garous. Découvrez qui se cache derrière ces créatures', 'Loup-Garou est un jeu d\'ambiance basé sur la discussion, la déduction et le bluff. Chaque joueur incarne secrètement un rôle, villageois ou loup-garou. À travers débats et votes, le village tente d\'éliminer la menace, tandis que les loups-garous cherchent à semer le doute. L\'animateur joue un rôle clé dans le rythme et l\'ambiance.'),
(8, 'Dune Imperium', '/HungerGames/assets/images/dune.png', 4.8, 4, 90, 'Combinez deck-building et placement d\'ouvriers dans l\'univers de Dune', 'Dune Imperium est un jeu stratégique exigeant combinant deck-building et placement d\'ouvriers. Les joueurs incarnent des maisons cherchant à dominer Arrakis en gérant influence politique, ressources et puissance militaire. Chaque décision est cruciale, entre alliances temporaires et conflits ouverts. Le thème est fortement intégré aux mécaniques, offrant une expérience immersive et profonde.'),
(9, 'Dixit', '/HungerGames/assets/images/dixit.webp', 4.5, 6, 30, 'Racontez des histoires à travers des illustrations oniriques', 'Dixit est un jeu créatif et poétique où l\'imagination est reine. À chaque tour, un joueur décrit une carte illustrée de façon énigmatique, tandis que les autres tentent de deviner laquelle est la sienne. Trop clair ou trop vague, le message peut coûter des points. Le jeu favorise échanges, rires et interprétations personnelles.'),
(10, 'Terraforming Mars', 'https://x.boardgamearena.net/data/gamemedia/terraformingmars/box/en_280.png', 4.7, 5, 105, 'Transformez la planète rouge en monde habitable', 'Terraforming Mars est un jeu de gestion et de développement où les joueurs dirigent des corporations chargées de rendre Mars habitable. En jouant des projets, ils augmentent température, oxygène et océans tout en développant leur moteur économique. Le jeu propose une grande profondeur stratégique, une forte rejouabilité et un excellent mode solo.'),
(11, 'Splendor', 'https://x.boardgamearena.net/data/gamemedia/splendor/box/en_280.png', 4.4, 4, 30, 'Devenez un riche marchand de pierres précieuses', 'Splendor est un jeu de gestion épuré où les joueurs incarnent des marchands de la Renaissance cherchant à acquérir des mines et des artisans. En collectant des jetons et en investissant intelligemment, ils réduisent leurs coûts futurs. Les règles simples cachent une réelle profondeur tactique, idéale pour des parties rapides mais très compétitives.'),
(12, 'Time\'s Up!', '/HungerGames/assets/images/timesup.png', 4.3, 12, 45, 'Faites deviner un maximum de personnages à votre équipe', 'Time\'s Up! est un jeu d\'ambiance incontournable basé sur la communication et la mémoire. En plusieurs manches, les joueurs doivent faire deviner des personnages d\'abord librement, puis avec un seul mot, et enfin par le mime. L\'énergie monte au fil des tours, garantissant rires et complicité. Idéal pour les groupes et les soirées festives.');

-- --------------------------------------------------------

--
-- Structure de la table `USER_`
--

CREATE TABLE `USER_` (
  `id_user` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `conditions` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT ;

--
-- Déchargement des données de la table `USER_`
--

INSERT INTO `USER_` (`id_user`, `name`, `email`, `password`, `conditions`, `created_at`) VALUES
(1, 'Julie', 'julie0510@live.fr', '$2y$12$meA0Wl3cClG0nzD/0FdFOeYjxh/TeR./ol8dWOZRs5678d7x9S396', 'accepted', '2026-03-11 15:01:15');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Asso_FAVORITES_GAME`
--
ALTER TABLE `Asso_FAVORITES_GAME`
  ADD PRIMARY KEY (`id_game`,`id_favorites`),
  ADD KEY `id_favorites` (`id_favorites`);

--
-- Index pour la table `ASSO_GAME_CATEGORY`
--
ALTER TABLE `ASSO_GAME_CATEGORY`
  ADD PRIMARY KEY (`id_game`,`id_category`),
  ADD KEY `id_category` (`id_category`);

--
-- Index pour la table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  ADD PRIMARY KEY (`id_category`);

--
-- Index pour la table `COMMENT`
--
ALTER TABLE `COMMENT`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_game` (`id_game`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `FAVORITES`
--
ALTER TABLE `FAVORITES`
  ADD PRIMARY KEY (`id_favorites`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `GAME`
--
ALTER TABLE `GAME`
  ADD PRIMARY KEY (`id_game`);

--
-- Index pour la table `USER_`
--
ALTER TABLE `USER_`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `COMMENT`
--
ALTER TABLE `COMMENT`
  MODIFY `id_comment` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `FAVORITES`
--
ALTER TABLE `FAVORITES`
  MODIFY `id_favorites` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `GAME`
--
ALTER TABLE `GAME`
  MODIFY `id_game` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `USER_`
--
ALTER TABLE `USER_`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Asso_FAVORITES_GAME`
--
ALTER TABLE `Asso_FAVORITES_GAME`
  ADD CONSTRAINT `Asso_FAVORITES_GAME_ibfk_1` FOREIGN KEY (`id_game`) REFERENCES `GAME` (`id_game`),
  ADD CONSTRAINT `Asso_FAVORITES_GAME_ibfk_2` FOREIGN KEY (`id_favorites`) REFERENCES `FAVORITES` (`id_favorites`);

--
-- Contraintes pour la table `ASSO_GAME_CATEGORY`
--
ALTER TABLE `ASSO_GAME_CATEGORY`
  ADD CONSTRAINT `ASSO_GAME_CATEGORY_ibfk_1` FOREIGN KEY (`id_game`) REFERENCES `GAME` (`id_game`),
  ADD CONSTRAINT `ASSO_GAME_CATEGORY_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `CATEGORY` (`id_category`);

--
-- Contraintes pour la table `COMMENT`
--
ALTER TABLE `COMMENT`
  ADD CONSTRAINT `COMMENT_ibfk_1` FOREIGN KEY (`id_game`) REFERENCES `GAME` (`id_game`),
  ADD CONSTRAINT `COMMENT_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `USER_` (`id_user`);

--
-- Contraintes pour la table `FAVORITES`
--
ALTER TABLE `FAVORITES`
  ADD CONSTRAINT `FAVORITES_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USER_` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
