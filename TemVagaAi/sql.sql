-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05-Dez-2020 às 19:10
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `temvagaai`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `vaga`
--

DROP TABLE IF EXISTS `vaga`;
CREATE TABLE IF NOT EXISTS `vaga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `descricao` varchar(350) NOT NULL,
  `diaria` float NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `arquivo1` varchar(45) NOT NULL,
  `arquivo2` varchar(45) NOT NULL,
  `arquivo3` varchar(45) NOT NULL,
  `arquivo4` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `vaga`
--

INSERT INTO `vaga` (`id`, `nome`, `descricao`, `diaria`, `cidade`, `arquivo1`, `arquivo2`, `arquivo3`, `arquivo4`) VALUES
(1, 'Casa de Inverno', 'Casa aconchegante para passar essa epoca do ano!', 300, 'Gramado - RS', '494ab5759db3f5d6aa1f165492852a90.jpg', '434d27a683e1e2129196dcc4b50adcae.png', '126f688039f219e7dfaa0cd9ae3db849.png', '0ab7cc6e65313c993f89954cd763365a.png'),
(2, 'Rancho Amarelo', 'Casa de frente ao lago!', 200, 'Rio Paranaiba - MG', 'de41558ca2d1f496c421e7d5b9868903.png', '3ece94180851b81c09f1190a8b409b35.png', '97d0f163a51c6b62b67e5ffb222692ef.png', '42f19e82ca24583a6dc734f001c4645d.png'),
(3, 'Apartamento Praia', 'Apto com vista magnifica para a praia!', 400, 'Salvador - BA', '6b5e644ac45d6a7c0c184852896d127d.png', '99d22a7e24c2a4c001c72a335963653c.png', '042829d0a290d261c472eb2cc9a37279.png', '475ea3cfb3cb4329f998cc846ab75750.png'),
(4, 'Bangalo Inteiro', 'Paz e descanso! 1 cama e 1 banheiro.', 450, 'Rio Paranaiba - MG', '8b70a7b711220197e93517fbe9a9adc3.png', 'c58c260d4b9cc3e54a601f53f06ca6a3.png', '17490d951d17978fdc67bfa6d14d3754.png', 'bcb60c0e95bf7613fc5d959e7fadafb2.png'),
(5, 'Apartamento Clube Beach Park', 'Aptos para uma familia, venha passar o final de semana conosco!', 470, 'Rio Paranaiba - MG', '83cf43d740c9f23377eda61dab4d33b3.png', '511d481707b1fcd4a5f25ed137d46630.png', '0aa1b80d69901939d82a4ebd41dcff97.png', '5ed604237603199749dc5e26a0d9a49c.png'),
(6, 'Apartamento com Churrasqueira', '2 quartos, 4 camas e 2 banheiros.', 260, 'Rio Paranaiba - MG', '1b6a44f1c848ab83840a2d5484d5393a.png', '224f86cd49cbc1d5f79cc4fd2f591b98.png', '416c2758944e0e9c1d54255be8a32382.png', '8005beaef3c21d30e0518bc9c8180a2b.png'),
(7, 'Apartamento simples e barato', 'Melhor sala e quarto de botafogo', 170, 'Rio de Janeiro - MG', '7985b82c4a5004cf2283736b48f64fec.png', 'b548c0059ac1ac369de2a5ec53e3b391.png', '4b2a2f2f5bc0d2f2e405298cdfe3c0cc.png', '6ea5802bc75004b5d8e2ffcfc49f6a55.png'),
(8, 'Casa com estudio simples', 'Aconchegante studio em RP.', 230, 'Rio Paranaiba - MG', '0588217256255d58963399b5976028e8.png', 'f432ba4b9259fed73650201e81abc813.png', '2265bb89585517f2324b864d7a5aeed0.png', '734d2fca3c2fa35ee1150e9c280f9770.png'),
(9, 'Sitio do Rodrigo', 'Lugar ideal pra tomar uma e passar o fim de semana!', 360, 'Carmo do Paranaiba - MG', 'dd3c5b077affee3acf7f1bb0f82316fa.png', '9ec8338443bebccdaaa3b65358302181.png', 'c82adbb24c4b1f31b21bfda24072a0d4.png', '293823e21006c76d0dd60c4f9f4fe434.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
