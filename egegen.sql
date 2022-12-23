-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 01 Ara 2022, 13:29:53
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `egegen`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `materials`
--

DROP TABLE IF EXISTS `materials`;
CREATE TABLE IF NOT EXISTS `materials` (
  `materials_id` int(11) NOT NULL AUTO_INCREMENT,
  `materials_name` varchar(350) COLLATE utf32_unicode_ci NOT NULL,
  `materials_createdat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`materials_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Tablo döküm verisi `materials`
--

INSERT INTO `materials` (`materials_id`, `materials_name`, `materials_createdat`) VALUES
(1, 'Şeker', '2022-12-01 16:03:53'),
(2, 'Sirke', '2022-12-01 16:03:58'),
(3, 'Domates', '2022-12-01 16:04:05');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_name` varchar(250) COLLATE utf32_unicode_ci NOT NULL,
  `products_cratedat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`products_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`products_id`, `products_name`, `products_cratedat`) VALUES
(1, 'Yağ', '2022-12-01 16:03:36'),
(2, 'Ketçap', '2022-12-01 16:04:24'),
(3, 'Sos', '2022-12-01 16:04:55'),
(4, 'Pizza', '2022-12-01 16:05:09');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product_to_material`
--

DROP TABLE IF EXISTS `product_to_material`;
CREATE TABLE IF NOT EXISTS `product_to_material` (
  `products_id` int(11) NOT NULL,
  `materials_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Tablo döküm verisi `product_to_material`
--

INSERT INTO `product_to_material` (`products_id`, `materials_id`) VALUES
(2, 3),
(2, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product_to_product`
--

DROP TABLE IF EXISTS `product_to_product`;
CREATE TABLE IF NOT EXISTS `product_to_product` (
  `products_id` int(11) NOT NULL,
  `products_child_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Tablo döküm verisi `product_to_product`
--

INSERT INTO `product_to_product` (`products_id`, `products_child_id`) VALUES
(4, 3),
(4, 2),
(4, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
