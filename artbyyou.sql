-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 26, 2023 at 03:05 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artbyyou`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `AboutID` int(11) NOT NULL,
  `HomePage` text NOT NULL,
  `Story` text NOT NULL,
  `AboutImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`AboutID`, `HomePage`, `Story`, `AboutImage`) VALUES
(1, 'A community of artists coming together to share personal work and consignment pieces for the general public. Do you have what it takes?', 'Lorem ipsum dolor sit amet, consectetur at et lectus sed risus tristique molestie.', 'files/AllArt.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `ArtistID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `ArtistImage` varchar(50) NOT NULL,
  `Type` varchar(100) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`ArtistID`, `Name`, `ArtistImage`, `Type`, `Description`) VALUES
(1, 'Mike Posner', 'files/artists/MikePosner.jpg', 'Food Lover', 'Lorem ipsum dolor sit amet, consectetur at et lectus sed risus tristique molestie.'),
(2, 'Jhon Kali', 'files/artists/JhonKali.jpg', 'Country Lover', 'Donec pretium mi turpis, in aliquet enim mattis et. Nunc pretium, risus at pulvinar tincidunt, lorem dolor feugiat turpis, vitae tristique massa nibh eu magna'),
(3, 'Reymond Murphy', 'files/artists/ReymondMurphy.jpg', 'Water Photographer', 'Ut elementum ac orci vitae finibus. Etiam commodo ti. erat quis ultrices mollis. Praesent vitae rhoncus lacus, s'),
(4, 'Rosaline Max', 'files/artists/RosalineMax.jpg', 'Crafts Artist', 'Morbi eu vestibulum leo. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus'),
(5, 'Ananya Patel', 'files/artists/AnanyaPatel.jpg', 'Painter', 'hendrerit magna eget, ullamcorper malesuada tellus. Vestibulum vestibulum non nunc bibendum interdum. Vivamus iaculis ultrices purus id tincidu'),
(6, 'Alice Kelly', 'files/artists/AliceKelly.jpg', 'Animal Lover', 'Maecenas vulputate ligula quis consequat malesuada. Cras lacinia malesuada sodales. Quisque venenatis'),
(7, 'Alexa Turner', 'files/artists/AlexaTurner.jpg', 'Flowers Photographer', 'Nullam rutrum vulputate risus, sit amet consequat dui feugiat nec. Nullam finibus lectus elit, sed maximus'),
(8, 'Natalie Kay', 'files/artists/NatalieKay.jpg', ' Architecture Photographer', 'Duis sodales malesuada nisi, et vehicula lectus maximus non. Sed iaculis turpis id lectus sollicitudin, non sodales lorem accumsan.'),
(9, 'Max Payne', 'files/artists/MaxPayne.jpg', 'Musician', 'I am very passionate'),
(10, 'Scarlet Mitchel', 'files/artists/ScarletMitchel.jpg', 'Wood Artists', 'I am very good at wood work');

-- --------------------------------------------------------

--
-- Table structure for table `artwork`
--

