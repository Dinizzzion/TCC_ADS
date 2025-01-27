-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/01/2025 às 20:44
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
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `assistentes`
--

CREATE TABLE `assistentes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `cress` int(11) NOT NULL,
  `local` varchar(50) NOT NULL,
  `atendimentos` int(11) NOT NULL,
  `funcao` varchar(40) NOT NULL,
  `matricula` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `assistentes`
--

INSERT INTO `assistentes` (`id`, `nome`, `email`, `senha`, `cpf`, `foto`, `cress`, `local`, `atendimentos`, `funcao`, `matricula`) VALUES
(1, 'Simone Rosado', 'simonerosado@gmail.com', '$2y$10$5V3z9FJi7F50zLvZQNDqie/.AKHanffd9LbT9pW2iQ70w66oFwoda', '2147483647', 'assets/img/kaiadmin/677d0e42b5a3c_6707f87d5120a_fcdecafc-9484-4b19-a94a-2e57616d8835.jfif', 6488, 'Secretaria', 33, 'Diretora de Proteção Social', '7238'),
(11, 'Larissa Costa', 'larissa@gmail.com', '$2y$10$L/DOg/YB0T/pKI.LfbdlB.lfja.1OhaK26ESeRvjXVWj0rFk9aU8O', '1715576039', 'assets/img/kaiadmin/67111f0059459_torta de limao.jpg', 2174, 'CRAS Extremo Leste', 8, 'Assistente social', '639874'),
(17, 'Carla Cristiane', 'carlacre@gmail.com', '$2y$10$02tH7oIy2OrWZmCr3KoAn.azpVnp7apU7pKXQOkfYnaWcckkGG6v6', '12314312', 'assets/img/kaiadmin/67167ad7759e0_example1.jpeg', 4312, 'CRAS Extremo Leste', 0, 'Assistente social', '125672'),
(18, 'Alaides', 'alai@gmail.com', '$2y$10$rcUckw4TvlkCxqSJShBorOFm3N/46oahRNYYkemiV74zXkfns5XrW', '95467857021', 'assets/img/kaiadmin/67167b4ed1f98_example7-300x300.jpg', 45673, 'CRAS Leste', 1, 'Assistente social', '2389'),
(28, 'Emerson Diniz', 'emerson.2022008297@aluno.iffar.edu.brr', '$2y$10$KFITz9dA7EQ9hTIO2yoKW.DtAXQ6k14maxBPgSJWk6Uz3YTsxzCPy', '03922155006', 'assets/img/kaiadmin/67167ffd4b63d_WhatsApp Image 2024-10-21 at 13.23.08.jpeg', 6721, 'CRAS Norte', 3, 'Coordenador', '00128724/1'),
(29, 'Eduarda Antolini', 'eduarda.afavero@gmail.com', '$2y$10$7//HNpZ3kUj.1iXcY8U8fee/jbDktWR5adZCNtuGwtmIfwxOaJBAe', '05415397019', 'assets/img/kaiadmin/6716862a9c5fd_WhatsApp Image 2024-10-21 at 13.48.39.jpeg', 2678, 'CRAS Sul', 2, 'Assistente social', '00136543/1'),
(30, 'Camila Rodrigues', 'camilacrodrigues@gmail.com', '$2y$10$HVCco5JWxlV.p0BButw.zOQXLavA/0TRMELEsc1cwHz8qbSQCcRPy', '11122233344', 'assets/img/kaiadmin/677d17360cd2c_Paisagem-1.jpg', 6318, 'CRAS Leste', 0, 'Assistente social', '123289'),
(31, 'Vitoria Dias', 'vicsoaresdias@gmail.com', '$2y$10$p/MX8sIdFQ6JsIOTyAwNxu9V82sj6ocj6vL8tbHuzCZCWqLl00poC', '12345678901', 'assets/img/kaiadmin/default.png', 987, 'CRAS Norte', 0, 'Assistente social', '983412');

-- --------------------------------------------------------

--
-- Estrutura para tabela `atendimentos`
--

CREATE TABLE `atendimentos` (
  `protocolo` int(11) NOT NULL,
  `assunto` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `id_assistente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `atendimentos`
