-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql306.infinityfree.com
-- Tempo de geração: 28/08/2023 às 13:37
-- Versão do servidor: 10.4.17-MariaDB
-- Versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `epiz_33790724_controlefinanceiro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `despensas`
--

CREATE TABLE `despensas` (
  `id` int(11) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `valor` float NOT NULL,
  `dataDespensa` date NOT NULL,
  `ano` varchar(300) NOT NULL,
  `quinzena` varchar(300) NOT NULL,
  `status` varchar(300) NOT NULL DEFAULT 'ATIVO',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `IdStatus_mes` int(11) NOT NULL,
  `idStatus_despensa` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idTipoDespensa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `despensas`
--

INSERT INTO `despensas` (`id`, `descricao`, `valor`, `dataDespensa`, `ano`, `quinzena`, `status`, `created`, `updated`, `IdStatus_mes`, `idStatus_despensa`, `idUsuario`, `idTipoDespensa`) VALUES
(2, 'teste', 2, '2023-03-09', '2023', 'Quinzena 1', 'ATIVO', '2023-03-09 16:40:51', NULL, 3, 1, 2, 1),
(5, 'Salario', 1700, '2023-03-15', '2023', 'Quinzena 1', 'ATIVO', '2023-03-15 15:50:37', NULL, 3, 3, 13, 1),
(6, 'SalÃ¡rio', 2500.75, '2023-03-15', '2023', 'Quinzena 1', 'ATIVO', '2023-03-15 16:28:21', NULL, 3, 3, 15, 1),
(7, 'Banana', 2, '2023-03-12', '2023', 'Quinzena 1', 'ATIVO', '2023-03-15 16:31:47', NULL, 3, 4, 15, 1),
(8, 'Mesada', 300, '2023-03-15', '2023', 'Quinzena 1', 'ATIVO', '2023-03-15 16:36:23', NULL, 3, 3, 16, 1),
(9, 'Mesada', 100, '2023-03-15', '2023', 'Quinzena 1', 'ATIVO', '2023-03-15 16:40:38', NULL, 3, 3, 17, 1),
(17, 'Dinheiro da quinzena', 200, '2023-03-11', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 16:50:16', NULL, 3, 1, 1, 1),
(18, 'Novo atacarejo', 170.03, '2023-03-11', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 16:50:50', NULL, 3, 2, 1, 1),
(19, 'Clube Portugues', 16.8, '2023-03-12', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 16:51:13', NULL, 3, 2, 1, 1),
(20, 'Fatura: Novo atacarejo', 23.94, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 16:51:38', NULL, 3, 2, 1, 1),
(21, 'Fatura: Narciso cortina 2/2', 29.99, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 16:51:57', NULL, 3, 2, 1, 1),
(22, 'Fatura: Clube Portugues', 12.8, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 16:52:40', NULL, 3, 2, 1, 1),
(23, 'Fatura: Multa de atraso ', 12.31, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 16:53:07', '2023-03-18 16:54:16', 3, 2, 1, 1),
(24, 'Fatura: Iof de atraso  ', 2.39, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 16:53:20', '2023-03-18 16:54:53', 3, 2, 1, 1),
(25, 'Fatura: Genfarma 1/3', 20.5, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 16:53:36', NULL, 3, 2, 1, 1),
(26, 'Compesa * (Pai pagou)', 103.62, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 16:56:17', NULL, 3, 2, 1, 1),
(27, 'Pagamento da compensa', 103.62, '2023-03-15', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 16:56:55', NULL, 3, 1, 1, 1),
(28, 'MelÃ£o e alfacer', 12, '2023-03-17', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 16:57:38', NULL, 3, 2, 1, 1),
(29, '1 Ã¡gua', 5.5, '2023-03-18', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 16:58:01', NULL, 3, 2, 1, 1),
(30, 'RaÃ§Ã£o de Lady', 7, '2023-03-15', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:02:10', NULL, 3, 2, 1, 1),
(31, 'RaÃ§Ã£o do gato', 18.7, '2023-03-15', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:02:26', NULL, 3, 2, 1, 1),
(32, '2 bananas', 4, '2023-03-15', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:03:02', NULL, 3, 2, 1, 1),
(33, 'Fatura: Cadeira magalu met 4/4', 74.98, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:10:36', NULL, 3, 4, 1, 1),
(34, 'Fatura: Shopee 6/6', 42.85, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:10:54', NULL, 3, 4, 1, 1),
(35, 'Fatura: Ãgua Fria utilidad', 44, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:11:11', NULL, 3, 4, 1, 1),
(36, 'Fatura: Academia iza forma', 137, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:11:31', NULL, 3, 4, 1, 1),
(37, 'Fatura: Xbox metade', 22.5, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:11:44', NULL, 3, 4, 1, 1),
(38, 'Fatura: Neo sol confecc 1/2', 40, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:12:01', NULL, 3, 4, 1, 1),
(39, 'Fatura: Universo beleza', 23.98, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:12:14', NULL, 3, 4, 1, 1),
(40, 'Fatura: Recarga Tim ', 20, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:12:27', '2023-03-18 17:15:02', 3, 4, 1, 1),
(41, 'Fatura: Prime', 14.9, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:12:44', NULL, 3, 4, 1, 1),
(42, 'Fatura: Odonto Centro', 70, '2023-03-13', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:15:17', NULL, 3, 4, 1, 1),
(43, 'Conserto do Odonto', 10, '2023-03-17', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:16:01', '2023-03-18 17:19:37', 3, 4, 1, 1),
(44, 'Sorvete Mc Donalds', 5, '2023-03-18', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:16:27', '2023-03-18 17:19:46', 3, 4, 1, 1),
(45, 'SalÃ¡rio', 1716.41, '2023-03-05', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:21:39', NULL, 3, 3, 1, 1),
(46, 'Recarga Vem', 50, '2023-03-06', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:22:06', NULL, 3, 4, 1, 1),
(47, 'Mesada', 100, '2023-03-08', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:22:24', NULL, 3, 3, 1, 1),
(48, 'Dinheiro da passagem', 100, '2023-03-09', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:22:39', NULL, 3, 3, 1, 1),
(49, 'Fatura de Camila', 27.5, '2023-03-18', '2023', 'Quinzena 1', 'ATIVO', '2023-03-18 17:23:10', NULL, 3, 3, 1, 1),
(50, 'ColchÃ£o de Camila** ', 220, '2023-03-21', '2023', 'Quinzena 2', 'ATIVO', '2023-03-22 14:42:32', '2023-03-22 14:55:00', 3, 2, 1, 1),
(51, '30 ovos', 18, '2023-03-21', '2023', 'Quinzena 2', 'ATIVO', '2023-03-22 14:42:52', NULL, 3, 2, 1, 1),
(52, 'InstalaÃ§Ã£o do guarda roupa**', 60, '2023-03-21', '2023', 'Quinzena 2', 'ATIVO', '2023-03-22 14:44:15', NULL, 3, 2, 1, 1),
(53, '1 Ã¡gua', 5.5, '2023-03-22', '2023', 'Quinzena 2', 'ATIVO', '2023-03-22 14:44:47', NULL, 3, 2, 1, 1),
(54, 'Dinheiro do colchÃ£o de Camila ', 116, '2023-03-21', '2023', 'Quinzena 2', 'ATIVO', '2023-03-22 14:55:54', '2023-03-22 15:08:17', 3, 1, 1, 1),
(57, '2Âª via carteira de identidade', 28.57, '2023-03-19', '2023', 'Quinzena 1', 'ATIVO', '2023-03-22 15:04:47', NULL, 3, 4, 1, 1),
(58, 'Carteira de estudante', 30, '2023-03-21', '2023', 'Quinzena 2', 'ATIVO', '2023-03-22 15:05:16', NULL, 3, 4, 1, 1),
(59, 'Jogo Zomboid', 18.43, '2023-03-21', '2023', 'Quinzena 2', 'ATIVO', '2023-03-22 15:05:47', NULL, 3, 4, 1, 1),
(60, 'Recarga vem', 50, '2023-03-22', '2023', 'Quinzena 2', 'ATIVO', '2023-03-22 15:06:06', NULL, 3, 4, 1, 1),
(61, 'Alface e couve', 4, '2023-03-24', '2023', 'Quinzena 2', 'ATIVO', '2023-03-24 14:02:09', NULL, 3, 2, 1, 1),
(62, '1 banana*', 2, '2023-03-23', '2023', 'Quinzena 2', 'ATIVO', '2023-03-24 14:02:22', NULL, 3, 2, 1, 1),
(63, '1 banana*', 2, '2023-03-21', '2023', 'Quinzena 2', 'ATIVO', '2023-03-24 14:02:43', NULL, 3, 2, 1, 1),
(64, 'teste', 2, '2023-03-12', '2023', 'Quinzena 1', 'ATIVO', '2023-03-30 16:33:32', NULL, 3, 4, 1, 1),
(65, 'RaÃ§Ã£o do gato', 20, '2023-03-25', '2023', 'Quinzena 2', 'ATIVO', '2023-04-02 19:39:22', NULL, 3, 2, 1, 1),
(66, 'sabÃ£o de lady', 10, '2023-03-25', '2023', 'Quinzena 2', 'ATIVO', '2023-04-02 19:39:35', NULL, 3, 2, 1, 1),
(67, 'raÃ§Ã£o de lady', 10, '2023-03-25', '2023', 'Quinzena 2', 'ATIVO', '2023-04-02 19:39:53', NULL, 3, 2, 1, 1),
(68, 'Dinheiro da quinzena', 400, '2023-04-06', '2023', 'Quinzena 1', 'ATIVO', '2023-04-11 14:06:54', NULL, 4, 1, 1, 1),
(69, '1 Ã¡gua ', 5.5, '2023-04-08', '2023', 'Quinzena 1', 'ATIVO', '2023-04-11 14:07:12', NULL, 4, 2, 1, 1),
(70, '2 palmas d ebanana', 4, '2023-04-08', '2023', 'Quinzena 1', 'ATIVO', '2023-04-11 14:07:33', NULL, 4, 2, 1, 1),
(71, 'Boa vista - kalzone *com Pedro ', 11.9, '2023-04-05', '2023', 'Quinzena 1', 'ATIVO', '2023-04-11 14:09:21', '2023-04-11 14:11:36', 4, 4, 1, 1),
(72, 'Tem: PH e leite', 16.94, '2023-04-12', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 11:40:20', NULL, 4, 2, 1, 1),
(73, 'EmpÃ³rio alimentos', 15.51, '2023-04-12', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 11:40:39', NULL, 4, 2, 1, 1),
(74, 'ChÃ¡ gelado pra mÃ£e ', 17.99, '2023-04-12', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 11:40:56', '2023-04-13 11:41:06', 4, 2, 1, 1),
(75, '1 Ã¡gua', 5.5, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 11:41:24', NULL, 4, 2, 1, 1),
(76, 'fatura: genfarma 2/3', 20.5, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 11:42:02', NULL, 4, 2, 1, 1),
(77, 'fatura: 99 app', 15.6, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 11:42:19', NULL, 4, 2, 1, 1),
(78, 'fatura: 99 app', 17.9, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 11:42:39', NULL, 4, 2, 1, 1),
(79, 'fatura: pag bombomsouza', 16, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 11:42:54', NULL, 4, 2, 1, 1),
(80, 'Novo atacarejo extras', 54.29, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 11:43:17', NULL, 4, 2, 1, 1),
(81, '1Âª parte do salÃ¡rio', 1000, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 11:47:57', NULL, 4, 3, 1, 1),
(82, 'Teaone cha gelado', 20, '2023-04-12', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 11:48:25', NULL, 4, 4, 1, 1),
(83, 'Fatura: neo sol confec 2/2 ', 39.99, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:49:11', NULL, 4, 4, 1, 1),
(84, 'universo beleza 2/2', 23.97, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:49:28', NULL, 4, 4, 1, 1),
(85, 'tacaruna', 21.5, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:49:36', NULL, 4, 4, 1, 1),
(86, 'Fatura: Xbox metade', 22.5, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:49:48', NULL, 4, 4, 1, 1),
(87, 'fatura: universo beleza 1/2', 17.5, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:50:00', NULL, 4, 4, 1, 1),
(88, 'Fatura: Novo atacarejo', 54.29, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:50:11', NULL, 4, 4, 1, 1),
(89, 'fatura: tim', 20, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:50:21', NULL, 4, 4, 1, 1),
(90, 'fatura:  boa vista shopping', 13.9, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:50:30', NULL, 4, 4, 1, 1),
(91, 'fatura: rp', 69.9, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:50:39', NULL, 4, 4, 1, 1),
(92, 'fatura: tropical 1/2', 25.98, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:50:49', NULL, 4, 4, 1, 1),
(93, 'fatura: prime', 14.9, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:50:57', NULL, 4, 4, 1, 1),
(94, 'fatura: versato fotos 1/8', 60, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:51:08', NULL, 4, 4, 1, 1),
(95, '2 parte do salario', 747.28, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:54:27', NULL, 4, 3, 1, 1),
(96, 'Dinheiro da quinzena', 100, '2023-04-11', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:54:39', NULL, 4, 3, 1, 1),
(97, 'mesada e pÃ¡scoa da madrinha', 150, '2023-04-09', '2023', 'Quinzena 1', 'ATIVO', '2023-04-13 12:55:01', NULL, 4, 3, 1, 1),
(98, 'testando a atualizacao', 2, '2023-03-10', '2023', 'Quinzena 1', 'ATIVO', '2023-05-10 15:32:29', NULL, 3, 4, 1, 2),
(115, 'glayce cavalcanti dias', 100, '2023-04-13', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 12:30:43', NULL, 4, 2, 1, 1),
(116, '1 Ã¡gua', 5.5, '2023-04-15', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 12:31:25', NULL, 4, 2, 1, 1),
(117, 'CARVALHO E SUASSUNA LTD', 3.5, '2023-04-17', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 12:31:43', NULL, 4, 2, 1, 1),
(118, 'Mercadinho gomes', 214.43, '2023-04-17', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 12:32:05', NULL, 4, 2, 1, 1),
(119, '1 Ã¡gua', 5.5, '2023-04-19', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 12:32:48', NULL, 4, 2, 1, 1),
(120, '1 Ã¡gua', 5.5, '2023-04-24', '2023', 'Quinzena 2', 'ATIVO', '2023-05-12 12:37:51', NULL, 4, 2, 1, 1),
(121, 'Ivany ribeiro carvalho', 4.96, '2023-04-25', '2023', 'Quinzena 2', 'ATIVO', '2023-05-12 12:38:06', NULL, 4, 2, 1, 1),
(122, 'Jose lucio da silva monteiro neto', 3, '2023-04-25', '2023', 'Quinzena 2', 'ATIVO', '2023-05-12 12:38:21', NULL, 4, 2, 1, 1),
(123, 'Bombomsouza', 21, '2023-04-27', '2023', 'Quinzena 2', 'ATIVO', '2023-05-12 12:38:41', NULL, 4, 2, 1, 1),
(124, '1 ÃGUA', 5.5, '2023-04-29', '2023', 'Quinzena 2', 'ATIVO', '2023-05-12 12:38:58', NULL, 4, 2, 1, 1),
(125, 'Atacarejo', 280.75, '2023-04-29', '2023', 'Quinzena 2', 'ATIVO', '2023-05-12 12:39:16', NULL, 4, 2, 1, 1),
(126, 'Conta de internet', 75, '2023-05-02', '2023', 'Quinzena 2', 'ATIVO', '2023-05-12 12:39:35', NULL, 4, 2, 1, 3),
(127, 'RaÃ§Ãµes dos animais', 24, '2023-05-02', '2023', 'Quinzena 2', 'ATIVO', '2023-05-12 12:39:54', NULL, 4, 2, 1, 1),
(128, 'Mana delicatessen', 4.87, '2023-05-03', '2023', 'Quinzena 2', 'ATIVO', '2023-05-12 12:40:08', NULL, 4, 2, 1, 1),
(129, 'dinheiro da quinzena', 400, '2023-04-30', '2023', 'Quinzena 2', 'ATIVO', '2023-05-12 12:40:59', NULL, 4, 1, 1, 7),
(130, '1 Ã¡gua', 5.5, '2023-05-05', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 12:41:42', NULL, 5, 2, 1, 1),
(131, 'Bananas', 4, '2023-05-05', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 12:42:10', NULL, 5, 2, 1, 1),
(132, 'Atacarejo', 259.77, '2023-05-07', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 12:42:37', NULL, 5, 2, 1, 1),
(133, 'RaÃ§Ã£o dos animais - humba', 30, '2023-05-07', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 12:42:49', NULL, 5, 2, 1, 1),
(134, 'RemÃ©dio de tosse', 19.9, '2023-05-10', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 12:43:04', NULL, 5, 2, 1, 6),
(135, '1 Ã¡gua', 5.5, '2023-05-10', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 12:43:16', NULL, 5, 2, 1, 1),
(136, '5 reais de sucrilho', 5.08, '2023-05-12', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 12:43:33', NULL, 5, 2, 1, 1),
(137, 'Fatura da casa', 170.01, '2023-05-12', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 13:06:00', NULL, 5, 2, 1, 7),
(138, 'dentista de maio', 70, '2023-05-12', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 13:08:18', NULL, 5, 4, 1, 6),
(139, 'relÃ³gio digital', 30, '2023-05-12', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 13:10:05', NULL, 5, 4, 1, 8),
(140, 'Fatura de maio', 521.38, '2023-05-12', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 13:10:30', NULL, 5, 4, 1, 7),
(141, 'mesada de andreia', 100, '2023-05-09', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 13:12:42', NULL, 5, 3, 1, 7),
(142, 'dinheiro do vem', 100, '2023-05-12', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 13:13:00', NULL, 5, 3, 1, 7),
(143, 'salario 1 metade', 10000, '2023-05-05', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 13:13:49', NULL, 5, 3, 1, 7),
(144, 'salario 2 metade', 588.92, '2023-05-05', '2023', 'Quinzena 1', 'ATIVO', '2023-05-12 13:14:04', NULL, 5, 3, 1, 7),
(146, 'Dinheiro da quinzena', 400, '2023-05-19', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:02:44', NULL, 5, 1, 1, 7),
(147, 'Mana delicatessen', 3.64, '2023-05-19', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:03:30', NULL, 5, 2, 1, 1),
(148, 'Novo atacarejo', 235.83, '2023-05-20', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:03:55', NULL, 5, 2, 1, 1),
(149, 'Bitta bijoterias', 5, '2023-05-21', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:04:40', NULL, 5, 2, 1, 1),
(150, 'Df presentes e utilidades', 5, '2023-05-21', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:05:04', NULL, 5, 2, 1, 1),
(151, 'Pdaavenida das nac', 10, '2023-05-21', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:05:23', NULL, 5, 2, 1, 1),
(152, '1 Ã¡gua', 5.5, '2023-05-22', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:05:53', NULL, 5, 2, 1, 1),
(153, '1 Ã¡gua', 5.5, '2023-05-25', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:06:37', NULL, 5, 2, 1, 1),
(154, '1 Ã¡gua', 5.5, '2023-05-29', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:06:53', NULL, 5, 2, 1, 1),
(155, 'EmpÃ³rio alimentos', 11.6, '2023-05-30', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:07:11', NULL, 5, 2, 1, 1),
(156, 'Guerreiroavenida D (30 ovos)', 20.5, '2023-05-30', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:07:50', '2023-06-03 10:10:03', 5, 2, 1, 1),
(157, 'PagBombomssouza', 21, '2023-06-01', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:09:17', NULL, 5, 2, 1, 1),
(158, 'Complementos agua fria', 47.52, '2023-06-01', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:11:01', NULL, 5, 2, 1, 1),
(159, '1 Ã¡gua', 5.5, '2023-06-03', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:11:16', NULL, 5, 2, 1, 1),
(160, 'RaÃ§Ã£o dos animais p/Humba (30 + 10 )', 40, '2023-06-03', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:14:06', NULL, 5, 2, 1, 1),
(161, '3 palmas de banana', 9, '2023-06-01', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:15:07', NULL, 5, 2, 1, 1),
(162, 'Dinheiro da quinzena', 400, '2023-06-05', '2023', 'Quinzena 1', 'ATIVO', '2023-06-03 10:18:23', NULL, 6, 1, 1, 7),
(163, 'SalÃ¡rio', 1749.29, '2023-06-05', '2023', 'Quinzena 1', 'ATIVO', '2023-06-03 10:25:08', NULL, 6, 3, 1, 7),
(164, 'Odonto conserto', 10, '2023-05-26', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:27:03', NULL, 5, 4, 1, 6),
(165, 'CalÃ§ado', 22, '2023-05-21', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:27:28', NULL, 5, 4, 1, 8),
(166, 'Adaptador p3 p2 headset amazon', 10.5, '2023-06-03', '2023', 'Quinzena 2', 'ATIVO', '2023-06-03 10:40:03', NULL, 5, 4, 1, 1),
(167, 'Fatura junho ', 1022.3, '2023-06-05', '2023', 'Quinzena 1', 'ATIVO', '2023-06-03 11:11:39', '2023-06-05 12:27:50', 6, 4, 1, 1),
(168, 'Fatura junho ', 198.87, '2023-06-05', '2023', 'Quinzena 1', 'ATIVO', '2023-06-03 11:12:18', '2023-06-05 12:27:27', 6, 2, 1, 1),
(169, 'Sabonete assepxia pele oleosa', 9.98, '2023-06-03', '2023', 'Quinzena 2', 'ATIVO', '2023-06-05 11:32:04', NULL, 5, 4, 1, 6),
(170, 'Novo atacarejo (04/06)', 228.42, '2023-06-05', '2023', 'Quinzena 1', 'ATIVO', '2023-06-05 11:33:31', NULL, 6, 2, 1, 1),
(171, 'Uber atacarejo', 17.12, '2023-06-05', '2023', 'Quinzena 1', 'ATIVO', '2023-06-05 11:33:50', NULL, 6, 2, 1, 2),
(173, 'Conta internet', 76.67, '2023-06-06', '2023', 'Quinzena 1', 'ATIVO', '2023-06-12 22:26:18', NULL, 6, 2, 1, 3),
(174, '1 Ã¡gua', 5.5, '2023-06-08', '2023', 'Quinzena 1', 'ATIVO', '2023-06-12 22:26:33', NULL, 6, 2, 1, 1),
(175, 'Uber catarata', 17.95, '2023-06-12', '2023', 'Quinzena 1', 'ATIVO', '2023-06-12 22:28:20', NULL, 6, 2, 1, 2),
(176, 'dinheiro do cinema', 18.5, '2023-06-10', '2023', 'Quinzena 1', 'ATIVO', '2023-06-12 22:28:44', NULL, 6, 3, 1, 4),
(177, 'sorvete mc donalds', 13.9, '2023-06-10', '2023', 'Quinzena 1', 'ATIVO', '2023-06-12 22:29:05', NULL, 6, 4, 1, 5),
(178, 'Kaulzone', 12.9, '2023-06-12', '2023', 'Quinzena 1', 'ATIVO', '2023-06-12 22:29:24', NULL, 6, 4, 1, 5),
(179, 'dinheiro da quinzena', 400, '2023-06-20', '2023', 'Quinzena 2', 'ATIVO', '2023-07-03 11:36:37', NULL, 6, 1, 1, 7),
(180, '1 Ã¡gua', 5.5, '2023-06-21', '2023', 'Quinzena 2', 'ATIVO', '2023-07-03 11:37:00', NULL, 6, 2, 1, 1),
(181, '1 Ã¡gua', 5.5, '2023-06-23', '2023', 'Quinzena 2', 'ATIVO', '2023-07-03 11:37:13', NULL, 6, 2, 1, 1),
(182, 'Novo atacarejo', 209.06, '2023-06-23', '2023', 'Quinzena 2', 'ATIVO', '2023-07-03 11:37:30', NULL, 6, 2, 1, 1),
(183, '1 Ã¡gua', 5.5, '2023-06-30', '2023', 'Quinzena 2', 'ATIVO', '2023-07-03 11:37:46', NULL, 6, 2, 1, 1),
(184, 'Emporio alimentos', 10.46, '2023-07-01', '2023', 'Quinzena 2', 'ATIVO', '2023-07-03 11:43:37', NULL, 6, 2, 1, 1),
(185, 'Conta internet', 76.57, '2023-07-03', '2023', 'Quinzena 2', 'ATIVO', '2023-07-09 11:55:37', NULL, 6, 2, 1, 3),
(186, 'Dinheiro da quinzena', 400, '2023-07-07', '2023', 'Quinzena 1', 'ATIVO', '2023-07-09 11:57:08', NULL, 7, 1, 1, 7),
(187, 'RemÃ©dio de tosse', 23.99, '2023-07-07', '2023', 'Quinzena 1', 'ATIVO', '2023-07-09 11:57:26', NULL, 7, 2, 1, 6),
(188, '1 Ã¡gua', 5.5, '2023-07-08', '2023', 'Quinzena 1', 'ATIVO', '2023-07-09 11:57:39', NULL, 7, 2, 1, 1),
(189, 'Novo atacarejo', 297.99, '2023-07-08', '2023', 'Quinzena 1', 'ATIVO', '2023-07-09 11:58:02', NULL, 7, 2, 1, 1),
(190, 'Restante da 2Âª quinzena de junho', 87.41, '2023-07-09', '2023', 'Quinzena 1', 'ATIVO', '2023-07-09 11:58:31', NULL, 7, 1, 1, 7),
(192, 'gastos atacarejo', 51.82, '2023-07-08', '2023', 'Quinzena 1', 'ATIVO', '2023-07-09 12:11:54', NULL, 7, 4, 1, 1),
(193, 'RaÃ§Ã£o do gato', 20, '2023-07-09', '2023', 'Quinzena 1', 'ATIVO', '2023-07-19 11:33:41', NULL, 7, 2, 1, 1),
(194, 'Areia do gato', 5, '2023-07-09', '2023', 'Quinzena 1', 'ATIVO', '2023-07-19 11:33:59', NULL, 7, 2, 1, 1),
(195, 'RaÃ§Ã£o lady', 10, '2023-07-09', '2023', 'Quinzena 1', 'ATIVO', '2023-07-19 11:34:16', NULL, 7, 2, 1, 1),
(196, '10 reais raÃ§Ã£o + 3 bananas', 13, '2023-07-09', '2023', 'Quinzena 1', 'ATIVO', '2023-07-19 11:34:58', NULL, 7, 2, 1, 1),
(197, 'Arcos dourados comercio alimentos', 6.9, '2023-07-11', '2023', 'Quinzena 1', 'ATIVO', '2023-07-19 11:35:34', NULL, 7, 2, 1, 1),
(198, 'xarope guapo', 9.9, '2023-07-11', '2023', 'Quinzena 1', 'ATIVO', '2023-07-19 11:35:57', NULL, 7, 2, 1, 6),
(199, 'Fatura casa', 130, '2023-07-14', '2023', 'Quinzena 1', 'ATIVO', '2023-07-19 11:37:27', NULL, 7, 2, 1, 1),
(200, '1 Ã¡gua', 5.5, '2023-07-15', '2023', 'Quinzena 1', 'ATIVO', '2023-07-19 11:38:02', NULL, 7, 2, 1, 1),
(201, 'FarmÃ¡cia agrestina doi', 21.55, '2023-07-17', '2023', 'Quinzena 1', 'ATIVO', '2023-07-19 11:38:39', NULL, 7, 2, 1, 1),
(202, '1 Ã¡gua', 5.5, '2023-07-19', '2023', 'Quinzena 1', 'ATIVO', '2023-07-19 11:38:52', NULL, 7, 2, 1, 1),
(203, 'Boleto humberto aposta**', 121.55, '2023-07-19', '2023', 'Quinzena 1', 'ATIVO', '2023-07-19 11:58:48', NULL, 7, 2, 1, 4),
(204, 'corte de cabelo', 16, '2023-07-11', '2023', 'Quinzena 1', 'ATIVO', '2023-07-19 12:09:29', NULL, 7, 4, 1, 6),
(205, 'Dinheiro da quinzena', 400, '2023-01-02', '2023', 'Quinzena 2', 'ATIVO', '2023-07-29 13:18:56', NULL, 7, 1, 1, 7),
(206, 'mercado gomes', 12.46, '2023-07-20', '2023', 'Quinzena 2', 'ATIVO', '2023-07-29 13:28:21', NULL, 7, 2, 1, 1),
(207, '1 agua', 5.5, '2023-07-21', '2023', 'Quinzena 2', 'ATIVO', '2023-07-29 13:28:32', NULL, 7, 2, 1, 1),
(208, '1 Ã¡gua', 5.5, '2023-07-22', '2023', 'Quinzena 2', 'ATIVO', '2023-07-29 13:28:44', NULL, 7, 2, 1, 1),
(209, 'Novo atacarejo', 200.81, '2023-07-22', '2023', 'Quinzena 2', 'ATIVO', '2023-07-29 13:29:08', NULL, 7, 2, 1, 1),
(210, 'pag glauciojosedasilv', 20, '2023-07-23', '2023', 'Quinzena 2', 'ATIVO', '2023-07-29 13:29:24', NULL, 7, 2, 1, 1),
(211, 'farmacia vila bela', 6, '2023-07-23', '2023', 'Quinzena 2', 'ATIVO', '2023-07-29 13:29:41', NULL, 7, 2, 1, 6),
(212, 'valdemir barbosa dos santos', 10, '2023-07-25', '2023', 'Quinzena 2', 'ATIVO', '2023-07-29 13:29:57', NULL, 7, 2, 1, 1),
(213, '1 Ã¡gua', 5.5, '2023-07-26', '2023', 'Quinzena 2', 'ATIVO', '2023-07-29 13:30:10', NULL, 7, 2, 1, 1),
(214, 'Mana delicatessen', 4.93, '2023-07-26', '2023', 'Quinzena 2', 'ATIVO', '2023-07-29 13:30:24', NULL, 7, 2, 1, 1),
(215, 'Fatura julho', 840.27, '2023-07-13', '2023', 'Quinzena 1', 'ATIVO', '2023-07-29 13:47:14', NULL, 7, 4, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `poupancas`
--

CREATE TABLE `poupancas` (
  `id` int(11) NOT NULL,
  `descricao` varchar(300) NOT NULL DEFAULT '',
  `valor` float NOT NULL,
  `dataPoupanca` date NOT NULL,
  `ano` varchar(300) NOT NULL DEFAULT '',
  `status` varchar(300) NOT NULL DEFAULT 'ATIVO',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `idStatus_despensa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `poupancas`
