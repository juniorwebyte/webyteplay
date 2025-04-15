-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 18/02/2025 às 06:24
-- Versão do servidor: 5.7.44-log
-- Versão do PHP: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `webyteplay`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cart_list`
--

CREATE TABLE `cart_list` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `config` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `customer_list`
--

CREATE TABLE `customer_list` (
  `id` int(11) NOT NULL,
  `firstname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci,
  `password` text COLLATE utf8mb4_unicode_ci,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cpf` text COLLATE utf8mb4_unicode_ci,
  `zipcode` text COLLATE utf8mb4_unicode_ci,
  `address` text COLLATE utf8mb4_unicode_ci,
  `number` text COLLATE utf8mb4_unicode_ci,
  `neighborhood` text COLLATE utf8mb4_unicode_ci,
  `complement` text COLLATE utf8mb4_unicode_ci,
  `state` text COLLATE utf8mb4_unicode_ci,
  `city` text COLLATE utf8mb4_unicode_ci,
  `reference_point` text COLLATE utf8mb4_unicode_ci,
  `is_affiliate` tinyint(1) DEFAULT '0',
  `birth` date DEFAULT NULL,
  `instagram` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `customer_list`
--

INSERT INTO `customer_list` (`id`, `firstname`, `lastname`, `phone`, `email`, `password`, `avatar`, `date_created`, `date_updated`, `cpf`, `zipcode`, `address`, `number`, `neighborhood`, `complement`, `state`, `city`, `reference_point`, `is_affiliate`, `birth`, `instagram`) VALUES
(12, 'Nando ', 'Nando', '31997538489', NULL, NULL, NULL, '2025-01-13 16:10:13', '2025-01-13 16:10:13', '126.649.996-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `origin` text,
  `description` text,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `logs`
--

INSERT INTO `logs` (`id`, `origin`, `description`, `date`) VALUES
(1, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL atualizado pelo usuário Alpha', '2024-12-31 12:54:39'),
(2, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL atualizado pelo usuário Alpha', '2024-12-31 13:20:07'),
(3, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL atualizado pelo usuário Alpha', '2024-12-31 13:20:20'),
(4, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL atualizado pelo usuário Alpha', '2024-12-31 13:23:56'),
(5, 'ORDER', 'Pedido 1 aprovado manualmente pelo usuário Alpha', '2024-12-31 13:24:29'),
(6, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL atualizado pelo usuário Alpha', '2024-12-31 13:41:02'),
(7, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL atualizado pelo usuário Alpha', '2024-12-31 13:41:08'),
(8, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL atualizado pelo usuário Alpha', '2024-12-31 13:58:04'),
(9, 'ORDER', 'Pedido 2 aprovado manualmente pelo usuário Alpha', '2024-12-31 13:58:26'),
(10, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL atualizado pelo usuário Alpha', '2024-12-31 14:04:30'),
(11, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL atualizado pelo usuário Alpha', '2024-12-31 14:17:13'),
(12, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2024-12-31 14:17:22'),
(13, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2024-12-31 14:17:55'),
(14, 'ORDER', 'Pedido 3 aprovado manualmente pelo usuário Alpha', '2024-12-31 14:49:18'),
(15, 'ORDER', 'Pedido 4 aprovado manualmente pelo usuário Alpha', '2024-12-31 14:50:58'),
(16, 'ORDER', 'Pedido 3 deletado pelo usuário Alpha', '2024-12-31 14:51:03'),
(17, 'ORDER', 'Pedido 4 deletado pelo usuário Alpha', '2024-12-31 14:52:32'),
(18, 'PRODUCT', 'Produto IPhone 14 PRO OU 4 MIL NO PIX! atualizado pelo usuário Alpha', '2024-12-31 14:58:40'),
(19, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2024-12-31 14:59:12'),
(20, 'ORDER', 'Pedido 5 aprovado manualmente pelo usuário Alpha', '2024-12-31 15:01:19'),
(21, 'ORDER', 'Pedido 5 deletado pelo usuário Alpha', '2024-12-31 15:04:03'),
(22, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2024-12-31 16:56:40'),
(23, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2024-12-31 16:56:51'),
(24, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2024-12-31 16:57:31'),
(25, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2024-12-31 16:59:09'),
(26, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2024-12-31 20:12:26'),
(27, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2024-12-31 20:12:48'),
(28, 'ORDER', 'Pedido 6 aprovado manualmente pelo usuário Alpha', '2025-01-02 08:59:51'),
(29, 'ORDER', 'Pedido 7 aprovado manualmente pelo usuário Alpha', '2025-01-02 09:04:42'),
(30, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2025-01-02 09:10:12'),
(31, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-02 09:14:50'),
(32, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2025-01-02 09:15:53'),
(33, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-02 11:41:28'),
(34, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-02 11:56:14'),
(35, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-02 11:56:51'),
(36, 'ORDER', 'Pedido 8 aprovado manualmente pelo usuário Alpha', '2025-01-03 18:36:24'),
(37, 'ORDER', 'Pedido 9 aprovado manualmente pelo usuário Alpha', '2025-01-03 18:40:00'),
(38, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-03 18:42:50'),
(39, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-03 18:45:42'),
(40, 'ORDER', 'Pedido 10 aprovado manualmente pelo usuário Alpha', '2025-01-03 18:46:29'),
(41, 'ORDER', 'Pedido 8 deletado pelo usuário Alpha', '2025-01-03 18:49:56'),
(42, 'ORDER', 'Pedido 9 deletado pelo usuário Alpha', '2025-01-03 18:49:58'),
(43, 'ORDER', 'Pedido 10 deletado pelo usuário Alpha', '2025-01-03 18:50:21'),
(44, 'ORDER', 'Pedido 11 aprovado manualmente pelo usuário Alpha', '2025-01-03 19:48:46'),
(45, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-03 19:49:21'),
(46, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-03 19:49:45'),
(47, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-03 19:50:08'),
(48, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-03 19:52:24'),
(49, 'ORDER', 'Pedido 12 aprovado manualmente pelo usuário Alpha', '2025-01-03 19:52:39'),
(50, 'SYSTEM', 'Configurações do sistema atualizadas pelo usuário Alpha', '2025-01-03 20:34:34'),
(51, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2025-01-03 20:36:11'),
(52, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-03 20:37:54'),
(53, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2025-01-03 20:38:28'),
(54, 'ORDER', 'Pedido 13 aprovado manualmente pelo usuário Alpha', '2025-01-06 21:08:58'),
(55, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2025-01-06 21:12:44'),
(56, 'PRODUCT', 'Produto TESTE CAIXAS adicionado pelo usuário Alpha', '2025-01-06 21:15:30'),
(57, 'PRODUCT', 'Produto TESTE CAIXAS atualizado pelo usuário Alpha', '2025-01-06 21:15:47'),
(58, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2025-01-06 21:24:32'),
(59, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2025-01-06 21:29:06'),
(60, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2025-01-06 21:33:27'),
(61, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2025-01-06 21:34:07'),
(62, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2025-01-06 21:34:24'),
(63, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2025-01-06 21:34:52'),
(64, 'ORDER', 'Pedido 14 aprovado manualmente pelo usuário Alpha', '2025-01-06 21:41:51'),
(65, 'ORDER', 'Pedido 15 aprovado manualmente pelo usuário Alpha', '2025-01-06 21:54:11'),
(66, 'ORDER', 'Pedido 16 aprovado manualmente pelo usuário Alpha', '2025-01-07 01:37:13'),
(67, 'ORDER', 'Pedido 17 aprovado manualmente pelo usuário Alpha', '2025-01-07 01:37:14'),
(68, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2025-01-07 13:15:00'),
(69, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-07 13:27:29'),
(70, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - CAIXAS atualizado pelo usuário Alpha', '2025-01-07 13:29:21'),
(71, 'ORDER', 'Pedido 19 aprovado manualmente pelo usuário Alpha', '2025-01-07 13:39:33'),
(72, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-07 13:50:18'),
(73, 'ORDER', 'Pedido 20 aprovado manualmente pelo usuário Alpha', '2025-01-07 13:51:22'),
(74, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-07 14:52:36'),
(75, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-07 16:44:20'),
(76, 'ORDER', 'Pedido 21 aprovado manualmente pelo usuário Alpha', '2025-01-07 16:47:38'),
(77, 'ORDER', 'Pedido 22 aprovado manualmente pelo usuário Alpha', '2025-01-07 16:48:00'),
(78, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-07 16:52:56'),
(79, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-07 18:01:57'),
(80, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-07 18:02:39'),
(81, 'ORDER', 'Pedido 23 aprovado manualmente pelo usuário Alpha', '2025-01-07 18:04:59'),
(82, 'PRODUCT', 'Produto PIX PREMIADO DE 3MIL - ROLETA atualizado pelo usuário Alpha', '2025-01-07 18:09:40'),
(83, 'SYSTEM', 'Configurações do sistema atualizadas pelo usuário Alpha', '2025-01-07 18:54:13'),
(84, 'SYSTEM', 'Configurações do sistema atualizadas pelo usuário Alpha', '2025-01-07 18:54:49'),
(85, 'SYSTEM', 'Configurações do sistema atualizadas pelo usuário Alpha', '2025-01-07 18:54:59'),
(86, 'PRODUCT', 'Produto  adicionado pelo usuário Alpha', '2025-01-07 18:58:36'),
(87, 'PRODUCT', 'Produto IPHONE 15 TESTE   atualizado pelo usuário Alpha', '2025-01-07 19:00:41'),
(88, 'USER', 'Usuário Cagilu atualizado pelo usuário Cagilu', '2025-01-07 19:17:28'),
(89, 'USER', 'Usuário Cagilu atualizado pelo usuário Cagilu', '2025-01-07 19:18:23'),
(90, 'SYSTEM', 'Configurações do sistema atualizadas pelo usuário Cagilu', '2025-01-07 19:22:43'),
(91, 'PRODUCT', 'Produto IPHONE 15 TESTE   atualizado pelo usuário Cagilu', '2025-01-07 19:23:33'),
(92, 'PRODUCT', 'Produto  adicionado pelo usuário Cagilu', '2025-01-07 19:52:00'),
(93, 'SYSTEM', 'Configurações do sistema atualizadas pelo usuário Cagilu', '2025-01-08 19:23:30'),
(94, 'PRODUCT', 'Produto  atualizado pelo usuário Cagilu', '2025-01-08 19:58:12'),
(95, 'ORDER', 'Pedido 26 deletado pelo usuário Cagilu', '2025-01-08 19:59:02'),
(96, 'ORDER', 'Pedido 25 deletado pelo usuário Cagilu', '2025-01-08 19:59:05'),
(97, 'ORDER', 'Pedido 24 deletado pelo usuário Cagilu', '2025-01-08 19:59:07'),
(98, 'USER', 'Usuário Nando atualizado pelo usuário Nando', '2025-01-08 21:58:07'),
(99, 'SYSTEM', 'Configurações do sistema atualizadas pelo usuário Nando', '2025-01-08 22:02:58'),
(100, 'PRODUCT', 'Produto  atualizado pelo usuário Nando', '2025-01-08 22:05:44'),
(101, 'PRODUCT', 'Produto Teste atualizado pelo usuário Nando', '2025-01-08 22:06:48'),
(102, 'PRODUCT', 'Produto Teste atualizado pelo usuário Nando', '2025-01-08 22:06:56'),
(103, 'PRODUCT', 'Produto Teste atualizado pelo usuário Nando', '2025-01-08 22:07:12'),
(104, 'PRODUCT', 'Produto Demonstração atualizado pelo usuário Nando', '2025-01-08 22:49:14'),
(105, 'PRODUCT', 'Produto Roleta adicionado pelo usuário Nando', '2025-01-08 23:03:09'),
(106, 'PRODUCT', 'Produto Roleta atualizado pelo usuário Nando', '2025-01-08 23:03:43'),
(107, 'PRODUCT', 'Produto Roleta atualizado pelo usuário Nando', '2025-01-08 23:04:28'),
(108, 'PRODUCT', 'Produto Teste Roleta adicionado pelo usuário Nando', '2025-01-08 23:07:43'),
(109, 'PRODUCT', 'Produto Teste Roleta atualizado pelo usuário Nando', '2025-01-08 23:08:04'),
(110, 'PRODUCT', 'Produto Teste Roleta atualizado pelo usuário Nando', '2025-01-08 23:08:22'),
(111, 'PRODUCT', 'Produto Teste Roleta atualizado pelo usuário Nando', '2025-01-08 23:08:40'),
(112, 'PRODUCT', 'Produto Teste Roleta atualizado pelo usuário Nando', '2025-01-08 23:08:48'),
(113, 'PRODUCT', 'Produto Teste Roleta atualizado pelo usuário Nando', '2025-01-08 23:09:18'),
(114, 'PRODUCT', 'Produto Demonstração atualizado pelo usuário Nando', '2025-01-08 23:27:34'),
(115, 'PRODUCT', 'Produto Demonstração atualizado pelo usuário Nando', '2025-01-08 23:30:24'),
(116, 'PRODUCT', 'Produto Teste Roleta atualizado pelo usuário Nando', '2025-01-08 23:31:07'),
(117, 'SYSTEM', 'Configurações do sistema atualizadas pelo usuário Nando', '2025-01-09 00:28:12'),
(118, 'USER', 'Usuário Nando atualizado pelo usuário Nando', '2025-01-09 00:35:00'),
(119, 'USER', 'Usuário Host atualizado pelo usuário Host', '2025-01-09 00:35:43'),
(120, 'SYSTEM', 'Configurações do sistema atualizadas pelo usuário Host', '2025-01-09 00:36:08'),
(121, 'SYSTEM', 'Configurações do sistema atualizadas pelo usuário Host', '2025-01-09 00:36:57'),
(122, 'SYSTEM', 'Configurações do sistema atualizadas pelo usuário Host', '2025-01-09 00:37:53'),
(123, 'SYSTEM', 'Configurações do sistema atualizadas pelo usuário Host', '2025-01-09 00:48:28'),
(124, 'PRODUCT', 'Produto Teste Roleta atualizado pelo usuário Host', '2025-01-09 00:53:31'),
(125, 'PRODUCT', 'Produto IPHONE 15 TESTE   atualizado pelo usuário Host', '2025-01-09 12:54:27'),
(126, 'PRODUCT', 'Produto IPHONE 15 TESTE   atualizado pelo usuário Host', '2025-01-09 12:55:11'),
(127, 'PRODUCT', 'Produto IPHONE 15 TESTE   atualizado pelo usuário Host', '2025-01-09 12:55:30'),
(128, 'USER', 'Usuário Host atualizado pelo usuário Host', '2025-01-09 13:04:36'),
(129, 'USER', 'Usuário Host atualizado pelo usuário Host', '2025-01-09 13:04:58'),
(130, 'USER', 'Usuário Host atualizado pelo usuário Host', '2025-01-09 13:05:10'),
(131, 'USER', 'Usuário Host atualizado pelo usuário Host', '2025-01-09 13:05:17'),
(132, 'USER', 'Usuário Host atualizado pelo usuário Host', '2025-01-09 13:05:47'),
(133, 'PRODUCT', 'Produto Teste adicionado pelo usuário Host', '2025-01-09 15:02:07'),
(134, 'PRODUCT', 'Produto Teste atualizado pelo usuário Host', '2025-01-09 15:02:50'),
(135, 'PRODUCT', 'Produto Teste atualizado pelo usuário Host', '2025-01-09 15:03:34'),
(136, 'PRODUCT', 'Produto Teste atualizado pelo usuário Host', '2025-01-13 15:23:45'),
(137, 'PRODUCT', 'Produto Teste atualizado pelo usuário Host', '2025-01-13 15:23:51'),
(138, 'PRODUCT', 'Produto Teste atualizado pelo usuário Host', '2025-01-13 15:25:08'),
(139, 'ORDER', 'Pedido 31 aprovado manualmente pelo usuário Host', '2025-01-13 15:28:16'),
(140, 'PRODUCT', 'Produto Demonstração atualizado pelo usuário Host', '2025-01-13 15:30:44'),
(141, 'PRODUCT', 'Produto Demonstração atualizado pelo usuário Host', '2025-01-13 15:30:51'),
(142, 'ORDER', 'Pedido 31 deletado pelo usuário Host', '2025-01-13 15:31:01'),
(143, 'PRODUCT', 'Produto Demonstração atualizado pelo usuário Host', '2025-01-13 15:31:58'),
(144, 'PRODUCT', 'Produto Modelo roleta atualizado pelo usuário Host', '2025-01-13 15:32:44'),
(145, 'PRODUCT', 'Produto Modelo Caixa Premiada atualizado pelo usuário Host', '2025-01-13 15:33:25'),
(146, 'PRODUCT', 'Produto Modelo Caixa Premiada atualizado pelo usuário Host', '2025-01-13 15:33:44'),
(147, 'PRODUCT', 'Produto Modelo Caixa Premiada atualizado pelo usuário Host', '2025-01-13 15:36:56'),
(148, 'PRODUCT', 'Produto Modelo Caixa Premiada atualizado pelo usuário Host', '2025-01-13 15:56:36'),
(149, 'PRODUCT', 'Produto Modelo Caixa Premiada atualizado pelo usuário Host', '2025-01-13 16:05:11'),
(150, 'USER', 'Usuário Host atualizado pelo usuário Host', '2025-01-13 16:06:24'),
(151, 'SYSTEM', 'Configurações do sistema atualizadas pelo usuário Host', '2025-01-13 16:11:37'),
(152, 'PRODUCT', 'Produto Modelo Caixa Premiada atualizado pelo usuário Host', '2025-01-13 16:13:39'),
(153, 'SYSTEM', 'Configurações do sistema atualizadas pelo usuário Host', '2025-01-13 16:14:22');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_05_14_045711_create_cart_list_table', 0),
(2, '2024_05_14_045711_create_config_table', 0),
(3, '2024_05_14_045711_create_customer_list_table', 0),
(4, '2024_05_14_045711_create_logs_table', 0),
(5, '2024_05_14_045711_create_order_items_table', 0),
(6, '2024_05_14_045711_create_order_list_table', 0),
(7, '2024_05_14_045711_create_product_list_table', 0),
(8, '2024_05_14_045711_create_referral_table', 0),
(9, '2024_05_14_045711_create_referral_transactions_table', 0),
(10, '2024_05_14_045711_create_system_info_table', 0),
(11, '2024_05_14_045711_create_users_table', 0),
(12, '2024_05_14_045714_add_foreign_keys_to_cart_list_table', 0),
(13, '2024_05_14_045714_add_foreign_keys_to_order_items_table', 0),
(14, '2024_05_14_045714_add_foreign_keys_to_order_list_table', 0),
(15, '2024_05_14_045714_add_foreign_keys_to_referral_table', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `price` float(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `order_list`
--

CREATE TABLE `order_list` (
  `id` int(11) NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `quantity` text COLLATE utf8mb4_unicode_ci,
  `total_amount` float(12,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=pending2=paid3=cancelled',
  `roleta` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `product_name` text COLLATE utf8mb4_unicode_ci,
  `order_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_numbers` longtext COLLATE utf8mb4_unicode_ci,
  `product_id` int(11) DEFAULT NULL,
  `payment_method` text COLLATE utf8mb4_unicode_ci,
  `order_expiration` text COLLATE utf8mb4_unicode_ci,
  `pix_code` text COLLATE utf8mb4_unicode_ci,
  `pix_qrcode` text COLLATE utf8mb4_unicode_ci,
  `txid` text COLLATE utf8mb4_unicode_ci,
  `discount_amount` text COLLATE utf8mb4_unicode_ci,
  `whatsapp_status` text COLLATE utf8mb4_unicode_ci,
  `dwapi_status` text COLLATE utf8mb4_unicode_ci,
  `id_mp` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `product_list`
--

CREATE TABLE `product_list` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float(12,2) NOT NULL DEFAULT '0.00',
  `image_path` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type_of_draw` tinyint(1) NOT NULL DEFAULT '1',
  `qty_numbers` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_purchase` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_purchase` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pending_numbers` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_numbers` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ranking_qty` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `enable_ranking` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_gallery` text COLLATE utf8mb4_unicode_ci,
  `enable_progress_bar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `draw_number` text COLLATE utf8mb4_unicode_ci,
  `status_display` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci,
  `date_of_draw` datetime DEFAULT NULL,
  `limit_order_remove` text COLLATE utf8mb4_unicode_ci,
  `discount_qty` text COLLATE utf8mb4_unicode_ci,
  `discount_amount` text COLLATE utf8mb4_unicode_ci,
  `discount_roleta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `enable_discount` text COLLATE utf8mb4_unicode_ci,
  `enable_cumulative_discount` text COLLATE utf8mb4_unicode_ci,
  `enable_sale` text COLLATE utf8mb4_unicode_ci,
  `sale_qty` text COLLATE utf8mb4_unicode_ci,
  `sale_price` float(12,2) DEFAULT '0.00',
  `ranking_message` text COLLATE utf8mb4_unicode_ci,
  `enable_ranking_show` text COLLATE utf8mb4_unicode_ci,
  `draw_winner` text COLLATE utf8mb4_unicode_ci,
  `private_draw` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_draw` text COLLATE utf8mb4_unicode_ci,
  `cotas_premiadas` longtext COLLATE utf8mb4_unicode_ci,
  `cotas_premiadas_premios` mediumtext COLLATE utf8mb4_unicode_ci,
  `cotas_premiadas_descricao` text COLLATE utf8mb4_unicode_ci,
  `limit_orders` int(11) DEFAULT '0',
  `ranking_type` int(11) NOT NULL DEFAULT '1',
  `qty_select_1` int(11) NOT NULL DEFAULT '10',
  `qty_select_2` int(11) NOT NULL DEFAULT '20',
  `qty_select_3` int(11) NOT NULL DEFAULT '50',
  `qty_select_4` int(11) NOT NULL DEFAULT '100',
  `qty_select_5` int(11) NOT NULL DEFAULT '200',
  `qty_select_6` int(11) NOT NULL DEFAULT '300',
  `status_auto_cota` tinyint(1) NOT NULL DEFAULT '0',
  `valor_base_auto` int(11) NOT NULL DEFAULT '50',
  `quantidade_numeros` int(11) NOT NULL DEFAULT '2',
  `tipo_auto_cota` longtext COLLATE utf8mb4_unicode_ci,
  `up` tinyint(1) NOT NULL DEFAULT '0',
  `quantidade_auto_cota` int(11) NOT NULL DEFAULT '0',
  `quantidade_auto_cota_diario` int(11) DEFAULT '0',
  `roleta` tinyint(1) NOT NULL DEFAULT '0',
  `box` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `product_list`
--

INSERT INTO `product_list` (`id`, `name`, `description`, `price`, `image_path`, `status`, `delete_flag`, `date_created`, `date_updated`, `type_of_draw`, `qty_numbers`, `min_purchase`, `max_purchase`, `slug`, `pending_numbers`, `paid_numbers`, `ranking_qty`, `enable_ranking`, `image_gallery`, `enable_progress_bar`, `draw_number`, `status_display`, `subtitle`, `date_of_draw`, `limit_order_remove`, `discount_qty`, `discount_amount`, `discount_roleta`, `enable_discount`, `enable_cumulative_discount`, `enable_sale`, `sale_qty`, `sale_price`, `ranking_message`, `enable_ranking_show`, `draw_winner`, `private_draw`, `featured_draw`, `cotas_premiadas`, `cotas_premiadas_premios`, `cotas_premiadas_descricao`, `limit_orders`, `ranking_type`, `qty_select_1`, `qty_select_2`, `qty_select_3`, `qty_select_4`, `qty_select_5`, `qty_select_6`, `status_auto_cota`, `valor_base_auto`, `quantidade_numeros`, `tipo_auto_cota`, `up`, `quantidade_auto_cota`, `quantidade_auto_cota_diario`, `roleta`, `box`) VALUES
(94, 'Modelo roleta', '&#60;p&#62;Modelo Roleta&#38;nbsp;&#60;/p&#62;', 0.00, 'uploads/campanhas/04.jpg?v=1723512703', 3, 0, '2024-08-13 03:31:43', '2025-02-17 20:02:39', 1, '1000000', '1', '20000', 'modelo-roleta', '0', '27002', '6', '1', '[]', '0', '', '4', 'Demonstração', '2024-08-12 21:36:00', '15', '[\"10\",\"20\",\"30\",\"40\"]', '[\"0.00\",\"0.00\",\"0.00\",\"0.00\"]', NULL, '1', '0', '0', '0', 0.00, 'Quem comprar mais cotas, 1º lugar ganha: R$', '1', '[\"\"]', '0', '0', '1111111,222222', '1111111:IPHONE 15 PRO MAX:ouro,222222:PIX DE 500 REAIS:premiada', '', 0, 1, 100, 200, 500, 1000, 2000, 3000, 1, 0, 2, '1111111,222222', 0, 1, 0, 1, 1),
(115, 'Teste', '&#60;p&#62;Teste&#60;/p&#62;', 0.02, 'uploads/campanhas/10001707.jpg?v=1736445727', 1, 0, '2025-01-09 15:02:07', '2025-01-13 15:31:01', 1, '50', '1', '500', 'teste-2', '0', '0', '3', '1', '[]', '1', '', '1', 'Teste', NULL, '0', '[\"100\",\"200\",\"400\"]', '[\"0.50\",\"0.70\",\"1.00\"]', NULL, '1', '0', '0', '0', 0.00, 'Quem comprar mais cotas, 1º lugar ganha: R$', '1', '[\"\"]', '0', '0', '', '', '', 0, 1, 10, 20, 50, 100, 200, 300, 1, 0, 2, '', 0, 1, 1, 1, 0),
(116, 'Modelo Caixa Premiada', '&#60;p&#62;Modelo Caixa Premiada&#60;/p&#62;', 0.00, 'uploads/campanhas/Tiago farias_20250108_220144_0000.png?v=1736793224', 1, 0, '2025-01-13 15:32:52', '2025-01-13 15:57:09', 1, '1000000', '1', '20000', 'modelo-caixa-premiada-2', '0', '202', '6', '1', '[]', '0', '', '1', 'Demonstração', NULL, '15', '[\"10\",\"20\",\"30\",\"40\"]', '[\"0.00\",\"0.00\",\"0.00\",\"0.00\"]', '', '1', '0', '0', '0', 0.00, 'Quem comprar mais cotas, 1º lugar ganha: R$', '1', '[\"\"]', '0', '0', '1111111,222222', '1111111:IPHONE 15 PRO MAX:ouro,222222:PIX DE 500 REAIS:premiada', '', 0, 1, 100, 200, 500, 1000, 2000, 3000, 1, 0, 2, '1111111,222222', 0, 1, 0, 0, 1),
(117, 'Modelo Caixa Premiada', '&#60;p&#62;Modelo Caixa Premiada&#60;/p&#62;', 0.00, 'uploads/campanhas/Tiago farias_20250108_220144_0000.png?v=1736793224', 1, 0, '2025-01-13 15:39:39', '2025-01-13 16:13:39', 1, '1000000', '1', '20000', 'modelo-caixa-premiada-3', '0', '20026', '6', '1', '[]', '0', '', '1', 'Demonstração', NULL, '15', '[\"10\",\"20\",\"30\",\"40\"]', '[\"0.00\",\"0.00\",\"0.00\",\"0.00\"]', '', '0', '0', '0', '0', 0.00, 'Quem comprar mais cotas, 1º lugar ganha: R$', '1', '[\"\"]', '0', '1', '1111111,222222', '1111111:IPHONE 15 PRO MAX:ouro,222222:PIX DE 500 REAIS:premiada', '', 0, 1, 100, 200, 500, 1000, 2000, 3000, 1, 0, 2, '1111111,222222', 0, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `referral`
--

CREATE TABLE `referral` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `referral_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage` float(12,2) NOT NULL DEFAULT '0.00',
  `amount_paid` float(12,2) NOT NULL DEFAULT '0.00',
  `amount_pending` float(12,2) NOT NULL DEFAULT '0.00',
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `referral_transactions`
--

CREATE TABLE `referral_transactions` (
  `id` int(11) NOT NULL,
  `total_amount` float(12,2) NOT NULL DEFAULT '0.00',
  `referral_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `system_info`
