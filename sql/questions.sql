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
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `qno` int(11) NOT NULL,
  `qtext` varchar(1000) NOT NULL,
  `nchoices` int(11) NOT NULL,
  `answer` int(11) DEFAULT NULL,
  PRIMARY KEY (`qno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qno`, `qtext`, `nchoices`, `answer`) VALUES
(1, 'The words in the bottom row are related in the same way as the words in the top row. For each item, find the word that completes the bottom row of words. <br />Candle:Lamp:Floodlight<br />Hut:Tent:?', 4, 4),
(2, 'Following consists of three statements. Based on the first two statements, the third statement may be true, false, or uncertain: <br />All the trees in the park are flowering trees.<br />Some of the trees in the park are dogwoods.<br />All dogwoods in the park are flowering trees.<br />If the first two statements are true, the third statement is', 4, 1),
(3, 'Following consists of three statements. Based on the first two statements, the third statement may be true, false, or uncertain:<br />Spot is bigger than King and smaller than Sugar. <br />Ralph is smaller than Sugar and bigger than Spot. <br />King is bigger than Ralph.<br />If the first two statements are true, the third statement is', 4, 2),
(4, 'Choose the statement that is best supported by the information given in the question passage.<br />During the last six years, the number of practicing physicians has increased by about 20%. During the same time period, the number of healthcare managers has increased by more than 600%. These percentages mean that many doctors have lost the authority to make their own schedules, determine the fees that they charge, and decide on prescribed treatments.<br />This paragraph best supports the statement that doctors', 5, 4),
(5, 'Read the below passage carefully and answer the questions:<br />Some groups want to outlaw burning the flag. They say that people have fought and died for the flag and that citizens of the United States ought to respect that. But 1 say that respect cannot be leg-islated. Also, most citizens who have served in the military did not fight for the flag, they fought for what the flag represents. Among the things the flag represents is freedom of speech, which includes, 1 believe, the right for a citizen to express displeasure with the government by burning the flag in protest.<br />Which of the following, if true, would weaken the speaker''s argument?', 5, 1),
(6, ' Read each paragraph carefully and answer the question given below it.<br />The consumption of harmful drugs by the people can be prevented not only by banning their sale in the market but also by instructing users about their dangerous effects which they must understand for their safety. Also the drug addicts may be provided with proper medical facilities for their rehabilitation. This will help in scaling down the use of drugs.<br />The passage best supports the statement that consumption of harmful drugs', 5, 4),
(7, ' The virtue of art does not allow the work to be interfered with or immediately ruled by anything other than itself. It insists that it alone shall touch the work in order to bring it into being. Art requires that nothing shall attain the work except through art itself.<br />This passage best supports the statement that:', 5, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
