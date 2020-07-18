-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 26-Nov-2019 às 13:33
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto_elegance`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atendimento`
--

DROP TABLE IF EXISTS `atendimento`;
CREATE TABLE IF NOT EXISTS `atendimento` (
  `idAtendimento` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` int(11) NOT NULL,
  `horario` int(11) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`idAtendimento`),
  KEY `cliente` (`cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `atendimento`
--

INSERT INTO `atendimento` (`idAtendimento`, `cliente`, `horario`, `data`) VALUES
(56, 2, 1, '2019-12-03'),
(55, 13, 2, '2019-11-30'),
(57, 2, 14, '2019-11-30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carousel`
--

DROP TABLE IF EXISTS `carousel`;
CREATE TABLE IF NOT EXISTS `carousel` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `imagem` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `carousel`
--

INSERT INTO `carousel` (`id`, `nome`, `titulo`, `imagem`) VALUES
(1, 'banner1', 'Barbearia', 'barbeiro.jpg'),
(2, 'banner2', 'Salão', 'cabelereiro.jpg'),
(3, 'banner3', 'Manicure & Pedicure', 'manicure.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCliente` varchar(50) NOT NULL,
  `emailCliente` varchar(35) NOT NULL,
  `senhaCliente` char(32) NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nomeCliente`, `emailCliente`, `senhaCliente`) VALUES
(2, 'maxwell', 'maxwell@maxwell.com', '202cb962ac59075b964b07152d234b70'),
(13, 'Bill Gates de Oliveira', 'billgates@microsoft.com', 'e10adc3949ba59abbe56e057f20f883e'),
(15, 'Vinicius Rosa Rafael de Oliveira', 'vinirosa@rosa.com', 'e10adc3949ba59abbe56e057f20f883e'),
(16, 'Iago Sales Orlandi', 'Iaguete@Orlandi.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(17, 'Vitão de toledinho', 'vitormillerdetoledo@gmail.com', '997d13b90da22b35ce43bebdd332ad11'),
(19, 'teste2', 'teste2@teste.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `idFunc` int(11) NOT NULL AUTO_INCREMENT,
  `nomeFunc` varchar(50) NOT NULL,
  `cpfFunc` char(11) NOT NULL,
  `descFunc` varchar(255) NOT NULL,
  `servicoFunc` int(11) NOT NULL,
  `fotoFunc` varchar(60) NOT NULL,
  PRIMARY KEY (`idFunc`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`idFunc`, `nomeFunc`, `cpfFunc`, `descFunc`, `servicoFunc`, `fotoFunc`) VALUES
(1, 'José Maria', '12345678910', 'Trabalha a 4 anos no estabelecimento.', 2, 'josemaria.jpg'),
(2, 'Maria José', '32165478998', 'Maria trabalha conosco a 8 anos.', 1, 'mariajose.jpg'),
(9, 'Iago Sales', '45665478985', 'Grande funcionário', 3, 'padrao.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE IF NOT EXISTS `horario` (
  `idHorario` int(11) NOT NULL AUTO_INCREMENT,
  `horario` varchar(30) NOT NULL,
  `horarioReal` time NOT NULL,
  `duracao` time NOT NULL,
  `funcHorario` int(11) NOT NULL,
  PRIMARY KEY (`idHorario`),
  KEY `aloc` (`funcHorario`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `horario`
--

INSERT INTO `horario` (`idHorario`, `horario`, `horarioReal`, `duracao`, `funcHorario`) VALUES
(1, '09:00 - 10:00', '09:00:00', '01:00:00', 1),
(2, '10:00 - 11:00', '10:00:00', '01:00:00', 1),
(3, '11:00 - 12:00', '11:00:00', '01:00:00', 1),
(4, '12:00 - 13:00', '12:00:00', '01:00:00', 1),
(5, '13:00 - 14:00', '13:00:00', '01:00:00', 1),
(6, '14:00 - 15:00', '14:00:00', '01:00:00', 1),
(7, '15:00 - 16:00', '15:00:00', '01:00:00', 1),
(8, '09:00 - 10:00', '09:00:00', '01:00:00', 2),
(9, '10:00 - 11:00', '10:00:00', '01:00:00', 2),
(10, '11:00 - 12:00', '11:00:00', '01:00:00', 2),
(11, '12:00 - 13:00', '12:00:00', '01:00:00', 2),
(12, '13:00 - 14:00', '13:00:00', '01:00:00', 2),
(13, '14:00 - 15:00', '14:00:00', '01:00:00', 2),
(14, '15:00 - 16:00', '15:00:00', '01:00:00', 2),
(36, '18:00 - 19:00', '18:00:00', '01:00:00', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagenshome`
--

DROP TABLE IF EXISTS `imagenshome`;
CREATE TABLE IF NOT EXISTS `imagenshome` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `imagem` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `imagenshome`
--

INSERT INTO `imagenshome` (`id`, `nome`, `imagem`) VALUES
(1, 'Imagem1', 'salao1.jpg'),
(2, 'Imagem2', 'salao2.jpg'),
(3, 'Imagem3', 'salao3.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logos`
--

DROP TABLE IF EXISTS `logos`;
CREATE TABLE IF NOT EXISTS `logos` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `imagem` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `logos`
--

INSERT INTO `logos` (`id`, `nome`, `imagem`) VALUES
(1, 'logo', 'logoteste.png'),
(2, 'icone', 'favicon.ico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacao`
--

DROP TABLE IF EXISTS `notificacao`;
CREATE TABLE IF NOT EXISTS `notificacao` (
  `idnot` int(11) NOT NULL AUTO_INCREMENT,
  `solicitante` int(11) NOT NULL,
  `solicitado` int(11) NOT NULL,
  `agendamento` int(11) NOT NULL,
  `notificacao` varchar(255) NOT NULL,
  `statusNot` int(11) NOT NULL,
  PRIMARY KEY (`idnot`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `notificacao`
--

INSERT INTO `notificacao` (`idnot`, `solicitante`, `solicitado`, `agendamento`, `notificacao`, `statusNot`) VALUES
(13, 2, 13, 50, 'Deseja Trocar horario do serviço', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagina`
--

DROP TABLE IF EXISTS `pagina`;
CREATE TABLE IF NOT EXISTS `pagina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(50) NOT NULL,
  `metodo` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `obs` varchar(150) DEFAULT NULL,
  `keywords` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `author` varchar(100) NOT NULL,
  `icone` varchar(100) DEFAULT NULL,
  `tp_pagina_id` int(11) NOT NULL,
  `robots_id` int(11) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pagina`
--

INSERT INTO `pagina` (`id`, `controller`, `metodo`, `nome`, `titulo`, `obs`, `keywords`, `description`, `author`, `icone`, `tp_pagina_id`, `robots_id`, `data_criacao`, `data_modificacao`) VALUES
(1, 'Home', 'index', 'Página principal', 'DW - Página inicial', 'Página principal', 'dw, programação, php', 'Site para exibir a página inicial do projeto', 'DW', 'home.jpg', 1, 1, '2019-05-24 00:00:00', NULL),
(2, 'Cadastro', 'index', 'Página de cadastro de usuário', 'Cadastro', 'página de cadastro de usuário', 'dw, programação, php', 'Site para exibir a página cadastro do projeto', 'DW', 'quemsomos.jpg', 1, 1, '2019-05-24 00:00:00', NULL),
(3, 'Funcionarios', 'index', 'Página de notícias', 'DW - Notícias', 'Página de notícias', 'dw, programação, php', 'Site para exibir a página de notícias do projeto', 'DW', 'noticias.jpg', 1, 1, '2019-05-24 00:00:00', NULL),
(4, 'Login', 'index', 'Página de visualização da notícia', 'DW - Notícias', 'Página de notícias', 'dw, programação, php', 'Site para exibir a página de notícias do projeto', 'DW', 'noticias.jpg', 1, 1, '2019-05-24 00:00:00', NULL),
(5, 'Login', 'logout', 'Página de contato', 'DW - Contato', 'Página de contato', 'dw, programação, php', 'Site para exibir a página de contato do projeto', 'DW', 'contato.jpg', 1, 1, '2019-05-24 00:00:00', NULL),
(6, 'Error404', 'index', 'Página de Erro', 'DW - Erro 404', 'Página de erro', 'dw, programação, php', 'Site para exibir a página de erro do projeto', 'DW', 'erro.jpg', 1, 1, '2019-05-24 00:00:00', NULL),
(7, 'AdmHome', 'index', 'Página principal da área administrativa', 'DW - Página inicial ADM', 'Página principal ADM', 'dw, programação, php', 'Site para exibir a página inicial do projeto ADM', 'DW', 'home.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(8, 'AdmUser', 'index', 'Página de usuários da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(9, 'AdmAuth', 'auth', 'Página de login da área administrativa', 'DW - Página login ADM', 'Página login ADM', 'dw, programação, php', 'Site para exibir a página de login do projeto ADM', 'DW', '', 2, 1, '2019-05-24 00:00:00', NULL),
(10, 'AdmNoticia', 'listar', 'Página ADM de notícia', 'DW - Página ADM Notícia', 'Página ADM', 'dw, programação, php', 'Site para exibir a página do projeto ADM', 'DW', '', 2, 1, '2019-05-24 00:00:00', NULL),
(11, 'AdmUser', 'addUser', 'Página de usuários da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(12, 'AdmUser', 'moreUser', 'Página de usuários da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(13, 'AdmUser', 'upUser', 'Página de usuários da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(14, 'AdmUser', 'delUser', 'Página de usuários da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(15, 'AdmUser', 'upUser', 'Página de usuários da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para alterar a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(16, 'AdmUser', 'upUserPass', 'Página de usuários da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para alterar a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(17, 'AdmAuth', 'logout', 'Página de login da área administrativa', 'DW - Página login ADM', 'Página login ADM', 'dw, programação, php', 'Site para exibir a página de login do projeto ADM', 'DW', '', 2, 1, '2019-05-24 00:00:00', NULL),
(18, 'Perfil', 'index', 'Página de Erro', 'DW - Erro 404', 'Página de erro', 'dw, programação, php', 'Site para exibir a página de erro do projeto', 'DW', 'erro.jpg', 1, 1, '2019-05-24 00:00:00', NULL),
(19, 'Perfil', 'alterarDados', 'Página de Erro', 'DW - Erro 404', 'Página de erro', 'dw, programação, php', 'Site para exibir a página de erro do projeto', 'DW', 'erro.jpg', 1, 1, '2019-05-24 00:00:00', NULL),
(20, 'Servicos', 'index', 'Página de Erro', 'DW - Erro 404', 'Página de erro', 'dw, programação, php', 'Site para exibir a página de erro do projeto', 'DW', 'erro.jpg', 1, 1, '2019-05-24 00:00:00', NULL),
(21, 'Servicos', 'agendarServico', 'Página de Erro', 'DW - Erro 404', 'Página de erro', 'dw, programação, php', 'Site para exibir a página de erro do projeto', 'DW', 'erro.jpg', 1, 1, '2019-05-24 00:00:00', NULL),
(22, 'Servicos', 'agendarTrocarServico', 'Página de Erro', 'DW - Erro 404', 'Página de erro', 'dw, programação, php', 'Site para exibir a página de erro do projeto', 'DW', 'erro.jpg', 1, 1, '2019-05-24 00:00:00', NULL),
(23, 'AdmUserAdm', 'index', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(24, 'AdmUserAdm', 'upAdm', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(25, 'AdmUserAdm', 'addAdm', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(26, 'AdmUserAdm', 'delAdm', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(27, 'AdmUserAdm', 'delAdm', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(28, 'AdmServico', 'index', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(29, 'AdmServico', 'addServico', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(30, 'AdmServico', 'delServico', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(31, 'AdmServico', 'upServico', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(32, 'AdmFunc', 'index', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(33, 'AdmFunc', 'upFunc', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(34, 'AdmFunc', 'delFunc', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(35, 'AdmFunc', 'addFunc', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(36, 'AdmFunc', 'horariosFunc', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL),
(37, 'AdmFunc', 'addHorarioFunc', 'Página de usuários adm da área administrativa', 'DW - Página user ADM', 'Página user ADM', 'dw, programação, php', 'Site para exibir a página user do projeto ADM', 'DW', 'user.jpg', 2, 1, '2019-05-24 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntas_frequentes`
--

DROP TABLE IF EXISTS `perguntas_frequentes`;
CREATE TABLE IF NOT EXISTS `perguntas_frequentes` (
  `id` int(11) NOT NULL,
  `pergunta` varchar(120) NOT NULL,
  `resposta` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perguntas_frequentes`
--

INSERT INTO `perguntas_frequentes` (`id`, `pergunta`, `resposta`) VALUES
(1, 'Onde Fica o Estabelecimento?', 'O Centro Estético Elegance fica localizado no endereço: Rua Cel. Borges, 105 - Cel. Borges, Cachoeiro de Itapemirim - ES'),
(2, 'Quais os dias e horário de funcionamento do estabelecimento?', 'O estabelecimento funciona de terça a sábado das 9:00 às 18:00.'),
(3, 'Telefone de contato', '(28) 99907-3668');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

DROP TABLE IF EXISTS `servico`;
CREATE TABLE IF NOT EXISTS `servico` (
  `idServico` int(11) NOT NULL AUTO_INCREMENT,
  `descServico` varchar(35) NOT NULL,
  `valorServico` float NOT NULL,
  `imagemServico` varchar(30) NOT NULL,
  PRIMARY KEY (`idServico`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`idServico`, `descServico`, `valorServico`, `imagemServico`) VALUES
(1, 'Manicure', 20, 'manicure.png'),
(2, 'Barbearia', 15, 'barbeiro.png'),
(3, 'Pedicure', 15, 'pedicure.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_pagina`
--

DROP TABLE IF EXISTS `tipo_pagina`;
CREATE TABLE IF NOT EXISTS `tipo_pagina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `obs` varchar(150) NOT NULL,
  `ordem` int(11) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_pagina`
--

INSERT INTO `tipo_pagina` (`id`, `tipo`, `nome`, `obs`, `ordem`, `data_criacao`, `data_modificacao`) VALUES
(1, 'site', 'Site principal', 'Site principal do projeto', 1, '2019-05-17 00:00:00', NULL),
(2, 'adm', 'Área administrativa', 'Área administrativa do projeto', 2, '2019-05-17 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `useradm`
--

DROP TABLE IF EXISTS `useradm`;
CREATE TABLE IF NOT EXISTS `useradm` (
  `idAdm` int(11) NOT NULL AUTO_INCREMENT,
  `loginAdm` varchar(20) NOT NULL,
  `senhaAdm` char(32) NOT NULL,
  `nomeAdm` varchar(60) NOT NULL,
  PRIMARY KEY (`idAdm`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `useradm`
--

INSERT INTO `useradm` (`idAdm`, `loginAdm`, `senhaAdm`, `nomeAdm`) VALUES
(1, 'maxwellF', 'e10adc3949ba59abbe56e057f20f883e', 'Maxwell Ferreira'),
(3, 'ewertonb', 'e10adc3949ba59abbe56e057f20f883e', 'Ewerton Batista');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
