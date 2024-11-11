-- In MySQL --

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `khach_hang` (
  `maKH` varchar(4) NOT NULL,
  `tenKH` varchar(100),
  `email` varchar(100),
  `sdt` varchar(10),
  `matKhau` varchar(50),
  `diaChi` varchar(200)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `khach_hang`  VALUES
('0000', 'admin'          , 'quan.na.63cntt@ntu.edu.vn' , ''          , '21232f297a57a5a743894a0e4a801fc3', ''                                ),
('0001', 'Nguyễn Anh Quân', 'anhquan300503@gmail.com'   , '0398090114', '50baf05c8bc18b1c3d13d91a804051d6', 'KTX K7 Trường Đại học Nha Trang' ),
('0002', 'Nguyễn Tiến Đạt', 'dat@gmail.com'             , '0398090111', 'e108177f8c3bb6f94ce0750f35a7c354', 'Nha Trang'                       );



-- --------------------------------------------------------
CREATE TABLE `loai_sach` (
  `maLS` varchar(4) NOT NULL,
  `tenLS` varchar(100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `loai_sach` (`maLS`, `tenLS`) VALUES
('0000', 'Tiểu thuyết'),
('0001', 'Ngôn tình'  ),
('0002', 'Trinh thám'  ),
('0003', 'Lịch sử'    ),
('0004', 'Self - help');



-- --------------------------------------------------------
CREATE TABLE `sach` (
  `maSach` varchar(4) NOT NULL,
  `tenSach` varchar(100),
  `maLS` varchar(4),
  `moTa` varchar(256),
  `giaTien` int(11),
  `soLuong` int(11),
  `tacGia` varchar(256),
  `hinhAnh` varchar(256)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `sach` (`maSach`, `tenSach`, `maLS`, `moTa`, `giaTien`, `soLuong`, `tacGia`, `hinhAnh`) VALUES('0000', 'Sherlock Holmes: The Complete Novels and Stories', '0000', 'Là bộ sưu tập các tiểu thuyết và truyện ngắn về Sherlock Holmes, thám tử huyền thoại nổi tiếng với tài suy luận đỉnh cao', 250000, 30, 'Arthur Conan Doyle', '0000.jpg'),
('0001', 'Harry Potter và Hòn Đá Phù Thủy'                , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 12700, 10, 'J.K.Rowling'         , '0001.jpg'),
('0002', 'Harry Potter và Phòng Chứa Bí Mật'              , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13000, 10, 'J.K.Rowling'         , '0002.jpg'),
('0003', 'Harry Potter và tên Tù Nhân Ngục Azkaban'       , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13500, 10, 'J.K.Rowling'         , '0003.jpg'),
('0004', 'Harry Potter và Chiếc Cốc Lửa'                  , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13000, 10, 'J.K.Rowling'         , '0004.jpg'),
('0005', 'Harry Potter và Hội Phượng Hoàng'               , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13000, 10, 'J.K.Rowling'         , '0005.jpg'),
('0006', 'Harry Potter và Hoàng Tử Lai'                   , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 15500, 10, 'J.K.Rowling'         , '0006.jpg'),
('0007', 'Harry Potter và Bảo Bối Tử Thần'                , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 19900, 10, 'J.K.Rowling'         , '0007.jpg'),
('0008', 'Mắt Biếc'                                       , '0001' , 'Cuốn sách nói về tình yêu thanh thiếu niên'                      , 29900, 10, 'Nguyễn Nhật Ánh'     , '0008.jpg'),
('0009', 'Những Đứa Con Rải Rác Trên Đường'               , '0000' , 'Cuốn sách nói về cuộc sống xã hội bất công với những đứa trẻ'    , 17500, 07, 'Hồ Anh Thái'         , '0009.jpg'),
('0010', 'Đà Lạt -Một thời phương xa'                     , '0000' , 'Cuốn sách nói về cuộc sống của người dân Đà Lạt'                 , 10600, 10, 'Phạm Duy'            , '0010.jpg'),
('0011', 'Dòng sông không trở lại'                        , '0000' , 'Nói về những Những ký ức tười đẹp của tuổi thanh xuân'           , 21000, 12, 'Vi Thuỳ Linh'        , '0011.jpg'),
('0012', 'Cho tôi xin một vé đi tuổi thơ'                 , '0000' , 'Nói về những kỹ niệm tưởng nhớ tuổi thơ'                         , 9000 , 10, 'Nguyễn Nhật Ánh'     , '0012.jpg'),
('0013', 'Bên nhau trọn đời'                              , '0000' , 'Nói về những biến cố diễn ra của 2 nhân vật chính'               , 17500, 20, 'Trích Tân'           , '0013.jpg'),
('0014', 'Truyện Kiều'                                    , '0001' , 'Nói về Cuộc sống chông gai của người con gái thời xưa'           , 7000 , 10, 'Nguyễn Du'           , '0014.jpg'),
('0015', 'Dế mèn phiêu lưu ký'                            , '0002' , 'Nói về những cuộc phiêu lưu hấp dẫn của chú dế mèn'              , 4000 , 21, 'Bùi Anh Tuấn'        , '0015.jpg'),
('0016', 'Thiên đường mười giờ'                           , '0002' , 'Nói về những mĩ quan đẹp trên thế giới vào đúng thời điểm'       , 10000, 12, 'Lê Lựu'              , '0016.jpg'),
('0017', 'Đất rừng Phương Nam'                            , '0003' , 'Nói về những mỹ quan, văn hóa của người dân Đất Nam'             , 20000, 10, 'Hồ Biểu Chánh'       , '0017.jpg'),
('0018', 'Sông Đời'                                       , '0000' , 'Nói về những thăng trầm chông gai của cuộc đời và cách vượt qua' , 21000, 19, 'Đoàn Thạch Biền'     , '0018.jpg'),
('0019', 'Gạo nếp gạo tẻ'                                 , '0000' , 'Nói về những định kiến nam và nữ trong xã hội ngày xưa và nay'   , 6900 , 22, 'Huyền Anh'           , '0019.jpg'),
('0020', 'Nhà giả Kim'                                    , '0004' , 'Nói về cậu bé chăn cừu và cuộc đời của cậu'                      , 11000, 10, 'Paulo Coelho'        , '0020.jpg'),
('0021', 'Đắc nhân tâm'                                   , '0004' , 'Nói về những cách sống và chỉ dạy cách sống đúng nghĩa'          , 12000, 30, 'NDale Carnegie'      , '0021.jpg'),
('0022', 'Cách nghĩ để thành công'                        , '0004' , 'Nói về những cách suy nghĩ tích cực để có được thành công'       , 4500 , 10, 'Napoleon Hill'       , '0022.jpg'),
('0023', 'Quảng gánh lo đi và vui sống'                   , '0004' , 'Nói về những gánh nặng của cuộc sống và cách vượt qua chúng'     , 9900 , 22, 'David J.Lieberman'   , '0023.jpg'),
('0024', 'Đọc vị bất kỳ ai'                               , '0004' , 'Nói về những cách đọc vị, nắm bắt được tâm lý của người khác'    , 7500 , 10, 'Mario Puzo'          , '0024.jpg'),
('0025', 'Tiểu thuyết bố già'                             , '0000' , 'Nói về cuộc sống của những người bố trong gia đình'              , 10000, 10, 'Nick Vujicic'        , '0025.jpg'),
('0026', 'Cuộc sống không giới hạn'                       , '0004' , 'Nói về cách sống ý nghĩa khi chúng ta còn có thể'                , 9700 , 10, 'Andrew Matthews'     , '0026.jpg'),
('0027', 'Đời thay đổi khi chúng ta thay đổi'             , '0004' , 'Chỉ dẫn chúng ta sống đúng là tích cực để thay đổi cuộc sống'    , 15000, 12, 'George Samuel Clason', '0027.jpg'),
('0028', 'Người giàu có nhất thành BabyLon'               , '0004' , 'Dạy chúng ta suy nghĩ như những người có tiền'                   , 8500 , 18, 'Vũ Trọng Phụng'      , '0028.jpg'),

('0029', 'Sherlock Holmes: The Complete Novels and Stories', '0000', 'Là bộ sưu tập các tiểu thuyết và truyện ngắn về Sherlock Holmes, thám tử huyền thoại nổi tiếng với tài suy luận đỉnh cao', 250000, 30, 'Arthur Conan Doyle', '0000.jpg'),
('0030', 'Harry Potter và Hòn Đá Phù Thủy'                , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 12700, 10, 'J.K.Rowling'         , '0001.jpg'),
('0031', 'Harry Potter và Phòng Chứa Bí Mật'              , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13000, 10, 'J.K.Rowling'         , '0002.jpg'),
('0032', 'Harry Potter và tên Tù Nhân Ngục Azkaban'       , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13500, 10, 'J.K.Rowling'         , '0003.jpg'),
('0033', 'Harry Potter và Chiếc Cốc Lửa'                  , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13000, 10, 'J.K.Rowling'         , '0004.jpg'),
('0034', 'Harry Potter và Hội Phượng Hoàng'               , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13000, 10, 'J.K.Rowling'         , '0005.jpg'),
('0035', 'Harry Potter và Hoàng Tử Lai'                   , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 15500, 10, 'J.K.Rowling'         , '0006.jpg'),
('0036', 'Harry Potter và Bảo Bối Tử Thần'                , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 19900, 10, 'J.K.Rowling'         , '0007.jpg'),
('0037', 'Mắt Biếc'                                       , '0001' , 'Cuốn sách nói về tình yêu thanh thiếu niên'                      , 29900, 10, 'Nguyễn Nhật Ánh'     , '0008.jpg'),
('0038', 'Những Đứa Con Rải Rác Trên Đường'               , '0000' , 'Cuốn sách nói về cuộc sống xã hội bất công với những đứa trẻ'    , 17500, 07, 'Hồ Anh Thái'         , '0009.jpg'),
('0039', 'Đà Lạt -Một thời phương xa'                     , '0000' , 'Cuốn sách nói về cuộc sống của người dân Đà Lạt'                 , 10600, 10, 'Phạm Duy'            , '0010.jpg'),
('0040', 'Dòng sông không trở lại'                        , '0000' , 'Nói về những Những ký ức tười đẹp của tuổi thanh xuân'           , 21000, 12, 'Vi Thuỳ Linh'        , '0011.jpg'),
('0041', 'Cho tôi xin một vé đi tuổi thơ'                 , '0000' , 'Nói về những kỹ niệm tưởng nhớ tuổi thơ'                         , 9000 , 10, 'Nguyễn Nhật Ánh'     , '0012.jpg'),
('0042', 'Bên nhau trọn đời'                              , '0000' , 'Nói về những biến cố diễn ra của 2 nhân vật chính'               , 17500, 20, 'Trích Tân'           , '0013.jpg'),
('0043', 'Truyện Kiều'                                    , '0001' , 'Nói về Cuộc sống chông gai của người con gái thời xưa'           , 7000 , 10, 'Nguyễn Du'           , '0014.jpg'),
('0044', 'Dế mèn phiêu lưu ký'                            , '0002' , 'Nói về những cuộc phiêu lưu hấp dẫn của chú dế mèn'              , 4000 , 21, 'Bùi Anh Tuấn'        , '0015.jpg'),
('0045', 'Thiên đường mười giờ'                           , '0002' , 'Nói về những mĩ quan đẹp trên thế giới vào đúng thời điểm'       , 10000, 12, 'Lê Lựu'              , '0016.jpg'),
('0046', 'Đất rừng Phương Nam'                            , '0003' , 'Nói về những mỹ quan, văn hóa của người dân Đất Nam'             , 20000, 10, 'Hồ Biểu Chánh'       , '0017.jpg'),
('0047', 'Sông Đời'                                       , '0000' , 'Nói về những thăng trầm chông gai của cuộc đời và cách vượt qua' , 21000, 19, 'Đoàn Thạch Biền'     , '0018.jpg'),
('0048', 'Gạo nếp gạo tẻ'                                 , '0000' , 'Nói về những định kiến nam và nữ trong xã hội ngày xưa và nay'   , 6900 , 22, 'Huyền Anh'           , '0019.jpg'),
('0049', 'Nhà giả Kim'                                    , '0004' , 'Nói về cậu bé chăn cừu và cuộc đời của cậu'                      , 11000, 10, 'Paulo Coelho'        , '0020.jpg'),
('0050', 'Đắc nhân tâm'                                   , '0004' , 'Nói về những cách sống và chỉ dạy cách sống đúng nghĩa'          , 12000, 30, 'NDale Carnegie'      , '0021.jpg'),
('0051', 'Cách nghĩ để thành công'                        , '0004' , 'Nói về những cách suy nghĩ tích cực để có được thành công'       , 4500 , 10, 'Napoleon Hill'       , '0022.jpg'),
('0052', 'Quảng gánh lo đi và vui sống'                   , '0004' , 'Nói về những gánh nặng của cuộc sống và cách vượt qua chúng'     , 9900 , 22, 'David J.Lieberman'   , '0023.jpg'),
('0053', 'Đọc vị bất kỳ ai'                               , '0004' , 'Nói về những cách đọc vị, nắm bắt được tâm lý của người khác'    , 7500 , 10, 'Mario Puzo'          , '0024.jpg'),
('0054', 'Tiểu thuyết bố già'                             , '0000' , 'Nói về cuộc sống của những người bố trong gia đình'              , 10000, 10, 'Nick Vujicic'        , '0025.jpg'),
('0055', 'Cuộc sống không giới hạn'                       , '0004' , 'Nói về cách sống ý nghĩa khi chúng ta còn có thể'                , 9700 , 10, 'Andrew Matthews'     , '0026.jpg'),
('0056', 'Đời thay đổi khi chúng ta thay đổi'             , '0004' , 'Chỉ dẫn chúng ta sống đúng là tích cực để thay đổi cuộc sống'    , 15000, 12, 'George Samuel Clason', '0027.jpg'),
('0057', 'Người giàu có nhất thành BabyLon'               , '0004' , 'Dạy chúng ta suy nghĩ như những người có tiền'                   , 8500 , 18, 'Vũ Trọng Phụng'      , '0028.jpg'),
('0058', 'Sherlock Holmes: The Complete Novels and Stories', '0000', 'Là bộ sưu tập các tiểu thuyết và truyện ngắn về Sherlock Holmes, thám tử huyền thoại nổi tiếng với tài suy luận đỉnh cao', 250000, 30, 'Arthur Conan Doyle', '0000.jpg'),
('0059', 'Harry Potter và Hòn Đá Phù Thủy'                , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 12700, 10, 'J.K.Rowling'         , '0001.jpg'),
('0060', 'Harry Potter và Phòng Chứa Bí Mật'              , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13000, 10, 'J.K.Rowling'         , '0002.jpg'),
('0061', 'Harry Potter và tên Tù Nhân Ngục Azkaban'       , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13500, 10, 'J.K.Rowling'         , '0003.jpg'),
('0062', 'Harry Potter và Chiếc Cốc Lửa'                  , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13000, 10, 'J.K.Rowling'         , '0004.jpg'),
('0063', 'Harry Potter và Hội Phượng Hoàng'               , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13000, 10, 'J.K.Rowling'         , '0005.jpg'),
('0064', 'Harry Potter và Hoàng Tử Lai'                   , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 15500, 10, 'J.K.Rowling'         , '0006.jpg'),
('0065', 'Harry Potter và Bảo Bối Tử Thần'                , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 19900, 10, 'J.K.Rowling'         , '0007.jpg'),
('0066', 'Mắt Biếc'                                       , '0001' , 'Cuốn sách nói về tình yêu thanh thiếu niên'                      , 29900, 10, 'Nguyễn Nhật Ánh'     , '0008.jpg'),
('0067', 'Những Đứa Con Rải Rác Trên Đường'               , '0000' , 'Cuốn sách nói về cuộc sống xã hội bất công với những đứa trẻ'    , 17500, 07, 'Hồ Anh Thái'         , '0009.jpg'),
('0068', 'Đà Lạt -Một thời phương xa'                     , '0000' , 'Cuốn sách nói về cuộc sống của người dân Đà Lạt'                 , 10600, 10, 'Phạm Duy'            , '0010.jpg'),
('0069', 'Dòng sông không trở lại'                        , '0000' , 'Nói về những Những ký ức tười đẹp của tuổi thanh xuân'           , 21000, 12, 'Vi Thuỳ Linh'        , '0011.jpg'),
('0070', 'Cho tôi xin một vé đi tuổi thơ'                 , '0000' , 'Nói về những kỹ niệm tưởng nhớ tuổi thơ'                         , 9000 , 10, 'Nguyễn Nhật Ánh'     , '0012.jpg'),
('0071', 'Bên nhau trọn đời'                              , '0000' , 'Nói về những biến cố diễn ra của 2 nhân vật chính'               , 17500, 20, 'Trích Tân'           , '0013.jpg'),
('0072', 'Truyện Kiều'                                    , '0001' , 'Nói về Cuộc sống chông gai của người con gái thời xưa'           , 7000 , 10, 'Nguyễn Du'           , '0014.jpg'),
('0073', 'Dế mèn phiêu lưu ký'                            , '0002' , 'Nói về những cuộc phiêu lưu hấp dẫn của chú dế mèn'              , 4000 , 21, 'Bùi Anh Tuấn'        , '0015.jpg'),
('0074', 'Thiên đường mười giờ'                           , '0002' , 'Nói về những mĩ quan đẹp trên thế giới vào đúng thời điểm'       , 10000, 12, 'Lê Lựu'              , '0016.jpg'),
('0075', 'Đất rừng Phương Nam'                            , '0003' , 'Nói về những mỹ quan, văn hóa của người dân Đất Nam'             , 20000, 10, 'Hồ Biểu Chánh'       , '0017.jpg'),
('0076', 'Sông Đời'                                       , '0000' , 'Nói về những thăng trầm chông gai của cuộc đời và cách vượt qua' , 21000, 19, 'Đoàn Thạch Biền'     , '0018.jpg'),
('0077', 'Gạo nếp gạo tẻ'                                 , '0000' , 'Nói về những định kiến nam và nữ trong xã hội ngày xưa và nay'   , 6900 , 22, 'Huyền Anh'           , '0019.jpg'),
('0078', 'Nhà giả Kim'                                    , '0004' , 'Nói về cậu bé chăn cừu và cuộc đời của cậu'                      , 11000, 10, 'Paulo Coelho'        , '0020.jpg'),
('0079', 'Đắc nhân tâm'                                   , '0004' , 'Nói về những cách sống và chỉ dạy cách sống đúng nghĩa'          , 12000, 30, 'NDale Carnegie'      , '0021.jpg'),
('0080', 'Cách nghĩ để thành công'                        , '0004' , 'Nói về những cách suy nghĩ tích cực để có được thành công'       , 4500 , 10, 'Napoleon Hill'       , '0022.jpg'),
('0081', 'Quảng gánh lo đi và vui sống'                   , '0004' , 'Nói về những gánh nặng của cuộc sống và cách vượt qua chúng'     , 9900 , 22, 'David J.Lieberman'   , '0023.jpg'),
('0082', 'Đọc vị bất kỳ ai'                               , '0004' , 'Nói về những cách đọc vị, nắm bắt được tâm lý của người khác'    , 7500 , 10, 'Mario Puzo'          , '0024.jpg'),
('0083', 'Tiểu thuyết bố già'                             , '0000' , 'Nói về cuộc sống của những người bố trong gia đình'              , 10000, 10, 'Nick Vujicic'        , '0025.jpg'),
('0084', 'Cuộc sống không giới hạn'                       , '0004' , 'Nói về cách sống ý nghĩa khi chúng ta còn có thể'                , 9700 , 10, 'Andrew Matthews'     , '0026.jpg'),
('0085', 'Đời thay đổi khi chúng ta thay đổi'             , '0004' , 'Chỉ dẫn chúng ta sống đúng là tích cực để thay đổi cuộc sống'    , 15000, 12, 'George Samuel Clason', '0027.jpg'),
('0086', 'Người giàu có nhất thành BabyLon'               , '0004' , 'Dạy chúng ta suy nghĩ như những người có tiền'                   , 8500 , 18, 'Vũ Trọng Phụng'      , '0028.jpg'),
('0087', 'Sherlock Holmes: The Complete Novels and Stories', '0000', 'Là bộ sưu tập các tiểu thuyết và truyện ngắn về Sherlock Holmes, thám tử huyền thoại nổi tiếng với tài suy luận đỉnh cao', 250000, 30, 'Arthur Conan Doyle', '0000.jpg'),
('0088', 'Harry Potter và Hòn Đá Phù Thủy'                , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 12700, 10, 'J.K.Rowling'         , '0001.jpg'),
('0089', 'Harry Potter và Phòng Chứa Bí Mật'              , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13000, 10, 'J.K.Rowling'         , '0002.jpg'),
('0090', 'Harry Potter và tên Tù Nhân Ngục Azkaban'       , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13500, 10, 'J.K.Rowling'         , '0003.jpg'),
('0091', 'Harry Potter và Chiếc Cốc Lửa'                  , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13000, 10, 'J.K.Rowling'         , '0004.jpg'),
('0092', 'Harry Potter và Hội Phượng Hoàng'               , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 13000, 10, 'J.K.Rowling'         , '0005.jpg'),
('0093', 'Harry Potter và Hoàng Tử Lai'                   , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 15500, 10, 'J.K.Rowling'         , '0006.jpg'),
('0094', 'Harry Potter và Bảo Bối Tử Thần'                , '0000' , 'Thuộc bộ truyện Harry Potter của nhà văn J.K.Rowling'            , 19900, 10, 'J.K.Rowling'         , '0007.jpg'),
('0095', 'Mắt Biếc'                                       , '0001' , 'Cuốn sách nói về tình yêu thanh thiếu niên'                      , 29900, 10, 'Nguyễn Nhật Ánh'     , '0008.jpg'),
('0096', 'Những Đứa Con Rải Rác Trên Đường'               , '0000' , 'Cuốn sách nói về cuộc sống xã hội bất công với những đứa trẻ'    , 17500, 07, 'Hồ Anh Thái'         , '0009.jpg'),
('0097', 'Đà Lạt -Một thời phương xa'                     , '0000' , 'Cuốn sách nói về cuộc sống của người dân Đà Lạt'                 , 10600, 10, 'Phạm Duy'            , '0010.jpg'),
('0098', 'Dòng sông không trở lại'                        , '0000' , 'Nói về những Những ký ức tười đẹp của tuổi thanh xuân'           , 21000, 12, 'Vi Thuỳ Linh'        , '0011.jpg'),
('0099', 'Cho tôi xin một vé đi tuổi thơ'                 , '0000' , 'Nói về những kỹ niệm tưởng nhớ tuổi thơ'                         , 9000 , 10, 'Nguyễn Nhật Ánh'     , '0012.jpg'),
('0100', 'Bên nhau trọn đời'                              , '0000' , 'Nói về những biến cố diễn ra của 2 nhân vật chính'               , 17500, 20, 'Trích Tân'           , '0013.jpg');



-- --------------------------------------------------------
-- `maSYT` varchar(4) NOT NULL,
CREATE TABLE `sach_yeu_thich` (
  `maKH` varchar(4),
  `maSach` varchar(4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO `sach_yeu_thich` VALUES
('0001', '0000'),
('0001', '0008');


ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`maKH`);

ALTER TABLE `loai_sach`
  ADD PRIMARY KEY (`maLS`);

ALTER TABLE `sach`
  ADD PRIMARY KEY (`maSach`),
  ADD KEY `maLS` (`maLS`);

ALTER TABLE `sach_yeu_thich`
  ADD KEY `maKH` (`maKH`),
  ADD KEY `maSach` (`maSach`),
  ADD PRIMARY KEY (`maKH`, `maSach`);

ALTER TABLE `sach`
  ADD CONSTRAINT `sach_ibfk_1` FOREIGN KEY (`maLS`) REFERENCES `loai_sach` (`maLS`);

ALTER TABLE `sach_yeu_thich`
  ADD CONSTRAINT `sach_yeu_thich_ibfk_2` FOREIGN KEY (`maSach`) REFERENCES `sach` (`maSach`),
  ADD CONSTRAINT `sach_yeu_thich_ibfk_3` FOREIGN KEY (`maKH`) REFERENCES `khach_hang` (`maKH`);
COMMIT;