--

INSERT INTO `poupancas` (`id`, `descricao`, `valor`, `dataPoupanca`, `ano`, `status`, `created`, `updated`, `idUsuario`, `idStatus_despensa`) VALUES
(1, 'Valor total e estimado da poupança atual', 200, '2023-03-09', '2023', 'ATIVO', '2023-03-09 16:54:54', NULL, 1, 11),
(2, 'Valor total e estimado da poupança atual', 5, '2023-03-09', '2023', 'ATIVO', '2023-03-09 17:00:24', NULL, 2, 11),
(7, 'teste de entrada', 200, '2023-03-09', '2023', 'ATIVO', '2023-03-09 17:04:08', NULL, 2, 7),
(8, 'MaÃ§Ã£', 2, '2023-03-15', '2023', 'ATIVO', '2023-03-15 16:08:36', NULL, 13, 8),
(9, 'Dinheiro do cachorro', 300, '2023-03-15', '2023', 'ATIVO', '2023-03-15 16:42:16', NULL, 17, 7),
(10, 'PoupanÃ§a do gato', 1000, '2023-02-15', '2023', 'ATIVO', '2023-03-15 16:42:36', NULL, 17, 8),
(11, 'Valor total e estimado da poupanÃ§a atual', 3354.2, '2023-03-18', '2023', 'ATIVO', '2023-03-18 17:29:51', NULL, 1, 11),
(12, 'Minha fatura de MarÃ§o', 490.21, '2023-03-13', '2023', 'ATIVO', '2023-03-18 17:31:09', NULL, 1, 8),
(13, 'Dinheiro atual da poupanÃ§a 18/03/23', 2748.73, '2023-03-18', '2023', 'ATIVO', '2023-03-18 17:32:58', NULL, 1, 7),
(14, 'Fatura da casa de marÃ§o', 101.93, '2023-03-13', '2023', 'ATIVO', '2023-03-18 17:35:11', NULL, 1, 6),
(15, 'Fatura de Camila', 22.5, '2023-03-13', '2023', 'ATIVO', '2023-03-18 17:35:32', NULL, 1, 6),
(16, 'Fatura de Humberto', 122.1, '2023-03-13', '2023', 'ATIVO', '2023-03-18 17:35:52', NULL, 1, 6),
(17, 'Dinheiro atual da poupanÃ§a 18/03/23', 703.82, '2023-03-18', '2023', 'ATIVO', '2023-03-18 17:36:46', NULL, 1, 5),
(18, 'Retornando a fatura de pai', 122.1, '2023-03-18', '2023', 'ATIVO', '2023-03-18 17:40:02', NULL, 1, 5),
(19, 'Retornando a fatura de camila', 22.5, '2023-03-18', '2023', 'ATIVO', '2023-03-18 17:42:50', NULL, 1, 5),
(20, 'Guardando dinheiro da casa', 200, '2023-03-18', '2023', 'ATIVO', '2023-03-18 17:46:37', NULL, 1, 5),
(21, '*Somando para correÃ§Ã£o do dinheiro (nao entrou mais 490.21)', 490.21, '2023-03-22', '2023', 'ATIVO', '2023-03-22 14:05:45', NULL, 1, 7),
(22, '*Somando para correÃ§Ã£o do dinheiro (nao entrou mais 246.53)', 246.53, '2023-03-22', '2023', 'ATIVO', '2023-03-22 14:06:52', NULL, 1, 5),
(23, 'Dinheiro para guarda roupa**', 250, '2023-03-21', '2023', 'ATIVO', '2023-03-22 14:39:37', NULL, 1, 6),
(24, 'Complemento pra instalaÃ§Ã£o do guarda roupa*', 30, '2023-03-21', '2023', 'ATIVO', '2023-03-22 14:43:41', NULL, 1, 6),
(25, 'Extras da ultima fatura', 151.47, '2023-04-13', '2023', 'ATIVO', '2023-04-13 11:46:40', NULL, 1, 5),
(26, 'Poupando o dinheiro antes da fatura', 532.03, '2023-05-12', '2023', 'ATIVO', '2023-05-12 13:26:57', NULL, 1, 5),
(27, 'Dinheiro da fatura de camila paga', 25.5, '2023-05-12', '2023', 'ATIVO', '2023-05-12 13:29:04', NULL, 1, 6),
(28, 'Dinheiro da fatura casa e humberto n pago', 323.03, '2023-05-12', '2023', 'ATIVO', '2023-05-12 13:29:23', NULL, 1, 6),
(29, 'tirando dinheiro pra despensa', 50, '2023-05-12', '2023', 'ATIVO', '2023-05-12 13:29:35', NULL, 1, 6),
(30, 'Fatura de humberto de maio', 168.06, '2023-06-03', '2023', 'ATIVO', '2023-06-03 10:35:59', NULL, 1, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `status_despensas`
--

CREATE TABLE `status_despensas` (
  `id` int(11) NOT NULL,
  `nome` varchar(300) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `status_despensas`
--

INSERT INTO `status_despensas` (`id`, `nome`, `descricao`, `created`) VALUES
(1, 'Despensas: Entrada da casa', '', '2023-02-02 16:42:07'),
(2, 'Despensas: Saida da casa', '', '2023-02-02 16:42:28'),
(3, 'Despensas: Entrada dos gastos pessoais', '', '2023-02-02 16:42:47'),
(4, 'Despensas: Saída dos gastos pessoais', '', '2023-02-02 16:42:49'),
(5, 'Poupanca: Entrada da casa', '', '2023-02-02 16:42:51'),
(6, 'Poupanca: Saida da casa', '', '2023-02-02 16:42:52'),
(7, 'Poupanca: Entrada dos gastos pessoais', '', '2023-02-02 16:42:53'),
(8, 'Poupanca: Saída dos gastos pessoais', '', '2023-02-02 16:42:53'),
(11, 'Valor total da Poupanca', '', '2023-03-08 13:42:15');

-- --------------------------------------------------------

--
-- Estrutura para tabela `status_mes`
--

CREATE TABLE `status_mes` (
  `id` int(11) NOT NULL,
  `nome` varchar(300) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `status_mes`
--

INSERT INTO `status_mes` (`id`, `nome`, `created`) VALUES
(1, ' Janeiro ', '2023-02-02 16:29:49'),
(2, 'Fevereiro', '2023-02-02 16:29:57'),
(3, 'Março', '2023-02-02 16:30:00'),
(4, 'Abril', '2023-02-02 16:30:02'),
(5, 'Maio', '2023-02-02 16:30:03'),
(6, 'Junho', '2023-02-02 16:30:05'),
(7, 'Julho', '2023-02-02 16:30:06'),
(8, 'Agosto', '2023-02-02 16:30:09'),
(9, 'Setembro', '2023-02-02 16:30:13'),
(10, 'Outubro', '2023-02-02 16:30:17'),
(11, 'Novembro', '2023-02-02 16:30:20'),
(12, 'Dezembro', '2023-02-02 16:30:23');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_despensas`
--

CREATE TABLE `tipo_despensas` (
  `id` int(11) NOT NULL,
  `nome` varchar(300) NOT NULL,
  `descricao` varchar(300) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `tipo_despensas`
--

INSERT INTO `tipo_despensas` (`id`, `nome`, `descricao`, `created`) VALUES
(1, 'Mercado', 'Uma das categorias de classificação das despensas', '2023-05-10 15:11:37'),
(2, 'Transporte', 'Uma das categorias de classificação das despensas', '2023-05-10 15:11:44'),
(3, 'TV / Internet / telefone', 'Uma das categorias de classificação das despensas', '2023-05-10 15:11:50'),
(4, 'Lazer', 'Uma das categorias de classificação das despensas', '2023-05-10 15:12:01'),
(5, 'Comida fora ou Ifood', 'Uma das categorias de classificação das despensas', '2023-05-10 15:12:08'),
(6, 'Saúde e Beleza', 'Uma das categorias de classificação das despensas', '2023-05-10 15:12:17'),
(7, 'Moradia', 'Uma das categorias de classificação das despensas', '2023-05-10 15:12:24'),
(8, 'Roupas', 'Uma das categorias de classificação das despensas', '2023-05-10 15:12:31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `senha` varchar(300) NOT NULL,
  `status` varchar(300) NOT NULL DEFAULT 'ATIVO',
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `status`, `created`, `updated`) VALUES
(1, 'Tiago', 'tiagocesar68@gmail.com', 'b6034a9d05d18d2db778ba69e33f12250eebfeca', 'ATIVO', '2023-02-02 16:29:26', '2023-03-09 17:25:07'),
(2, 'Teste de tiago', 'teste@gmail.com', 'e0f68134d29dc326d115de4c8fab8700a3c4b002', 'ATIVO', '2023-03-08 17:39:54', '2023-03-09 17:24:32'),
(8, 'Papiiiiiiiiiiiiiii', 'papi@gmail.com', 'ab14d94055e71ffa6e93f213d950c654f42fd275', 'ATIVO', '2023-03-08 17:44:48', NULL),
(10, 'Papi', 'titi@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ATIVO', '2023-03-09 14:14:56', NULL),
(11, 'papi', 'papicum@gmail.com', '3052150f9a9de9a376afcc809ff9e34e6c22f373', 'ATIVO', '2023-03-09 14:17:41', NULL),
(12, 'teste da quarta', 'testequarta@gmail.com', 'e0f68134d29dc326d115de4c8fab8700a3c4b002', 'ATIVO', '2023-03-15 15:17:00', NULL),
(13, 'teste pro repositorio', 'repositorio@gmail.com', '0bf8c12df5709010337751ceb9b7aaf7748dad75', 'ATIVO', '2023-03-15 15:45:08', NULL),
(14, 'Teste do repositÃ³rio', 'testerepositorio@gmail.com', '0bf8c12df5709010337751ceb9b7aaf7748dad75', 'ATIVO', '2023-03-15 16:22:58', NULL),
(15, 'UsuÃ¡rio de teste', 'usuarioteste@gmail.com', '0bf8c12df5709010337751ceb9b7aaf7748dad75', 'ATIVO', '2023-03-15 16:26:12', NULL),
(16, 'Teste de usuÃ¡rio', 'testedeusuario@gmail.com', '0bf8c12df5709010337751ceb9b7aaf7748dad75', 'ATIVO', '2023-03-15 16:33:19', NULL),
(17, 'Tiago de teste', 'tiagoteste@gmail.com', '0bf8c12df5709010337751ceb9b7aaf7748dad75', 'ATIVO', '2023-03-15 16:38:10', NULL),
(18, 'Walber', 'walbepereira@gmail.com', '8109f559c2d7c8fbc21342ab39dfc14fa1d4f0c5', 'ATIVO', '2023-03-18 15:10:14', NULL),
(19, 'Tester', 'tester@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'ATIVO', '2023-03-23 12:26:38', NULL),
(20, 'Tester2', 'tester2@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ATIVO', '2023-03-23 12:27:26', NULL),
(21, 'teste', 'test@test.net', 'e0f68134d29dc326d115de4c8fab8700a3c4b002', 'ATIVO', '2023-05-10 11:06:45', NULL),
(22, 'CÃ©lio', 'teste@teste.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ATIVO', '2023-05-27 18:33:54', NULL),
(23, 'Et quia ut fugit co', 'rerofok@mailinator.com', '2e6f9b0d5885b6010f9167787445617f553a735f', 'ATIVO', '2023-06-01 13:19:40', NULL),
(24, 'teste', 'criarnetme@gmail.com', 'd2c5311c7d195e560e6244e1892cdcd86c399901', 'ATIVO', '2023-06-08 16:02:24', NULL),
(25, 'Teste1973', 'teste@teste1973.com', '2e6f9b0d5885b6010f9167787445617f553a735f', 'ATIVO', '2023-06-19 18:01:58', NULL),
(26, 'testt', 'testt@tes.com.br', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'ATIVO', '2023-07-12 12:53:48', NULL);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `despensas`
--
ALTER TABLE `despensas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IdStatus_mes` (`IdStatus_mes`),
  ADD KEY `idStatus_despensa` (`idStatus_despensa`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idTipoDespensa` (`idTipoDespensa`);

--
-- Índices de tabela `poupancas`
--
ALTER TABLE `poupancas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idStatus_despensa` (`idStatus_despensa`);

--
-- Índices de tabela `status_despensas`
--
ALTER TABLE `status_despensas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `status_mes`
--
ALTER TABLE `status_mes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tipo_despensas`
--
ALTER TABLE `tipo_despensas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `despensas`
--
ALTER TABLE `despensas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT de tabela `poupancas`
--
ALTER TABLE `poupancas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `status_despensas`
--
ALTER TABLE `status_despensas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `status_mes`
--
ALTER TABLE `status_mes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tipo_despensas`
--
ALTER TABLE `tipo_despensas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `despensas`
--
ALTER TABLE `despensas`
  ADD CONSTRAINT `despensas_ibfk_1` FOREIGN KEY (`IdStatus_mes`) REFERENCES `status_mes` (`id`),
  ADD CONSTRAINT `despensas_ibfk_2` FOREIGN KEY (`idStatus_despensa`) REFERENCES `status_despensas` (`id`),
  ADD CONSTRAINT `despensas_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `poupancas`
--
ALTER TABLE `poupancas`
  ADD CONSTRAINT `poupancas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `poupancas_ibfk_2` FOREIGN KEY (`idStatus_despensa`) REFERENCES `status_despensas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
