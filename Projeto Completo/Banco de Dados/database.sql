-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Fev-2022 às 14:48
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `database`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `senha` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admins`
--

INSERT INTO `admins` (`id`, `email`, `senha`) VALUES
(1, 'admin@fatec.sp.gov.br', 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(5, 'Camisas'),
(6, 'Tênis'),
(15, 'Camisetas'),
(22, 'Calças');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_carrinho`
--

CREATE TABLE `itens_carrinho` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `imagem` text NOT NULL,
  `titulo` text NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` float NOT NULL,
  `desconto` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `id_categoria`, `imagem`, `titulo`, `quantidade`, `valor`, `desconto`) VALUES
(122, 5, 'D_NQ_NP_926850-MLB41806502199_052020-W-_1_.png', 'Camisa Social Masculina Manga Longa Slim Fit Sem Bolso', 1492, 79, 13),
(123, 22, 'D_NQ_NP_857770-MLB40466921304_012020-W.png', 'Calça Jeans Lavado Escuro Bigodes Guess 40309', 42, 67.9, 19),
(124, 15, 'D_NQ_NP_798794-MLB43093026485_082020-W.png', 'Camiseta Fe Camisa Longline Masculina Oversized Estampada', 1710, 31.9, 0),
(125, 22, 'D_NQ_NP_750155-MLB31700989684_082019-W.png', 'Calça Brim Cinza Uniforme Profissional Pronta Entrega', 13716, 38.97, 0),
(126, 5, 'D_NQ_NP_790824-MLB41806509442_052020-W.png', 'Camisa Social Masculina Slim Fit Eventos Festas Casamentos', 1395, 78.69, 17),
(127, 15, 'D_NQ_NP_610835-MLB32650029533_102019-W.png', 'Kit 5 Pç Camisas Long Line Masculina Oversize Swag Promoçao', 14268, 128.9, 0),
(128, 15, 'D_NQ_NP_996884-MLB42224812823_062020-W.png', '10 Camisas Camisetas Masculinas Baratas Atacado Diversas', 2826, 181.9, 5),
(129, 15, 'D_NQ_NP_970330-MLB42793979039_072020-W.png', 'Camisa Gola Polo Em Malha Piquet Camiseta Barato', 2687, 39.99, 0),
(133, 6, 'cb853d7310639ad959ab369293d6dee9.jpeg', 'Tenis Nike', 10, 5000, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL,
  `cpf` text NOT NULL,
  `email` text NOT NULL,
  `senha` text NOT NULL,
  `sexo` text NOT NULL,
  `nascimento` text NOT NULL,
  `celular` text NOT NULL,
  `cep` text NOT NULL,
  `endereco` text NOT NULL,
  `cidade` text NOT NULL,
  `uf` text NOT NULL,
  `bairro` text NOT NULL,
  `numero` text NOT NULL,
  `complemento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `cpf`, `email`, `senha`, `sexo`, `nascimento`, `celular`, `cep`, `endereco`, `cidade`, `uf`, `bairro`, `numero`, `complemento`) VALUES
(12, 'Hulgo', '999.999.999-99', 'hulgo@fatec.com', '123456', 'Masculino', '99/99/9999', '(99)99999-9999', '99.999-999', 'A.V. Duque de Caxias', 'Bauru', 'SP', 'Centro', '999', ''),
(13, 'Hulgo Rafael', '123.243.451-08', 'hulgo.ferreir@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '14997664250', '17470000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(14, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(15, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(16, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(17, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(18, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(19, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(20, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(21, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(22, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(23, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(24, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(25, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(26, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(27, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(28, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(29, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'pwd123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(30, 'Hulgo Rafael Ferreira', '406.428.888-45', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '(14)99766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'Sp', 'Vila Duartina', '174', 'casa'),
(31, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(32, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(33, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(34, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(35, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(36, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(37, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(38, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(39, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(40, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(41, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(42, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(43, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(44, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(45, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(46, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(47, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(48, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(49, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(50, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(51, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(52, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(53, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(54, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(55, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(56, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(57, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(58, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(59, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(60, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(61, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(62, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(63, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa'),
(64, 'Hulgo Rafael Ferreira', '123.243.451-08', 'hulgo.ferreira@fatec.sp.gov.br', 'teste123', 'masculino', '30/03/1992', '1499766-4250', '17470-000', 'Rua José Valentim Fávaro', 'Duartina', 'SP', 'Vila', '174', 'casa');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `itens_carrinho`
--
ALTER TABLE `itens_carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `itens_carrinho`
--
ALTER TABLE `itens_carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `itens_carrinho`
--
ALTER TABLE `itens_carrinho`
  ADD CONSTRAINT `itens_carrinho_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `itens_carrinho_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
