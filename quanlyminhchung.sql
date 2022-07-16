-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 16, 2022 lúc 10:50 AM
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
-- Cấu trúc bảng cho bảng `ctdt`
--

CREATE TABLE `ctdt` (
  `id` int(11) NOT NULL,
  `ten_ctdt` varchar(255) NOT NULL,
  `id_dvbc` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ctdt`
--

INSERT INTO `ctdt` (`id`, `ten_ctdt`, `id_dvbc`, `created_at`, `updated_at`) VALUES
(1, 'HEDSPI', 1, '2022-07-15 04:07:23', '2022-07-15 04:07:23'),
(2, 'ASIS', 1, '2022-07-15 04:07:23', '2022-07-15 04:07:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia`
--

CREATE TABLE `danhgia` (
  `id` int(11) NOT NULL,
  `id_dvbc` int(11) NOT NULL,
  `id_tieu_chi` int(11) NOT NULL,
  `danh_gia` int(11) DEFAULT NULL,
  `tu_danh_gia` int(11) DEFAULT NULL,
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
(1, 'HUST', '0123913123', 'Đại Cồ Việt, Hà Nội', '2022-07-15 04:06:08', '2022-07-15 04:06:45'),
(2, 'NEU', '0977123456', 'Giải Phóng, Hà Nội', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(3, 'NUCE', '0988765432', 'Trần Đại Nghĩa, Hà Nội', '2022-07-11 06:00:10', '2022-07-11 06:00:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `minhchung`
--

CREATE TABLE `minhchung` (
  `id` int(11) NOT NULL,
  `ten_minh_chung` varchar(255) NOT NULL,
  `noi_dung` text DEFAULT NULL,
  `id_dvbc` int(11) NOT NULL,
  `id_ctdt` int(11) DEFAULT NULL,
  `id_tieu_chi` int(11) NOT NULL,
  `file` text DEFAULT NULL,
  `hash_file` text DEFAULT NULL,
  `duyet` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `minhchung`
--

INSERT INTO `minhchung` (`id`, `ten_minh_chung`, `noi_dung`, `id_dvbc`, `id_ctdt`, `id_tieu_chi`, `file`, `hash_file`, `duyet`, `created_at`, `updated_at`) VALUES
(25, 'asdasdas', 'asdasdsa', 1, 1, 12, 'keymap.txt', '5298a6ffff4d8789245b6781b7843038.txt', 'ACCEPTED', '2022-07-15 12:47:05', '2022-07-16 01:19:19'),
(26, 'sdsad2', 'asdasda', 1, 1, 12, 'ĐGTV_ Nguyễn Tuấn Anh.docx', 'ff0229da50ac56a0f1bac414d6621b4f.docx', 'ACCEPTED', '2022-07-15 12:47:35', '2022-07-16 01:21:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tieuchi`
--

CREATE TABLE `tieuchi` (
  `id` int(11) NOT NULL,
  `ten_tieu_chi` varchar(255) NOT NULL,
  `id_tieu_chuan` int(11) NOT NULL,
  `noi_dung` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tieuchi`
--

INSERT INTO `tieuchi` (`id`, `ten_tieu_chi`, `id_tieu_chuan`, `noi_dung`, `created_at`, `updated_at`) VALUES
(12, 'Tiêu Chí 1', 13, '123', '2022-07-14 21:41:54', '2022-07-14 22:04:01'),
(13, 'Hello', 13, '123', '2022-07-14 22:06:24', '2022-07-14 22:06:24'),
(14, 'SuperAdmin', 13, '232', '2022-07-14 22:10:30', '2022-07-14 22:10:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tieuchuan`
--

CREATE TABLE `tieuchuan` (
  `id` int(11) NOT NULL,
  `ten_tieu_chuan` varchar(255) NOT NULL,
  `loai_tieu_chuan` varchar(255) NOT NULL,
  `noi_dung` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tieuchuan`
--

INSERT INTO `tieuchuan` (`id`, `ten_tieu_chuan`, `loai_tieu_chuan`, `noi_dung`, `created_at`, `updated_at`) VALUES
(13, 'Tiêu Chuẩn 1', 'CSGD', 'CSGD2', '2022-07-14 21:40:38', '2022-07-16 06:45:07'),
(14, 'Tiêu Chuẩn 2', 'CTDT', 'OK', '2022-07-14 21:53:37', '2022-07-14 21:53:37');

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
(2, 'hust', 'hust', '$2y$10$yjK66vhdAq4UAY/aPrwH2uxLivUGilpAIPl9Wc65qbAEK574exK3a', 'hust@gmail.com', '', 'Ha Noi', 1, '2022-07-12 07:34:43', '2022-07-12 07:34:43'),
(3, 'HNUE', 'hnue1', '$2y$10$.zz4w..DCw/XgGi1.h7k6Or0Stzj15EQkCEv7zuEuaf8iwoxIv32m', 'hnue@gmail.com', '', '', 2, '2022-07-15 08:19:34', '2022-07-15 08:19:49'),
(4, 'Anh Nguyen', 'anhnt', '$2y$10$t4Z5zrA.qQcZNJwEoUV7N.EyyYCVNzW.2Nqfd9Wi.JJlOkGjAQR1.', 'anh.nt060699@gmail.com', '0912912231', '209 Doi Can, Ba Dinh', 1, '2022-07-15 08:32:08', '2022-07-15 08:32:08');

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
(41, 'Anh', 'anhh', '$2y$10$ywrHaDRQu3y3tBD7wzJb3Ok3dVJhhD1Q6.ds2HbX2Wmt9tfj4LQ2.', 'anh1@gmail.com', NULL, '', 'mod', '2022-07-14 22:02:11', '2022-07-14 22:02:11'),
(42, 'Anh2', 'anh2', '$2y$10$GttVEKFjZCGsffKhLjBboOZUZyLfSqn53a2oVIscOonN/jVQh94G6', 'anh2@gmail.com', NULL, '', 'mod', '2022-07-14 22:04:53', '2022-07-14 22:04:53');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ctdt`
--
ALTER TABLE `ctdt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ctdt` (`id_dvbc`);

--
-- Chỉ mục cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dvbc` (`id_dvbc`),
  ADD KEY `fk_tieu_chi` (`id_tieu_chi`);

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
  ADD KEY `fk_tieu_chi_1` (`id_tieu_chi`),
  ADD KEY `fk_mc_dvbc` (`id_dvbc`);

--
-- Chỉ mục cho bảng `tieuchi`
--
ALTER TABLE `tieuchi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tieuchi_tieuchuan` (`id_tieu_chuan`);

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
  ADD KEY `fk_user_dvbc` (`id_dvbc`);

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
-- AUTO_INCREMENT cho bảng `ctdt`
--
ALTER TABLE `ctdt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `danhgia`
--
ALTER TABLE `danhgia`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `tieuchi`
--
ALTER TABLE `tieuchi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tieuchuan`
--
ALTER TABLE `tieuchuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `userdvbc`
--
ALTER TABLE `userdvbc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `userhddg`
--
ALTER TABLE `userhddg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `ctdt`
--
ALTER TABLE `ctdt`
  ADD CONSTRAINT `fk_ctdt` FOREIGN KEY (`id_dvbc`) REFERENCES `dvbc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `fk_dvbc` FOREIGN KEY (`id_dvbc`) REFERENCES `dvbc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tieu_chi` FOREIGN KEY (`id_tieu_chi`) REFERENCES `tieuchi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `minhchung`
--
ALTER TABLE `minhchung`
  ADD CONSTRAINT `fk_mc_dvbc` FOREIGN KEY (`id_dvbc`) REFERENCES `dvbc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tieu_chi_1` FOREIGN KEY (`id_tieu_chi`) REFERENCES `tieuchi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tieuchi`
--
ALTER TABLE `tieuchi`
  ADD CONSTRAINT `fk_tieuchi_tieuchuan` FOREIGN KEY (`id_tieu_chuan`) REFERENCES `tieuchuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `userdvbc`
--
ALTER TABLE `userdvbc`
  ADD CONSTRAINT `fk_user_dvbc` FOREIGN KEY (`id_dvbc`) REFERENCES `dvbc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
