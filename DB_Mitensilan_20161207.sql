-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table bpkp_db.ci_sessions
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.diklat
CREATE TABLE IF NOT EXISTS `diklat` (
  `ID_Diklat` int(11) NOT NULL AUTO_INCREMENT,
  `Lembaga_Penyelenggara` varchar(100) DEFAULT NULL,
  `No_Sertifikat` varchar(50) DEFAULT NULL,
  `Tanggal_Sertifikat` date DEFAULT NULL,
  `Jenis_Diklat_ID_Jenis_Diklat` int(11) DEFAULT NULL,
  `Master_Diklat_ID_Diklat` int(11) NOT NULL,
  `Pegawai_ID_Pegawai` int(11) NOT NULL,
  PRIMARY KEY (`ID_Diklat`,`Pegawai_ID_Pegawai`),
  KEY `fk_Diklat_Jenis Diklat1_idx` (`Jenis_Diklat_ID_Jenis_Diklat`),
  KEY `fk_Diklat_Pegawai1_idx` (`Pegawai_ID_Pegawai`),
  KEY `fk_Master_Diklat` (`Master_Diklat_ID_Diklat`),
  CONSTRAINT `fk_Diklat_Jenis Diklat1` FOREIGN KEY (`Jenis_Diklat_ID_Jenis_Diklat`) REFERENCES `jenis_diklat` (`ID_Jenis_Diklat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Diklat_Pegawai1` FOREIGN KEY (`Pegawai_ID_Pegawai`) REFERENCES `pegawai` (`ID_Pegawai`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Master_Diklat` FOREIGN KEY (`Master_Diklat_ID_Diklat`) REFERENCES `master_diklat` (`ID_Diklat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table bpkp_db.groups: ~2 rows (approximately)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
	(1, 'admin', 'Administrator kece badai'),
	(2, 'members', 'General Usersss'),
	(3, 'bidang_kepegawaian', 'Bagian HRD');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.jenis_diklat
CREATE TABLE IF NOT EXISTS `jenis_diklat` (
  `ID_Jenis_Diklat` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Jenis_Diklat` varchar(60) NOT NULL,
  `Deskripsi_Jenis_Diklat` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID_Jenis_Diklat`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.jenis_layanan
CREATE TABLE IF NOT EXISTS `jenis_layanan` (
  `ID_Jenis_Layanan` int(11) NOT NULL AUTO_INCREMENT,
  `Kategori_Layanan` varchar(100) NOT NULL,
  `Deskripsi_Jenis_Layanan` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Jenis_Layanan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.jenis_sertifikasi
CREATE TABLE IF NOT EXISTS `jenis_sertifikasi` (
  `ID_Jenis_Sertifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Jenis_Sertifikasi` varchar(100) NOT NULL,
  `Deskripsi_Jenis_Sertifikasi` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Jenis_Sertifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.kategori_mitra
CREATE TABLE IF NOT EXISTS `kategori_mitra` (
  `ID_Kategori_Mitra` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Kategori` varchar(100) DEFAULT NULL,
  `Deskripsi_Kategori_Mitra` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_Kategori_Mitra`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.login_attempts
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.master_diklat
CREATE TABLE IF NOT EXISTS `master_diklat` (
  `ID_Diklat` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Diklat` varchar(100) NOT NULL,
  `Keterangan_Diklat` varchar(250) DEFAULT NULL,
  `ID_Jenis_Diklat` int(11) NOT NULL,
  PRIMARY KEY (`ID_Diklat`,`ID_Jenis_Diklat`),
  KEY `FK_Jenis_Diklat` (`ID_Jenis_Diklat`),
  CONSTRAINT `FK_Jenis_Diklat` FOREIGN KEY (`ID_Jenis_Diklat`) REFERENCES `jenis_diklat` (`ID_Jenis_Diklat`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.master_fakultas
CREATE TABLE IF NOT EXISTS `master_fakultas` (
  `ID_Fakultas` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Fakultas` varchar(100) NOT NULL,
  `Keterangan_Fakultas` varchar(250) DEFAULT NULL,
  `ID_Tingkat_Pendidikan` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Fakultas`,`ID_Tingkat_Pendidikan`),
  KEY `FK_Tingkat_Pendidikan` (`ID_Tingkat_Pendidikan`),
  CONSTRAINT `FK_Tingkat_Pendidikan` FOREIGN KEY (`ID_Tingkat_Pendidikan`) REFERENCES `tingkat_pendidikan` (`ID_Tingkat_Pendidikan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.master_jurusan
CREATE TABLE IF NOT EXISTS `master_jurusan` (
  `ID_Jurusan` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Jurusan` varchar(100) NOT NULL,
  `Keterangan_Jurusan` varchar(250) DEFAULT NULL,
  `ID_Fakultas` int(11) NOT NULL,
  PRIMARY KEY (`ID_Jurusan`),
  KEY `FK_Fakultas` (`ID_Fakultas`),
  CONSTRAINT `FK_Fakultas` FOREIGN KEY (`ID_Fakultas`) REFERENCES `master_fakultas` (`ID_Fakultas`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.master_penugasan
CREATE TABLE IF NOT EXISTS `master_penugasan` (
  `ID_Jenis_Penugasan` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Jenis_Penugasan` varchar(100) NOT NULL,
  `Deskripsi_Jenis_Penugasan` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Jenis_Penugasan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.master_peran
CREATE TABLE IF NOT EXISTS `master_peran` (
  `ID_Peran` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Peran` varchar(100) NOT NULL,
  `Deskripsi_Peran` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`ID_Peran`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.master_posisi_kepengurusan
CREATE TABLE IF NOT EXISTS `master_posisi_kepengurusan` (
  `idMaster_Posisi` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Posisi` varchar(100) NOT NULL,
  `Deskripsi_Posisi_Kepengurusan` varchar(250) NOT NULL,
  PRIMARY KEY (`idMaster_Posisi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.master_sertifikasi
CREATE TABLE IF NOT EXISTS `master_sertifikasi` (
  `ID_Sertifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Sertifikasi` varchar(100) NOT NULL,
  `Keterangan_Sertifikasi` varchar(250) DEFAULT NULL,
  `ID_Jenis_Sertifikasi` int(11) NOT NULL,
  PRIMARY KEY (`ID_Sertifikasi`,`ID_Jenis_Sertifikasi`),
  KEY `FK_Jenis_Sertifikasi` (`ID_Jenis_Sertifikasi`),
  CONSTRAINT `FK_Jenis_Sertifikasi` FOREIGN KEY (`ID_Jenis_Sertifikasi`) REFERENCES `jenis_sertifikasi` (`ID_Jenis_Sertifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.mitra
CREATE TABLE IF NOT EXISTS `mitra` (
  `ID_Mitra` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Mitra` varchar(120) DEFAULT NULL,
  `Alamat_Mitra` varchar(200) DEFAULT NULL,
  `Kota` varchar(50) DEFAULT NULL,
  `Provinsi` varchar(50) DEFAULT NULL,
  `Bidang_Usaha` varchar(150) DEFAULT NULL,
  `Deskripsi` varchar(350) DEFAULT NULL,
  `Kategori_Mitra_ID_Kategori_Mitra` int(11) NOT NULL,
  PRIMARY KEY (`ID_Mitra`,`Kategori_Mitra_ID_Kategori_Mitra`),
  KEY `fk_Mitra_Kategori Mitra1_idx` (`Kategori_Mitra_ID_Kategori_Mitra`),
  CONSTRAINT `fk_Mitra_Kategori Mitra1` FOREIGN KEY (`Kategori_Mitra_ID_Kategori_Mitra`) REFERENCES `kategori_mitra` (`ID_Kategori_Mitra`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.opini kinerja
CREATE TABLE IF NOT EXISTS `opini kinerja` (
  `ID Opini Kinerja` int(11) NOT NULL AUTO_INCREMENT,
  `Kinerja` enum('1','2','3','4','5') NOT NULL,
  `Opini Auditor` varchar(500) DEFAULT NULL,
  `Tahun` int(11) DEFAULT NULL,
  `Posisi Keuangan` varchar(200) DEFAULT NULL,
  `Mitra_ID Mitra` int(11) NOT NULL,
  `Mitra_Kategori Mitra_ID Kategori Mitra` int(11) NOT NULL,
  PRIMARY KEY (`ID Opini Kinerja`,`Mitra_ID Mitra`,`Mitra_Kategori Mitra_ID Kategori Mitra`),
  KEY `fk_Opini Kinerja_Mitra1_idx` (`Mitra_ID Mitra`,`Mitra_Kategori Mitra_ID Kategori Mitra`),
  CONSTRAINT `fk_Opini Kinerja_Mitra1` FOREIGN KEY (`Mitra_ID Mitra`, `Mitra_Kategori Mitra_ID Kategori Mitra`) REFERENCES `mitra` (`ID_Mitra`, `Kategori_Mitra_ID_Kategori_Mitra`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.pegawai
CREATE TABLE IF NOT EXISTS `pegawai` (
  `ID_Pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Pegawai` varchar(100) NOT NULL,
  `NIK` char(18) DEFAULT NULL,
  `NIP` char(18) NOT NULL,
  `Tempat_Lahir` varchar(50) DEFAULT NULL,
  `Tanggal_Lahir` date DEFAULT NULL,
  `Alamat` varchar(125) DEFAULT NULL,
  `Jenis_Kelamin` enum('L','P') CHARACTER SET big5 NOT NULL,
  `Agama` enum('I','KK','KP','H','B') DEFAULT NULL,
  PRIMARY KEY (`ID_Pegawai`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.pelayanan
CREATE TABLE IF NOT EXISTS `pelayanan` (
  `ID_Pelayanan` int(11) NOT NULL AUTO_INCREMENT,
  `Nomor_Pelayanan` varchar(50) NOT NULL,
  `Judul_Pelayanan` varchar(200) DEFAULT NULL,
  `Tanggal_Mulai` date DEFAULT NULL,
  `Tanggal_Selesai` date DEFAULT NULL,
  `Biaya` int(11) DEFAULT NULL,
  `Tanggal_Laporan_Pelaksanaan` date DEFAULT NULL,
  `Jenis_Layanan_ID_Jenis_Layanan` int(11) NOT NULL,
  `Mitra_ID_Mitra` int(11) NOT NULL,
  PRIMARY KEY (`ID_Pelayanan`,`Jenis_Layanan_ID_Jenis_Layanan`,`Mitra_ID_Mitra`),
  KEY `fk_Pelayanan_Jenis Layanan1_idx` (`Jenis_Layanan_ID_Jenis_Layanan`),
  KEY `fk_Pelayanan_Mitra1_idx` (`Mitra_ID_Mitra`),
  CONSTRAINT `fk_Pelayanan_Jenis Layanan1` FOREIGN KEY (`Jenis_Layanan_ID_Jenis_Layanan`) REFERENCES `jenis_layanan` (`ID_Jenis_Layanan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pelayanan_Mitra1` FOREIGN KEY (`Mitra_ID_Mitra`) REFERENCES `mitra` (`ID_Mitra`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.pelayanan_has_pegawai
CREATE TABLE IF NOT EXISTS `pelayanan_has_pegawai` (
  `ID_Pelayanan_has_Pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `Pelayanan_ID_Pelayanan` int(11) NOT NULL,
  `Pegawai_ID_Pegawai` int(11) NOT NULL,
  `Master_Peran_ID_Peran` int(11) NOT NULL,
  PRIMARY KEY (`ID_Pelayanan_has_Pegawai`,`Pelayanan_ID_Pelayanan`,`Pegawai_ID_Pegawai`,`Master_Peran_ID_Peran`),
  KEY `fk_Pelayanan_has_Pegawai_Pegawai1_idx` (`Pegawai_ID_Pegawai`),
  KEY `fk_Pelayanan_has_Pegawai_Pelayanan1_idx` (`Pelayanan_ID_Pelayanan`),
  KEY `fk_Pelayanan_has_Pegawai_Master Peran1_idx` (`Master_Peran_ID_Peran`),
  CONSTRAINT `fk_Pelayanan_has_Pegawai_Master Peran1` FOREIGN KEY (`Master_Peran_ID_Peran`) REFERENCES `master_peran` (`ID_Peran`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pelayanan_has_Pegawai_Pegawai1` FOREIGN KEY (`Pegawai_ID_Pegawai`) REFERENCES `pegawai` (`ID_Pegawai`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pelayanan_has_Pegawai_Pelayanan1` FOREIGN KEY (`Pelayanan_ID_Pelayanan`) REFERENCES `pelayanan` (`ID_Pelayanan`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.pendidikan
CREATE TABLE IF NOT EXISTS `pendidikan` (
  `ID_Pendidikan` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Instansi` varchar(100) DEFAULT NULL,
  `Tingkat_Pendidikan_ID_Tingkat_Pendidikan` int(11) NOT NULL,
  `Fakultas_ID_Fakultas` int(11) DEFAULT NULL,
  `Jurusan_ID_Jurusan` int(11) DEFAULT NULL,
  `Nomor_Ijazah` varchar(100) DEFAULT NULL,
  `Tanggal_Ijazah` date DEFAULT NULL,
  `Pegawai_ID_Pegawai` int(11) NOT NULL,
  PRIMARY KEY (`ID_Pendidikan`,`Tingkat_Pendidikan_ID_Tingkat_Pendidikan`,`Pegawai_ID_Pegawai`),
  KEY `fk_Pendidikan_Tingkat Pendidikan1_idx` (`Tingkat_Pendidikan_ID_Tingkat_Pendidikan`),
  KEY `fk_Pendidikan_Pegawai1_idx` (`Pegawai_ID_Pegawai`),
  KEY `fk_Fakultas_Pendidikan` (`Fakultas_ID_Fakultas`),
  KEY `fk_Jurusan_Pendidikan` (`Jurusan_ID_Jurusan`),
  CONSTRAINT `fk_Fakultas_Pendidikan` FOREIGN KEY (`Fakultas_ID_Fakultas`) REFERENCES `master_fakultas` (`ID_Fakultas`),
  CONSTRAINT `fk_Jurusan_Pendidikan` FOREIGN KEY (`Jurusan_ID_Jurusan`) REFERENCES `master_jurusan` (`ID_Jurusan`),
  CONSTRAINT `fk_Pendidikan_Pegawai1` FOREIGN KEY (`Pegawai_ID_Pegawai`) REFERENCES `pegawai` (`ID_Pegawai`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pendidikan_Tingkat Pendidikan1` FOREIGN KEY (`Tingkat_Pendidikan_ID_Tingkat_Pendidikan`) REFERENCES `tingkat_pendidikan` (`ID_Tingkat_Pendidikan`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.penugasan
CREATE TABLE IF NOT EXISTS `penugasan` (
  `ID_Penugasan` int(11) NOT NULL AUTO_INCREMENT,
  `Objek_Penugasan` varchar(100) NOT NULL,
  `Tanggal_Mulai_Penugasan` date DEFAULT NULL,
  `Nama_Penugasan` varchar(200) DEFAULT NULL,
  `Tanggal_Selesai_Penugasan` date DEFAULT NULL,
  `Pegawai_ID_Pegawai` int(11) NOT NULL,
  `Master_Peran_ID_Peran` int(11) NOT NULL,
  `Master_Penugasan_ID_Jenis_Penugasan` int(11) NOT NULL,
  PRIMARY KEY (`ID_Penugasan`,`Pegawai_ID_Pegawai`,`Master_Penugasan_ID_Jenis_Penugasan`,`Master_Peran_ID_Peran`),
  KEY `fk_Penugasan_Pegawai1_idx` (`Pegawai_ID_Pegawai`),
  KEY `fk_Penugasan_Master Peran1_idx` (`Master_Peran_ID_Peran`),
  KEY `fk_Penugasan_Master_Penugasan` (`Master_Penugasan_ID_Jenis_Penugasan`),
  CONSTRAINT `fk_Penugasan_Master_Penugasan` FOREIGN KEY (`Master_Penugasan_ID_Jenis_Penugasan`) REFERENCES `master_penugasan` (`ID_Jenis_Penugasan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Penugasan_Pegawai1` FOREIGN KEY (`Pegawai_ID_Pegawai`) REFERENCES `pegawai` (`ID_Pegawai`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Peran` FOREIGN KEY (`Master_Peran_ID_Peran`) REFERENCES `master_peran` (`ID_Peran`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.sertifikasi
CREATE TABLE IF NOT EXISTS `sertifikasi` (
  `ID_Sertifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `Lembaga_Penyelenggara` varchar(200) DEFAULT NULL,
  `No_Sertifikat` varchar(100) DEFAULT NULL,
  `Tanggal_Sertifikat` date NOT NULL,
  `Jenis_Sertifikasi_ID_Jenis_Sertifikasi` int(11) DEFAULT NULL,
  `ID_Master_Sertifikasi` int(11) DEFAULT NULL,
  `Pegawai_ID_Pegawai` int(11) NOT NULL,
  PRIMARY KEY (`ID_Sertifikasi`,`Pegawai_ID_Pegawai`),
  KEY `fk_Sertifikasi_Jenis Sertifikasi1_idx` (`Jenis_Sertifikasi_ID_Jenis_Sertifikasi`),
  KEY `fk_Sertifikasi_Pegawai1_idx` (`Pegawai_ID_Pegawai`),
  KEY `fk_Sertifikasi_Master` (`ID_Master_Sertifikasi`),
  CONSTRAINT `fk_Sertifikasi_Jenis Sertifikasi1` FOREIGN KEY (`Jenis_Sertifikasi_ID_Jenis_Sertifikasi`) REFERENCES `jenis_sertifikasi` (`ID_Jenis_Sertifikasi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Sertifikasi_Master_Sertifikasi` FOREIGN KEY (`ID_Master_Sertifikasi`) REFERENCES `master_sertifikasi` (`ID_Sertifikasi`),
  CONSTRAINT `fk_Sertifikasi_Pegawai1` FOREIGN KEY (`Pegawai_ID_Pegawai`) REFERENCES `pegawai` (`ID_Pegawai`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.susunan_kepengurusan
CREATE TABLE IF NOT EXISTS `susunan_kepengurusan` (
  `ID_Susunan_Kepengurusan` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Pengurus` varchar(120) NOT NULL,
  `Master_Posisi_Kepengurusan_idMaster_Posisi` int(11) NOT NULL,
  `Mitra_ID_Mitra` int(11) NOT NULL,
  PRIMARY KEY (`ID_Susunan_Kepengurusan`,`Master_Posisi_Kepengurusan_idMaster_Posisi`,`Mitra_ID_Mitra`),
  KEY `fk_Susunan Kepengurusan_Master Posisi Kepengurusan1_idx` (`Master_Posisi_Kepengurusan_idMaster_Posisi`),
  KEY `fk_Susunan Kepengurusan_Mitra1_idx` (`Mitra_ID_Mitra`),
  CONSTRAINT `fk_Susunan Kepengurusan_Master Posisi Kepengurusan1` FOREIGN KEY (`Master_Posisi_Kepengurusan_idMaster_Posisi`) REFERENCES `master_posisi_kepengurusan` (`idMaster_Posisi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Susunan Kepengurusan_Mitra1` FOREIGN KEY (`Mitra_ID_Mitra`) REFERENCES `mitra` (`ID_Mitra`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.tbl_login
CREATE TABLE IF NOT EXISTS `tbl_login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengguna` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL,
  `sta_aktif` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `last_login` date NOT NULL,
  PRIMARY KEY (`id_login`),
  KEY `id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=9448 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table bpkp_db.tingkat_pendidikan
CREATE TABLE IF NOT EXISTS `tingkat_pendidikan` (
  `ID_Tingkat_Pendidikan` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Tingkat_Pendidikan` varchar(100) NOT NULL,
  `Deskripsi_Tingkat_Pendidikan` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_Tingkat_Pendidikan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping structure for table bpkp_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table bpkp_db.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
	(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, 'FX1VOPX3EG0Ia/TUsjjbRO', 1268889823, 1480169890, 1, 'Admin', 'istrator', 'ADMIN', '1234567890'),
	(2, '::1', 'themusketeer17@gmail.com', '$2y$08$QDh0a1vzdZnAh0Zh1Pxi3OiL9CkDkgMJ4iOXMKFeNP82rfD8H9Cja', NULL, 'themusketeer17@gmail.com', NULL, NULL, NULL, NULL, 1478674255, NULL, 1, 'Rachmawan', 'Atmaji', 'BPPT', '082213030223'),
	(3, '::1', 'rachmawan.atmaji@bppt.go.id', '$2y$08$eDNs6huNm/N9.R.Qf9qZCuqBhwRx6bcXgmUOApHNFuqAJsO7r/JLu', NULL, 'rachmawan.atmaji@bppt.go.id', '9f00c88698b8ad5afab01ec1b184979295d14a00', 'GGitz43ju0Zl8ra0xb4zNu346005c0360780edeb', 1479647274, NULL, 1478999969, NULL, 0, 'Dwita', 'Indriarti', 'UNAIR', '09989899');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table bpkp_db.users_groups
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table bpkp_db.users_groups: ~5 rows (approximately)
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(13, 1, 1),
	(14, 1, 2),
	(17, 2, 2),
	(18, 2, 3),
	(16, 3, 1);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
