-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 03, 2024 at 09:03 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PSGameTracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `Playlogs`
--

CREATE TABLE `Playlogs` (
  `logid` int(11) NOT NULL,
  `gameid` int(11) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `hours_played` decimal(5,1) DEFAULT NULL,
  `progress` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Playlogs`
--

INSERT INTO `Playlogs` (`logid`, `gameid`, `log_date`, `status`, `hours_played`, `progress`) VALUES
(1, 2, '2023-11-10', 'In Progress', '3.0', 'Completed first major mission'),
(2, 5, '2023-10-10', 'In Progress', '2.0', 'Challenged third boss'),
(3, 5, '2023-10-09', 'In Progress', '3.0', 'Explored new levels with co-op partner'),
(4, 7, '2023-09-29', 'In Progress', '4.0', 'Unlocked co-op mode'),
(5, 7, '2023-09-28', 'In Progress', '1.0', 'Game tutorial and initial mission'),
(6, 4, '2022-07-07', 'In Progress', '1.0', 'Encountered Great Shinobi Owl in Hirata Estate'),
(7, 4, '2022-06-07', 'In Progress', '5.0', 'Explored Fountainhead Palace and defeated True Corrupted Monk'),
(8, 4, '2022-02-07', 'In Progress', '3.0', 'Stuck in boss level: Demon of hatred'),
(9, 4, '2022-01-07', 'In Progress', '2.0', 'Defeated Guardian Ape in Sunken Valley'),
(10, 4, '2022-06-28', 'In Progress', '4.0', 'Explored Sunken Valley'),
(11, 8, '2022-03-14', 'In Progress', '5.0', 'Fought mini-bosses and collected loot'),
(12, 3, '2022-03-13', 'Completed', '3.0', 'Completed storyline'),
(13, 8, '2022-07-03', 'In Progress', '2.0', 'Initial Exploration'),
(14, 9, '2021-04-06', 'In Progress', '2.0', 'Encountered Mr X'),
(15, 9, '2021-04-13', 'In Progress', '3.0', 'Explored sewers'),
(16, 9, '2021-04-12', 'In Progress', '2.0', 'Retrieved electronic parts, restored power to facility'),
(17, 9, '2021-04-10', 'In Progress', '3.0', 'Explored underground area'),
(18, 9, '2021-03-07', 'In Progress', '2.0', 'Explored Police Station'),
(19, 4, '2021-02-21', 'In Progress', '4.0', 'Fought Genichiro Ashina atop Ashina Castle'),
(20, 4, '2021-02-20', 'In Progress', '3.0', 'Defeated Lady Butterfly in Hirata Estate'),
(21, 4, '2021-02-17', 'In Progress', '3.0', 'Defeated General Naomori Kawarada, acquired Shinobi Prosthetic'),
(22, 4, '2021-02-15', 'In Progress', '3.0', 'Introduction to combat and stealth mechanics'),
(23, 6, '2020-10-25', 'Completed', '5.0', 'Completed Side Quests with friend'),
(24, 6, '2020-10-22', 'Completed', '2.0', 'Completed Side Quests with friend'),
(25, 6, '2020-10-21', 'Completed', '6.0', 'Finished main co-op storyline'),
(26, 6, '2020-10-20', 'In Progress', '3.0', 'Explored quarantine zone, encountered special infected'),
(27, 6, '2020-10-15', 'In Progress', '2.0', 'Gathered supplies for survivors'),
(28, 6, '2020-10-11', 'In Progress', '3.0', 'Completed first main mission and rescued survivors'),
(29, 6, '2020-10-10', 'In Progress', '4.0', 'Introduction to parkour mechanics'),
(30, 11, '2019-08-25', 'Completed', '2.0', 'Finished main story line. Side quests undone'),
(31, 11, '2019-08-20', 'In Progress', '4.0', 'Defeated boss battle and acquired new skills'),
(32, 11, '2019-08-15', 'In Progress', '6.0', 'Completed main questline in another realm'),
(33, 11, '2019-08-14', 'In Progress', '4.0', 'Defeated first boss, acquired new weapon'),
(34, 11, '2019-08-13', 'In Progress', '5.0', 'Explored inloitial area, learned basic combat mechanics'),
(35, 10, '2018-04-24', 'Completed', '2.0', 'Completed storyline'),
(36, 10, '2018-04-23', 'In Progress', '4.0', 'Reached new settlement'),
(37, 10, '2018-04-20', 'In Progress', '4.0', 'Explored underground tunnels'),
(38, 10, '2018-04-13', 'In Progress', '3.0', 'Explored new city area, encountered hostile survivors'),
(39, 10, '2018-04-12', 'In Progress', '2.0', 'Character introductions');

--
-- Triggers `Playlogs`
--
DELIMITER $$
CREATE TRIGGER `update_psgames_stats` AFTER INSERT ON `Playlogs` FOR EACH ROW BEGIN
    DECLARE total_hours DECIMAL(5, 1);
    DECLARE final_status VARCHAR(50);

    -- Calculate total HoursPlayed for the GameId
    SELECT SUM(hours_played) INTO total_hours
    FROM Playlogs
    WHERE gameid = NEW.gameid;

    -- Get the final PlayStatus
    SELECT status INTO final_status
    FROM Playlogs
    WHERE gameid = NEW.gameid
    ORDER BY log_date DESC
    LIMIT 1;

    -- Update PSGames table
    UPDATE PSGames
    SET hours_played = total_hours,
        status = final_status
    WHERE gameid = NEW.gameid;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `PSGames`
--

CREATE TABLE `PSGames` (
  `gameid` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `player_mode` varchar(50) DEFAULT NULL,
  `released_date` date DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `hours_played` decimal(5,1) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PSGames`
--

INSERT INTO `PSGames` (`gameid`, `title`, `genre`, `player_mode`, `released_date`, `price`, `status`, `rating`, `hours_played`, `description`) VALUES
(1, 'Ghost of Tsushima', 'Action-Adventure', 'Single-player', '2020-07-17', '65.99', 'Not Started', NULL, NULL, 'Highly praised for its visual aesthetics'),
(2, 'God Of War Ragnorak', 'Action-Adventure', 'Single-player', '2022-11-09', '80.50', 'In Progress', 8, '3.0', 'Great storyline and combat mechanics'),
(3, 'Journey', 'Adventure', 'Multiplayer', '2012-03-13', '15.00', 'Completed', 8, '3.0', 'Beautiful and relaxing game'),
(4, 'Sekiro', 'Action-Adventure', 'Single-player', '2019-03-22', '59.50', 'In Progress', 10, '28.0', 'Extremely challenging combat with high replayability'),
(5, 'It Takes Two', 'Action-Adventure', 'Multiplayer', '2021-03-26', '35.99', 'In Progress', 9, '5.0', 'Co-op game that won game of the year'),
(6, 'Dying Light', 'Survival Horror', 'Single/multiplayer', '2015-01-27', '16.50', 'Completed', 10, '25.0', 'Intense parkour game and survival elements. Good coop.'),
(7, 'Dying Light 2: Stay Human', 'Survival Horror', 'Single/multiplayer', '2022-02-03', '59.99', 'In Progress', 8, '5.0', 'Expanded story and world but too many side quests involved'),
(8, 'Elden Ring', 'Action role-playing (RPG)', 'Single/multiplayer', '2022-02-25', '79.50', 'In Progress', 7, '7.0', 'Vast open world with deep lore but was not satisfied with the slow combat style'),
(9, 'Resident Evil 2', 'Survival Horror', 'Single-player', '2019-01-25', '20.00', 'In Progress', 8, '12.0', 'Classic horror game'),
(10, 'The Last of Us Remastered', 'Action-Adventure', 'Single-player', '2014-07-29', '30.50', 'Completed', 9, '15.0', 'Great storyline'),
(11, 'God Of War', 'Action-Adventure', 'Single-player', '2018-04-20', '0.00', 'Completed', 10, '21.0', 'Stunning visuals what won game of the year');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Playlogs`
--
ALTER TABLE `Playlogs`
  ADD PRIMARY KEY (`logid`),
  ADD KEY `gameid` (`gameid`);

--
-- Indexes for table `PSGames`
--
ALTER TABLE `PSGames`
  ADD PRIMARY KEY (`gameid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Playlogs`
--
ALTER TABLE `Playlogs`
  ADD CONSTRAINT `playlogs_ibfk_1` FOREIGN KEY (`gameid`) REFERENCES `PSGames` (`gameid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
