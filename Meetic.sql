-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 05 fév. 2025 à 19:56
-- Version du serveur : 8.0.41-0ubuntu0.24.04.1
-- Version de PHP : 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Meetic`
--

-- --------------------------------------------------------

--
-- Structure de la table `hobbies`
--

CREATE TABLE `hobbies` (
  `id` int NOT NULL COMMENT 'Identifiant unique',
  `name` varchar(50) NOT NULL COMMENT 'Nom du loisir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `hobbies`
--

INSERT INTO `hobbies` (`id`, `name`) VALUES
(119, 'Toilette'),
(120, 'Dormir'),
(121, 'Autre'),
(122, 'Lire'),
(123, 'Écrire'),
(124, 'Dessiner'),
(125, 'Peindre'),
(126, 'Photographie'),
(127, 'Cuisiner'),
(128, 'Jardinage'),
(129, 'Bricolage'),
(130, 'Voyager'),
(131, 'Randonnée'),
(132, 'Cyclisme'),
(133, 'Natation'),
(134, 'Yoga'),
(135, 'Méditation'),
(136, 'Danse'),
(137, 'Musique'),
(138, 'Chanter'),
(139, 'Théâtre'),
(140, 'Cinéma'),
(141, 'Jeux vidéo'),
(142, 'Jeux de société'),
(143, 'Échecs'),
(144, 'Poker'),
(145, 'Collectionner'),
(146, 'Tricoter'),
(147, 'Couture'),
(148, 'Broderie'),
(149, 'Poterie'),
(150, 'Sculpture'),
(151, 'Calligraphie'),
(152, 'Origami'),
(153, 'Astronomie'),
(154, 'Astrophotographie'),
(155, 'Observation des oiseaux'),
(156, 'Pêche'),
(157, 'Chasse'),
(158, 'Camping'),
(159, 'Escalade'),
(160, 'Surf'),
(161, 'Planche à voile'),
(162, 'Ski'),
(163, 'Snowboard'),
(164, 'Patinage sur glace'),
(165, 'Patinage à roulettes'),
(166, 'Course à pied'),
(167, 'Marathon'),
(168, 'Triathlon'),
(169, 'Golf'),
(170, 'Tennis'),
(171, 'Badminton'),
(172, 'Volley-ball'),
(173, 'Basket-ball'),
(174, 'Football'),
(175, 'Rugby'),
(176, 'Boxe'),
(177, 'Arts martiaux'),
(178, 'Escrime'),
(179, 'Équitation'),
(180, 'Polo'),
(181, 'Voile'),
(182, 'Plongée sous-marine'),
(183, 'Parapente'),
(184, 'Deltaplane'),
(185, 'Parachutisme'),
(186, 'Modélisme'),
(187, 'Maquettisme'),
(188, 'Jeux de rôle'),
(189, 'Cosplay'),
(190, 'Streaming'),
(191, 'Blogging'),
(192, 'Vlogging'),
(193, 'Podcasting'),
(194, 'Programmation'),
(195, 'Développement web'),
(196, 'Design graphique'),
(197, 'Animation 3D'),
(198, 'Montage vidéo'),
(199, 'Cryptographie'),
(200, 'Jeux de cartes'),
(201, 'Jeux de dés'),
(202, 'Jeux de stratégie'),
(203, 'Jeux de mots'),
(204, 'Jeux de mémoire'),
(205, 'Jeux de réflexion'),
(206, 'Jeux de hasard'),
(207, 'Jeux de rôle en ligne'),
(208, 'Jeux de simulation'),
(209, 'Jeux de gestion'),
(210, 'Jeux de tir'),
(211, 'Jeux de sport'),
(212, 'Jeux de combat'),
(213, 'Jeux de plateforme'),
(214, 'Jeux de puzzle'),
(215, 'Jeux de course');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL COMMENT 'Identifiant unique',
  `firstname` varchar(50) NOT NULL COMMENT 'Prénom',
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nom',
  `birthday` date NOT NULL COMMENT 'Date de Naissance',
  `gender` enum('Homme','Femme','Non-binaire','Gender fluide','Agender','Androgyne','Transgenre','Cisgenre','Intersexe','Autre') NOT NULL COMMENT 'Genre',
  `city` varchar(100) NOT NULL COMMENT 'Ville',
  `email` varchar(255) NOT NULL COMMENT 'Email',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Mot de passe hashé',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Compte actif (0 = supprimé, 1 = actif)',
  `profile_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `birthday`, `gender`, `city`, `email`, `password`, `is_active`, `profile_photo`) VALUES
