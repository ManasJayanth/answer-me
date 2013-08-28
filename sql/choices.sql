-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 28, 2013 at 09:02 PM
-- Server version: 5.5.32
-- PHP Version: 5.3.10-1ubuntu3.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `answerMe`
-- For a quick start use the values

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE IF NOT EXISTS `choices` (
  `qno` int(11) DEFAULT NULL,
  `cno` int(11) DEFAULT NULL,
  `choice` varchar(100) NOT NULL,
  KEY `qno` (`qno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`qno`, `cno`, `choice`) VALUES
(1, 1, ' Tent '),
(1, 2, 'City '),
(1, 3, 'Dwelling '),
(1, 4, 'House '),
(2, 1, ' True '),
(2, 2, 'False '),
(2, 3, 'Uncertain '),
(2, 4, 'None of these '),
(3, 1, ' True'),
(3, 2, 'False '),
(3, 3, 'Uncertain '),
(3, 4, 'None of these '),
(4, 1, 'resent the interference of healthcare managers.'),
(4, 2, 'no longer have adequate training. '),
(4, 3, 'care a great deal about their patients '),
(4, 4, 'are less independent than they used to be. '),
(4, 5, 'are making a lot less money than they used to make. '),
(5, 1, ' An action is not considered a part of freedom of speech.'),
(5, 2, 'People who burn the flag usually commit other crimes as well. '),
(5, 3, 'The flag was not recognized by the government until 1812. '),
(5, 4, 'State flags are almost never burned '),
(5, 5, 'Most people are against flag burning. '),
(6, 1, ' are on increase in the society.'),
(6, 2, 'can always be reduced. '),
(6, 3, 'are due to lack of medical facilities. '),
(6, 4, 'can be eliminated with the help of banning their sale. '),
(6, 5, 'may be channelized through proper system. '),
(7, 1, ' art is governed by external rules and conditions.'),
(7, 2, 'art is for the sake of art and life. '),
(7, 3, 'art is for the sake of art alone. '),
(7, 4, 'artist realises his dreams through his artistic creation. '),
(7, 5, 'artist should use his art for the sake of society.');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_ibfk_1` FOREIGN KEY (`qno`) REFERENCES `questions` (`qno`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
