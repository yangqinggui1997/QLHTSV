
INSERT INTO `khoa` (`IdKhoa`, `TenKhoa`, `NgayTL`, `ChucNang`, `created_at`, `updated_at`) VALUES
('cong_nghe_thong_tin', 'Công Nghệ Thông Tin', '2019-09-20 01:05:00', 'Đào tạo sinh viên chuyên ngành Công nghệ Thông tin.', '2019-09-20 01:05:00', '2019-09-26 10:00:00'),
('hanh_chinh', 'Hành Chính', '2019-09-20 01:05:00', 'Giải quyết các công việc liên quan đến ành chính.', '2019-09-20 01:05:00', '2019-09-19 10:00:00');

INSERT INTO `phong_ban` (`IdPB`, `IdKhoa`, `TenPB`, `created_at`, `updated_at`) VALUES
('phong_du_lieu_va_cong_nghe_thong_tin', 'cong_nghe_thong_tin', 'Phòng dữ liệu và Công nghệ Thông tin', '2019-09-20 01:08:47', '2019-09-26 10:00:00');

INSERT INTO `tinh__thanh_pho` (`IdTP`, `TenTP`, `created_at`, `updated_at`) VALUES
('67', 'An Giang', '2019-09-19 17:43:49', '2019-09-19 03:00:00');

INSERT INTO `quan__huyen` (`IdHuyen`, `IdTP`, `TenQH`, `created_at`, `updated_at`) VALUES
('840', '67', 'Thoại Sơn', '2019-09-19 17:45:37', '2019-09-27 03:00:00'),
('841', '67', 'Châu Thành', '2019-09-19 17:45:37', '2019-09-26 03:00:00');


INSERT INTO `xa__phuong__thi_tran` (`IdXa`, `IdHuyen`, `TenXa`, `created_at`, `updated_at`) VALUES
('8401', '840', 'Mỹ Phú Đông', '2019-09-19 17:46:31', '2019-09-25 03:00:00'),
('8411', '841', 'Vĩnh Trạch', '2019-09-19 17:46:31', '2019-09-26 03:00:00');

INSERT INTO `quyen_han_user` (`IdQuyen`, `TenQH`, `MoTa`, `CapDo`, `created_at`, `updated_at`) VALUES
('can_bo_cap_bo_mon', 'Cán bộ cấp bộ môn', NULL, 4, '2019-10-01 07:57:42', '2019-10-01 17:00:00'),
('can_bo_cap_khoa', 'Cán bộ cấp khoa', NULL, 3, '2019-10-26 07:17:25', '2019-10-25 17:00:00'),
('can_bo_cap_phong', 'Cán bộ cấp phòng', NULL, 4, '2019-10-26 07:17:25', '2019-10-25 17:00:00'),
('can_bo_cap_truong', 'Cán bộ cấp trường', NULL, 2, '2019-10-01 07:57:42', '2019-10-01 17:00:00'),
('master', 'Master', 'Quản lý toàn bộ hệ thống bao gồm cơ sở dữ liệu', 0, '2019-10-26 07:31:13', '2019-10-25 17:00:00'),
('quan_tri_he_thong', 'Quản trị hệ thống', NULL, 1, '2019-10-01 07:57:42', '2019-10-01 17:00:00'),
('sinh_vien', 'Sinh viên', NULL, 5, '2019-10-01 07:57:42', '2019-10-01 17:00:00');

