/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.3.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: DB_UAS_PBO_TRPL1B_AdeAriansyahAnggoro
-- ------------------------------------------------------
-- Server version	12.3.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `tabel_mahasiswa`
--

DROP TABLE IF EXISTS `tabel_mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `semester` int(11) NOT NULL,
  `tarif_ukt_nominal` int(11) NOT NULL,
  `jenis_pembiayaan` enum('Mandiri','Bidikmisi','Prestasi') NOT NULL,
  `golongan_ukt` int(11) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nomor_kip_kuliah` varchar(30) DEFAULT NULL,
  `dana_saku_subsidi` int(11) DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(100) DEFAULT NULL,
  `minimal_ipk_syarat` decimal(3,2) DEFAULT NULL,
  PRIMARY KEY (`id_mahasiswa`),
  UNIQUE KEY `nim` (`nim`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_mahasiswa`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `tabel_mahasiswa` WRITE;
/*!40000 ALTER TABLE `tabel_mahasiswa` DISABLE KEYS */;
INSERT INTO `tabel_mahasiswa` VALUES
(1,'Ade Ariansyah Anggoro','202601001',2,5000000,'Mandiri',4,'Budi Anggoro',NULL,NULL,NULL,NULL),
(2,'Citra Lestari','202601002',4,6500000,'Mandiri',5,'Heri Lestari',NULL,NULL,NULL,NULL),
(3,'Dedi Wijaya','202601003',2,3500000,'Mandiri',3,'Wawan Wijaya',NULL,NULL,NULL,NULL),
(4,'Elrika Putri','202601004',6,8000000,'Mandiri',6,'Slamet Putri',NULL,NULL,NULL,NULL),
(5,'Fajar Nugroho','202601005',4,5000000,'Mandiri',4,'Anwar Nugroho',NULL,NULL,NULL,NULL),
(6,'Gita Permata','202601006',2,3500000,'Mandiri',3,'Rudi Permata',NULL,NULL,NULL,NULL),
(7,'Hendra Kusuma','202601007',8,6500000,'Mandiri',5,'Agus Kusuma',NULL,NULL,NULL,NULL),
(8,'Indah Sari','202601008',2,0,'Bidikmisi',NULL,NULL,'KIP-2026-001',700000,NULL,NULL),
(9,'Joko Susilo','202601009',4,0,'Bidikmisi',NULL,NULL,'KIP-2026-002',700000,NULL,NULL),
(10,'Kurniawan','202601010',2,0,'Bidikmisi',NULL,NULL,'KIP-2026-003',700000,NULL,NULL),
(11,'Lestari Wahyuni','202601011',6,0,'Bidikmisi',NULL,NULL,'KIP-2026-004',750000,NULL,NULL),
(12,'Muhammad Rizky','202601012',4,0,'Bidikmisi',NULL,NULL,'KIP-2026-005',700000,NULL,NULL),
(13,'Nadia Utami','202601013',2,0,'Bidikmisi',NULL,NULL,'KIP-2026-006',700000,NULL,NULL),
(14,'Oki Pratama','202601014',8,0,'Bidikmisi',NULL,NULL,'KIP-2026-007',750000,NULL,NULL),
(15,'Putri Handayani','202601015',4,4000000,'Prestasi',NULL,NULL,NULL,NULL,'Djarum Foundation',3.50),
(16,'Rian Hidayat','202601016',6,6000000,'Prestasi',NULL,NULL,NULL,NULL,'Kemenpora',3.25),
(17,'Siska Amelia','202601017',2,4800000,'Prestasi',NULL,NULL,NULL,NULL,'Bank Indonesia',3.50),
(18,'Taufik Hidayat','202601018',4,5000000,'Prestasi',NULL,NULL,NULL,NULL,'Tanoto Foundation',3.75),
(19,'Utari Dewi','202601019',6,4000000,'Prestasi',NULL,NULL,NULL,NULL,'Pemprov Jateng',3.00),
(20,'Vina Panduwinata','202601020',2,4000000,'Prestasi',NULL,NULL,NULL,NULL,'Djarum Foundation',3.50);
/*!40000 ALTER TABLE `tabel_mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-06-30 15:13:07