--

CREATE TABLE `system_info` (
  `id` int(11) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Hostsever'),
(2, 'short_name', ''),
(3, 'logo', 'uploads/logo.png?v=1736384578'),
(4, 'user_avatar', 'uploads/user_avatar.jpg'),
(5, 'cover', 'uploads/cover.png?v=1675042834'),
(6, 'phone', '(31) 99753-8489'),
(7, 'mobile', '00000'),
(8, 'email', 'b4hoost@gmail.com'),
(9, 'address', 'Endereço'),
(10, 'mercadopago', '2'),
(11, 'mercadopago_access_token', 'APP_USR-325888472139985-072111-bf236d0726f8d6ce60a581cf62f10140-1170836546'),
(12, 'gerencianet', '2'),
(13, 'gerencianet_client_id', ''),
(14, 'gerencianet_client_secret', ''),
(15, 'gerencianet_pix_key', ''),
(16, 'gateway', '1'),
(17, 'enable_cpf', '2'),
(18, 'enable_email', '2'),
(19, 'enable_address', '2'),
(20, 'favicon', 'uploads/favicon.png?v=1736384578'),
(21, 'enable_share', '2'),
(22, 'enable_groups', '1'),
(23, 'telegram_group_url', ''),
(24, 'whatsapp_group_url', ''),
(25, 'enable_footer', '1'),
(26, 'text_footer', 'Título de Capitalização da Modalidade Filantropia Premiável de Contribuição Única, emitido pela KOVR Capitalização S/A, CNPJ 00.000.000/0000-00, aprovado pelo Processo SUSEP que consta no Título. SAC 0800 646 8378. OUVIDORIA 0800 606 2320. É proibida a venda de título de capitalização a menores de dezesseis anos. O valor não exigido dentro do prazo prescricional, estabelecido pela legislação em vigor, acarretará a perda desse direito. A aquisição deste título implica a cessão de 100% do direito de resgate à Federação Nacional das Associações Pestalozzi - FENAPESTALOZZI, certificada nos termos da legislação em vigor. Antes de contratar consulte previamente as Condições Gerais. As condições contratuais/regulamento deste produto protocolizadas pela sociedade junto à SUSEP poderão ser consultadas no endereço eletrônico www.susep.gov.br, de acordo com o número de processo constante da proposta. Prêmios líquidos de imposto de renda. Confira o resultado dos sorteios e as condições de participação em www.seguiste.com.br Imagens meramente ilustrativas.'),
(27, 'enable_password', '2'),
(28, 'paggue', '1'),
(29, 'paggue_client_key', '4073067412884515346'),
(30, 'paggue_client_secret', '9446284159648339243996261'),
(31, 'enable_pixel', '2'),
(32, 'facebook_access_token', ''),
(33, 'facebook_pixel_id', ''),
(34, 'enable_hide_numbers', '1'),
(35, 'whatsapp_footer', ''),
(36, 'instagram_footer', ''),
(37, 'facebook_footer', ''),
(38, 'twitter_footer', ''),
(39, 'youtube_footer', ''),
(40, 'enable_dwapi', '2'),
(41, 'token_dwapi', ''),
(42, 'numero_dwapi', ''),
(43, 'mensagem_novo_pedido_dwapi', ''),
(44, 'mensagem_pedido_pago_dwapi', ''),
(45, 'smtp_host', 'smtp.hostinger.com'),
(46, 'smtp_port', ' 465'),
(47, 'smtp_user', ''),
(48, 'smtp_pass', 'digital2023'),
(49, 'question1', 'Como acessar minhas compras?'),
(50, 'answer1', 'Fazendo login no site e abrindo o Menu Principal, você consegue consultar suas últimas compras no menu '),
(51, 'question2', 'Como envio o comprovante?'),
(52, 'answer2', 'Caso você tenha feito o pagamento via Pix QR Code ou copiando o código, não é necessário enviar o comprovante, aguardando até 5 minutos após o pagamento, o sistema irá dar baixa automaticamente, para mais dúvidas entre em contato conosco clicando aqui.'),
(53, 'question3', 'Como é o processo do sorteio?'),
(54, 'answer3', 'O sorteio será realizado com base na extração da Loteria Federal, conforme Condições de Participação constantes no título'),
(55, 'question4', ''),
(56, 'answer4', ''),
(57, 'terms', '<b>1)</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br><br> <b>2)</b> Lorem Ipsum has been the industry&apos;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. <br><br> <b>3)</b> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. <br><br> (i) It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. <br><br> (ii) Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &apos;lorem ipsum&apos; will uncover many web sites still in their infancy.'),
(58, 'enable_ga4', '2'),
(59, 'google_ga4_id', '1'),
(60, 'license', ''),
(61, 'enable_two_phone', '2'),
(62, 'enable_gtm', '2'),
(63, 'google_gtm_id', ''),
(64, 'theme', '1'),
(65, 'email_order', ''),
(66, 'email_purchase', ''),
(67, 'enable_legal_age', '2'),
(68, 'enable_birth', '2'),
(69, 'enable_instagram', '2'),
(70, 'enable_multiple_order', '2'),
(71, 'dealer_active', '2'),
(72, 'dealer_deactive_site', '2'),
(73, 'dealer_split_mercadopago', '2'),
(74, 'mercadopago_tax', ''),
(75, 'gerencianet_tax', ''),
(76, 'paggue_tax', '0'),
(77, 'openpix_app_id', ''),
(78, 'openpix_tax', ''),
(79, 'pay2m_client_id', 'd8e276b1-01ab-4ede-a7fb-035d915adfb4'),
(80, 'pay2m_client_secret', '5a8dd04d-638d-4b51-90d2-61912053c759 '),
(81, 'pay2m_tax', '0'),
(82, 'openpix', '2'),
(83, 'pay2m', '2'),
(85, 'pagstar', '2'),
(86, 'pagstar_client_key', 'b75fd923-9dd2-4cf4-84ad-3cee1fc2779d'),
(87, 'pagstar_client_secret', 'b75fd923-9dd2-4cf4-84ad-3cee1fc2779d'),
(88, 'openpix_webhook_url', 'https://thiagoaraujoofc.com/webhook.php?notify=openpix'),
(89, 'pagstar2', '2'),
(90, 'Pagstar_webhook_url', ''),
(91, 'ezzepay', '2'),
(92, 'ezzepay_client_id', ''),
(93, 'ezzepay_client_secret', '   '),
(94, 'nextpay', '2'),
(95, 'nextpay_client_id', '2jou8i97fbsnma4r5qiau8apfo'),
(96, 'nextpay_client_secret', '9mioetq5u2to5qsr5jp12tq88l9tekp6mitnr7d0n9f7tsfkbpv     '),
(97, 'nextpay_webhook', 'https://primium.renovee.com.br/webhook_next.php');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` text,
  `site` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='2';

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`, `email`, `site`) VALUES
(1, 'Webyte', 'Play', 'Rifas', 'Admin', '3d8dc180b6397ff4cf1953e83b5428df', 'uploads/avatars/novo_avatar.png', '2025-02-17 22:16:05', 1, '2021-01-20 14:02:37', '2025-02-17 22:21:44', 'juniorwci70@gmail.com', 'https://webyteplay.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cart_list`
--
ALTER TABLE `cart_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Índices de tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `customer_list`
--
ALTER TABLE `customer_list`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `order_items`
--
ALTER TABLE `order_items`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id_2` (`order_id`,`product_id`,`quantity`,`price`);

--
-- Índices de tabela `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_list_index` (`product_id`,`order_numbers`(64),`code`);

--
-- Índices de tabela `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Índices de tabela `referral_transactions`
--
ALTER TABLE `referral_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cart_list`
--
ALTER TABLE `cart_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=551;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `customer_list`
--
ALTER TABLE `customer_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de tabela `referral`
--
ALTER TABLE `referral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `referral_transactions`
--
ALTER TABLE `referral_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cart_list`
--
ALTER TABLE `cart_list`
  ADD CONSTRAINT `customer_id_fk_cl` FOREIGN KEY (`customer_id`) REFERENCES `customer_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_id_fk_cl` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_id_fk_oi` FOREIGN KEY (`order_id`) REFERENCES `order_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_id_fk_oi` FOREIGN KEY (`product_id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `customer_id_fk_ol` FOREIGN KEY (`customer_id`) REFERENCES `customer_list` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `referral`
--
ALTER TABLE `referral`
  ADD CONSTRAINT `customer_id_fk_re` FOREIGN KEY (`customer_id`) REFERENCES `customer_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
