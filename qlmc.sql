
-- Tài khoản Hội đồng đánh giá
CREATE TABLE UserHDDG (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  username VARCHAR(255),
  password VARCHAR(255),
  phone VARCHAR(20),
  address TEXT,
  permission VARCHAR(20),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tài khoản Đơn vị báo cáo
CREATE TABLE UserDVBC (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  username VARCHAR(255),
  password VARCHAR(255),
  phone VARCHAR(20),
  address TEXT,
  id_DVBC INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Các bài báo cáo
CREATE TABLE BaoCao(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ten_bao_cao VARCHAR(255) NOT NULL,
  noi_dung TEXT,
  id_DVBC INT NOT NULL,
  kieu_bao_cao VARCHAR(20) NOT NULL,
  danh_gia VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Chi tiết về báo cáo. tiêu chuẩn, tiêu chí, minh chứng
CREATE TABLE ChiTietBaoCao(
  id_bao_cao INT NOT NULL,
  id_tieu_chuan INT NOT NULL,
  id_tieu_chi INT NOT NULL,
  id_minh_chung INT NOT NULL
);

-- Thông tin về các đơn vị báo cáo
CREATE TABLE DVBC (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ten_dvbc VARCHAR(255) NOT NULL,
  phone VARCHAR(20) DEFAULT NULL,
  address TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Thông tin về các chương trình đào tạo
CREATE TABLE CTDT (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ten_ctdt VARCHAR(255) NOT NULL,
  id_DVBC INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Minh chứng
CREATE TABLE MinhChung (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ten_minh_chung VARCHAR(255) NOT NULL,
  kieu_minh_chung VARCHAR(20) NOT NULL,
  noi_dung TEXT,
  ten_dvbc INT NOT NULL,
  dia_diem_phat_hanh VARCHAR(255) NOT NULL,
  ngay_phat_hanh TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  ma_minh_chung VARCHAR(20) NOT NULL,
  file TEXT DEFAULT NULL,
  hash_file TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tiêu chuẩn
CREATE TABLE TieuChuan(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ten_tieu_chuan  VARCHAR(255) NOT NULL,
  noi_dung TEXT,
  loai_tieu_chuan VARCHAR(20) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tiêu chí
CREATE TABLE TieuChi (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ten_tieu_chi VARCHAR(255) NOT NULL,
  loai_tieu_chi VARCHAR(20) NOT NULL,
  id_tieu_chuan INT NOT NULL,
  noi_dung TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


ALTER TABLE ChiTietBaoCao ADD CONSTRAINT fk_proof FOREIGN KEY (id_minh_chung) REFERENCES MinhChung (id);
ALTER TABLE ChiTietBaoCao ADD CONSTRAINT fk_report FOREIGN KEY (id_bao_cao) REFERENCES BaoCao (id);
ALTER TABLE ChiTietBaoCao ADD CONSTRAINT fk_standard FOREIGN KEY (id_tieu_chuan) REFERENCES TieuChuan (id);
ALTER TABLE ChiTietBaoCao ADD CONSTRAINT fk_criteria FOREIGN KEY (id_tieu_chi) REFERENCES TieuChi (id);

ALTER TABLE TieuChi ADD CONSTRAINT fk_standard_criteria FOREIGN KEY (id_tieu_chuan) REFERENCES TieuChuan(id);

ALTER TABLE UserDVBC ADD CONSTRAINT fk_report_ei FOREIGN KEY (id_DVBC) REFERENCES DVBC(id);
ALTER TABLE CTDT ADD CONSTRAINT fk_sc_ei FOREIGN KEY (id_DVBC) REFERENCES CTDT(id);

ALTER TABLE `laravel`.`UserHDDG` 
RENAME TO  `laravel`.`userhddg` ;

ALTER TABLE `laravel`.`UserDVBC` 
RENAME TO  `laravel`.`userdvbc` ;

ALTER TABLE `laravel`.`TieuChuan` 
RENAME TO  `laravel`.`tieuchuan` ;

ALTER TABLE `laravel`.`TieuChi` 
RENAME TO  `laravel`.`tieuchi` ;

ALTER TABLE `laravel`.`MinhChung` 
RENAME TO  `laravel`.`minhchung` ;


ALTER TABLE `quanlyminhchung`.`UserHDDG` 
RENAME TO  `quanlyminhchung`.`userhddg` ;

ALTER TABLE `quanlyminhchung`.`UserDVBC` 
RENAME TO  `quanlyminhchung`.`userdvbc` ;

ALTER TABLE `quanlyminhchung`.`userhddg` 
ADD COLUMN `email` VARCHAR(45) NULL AFTER `updated_at`;

ALTER TABLE `quanlyminhchung`.`MinhChung` 
RENAME TO  `quanlyminhchung`.`minhchung` ;


INSERT INTO `quanlyminhchung`.`minhchung` (`ten_minh_chung`, `kieu_minh_chung`, `noi_dung`, `ten_dvbc`, `dia_diem_phat_hanh`, `ngay_phat_hanh`, `ma_minh_chung`, `file`, `hash_file`) VALUES ('hệ thống thông tin', 'ctdt', 'lý thuyết thông tin, truyền tin', '2', 'Hà Nội', '2022-03-06 00:00:00', 'HTTT', 'xyz.jpg', ' ');

INSERT INTO `quanlyminhchung`.`minhchung` (`ten_minh_chung`, `kieu_minh_chung`, `noi_dung`, `ten_dvbc`, `dia_diem_phat_hanh`, `ngay_phat_hanh`, `ma_minh_chung`, `file`, `hash_file`) VALUES ('name1', 'ctdt', 'lý thuyết 1', '1', 'Hà Nội', '2022-03-06 00:00:00', 'HTTT', 'xyz.jpg', ' ');
INSERT INTO `quanlyminhchung`.`minhchung` (`ten_minh_chung`, `kieu_minh_chung`, `noi_dung`, `ten_dvbc`, `dia_diem_phat_hanh`, `ngay_phat_hanh`, `ma_minh_chung`, `file`, `hash_file`) VALUES ('name2', 'csgd', 'lý thuyết 2', '2', 'Hà Nội', '2022-03-06 00:00:00', 'HTTT', 'xyz.jpg', ' ');
INSERT INTO `quanlyminhchung`.`minhchung` (`ten_minh_chung`, `kieu_minh_chung`, `noi_dung`, `ten_dvbc`, `dia_diem_phat_hanh`, `ngay_phat_hanh`, `ma_minh_chung`, `file`, `hash_file`) VALUES ('name3', 'ctdt', 'lý thuyết 3', '2', 'Hà Nội', '2022-03-06 00:00:00', 'HTTT', 'xyz.jpg', ' ');
INSERT INTO `quanlyminhchung`.`minhchung` (`ten_minh_chung`, `kieu_minh_chung`, `noi_dung`, `ten_dvbc`, `dia_diem_phat_hanh`, `ngay_phat_hanh`, `ma_minh_chung`, `file`, `hash_file`) VALUES ('name4', 'ctdt', 'lý thuyết 4', '3', 'Hà Nội', '2022-03-06 00:00:00', 'HTTT', 'xyz.jpg', ' ');
INSERT INTO `quanlyminhchung`.`minhchung` (`ten_minh_chung`, `kieu_minh_chung`, `noi_dung`, `ten_dvbc`, `dia_diem_phat_hanh`, `ngay_phat_hanh`, `ma_minh_chung`, `file`, `hash_file`) VALUES ('name5', 'csgd', 'lý thuyết 5', '3', 'Hà Nội', '2022-03-06 00:00:00', 'HTTT', 'xyz.jpg', ' ');
INSERT INTO `quanlyminhchung`.`minhchung` (`ten_minh_chung`, `kieu_minh_chung`, `noi_dung`, `ten_dvbc`, `dia_diem_phat_hanh`, `ngay_phat_hanh`, `ma_minh_chung`, `file`, `hash_file`) VALUES ('name6', 'csgd', 'lý thuyết 6', '1', 'Hà Nội', '2022-03-06 00:00:00', 'HTTT', 'xyz.jpg', ' ');
INSERT INTO `quanlyminhchung`.`minhchung` (`ten_minh_chung`, `kieu_minh_chung`, `noi_dung`, `ten_dvbc`, `dia_diem_phat_hanh`, `ngay_phat_hanh`, `ma_minh_chung`, `file`, `hash_file`) VALUES ('name7', 'ctdt', 'lý thuyết 7', '1', 'Hà Nội', '2022-03-06 00:00:00', 'HTTT', 'xyz.jpg', ' ');
INSERT INTO `quanlyminhchung`.`minhchung` (`ten_minh_chung`, `kieu_minh_chung`, `noi_dung`, `ten_dvbc`, `dia_diem_phat_hanh`, `ngay_phat_hanh`, `ma_minh_chung`, `file`, `hash_file`) VALUES ('name8', 'csgd', 'lý thuyết 8', '3', 'Hà Nội', '2022-03-06 00:00:00', 'HTTT', 'xyz.jpg', ' ');
INSERT INTO `quanlyminhchung`.`minhchung` (`ten_minh_chung`, `kieu_minh_chung`, `noi_dung`, `ten_dvbc`, `dia_diem_phat_hanh`, `ngay_phat_hanh`, `ma_minh_chung`, `file`, `hash_file`) VALUES ('name9', 'csgd', 'lý thuyết 9', '2', 'Hà Nội', '2022-03-06 00:00:00', 'HTTT', 'xyz.jpg', ' ');
INSERT INTO `quanlyminhchung`.`minhchung` (`ten_minh_chung`, `kieu_minh_chung`, `noi_dung`, `ten_dvbc`, `dia_diem_phat_hanh`, `ngay_phat_hanh`, `ma_minh_chung`, `file`, `hash_file`) VALUES ('name10', 'ctdt', 'lý thuyết 10', '2', 'Hà Nội', '2022-03-06 00:00:00', 'HTTT', 'xyz.jpg', ' ');
INSERT INTO `quanlyminhchung`.`minhchung` (`ten_minh_chung`, `kieu_minh_chung`, `noi_dung`, `ten_dvbc`, `dia_diem_phat_hanh`, `ngay_phat_hanh`, `ma_minh_chung`, `file`, `hash_file`) VALUES ('name11', 'ctdt', 'lý thuyết 11', '2', 'Hà Nội', '2022-03-06 00:00:00', 'HTTT', 'xyz.jpg', ' ');


ALTER TABLE `quanlyminhchung`.`TieuChuan` 
RENAME TO  `quanlyminhchung`.`tieuchuan` ;


ALTER TABLE `quanlyminhchung`.`TieuChi` 
RENAME TO  `quanlyminhchung`.`tieuchi` ;


INSERT INTO `quanlyminhchung`.`tieuchuan` (`ten_tieu_chuan`, `noi_dung`, `loai_tieu_chuan`) VALUES ('tiêu chuẩn 1', 'nội dung tiêu chuẩn 1', 'loại 1');
INSERT INTO `quanlyminhchung`.`tieuchuan` (`ten_tieu_chuan`, `noi_dung`, `loai_tieu_chuan`) VALUES ('tiêu chuẩn 2', 'nội dung tiêu chuẩn 2', 'loại 2');
INSERT INTO `quanlyminhchung`.`tieuchuan` (`ten_tieu_chuan`, `noi_dung`, `loai_tieu_chuan`) VALUES ('tiêu chuẩn 3', 'nội dung tiêu chuẩn 3', 'loại 1');
INSERT INTO `quanlyminhchung`.`tieuchuan` (`ten_tieu_chuan`, `noi_dung`, `loai_tieu_chuan`) VALUES ('tiêu chuẩn 4', 'nội dung tiêu chuẩn 4', 'loại 1');
INSERT INTO `quanlyminhchung`.`tieuchuan` (`ten_tieu_chuan`, `noi_dung`, `loai_tieu_chuan`) VALUES ('tiêu chuẩn 5', 'nội dung tiêu chuẩn 5', 'loại 3');
INSERT INTO `quanlyminhchung`.`tieuchuan` (`ten_tieu_chuan`, `noi_dung`, `loai_tieu_chuan`) VALUES ('tiêu chuẩn 6', 'nội dung tiêu chuẩn 6', 'loại 2');
INSERT INTO `quanlyminhchung`.`tieuchuan` (`ten_tieu_chuan`, `noi_dung`, `loai_tieu_chuan`) VALUES ('tiêu chuẩn 7', 'nội dung tiêu chuẩn 7', 'loại 3');
INSERT INTO `quanlyminhchung`.`tieuchuan` (`ten_tieu_chuan`, `noi_dung`, `loai_tieu_chuan`) VALUES ('tiêu chuẩn 8', 'nội dung tiêu chuẩn 8', 'loại 1');
INSERT INTO `quanlyminhchung`.`tieuchuan` (`ten_tieu_chuan`, `noi_dung`, `loai_tieu_chuan`) VALUES ('tiêu chuẩn 9', 'nội dung tiêu chuẩn 9', 'loại 4');
INSERT INTO `quanlyminhchung`.`tieuchuan` (`ten_tieu_chuan`, `noi_dung`, `loai_tieu_chuan`) VALUES ('tiêu chuẩn 10', 'nội dung tiêu chuẩn 10', 'loại 2');


INSERT INTO `quanlyminhchung`.`tieuchi` (`ten_tieu_chi`, `noi_dung`, `loai_tieu_chi`,`id_tieu_chuan`) VALUES ('tiêu chí 1', 'nội dung tiêu chí 1', 'loại 1', '2');
INSERT INTO `quanlyminhchung`.`tieuchi` (`ten_tieu_chi`, `noi_dung`, `loai_tieu_chi`,`id_tieu_chuan`) VALUES ('tiêu chí 2', 'nội dung tiêu chí 2', 'loại 3', '3');
INSERT INTO `quanlyminhchung`.`tieuchi` (`ten_tieu_chi`, `noi_dung`, `loai_tieu_chi`,`id_tieu_chuan`) VALUES ('tiêu chí 3', 'nội dung tiêu chí 3', 'loại 2', '1');
INSERT INTO `quanlyminhchung`.`tieuchi` (`ten_tieu_chi`, `noi_dung`, `loai_tieu_chi`,`id_tieu_chuan`) VALUES ('tiêu chí 4', 'nội dung tiêu chí 4', 'loại 1', '5');
INSERT INTO `quanlyminhchung`.`tieuchi` (`ten_tieu_chi`, `noi_dung`, `loai_tieu_chi`,`id_tieu_chuan`) VALUES ('tiêu chí 5', 'nội dung tiêu chí 5', 'loại 4', '2');
INSERT INTO `quanlyminhchung`.`tieuchi` (`ten_tieu_chi`, `noi_dung`, `loai_tieu_chi`,`id_tieu_chuan`) VALUES ('tiêu chí 6', 'nội dung tiêu chí 6', 'loại 2', '2');
INSERT INTO `quanlyminhchung`.`tieuchi` (`ten_tieu_chi`, `noi_dung`, `loai_tieu_chi`,`id_tieu_chuan`) VALUES ('tiêu chí 7', 'nội dung tiêu chí 7', 'loại 3', '4');
INSERT INTO `quanlyminhchung`.`tieuchi` (`ten_tieu_chi`, `noi_dung`, `loai_tieu_chi`,`id_tieu_chuan`) VALUES ('tiêu chí 8', 'nội dung tiêu chí 8', 'loại 3', '1');
INSERT INTO `quanlyminhchung`.`tieuchi` (`ten_tieu_chi`, `noi_dung`, `loai_tieu_chi`,`id_tieu_chuan`) VALUES ('tiêu chí 9', 'nội dung tiêu chí 9', 'loại 4', '3');
INSERT INTO `quanlyminhchung`.`tieuchi` (`ten_tieu_chi`, `noi_dung`, `loai_tieu_chi`,`id_tieu_chuan`) VALUES ('tiêu chí 10', 'nội dung tiêu chí 10', 'loại 2', '5');


INSERT INTO `quanlyminhchung`.`DVBC` (`ten_dvbc`, `phone`, `address`) VALUES ('HUST', '0966987654', 'Đại Cồ Việt, Hà Nội');
INSERT INTO `quanlyminhchung`.`DVBC` (`ten_dvbc`, `phone`, `address`) VALUES ('NEU', '0977123456', 'Giải Phóng, Hà Nội');
INSERT INTO `quanlyminhchung`.`DVBC` (`ten_dvbc`, `phone`, `address`) VALUES ('NUCE', '0988765432', 'Trần Đại Nghĩa, Hà Nội');


ALTER TABLE `quanlyminhchung`.`minhchung` 
ADD CONSTRAINT `fk_minhchung_1`
  FOREIGN KEY (`ten_dvbc`)
  REFERENCES `quanlyminhchung`.`DVBC` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


ALTER TABLE `quanlyminhchung`.`DVBC` 
RENAME TO  `quanlyminhchung`.`dvbc` ;


select minhchung.*, dvbc.ten_dvbc 
from minhchung
left join dvbc
on dvbc.id = minhchung.ten_dvbc
where minhchung.kieu_minh_chung='csgd'