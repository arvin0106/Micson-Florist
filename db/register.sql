-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2024-01-12 09:03:51
-- 服务器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `register`
--

-- --------------------------------------------------------

--
-- 表的结构 `form`
--

CREATE TABLE `form` (
  `id` int(11) NOT NULL,
  `name` varchar(22) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `password_plain` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `form`
--

INSERT INTO `form` (`id`, `name`, `email`, `password`, `tel`, `reset_token_hash`, `reset_token_expires_at`, `password_hash`, `password_plain`) VALUES
(2, 'zavier', 'zavier@gmail.com', '', '0178421350', 'b8d3f28787534bc04e89e3ee383f44e54451a6af500088cfd9a377d3faa3d148', '2023-12-08 05:19:41', NULL, '123456'),
(3, 'arvin', 'loopanghao@gmail.com', '123456', '0178421350', 'bc698a99919b1b150006bfde707dfe5ab9240d41d3b3e695180a02af1839ee80', '2024-01-10 10:19:11', '$2y$10$fhGnNPrST6na3Zy6TplgWe5/.rd0BlplCm7Lp2DC/mNRHxkJC47ou', 'Yap123456'),
(5, 'tong12', '1211206616@student.mmu.edu.my', '', '0178421350', '994ee18cd2913afda1fdee75cf035c92d11e1133d1f4c6a9a87f013f8d3fe43f', '2023-12-11 07:28:44', NULL, NULL),
(6, 'pop', '123456@gmail.com', '', '12345', '9574c058286a477a64f72df642987057d34313a542c45f1cc9fd27aca245af63', '2023-12-08 05:27:00', NULL, NULL),
(7, 'zavier000', 'zavierong4@gmail.com', '123456', '31216465654', '5e4ae009f9da12b969c0eb6262770e7342744e0ac63b114d48fb828de43b279a', '2023-12-11 06:45:07', NULL, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD UNIQUE KEY `unique_reset_token_hash` (`reset_token_hash`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
