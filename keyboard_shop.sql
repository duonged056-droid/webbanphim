-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: keyboard_shop
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chi_tiet_hoa_dons`
--

DROP TABLE IF EXISTS `chi_tiet_hoa_dons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chi_tiet_hoa_dons` (
  `MaHD` bigint(20) unsigned NOT NULL,
  `MaSP` bigint(20) unsigned NOT NULL,
  `SoLuong` int(11) NOT NULL DEFAULT 1,
  `DonGia` decimal(18,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`MaHD`,`MaSP`),
  KEY `chi_tiet_hoa_dons_masp_foreign` (`MaSP`),
  CONSTRAINT `chi_tiet_hoa_dons_mahd_foreign` FOREIGN KEY (`MaHD`) REFERENCES `hoa_dons` (`MaHD`) ON DELETE CASCADE,
  CONSTRAINT `chi_tiet_hoa_dons_masp_foreign` FOREIGN KEY (`MaSP`) REFERENCES `san_phams` (`MaSP`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chi_tiet_hoa_dons`
--

LOCK TABLES `chi_tiet_hoa_dons` WRITE;
/*!40000 ALTER TABLE `chi_tiet_hoa_dons` DISABLE KEYS */;
INSERT INTO `chi_tiet_hoa_dons` VALUES (1,1,1,1500000.00,'2026-10-02 23:20:56','2026-10-02 23:20:56'),(2,1,1,1500000.00,'2026-10-15 06:23:22','2026-10-15 06:23:22'),(2,5,1,6000.00,'2026-10-15 06:23:22','2026-10-15 06:23:22'),(2,120,1,450000.00,'2026-10-15 06:23:22','2026-10-15 06:23:22');
/*!40000 ALTER TABLE `chi_tiet_hoa_dons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `danh_gias`
--

DROP TABLE IF EXISTS `danh_gias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `danh_gias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `MaSP` bigint(20) unsigned NOT NULL,
  `MaHD` bigint(20) unsigned DEFAULT NULL,
  `so_sao` tinyint(4) NOT NULL,
  `tieu_de` varchar(200) DEFAULT NULL,
  `noi_dung` text DEFAULT NULL,
  `da_duyet` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `danh_gias_user_id_foreign` (`user_id`),
  KEY `danh_gias_masp_foreign` (`MaSP`),
  KEY `danh_gias_mahd_foreign` (`MaHD`),
  CONSTRAINT `danh_gias_mahd_foreign` FOREIGN KEY (`MaHD`) REFERENCES `hoa_dons` (`MaHD`) ON DELETE SET NULL,
  CONSTRAINT `danh_gias_masp_foreign` FOREIGN KEY (`MaSP`) REFERENCES `san_phams` (`MaSP`) ON DELETE CASCADE,
  CONSTRAINT `danh_gias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `danh_gias`
--

LOCK TABLES `danh_gias` WRITE;
/*!40000 ALTER TABLE `danh_gias` DISABLE KEYS */;
INSERT INTO `danh_gias` VALUES (1,4,1,NULL,5,'Gõ cực kỳ đầm tay, âm thock rất sướng!','Bàn phím hoàn thiện xuất sắc, switch đã được pre-lube sẵn rất mượt, không hề có tiếng vang lò xo. Đèn RGB cực kỳ bắt mắt, xứng đáng từng đồng.',1,'2026-10-16 23:07:16','2026-10-16 23:07:16'),(2,4,2,NULL,5,'Kết nối không dây 3 chế độ siêu ổn định','Dùng Type-C, Bluetooth và 2.4Ghz chuyển đổi rất mượt. Pin trâu dùng cả tuần chưa phải sạc lại. Rất hài lòng với dịch vụ tư vấn của shop.',1,'2026-10-16 23:07:16','2026-10-16 23:07:16'),(3,4,3,NULL,4,'Keycap PBT dày dặn, layout gọn gàng','Chất lượng nhựa PBT double-shot nhám nhẹ chống bám vân tay tốt. Giao hàng bọc chống sốc 3 lớp cẩn thận, cho 9.5/10 điểm.',1,'2026-10-16 23:07:16','2026-10-16 23:07:16'),(4,4,4,NULL,5,'Gõ cực kỳ đầm tay, âm thock rất sướng!','Bàn phím hoàn thiện xuất sắc, switch đã được pre-lube sẵn rất mượt, không hề có tiếng vang lò xo. Đèn RGB cực kỳ bắt mắt, xứng đáng từng đồng.',1,'2026-10-16 23:07:16','2026-10-16 23:07:16'),(5,4,5,NULL,5,'Kết nối không dây 3 chế độ siêu ổn định','Dùng Type-C, Bluetooth và 2.4Ghz chuyển đổi rất mượt. Pin trâu dùng cả tuần chưa phải sạc lại. Rất hài lòng với dịch vụ tư vấn của shop.',1,'2026-10-16 23:07:16','2026-10-16 23:07:16');
/*!40000 ALTER TABLE `danh_gias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dia_chi_giao_hangs`
--

DROP TABLE IF EXISTS `dia_chi_giao_hangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dia_chi_giao_hangs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `so_dien_thoai` varchar(20) NOT NULL,
  `dia_chi` varchar(500) NOT NULL,
  `phuong_xa` varchar(100) DEFAULT NULL,
  `quan_huyen` varchar(100) DEFAULT NULL,
  `tinh_thanh` varchar(100) NOT NULL,
  `la_mac_dinh` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dia_chi_giao_hangs_user_id_foreign` (`user_id`),
  CONSTRAINT `dia_chi_giao_hangs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dia_chi_giao_hangs`
--

LOCK TABLES `dia_chi_giao_hangs` WRITE;
/*!40000 ALTER TABLE `dia_chi_giao_hangs` DISABLE KEYS */;
INSERT INTO `dia_chi_giao_hangs` VALUES (1,4,'Hoàng Văn Đương','0987654321','123 Nguyễn Huệ','Phường Bến Nghé','Quận 1','TP. Hồ Chí Minh',1,'2026-10-16 23:07:16','2026-10-16 23:07:16'),(2,4,'Hoàng Văn Đương (Văn phòng)','0987654321','Tòa nhà Landmark 81, 720A Điện Biên Phủ','Phường 22','Quận Bình Thạnh','TP. Hồ Chí Minh',0,'2026-10-16 23:07:16','2026-10-16 23:07:16'),(3,2,'Khách Mua Phím','0912345678','456 Lê Lợi','Phường Bến Thành','Quận 1','TP. Hồ Chí Minh',1,'2026-10-16 23:07:16','2026-10-16 23:07:16');
/*!40000 ALTER TABLE `dia_chi_giao_hangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hoa_dons`
--

DROP TABLE IF EXISTS `hoa_dons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hoa_dons` (
  `MaHD` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `MaKH` bigint(20) unsigned NOT NULL,
  `NgayDat` datetime NOT NULL,
  `TongTien` decimal(18,2) NOT NULL DEFAULT 0.00,
  `TrangThai` varchar(50) NOT NULL DEFAULT 'Chờ xử lý',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `DienThoai` varchar(20) DEFAULT NULL,
  `DiaChiGiaoHang` varchar(255) DEFAULT NULL,
  `PhuongThucThanhToan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`MaHD`),
  KEY `hoa_dons_makh_foreign` (`MaKH`),
  CONSTRAINT `hoa_dons_makh_foreign` FOREIGN KEY (`MaKH`) REFERENCES `khach_hangs` (`MaKH`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hoa_dons`
--

LOCK TABLES `hoa_dons` WRITE;
/*!40000 ALTER TABLE `hoa_dons` DISABLE KEYS */;
INSERT INTO `hoa_dons` VALUES (1,1,'2026-10-03 06:20:56',1500000.00,'Đã hoàn thành','2026-10-02 23:20:56','2026-10-02 23:32:54','0702039472','số 7 ngách 31 ngõ 595 lĩnh nam vĩnh hưng hà nội','Thanh toán khi nhận hàng (COD)'),(2,2,'2026-10-15 13:23:22',1956000.00,'Đã hoàn thành','2026-10-15 06:23:22','2026-10-15 06:37:23','sàds','fasfd','Chuyển khoản ngân hàng');
/*!40000 ALTER TABLE `hoa_dons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `khach_hangs`
--

DROP TABLE IF EXISTS `khach_hangs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `khach_hangs` (
  `MaKH` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `TenKH` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `SoDienThoai` varchar(15) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`MaKH`),
  UNIQUE KEY `khach_hangs_email_unique` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `khach_hangs`
--

LOCK TABLES `khach_hangs` WRITE;
/*!40000 ALTER TABLE `khach_hangs` DISABLE KEYS */;
INSERT INTO `khach_hangs` VALUES (1,'Hoàng Văn Đương','duonghoang130226@gmail.com','NO_PASSWORD','0702039472','số 7 ngách 31 ngõ 595 lĩnh nam vĩnh hưng hà nội','2026-10-02 23:20:56','2026-10-02 23:20:56'),(2,'duong','duong@gmail.com','NO_PASSWORD','sàds','fasfd','2026-10-15 06:23:22','2026-10-15 06:23:22');
/*!40000 ALTER TABLE `khach_hangs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ma_giam_gias`
--

DROP TABLE IF EXISTS `ma_giam_gias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ma_giam_gias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ma_code` varchar(50) NOT NULL,
  `mo_ta` varchar(255) DEFAULT NULL,
  `loai_giam` enum('phan_tram','so_tien') NOT NULL,
  `gia_tri` decimal(10,2) NOT NULL,
  `don_hang_toi_thieu` decimal(18,2) NOT NULL DEFAULT 0.00,
  `giam_toi_da` decimal(18,2) DEFAULT NULL,
  `so_luong_su_dung` int(11) NOT NULL DEFAULT 0,
  `gioi_han_su_dung` int(11) DEFAULT NULL,
  `ngay_bat_dau` datetime NOT NULL,
  `ngay_ket_thuc` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_giam_gias_ma_code_unique` (`ma_code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ma_giam_gias`
--

LOCK TABLES `ma_giam_gias` WRITE;
/*!40000 ALTER TABLE `ma_giam_gias` DISABLE KEYS */;
INSERT INTO `ma_giam_gias` VALUES (1,'KEYLABS10','Giảm 10% cho đơn hàng đầu tiên (tối đa 200.000đ)','phan_tram',10.00,500000.00,200000.00,0,100,'2026-10-12 06:07:16','2027-01-17 06:07:16',1,'2026-10-16 23:07:16','2026-10-16 23:07:16'),(2,'FREESHIP50K','Giảm ngay 50.000đ tiền vận chuyển cho đơn từ 300.000đ','so_tien',50000.00,300000.00,NULL,0,500,'2026-10-16 06:07:16','2027-04-17 06:07:16',1,'2026-10-16 23:07:16','2026-10-16 23:07:16'),(3,'CUSTOMPRO','Giảm 15% tối đa 500.000đ cho bàn phím Custom cao cấp','phan_tram',15.00,1500000.00,500000.00,0,50,'2026-10-17 06:07:16','2026-12-17 06:07:16',1,'2026-10-16 23:07:16','2026-10-16 23:07:16');
/*!40000 ALTER TABLE `ma_giam_gias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2026_10_03_054048_create_khach_hangs_table',1),(6,'2026_10_03_054049_create_hoa_dons_table',1),(7,'2026_10_03_054049_create_san_phams_table',1),(8,'2026_10_03_054050_create_chi_tiet_hoa_dons_table',1),(9,'2026_10_03_055454_add_role_to_users_table',2),(10,'2026_10_03_061644_add_checkout_fields_to_hoa_dons_table',3),(11,'2026_10_17_055357_add_profile_fields_to_users_table',4),(12,'2026_10_17_055500_create_dia_chi_giao_hangs_table',4),(13,'2026_10_17_055517_create_danh_gias_table',4),(14,'2026_10_17_055534_create_ma_giam_gias_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `san_phams`
--

DROP TABLE IF EXISTS `san_phams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `san_phams` (
  `MaSP` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `TenSP` varchar(200) NOT NULL,
  `LoaiSP` varchar(50) NOT NULL,
  `GiaBan` decimal(18,2) NOT NULL,
  `SoLuongTon` int(11) NOT NULL DEFAULT 0,
  `MoTa` text DEFAULT NULL,
  `HinhAnh` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`MaSP`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `san_phams`
--

LOCK TABLES `san_phams` WRITE;
/*!40000 ALTER TABLE `san_phams` DISABLE KEYS */;
INSERT INTO `san_phams` VALUES (1,'nut75','Bàn phím cơ',1500000.00,1,'[CHÍNH HÃNG - FULL VAT] Bàn Phím Cơ WEIKAV NUT75 CNC Nhôm 3 Mode | Dual 8K | Pin 10.000mAh | Gasket Mount\r\n\r\nSo sánh','1791006708_6ac097f4b7caf.webp','2026-10-02 22:51:48','2026-10-15 06:23:22'),(2,'Bàn phím cơ Keychron Q1 Pro','Bàn phím cơ',4500000.00,15,'Bàn phím cơ nhôm nguyên khối cao cấp','keychron.jpg',NULL,NULL),(3,'Bàn phím cơ Akko 3098B','Bàn phím cơ',2200000.00,30,'Bàn phím cơ không dây','akko.jpg',NULL,NULL),(4,'Switch Cherry MX Red','Switch',15000.00,500,'Switch Linear','cherry.jpg',NULL,NULL),(5,'Switch Gateron Milky Yellow Pro','Switch',6000.00,999,'Switch siêu mượt','cherry.jpg',NULL,'2026-10-15 06:23:22'),(107,'Bàn phím cơ Aula F75','Bàn phím cơ',950000.00,34,'Sản phẩm chính hãng, phân phối trực tiếp tại Đương phím cơ.','https://cdn-files.hacom.vn/hacom/cdn/web/24082026/ban-phim-co-gaming-aula-hero75he-3-mode-mau-cam-trang-spiritcloud-magnetic-switch.jpg',NULL,NULL),(109,'Bàn phím ASUS ROG Azoth Extreme Edition 20 (ROG NX Snow)','Bàn phím cơ',5990000.00,18,'Sản phẩm chính hãng, phân phối trực tiếp tại Đương phím cơ.','https://cdn-files.hacom.vn/hacom/cdn/web/12062026/ban-phim-asus-rog-azoth-extreme-edition-20-rog-nx-snow-1.jpg',NULL,NULL),(110,'Bàn phím Razer Huntsman V3 Pro Tenkeyless','Bàn phím cơ',4500000.00,22,'Sản phẩm chính hãng, phân phối trực tiếp tại Đương phím cơ.','https://cdn-files.hacom.vn/hacom/cdn/web/14092026/ban-phim-razer-huntsman-v3-pro-tenkeyless-8khz-sentinels-edition-rz03-05521700-r3m1-1.jpg',NULL,NULL),(111,'Bàn phím Corsair GALLEON 100 SD-BLK','Bàn phím cơ',2100000.00,28,'Sản phẩm chính hãng, phân phối trực tiếp tại Đương phím cơ.','https://cdn-files.hacom.vn/hacom/cdn/web/05022026/ban-phim-corsair-galleon-100-sd-blk-mlx-pulse.jpg',NULL,NULL),(112,'Bàn phím Logitech G512 X 75 Màu Đen','Bàn phím cơ',1890000.00,17,'Sản phẩm chính hãng, phân phối trực tiếp tại Đương phím cơ.','https://cdn-files.hacom.vn/hacom/cdn/web/26052026/ban-phim-logitech-g512-x-75-mau-den-1.jpg',NULL,NULL),(113,'Bàn phím Keychron Q6U-M1 Red Switch','Bàn phím cơ',3800000.00,21,'Sản phẩm chính hãng, phân phối trực tiếp tại Đương phím cơ.','https://cdn-files.hacom.vn/hacom/cdn/web/25042026/ban-phim-keychron-q6u-m1-red-switch.jpg',NULL,NULL),(114,'Bàn phím cơ Logitech G413 SE TKL','Bàn phím cơ',1590000.00,33,'Sản phẩm chính hãng, phân phối trực tiếp tại Đương phím cơ.','https://hanoicomputercdn.com/media/product/63508_ban_phim_co_logitech_g413_se_tkl_tactile_sw_usb_pbt_0002_3.jpg',NULL,NULL),(115,'Bàn phím Razer BlackWidow V3 Green switch','Bàn phím cơ',2990000.00,44,'Sản phẩm chính hãng, phân phối trực tiếp tại Đương phím cơ.','https://hanoicomputercdn.com/media/product/56226_ba_n_phi_m_razer_blackwidow_v3_rz03_03540100_r3m1_0002_3.jpg',NULL,NULL),(116,'Bàn phím cơ gaming Edra EK398 Alpha','Bàn phím cơ',690000.00,18,'Sản phẩm chính hãng, phân phối trực tiếp tại Đương phím cơ.','https://hanoicomputercdn.com/media/product/71045_ban_phim_co_gaming_edra_ek398_alpha_blue_switch_usb_abs_led_rainbow_1.jpg',NULL,NULL),(117,'Switch Cherry MX Red (Pack 90)','Switch',850000.00,26,'Sản phẩm chính hãng, phân phối trực tiếp tại Đương phím cơ.','cherry.jpg',NULL,NULL),(118,'Switch Gateron Milky Yellow Pro (Pack 90)','Switch',650000.00,33,'Sản phẩm chính hãng, phân phối trực tiếp tại Đương phím cơ.','cherry.jpg',NULL,NULL),(119,'Bộ Keycap CMK Trắng Xanh','Keycap',500000.00,40,'Sản phẩm chính hãng, phân phối trực tiếp tại Đương phím cơ.','akko.jpg',NULL,NULL),(120,'Bộ Keycap GMK Olivia Clone','Keycap',450000.00,15,'Sản phẩm chính hãng, phân phối trực tiếp tại Đương phím cơ.','akko.jpg',NULL,'2026-10-15 06:23:22');
/*!40000 ALTER TABLE `san_phams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `dia_chi` varchar(500) DEFAULT NULL,
  `phuong_xa` varchar(100) DEFAULT NULL,
  `quan_huyen` varchar(100) DEFAULT NULL,
  `tinh_thanh` varchar(100) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `gioi_tinh` enum('Nam','Nữ','Khác') DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'customer',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'$2y$10$eteN8vMXeTYjGATC57yToeNjDUBnpys4YM/R10ir8.xVwq/cc4d5u',NULL,'2026-10-02 22:55:34','2026-10-02 22:55:34','customer'),(2,'Customer','khach@gmail.com','0912345678','456 Lê Lợi','Phường Bến Thành','Quận 1','TP. Hồ Chí Minh',NULL,'1998-05-15','Nam',1,NULL,NULL,'$2y$10$MPfv7OKTOp/Xp9XJbjSlr.PBnL7moOX5cuLm5nIsFK6erVSRIHtGy',NULL,'2026-10-02 22:55:34','2026-10-16 23:07:16','customer'),(3,'duong','duong@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'$2y$10$t9iU3hUHZoXfMMtfNWY2a.x7G172h7pcYFCWRXcBp3XMl.5EeuCN6',NULL,'2026-10-02 22:58:52','2026-10-02 23:09:54','admin'),(4,'Hoàng Văn Đương','duonghoang130226@gmail.com','0987654321','123 Nguyễn Huệ','Phường Bến Nghé','Quận 1','TP. Hồ Chí Minh',NULL,'2000-02-26','Nam',1,NULL,NULL,'$2y$10$U4DnZTmN8W2hjGylN2rmjOW7DQdCe.wc9yaOKzinCjR5Wb9PMzpDK',NULL,'2026-10-02 23:14:44','2026-10-16 23:07:16','customer');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-17 13:14:14
