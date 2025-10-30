-- Adminer 4.8.1 MySQL 5.7.39 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `assignment`;
CREATE TABLE `assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materi_id` int(11) DEFAULT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `materi_id` (`materi_id`),
  CONSTRAINT `assignment_ibfk_5` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `assignment_submission`;
CREATE TABLE `assignment_submission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assignment_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` enum('Belum Mengumpulkan','Sudah Mengumpulkan','Terlambat') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assignment_id` (`assignment_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `assignment_submission_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignment` (`id`),
  CONSTRAINT `assignment_submission_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `class`;
CREATE TABLE `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `class` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'TKJ 1',	'2025-10-21 07:48:23',	'2025-10-21 07:48:23'),
(2,	'TKJ 2',	'2025-10-21 07:48:30',	'2025-10-21 07:48:30'),
(3,	'TKJ 3',	'2025-10-21 07:48:38',	'2025-10-21 08:24:31'),
(4,	'TKJ 4',	'2025-10-27 16:27:14',	'2025-10-27 16:27:14'),
(7,	'TKJ 5',	'2025-10-27 16:29:54',	'2025-10-27 16:29:54');

DROP TABLE IF EXISTS `lesson`;
CREATE TABLE `lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `user_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lesson_attendance`;
CREATE TABLE `lesson_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_schedule_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` enum('Hadir','Tidak Hadir') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lesson_schedule_id` (`lesson_schedule_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `lesson_attendance_ibfk_1` FOREIGN KEY (`lesson_schedule_id`) REFERENCES `lesson_schedule` (`id`),
  CONSTRAINT `lesson_attendance_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lesson_schedule`;
CREATE TABLE `lesson_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `room` varchar(100) NOT NULL,
  `day` varchar(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_absensi` enum('Y','N') NOT NULL DEFAULT 'N',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lesson_id` (`lesson_id`),
  KEY `class_id` (`class_id`),
  CONSTRAINT `lesson_schedule_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`),
  CONSTRAINT `lesson_schedule_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `materi`;
CREATE TABLE `materi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lesson_id` (`lesson_id`),
  CONSTRAINT `materi_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `notifikasi`;
CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` enum('Guru','Murid') NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` longtext,
  `is_seen` enum('Y','N') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nomor_induk` bigint(20) DEFAULT NULL,
  `role` enum('Guru','Murid','Admin') NOT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `alamat` longtext,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `email`, `password`, `nama_lengkap`, `nomor_induk`, `role`, `jurusan`, `class_id`, `alamat`, `gambar`, `created_at`, `updated_at`) VALUES
(1,	'admin@gmail.com',	'admin123',	'admin',	NULL,	'Admin',	NULL,	NULL,	NULL,	NULL,	'2025-10-21 07:47:21',	'2025-10-21 07:47:21'),
(2,	'guru@gmail.com',	'guru123',	'guru',	1223456,	'Guru',	'TKJ',	2,	'Jl alamat',	NULL,	'2025-10-21 07:48:54',	'2025-10-21 07:48:54'),
(3,	'murid@gmail.com',	'murid123',	'murid1',	912873123,	'Murid',	'TKJ',	1,	'jl murid murid1',	'1761780698__000c2c7d-3f00-49ab-8db5-37b6951fea1c.jpeg',	'2025-10-30 06:31:38',	'2025-10-30 06:31:38'),
(5,	'guru2@gmail.com',	'$2y$10$CYUecq1tELQOVSxOWvajQOBAlkK/HzlAzGytTq23i.cZ6J5yLhj3q',	'guru 2',	12318971321,	'Guru',	NULL,	NULL,	NULL,	NULL,	'2025-10-29 19:25:09',	'2025-10-29 19:25:09'),
(6,	'admin22@mail.com',	'murid123',	'murid1',	1231897132,	'Murid',	NULL,	1,	'Jl. Simowau Baru Gg Durian, Sidoarjo',	'LOGO SIMARA BG BIRU.png',	'2025-10-29 19:38:03',	'2025-10-29 19:38:03'),
(7,	'adminss@mail.com',	'asdadasd',	'asdad',	1232139,	'Murid',	NULL,	2,	'asdad',	'1761783942__1a596d16-5bfe-438a-82e2-0e0d5a812c38.jpeg',	'2025-10-30 07:25:42',	'2025-10-30 07:25:42');

-- 2025-10-30 13:59:44
