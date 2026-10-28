-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/10/2026 às 21:35
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `bd_lumodas` 
  DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_lumodas`;   

--
-- Banco de dados: `bd_lumodas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` char(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf`, `email`, `senha`) VALUES
(1, 'Lua Tubi', '123.456.788', 'devtools@gmail.com', 'devtools'),
(2, 'Lumodas', '400.000.000', 'lumodas@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_venda`
--

CREATE TABLE `itens_venda` (
  `id` int(11) NOT NULL,
  `venda_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `quantidade_estoque` int(11) NOT NULL DEFAULT 0,
  `descricao` text DEFAULT NULL,
  `imagem_url` varchar(255) DEFAULT NULL,
  `categoria` varchar(30) NOT NULL DEFAULT 'blusas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `quantidade_estoque`, `descricao`, `imagem_url`, `categoria`) VALUES
(1, 'Blazer', 129.90, 10, 'Perfeito para ocasiões especiais.', 'imagens/produtos/blazer.jpeg', 'blusas'),
(2, 'Blusa Manga Longa', 89.90, 10, 'Conforto e estilo para o dia a dia.', 'imagens/produtos/blusa_manga_longa.jpeg', 'blusas'),
(3, 'Camisa Amarela', 59.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/camisa_amarela.jpeg', 'blusas'),
(4, 'Camisa Azul Amarela', 79.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/camisa_azul_amarela.jpeg', 'blusas'),
(5, 'Camisa Azul Listrada', 67.90, 10, 'Ótimo para festas.', 'imagens/produtos/camisa_azul_listrada.jpeg', 'blusas'),
(6, 'Camisa de Couro', 86.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/camisa_de_couro.jpeg', 'blusas'),
(7, 'Camisa Oversized Rosa', 42.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/camisa_oversized_rosa.jpeg', 'blusas'),
(8, 'Camisa Oversized', 88.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/camisa_oversized.jpeg', 'blusas'),
(9, 'Camisa Preta', 60.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/camisa_preta.jpeg', 'blusas'),
(10, 'Camisa Social Branca', 99.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/camisa_social_branca.jpeg', 'blusas'),
(11, 'Camisa Social', 134.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/camisa_social.jpeg', 'blusas'),
(12, 'Camiseta Manga Longa', 96.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/camiseta_manga_longa.jpeg', 'blusas'),
(13, 'Cardigan', 34.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/cardigan.jpeg', 'blusas'),
(14, 'Casaco Cinza', 80.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/casaco_cinza.jpeg', 'blusas'),
(15, 'Casaco Jeans', 79.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/casaco_jeans.jpeg', 'blusas'),
(16, 'Casaco Marrom Lindo', 89.90, 10, 'Um casaco marrom muito lindo!', 'imagens/produtos/casaco_marrom.jpeg', 'blusas'),
(27, 'Conjunto Preto', 67.00, 5, 'Breve descrição do produto da loja.', 'imagens/produtos/b5b442f08c54ae53.jpg', 'conjuntos'),
(28, 'Conjunto Casual', 55.00, 7, 'Breve descrição do produto da loja.', 'imagens/produtos/c4a82828ba46e915.jpg', 'conjuntos'),
(29, 'Conjunto Fofo', 34.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/018b7326eddd32a7.jpg', 'conjuntos'),
(30, 'Conjunto Verde', 76.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/54502d45ec9fc2d2.jpg', 'conjuntos'),
(31, 'Conjunto Azul', 122.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/c13a48618d00855e.jpg', 'conjuntos'),
(32, 'Conjunto Elegante', 290.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/457b1536aaa45b2e.jpg', 'conjuntos'),
(33, 'Conjunto Marrom', 87.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/396f4fcc564c7967.jpg', 'conjuntos'),
(34, 'Conjunto Vermelho', 49.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/0c803a92e1716d6e.jpg', 'conjuntos'),
(35, 'Conjunto Social', 45.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/520ce3bc1f8b707a.jpg', 'conjuntos'),
(36, 'Conjunto Casual', 67.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/d129767c5db9f576.jpg', 'conjuntos'),
(37, 'Conjunto Marrom Casual', 35.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/50c3672f4043448e.jpg', 'conjuntos'),
(38, 'Conjunto Jeans', 88.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/4f31a17f56202192.jpg', 'conjuntos'),
(39, 'Conjunto Bege', 100.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/2b35536b96c406df.jpg', 'conjuntos'),
(40, 'Conjunto Rosa', 43.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/3a2c083c1cc01055.jpg', 'conjuntos'),
(41, 'Conjunto Vermelho Cunt', 129.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/483aff14c7ea5ddb.jpg', 'conjuntos'),
(43, 'Brinco Estrela', 45.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/af4ff6b50e6ec188.jpg', 'acessorios'),
(44, 'Brinco Duplo', 34.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/67613f6e74bdf83f.jpg', 'acessorios'),
(45, 'Brinco Longo', 88.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/a378827050c81858.jpg', 'acessorios'),
(46, 'Brinco Borboleta', 34.00, 0, 'Breve descrição do produto da loja.', 'imagens/produtos/de14dd9a8ad8258a.jpg', 'acessorios'),
(47, 'Colar Cute', 21.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/736c6b813d75a325.jpg', 'acessorios'),
(48, 'Anel', 29.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/156ad501a28bdf22.jpg', 'acessorios'),
(49, 'Colar Simples', 55.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/f55be1aaedecc87c.jpg', 'acessorios'),
(50, 'Anel de Prata', 99.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/cc091bbd720fbead.jpg', 'acessorios'),
(51, 'Anel Duplo', 19.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/8744a270a6f36039.jpg', 'acessorios'),
(52, 'Anel Casual', 31.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/d3e31686947e4bdb.jpg', 'acessorios'),
(53, 'Pulseira', 21.99, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/afc9fffdb1820596.jpg', 'acessorios'),
(54, 'Pulseira Dupla', 67.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/834c256a9aa0ad83.jpg', 'acessorios'),
(55, 'Pulseira de Estrela', 78.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/b1deeeef80c44d0d.jpg', 'acessorios'),
(56, 'Pulseira de Prata', 55.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/d7829b3104963b36.jpg', 'acessorios'),
(57, 'Brinco de Estrelas', 45.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/eba186311b9ec277.jpg', 'acessorios'),
(58, 'Colar de Estrelas', 67.00, 0, 'Breve descrição do produto da loja.', 'imagens/produtos/21e6f52247b934da.jpg', 'acessorios'),
(59, 'Vestido Xadrez Marrom', 139.99, 0, 'Breve descrição do produto da loja.', 'imagens/produtos/318ee88a4e204578.jpg', 'vestidos'),
(60, 'Vestido Branco Pontilhado', 67.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/cf7caf059b1cc964.jpg', 'vestidos'),
(61, 'Vestido Preto', 77.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/d4fc9a0ea7bc8768.jpg', 'vestidos'),
(62, 'Vestido Casual Marrom', 67.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/05e2a102289a75ce.jpg', 'vestidos'),
(63, 'Vestido Verde Simples', 88.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/9e41e177160f235b.jpg', 'vestidos'),
(64, 'Tomara que Caia Preto', 55.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/e29f2d7af17412ff.jpg', 'vestidos'),
(65, 'Vestido Branco Cute', 139.99, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/027eedb8fab81c8c.jpg', 'vestidos'),
(66, 'Vestido Azul Fofo', 45.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/f8eaeb911822580f.jpg', 'vestidos'),
(67, 'Vestido Preto com Flores', 88.00, 0, 'Breve descrição do produto da loja.', 'imagens/produtos/17e359685b827205.jpg', 'vestidos'),
(68, 'Vestido Branco', 57.99, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/00eb6885a0ead539.jpg', 'vestidos'),
(69, 'Vestido Branco Coquette', 120.99, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/79684d0115be99de.jpg', 'vestidos'),
(70, 'Vestido Azul', 140.99, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/d6f80f1c7925067e.jpg', 'vestidos'),
(71, 'Vestido Preto Casual', 150.00, 0, 'Breve descrição do produto da loja.', 'imagens/produtos/c79aab30b946cf16.jpg', 'vestidos'),
(72, 'Vestido Bege', 67.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/5a42cd9e34372b68.jpg', 'vestidos'),
(73, 'Tomara que Caia branco', 110.99, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/eaf77951ec2aeab2.jpg', 'vestidos'),
(74, 'Vestido Preto Cunt', 200.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/c7305d5c6e07c8b4.jpg', 'vestidos'),
(75, 'Conjunto Rosa Cute', 87.99, 0, '', 'imagens/produtos/da2de36bc35f06fd.jpg', 'conjuntos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `data_venda` timestamp NOT NULL DEFAULT current_timestamp(),
  `forma_pagamento` varchar(50) NOT NULL,
  `pago` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venda_id` (`venda_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD CONSTRAINT `itens_venda_ibfk_1` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `itens_venda_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
