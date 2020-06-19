-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2019 at 12:40 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ireview`
--

-- --------------------------------------------------------

--
-- Table structure for table `e_answers`
--

CREATE TABLE `e_answers` (
  `ea_id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `eaDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_answers`
--

INSERT INTO `e_answers` (`ea_id`, `q_id`, `eaDescription`) VALUES
(1, 20, 'Early+game'),
(2, 20, 'Mid+game'),
(3, 20, 'Late+game'),
(4, 32, 'Charmander'),
(5, 32, 'Bulbasaur'),
(6, 32, 'Squirtle'),
(7, 33, 'Short term'),
(8, 33, 'Long term'),
(9, 39, 'Static'),
(10, 39, 'Kinetic'),
(11, 40, 'Mercury'),
(12, 40, 'Venus'),
(13, 40, 'Earth'),
(14, 64, 'Business process modeling notation'),
(15, 64, 'BPMN'),
(16, 65, 'UML'),
(17, 65, 'Unified Modeling Language'),
(18, 66, 'Flowchart'),
(19, 66, 'Flowchart technique'),
(20, 67, 'Data flow diagram'),
(21, 67, 'DFD'),
(22, 68, 'Role Activity Diagrams'),
(23, 68, 'RAD'),
(24, 68, 'Role Activity Diagram'),
(25, 69, 'Gantt Charts'),
(26, 70, 'IDEF'),
(27, 70, 'Integrated Definition for Function Modeling'),
(28, 71, 'Gap Analysis');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `f_id` int(11) NOT NULL,
  `st_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`f_id`, `st_id`, `u_id`) VALUES
(19, 27, 1),
(17, 28, 1),
(20, 32, 1),
(22, 33, 1),
(23, 34, 1),
(24, 35, 1),
(21, 36, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mc_choices`
--

