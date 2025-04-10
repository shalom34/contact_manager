-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 08 avr. 2025 à 18:34
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `contact_manager_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `CONTACT_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(100) NOT NULL,
  `LAST_NAME` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(200) DEFAULT NULL,
  `PHONE` varchar(25) NOT NULL,
  `EMAIL` varchar(150) DEFAULT NULL,
  `SOCIALS` text DEFAULT NULL COMMENT 'This will store all the users socials urls with their ids in json data type',
  `PHOTO` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`CONTACT_ID`, `USER_ID`, `FIRST_NAME`, `LAST_NAME`, `DESCRIPTION`, `PHONE`, `EMAIL`, `SOCIALS`, `PHOTO`) VALUES
(1, 1, 'Irumva', 'Shalom', 'CEO', '+25761258468', 'irumvashalom@gmail.com', '[\n        {\"fb\": \"\",\n        \"wp\": \"\",\n        \"insta\": \"\",\n        \"x\": \"\"\n        }\n      ]', ''),
(16, 1, 'jkhhsd', 'hhdhdh', 'dghdghhdg', '66477844', 'irumvashailom@gmail.com', '[\n        {\"fb\": \"\",\n        \"wp\": \"\",\n        \"insta\": \"\",\n        \"x\": \"\",\n        }\n      ]', NULL),
(18, 1, 'Jane', 'Doe', 'Manager', '+25712345678', 'jane.doe@example.com', NULL, NULL),
(19, 1, 'John', 'Smith', 'Developer', '+25787654321', 'john.smith@example.com', NULL, NULL),
(20, 1, 'Alice', 'Johnson', 'Designer', '+25756473829', 'alice.johnson@example.com', '[\n        {\"fb\": \"\",\n        \"wp\": \"\",\n        \"insta\": \"\",\n        \"x\": \"\"\n        }\n      ]', ''),
(21, 1, 'Bob', 'Brown', 'Accountant', '+25783726190', 'bob.brown@example.com', NULL, NULL),
(22, 1, 'Charlie', 'Williams', 'HR', '+25724536789', 'charlie.williams@example.com', NULL, NULL),
(23, 1, 'David', 'Taylor', 'Engineer', '+25712345876', 'david.taylor@example.com', NULL, NULL),
(24, 1, 'Emma', 'Martinez', 'Analyst', '+25756478923', 'emma.martinez@example.com', NULL, NULL),
(25, 1, 'Grace', 'Lee', 'Consultant', '+25798765432', 'grace.lee@example.com', NULL, NULL),
(26, 1, 'Henry', 'Garcia', 'Technician', '+25723456789', 'henry.garcia@example.com', NULL, NULL),
(27, 1, 'Kevin', 'Walker', 'Operator', '+25734567892', 'kevin.walker@example.com', NULL, NULL),
(28, 1, 'Linda', 'Young', 'Writer', '+25745678923', 'linda.young@example.com', NULL, NULL),
(29, 1, 'Mike', 'Scott', 'Artist', '+25756789124', 'mike.scott@example.com', NULL, NULL),
(30, 1, 'Nancy', 'Hill', 'Educator', '+25767891245', 'nancy.hill@example.com', NULL, NULL),
(31, 1, 'Olivia', 'Campbell', 'Salesperson', '+25778912356', 'olivia.campbell@example.com', NULL, NULL),
(32, 1, 'Zoe', 'King', 'Entrepreneur', '+25789023456', 'zoe.king@example.com', NULL, NULL),
(33, 1, 'Adam', 'Smiths', 'Engineer', '+25711111111', 'adam.smith@example.com', '[\n        {\"fb\": \"\",\n        \"wp\": \"\",\n        \"insta\": \"\",\n        \"x\": \"\"\n        }\n      ]', ''),
(34, 1, 'Betty', 'Taylor', 'Designer', '+25722222222', 'betty.taylor@example.com', NULL, NULL),
(36, 1, 'Diana', 'Johnson', 'Photographer', '+25744444444', 'diana.johnson@example.com', NULL, NULL),
(37, 1, 'Evan', 'Miller', 'Doctor', '+25755555555', 'evan.miller@example.com', NULL, NULL),
(38, 1, 'Fiona', 'Garcia', 'Artist', '+25766666666', 'fiona.garcia@example.com', NULL, NULL),
(39, 1, 'George', 'Moore', 'Writer', '+25777777777', 'george.moore@example.com', NULL, NULL),
(40, 1, 'Hannah', 'Lee', 'Consultant', '+25788888888', 'hannah.lee@example.com', NULL, NULL),
(41, 1, 'Ivan', 'Clark', 'Manager', '+25799999999', 'ivan.clark@example.com', NULL, NULL),
(42, 1, 'Julia', 'Adams', 'Accountant', '+25712312312', 'julia.adams@example.com', NULL, NULL),
(43, 1, 'Kevin', 'Turner', 'Chef', '+25732132132', 'kevin.turner@example.com', NULL, NULL),
(44, 1, 'Lila', 'Carter', 'Developer', '+25721321321', 'lila.carter@example.com', NULL, NULL),
(45, 1, 'Mike', 'Robinson', 'Analyst', '+25731231231', 'mike.robinson@example.com', NULL, NULL),
(46, 1, 'Nina', 'Walker', 'Nurse', '+25713131313', 'nina.walker@example.com', NULL, NULL),
(47, 1, 'Oscar', 'King', 'Pilot', '+25723123123', 'oscar.king@example.com', NULL, NULL),
(48, 1, 'Paula', 'Allen', 'Dentist', '+25713213213', 'paula.allen@example.com', NULL, NULL),
(49, 1, 'Quinn', 'Harris', 'Scientist', '+25722112211', 'quinn.harris@example.com', NULL, NULL),
(50, 1, 'Rachel', 'Wright', 'Librarian', '+25733223322', 'rachel.wright@example.com', NULL, NULL),
(51, 1, 'Steve', 'Bell', 'Architect', '+25744334433', 'steve.bell@example.com', NULL, NULL),
(53, 1, 'Uma', 'Young', 'Athlete', '+25766556655', 'uma.young@example.com', NULL, NULL),
(54, 1, 'Victor', 'Scott', 'Mechanic', '+25777667766', 'victor.scott@example.com', NULL, NULL),
(55, 1, 'Wendy', 'Evans', 'Salesperson', '+25788778877', 'wendy.evans@example.com', NULL, NULL),
(56, 1, 'Xander', 'Cruz', 'Student', '+25799889988', 'xander.cruz@example.com', NULL, NULL),
(57, 1, 'Yara', 'Lopez', 'Biologist', '+25711211211', 'yara.lopez@example.com', NULL, NULL),
(58, 1, 'Zane', 'Perry', 'Entrepreneur', '+25722322322', 'zane.perry@example.com', NULL, NULL),
(60, 1, 'Bella', 'Collins', 'Pilot', '+25744544544', 'bella.collins@example.com', '[\n        {\"fb\": \"\",\n        \"wp\": \"\",\n        \"insta\": \"\",\n        \"x\": \"\"\n        }\n      ]', ''),
(62, 1, 'Dana', 'Hughes', 'CEO', '+25766766766', 'dana.hughes@example.com', '[\n        {\"fb\": \"\",\n        \"wp\": \"\",\n        \"insta\": \"\",\n        \"x\": \"\"\n        }\n      ]', ''),
(63, 1, 'Eddie', 'Fox', 'Principal', '+25777877877', 'eddie.fox@example.com', NULL, NULL),
(64, 1, 'Faye', 'Howard', 'Clerk', '+25788988988', 'faye.howard@example.com', NULL, NULL),
(65, 1, 'Gina', 'Foster', 'Geologist', '+25799099099', 'gina.foster@example.com', NULL, NULL),
(66, 1, 'Harold', 'Murphy', 'Lawyer', '+25712121212', 'harold.murphy@example.com', NULL, NULL),
(67, 1, 'Isla', 'Price', 'Editor', '+25723232323', 'isla.price@example.com', NULL, NULL),
(68, 1, 'Jack', 'Carter', 'Producer', '+25734343434', 'jack.carter@example.com', NULL, NULL),
(69, 1, 'Kara', 'Griffin', 'Actor', '+25745454545', 'kara.griffin@example.com', NULL, NULL),
(70, 1, 'Liam', 'Bailey', 'Consultant', '+25756565656', 'liam.bailey@example.com', NULL, NULL),
(71, 1, 'Maya', 'Reed', 'Singer', '+25767676767', 'maya.reed@example.com', NULL, NULL),
(72, 1, 'Noah', 'Jenkins', 'Director', '+25778787878', 'noah.jenkins@example.com', NULL, NULL),
(73, 1, 'Olive', 'Dixon', 'Chef', '+25789898989', 'olive.dixon@example.com', NULL, NULL),
(74, 1, 'Paul', 'Hayes', 'Engineer', '+25790909090', 'paul.hayes@example.com', NULL, NULL),
(75, 1, 'Quincy', 'Jordan', 'Teacher', '+25714141414', 'quincy.jordan@example.com', NULL, NULL),
(76, 1, 'Ruby', 'Cole', 'Scientist', '+25715151515', 'ruby.cole@example.com', NULL, NULL),
(77, 1, 'Sam', 'Morgan', 'Therapist', '+25716161616', 'sam.morgan@example.com', NULL, NULL),
(79, 1, 'Ursula', 'Knight', 'Veterinarian', '+25718181818', 'ursula.knight@example.com', NULL, NULL),
(80, 1, 'Victor', 'Hart', 'Consultant', '+25719191919', 'victor.hart@example.com', NULL, NULL),
(82, 1, 'James', 'Taylor', 'Dad', '+25798765432', 'james.taylor@example.com', NULL, NULL),
(83, 1, 'Lucy', 'Johnson', 'Bestie', '+25745678912', 'lucy.johnson@example.com', NULL, NULL),
(84, 1, 'Oliver', 'Brown', 'Brother', '+25778912345', 'oliver.brown@example.com', NULL, NULL),
(85, 1, 'Emma', 'Davis', 'Sister', '+25732165487', 'emma.davis@example.com', NULL, NULL),
(86, 1, 'Charlie', 'Miller', 'Uncle', '+25765432198', 'charlie.miller@example.com', NULL, NULL),
(87, 1, 'Sophia', 'Garcia', 'Aunt', '+25767894567', 'sophia.garcia@example.com', NULL, NULL),
(88, 1, 'Mason', 'Moore', 'Cousin', '+25789012345', 'mason.moore@example.com', NULL, NULL),
(89, 1, 'Hannah', 'White', 'Friend', '+25712398765', 'hannah.white@example.com', NULL, NULL),
(90, 1, 'Noah', 'Adams', 'Mentor', '+25745632178', 'noah.adams@example.com', NULL, NULL),
(91, 1, 'Liam', 'Carter', 'Colleague', '+25778965432', 'liam.carter@example.com', NULL, NULL),
(92, 1, 'Olivia', 'Martinez', 'Neighbor', '+25798712345', 'olivia.martinez@example.com', NULL, NULL),
(93, 1, 'Ethan', 'Clark', 'Coach', '+25756789012', 'ethan.clark@example.com', NULL, NULL),
(94, 1, 'Grace', 'Turner', 'Teacher', '+25723456789', 'grace.turner@example.com', NULL, NULL),
(95, 1, 'Daniel', 'Hill', 'Partner', '+25787654321', 'daniel.hill@example.com', NULL, NULL),
(96, 1, 'Sophia', 'Evans', 'Grandma', '+25765432190', 'sophia.evans@example.com', NULL, NULL),
(97, 1, 'Lucas', 'Harris', 'Grandpa', '+25798765401', 'lucas.harris@example.com', NULL, NULL),
(98, 1, 'Zoe', 'Walker', 'Buddy', '+25712345698', 'zoe.walker@example.com', NULL, NULL),
(99, 1, 'Jack', 'Allen', 'Classmate', '+25745678901', 'jack.allen@example.com', NULL, NULL),
(100, 1, 'Chloe', 'Wright', 'Roommate', '+25778912301', 'chloe.wright@example.com', NULL, NULL),
(102, 1, 'Ella', 'Mitchell', 'Family Friend', '+25711223344', 'ella.mitchell@example.com', NULL, NULL),
(103, 1, 'Berry', 'Bell', 'Gym Partner', '+25722334455', 'aaron.bell@example.com', '[\n        {\"fb\": \"\",\n        \"wp\": \"\",\n        \"insta\": \"\",\n        \"x\": \"\"\n        }\n      ]', ''),
(104, 1, 'Rachel', 'Young', 'Book Club Buddy', '+25733445566', 'rachel.young@example.com', NULL, NULL),
(105, 1, 'Henry', 'King', 'Travel Companion', '+25744556677', 'henry.king@example.com', NULL, NULL),
(106, 1, 'hdfhfdh', 'KJHGDS', 'JHGSDHFJKF', '647674632', 'amour@gmail.com', '[\n        {\"fb\": \"\",\n        \"wp\": \"\",\n        \"insta\": \"\",\n        \"x\": \"\",\n        }\n      ]', ''),
(108, 1, 'jksdhj', 'hjhchh', 'hhdshj', '77837378', '', '[\n        {\"fb\": \"\",\n        \"wp\": \"\",\n        \"insta\": \"\",\n        \"x\": \"\",\n        }\n      ]', 'uploads/profiles/bipemacho (1).jpg'),
(110, 1, 'Arakaza', 'Aime', 'My friend', '66753982', 'aime@gmail.com', '[\n        {\"fb\": \"https://www.facebook.com/Ctrlteam257\",\n        \"wp\": \"61258468\",\n        \"insta\": \"https://www.facebook.com/Ctrlteam\",\n        \"x\": \"https://www.facebook.com/Ctrlteam2563737\"\n        }\n      ]', 'uploads/profiles/Eid mubarak (1).jpg'),
(112, 1, 'Restaurant', 'Homemade', 'My favorite restaurant ever', '78992673', 'resto@gmail.com', '[\n        {\"fb\": \"\",\n        \"wp\": \"\",\n        \"insta\": \"\",\n        \"x\": \"\"\n        }\n      ]', ''),
(113, 1, 'Kamana', 'Stephy', 'My Hacker friend', '66739873', 'kamanastephy@gmail.com', '[\n        {\"fb\": \"\",\n        \"wp\": \"\",\n        \"insta\": \"\",\n        \"x\": \"\"\n        }\n      ]', '');

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

CREATE TABLE `favorites` (
  `FAVORITE_ID` int(11) NOT NULL,
  `CONTACT_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `favorites`
--

INSERT INTO `favorites` (`FAVORITE_ID`, `CONTACT_ID`) VALUES
(17, 112),
(21, 33);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL,
  `USERNAME` varchar(32) NOT NULL,
  `PASSWORD` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`USER_ID`, `USERNAME`, `PASSWORD`) VALUES
(1, 'Shalom', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(2, 'Aime', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(3, 'Eric', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`CONTACT_ID`);

--
-- Index pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`FAVORITE_ID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `CONTACT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT pour la table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `FAVORITE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
