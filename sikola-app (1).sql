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
  `file` varchar(255) NOT NULL,
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
(3,	'TKJ 3',	'2025-10-21 07:48:38',	'2025-10-21 08:24:31');

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

INSERT INTO `lesson` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1,	'MTK',	2,	'2025-10-21 08:32:04',	'2025-10-21 08:32:04');

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
  `time` time NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lesson_id` (`lesson_id`),
  KEY `class_id` (`class_id`),
  CONSTRAINT `lesson_schedule_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`),
  CONSTRAINT `lesson_schedule_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lesson_schedule` (`id`, `lesson_id`, `class_id`, `room`, `day`, `time`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	'TKJ 1',	'Monday',	'07:00:00',	'2025-10-21 08:36:51',	'2025-10-21 08:36:51');

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

INSERT INTO `materi` (`id`, `lesson_id`, `judul`, `deskripsi`, `file`, `gambar`, `created_at`, `updated_at`) VALUES
(1,	1,	'mtk kabataku',	'<p>adsasd</p>',	NULL,	'my-foto-terbaru.png',	'2025-10-21 09:16:40',	'2025-10-21 09:16:40');

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

INSERT INTO `notifikasi` (`id`, `role`, `judul`, `deskripsi`, `is_seen`, `created_at`, `updated_at`) VALUES
(1,	'Murid',	'Materi baru dengan judul \'mtk kabataku\' telah diunggah, yuk pelajari !!!',	NULL,	'N',	'2025-10-21 09:16:40',	'2025-10-21 09:16:40');

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
  `nomor_induk` int(20) DEFAULT NULL,
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
(3,	'murid1@gmail.com',	'murid123',	'murid1',	912873123,	'Murid',	'TKJ',	1,	'jl murid murid1',	'dyta-profile.jpeg',	'2025-10-21 08:01:26',	'2025-10-21 08:01:26');

-- 2025-10-24 15:57:08