--

INSERT INTO `atendimentos` (`protocolo`, `assunto`, `data`, `descricao`, `id_assistente`, `id_usuario`) VALUES
(17, 'Atendimento de Usuário', '2024-10-07', 'Usuario relatou estar passando dificuldades financeiras e que nao tem condicoes de comprar alimento para seus filhos, o mesmo solicitou uma cesta basi', 1, 1),
(18, 'Atendimento da Larissa', '2024-10-10', 'O usu&aacute;rio relatou que esta necessitando de CESTA BASICA, alegando que esta sem recurso financeiro e necessita de uma CESTA BASICA urgente pois ', 11, 4),
(19, 'Atendimento de Usuário', '2024-10-15', 'AAAAA', 1, 4),
(20, 'Atendimento de Usuário', '2024-10-15', 'asasdad', 1, 27),
(21, 'Atendimento de Usuário', '2024-10-15', 'saaad', 1, 4),
(22, 'Atendimento de Usuário', '2024-10-08', 'aaa', 1, 4),
(23, 'Atendimento de Usuário', '2024-10-08', 'adsdsad', 1, 1),
(24, 'Atendimento de Usuário', '2024-10-15', 'aaaa', 1, 1),
(25, 'Atendimento de Usuário', '2024-10-15', 'asdsad', 1, 1),
(26, 'Primeiro Teste', '2024-10-11', 'sadd', 1, 1),
(27, 'Primeiro Teste', '2024-10-09', 'asaa', 1, 1),
(28, 'Atendimento de Usuário', '2024-10-15', 'Foi atendido\r\n- SimoneDiretora de Prote&ccedil;&atilde;o Social', 1, 4),
(29, 'Atendimento de Usuário', '2024-10-15', 'Foi atendido\r\n- SimoneDiretora de Prote&ccedil;&atilde;o Social', 1, 4),
(30, 'Atendimento de Usuário', '2024-10-08', 'aaa', 1, 4),
(31, 'Atendimento de Usuário', '2024-10-08', 'o Usu&aacute;rio', 1, 4),
(32, 'Teste', '2024-10-08', 'àà', 1, 1),
(33, 'Atendimento de Usuário', '2024-10-15', 'O usuário relatou que está passando dificuldades.', 1, 4),
(34, 'Atendimento de Usuário', '2024-10-15', 'AAAA', 1, 1),
(35, 'Atendimento de Usuário', '2024-10-15', 'aaaa', 1, 4),
(36, 'Benefícios Eventuais', '2024-10-14', 'aaaaaaaa', 11, 27),
(37, 'Encaminhamento', '2024-10-01', 'aaaaa', 11, 1),
(42, 'Teste de Validação', '2024-10-21', 'Este teste serve para validar se o sistema está gerando o PDF corretamente.', 1, 1),
(43, 'Atendimento de Usuário', '2024-10-21', 'Usuário relatou que pegou enchente em sua residência e ainda não recebeu o auxílio reconstrução do governo federal, o mesmo está pedindo ajuda em alim', 11, 29),
(44, 'Primeiro atendimento', '2024-10-21', 'Teste se está tudo certo', 18, 29),
(45, 'cesta basica', '2024-10-21', 'retirou a cesta', 29, 27),
(46, 'Atendimento de Usuário', '2024-09-23', 'Bom dia,', 1, 4),
(47, 'Atendimento de Usuário', '2024-10-30', 'Teste', 1, 1),
(48, 'Atendimento de Usuário', '2024-10-28', 'aaaa', 29, 4),
(49, 'Atendimento de Usuário', '2024-10-30', 'Hoje atendi o usuário e librei 300 cestas básicas para ele.', 1, 29),
(50, 'Atendimento de Usuário', '2024-10-30', 'Hoje atendi um usuário que relatou estar necessitado de alimento, pois o mesmo se encontra sem emprego e precisar alimentar 3 crianças pequenas, porta', 1, 29),
(51, 'Atendimento de Usuário', '2024-10-30', 'teste', 1, 1),
(52, 'Atendimento de Usuário', '2024-10-30', 'a', 28, 4),
(53, 'Atendimento de Usuário', '2024-10-02', 'a', 28, 29),
(54, 'Atendimento de Usuário', '2024-11-05', 'Este é um teste de atendimento', 28, 1),
(55, 'Atendimento de Usuário', '2024-12-18', 'Teste de atendimento', 1, 29),
(56, 'Atendimento da Larissa', '2024-12-18', 'O usuário relatou que esta', 11, 27),
(57, 'Teste de Texto', '2024-12-18', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ex risus, sollicitudin at faucibus sed, maximus eu diam. Integer pretium tincidunt ni', 11, 1),
(58, 'Terceiro Teste', '2024-12-18', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ex risus, sollicitudin at faucibus sed, maximus eu diam. Integer pretium tincidunt nisi, volutpat imperdiet arcu consequat nec. Nulla in lectus quis libero consequat tristique. Suspendisse nec lectus auctor, tristique nulla ac, imperdi', 11, 4),
(59, 'Quarto Teste', '2024-12-18', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ex risus, sollicitudin at faucibus sed, maximus eu diam. Integer pretium tincidunt nisi, volutpat imperdiet arcu consequat nec. Nulla in lectus quis libero consequat tristique. Suspendisse nec lectus auctor, tristique nulla ac, imperdiet nulla. Aenean bibendum risus non mauris interdum, id suscipit eros sollicitudin. Duis condimentum nunc sed diam laoreet maximus. Donec vitae tortor nec odio vestibulum mollis et ut turpis.\r\nAenean in ante id nulla eleifend cursus blandit non ipsum. Sed pretium in ante et tincidunt. Mauris eget ex felis. Duis pharetra erat sed mauris porttitor, a commodo ante pulvinar. Nam eu lobortis purus. Duis aliquet euismod magna, eu blandit mi fermentum sit amet. Proin eu facilisis diam. Sed et facilisis nunc, nec lacinia quam. Praesent molestie nisl eget mattis rutrum. Suspendisse interdum sit amet felis sed ultrices. Nunc id pharetra magna. Vestibulum ac rhoncus tortor. In molestie dolor in lorem p', 11, 27),
(60, 'Atendimento de Usuário', '2024-12-19', 'adaddsdsadavgfggdasdas', 1, 1),
(61, 'Atendimento Paulo Farias', '2025-01-07', 'O senhor Paulo Farias veio até a secretaria para solicitar inclusão no auxílio BPC, pois relata que está desempregado e possui 3 filhos para alimentar em sua residência.', 1, 30),
(62, 'Atendimento de Usuário', '2025-01-06', 'Teste', 1, 30);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(12) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` int(11) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `datanasc` date NOT NULL,
  `telefone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `cpf`, `endereco`, `datanasc`, `telefone`) VALUES
(1, 'Rodrigo Barcelos', 2147483647, 'Rua José do Patrocínio', '1984-04-23', '55996324567'),
(4, 'Flavio Ricardo', 2147483647, 'Rua das Américas', '1993-04-12', '55992334665'),
(27, 'Joao Rodrigues', 987654321, 'Rua Carlos Gomes', '2024-10-08', '55996324567'),
(29, 'Elias Honnse', 2147483647, 'Rua Timóteo Paim', '1982-05-19', '55991346785'),
(30, 'Paulo Farias', 2147483647, 'Rua Euclides Brás', '1976-03-20', '55991123457');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `assistentes`
--
ALTER TABLE `assistentes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD PRIMARY KEY (`protocolo`),
  ADD KEY `id_assistente` (`id_assistente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `assistentes`
--
ALTER TABLE `assistentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  MODIFY `protocolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD CONSTRAINT `id_assistente` FOREIGN KEY (`id_assistente`) REFERENCES `assistentes` (`id`),
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
