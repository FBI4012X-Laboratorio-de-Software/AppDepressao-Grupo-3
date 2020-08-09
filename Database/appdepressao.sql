-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05-Jun-2020 às 00:47
-- Versão do servidor: 10.4.12-MariaDB
-- versão do PHP: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u401195340_appdepressao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `MainQuestions`
--

CREATE TABLE `MainQuestions` (
  `cod_question` int(10) UNSIGNED NOT NULL,
  `question_desc` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `QuestionHistory`
--

CREATE TABLE `QuestionHistory` (
  `cod_history` int(10) UNSIGNED NOT NULL,
  `cod_question` int(10) UNSIGNED NOT NULL,
  `cod_question_item` int(10) UNSIGNED NOT NULL,
  `cod_user` int(10) UNSIGNED NOT NULL,
  `reply_date` date NOT NULL,
  `replay_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `QuestionItens`
--

CREATE TABLE `QuestionItens` (
  `cod_question_item` int(10) UNSIGNED NOT NULL,
  `cod_question` int(10) UNSIGNED NOT NULL,
  `question_item_desc` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `User`
--

CREATE TABLE `User` (
  `COD_USER` int(11) UNSIGNED NOT NULL,
  `DES_USER` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DES_EMAIL` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DES_PASSWORD` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TIP_MASTER` tinyint(1) NOT NULL,
  `TIP_STATUS` tinyint(1) NOT NULL,
  `last_acess` date DEFAULT NULL,
  `last_reply` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `User`
--

INSERT INTO `User` (`COD_USER`, `DES_USER`, `DES_EMAIL`, `DES_PASSWORD`, `TIP_MASTER`, `TIP_STATUS`, `last_acess`, `last_reply`) VALUES
(1, 'Admin', 'admin@appdepressao.16mb.com', '21232f297a57a5a743894a0e4a801fc3', 1, 1, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `MainQuestions`
--
ALTER TABLE `MainQuestions`
  ADD PRIMARY KEY (`cod_question`);

--
-- Índices para tabela `QuestionHistory`
--
ALTER TABLE `QuestionHistory`
  ADD PRIMARY KEY (`cod_history`),
  ADD KEY `fk_cod_question` (`cod_question`),
  ADD KEY `fk_cod_question_item` (`cod_question_item`),
  ADD KEY `fk_cod_user` (`cod_user`);

--
-- Índices para tabela `QuestionItens`
--
ALTER TABLE `QuestionItens`
  ADD PRIMARY KEY (`cod_question_item`),
  ADD KEY `fk_cod_question` (`cod_question`);

--
-- Índices para tabela `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`COD_USER`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `MainQuestions`
--
ALTER TABLE `MainQuestions`
  MODIFY `cod_question` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `QuestionHistory`
--
ALTER TABLE `QuestionHistory`
  MODIFY `cod_history` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `QuestionItens`
--
ALTER TABLE `QuestionItens`
  MODIFY `cod_question_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `User`
--
ALTER TABLE `User`
  MODIFY `COD_USER` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `QuestionHistory`
--
ALTER TABLE `QuestionHistory`
  ADD CONSTRAINT `QuestionHistory_ibfk_1` FOREIGN KEY (`cod_question`) REFERENCES `MainQuestions` (`cod_question`),
  ADD CONSTRAINT `QuestionHistory_ibfk_2` FOREIGN KEY (`cod_question_item`) REFERENCES `QuestionItens` (`cod_question_item`),
  ADD CONSTRAINT `QuestionHistory_ibfk_3` FOREIGN KEY (`cod_user`) REFERENCES `User` (`cod_user`);

--
-- Limitadores para a tabela `QuestionItens`
--
ALTER TABLE `QuestionItens`
  ADD CONSTRAINT `QuestionItens_ibfk_1` FOREIGN KEY (`cod_question`) REFERENCES `MainQuestions` (`cod_question`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
