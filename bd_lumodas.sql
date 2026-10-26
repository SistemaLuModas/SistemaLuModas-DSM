-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/10/2026 às 19:27
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
(27, 'Conjunto Preto', 67.00, 5, 'Breve descrição do produto da loja.', 'imagens/produtos/0d2947167a0c07e9.jpg', 'conjuntos'),
(28, 'Conjunto Casual', 55.00, 7, 'Breve descrição do produto da loja.', 'imagens/produtos/91a8c3d321475176.jpg', 'conjuntos'),
(29, 'Conjunto Fofo', 34.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/197afc20d74013e7.jpg', 'conjuntos'),
(30, 'Conjunto Verde', 76.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/d43b7041c557ec58.jpg', 'conjuntos'),
(31, 'Conjunto Azul', 122.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/f35cc460a8c7d8bc.jpg', 'conjuntos'),
(32, 'Conjunto Elegante', 290.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/da4062eedcc40c08.jpg', 'conjuntos'),
(33, 'Conjunto Marrom', 87.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/e0a9eee1fce4b12d.jpg', 'conjuntos'),
(34, 'Conjunto Vermelho', 49.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/7ad7e5b05002516c.jpg', 'conjuntos'),
(35, 'Conjunto Social', 45.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/0a0a63c9a9bc97d9.jpg', 'conjuntos'),
(36, 'Conjunto Casual', 67.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/2f8667045e52db8c.jpg', 'conjuntos'),
(37, 'Conjunto Marrom Casual', 35.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/4131fef20dec161a.jpg', 'conjuntos'),
(38, 'Conjunto Jens', 88.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/c5d5c597452ffc69.jpg', 'conjuntos'),
(39, 'Conjunto Bege', 100.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/853786b8939f492d.jpg', 'conjuntos'),
(40, 'Conjunto Rosa', 43.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/570753ea0eeb2f11.jpg', 'conjuntos'),
(41, 'Conjunto Vermelho Cutting', 129.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/0237dc46714c09f8.jpg', 'conjuntos'),
(42, 'Conjunto Rosa Cute', 67.00, 0, 'Breve descrição do produto da loja.', 'imagens/produtos/b4440cb4d1e5eb0a.jpg', 'conjuntos'),
(43, 'Brinco Estrela', 45.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/cec84b1bda17b5c2.jpg', 'acessorios'),
(44, 'Brinco Duplo', 34.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/6237bb99bf7b5264.jpg', 'acessorios'),
(45, 'Brinco Longo', 88.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/29b262e575c5ce08.jpg', 'acessorios'),
(46, 'Brinco Borboleta', 34.00, 0, 'Breve descrição do produto da loja.', 'imagens/produtos/aa2c66f8e2606390.jpg', 'acessorios'),
(47, 'Colar Cute', 21.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/cc869042d6e1ee7d.jpg', 'acessorios'),
(48, 'Anel', 29.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/05098805bd8b008a.jpg', 'acessorios'),
(49, 'Colar Simples', 55.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/3149b5babbc3b504.jpg', 'acessorios'),
(50, 'Anel de Prata', 99.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/17db9dce4ac5c0df.jpg', 'acessorios'),
(51, 'Anel Duplo', 19.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/ce189a985826e496.jpg', 'acessorios'),
(52, 'Anel Casual', 31.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/2bcb74fb863e6f72.jpg', 'acessorios'),
(53, 'Pulseira', 21.99, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/5442b216c477d50c.jpg', 'acessorios'),
(54, 'Pulseira Dupla', 67.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/39fcbab6d8a23b3b.jpg', 'acessorios'),
(55, 'Pulseira de Estrela', 78.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/cccfc0c2d2cb9357.jpg', 'acessorios'),
(56, 'Pulseira de Prata', 55.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/655f7774a24c9892.jpg', 'acessorios'),
(57, 'Brinco de Estrelas', 45.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/81adf90fb74d3911.jpg', 'acessorios'),
(58, 'Colar de Estrelas', 67.00, 0, 'Breve descrição do produto da loja.', 'imagens/produtos/0df171fb17e435f3.jpg', 'acessorios'),
(59, 'Vestido Xadrez Marrom', 139.99, 0, 'Breve descrição do produto da loja.', 'imagens/produtos/b32f7e3d993546ad.jpg', 'vestidos'),
(60, 'Vestido Branco Pontilhado', 67.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/f44d8d446f8fae8e.jpg', 'vestidos'),
(61, 'Vestido Preto', 77.90, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/97d27876408eb70b.jpg', 'vestidos'),
(62, 'Vestido Casual Marrom', 67.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/45c81e13f7f650bd.jpg', 'vestidos'),
(63, 'Vestido Verde Simples', 88.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/109cdaf85d83f2e6.jpg', 'vestidos'),
(64, 'Tomara que Caia Preto', 55.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/52a793c977ba084f.jpg', 'vestidos'),
(65, 'Vestido Branco Cute', 139.99, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/5c512dcea4c3f469.jpg', 'vestidos'),
(66, 'Vestido Azul Fofo', 45.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/0accc05639833de6.jpg', 'vestidos'),
(67, 'Vestido Preto com Flores', 88.00, 0, 'Breve descrição do produto da loja.', 'imagens/produtos/5da1f7971fc37a9d.jpg', 'vestidos'),
(68, 'Vestido Branco', 57.99, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/de4f980ae19bcd2b.jpg', 'vestidos'),
(69, 'Vestido Branco Coquette', 120.99, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/308b4ba73adebb1b.jpg', 'vestidos'),
(70, 'Vestido Azul', 140.99, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/88242119ffc2cb6b.jpg', 'vestidos'),
(71, 'Vestido Preto Casual', 150.00, 0, 'Breve descrição do produto da loja.', 'imagens/produtos/563812aa981ac220.jpg', 'vestidos'),
(72, 'Vestido Bage', 67.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/08d03224936a289d.jpg', 'vestidos'),
(73, 'Tomara que Caia branco', 110.99, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/03e251148d7b3c39.jpg', 'vestidos'),
(74, 'Vestido Preto Cutting', 200.00, 10, 'Breve descrição do produto da loja.', 'imagens/produtos/a95258e79cdb6090.jpg', 'vestidos');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

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
