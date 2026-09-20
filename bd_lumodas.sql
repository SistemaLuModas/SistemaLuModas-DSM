-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/09/2026 às 03:46
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_lumodas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `bd_ajuste_estoque`
--

CREATE TABLE `bd_ajuste_estoque` (
  `ajuste_id` int(11) NOT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `ajuste_quantidade` int(11) DEFAULT NULL,
  `ajuste_baixa` tinyint(1) NOT NULL,
  `ajuste_motivo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `bd_categoria`
--

CREATE TABLE `bd_categoria` (
  `categoria_id` int(11) NOT NULL,
  `categoria_nome` varchar(30) DEFAULT NULL,
  `categoria_sexo` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `bd_estoque`
--

CREATE TABLE `bd_estoque` (
  `estoque_id` int(11) NOT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `estoque_quantidade_disponivel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `bd_item_venda`
--

CREATE TABLE `bd_item_venda` (
  `item_id` int(11) NOT NULL,
  `venda_id` int(11) DEFAULT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `item_quantidade` int(11) DEFAULT NULL,
  `item_valor` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `bd_produtos`
--

CREATE TABLE `bd_produtos` (
  `prod_nome` varchar(45) DEFAULT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_preco` decimal(4,2) DEFAULT NULL,
  `prod_quantidade` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `bd_usuario`
--

CREATE TABLE `bd_usuario` (
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `bd_usuario`
--

INSERT INTO `bd_usuario` (`usuario`, `senha`) VALUES
('devtools@gmail.com', 'devtools');

-- --------------------------------------------------------

--
-- Estrutura para tabela `bd_usuario_adm`
--

CREATE TABLE `bd_usuario_adm` (
  `usuario_adm` varchar(50) NOT NULL,
  `senha_adm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `bd_usuario_adm`
--

INSERT INTO `bd_usuario_adm` (`usuario_adm`, `senha_adm`) VALUES
('lumodas@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Estrutura para tabela `bd_venda`
--

CREATE TABLE `bd_venda` (
  `venda_id` int(11) NOT NULL,
  `venda_data` date DEFAULT NULL,
  `venda_preco` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `bd_ajuste_estoque`
--
ALTER TABLE `bd_ajuste_estoque`
  ADD PRIMARY KEY (`ajuste_id`),
  ADD KEY `FK_ajuste_produto` (`prod_id`);

--
-- Índices de tabela `bd_categoria`
--
ALTER TABLE `bd_categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Índices de tabela `bd_estoque`
--
ALTER TABLE `bd_estoque`
  ADD PRIMARY KEY (`estoque_id`),
  ADD KEY `FK_estoque_produto` (`prod_id`);

--
-- Índices de tabela `bd_item_venda`
--
ALTER TABLE `bd_item_venda`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `FK_venda_id` (`venda_id`),
  ADD KEY `FK_prod_id` (`prod_id`);

--
-- Índices de tabela `bd_produtos`
--
ALTER TABLE `bd_produtos`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `FK_categoria_id` (`categoria_id`);

--
-- Índices de tabela `bd_venda`
--
ALTER TABLE `bd_venda`
  ADD PRIMARY KEY (`venda_id`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `bd_ajuste_estoque`
--
ALTER TABLE `bd_ajuste_estoque`
  ADD CONSTRAINT `FK_ajuste_produto` FOREIGN KEY (`prod_id`) REFERENCES `bd_produtos` (`prod_id`);

--
-- Restrições para tabelas `bd_estoque`
--
ALTER TABLE `bd_estoque`
  ADD CONSTRAINT `FK_estoque_produto` FOREIGN KEY (`prod_id`) REFERENCES `bd_produtos` (`prod_id`);

--
-- Restrições para tabelas `bd_item_venda`
--
ALTER TABLE `bd_item_venda`
  ADD CONSTRAINT `FK_prod_id` FOREIGN KEY (`prod_id`) REFERENCES `bd_produtos` (`prod_id`),
  ADD CONSTRAINT `FK_venda_id` FOREIGN KEY (`venda_id`) REFERENCES `bd_venda` (`venda_id`);

--
-- Restrições para tabelas `bd_produtos`
--
ALTER TABLE `bd_produtos`
  ADD CONSTRAINT `FK_categoria_id` FOREIGN KEY (`categoria_id`) REFERENCES `bd_categoria` (`categoria_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