(95, 'Fatima', 'Ait Ahmed Ouali ', '1998-03-22', 'Femme', '59200 Tourcoing, France', 'fatima.aao@gmail.com', '$2y$12$ZNIHeHGywrM8Szys8aROFOGqyPJPTcA2rSOD1hXKiM/QEADqv1WGC', 1, ''),
(96, 'Rigel', 'Codjia', '1999-01-14', 'Cisgenre', 'Lille, HDF, France', 'rigel.Codja@epitech.eu', '$2y$12$gylb1BLks58NVHfIKYByLe8ndnXKu1WKzUNt8poS8eE2/jQf2Ivba', 1, ''),
(97, 'Kahina', 'Lahouazi', '1989-10-12', 'Femme', '59120 Loos, France', 'kahina.lahouazi@epitech.eu', '$2y$12$NgHekYPdpa0IWwCRRMhO4egpwOEIpSTmQVpdALnO/DCkR1y5TfPRa', 1, ''),
(98, 'Ahmad', 'Salam', '1996-06-30', 'Homme', '59300 Valenciennes, France', 'ahmad.salam@epitech.eu', '$2y$12$zl9rw8MzE/Il7JNDIsmQ9emM76zqI8CtFmDN//LKWCVM5KnTCOcay', 1, ''),
(99, 'Bryan', 'Salome', '2002-06-11', 'Homme', '62840 Sailly-sur-la-Lys, France', 'bryan.salome@epitech.eu', '$2y$12$V4W3Y.5aM4sPrPTv3u3LLe9FMzXKqhfDLyJXu.YSPugrdScW2doKa', 1, ''),
(100, 'Billy', 'DJEZZAR', '1990-06-06', 'Homme', '59370 Mons-en-Barœul, France', 'Abdellah.DJEZZAR@epitech.eu', '$2y$12$wuimU8FkUteTB3z4voGVgOywMQrBrevFPqwamZGaJpWvLecqQLr/C', 1, ''),
(101, 'Aissa', 'RAMZI', '2003-02-05', 'Homme', 'Lille, HDF, France', 'Aissa.RAMZI@epitech.eu', '$2y$12$dZcBzOkBlNGlUXxOv8JY4OEtW3bqPo4tWPq/m/9mTfmT5jqlv1KvG', 1, ''),
(102, 'Augustin', 'VERISSIMO', '1998-01-30', 'Homme', '59100 Roubaix, France', 'Augustin.VERISSIMO@epitech.eu', '$2y$12$7Ni/8.ne1fsTA5d1Y4yKsut5dfZzrdGN9cxTdAsgniN6Boyj8uxm.', 1, ''),
(103, 'Aymeric', 'BODIN', '1990-10-13', 'Homme', 'Lille, HDF, France', 'Aymeric.BODIN@epitech.eu', '$2y$12$.xJDUFyhNo0srlzkn4vm0uwp3B2lDdAMvqSbKcQepScMwSpr5lpcq', 1, ''),
(104, 'Brahim', 'BOULAHIA', '1996-05-15', 'Homme', 'Lille, HDF, France', 'Brahim.BOULAHIA@epitech.eu', '$2y$12$CtRPex.Qe.ojtGvA.l3GtulU102S9W9kC55sG.XhYLIv6AFbsJDsm', 1, ''),
(105, 'Clémence', 'NEUVY', '2002-06-06', 'Femme', 'Lille, HDF, France', 'Clemence.NEUVY@epitech.eu', '$2y$12$nXDd.rVDOVHrMO0OaH4R6.OGVvwgkS8Fb8vQITRPLeB4ujaQaPoIq', 1, ''),
(106, 'Corentin', 'LOISÉE', '1996-02-06', 'Homme', 'Montpellier, OCC, France', 'Corentin.LOISEE@epitech.eu', '$2y$12$420xur2FI3JQidHRA7aaQOAx1/x9rY7F9nO.sC8BLeUbvWBFFd7Wm', 1, ''),
(107, 'Corentin', 'MARLIERE', '1998-02-13', 'Homme', 'Lille, HDF, France', 'Corentin.MARLIERE@epitech.eu', '$2y$12$.hQUN.ZC6gP0EBRpcG3tiOn4zvROn8yYcnEg6FiVGLWuClU/p905a', 1, ''),
(108, 'Dimitri', 'LEBEAU', '1995-06-14', 'Homme', '62400 Béthune, France', 'Dimitri.LEBEAU@epitech.eu', '$2y$12$7b17ePi6Jh2K7buEF1EaQucbty5amHlsH7w5TsCl/yh.sZ/b.aN8m', 1, ''),
(109, 'Elhadj', 'Abdoulaye DIALLO', '2003-05-27', 'Homme', 'Lille, HDF, France', 'Elhadj.Abdoulaye.DIALLO@epitech.eu', '$2y$12$cQ8b7H3utgesORUkAgG15eTwkk/nVkijk9uoqY/JWhU7lB3tNZvaS', 1, ''),
(110, 'Ethan', 'CARPENTIER', '1998-06-18', 'Homme', 'Lille, HDF, France', 'Ethan.CARPENTIER@epitech.eu', '$2y$12$6RWi6fXjE8G0JEzrDjQnf.gAX7cYjVXDUvOggkyT6K3fCXNWyq6dC', 1, ''),
(111, 'Fabien', 'PICAVEZ', '2003-06-04', 'Homme', 'Lille, HDF, France', 'Fabien.PICAVEZ@epitech.eu', '$2y$12$wSPOgknoVB9hIGSQUR3UBu5UpTDKN/nU.eL57ICKoGAMX6L/D/amq', 1, ''),
(112, 'Geoffrey', 'MASQUELIER', '2000-06-08', 'Homme', '59300 Valenciennes, France', 'Geoffrey.MASQUELIER@epitech.eu', '$2y$12$7397By1vPodZ4LJ7KPOLLO0TCF0wLwaWjL50PirwXWk86qGRRJRmq', 1, ''),
(113, 'Jonathan', 'YOKA LUSAVUKU', '2002-06-05', 'Homme', 'Villeneuve-d\'Ascq, HDF, France', 'Jonathan.YOKA.LUSAVUKU@epitech.eu', '$2y$12$67uuBucUxD0wCLOhCFxLc.hwbeF/2t2ZFNehuuq5EEqM.Q6ixtAWS', 1, ''),
(114, 'Lisa', 'DELESPAUL', '2004-01-07', 'Femme', 'Lille, HDF, France', 'Lisa.DELESPAUL@epitech.eu', '$2y$12$vxRntFVd/qD42.1BmyDNAeDOX8O0tzce.OyoTJX6Wl0pyx6XkrTNC', 1, ''),
(115, 'Marwan', 'ESSEGHIR', '2004-06-09', 'Homme', 'Lille, HDF, France', 'Marwan.ESSEGHIR@epitech.eu', '$2y$12$oDLhErd3JhhTXpLOya8Kz.o3Uh3BPH3vpGw.2lbugbDK7auM7pkfS', 1, ''),
(116, 'Mathéo', 'MINET', '1985-01-30', 'Homme', 'Lille, HDF, France', 'Matheo.MINET@epitech.eu', '$2y$12$JTVP44FguQqtrK4JvlUwZeOvpvkCIEToeiEBs3G3kitoIvAZk6cqm', 1, ''),
(117, 'Merveille', 'ARIKUNGOMA', '2001-06-13', 'Homme', '59100 Roubaix, France', 'Merveille.ARIKUNGOMA@epitech.eu', '$2y$12$tJpHSO40ob0GEzrwtJcnHuaFRBsBnLPtGAipUr/A9CcFLPcKt55Ta', 1, ''),
(118, 'Nathan', 'MOUSSOUNI', '2001-06-02', 'Homme', '59200 Tourcoing, France', 'Nathan.MOUSSOUNI@epitech.eu', '$2y$12$GV0nZkpqBl93BhPOWQDAFuFe/FHFap1SkZ3VX6ppO1ijBj1JGnv3y', 1, ''),
(119, 'Pierre', 'DECAUDIN', '2002-02-06', 'Homme', 'Lille, HDF, France', 'Pierre.DECAUDIN@epitech.eu', '$2y$12$J3XF4ZCECWPil1je7NCLMOPQ0d6eifFvw60m5cRC4raEC4OK8LGgq', 1, ''),
(120, 'Rédwan', 'BOUCHAIR', '2002-02-06', 'Homme', 'Lille, HDF, France', 'Redwan.BOUCHAIR@epitech.eu', '$2y$12$DCxl5dCWa9Cv58uFgooDsezHZKWqE0xW.pnzUfRNG7g6ihlJzcgA2', 1, ''),
(121, 'Ryan', 'CALOU', '2004-02-04', 'Homme', 'Lille, HDF, France', 'Ryan.CALOU@epitech.eu', '$2y$12$B6PV1kbP.Ry5dNdKu7x9d.vTumMyXOAFTZSlw8wFnkEg9yFwpcvMi', 1, ''),
(122, 'Sylvan', 'RUFIN', '1998-06-09', 'Homme', '62400 Béthune, France', 'Sylvan.RUFIN@epitech.eu', '$2y$12$0HPCTPufXK/d2/IDwViZ0eITbcORXXUExTy/iTcDefj7xhx6eeUCO', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `user_hobbies`
--

CREATE TABLE `user_hobbies` (
  `user_id` int NOT NULL COMMENT 'Référence à l''utilisateur',
  `hobby_id` int NOT NULL COMMENT 'Référence au loisir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user_hobbies`
--

INSERT INTO `user_hobbies` (`user_id`, `hobby_id`) VALUES
(95, 122),
(95, 131),
(95, 137),
(95, 151),
(95, 177),
(97, 120),
(97, 127),
(97, 137),
(98, 120),
(98, 141),
(98, 210),
(99, 137),
(99, 141),
(99, 189),
(100, 119),
(100, 131),
(100, 130),
(100, 189),
(101, 127),
(101, 135),
(101, 189),
(101, 137),
(101, 125),
(102, 195),
(102, 194),
(102, 141),
(102, 190),
(102, 156),
(103, 130),
(103, 131),
(103, 137),
(103, 141),
(103, 194),
(104, 127),
(104, 176),
(104, 151),
(104, 136),
(104, 150),
(105, 125),
(105, 133),
(105, 141),
(105, 190),
(105, 167),
(106, 141),
(106, 122),
(106, 120),
(107, 127),
(107, 190),
(107, 137),
(107, 194),
(107, 193),
(107, 192),
(107, 191),
(108, 131),
(108, 123),
(108, 208),
(108, 170),
(109, 135),
(109, 130),
(109, 150),
(109, 149),
(109, 141),
(110, 127),
(110, 141),
(110, 174),
(110, 120),
(111, 132),
(111, 158),
(111, 122),
(111, 141),
(111, 120),
(111, 136),
(112, 141),
(112, 137),
(112, 190),
(112, 197),
(113, 137),
(113, 120),
(113, 127),
(113, 177),
(113, 176),
(114, 137),
(114, 136),
(114, 134),
(115, 133),
(115, 131),
(115, 194),
(115, 195),
(116, 137),
(116, 120),
(116, 136),
(117, 136),
(117, 137),
(117, 127),
(117, 138),
(117, 133),
(117, 134),
(118, 177),
(118, 176),
(118, 127),
(118, 138),
(118, 140),
(118, 141),
(118, 150),
(118, 190),
(119, 136),
(119, 121),
(119, 127),
(119, 138),
(119, 150),
(119, 160),
(119, 169),
(119, 184),
(119, 120),
(120, 125),
(120, 194),
(120, 195),
(120, 124),
(120, 200),
(120, 141),
(121, 128),
(121, 141),
(121, 184),
(121, 120),
(121, 127),
(122, 120),
(122, 135),
(122, 167),
(122, 128),
(122, 129),
(122, 127),
(122, 133),
(122, 124),
(96, 130),
(96, 125),
(96, 121);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `user_hobbies`
--
ALTER TABLE `user_hobbies`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hobby_id` (`hobby_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique', AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique', AUTO_INCREMENT=133;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user_hobbies`
--
ALTER TABLE `user_hobbies`
  ADD CONSTRAINT `user_hobbies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_hobbies_ibfk_2` FOREIGN KEY (`hobby_id`) REFERENCES `hobbies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