CREATE TABLE `mc_choices` (
  `mcc_id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `mccDescription` varchar(255) NOT NULL,
  `mccIsAnswer` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mc_choices`
--

INSERT INTO `mc_choices` (`mcc_id`, `q_id`, `mccDescription`, `mccIsAnswer`) VALUES
(29, 19, 'Red', 0),
(30, 19, 'White', 0),
(31, 19, 'Blue', 1),
(32, 19, 'Black', 0),
(33, 23, 'Matulog', 0),
(34, 23, 'Mag+Facebook', 0),
(35, 23, 'Humilata', 0),
(36, 23, 'All+of+the+above', 1),
(37, 24, '9', 0),
(38, 24, '10', 0),
(39, 24, '11', 0),
(40, 24, '8', 1),
(41, 25, '23', 0),
(42, 25, '24', 1),
(43, 25, '7', 0),
(44, 25, '13', 0),
(45, 26, 'Goku', 0),
(46, 26, 'Krillin', 0),
(47, 26, 'Gohan', 1),
(48, 26, 'Chichi', 0),
(49, 27, 'Masashi+Kishimoto', 0),
(50, 27, 'Monkey+D.+Luffy', 0),
(51, 27, 'Eichiro+Oda', 1),
(52, 27, 'Ichigo+Kurosaki', 0),
(57, 35, 'Africa', 0),
(58, 35, 'South+America', 0),
(59, 35, 'Antartica', 0),
(60, 35, 'Asia', 1),
(61, 36, 'Chicken', 0),
(62, 36, 'Bat', 1),
(63, 36, 'Penguin', 0),
(64, 36, 'Eagle', 0),
(65, 37, '2', 0),
(66, 37, '4', 0),
(67, 37, '6', 0),
(68, 37, 'Math+equation', 1),
(69, 38, '3', 0),
(70, 38, '7', 0),
(71, 38, '5', 1),
(72, 38, '2', 0),
(73, 41, 'Luffy', 1),
(74, 41, 'Ace', 0),
(75, 41, 'Sabo', 0),
(76, 41, 'Shanks', 0),
(77, 42, 'fsd', 1),
(78, 42, 'fsd', 0),
(79, 42, 'fsdf', 0),
(80, 42, 'fsdf', 0),
(81, 43, 'Information', 0),
(82, 43, 'Documents', 0),
(83, 43, 'Data', 1),
(84, 43, 'Statistics', 0),
(85, 44, 'Field', 0),
(86, 44, 'Column', 0),
(87, 44, 'Record', 1),
(88, 44, 'Data', 0),
(89, 45, 'Super key', 0),
(90, 45, 'Candidate key', 1),
(91, 45, 'Composite key', 0),
(92, 45, 'Secondary key', 0),
(93, 46, 'Non-key attributes are attributes other than candidate key attributes.', 1),
(94, 46, 'Super Key is a superset of Candidate key.', 0),
(95, 46, 'Non-prime Attributes are attributes other than Primary attribute.', 0),
(96, 46, 'Candidate key which are not selected for primary key are known as Foreign key.', 0),
(97, 47, 'That there must not be any partial dependency of any column on primary key.', 1),
(98, 47, 'that every non-prime attribute of table must be dependent on primary key.', 0),
(99, 47, 'that each column must have a unique value.', 0),
(100, 47, 'None of the above', 0),
(101, 48, 'Normalization', 1),
(102, 48, 'Aggregation', 0),
(103, 48, 'Generalization', 0),
(104, 48, 'Specialization', 0),
(105, 49, 'Diamond', 1),
(106, 49, 'Rectangle', 0),
(107, 49, 'Eclipse', 0),
(108, 49, 'Double rectangle.', 0),
(109, 50, 'attribute', 0),
(110, 50, 'Key attribute.', 1),
(111, 50, 'Composite attribute.', 0),
(112, 50, 'Multivalued attribute', 0),
(113, 51, 'Primary key', 0),
(114, 51, 'Foreign Key', 1),
(115, 51, 'Check', 0),
(116, 51, 'Not Null', 0),
(117, 52, 'Primary key', 0),
(118, 52, 'Foreign Key', 1),
(119, 52, 'Check', 0),
(120, 52, 'Not Null', 0),
(121, 53, 'auto', 1),
(122, 53, 'register', 0),
(123, 53, 'static', 0),
(124, 53, 'extern', 0),
(125, 54, '100-200', 1),
(126, 54, '400-1000', 0),
(127, 54, '200-400', 0),
(128, 54, 'above 1000', 0),
(129, 55, 'Relative Application Development', 0),
(130, 55, 'Rapid Application Development', 1),
(131, 55, 'Rapid Application Document', 0),
(132, 55, 'None of the mentioned', 0),
(133, 56, 'Build and Fix Model', 0),
(134, 56, 'Prototyping Model', 0),
(135, 56, 'RAD Model', 0),
(136, 56, 'Waterfall Model', 1),
(137, 57, 'Horizontal Prototype', 0),
(138, 57, 'Vertical Prototype', 0),
(139, 57, 'Diagonal Prototype', 1),
(140, 57, 'Domain Prototype', 0),
(141, 58, 'Quick Design', 0),
(142, 58, 'Coding', 1),
(143, 58, ' Prototype Refinement', 0),
(144, 58, 'Engineer Product', 0),
(145, 59, 'No room for structured design', 0),
(146, 59, ' Code soon becomes unfixable and unchangeable', 0),
(147, 59, 'Maintenance is practically not possible', 0),
(148, 59, 'It scales up well to large projects', 1),
(149, 60, '2 phases', 0),
(150, 60, '3 phase', 0),
(151, 60, '5 phases', 1),
(152, 60, '6 phases', 0),
(153, 61, 'Highly specialized and skilled developers/designers are required', 0),
(154, 61, 'Increases reusability of components', 0),
(155, 61, 'Encourages customer/client feedback', 0),
(156, 61, 'Increases reusability of components%2C Highly specialized and skilled developers/designers are required', 1),
(157, 62, 'Software Development Life Cycle', 1),
(158, 62, 'Software Design Life Cycle', 0),
(159, 62, 'System Development Life cycle', 0),
(160, 62, 'System Design Life Cycle', 0),
(161, 63, 'Waterfall Model', 0),
(162, 63, 'Prototyping Model', 0),
(163, 63, 'RAD Model', 1),
(164, 63, 'both Prototyping Model and RAD Model', 0),
(165, 82, 'Cecilia Munoz Palma ', 1),
(166, 82, 'Napoleon G. Rama', 0),
(167, 82, 'Ahmad Domocao Alonto', 0),
(168, 82, 'Ambrosio B. Padilla', 0),
(169, 83, 'education', 0),
(170, 83, 'labor', 1),
(171, 83, 'trade', 0),
(172, 83, 'commerce', 0),
(173, 84, 'war', 1),
(174, 84, 'invasion', 0),
(175, 84, 'martial law', 0),
(176, 84, 'terrorism', 0),
(177, 85, 'war', 1),
(178, 85, 'invasion', 0),
(179, 85, 'martial law', 0),
(180, 85, 'terrorism', 0),
(181, 86, 'Senate', 0),
(182, 86, 'National Assembly', 0),
(183, 86, 'Congressional Lower Chamber', 0),
(184, 86, 'House of Representatives', 1),
(185, 87, 'nine-tenths', 0),
(186, 87, 'two-thirds', 1),
(187, 87, 'three-fourths', 0),
(188, 87, 'majority', 0),
(189, 88, '48 days', 0),
(190, 88, '30 days', 1),
(191, 88, '3 weeks', 0),
(192, 88, '60 days', 0),
(193, 89, 'President of the Senate', 0),
(194, 89, 'Speaker of the House of Representatives', 0),
(195, 89, 'Chief Justice of the Supreme Court', 0),
(196, 89, 'Executive Secretary of the Cabinet', 1),
(197, 90, 'President of the Senate', 1),
(198, 90, 'Speaker of the House of Representatives', 0),
(199, 90, 'Chief Justice of the Supreme Court', 0),
(200, 90, 'Executive Secretary of the Cabinet', 0),
(201, 91, 'Department of Foreign Affairs', 0),
(202, 91, 'Supreme Court', 0),
(203, 91, 'Senate', 1),
(204, 91, 'Cabinet', 0),
(205, 92, '15', 0),
(206, 92, '12', 0),
(207, 92, '14', 1),
(208, 92, '19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(82) NOT NULL,
  `email` varchar(64) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`) VALUES
(1, 'John Doe', 'johndoe@gmail.com', 'Your system is very helpful. Thank You!'),
(2, 'Michael Marana', 'marana@gmail.com', 'Can you please activate my account?');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `q_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `qDescription` varchar(255) NOT NULL,
  `qCount` int(11) NOT NULL DEFAULT '0',
  `qRight` int(11) NOT NULL DEFAULT '0',
  `qDifficulty` enum('Easy','Average','Hard','') NOT NULL DEFAULT 'Average',
  `qInTrash` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`q_id`, `test_id`, `qDescription`, `qCount`, `qRight`, `qDifficulty`, `qInTrash`) VALUES
(19, 5, 'What is the color of the sky?', 13, 10, 'Hard', 0),
(20, 7, 'Enumerate the three game stage of a MOBA', 8, 6, 'Hard', 0),
(22, 6, 'Masarap ba matulog at humilata?', 7, 5, 'Hard', 0),
(23, 5, 'Tambak ang gawain, ano ang gagawin mo?', 13, 9, 'Hard', 0),
(25, 5, 'How many moon does the planet Saturn have?', 13, 7, 'Hard', 0),
(26, 5, 'Who defeated Cell in Dragonball Z?', 13, 8, 'Hard', 0),
(27, 5, 'Who created One Piece?', 13, 10, 'Hard', 0),
(28, 6, 'Verb === Pandesal', 7, 6, 'Average', 0),
(29, 6, 'Si Niel Armstrong ang unang taong nakatapak sa buwan', 7, 7, 'Easy', 0),
(30, 6, 'Crocodile is a reptile', 7, 6, 'Average', 0),
(31, 6, 'Earth is flat', 7, 5, 'Hard', 0),
(32, 7, 'First three pokemon to choose at the start of a pokemon game', 8, 5, 'Hard', 0),
(33, 7, 'Two types of goal', 8, 3, 'Hard', 0),
(35, 5, 'What is the biggest continent in the world?', 13, 9, 'Hard', 0),
(36, 5, 'Which of the following is a mamal?', 13, 10, 'Hard', 0),
(37, 5, 'What is 1 + 1?', 7, 6, 'Average', 0),
(38, 11, 'How many level does the Capability Maturity Model have?', 0, 0, 'Average', 0),
(39, 7, 'Two kinds of Energy', 8, 5, 'Hard', 0),
(40, 7, 'Three closest planet to the sun in our solar system', 8, 4, 'Hard', 0),
(41, 21, 'who is the protagonist in the anime One Piece?', 0, 0, 'Average', 0),
(42, 20, 'fsdfs', 0, 0, 'Average', 0),
(43, 22, 'appearance of a fact which can be recorded, stored or modified, and send on.', 0, 0, 'Average', 0),
(44, 22, 'A single entry in a table is called a _________.', 0, 0, 'Average', 0),
(45, 22, '________ are defined as the set of fields from which primary key can be selected.', 0, 0, 'Average', 0),
(46, 22, 'Which of the following statement is not correct ?', 0, 0, 'Average', 0),
(47, 22, 'Second form of Normalization requires ________ .', 0, 0, 'Average', 0),
(48, 22, 'Is a process when relation between two entity is treated as a single entity.', 0, 0, 'Average', 0),
(49, 22, 'In ER Diagram, relationship is represented using?', 0, 0, 'Average', 0),
(50, 22, 'In an ER Diagram, ellipse with underlying lines is used to represent ', 0, 0, 'Average', 0),
(51, 22, 'This constraint is used to restricts actions that would destroy links between tables?', 0, 0, 'Average', 1),
(52, 22, 'This constraint is used to restricts actions that would destroy links between tables?', 0, 0, 'Average', 0),
(53, 22, 'the Default storage class for local variables', 0, 0, 'Average', 0),
(54, 23, 'Build & Fix Model is suitable for programming exercises of ___________ LOC (Line of Code).', 0, 0, 'Average', 0),
(55, 23, 'RAD stands for', 0, 0, 'Average', 0),
(56, 23, 'Which one of the following models is not suitable for accommodating any change?', 0, 0, 'Average', 0),
(57, 23, 'Which is not one of the types of prototype of Prototyping Model?', 0, 0, 'Average', 0),
(58, 23, 'Which one of the following is not a phase of Prototyping Model?', 0, 0, 'Average', 0),
(59, 23, ' Which of the following statements regarding Build & Fix Model is wrong?', 0, 0, 'Average', 0),
(60, 23, 'RAD Model has', 0, 0, 'Average', 0),
(61, 23, 'What is the major drawback of using RAD Model?', 0, 0, 'Average', 0),
(62, 23, 'SDLC stands for', 0, 0, 'Average', 0),
(63, 23, 'Which model can be selected if user is involved in all the phases of SDLC?', 0, 0, 'Average', 0),
(64, 24, 'This technique is similar to creating process flowcharts, although it has its own symbols and elements. Business process modeling and notation is used to create graphs for the business process. These graphs simplify understanding the business process.', 0, 0, 'Average', 0),
(65, 24, 'It consists of an integrated set of diagrams that are created to specify, visualize, construct and document the artifacts of a software system. It is a useful technique while creating object-oriented software and working with the software development proc', 0, 0, 'Average', 0),
(66, 24, 'depicts the sequential flow and control logic of a set of activities that are related. Are in different formats such as linear, cross-functional, and top-down.  It can represent system interactions, data flows, etc. ', 0, 0, 'Average', 0),
(67, 24, 'This technique is used to visually represent systems and processes that are complex and difficult to describe in text. It represent the flow of information through a process or a system. It also includes the data inputs and outputs, data stores, and the v', 0, 0, 'Average', 0),
(68, 24, 'is a role-oriented process model that represents role-activity diagrams. are a high-level view that captures the dynamics and role structure of an organization. Roles are used to grouping together activities into units of responsibilities.', 0, 0, 'Average', 0),
(69, 24, 'used in project planning as they provide a visual representation of tasks that are scheduled along with the timelines. It helps to know what is scheduled to be completed by which date. ', 0, 0, 'Average', 0),
(70, 24, 'represents the functions of a process and their relationships to child and parent systems with the help of a box. It provides a blueprint to gain an understanding of an organizationâ€™s system.', 0, 0, 'Average', 0),
(71, 24, 'is a technique which helps to analyze the gaps in performance of a software application to determine whether the business requirements are met or not. It also involves the steps that are to be taken to ensure that all the business requirements are met suc', 0, 0, 'Average', 0),
(72, 25, 'Parent constructors are not called implicitly if the child class defines a constructor.', 0, 0, 'Average', 0),
(73, 25, 'Interface constant can be override in class implementing the interface.', 0, 0, 'Average', 0),
(74, 25, 'Static methods can be call with class name and colon operator, $this is not available inside the method declared as static.', 0, 0, 'Average', 0),
(75, 25, 'Static properties can be accessed through the object using the arrow operator ->.', 0, 0, 'Average', 0),
(76, 25, 'If parent class has Final method abc(). Method abc() can be overridden in child class.\n', 0, 0, 'Average', 0),
(77, 25, 'In PHP, a class can be inherited from one base class and with multiple base classes.', 0, 0, 'Average', 0),
(78, 25, 'To create instance of class \"new\" keyword is not required.', 0, 0, 'Average', 0),
(79, 25, '$this is a reference to the calling object', 0, 0, 'Average', 0),
(80, 25, 'The variable name is case-sensitive in PHP.', 0, 0, 'Average', 0),
(81, 25, 'PHP is an open source software', 0, 0, 'Average', 0),
(82, 26, '1. Who was the President of the 1987 Constitutional Commission?', 0, 0, 'Average', 0),
(83, 26, 'What is regarded by the State as a \"primary social economic force?\"', 0, 0, 'Average', 0),
(84, 26, 'According to Article III, Section 15 of the Constitution, the writ of habeas corpus may be suspended in times of rebellion or what?', 0, 0, 'Average', 1),
(85, 26, 'According to Article III, Section 15 of the Constitution, the writ of habeas corpus may be suspended in times of rebellion or what?', 0, 0, 'Average', 0),
(86, 26, 'The Lower Chamber of the Congress of the Philippines is known by what name?', 0, 0, 'Average', 0),
(87, 26, 'A Member of either house of Congress may be expelled by their fellow Members. For a Member to be expelled, how much of the total number of Members of a house must concur with the expulsion?', 0, 0, 'Average', 0),
(88, 26, 'If a President wishes to veto a bill, he/she must communicate it within a certain span of time, otherwise the bill will become a law. How long is this span of time?', 0, 0, 'Average', 0),
(89, 26, 'In the event that both the President and Vice President are removed from office, who will act as President in the Philippines?', 0, 0, 'Average', 0),
(90, 26, 'In the event that both the President and Vice President are removed from office, who will act as President in the Philippines?', 0, 0, 'Average', 0),
(91, 26, ' One of the functions of the government is to enter into treaties and agreements with the governments of other states. However, such agreements will only be valid and effective when the concurrence of a specific government entity has been given. Name this', 0, 0, 'Average', 0),
(92, 26, 'How many Associate Justices comprise the Supreme Court?', 0, 0, 'Average', 0);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `r_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `rTotalItems` int(11) NOT NULL,
  `rScore` int(11) NOT NULL,
  `rDateTaken` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`r_id`, `test_id`, `u_id`, `rTotalItems`, `rScore`, `rDateTaken`) VALUES
(1, 5, 1, 7, 2, '2019-02-19 16:13:35'),
(2, 5, 1, 7, 5, '2019-02-20 16:42:15'),
(3, 5, 1, 7, 2, '2019-02-21 16:52:31'),
(4, 5, 1, 7, 1, '2019-02-22 16:53:57'),
(5, 5, 1, 8, 6, '2019-02-23 16:57:30'),
(6, 6, 1, 5, 5, '2019-02-19 20:10:17'),
(9, 6, 1, 5, 3, '2019-02-20 20:49:25'),
(10, 5, 1, 8, 6, '2019-02-24 21:51:01'),
(12, 7, 1, 13, 11, '2019-02-19 11:58:16'),
(13, 7, 1, 13, 13, '2019-02-20 12:00:00'),
(14, 6, 1, 5, 5, '2019-02-21 12:01:11'),
(15, 5, 1, 8, 8, '2019-02-25 12:02:02'),
(16, 7, 1, 13, 10, '2019-02-21 12:03:28'),
(17, 6, 1, 5, 5, '2019-02-25 21:13:05'),
(18, 7, 1, 13, 13, '2019-02-25 21:14:36'),
(19, 5, 1, 8, 7, '2019-02-27 22:00:31'),
(20, 5, 1, 8, 4, '2019-03-01 21:58:55'),
(21, 6, 1, 5, 2, '2019-03-01 22:00:02'),
(22, 7, 1, 13, 5, '2019-03-01 22:01:54'),
(23, 5, 1, 8, 8, '2019-03-08 20:44:32'),
(24, 6, 1, 5, 5, '2019-03-08 20:46:20'),
(25, 7, 1, 13, 11, '2019-03-08 20:48:01'),
(26, 5, 1, 8, 7, '2019-03-17 09:36:10'),
(27, 6, 1, 5, 4, '2019-03-17 20:47:49'),
(28, 7, 1, 13, 0, '2019-03-17 20:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `subtopics`
--

CREATE TABLE `subtopics` (
  `st_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `stName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `stOverview` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stInTrash` tinyint(1) DEFAULT '0',
  `dateTimeAdded` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subtopics`
--

INSERT INTO `subtopics` (`st_id`, `t_id`, `stName`, `stOverview`, `stInTrash`, `dateTimeAdded`) VALUES
(12, 7, 'Linkin ParK', 'I tried so hard and got so far ', 1, '2019-01-28 12:11:13'),
(13, 8, 'Bruno Mars', 'I will go through all this pain take a bullet straight to my brain ', 1, '2019-01-28 12:42:58'),
(14, 7, 'Capability Maturity Model (CMM)', 'I take one step away', 1, '2019-01-28 12:52:26'),
(15, 8, 'My Chemical Romance', 'When I was a young boy my father took me into the city', 1, '2019-01-28 12:54:08'),
(17, 14, 'Kinematics', 'Study of motion', 0, '2019-01-28 13:10:04'),
(24, 14, 'Velocity', 'The City of Velo', 0, '2019-01-28 16:10:53'),
(26, 32, 'Database connection', 'connecting to database via php', 1, '2019-01-28 16:14:42'),
(27, 13, 'Capability Maturity Model', 'a model', 1, '2019-02-05 17:53:11'),
(28, 34, 'Bill of Rights', 'rights of Bills', 1, '2019-02-05 17:57:30'),
(29, 35, 'Normalization', 'normalization', 0, '2019-02-08 08:58:13'),
(30, 35, 'Normalization', 'normalization', 1, '2019-02-08 08:58:22'),
(31, 8, 'asdf', 'asdf', 1, '2019-02-25 21:10:14'),
(32, 8, 'Database', 'Database Definitions and Diagrams', 0, '2019-03-22 20:50:12'),
(33, 13, 'Software Life Cycle ', 'Life Cycle Models', 0, '2019-03-22 21:33:23'),
(34, 7, 'Requirement Analysis ', 'requirements', 0, '2019-03-22 21:47:28'),
(35, 32, 'PHP', 'PHP syntax and variables', 0, '2019-03-22 22:27:10'),
(36, 34, 'Philippine Constitution', 'Constitution', 0, '2019-03-22 22:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_id` int(11) NOT NULL,
  `st_id` int(11) NOT NULL,
  `testCategory` enum('Multiple Choice','True or False','Enumeration','') NOT NULL,
  `testName` varchar(64) NOT NULL,
  `testInTrash` int(1) NOT NULL DEFAULT '0',
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `st_id`, `testCategory`, `testName`, `testInTrash`, `dateAdded`) VALUES
(5, 17, 'Multiple Choice', 'Kinematics Test 1', 0, '2019-02-04 20:06:19'),
(6, 17, 'True or False', 'Kinematics Midterm Reviewer', 0, '2019-02-04 20:06:19'),
(7, 17, 'Enumeration', 'Kinematics Exam 1', 0, '2019-02-04 20:21:21'),
(10, 24, 'Multiple Choice', 'sample1', 0, '2019-02-05 17:22:21'),
(11, 27, 'Multiple Choice', 'test1', 0, '2019-02-05 17:53:27'),
(13, 28, 'Enumeration', 'test1', 0, '2019-02-05 17:57:46'),
(14, 24, 'Multiple Choice', 'sample', 0, '2019-02-07 11:53:21'),
(15, 29, 'Multiple Choice', 'sample1', 1, '2019-02-08 08:58:45'),
(18, 17, 'True or False', 'asdf', 1, '2019-02-12 19:47:03'),
(19, 15, 'Multiple Choice', 'multiple choice', 0, '2019-02-13 11:15:20'),
(20, 15, 'Multiple Choice', 'multiple choice', 0, '2019-02-13 11:15:30'),
(21, 31, 'Multiple Choice', 'sample', 0, '2019-02-25 21:11:23'),
(22, 32, 'Multiple Choice', 'Basic Definitions', 0, '2019-03-22 20:50:43'),
(23, 33, 'Multiple Choice', 'Software Life Cycle', 0, '2019-03-22 21:34:31'),
(24, 34, 'Enumeration', 'Requirement Analysis Techniques', 0, '2019-03-22 21:48:28'),
(25, 35, 'True or False', 'PHP basics', 0, '2019-03-22 22:27:30'),
(26, 36, 'Multiple Choice', 'Constitution Test I', 0, '2019-03-22 22:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `tf_answers`
--

CREATE TABLE `tf_answers` (
  `tfa_id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `tfaDescription` enum('True','False','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tf_answers`
--

INSERT INTO `tf_answers` (`tfa_id`, `q_id`, `tfaDescription`) VALUES
(1, 22, 'True'),
(2, 28, 'True'),
(3, 29, 'False'),
(4, 30, 'True'),
(5, 31, 'False'),
(6, 72, 'True'),
(7, 73, 'False'),
(8, 74, 'True'),
(9, 75, 'False'),
(10, 76, 'False'),
(11, 77, 'False'),
(12, 78, 'False'),
(13, 79, 'True'),
(14, 80, 'True'),
(15, 81, 'True');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `t_id` int(15) NOT NULL,
  `u_id` int(15) NOT NULL,
  `tName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tFavorite` tinyint(1) DEFAULT '0',
  `tInTrash` int(1) NOT NULL DEFAULT '0',
  `dateTimeAdded` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`t_id`, `u_id`, `tName`, `tFavorite`, `tInTrash`, `dateTimeAdded`) VALUES
(7, 1, 'System Analysis and Design', 0, 0, '2019-01-28 12:06:25'),
(8, 5, 'Database Management Systems', 0, 0, '2019-01-28 12:42:01'),
(13, 1, 'Software Engineering', 0, 0, '2019-01-28 12:55:33'),
(14, 1, 'College Physics', 0, 0, '2019-01-28 12:55:33'),
(32, 1, 'Web Development', 0, 0, '2019-01-28 16:14:26'),
(34, 5, 'Political Governance', 0, 0, '2019-02-05 17:56:42'),
(35, 1, 'Database Management Systems', 0, 1, '2019-02-08 08:57:51'),
(36, 5, 'web dev', 0, 1, '2019-02-25 21:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(15) NOT NULL,
  `uImage` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unknown.png',
  `uBackground` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'bg.jpg',
  `uFirstName` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `uMiddleName` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `uLastName` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `uName` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `uPassword` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `uType` enum('Administrator','Encoder','Visitor','') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Visitor',
  `uActive` tinyint(1) DEFAULT '1',
  `dateTimeAdded` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `uImage`, `uBackground`, `uFirstName`, `uMiddleName`, `uLastName`, `uName`, `uPassword`, `uType`, `uActive`, `dateTimeAdded`) VALUES
(1, '667128384.jpg', 'bg.jpg', 'Joshua', 'Duran', 'Marana', 'mMarana', 'lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=', 'Visitor', 1, '2019-01-28 12:02:49'),
(5, '14529.jpg', 'bg.jpg', 'Franz', 'Febrer', 'Mercado', 'fMercado', 'lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=', 'Encoder', 1, '2019-01-28 12:41:19'),
(7, 'unknown.png', 'bg.jpg', 'Kim', 'Bryan', 'Clavecillas', 'kClavecillas', '0hEp2Ic9v2ErUl/Q0EwXhTC4/3/BAZNEi1YaF6MQdOI=', 'Encoder', 1, '2019-01-28 13:14:17'),
(8, 'unknown.png', 'bg.jpg', 'Patricia Anne Marie', 'Gueco', 'Santos', 'pSantos', 'lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=', 'Administrator', 1, '2019-01-28 13:18:12'),
(10, 'unknown.png', 'bg.jpg', 'Jhon', 'Peter', 'Pacinos', 'jPacinos', 'No3a0Ymt9/Y5G9gF1eZd1EaiBBZlNrY5ZVzP0IT+TqE=', 'Visitor', 1, '2019-01-28 13:18:50'),
(14, 'unknown.png', 'bg.jpg', 'Mark Joseph', 'R', 'Colibao', 'mColibao', 'shTY7cHWpWem7ns91cmrFfJa28ueDhUAPm35s6mDxfQ=', 'Visitor', 0, '2019-01-28 16:16:04'),
(15, 'unknown.png', 'bg.jpg', 'Czar Lawrence', 'T', 'Esmani', 'cEsmani', 'ekwARPbH3hXqKRALN1MOA7MIAMpVb3sNNf1ddPazDpA=', 'Visitor', 1, '2019-01-28 16:16:59'),
(16, 'unknown.png', 'bg.jpg', 'Kevin', 'C', 'Acogido', 'kAcogido', '73C2cgiMrOH3z1j5/yDKCAyre0YLoKa8gEEleCNOLGs=', 'Visitor', 1, '2019-01-28 16:17:43'),
(17, 'unknown.png', 'bg.jpg', 'William', 'Lachica', 'Desamparado II', 'wDesamparado', 'xlzvolLBLAmXpYXtugYeuQn5p/R6Nl/jKEeST1vaIvs=', 'Visitor', 0, '2019-01-30 15:23:27'),
(18, 'unknown.png', 'bg.jpg', 'Clark', 'Kent', 'Cometa', 'cCometa', 'cMTKGpOSoRM9HHAaezTpklz+vmOdn0axEWrZje3OufY=', 'Visitor', 0, '2019-02-05 17:58:31'),
(20, 'unknown.png', 'bg.jpg', 'John', 'Lloyd', 'Cruz', 'jCruz', 'uL4gADpEWoiP6H39PRWJnC2SXhJpXwQpPbHMtkPGm58=', 'Visitor', 0, '2019-02-05 18:03:54'),
(21, 'unknown.png', 'bg.jpg', 'John', 'M', 'Doe', 'jDoe', 'o3FGTYFgmPid6A3NHs2zMVDW2zeM2+ZBq9IxrPWR37Y=', 'Visitor', 1, '2019-03-01 23:21:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `e_answers`
--
ALTER TABLE `e_answers`
  ADD PRIMARY KEY (`ea_id`),
  ADD KEY `q_id` (`q_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `st_id` (`st_id`,`u_id`);

--
-- Indexes for table `mc_choices`
--
ALTER TABLE `mc_choices`
  ADD PRIMARY KEY (`mcc_id`),
  ADD KEY `q_id` (`q_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`q_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `subtopics`
--
ALTER TABLE `subtopics`
  ADD PRIMARY KEY (`st_id`),
  ADD KEY `t_id` (`t_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`),
  ADD KEY `st_id` (`st_id`);

--
-- Indexes for table `tf_answers`
--
ALTER TABLE `tf_answers`
  ADD PRIMARY KEY (`tfa_id`),
  ADD KEY `q_id` (`q_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `uName` (`uName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `e_answers`
--
ALTER TABLE `e_answers`
  MODIFY `ea_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mc_choices`
--
ALTER TABLE `mc_choices`
  MODIFY `mcc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `subtopics`
--
ALTER TABLE `subtopics`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tf_answers`
--
ALTER TABLE `tf_answers`
  MODIFY `tfa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `t_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
