-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 19, 2012 at 01:54 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spkmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `spk`
--

CREATE TABLE IF NOT EXISTS `spk` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `ref` varchar(25) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `status_produksi` text,
  `customer` varchar(75) NOT NULL,
  `alamat_kirim` varchar(250) DEFAULT NULL,
  `item` varchar(150) DEFAULT NULL,
  `order` varchar(50) DEFAULT NULL,
  `toleransi` varchar(25) DEFAULT NULL,
  `bahan` varchar(150) DEFAULT NULL,
  `ukuran` varchar(25) DEFAULT NULL,
  `warna` varchar(150) DEFAULT NULL,
  `finishing` varchar(150) DEFAULT NULL,
  `bentuk_potongan` varchar(50) DEFAULT NULL,
  `catatan_stiker` varchar(150) DEFAULT NULL,
  `nomor_po` varchar(100) DEFAULT NULL,
  `permintaan_kirim` date DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `mesin` varchar(50) DEFAULT NULL,
  `data` varchar(50) DEFAULT NULL,
  `bentuk_pisau` varchar(50) DEFAULT NULL,
  `list` varchar(75) DEFAULT NULL,
  `nomor_pisau` varchar(50) DEFAULT NULL,
  `nomor_silinder` varchar(50) DEFAULT NULL,
  `nomor_piringan` varchar(50) DEFAULT NULL,
  `alokasi_bahan` varchar(150) DEFAULT NULL,
  `catatan` varchar(150) DEFAULT NULL,
  `file_stiker` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123548 ;