INSERT INTO `can_bo` (`IdCB`, `email`, `IdXa`, `HoTen`, `NgaySinh`, `GioiTinh`, `DanToc`, `SCMND`, `SDT`, `STK`, `DiaChi`, `ChuyenMon`, `TrinhDo`, `CongViec`, `BacLuong`, `LoaiNV`, `HopDongTuNgay`, `HopDongDenNgay`, `Anh`, `created_at`, `updated_at`) VALUES
('CB8888888888888', 'wangxi@123.com', '8401', 'Wang Yu Ran', '1992-11-22 17:00:00', 0, 'hoa', '352397502', '0345114926', '1234567891234', 'Bình Đỉnh Sơn', 'cong_nghe_thong_tin', 'cu_nhan', 'quan_tri_he_thong', 8, 1, '2019-10-26 07:42:49', '2019-10-26 14:42:49', NULL, '2019-10-26 07:42:49', '2019-10-30 17:00:00'),
('CB9999999999998', 'wangyanran1992@gmail.com', '8411', 'Wang Yan Ran', '1992-11-22 17:00:00', 0, 'hoa', '352397502', '0345114926', '1234567894561', 'Bình Đỉnh Sơn', 'tai_chinh_ke_toan', 'cu_nhan', 'ke_toan_tai_vu', 8, 0, '2019-10-06 17:00:00', '2100-12-29 00:00:00', NULL, '2019-10-26 07:47:58', '2019-10-30 17:00:00'),
('CB9999999999999', 'duongthanhqui1997@gmail.com', '8401', 'Dương Thanh Quí', '1997-06-28 21:18:37', 1, 'kinh', '352397501', '0345114925', '1234567891234', 'Tân Mỹ', 'cong_nghe_thong_tin', 'cu_nhan', 'quan_tri_he_thong', 9, 1, '2019-09-20 21:18:37', '2019-09-21 04:18:37', NULL, '2019-09-20 21:18:37', '2019-09-26 10:00:00');

INSERT INTO `users` (`IdCBSV`, `email`, `password`, `TrangThai`, `SoLanDangNhap`, `DangNhapLC`, `remember_token`, `created_at`, `updated_at`) VALUES
('CB8888888888888', 'wangxi@123.com', '$2y$10$epoDW9a/DcRwUljYRsJyAOmJfju6P3Nh1Y9THkBKQQijZzFLaK4ua', 0, 1, '2019-10-26 08:39:13', 'iNrmM6XZgYEWK9Pm4WfjcaEsnjhoUX52QZy3N1iBEOCCCXJ5GAV8dZyiqXOP', '2019-10-26 08:39:13', '2019-10-26 12:37:25'),
('CB9999999999998', 'wanyanran1992@gmail.com', '$2y$10$H8kMF3QXiCqSodTqlqHnQ.oUTRR2QafMsnCp4gXwJlFslzHDi4N6u', 0, 0, '2019-10-26 08:40:41', NULL, '2019-10-26 08:40:41', '2019-10-25 17:00:00'),
('CB9999999999999', 'duongthanhqui1997@gmail.com', '$2y$10$lybYNG93PktovqPUDw5cf.U0nVoqkbePF3UV/iO7BF4/pjGTfoawe', 1, 1, '2019-10-01 07:39:41', '1QjKfjqZUVtPpEqM5jXeTkr4zqE9jMug7uE0nY2mndpNGVqKtHwYoLUlYuBE', '2019-09-20 21:20:12', '2019-10-26 10:08:19');

INSERT INTO `users__can_bo` (`IdCB`, `created_at`, `updated_at`) VALUES
('CB8888888888888', '2019-10-26 10:06:08', '2019-10-25 17:00:00'),
('CB9999999999998', '2019-10-26 10:06:08', '2019-10-25 17:00:00'),
('CB9999999999999', '2019-09-20 21:20:59', '2019-09-26 10:00:00');

