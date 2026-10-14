-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2026 at 12:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `f`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `adresse` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `prenom`, `email`, `telephone`, `adresse`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@mail.com', '0601020304', '12 rue des Lilas, Paris'),
(2, 'Martin', 'Claire', 'claire.martin@mail.com', '0605060708', '5 avenue Victor Hugo, Lyon'),
(3, 'Bernard', 'Luc', 'luc.bernard@mail.com', '0603040506', '22 boulevard Haussmann, Marseille'),
(4, 'mohiyedine', 'fatima', 'fmohiyedine@gmail.com', '0662053262', '164 jbel tghat 1 fes');

-- --------------------------------------------------------

--
-- Table structure for table `command`
--

CREATE TABLE `command` (
  `id_commande` int(11) NOT NULL,
  `date_commande` date DEFAULT NULL,
  `statut` varchar(20) DEFAULT NULL,
  `mantant_total` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `command`
--

INSERT INTO `command` (`id_commande`, `date_commande`, `statut`, `mantant_total`, `id_client`) VALUES
(1, '2025-05-01', 'livrée', 780, 1),
(2, '2025-05-03', 'en cours', 780, 2),
(3, '2025-05-05', 'annulée', 120, 3),
(4, '2025-05-07', 'livrée', 765, 1),
(5, '2025-06-02', 'livré', 122, 2),
(6, '2025-06-06', 'livrée s', 990, 4),
(8, '2025-06-10', 'livrée', 3110, 3);

-- --------------------------------------------------------

--
-- Table structure for table `lignecommande`
--

CREATE TABLE `lignecommande` (
  `id_commande` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `prix_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lignecommande`
--

INSERT INTO `lignecommande` (`id_commande`, `id_produit`, `quantite`, `prix_total`) VALUES
(1, 1, 1, 750.00),
(1, 4, 2, 30.00),
(2, 2, 1, 600.00),
(2, 5, 1, 180.00),
(3, 3, 1, 120.00),
(4, 1, 1, 750.00),
(4, 4, 1, 15.00),
(6, 1, 1, 750.00),
(6, 3, 2, 240.00),
(8, 1, 2, 1500.00),
(8, 2, 1, 600.00),
(8, 3, 2, 240.00),
(8, 5, 2, 360.00),
(8, 6, 1, 410.00);

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `nom_produit` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `prix_unitaire` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom_produit`, `description`, `prix_unitaire`, `stock`) VALUES
(1, 'Ordinateur Portable', 'HP Pavilion 15 pouces', 750.00, 15),
(2, 'Smartphone', 'Samsung Galaxy S21', 600.00, 25),
(3, 'Imprimante', 'Canon Pixma TS5050', 120.00, 10),
(4, 'Clé USB 64Go', 'Clé USB Sandisk 64Go', 15.00, 50),
(5, 'Écran 24\"', 'Écran Dell Full HD 24 pouces', 180.00, 20),
(6, 'produit', 'hp pavillion', 410.00, 17);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` text NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `login`, `password`) VALUES
(1, 'alaoui karime', 'admin', 'admin'),
(3, 'manssouri', '123ahmed', '147857');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `command`
--
ALTER TABLE `command`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `lignecommande`
--
ALTER TABLE `lignecommande`
  ADD PRIMARY KEY (`id_commande`,`id_produit`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `command`
--
ALTER TABLE `command`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `command`
--
ALTER TABLE `command`
  ADD CONSTRAINT `command_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lignecommande`
--
ALTER TABLE `lignecommande`
  ADD CONSTRAINT `lignecommande_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `command` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lignecommande_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