CREATE TABLE `artwork` (
  `ArtID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `ArtImage` varchar(50) NOT NULL,
  `ThemeID` int(11) NOT NULL,
  `ArtistID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artwork`
--

INSERT INTO `artwork` (`ArtID`, `Title`, `ArtImage`, `ThemeID`, `ArtistID`) VALUES
(1, 'Gold and Green', 'files/Flowers/Flower1_Alexa.jpg', 5, 7),
(2, 'Sweet Pink', 'files/Flowers/Flower2_Alexa.jpg', 5, 7),
(3, 'Yellow from the Sun', 'files/Flowers/Flower3_Alexa.jpg', 5, 7),
(4, 'Daffodil Violet', 'files/Flowers/Flower4_Alexa.jpg', 5, 7),
(5, 'Red and Pink', 'files/Flowers/Flower5_Alexa.jpg', 5, 7),
(6, 'White Cream', 'files/Flowers/Flower6_Alexa.jpg', 5, 7),
(7, 'Wind and Warm', 'files/Country Side/Country1_Jhon.jpg', 3, 2),
(8, 'Dry and Cold', 'files/Country Side/Country2_Jhon.jpg', 3, 2),
(9, 'Life in Green', 'files/Country Side/Country3_Jhon.jpg', 3, 2),
(10, 'Golden Wind', 'files/Country Side/Country4_Jhon.jpg', 3, 2),
(11, 'Red in White', 'files/Country Side/Country5_Jhon.jpg', 3, 2),
(12, 'Upside down', 'files/Water/Water1_Reymond.jpg', 8, 3),
(13, 'Life in Water', 'files/Water/Water2_Reymond.jpg', 8, 3),
(14, 'Shallow Blue', 'files/Water/Water3_Reymond.jpg', 8, 3),
(15, 'Sunset time Water', 'files/Water/Water4_Reymond.jpg', 8, 3),
(16, 'Black and White', 'files/Water/Water5_Reymond.jpg', 8, 3),
(17, 'Surfing and Water', 'files/Water/Water6_Reymond.jpg', 8, 3),
(18, 'Spirals', 'files/Crafts/Craft1_Rosaline.jpg', 4, 4),
(19, 'Continental Crafts', 'files/Crafts/Craft2_Rosaline.jpg', 4, 4),
(20, 'WhiteCrafts', 'files/Crafts/Craft3_Rosaline.jpg', 4, 4),
(21, 'Various Crafts', 'files/Crafts/Craft4_Rosaline.jpg', 4, 4),
(22, 'Mug Crafts', 'files/Crafts/Craft5_Rosaline.jpg', 4, 4),
(23, 'Plate and Mug', 'files/Crafts/Craft6_Rosaline.jpg', 4, 4),
(24, 'Mix Fruit', 'files/Paintings/Painting1_Ananya.jpg', 6, 5),
(25, 'Sun and Flower', 'files/Paintings/Painting2_Ananya.jpg', 6, 5),
(26, 'Sunset ', 'files/Paintings/Painting3_Ananya.jpg', 6, 5),
(27, 'Crystal Water', 'files/Paintings/Painting4_Ananya.jpg', 6, 5),
(28, 'Orange Skin', 'files/Paintings/Painting5_Ananya.jpg', 6, 5),
(29, 'Oreo', 'files/Paintings/Painting6_Ananya.jpg', 6, 5),
(30, 'Spicy', 'files/Foods/Posner1.jpg', 7, 1),
(31, 'Sweet and Spice', 'files/Foods/Posner2.jpg', 7, 1),
(32, 'Sweet', 'files/Foods/Posner3.jpg', 7, 1),
(33, 'Life in Whiite', 'files/Animal/Animal1_Alice.jpg', 1, 6),
(34, 'Angry Birds', 'files/Animal/Animal2_Alice.jpg', 1, 6),
(35, 'Couple Birds', 'files/Animal/Animal3_Alice.jpg', 1, 6),
(36, 'Friends in a branch', 'files/Animal/Animal4_Alice.jpg', 1, 6),
(37, 'Buildings facing sun', 'files/Architecture/Arch1_Natalie.jpg', 2, 8),
(38, 'Sky scrappers', 'files/Architecture/Arch2_Natalie.jpg', 2, 8),
(39, 'Modern Buildings', 'files/Architecture/Arch3_Natalie.jpg', 2, 8),
(40, 'Sunset Town', 'files/Architecture/Arch4_Natalie.jpg', 2, 8),
(41, 'Upside down world', 'files/Architecture/Arch5_Natalie.jpg', 2, 8),
(42, 'Sibling Buildings', 'files/Architecture/Arch6_Natalie.jpg', 2, 8),
(43, 'Sun and  Sea', 'files/Water/Water7_Reymond.jpg', 8, 3),
(44, 'Glowing Cake', 'files/Foods/Posner4.jpg', 7, 1),
(45, 'Black and White', 'files/Animal/Animal5_Alice.jpg', 1, 6),
(46, 'Love Birds', 'files/Animal/Animal6_Alice.jpg', 1, 6),
(47, 'Green and Yellow', 'files/Foods/Posner5.jpg', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `signin`
--

CREATE TABLE `signin` (
  `UserID` int(11) NOT NULL,
  `ArtistID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `signin`
--

INSERT INTO `signin` (`UserID`, `ArtistID`, `Username`, `Password`) VALUES
(1, 9, 'MaxPayne', 'Max123'),
(2, 10, 'ScarletM', 'Scarlet123'),
(3, 6, 'aliceKelly', 'alice123'),
(4, 1, 'mikePosner', 'mike123');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `ThemeID` int(11) NOT NULL,
  `Theme` varchar(100) NOT NULL,
  `ThemeImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`ThemeID`, `Theme`, `ThemeImage`) VALUES
(1, 'Animal', 'files/Animal/Animal1_Alice.jpg'),
(2, 'Architecture', 'files/Architecture/Arch1_Natalie.jpg'),
(3, 'Country Side', 'files/Country Side/Country1_Jhon.jpg'),
(4, 'Crafts', 'files/Crafts/Craft3_Rosaline.jpg'),
(5, 'Flowers', 'files/Flowers/Flower1_Alexa.jpg'),
(6, 'Paintings', 'files/Paintings/Painting4_Ananya.jpg'),
(7, 'Foods', 'files/Foods/Posner2.jpg'),
(8, 'Water', 'files/Water/Water2_Reymond.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`AboutID`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`ArtistID`);

--
-- Indexes for table `artwork`
--
ALTER TABLE `artwork`
  ADD PRIMARY KEY (`ArtID`),
  ADD KEY `FK1` (`ThemeID`),
  ADD KEY `FK2` (`ArtistID`);

--
-- Indexes for table `signin`
--
ALTER TABLE `signin`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `FK3` (`ArtistID`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`ThemeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `AboutID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `ArtistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `artwork`
--
ALTER TABLE `artwork`
  MODIFY `ArtID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `signin`
--
ALTER TABLE `signin`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `ThemeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artwork`
--
ALTER TABLE `artwork`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`ThemeID`) REFERENCES `theme` (`ThemeID`),
  ADD CONSTRAINT `FK2` FOREIGN KEY (`ArtistID`) REFERENCES `artists` (`ArtistID`);

--
-- Constraints for table `signin`
--
ALTER TABLE `signin`
  ADD CONSTRAINT `FK3` FOREIGN KEY (`ArtistID`) REFERENCES `artists` (`ArtistID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