INSERT INTO `cap_quyen_user` (`IdCBSV`, `IdQuyen`, `QuyenChinh`, `ThaoTac`, `created_at`, `updated_at`) VALUES
('CB8888888888888', 'can_bo_cap_bo_mon', 0, 'xem', '2019-10-26 08:49:56', '2019-10-25 17:00:00'),
('CB8888888888888', 'can_bo_cap_khoa', 0, 'xem', '2019-10-26 08:49:56', '2019-10-25 17:00:00'),
('CB8888888888888', 'can_bo_cap_phong', 0, 'xem', '2019-10-26 08:49:56', '2019-10-25 17:00:00'),
('CB8888888888888', 'can_bo_cap_truong', 0, 'xem', '2019-10-26 08:49:56', '2019-10-25 17:00:00'),
('CB8888888888888', 'quan_tri_he_thong', 1, 'xem|them|capnhat|saochep', '2019-10-26 08:49:56', '2019-10-25 17:00:00'),
('CB8888888888888', 'sinh_vien', 0, 'xem', '2019-10-26 08:49:56', '2019-10-25 17:00:00'),
('CB9999999999998', 'can_bo_cap_khoa', 0, 'xem', '2019-10-26 08:51:11', '2019-10-25 17:00:00'),
('CB9999999999998', 'can_bo_cap_truong', 1, 'xem|them|xoa|capnhat|saochep', '2019-10-26 08:51:11', '2019-10-25 17:00:00'),
('CB9999999999999', 'can_bo_cap_bo_mon', 0, 'xem|them|capnhat|xoa|saochep', '2019-10-26 07:22:52', '2019-10-25 17:00:00'),
('CB9999999999999', 'can_bo_cap_khoa', 0, 'xem|xoa|them|saochep|capnhat', '2019-10-26 07:22:52', '2019-10-25 17:00:00'),
('CB9999999999999', 'can_bo_cap_phong', 0, 'xem|them|capnhat|xoa|saochep', '2019-10-26 07:36:46', '2019-10-29 17:00:00'),
('CB9999999999999', 'can_bo_cap_truong', 0, 'xem|them|capnhat|xoa|saochep', '2019-10-26 07:36:46', '2019-10-27 17:00:00'),
('CB9999999999999', 'master', 1, 'xem|them|capnhat|xoa|saochep', '2019-10-26 07:36:46', '2019-10-26 17:00:00'),
('CB9999999999999', 'quan_tri_he_thong', 0, 'xem|them|xoa|capnhat|saochep', '2019-10-01 07:59:26', '2019-09-30 17:00:00'),
('CB9999999999999', 'sinh_vien', 0, 'xem|them|capnhat|xoa|saochep', '2019-10-26 07:36:46', '2019-10-26 17:00:00');

----------------------
INSERT INTO `tin_nhan` (`idTN`, `idUserGui`, `idUserNhan`, `noiDung`, `created_at`, `updated_at`) VALUES
(1, 'CB9999999999998', 'CB9999999999999', 'sfs ddf dfdfd', '2020-01-04 12:40:11', NULL),
(2, 'CB9999999999998', 'CB9999999999999', 'fsf sdfsdf dfdf dfdfd df', '2020-01-04 12:40:13', NULL),
(3, 'CB9999999999998', 'CB9999999999999', 'fdg fg', '2020-01-04 12:40:14', NULL),
(4, 'CB9999999999998', 'CB9999999999997', 'dgdg dgdg dg4', '2020-01-04 12:40:11', NULL),
(5, 'CB9999999999998', 'CB9999999999997', 'g ghfg4 454 454', '2020-01-04 12:40:11', NULL),
(6, 'CB9999999999998', 'CB9999999999997', 'fggd dgdg dgdg', '2020-01-04 12:40:11', NULL),
(7, 'CB9999999999998', 'CB9999999999996', 'ff ffgfg gfhf', '2020-01-04 12:40:11', NULL),
(8, 'CB9999999999998', 'CB9999999999996', 'hgj g564 64645hh jghj', '2020-01-04 12:40:11', NULL),
(9, 'CB9999999999998', 'CB9999999999996', 'h,hjgjg gjggjg hg', '2020-01-04 12:40:11', NULL),
(10, 'CB9999999999999', 'CB9999999999998', 'dsfs sd sd sd ds', '2020-01-04 12:40:12', NULL),
(11, 'CB9999999999999', 'CB9999999999998', 'dvd ddd', '2020-01-04 12:40:15', NULL),
(12, 'CB9999999999999', 'CB9999999999998', 'dd dfd dfdf', '2020-01-04 12:40:16', NULL),
(13, 'CB9999999999999', 'CB9999999999998', '4343 45435 34 345', '2020-01-04 12:40:17', NULL);
INSERT INTO `file_cua_tin_nhan` (`idFile`, `idTN`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 'bai1.pdf', '2020-01-04 13:40:08', NULL),
(2, 1, 'HỆ SỐ PHỤ CẤP CHỨC VỤ NGÀNH Y.docx', '2020-01-04 13:40:08', NULL),
(3, 1, 'Nội dung đề cương_Sua.docx', '2020-01-04 13:40:08', NULL),
(5, 3, 'Mẫu giấy chuyển viện.docx', '2020-01-04 13:40:08', NULL),
(6, 3, 'Trang phụ đề cương.docx', '2020-01-04 13:40:08', NULL),
(7, 10, 'laravel_starter.pdf', '2020-01-04 13:44:22', NULL),
(8, 12, 'MẪU GIẤY RA VIỆN.docx', '2020-01-04 13:47:10', NULL),
(9, 12, 'bai1.pdf', '2020-01-04 13:47:10', NULL);