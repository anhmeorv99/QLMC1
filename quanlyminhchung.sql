-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 14, 2022 lúc 07:31 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlyminhchung`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baocao`
--

CREATE TABLE `baocao` (
  `id` int(11) NOT NULL,
  `ten_bao_cao` varchar(255) NOT NULL,
  `noi_dung` text DEFAULT NULL,
  `id_dvbc` int(11) NOT NULL,
  `kieu_bao_cao` varchar(20) NOT NULL,
  `danh_gia` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietbaocao`
--

CREATE TABLE `chitietbaocao` (
  `id_bao_cao` int(11) NOT NULL,
  `id_tieu_chi` int(11) NOT NULL,
  `id_minh_chung` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctdt`
--

CREATE TABLE `ctdt` (
  `id` int(11) NOT NULL,
  `ten_ctdt` varchar(255) NOT NULL,
  `id_dvbc` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dvbc`
--

CREATE TABLE `dvbc` (
  `id` int(11) NOT NULL,
  `ten_dvbc` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `dvbc`
--

INSERT INTO `dvbc` (`id`, `ten_dvbc`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'HUST', '0966987654', 'Đại Cồ Việt, Hà Nội', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(2, 'NEU', '0977123456', 'Giải Phóng, Hà Nội', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(3, 'NUCE', '0988765432', 'Trần Đại Nghĩa, Hà Nội', '2022-07-11 06:00:10', '2022-07-11 06:00:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `minhchung`
--

CREATE TABLE `minhchung` (
  `id` int(11) NOT NULL,
  `ten_minh_chung` varchar(255) NOT NULL,
  `kieu_minh_chung` varchar(20) NOT NULL,
  `noi_dung` text DEFAULT NULL,
  `id_dvbc` int(11) NOT NULL,
  `id_ctct` int(11) DEFAULT NULL,
  `id_tieu_chi` int(11) NOT NULL,
  `dia_diem_phat_hanh` varchar(255) NOT NULL,
  `ngay_phat_hanh` timestamp NOT NULL DEFAULT current_timestamp(),
  `ma_minh_chung` varchar(20) NOT NULL,
  `file` text DEFAULT NULL,
  `hash_file` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `minhchung`
--

INSERT INTO `minhchung` (`id`, `ten_minh_chung`, `kieu_minh_chung`, `noi_dung`, `id_dvbc`, `id_ctct`, `id_tieu_chi`, `dia_diem_phat_hanh`, `ngay_phat_hanh`, `ma_minh_chung`, `file`, `hash_file`, `created_at`, `updated_at`) VALUES
(1, 'hệ thống thông tin', 'ctdt', 'lý thuyết thông tin, truyền tin', 2, NULL, 1, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-12 13:19:30'),
(2, 'name1', 'ctdt', 'lý thuyết 1', 1, NULL, 1, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-12 13:19:34'),
(3, 'name2', 'csgd', 'lý thuyết 2', 2, NULL, 1, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-12 13:19:36'),
(4, 'name3', 'ctdt', 'lý thuyết 3', 2, NULL, 1, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-12 13:19:39'),
(5, 'name4', 'ctdt', 'lý thuyết 4', 3, NULL, 2, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-12 13:19:40'),
(6, 'name5', 'csgd', 'lý thuyết 5', 3, NULL, 2, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-12 13:19:42'),
(7, 'name6', 'csgd', 'lý thuyết 6', 1, NULL, 3, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-12 13:19:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tieuchi`
--

CREATE TABLE `tieuchi` (
  `id` int(11) NOT NULL,
  `ten_tieu_chi` varchar(255) NOT NULL,
  `loai_tieu_chi` varchar(20) NOT NULL,
  `id_tieu_chuan` int(11) NOT NULL,
  `noi_dung` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tieuchi`
--

INSERT INTO `tieuchi` (`id`, `ten_tieu_chi`, `loai_tieu_chi`, `id_tieu_chuan`, `noi_dung`, `created_at`, `updated_at`) VALUES
(1, 'tiêu chí 1', 'CSGD', 2, 'nội dung tiêu chí 1', '2022-07-11 06:00:10', '2022-07-14 05:28:27'),
(2, 'tiêu chí 2', 'CTDT', 3, 'nội dung tiêu chí 2', '2022-07-11 06:00:10', '2022-07-14 05:28:43'),
(3, 'tiêu chí 3', 'loại 2', 1, 'nội dung tiêu chí 3', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(4, 'tiêu chí 4', 'loại 1', 5, 'nội dung tiêu chí 4', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(5, 'tiêu chí 5', 'loại 4', 2, 'nội dung tiêu chí 5', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(6, 'tiêu chí 6', 'loại 2', 2, 'nội dung tiêu chí 6', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(7, 'tiêu chí 7', 'loại 3', 4, 'nội dung tiêu chí 7', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(8, 'tiêu chí 8', 'loại 3', 1, 'nội dung tiêu chí 8', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(9, 'tiêu chí 9', 'loại 4', 3, 'nội dung tiêu chí 9', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(10, 'tiêu chí 10', 'loại 2', 5, 'nội dung tiêu chí 10', '2022-07-11 06:00:10', '2022-07-11 06:00:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tieuchuan`
--

CREATE TABLE `tieuchuan` (
  `id` int(11) NOT NULL,
  `ten_tieu_chuan` varchar(255) NOT NULL,
  `noi_dung` text DEFAULT NULL,
  `loai_tieu_chuan` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tieuchuan`
--

INSERT INTO `tieuchuan` (`id`, `ten_tieu_chuan`, `noi_dung`, `loai_tieu_chuan`, `created_at`, `updated_at`) VALUES
(1, 'tiêu chuẩn 1', 'nội dung tiêu chuẩn 1', 'CSGD', '2022-07-11 06:00:10', '2022-07-11 13:36:15'),
(2, 'tiêu chuẩn 2', 'nội dung tiêu chuẩn 2', 'CTDT', '2022-07-11 06:00:10', '2022-07-11 13:36:20'),
(3, 'tiêu chuẩn 3', 'nội dung tiêu chuẩn 3', 'CSGD', '2022-07-11 06:00:10', '2022-07-14 05:26:12'),
(4, 'tiêu chuẩn 4', 'nội dung tiêu chuẩn 4', 'loại 1', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(5, 'tiêu chuẩn 5', 'nội dung tiêu chuẩn 5', 'loại 3', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(6, 'tiêu chuẩn 6', 'nội dung tiêu chuẩn 6', 'loại 2', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(7, 'tiêu chuẩn 7', 'nội dung tiêu chuẩn 7', 'loại 3', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(8, 'tiêu chuẩn 8', 'nội dung tiêu chuẩn 8', 'loại 1', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(9, 'tiêu chuẩn 9', 'nội dung tiêu chuẩn 9', 'loại 4', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(10, 'tiêu chuẩn 10', 'nội dung tiêu chuẩn 10', 'loại 2', '2022-07-11 06:00:10', '2022-07-11 06:00:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `userdvbc`
--

CREATE TABLE `userdvbc` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `id_dvbc` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `userdvbc`
--

INSERT INTO `userdvbc` (`id`, `name`, `username`, `password`, `email`, `phone`, `address`, `id_dvbc`, `created_at`, `updated_at`) VALUES
(2, 'hust', 'hust', '$2y$10$yjK66vhdAq4UAY/aPrwH2uxLivUGilpAIPl9Wc65qbAEK574exK3a', 'hust@gmail.com', '', 'Ha Noi', 1, '2022-07-12 07:34:43', '2022-07-12 07:34:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `userhddg`
--

CREATE TABLE `userhddg` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `permission` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `userhddg`
--

INSERT INTO `userhddg` (`id`, `name`, `username`, `password`, `email`, `phone`, `address`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '$2y$10$7fglZ2yz6idUz96dMHVmveyyrjCxD9mxGmqX5q.feknWKzopP.Cny', 'anh.nt060699@gmail.com', NULL, NULL, 'admin', '2022-07-10 23:02:42', '2022-07-11 06:31:12'),
(29, 'mod', 'dsa11112', '$2y$10$J3bLRVvuGvE18zYAsw0DZOz1HN5RjYNd8xuyXpdDfYDGG0byc15UW', '123@gmail.com', '121212', '', 'mod', '2022-07-13 09:49:58', '2022-07-13 21:51:15'),
(30, 'hello ae', 'hello', '$2y$10$vgKrgu3nduzoxlG1773lcOp7Qidpv6S0BzER8OZIRWjNgpmbhfYfS', 'helloae@gmail.com', NULL, '', 'mod', '2022-07-13 09:52:00', '2022-07-13 09:52:00'),
(31, 'hehehe', 'modxxx', '$2y$10$n4L0pDg38R0w2ePZGuJeB.PuWvSmD.8m5niFc5fbwJcfHl189WDWi', 'mox@gmail.com', NULL, '', 'mod', '2022-07-13 09:56:16', '2022-07-13 09:56:16'),
(32, 'asdsadsa12', 'sadsa12dsad', '$2y$10$eVtkM71kaSLommY3DVYqme3c/tMD2HVq87EC0tDH.eVrTJgUzG6d.', 'sadsadsa@gmail.com', '', '', 'mod', '2022-07-13 09:57:33', '2022-07-13 21:59:42'),
(40, 'asdsadsa123', 'sadsa112dsad', '$2y$10$5nkgOrvVioqnDtsxonV30.WJPCBGbgMv30Yru2l2/Ma8GhA7nyXRm', 'sadsads1a@gmail.com', NULL, '', 'mod', '2022-07-13 22:00:01', '2022-07-13 22:00:01');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `baocao`
--
ALTER TABLE `baocao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dvbc` (`id_dvbc`);

--
-- Chỉ mục cho bảng `chitietbaocao`
--
ALTER TABLE `chitietbaocao`
  ADD KEY `fk_proof` (`id_minh_chung`),
  ADD KEY `fk_report` (`id_bao_cao`),
  ADD KEY `fk_criteria` (`id_tieu_chi`);

--
-- Chỉ mục cho bảng `ctdt`
--
ALTER TABLE `ctdt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ctdt` (`id_dvbc`);

--
-- Chỉ mục cho bảng `dvbc`
--
ALTER TABLE `dvbc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `minhchung`
--
ALTER TABLE `minhchung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_minhchung_1` (`id_dvbc`),
  ADD KEY `fk_tieu_chi_1` (`id_tieu_chi`);

--
-- Chỉ mục cho bảng `tieuchi`
--
ALTER TABLE `tieuchi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_standard_criteria` (`id_tieu_chuan`);

--
-- Chỉ mục cho bảng `tieuchuan`
--
ALTER TABLE `tieuchuan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `userdvbc`
--
ALTER TABLE `userdvbc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_report_ei` (`id_dvbc`);

--
-- Chỉ mục cho bảng `userhddg`
--
ALTER TABLE `userhddg`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `baocao`
--
ALTER TABLE `baocao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ctdt`
--
ALTER TABLE `ctdt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `dvbc`
--
ALTER TABLE `dvbc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `minhchung`
--
ALTER TABLE `minhchung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tieuchi`
--
ALTER TABLE `tieuchi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tieuchuan`
--
ALTER TABLE `tieuchuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `userdvbc`
--
ALTER TABLE `userdvbc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `userhddg`
--
ALTER TABLE `userhddg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `baocao`
--
ALTER TABLE `baocao`
  ADD CONSTRAINT `fk_dvbc` FOREIGN KEY (`id_dvbc`) REFERENCES `dvbc` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `chitietbaocao`
--
ALTER TABLE `chitietbaocao`
  ADD CONSTRAINT `fk_criteria` FOREIGN KEY (`id_tieu_chi`) REFERENCES `tieuchi` (`id`),
  ADD CONSTRAINT `fk_proof` FOREIGN KEY (`id_minh_chung`) REFERENCES `minhchung` (`id`),
  ADD CONSTRAINT `fk_report` FOREIGN KEY (`id_bao_cao`) REFERENCES `baocao` (`id`);

--
-- Các ràng buộc cho bảng `ctdt`
--
ALTER TABLE `ctdt`
  ADD CONSTRAINT `fk_ctdt` FOREIGN KEY (`id_DVBC`) REFERENCES `dvbc` (`id`);

--
-- Các ràng buộc cho bảng `minhchung`
--
ALTER TABLE `minhchung`
  ADD CONSTRAINT `fk_minhchung_1` FOREIGN KEY (`id_dvbc`) REFERENCES `dvbc` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tieu_chi_1` FOREIGN KEY (`id_tieu_chi`) REFERENCES `tieuchi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tieuchi`
--
ALTER TABLE `tieuchi`
  ADD CONSTRAINT `fk_standard_criteria` FOREIGN KEY (`id_tieu_chuan`) REFERENCES `tieuchuan` (`id`);

--
-- Các ràng buộc cho bảng `userdvbc`
--
ALTER TABLE `userdvbc`
  ADD CONSTRAINT `fk_report_ei` FOREIGN KEY (`id_DVBC`) REFERENCES `dvbc` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


UPDATE `quanlyminhchung`.`tieuchi` SET `loai_tieu_chi` = 'CTDT' WHERE (`id` = '5');
UPDATE `quanlyminhchung`.`tieuchi` SET `loai_tieu_chi` = 'CTDT' WHERE (`id` = '9');
UPDATE `quanlyminhchung`.`tieuchi` SET `loai_tieu_chi` = 'CTDT' WHERE (`id` = '10');
UPDATE `quanlyminhchung`.`tieuchi` SET `loai_tieu_chi` = 'CSGD' WHERE (`id` = '3');
UPDATE `quanlyminhchung`.`tieuchi` SET `loai_tieu_chi` = 'CSGD' WHERE (`id` = '4');
UPDATE `quanlyminhchung`.`tieuchi` SET `loai_tieu_chi` = 'CSGD' WHERE (`id` = '6');
UPDATE `quanlyminhchung`.`tieuchi` SET `loai_tieu_chi` = 'CSGD' WHERE (`id` = '7');
UPDATE `quanlyminhchung`.`tieuchi` SET `loai_tieu_chi` = 'CSGD' WHERE (`id` = '8');


ALTER TABLE `quanlyminhchung`.`tieuchuan` 
ADD COLUMN `deleted_at` VARCHAR(45) NULL AFTER `updated_at`;
