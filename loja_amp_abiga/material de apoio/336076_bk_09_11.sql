-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/11/2022 às 19:30
-- Versão do servidor: 10.4.22-MariaDB
-- Versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `336076`
--
CREATE DATABASE IF NOT EXISTS `336076` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `336076`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `amplificadores`
--

CREATE TABLE `amplificadores` (
  `COD_AMP` int(11) NOT NULL,
  `TIPO_AMP` varchar(45) NOT NULL,
  `MARCA_AMP` varchar(45) NOT NULL,
  `MODELO_AMP` varchar(45) NOT NULL,
  `PRECO_AMP` decimal(5,3) NOT NULL,
  `FOTO_AMP` varchar(60) NOT NULL,
  `FILA_COMPRA_AMP` char(1) NOT NULL DEFAULT 'N',
  `VENDAS_COD_VEN` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `amplificadores`
--

INSERT INTO `amplificadores` (`COD_AMP`, `TIPO_AMP`, `MARCA_AMP`, `MODELO_AMP`, `PRECO_AMP`, `FOTO_AMP`, `FILA_COMPRA_AMP`, `VENDAS_COD_VEN`) VALUES
(1, 'baixo', 'Staner', 'bx200a', '2.500', 'img/baixo_staner_bx200a.jpg', 'S', NULL),
(2, 'baixo', 'Ampeg', 'Ba 108', '3.000', 'img/baixo_ampeg_ba108.jpg', 'N', NULL),
(3, 'guitarra', 'Vox', 'Ac15 Valvulado', '2.000', 'img/guitarra_vox_ac15_valvulado.jpg', 'N', NULL),
(4, 'violao', 'Borne', 'Infinit', '1.000', 'img/violao_borne_infinit.jpg', 'S', NULL),
(5, 'guitarra', 'Blackstar', 'Ht5r Valvulado', '6.000', 'img/guitarra_blackstar_ht5r_valvulado.jpg', 'N', NULL),
(9, 'guitarra', 'Boss', 'katana 100 Transistorizado', '4.000', 'img/guitarra_boss_katana100_transist.jpg', 'N', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `COD_FUN` int(11) NOT NULL,
  `NOME_FUN` varchar(45) NOT NULL,
  `LOGIN_FUN` varchar(45) NOT NULL,
  `SENHA_FUN` varchar(45) NOT NULL,
  `STATUS_FUN` char(1) NOT NULL DEFAULT 'A',
  `FUNCAO_FUN` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`COD_FUN`, `NOME_FUN`, `LOGIN_FUN`, `SENHA_FUN`, `STATUS_FUN`, `FUNCAO_FUN`) VALUES
(1, 'Administrador do Sistema', 'admin', 'etb123', 'A', 'administrador'),
(2, 'João da Silva ', 'jao', '123', 'a', 'estoquista'),
(3, 'Joana Vendedora de Fonseca', 'jo', '1', 'A', 'vendedor'),
(4, 'Ana da Silva', 'anas', '123', 'A', 'estoquista'),
(5, 'André dos Santos', 'and', '1706', 'A', 'vendedor'),
(6, 'Pedro Alves', 'pedrim', '456', 'A', 'estoquista');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `COD_VEN` int(11) NOT NULL,
  `DATA_VEN` date NOT NULL,
  `FUNCIONARIOS_COD_FUN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `amplificadores`
--
ALTER TABLE `amplificadores`
  ADD PRIMARY KEY (`COD_AMP`),
  ADD KEY `fk_IMPRESSORAS_VENDAS1_idx` (`VENDAS_COD_VEN`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`COD_FUN`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`COD_VEN`),
  ADD KEY `fk_VENDAS_FUNCIONARIOS_idx` (`FUNCIONARIOS_COD_FUN`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `amplificadores`
--
ALTER TABLE `amplificadores`
  MODIFY `COD_AMP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `COD_FUN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `COD_VEN` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `amplificadores`
--
ALTER TABLE `amplificadores`
  ADD CONSTRAINT `fk_IMPRESSORAS_VENDAS1` FOREIGN KEY (`VENDAS_COD_VEN`) REFERENCES `vendas` (`COD_VEN`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `fk_VENDAS_FUNCIONARIOS` FOREIGN KEY (`FUNCIONARIOS_COD_FUN`) REFERENCES `funcionarios` (`COD_FUN`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
