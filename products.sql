-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.4.3 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table stockify.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `supplier_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `purchase_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `min_stock` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_sku_unique` (`sku`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel stockify.products: ~50 rows (lebih kurang)
INSERT INTO `products` (`id`, `category_id`, `supplier_id`, `name`, `sku`, `description`, `purchase_price`, `selling_price`, `image`, `stock`, `created_at`, `updated_at`, `min_stock`) VALUES
	(1, 1, 1, 'Minuman Produk 1', 'MNM001', 'Deskripsi minuman produk 1 (contoh deskripsi dari kamu saja)', 3010.00, 5512.00, 'products/product-1.jpg', 344, '2025-02-12 06:01:43', '2025-02-13 01:24:16', 0),
	(2, 2, 2, 'Makanan Produk 2', 'MKN002', 'Deskripsi makanan produk 2 (contoh deskripsi dari anda saja)', 5030.00, 8040.00, 'products/product-2.jpg', 1325, '2025-02-12 06:01:43', '2025-02-13 00:48:20', 0),
	(3, 1, 3, 'Minuman Produk 3', 'MNM003', 'Deskripsi minuman produk 3 (contoh deskripsi dari kamu saja)', 3030.00, 5536.00, 'products/product-3.jpg', 516, '2025-02-12 06:01:43', '2025-02-13 01:25:41', 0),
	(4, 2, 4, 'Makanan Produk 4', 'MKN004', 'Deskripsi makanan produk 4 (contoh deskripsi dari anda saja)', 5060.00, 8080.00, 'products/product-4.jpg', 111, '2025-02-12 06:01:43', '2025-02-12 23:09:12', 0),
	(5, 1, 5, 'Minuman Produk 5', 'MNM005', 'Deskripsi minuman produk 5 (contoh deskripsi dari kamu saja)', 3050.00, 5560.00, 'products/product-5.jpg', 102, '2025-02-12 06:01:43', '2025-02-12 23:07:53', 0),
	(6, 2, 1, 'Makanan Produk 6', 'MKN006', 'Deskripsi makanan produk 6 (contoh deskripsi dari anda saja)', 5090.00, 8120.00, 'products/product-6.jpg', 100, '2025-02-12 06:01:43', '2025-02-12 06:01:43', 0),
	(7, 1, 2, 'Minuman Produk 7', 'MNM007', 'Deskripsi minuman produk 7 (contoh deskripsi dari kamu saja)', 3070.00, 5584.00, 'products/product-7.jpg', 588, '2025-02-12 06:01:43', '2025-02-13 00:14:02', 0),
	(8, 2, 3, 'Makanan Produk 8', 'MKN008', 'Deskripsi makanan produk 8 (contoh deskripsi dari anda saja)', 5120.00, 8160.00, 'products/product-8.jpg', 112, '2025-02-12 06:01:43', '2025-02-13 01:18:11', 0),
	(9, 1, 4, 'Minuman Produk 9', 'MNM009', 'Deskripsi minuman produk 9 (contoh deskripsi dari kamu saja)', 3090.00, 5608.00, 'products/product-9.jpg', 100, '2025-02-12 06:01:43', '2025-02-12 06:01:43', 0),
	(10, 2, 5, 'Makanan Produk 10', 'MKN010', 'Deskripsi makanan produk 10 (contoh deskripsi dari anda saja)', 5150.00, 8200.00, 'products/product-10.jpg', 100, '2025-02-12 06:01:43', '2025-02-12 06:01:43', 0),
	(11, 1, 1, 'Minuman Produk 11', 'MNM011', 'Deskripsi minuman produk 11 (contoh deskripsi dari kamu saja)', 3110.00, 5632.00, 'products/product-11.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(12, 2, 2, 'Makanan Produk 12', 'MKN012', 'Deskripsi makanan produk 12 (contoh deskripsi dari anda saja)', 5180.00, 8240.00, 'products/product-12.jpg', 313, '2025-02-12 06:01:44', '2025-02-13 01:26:39', 0),
	(13, 1, 3, 'Minuman Produk 13', 'MNM013', 'Deskripsi minuman produk 13 (contoh deskripsi dari kamu saja)', 3130.00, 5656.00, 'products/product-13.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(14, 2, 4, 'Makanan Produk 14', 'MKN014', 'Deskripsi makanan produk 14 (contoh deskripsi dari anda saja)', 5210.00, 8280.00, 'products/product-14.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(15, 1, 5, 'Minuman Produk 15', 'MNM015', 'Deskripsi minuman produk 15 (contoh deskripsi dari kamu saja)', 3150.00, 5680.00, 'products/product-15.jpg', 0, '2025-02-12 06:01:44', '2025-02-12 22:23:36', 0),
	(16, 2, 1, 'Makanan Produk 16', 'MKN016', 'Deskripsi makanan produk 16 (contoh deskripsi dari anda saja)', 5240.00, 8320.00, 'products/product-16.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(17, 1, 2, 'Minuman Produk 17', 'MNM017', 'Deskripsi minuman produk 17 (contoh deskripsi dari kamu saja)', 3170.00, 5704.00, 'products/product-17.jpg', 176, '2025-02-12 06:01:44', '2025-02-13 01:28:36', 0),
	(18, 2, 3, 'Makanan Produk 18', 'MKN018', 'Deskripsi makanan produk 18 (contoh deskripsi dari anda saja)', 5270.00, 8360.00, 'products/product-18.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(19, 1, 4, 'Minuman Produk 19', 'MNM019', 'Deskripsi minuman produk 19 (contoh deskripsi dari kamu saja)', 3190.00, 5728.00, 'products/product-19.jpg', 140, '2025-02-12 06:01:44', '2025-02-13 01:28:51', 0),
	(20, 2, 5, 'Makanan Produk 20', 'MKN020', 'Deskripsi makanan produk 20 (contoh deskripsi dari anda saja)', 5300.00, 8400.00, 'products/product-20.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(21, 1, 1, 'Minuman Produk 21', 'MNM021', 'Deskripsi minuman produk 21 (contoh deskripsi dari kamu saja)', 3210.00, 5752.00, 'products/product-21.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(22, 2, 2, 'Makanan Produk 22', 'MKN022', 'Deskripsi makanan produk 22 (contoh deskripsi dari anda saja)', 5330.00, 8440.00, 'products/product-22.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(23, 1, 3, 'Minuman Produk 23', 'MNM023', 'Deskripsi minuman produk 23 (contoh deskripsi dari kamu saja)', 3230.00, 5776.00, 'products/product-23.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(24, 2, 4, 'Makanan Produk 24', 'MKN024', 'Deskripsi makanan produk 24 (contoh deskripsi dari anda saja)', 5360.00, 8480.00, 'products/product-24.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(25, 1, 5, 'Minuman Produk 25', 'MNM025', 'Deskripsi minuman produk 25 (contoh deskripsi dari kamu saja)', 3250.00, 5800.00, 'products/product-25.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(26, 2, 1, 'Makanan Produk 26', 'MKN026', 'Deskripsi makanan produk 26 (contoh deskripsi dari anda saja)', 5390.00, 8520.00, 'products/product-26.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(27, 1, 2, 'Minuman Produk 27', 'MNM027', 'Deskripsi minuman produk 27 (contoh deskripsi dari kamu saja)', 3270.00, 5824.00, 'products/product-27.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(28, 2, 3, 'Makanan Produk 28', 'MKN028', 'Deskripsi makanan produk 28 (contoh deskripsi dari anda saja)', 5420.00, 8560.00, 'products/product-28.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(29, 1, 4, 'Minuman Produk 29', 'MNM029', 'Deskripsi minuman produk 29 (contoh deskripsi dari kamu saja)', 3290.00, 5848.00, 'products/product-29.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(30, 2, 5, 'Makanan Produk 30', 'MKN030', 'Deskripsi makanan produk 30 (contoh deskripsi dari anda saja)', 5450.00, 8600.00, 'products/product-30.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(31, 1, 1, 'Minuman Produk 31', 'MNM031', 'Deskripsi minuman produk 31 (contoh deskripsi dari kamu saja)', 3310.00, 5872.00, 'products/product-31.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(32, 2, 2, 'Makanan Produk 32', 'MKN032', 'Deskripsi makanan produk 32 (contoh deskripsi dari anda saja)', 5480.00, 8640.00, 'products/product-32.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(33, 1, 3, 'Minuman Produk 33', 'MNM033', 'Deskripsi minuman produk 33 (contoh deskripsi dari kamu saja)', 3330.00, 5896.00, 'products/product-33.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(34, 2, 4, 'Makanan Produk 34', 'MKN034', 'Deskripsi makanan produk 34 (contoh deskripsi dari anda saja)', 5510.00, 8680.00, 'products/product-34.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(35, 1, 5, 'Minuman Produk 35', 'MNM035', 'Deskripsi minuman produk 35 (contoh deskripsi dari kamu saja)', 3350.00, 5920.00, 'products/product-35.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(36, 2, 1, 'Makanan Produk 36', 'MKN036', 'Deskripsi makanan produk 36 (contoh deskripsi dari anda saja)', 5540.00, 8720.00, 'products/product-36.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(37, 1, 2, 'Minuman Produk 37', 'MNM037', 'Deskripsi minuman produk 37 (contoh deskripsi dari kamu saja)', 3370.00, 5944.00, 'products/product-37.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(38, 2, 3, 'Makanan Produk 38', 'MKN038', 'Deskripsi makanan produk 38 (contoh deskripsi dari anda saja)', 5570.00, 8760.00, 'products/product-38.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(39, 1, 4, 'Minuman Produk 39', 'MNM039', 'Deskripsi minuman produk 39 (contoh deskripsi dari kamu saja)', 3390.00, 5968.00, 'products/product-39.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(40, 2, 5, 'Makanan Produk 40', 'MKN040', 'Deskripsi makanan produk 40 (contoh deskripsi dari anda saja)', 5600.00, 8800.00, 'products/product-40.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(41, 1, 1, 'Minuman Produk 41', 'MNM041', 'Deskripsi minuman produk 41 (contoh deskripsi dari kamu saja)', 3410.00, 5992.00, 'products/product-41.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(42, 2, 2, 'Makanan Produk 42', 'MKN042', 'Deskripsi makanan produk 42 (contoh deskripsi dari anda saja)', 5630.00, 8840.00, 'products/product-42.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(43, 1, 3, 'Minuman Produk 43', 'MNM043', 'Deskripsi minuman produk 43 (contoh deskripsi dari kamu saja)', 3430.00, 6016.00, 'products/product-43.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(44, 2, 4, 'Makanan Produk 44', 'MKN044', 'Deskripsi makanan produk 44 (contoh deskripsi dari anda saja)', 5660.00, 8880.00, 'products/product-44.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(45, 1, 5, 'Minuman Produk 45', 'MNM045', 'Deskripsi minuman produk 45 (contoh deskripsi dari kamu saja)', 3450.00, 6040.00, 'products/product-45.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(46, 2, 1, 'Makanan Produk 46', 'MKN046', 'Deskripsi makanan produk 46 (contoh deskripsi dari anda saja)', 5690.00, 8920.00, 'products/product-46.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(47, 1, 2, 'Minuman Produk 47', 'MNM047', 'Deskripsi minuman produk 47 (contoh deskripsi dari kamu saja)', 3470.00, 6064.00, 'products/product-47.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(48, 2, 3, 'Makanan Produk 48', 'MKN048', 'Deskripsi makanan produk 48 (contoh deskripsi dari anda saja)', 5720.00, 8960.00, 'products/product-48.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(49, 1, 4, 'Minuman Produk 49', 'MNM049', 'Deskripsi minuman produk 49 (contoh deskripsi dari kamu saja)', 3490.00, 6088.00, 'products/product-49.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0),
	(50, 2, 5, 'Makanan Produk 50', 'MKN050', 'Deskripsi makanan produk 50 (contoh deskripsi dari anda saja)', 5750.00, 9000.00, 'products/product-50.jpg', 100, '2025-02-12 06:01:44', '2025-02-12 06:01:44', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
