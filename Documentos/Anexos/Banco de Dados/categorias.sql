-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15-Nov-2017 às 05:37
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classi-o`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Acessórios para Veículos'),
(2, 'Agro, Indústria e Comércio'),
(3, 'Alimentos e Bebidas'),
(4, 'Animais'),
(5, 'Antiguidades'),
(6, 'Arte e Artesanato'),
(7, 'Bebês'),
(8, 'Beleza e Cuidado Pessoal'),
(9, 'Brinquedos e Hobbies'),
(10, 'Calçados, Roupas e Bolsas'),
(11, 'Câmeras e Acessórios'),
(12, 'Carros, Motos e Outros'),
(13, 'Casa, Móveis e Decoração '),
(14, 'Celulares e Telefones'),
(15, 'Coleções e Comics'),
(16, 'Eletrodomésticos'),
(17, 'Eletrônicos, Áudio e Vídeo'),
(18, 'Esportes e Fitness'),
(19, 'Ferramentas e Construção'),
(20, 'Filmes e Seriados'),
(21, 'Games'),
(22, 'Imóveis'),
(23, 'Informática'),
(24, 'Ingressos'),
(25, 'Instrumentos Musicais'),
(26, 'Joias e Relógios'),
(27, 'Livros'),
(28, 'Música'),
(29, 'Saúde'),
(30, 'Serviços'),
(31, 'Outros');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
