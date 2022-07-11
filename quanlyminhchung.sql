-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 11, 2022 lúc 11:20 AM
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
  `id_DVBC` int(11) NOT NULL,
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
  `id_DVBC` int(11) NOT NULL,
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
  `ten_dvbc` int(11) NOT NULL,
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

INSERT INTO `minhchung` (`id`, `ten_minh_chung`, `kieu_minh_chung`, `noi_dung`, `ten_dvbc`, `dia_diem_phat_hanh`, `ngay_phat_hanh`, `ma_minh_chung`, `file`, `hash_file`, `created_at`, `updated_at`) VALUES
(1, 'hệ thống thông tin', 'ctdt', 'lý thuyết thông tin, truyền tin', 2, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(2, 'name1', 'ctdt', 'lý thuyết 1', 1, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(3, 'name2', 'csgd', 'lý thuyết 2', 2, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(4, 'name3', 'ctdt', 'lý thuyết 3', 2, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(5, 'name4', 'ctdt', 'lý thuyết 4', 3, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(6, 'name5', 'csgd', 'lý thuyết 5', 3, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(7, 'name6', 'csgd', 'lý thuyết 6', 1, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(8, 'name7', 'ctdt', 'lý thuyết 7', 1, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(9, 'name8', 'csgd', 'lý thuyết 8', 3, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(10, 'name9', 'csgd', 'lý thuyết 9', 2, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(11, 'name10', 'ctdt', 'lý thuyết 10', 2, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(12, 'name11', 'ctdt', 'lý thuyết 11', 2, 'Hà Nội', '2022-03-05 17:00:00', 'HTTT', 'xyz.jpg', ' ', '2022-07-11 06:00:10', '2022-07-11 06:00:10');

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
(1, 'tiêu chí 1', 'loại 1', 2, 'nội dung tiêu chí 1', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(2, 'tiêu chí 2', 'loại 3', 3, 'nội dung tiêu chí 2', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
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
(1, 'tiêu chuẩn 1', 'nội dung tiêu chuẩn 1', 'loại 1', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(2, 'tiêu chuẩn 2', 'nội dung tiêu chuẩn 2', 'loại 2', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
(3, 'tiêu chuẩn 3', 'nội dung tiêu chuẩn 3', 'loại 1', '2022-07-11 06:00:10', '2022-07-11 06:00:10'),
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
  `id_DVBC` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(20, 'mod', 'mod01', '$2y$10$IPNMDD18PqhLoJXLrMtrDe6Py2Kg/KxNzYfU0EtMSDRptPXvSU6eS', 'mod01@gmail.com', NULL, 'Ha Noi', 'mod', '2022-07-11 01:48:33', '2022-07-11 01:48:33');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `baocao`
--
ALTER TABLE `baocao`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `fk_sc_ei` (`id_DVBC`);

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
  ADD KEY `fk_minhchung_1` (`ten_dvbc`);

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
  ADD KEY `fk_report_ei` (`id_DVBC`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `userhddg`
--
ALTER TABLE `userhddg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Các ràng buộc cho các bảng đã đổ
--

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
  ADD CONSTRAINT `fk_sc_ei` FOREIGN KEY (`id_DVBC`) REFERENCES `ctdt` (`id`);

--
-- Các ràng buộc cho bảng `minhchung`
--
ALTER TABLE `minhchung`
  ADD CONSTRAINT `fk_minhchung_1` FOREIGN KEY (`ten_dvbc`) REFERENCES `dvbc` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
