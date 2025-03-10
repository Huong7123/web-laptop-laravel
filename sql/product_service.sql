-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 10, 2025 lúc 05:45 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `product_service`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 'HP', '1234567', 0, '2025-02-21 01:09:59', NULL),
(2, 'Lenovo', 'Apparel for men, women, and children', 0, '2024-12-24 04:18:25', NULL),
(3, 'Dell', 'Kitchen and household appliances', 0, '2024-12-24 16:39:53', NULL),
(4, 'MSI', 'Books of various genres and topics', 0, '2024-12-24 04:18:25', NULL),
(5, 'Sports', 'Sports equipment and outdoor gear', 1, '2025-02-14 07:57:30', NULL),
(6, 'Product Name', 'Product description', 1, '2024-12-23 21:18:53', '2024-12-23 21:18:28'),
(7, 'Product Name', 'Product description', 1, '2025-02-14 00:57:44', '2024-12-23 21:25:11'),
(8, '2', '2', 1, '2024-12-23 21:39:24', '2024-12-23 21:38:00'),
(9, 'aaaabbb', 'aaa', 1, '2024-12-26 16:47:37', NULL),
(10, 'bbb', 'aa', 1, '2025-02-21 01:10:18', '2025-02-21 01:10:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `discounts`
--

CREATE TABLE `discounts` (
  `discount_id` int(11) NOT NULL,
  `discount_name` varchar(255) NOT NULL,
  `discount_percent` decimal(5,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `discounts`
--

INSERT INTO `discounts` (`discount_id`, `discount_name`, `discount_percent`, `start_date`, `end_date`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 'New Year Sale', 10.00, '2024-01-01 00:00:00', '2024-01-31 23:59:59', 0, '2024-12-24 05:15:15', NULL),
(2, 'Summer Discount', 15.00, '2024-06-01 00:00:00', '2024-06-30 23:59:59', 0, '2024-12-24 05:15:15', NULL),
(3, 'Black Friday', 30.00, '2024-11-29 00:00:00', '2024-11-29 23:59:59', 0, '2024-12-24 05:15:15', NULL),
(4, '123', 19.00, '2024-01-01 00:00:00', '2024-12-31 00:00:00', 1, '2024-12-26 16:48:14', NULL),
(5, '123123', 12.00, '2024-12-25 00:00:00', '2024-12-29 00:00:00', 1, '2024-12-23 22:17:01', '2024-12-23 22:16:51'),
(6, 'hhhhkkk', 25.00, '2024-12-27 00:00:00', '2024-12-28 00:00:00', 1, '2024-12-26 16:48:09', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(20,2) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `description`, `price`, `category_id`, `image_url`, `discount_id`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 'Lenovo Yoga 7 2-in-1', 'Đặc điểm nổi bật\nLenovo Yoga 7 2-in-1 - Cảm ứng mỏng nhẹ& thiết kế đỉnh cao\nLenvo Yoga 7 2-in-1 có thể nói là phiên bản hoàn hảo nhất của dòng laptop mỏng nhẹ tới từ nhà Lenovo bởi thiết kế sang trọng cùng trọng lượng chỉ 1.6kg. Với một thân hình mảnh mai, Lenovo Yoga 7 2-in-1 mang trong mình cấu hình Intel® Core™ Ultra 5 125U. Chưa hết, Lenovo Yoga 7 2-in-1 còn được trang bị màn hình FHD+ cảm ứng đẹp mắt, hứa hẹn sẽ mang đến cho bạn trải nghiệm tuyệt vời. Hãy cùng LaptopAZ đi tìm hiểu nhé! \nThiết kế\nLenovo Yoga 7 2-in-1 đi theo lối thiết kế tinh tế và hiện đại. Vỏ kim loại màu xám đen tạo nên một ngoại hình sang trọng và lịch lãm, đồng thời mang tới sự bền bỉ và khả năng tản nhiệt hiệu quả. Đường cắt vát trên bề mặt máy tạo nên các góc cạnh và tạo hiệu ứng ánh sáng vô cùng độc đáo. Lenovo Yoga 7 2-in-1 sở hữu sự kết hợp tuyệt vời giữa Thiết kế này thể hiện sự kết hợp tuyệt vời giữa thẩm mỹ và hiệu suất làm việc. \nLenovo Yoga 7 2-in-1 có kích thước 317,72 x 222,13 x 16,64mm và có trọng lượng khoảng 1.6 kg. Điều này làm cho máy trở nên nhẹ và mỏng hơn so với nhiều laptop cùng phân khúc, đặc biệt nhờ sử dụng nhôm và việc thiết kế màn hình với viền mỏng. Điều này cho phép máy dễ dàng vừa vặn trong balo hoặc túi xách của bạn mà không tạo cảm giác nặng nề hay cồng kềnh. Máy cũng có một bản lề cho phép mở màn hình ở góc lên đến 180 độ, giúp bạn điều chỉnh góc nhìn một cách thuận tiện.\nMàn hình\nĐiểm nhấn ấn tượng nhất với người dùng trên con máy Lenvo Yoga 7 2-in-1 chính là màn hình. Màn hình của Lenovo Yoga 7 2-in-1 có kích thước 14\", độ phân giải FHD+ (1920x1200) được hiệu chuẩn màu sắc để cho hình ảnh chân thực nhất. Màn hình này có công nghệ IPS cho góc nhìn rộng và độ sáng tối đa lên đến 300 nits. Màn hình cũng có tính năng cảm ứng và xoay gập 360 độ, giúp người dùng có thể thao tác trực tiếp trên màn hình một cách dễ dàng và tiện lợi. Ngoài ra Lenovo Yoga 7 2-in-1 với công nghệ xử lý hình ảnh hiện đại còn mang tới trải nghiệm không gian thực với hình ảnh sắc nét cho người dùng, đáp ứng nhu cầu thiết kế, chỉnh video không thua kém các máy tính chuyên về đồ họa.\nMột điểm cộng nữa của màn hình của Yoga 7 2-in-1 là viền màn hình rất mỏng, giúp người dùng dễ dàng đắm chìm trong từng khung hình, tạo sự thoải mái khi làm việc hoặc chơi game. Màn hình này cũng được bảo vệ bởi kính cường lực, giúp chống trầy xước và va đập.\nHiệu năng\nKhông khó khi người dùng có thể nhận thấy rằng với một thiết kế bề ngoài hoàn mỹ thì CPU đời mới hiện đại cũng được trang bị trên chiếc Lenovo Yoga 7 2-in-1. Với việc được trang bị con chip CPU Intel® Core™ Ultra 5 125U (1.30GHz up to 4.30GHz, 12MB Cache), đi cùng Ram 16GB LPDDR5x-7467MHz và 512GB SSD NVMe PCIe, Lenovo Yoga 7 2-in-1 có thể thoải mái cân tất cả các tác vụ công việc cũng như hoạt động đa nhiệm mượt mà. \nNgoài ra, Lenovo Yoga 7 2-in-1 được trang bị card đồ họa tích hợp cung cấp khả năng xử lý hình ảnh tốt để đáp ứng các công việc hàng ngày, chơi game và giải trí. \nBàn phím - Touchpad\nBàn phím trên Yoga 7 2-in-1 có thiết kế kiểu chiclet với các phím được đặt khá rộng rãi, tạo cảm giác thoải mái khi gõ. Các phím có hành trình hợp lý và độ nảy tốt, giúp tăng tốc độ gõ phím và giảm thiểu sai sót. Ngoài ra, bàn phím cũng được trang bị đèn nền, cho phép người dùng làm việc trong môi trường thiếu ánh sáng.\nCổng kết nối\nCũng giống như phiên bản tiền nhiệm Lenvo Yoga 7 2-in-1 được trang bị đầy đủ các cổng kết nối giúp cho người dùng thuận tiện kết nói với các thiết bị ngoại vi như: chuột, bàn phím, USB, Box HDD,… một cách thoải mái đem lại trải nghiệm tốt nhất trong quá trình sử dụng. Hệ thống cổng kết nối bao gồm: 1x USB-A (USB 5Gbps / USB 3.2 Gen 1), 2x USB-C® (Thunderbolt™ 4 / USB4® 40Gbps), 1x HDMI® 2.1, 1x Giắc cắm kết hợp tai nghe / micrô (3,5 mm), 1x đầu đọc thẻ nhớ microSD\nNgoài ra Lenovo Yoga 7 2-in-1 còn là một trong những chiếc laptop có thời lượng pin tốt trên thị trường hiện nay. Với pin có dung lượng lên đến 71Wh, máy có thể sử dụng liên tục lên đến trên 10 giờ trên một lần sạc đầy, tuỳ thuộc vào cấu hình và cách sử dụng của người dùng.', 17990000.00, 2, 'yoga7.png', 3, 0, '2025-02-14 00:59:37', NULL),
(2, 'Laptop Dell Inspiron 15 3520 6HD73 I7-1255U/16GB/5', 'Laptop Dell Inspiron 15 3520 6HD73 là dòng máy đa năng với chip xử lý Intel Core i7-1255U 10 nhân 12 luồng, RAM 16GB DDR4 và ổ SSD 512GB PCIe NVMe. Máy tích hợp card Intel X Graphics với màn hình 15.6 inch cùng độ phân giải 1920 x 1080 pixels (Full HD) sống động. Mẫu laptop Dell Inspiron này có thiết kế thanh lịch, nặng 1.66 kg cùng viên pin 3 Cell 41Wh. ', 17990000.00, 3, 'dell-1.webp', NULL, 0, '2024-12-26 15:52:09', NULL),
(3, 'Laptop Dell Latitude 3540 71038100 I5-1235U/16GB/5', 'Laptop Dell Latitude 3540 71038100 mang hiệu suất đỉnh cao từ vi xử lý i5-1235U Intel Core, kết hợp dung lượng 16GB RAM cùng ổ cứng chuẩn PCIe 512GB. Không những vậy, mẫu laptop Dell này còn sở hữu màn hình Full HD 15.6 inch với tốc độ quét 60Hz. Ngoài ra, thiết kế gọn gàng, hiện đại cũng phù hợp với môi trường, nhu cầu văn phòng chuyên nghiệp của người dùng.', 16990000.00, 2, 'dell-2.webp', 3, 0, '2024-12-26 16:46:11', NULL),
(4, 'Laptop Dell Vostro 3530 2H1TPI7 I7-1355U/16GB/512G', 'Laptop Dell Vostro 3530 2H1TPI7 sở hữu cấu hình mạnh mẽ với Intel Core i7 thế hệ 13 cùng RAM 16GB DDR4, mang lại hiệu năng ấn tượng và khả năng đa nhiệm tốt. Máy được trang bị màn hình 15.6 inch Full HD LCD với tần số quét 120Hz, cho hình ảnh sắc nét và chuyển động mượt mà. Bên cạnh đó, lớp chống chói cũng giúp thế hệ laptop Dell Vostro này có thể làm việc dễ dàng trong mọi điều kiện ánh sáng. Máy có thiết kế vỏ carbon bền bỉ, trọng lượng nhẹ 1.66 kg và đầy đủ các cổng kết nối.', 18490000.00, 3, 'dell-3.jpg', 1, 0, '2024-12-26 15:52:17', NULL),
(5, 'Laptop Dell XPS 13 9340 Ultra 5 125H/16GB/2TB', 'Dell XPS được trang bị bộ vi xử lý Intel Core Ultra 5 Meteor Lake - 125H thế hệ 14 mới nhất, với tốc độ ép xung tối đa lên đến 4.5 GHz. Điều này không chỉ đảm bảo xử lý trơn tru mọi tác vụ từ công việc văn phòng, xử lý dữ liệu đến các ứng dụng giải trí đa phương tiện nặng mà còn hỗ trợ tốt các phần mềm đòi hỏi cấu hình cao như Adobe Premiere Pro hay vận dụng các công cụ thiết kế phần mềm.', 51990000.00, 3, 'dell-4.jpg', 2, 0, '2024-12-26 15:52:20', NULL),
(6, 'Laptop Dell G15 5530 i7 13650HX/16GB/1TB/8GB RTX40', 'Với laptop Dell G15 5530 i7 13650HX (i7HX161W11GR4060) bạn không chỉ là một game thủ mà còn là một nhà sáng tạo thực thụ. CPU Intel Core i7 thế hệ 13 và card đồ họa RTX 4060 mang đến hiệu năng vượt trội, giúp bạn chinh phục mọi thử thách, từ những trận game căng thẳng đến các dự án sáng tạo đòi hỏi cao. Thiết kế hiện đại và màn hình chất lượng cao sẽ làm bạn hài lòng ngay từ cái nhìn đầu tiên.', 36990000.00, 3, 'dell-5.jpg', 3, 0, '2024-12-26 15:52:24', NULL),
(7, 'Lenovo Thinkbook 14 G6+ 2024', 'Đặc điểm nổi bật\r\nLaptop Lenovo ThinkBook 14 G6+ có đáng để sở hữu?\r\nLenovo ThinkBook 14 G6+ là chiếc laptop doanh nhân mạnh mẽ nhưng đầy phong cách. Bên cạnh bộ vi xử lý thế hệ mới nhất, ThinkBook 14 G6+ còn tích hợp những tính năng thông minh để tối ưu hóa cho khả năng làm việc từ xa vốn đang là xu hướng hiện nay.\r\nTăng cường năng suất làm việc nhờ cấu hình tiên tiến\r\nLenovo ThinkBook 14 G6+ có sức mạnh vượt trội nhờ việc sử dụng bộ vi xử lý Intel Ultra 5 125H mới nhất hiện nay. Con chip Intel Ultra 5 125H hiệu năng cao không chỉ cho tốc độ nhanh với 14 lõi 18 luồng, tốc độ xung nhịp tối đa lên tới 4.50GHz. Kết hợp thêm 16GB LPDDR5x 7467MT/s và ổ cứng SSD dung lượng cao 512GB, bạn sẽ có một thiết bị làm việc lý tưởng, tối ưu hiệu suất trong công việc.\r\nKhả năng xử lý đồ họa xuất sắc\r\nBộ vi xử lý Intel Ultra 5 125H tích hợp GPU đồ họa Intel Arc Graphics mạnh mẽ hàng đầu hiện nay. Nhờ sức mạnh đồ họa ấn tượng, Lenovo ThinkBook 14 G6+ có thể chỉnh sửa ảnh, biên tập video hay chạy các ứng dụng đồ họa cơ bản, cho bạn làm được nhiều việc hơn trên chiếc laptop di động.\r\nThiết kế sang trọng và chuyên nghiệp\r\nLenovo ThinkBook 14 G6+ mang đến cho bạn nhiều cảm hứng làm việc hơn nhờ một thiết kế sang trọng và chuyên nghiệp. Phần viền màn hình siêu mỏng, kích thước gọn nhẹ, di động và một thiết kế rất thời thượng tạo nên chiếc máy tính xách tay đẹp đẳng cấp. Không chỉ tạo phong cách riêng, sự mỏng nhẹ của Lenovo ThinkBook 14 G6+ còn giúp bạn có thể dễ dàng mang laptop đi bất cứ đâu.\r\nMàn hình sống động sắc nét\r\nMàn hình của Lenovo ThinkBook 14 G6+ có kích thước 14 inch, độ phân giải 2K+ sắc nét, cho hình ảnh sống động như thật với màu sắc, độ tương phản chính xác. Viền màn hình siêu mỏng giúp bạn hoàn toàn tập trung vào nội dung trước mắt. Hơn nữa, màn hình này còn có công nghệ lọc ánh sáng xanh bảo vệ mắt đã được chứng nhận bởi TUV Rheinland, giúp bạn làm việc thoải mái dù trong thời gian dài.\r\nTối ưu cho khả năng làm việc từ xa\r\nNhững cuộc họp video đang là điều không còn xa lạ hiện nay, khi bạn vẫn có thể tham gia họp mà không cần phải mất thời gian di chuyển đến phòng họp, đồng thời tạo kết nối từ xa trong công việc. Lenovo ThinkBook 14 G6+ hiểu điều đó và đã xây dựng hệ thống webcam sắc nét, âm thanh trung thực cùng micro chống ồn. Bạn sẽ có được chất lượng cuộc gọi tối ưu nhất để công việc hoàn toàn trôi chảy. \r\nKhả năng kết nối ấn tượng\r\nLenovo ThinkBook 14 G6+ đảm bảo khả năng kết nối linh hoạt và nhanh chóng nhất. Chuẩn WiFi 6 cho tốc độ tải xuống nhanh hơn, băng thông rộng hơn và độ trễ thấp hơn. Nhờ những cổng kết nối tiên tiến hàng đầu, Lenovo ThinkBook 14 G6+ có thể kết nối với bất kỳ thiết bị ngoại vi nào bạn muốn, phục vụ tối đa cho công việc.\r\nNgoài ra Lenovo ThinkBook 14 G6+ còn sở hữu số lượng cổng kết nối đầy đủ, đáp ứng được hầu hết các tác vụ trong công việc bao gồm: 1x USB type C, 1x HDMI 2.1, 1x Thunderbolt, 1x Headphone / mic combo 3.5, 2x USB type A, 1x TGX, 1x Đầu đọc thẻ SD, 1x RJ45\r\nBảo mật, an toàn và thông minh\r\nLenovo ThinkBook 14 G6+ đảm bảo cho dữ liệu và quyền riêng tư cá nhân của bạn luôn an toàn. Các tính năng phần cứng đều được bảo mật bởi nền tảng TPM, kiểm soát truy cập cổng kết nối, tính năng xóa an toàn, … Một màn trập trên webcam giúp bạn tránh khỏi nguy cơ bị truy cập hình ảnh trái phép khi không sử dụng. Ngoài ra laptop cũng tích hợp các tính năng thông minh về khởi động; chế độ bảo vệ mắt; làm mát thông minh. Bạn sẽ có được những trải nghiệm an toàn và thoải mái nhất trên Lenovo ThinkBook 14 G6+.\r\nBàn phím tuyệt vời\r\nBàn phím của Thinkbook 14 G6+ 2024 với hành trình phím 1.5mm không chỉ mang lại cảm giác gõ phím chính xác mà còn tạo trải nghiệm thoải mái rất đặc biệt. Hành trình phím lớn cũng giúp giảm mệt mỏi trong quá trình sử dụng lâu dài, hòa mình vào không gian làm việc một cách dễ dàng và thoải mái hơn bao giờ hết.\r\nTouchpad của chiếc laptop này có kích thước lớn mang đến không gian rộng rãi cho những thao tác đa chạm và di chuyển linh hoạt trên màn hình. Mượt mà và chính xác, touchpad giúp người dùng dễ dàng thực hiện các thao tác như cuộn, phóng to, xoay.\r\nBên cạnh đó Thinkbook 14 G6+ 2024 sở hữu pin vô cùng mạnh mẽ, với dung lượng lên tới 85Whr. Dung lượng pin lớn này hứa hẹn mang lại thời lượng sử dụng ấn tượng, giúp người dùng thoải mái sử dụng máy tính trong thời gian dài mà không cần lo lắng về việc sạc pin liên tục.\r\nTổng kết: Laptop Lenovo ThinkBook 14 G6+ với hiệu năng mạnh mẽ cùng thiết kế thanh lịch, là sự lựa chọn phù hợp cho hầu hết tất cả mọi người, nhất là những ai có nhu cầu học tập - văn phòng. Hiện tại LaptopAZ đang có những chương trình ưu đãi vô cùng tuyệt vời khi khách hàng đặt mua Lenovo ThinkBook 14 G6+ ngay từ ngày hôm nay!', 18690000.00, 2, 'thinkbook14.png\r\n', 1, 0, '2024-12-26 15:52:28', NULL),
(8, 'Laptop MSI Modern 14 C13M-607VN', 'MSI Modern 14 C13M-607VN sản phẩm có trọng lượng chỉ 1.4kg thuộc dạng nhỏ gọn với kích thước 319.9 x 223 x 19.35 mm và khối lượng chỉ 1.4 kg, laptop này thực sự rất nhẹ và tiện lợi cho việc di chuyển. Kích thước nhỏ gọn của nó cũng làm cho việc xách nó đi khá dễ dàng mà không cần phải lo lắng về trọng lượng.', 16490000.00, 4, 'MSI1.png', 1, 0, '2024-12-26 15:52:32', NULL),
(9, 'Laptop MSI GF63 Thin 12VE-460VN', 'Được trang bị bộ vi xử lý Intel® Core™ i5-12450H thế hệ 12 và card đồ họa rời NVIDIA® GeForce RTX™ 4050, chiếc laptop này không chỉ mang lại trải nghiệm chơi game mượt mà mà còn đáp ứng tốt các nhu cầu công việc đa nhiệm và sáng tạo nội dung', 17990000.00, 4, 'MSI2.png', 1, 0, '2024-12-26 15:52:36', NULL),
(10, 'Laptop MSI Modern 14 C13M - 609VN', 'Laptop MSI Modern 14 C13M - 609VN với thiết kế nhỏ gọn với kích thước 319.9 x 223 x 19.35 mm và trọng lượng chỉ 1.4 kg. Laptop MSI Modern 14 C13M - 609VN thuộc dạng nhỏ gọn, dễ dàng mang theo khi di chuyển, phù hợp cho những người thường xuyên phải làm việc ở nhiều nơi', 12990000.00, 4, 'MSI3.png', 1, 0, '2024-12-26 15:52:40', NULL),
(11, 'Laptop MSI Modern 14 C13M - 608VN', 'MSI Modern 14 C13M-608VN là chiếc laptop văn phòng mang đến sự cân bằng hoàn hảo giữa thiết kế thời trang, hiệu năng mạnh mẽ và tính di động cao. Dòng sản phẩm này luôn là sự lựa chọn hàng đầu dành cho những bạn học sinh-sinh viên và nhân viên văn phòng nhờ vào thiết kế trẻ trung cùng một mức giá vô cùng tốt', 13990000.00, 4, 'MSI4.png', 1, 0, '2024-12-26 15:52:44', NULL),
(12, 'Laptop MSI Modern 15 B13M-438VN', 'MSI Modern 15 B13M-438VN có trọng lượng chỉ 1.7 kg nhỏ gọn với thiết kế nhỏ gọn và trọng lượng chỉ 1.7 kg, Laptop MSI Modern 15 B13M-438VN đáp ứng nhu cầu di động của người dùng hiện đại, mang lại sự thuận tiện và linh hoạt trong việc sử dụng hàng ngày', 12990000.00, 4, 'MSI5.png', 1, 0, '2024-12-26 15:52:47', NULL),
(13, 'Laptop HP Pavilion X360 14-EK2017TU 9Z2V5PA', '\"Trang bị bộ vi xử lý Intel Core 5-120U, đảm bảo hiệu năng ổn định cho công việc văn phòng và học tập.\r\nMáy sở hữu bộ nhớ RAM 16GB giúp đa nhiệm mượt mà, không gặp tình trạng giật lag khi mở nhiều ứng dụng.\r\nỔ cứng SSD PCIe 512GB mang đến không gian lưu trữ rộng rãi cùng tốc độ truy xuất dữ liệu nhanh chóng.\r\nMàn hình cảm ứng 14 inch Full HD kết hợp với bút cảm ứng cho phép người dùng vẽ, ghi chú và tương tác trực tiếp một cách thuận tiện.\r\nThiết kế xoay gập 360 độ linh hoạt cho phép sử dụng ở nhiều chế độ khác nhau.\"', 23490000.00, 1, 'hp2.png', 2, 0, '2024-12-26 15:52:50', NULL),
(14, 'Laptop HP 15S-FQ5231TU 8U241PA', '\"Sở hữu thiết kế hiện đại với lớp vỏ bạc đẹp mắt, tạo cảm giác hài hòa cho mọi không gian làm việc.\r\nCPU Intel Core i3 1215U xử lý trơn tru mọi tác vụ thường ngày hay sử dụng Word, Excel, PowerPoint,...\r\nRAM 8 GB cho khả năng đa nhiệm mượt mà, mở cùng lúc nhiều tab Chrome và các ứng dụng khác như Spotify, Photoshop,...\r\nỔ cứng SSD 256 GB dễ dàng truy xuất hay khởi động ứng dụng nhanh chóng.\"', 10490000.00, 1, 'hp3.png', 3, 0, '2024-12-26 15:52:53', NULL),
(15, 'Laptop HP 240 G9 9E5W3PT', '\"Trang bị chip Intel Core i5, RAM 8GB và ổ cứng SSD 512GB PCIe cho khả năng xử lý mượt mà các tác vụ văn phòng, học tập và giải trí cơ bản.\r\nMàn hình 14 inch FHD (1920x1080) mang đến trải nghiệm hình ảnh rõ nét, sống động cho công việc và giải trí.\r\nVới trọng lượng chỉ từ 1.47kg, HP 240 G9 dễ dàng mang theo bên mình mọi lúc mọi nơi.\r\nMáy được cài đặt sẵn Windows 11 bản quyền, mang đến giao diện hiện đại và nhiều tính năng mới mẻ.\"', 15690000.00, 1, 'hp4.png', 4, 0, '2024-12-26 15:52:56', NULL),
(16, 'Laptop HP Elitebook 630 G9 6M142PA', '\"Sở hữu thiết kế thời thượng với các đường nét thiết kế mềm mại, sang trọng\r\nMàn hình 13.3 inch Full HD mang đến cho bạn những khung hình sắc nét, sống động\r\nCPU Intel Core i5-1235U cho bạn khả năng vận hành xử lý nhanh chóng, mượt mà\r\nChất lượng đồ họa đỉnh cao với chip đồ họa Intel Iris Xe Graphics\r\nRAM 8GB đạt chuẩn DDR4 cho khả năng đa nhiệm tốt thao tác cùng lúc nhiều tác vụ mà không lo lag, giật\"', 16990000.00, 1, 'hp5.png', 2, 0, '2024-12-26 15:52:59', NULL),
(17, 'Laptop HP Pavilion 15-EG3111TU 8U6L8PA', '\"CPU Intel Core i5, RAM 16GB và ổ cứng SSD 512GB PCIe cho khả năng xử lý nhanh chóng mọi tác vụ từ văn phòng, học tập đến giải trí.\r\nMàn hình 15.6 inch FHD (1920x1080) mang đến không gian hiển thị rộng rãi và hình ảnh sắc nét, sống động.\r\nSở hữu thiết kế thanh lịch với lớp vỏ màu bạc sang trọng, phù hợp với nhiều đối tượng người dùng.\r\nVới cấu hình mạnh mẽ, HP Pavilion 15 giúp bạn dễ dàng xử lý cùng lúc nhiều tác vụ mà không gặp trở ngại.\r\nMáy được cài đặt sẵn Windows 11 bản quyền, mang đến giao diện hiện đại và nhiều tính năng mới mẻ cho trải nghiệm người dùng tuyệt vời.\"', 18790000.00, 1, 'hp1.png', 1, 0, '2024-12-26 15:53:02', NULL),
(18, 'LENOVO THINKPAD P51', 'Đặc điểm nổi bật\r\nĐịa chỉ bán Laptop Lenovo Thinkpad P51 uy tín trên toàn quốc - LaptopAZ.vn\r\n \r\nLenovo Thinkpad P51 dòng máy workstattion chuyên làm đồ hoạ 3D, làm Fim 4k, các phần mềm chỉnh sửa anh chuyên nghiệp. \r\n \r\nVới nhu cầu sử dụng máy trạm đồ họa hiệu suất cao cho công việc Thiế kế đồ họa 3D hoặc xử lý các Video 4K thì Lenovo ThinkPad P51 là sự lựa chọn không thể bỏ qua. Thế hệ máy trạm tiếp theo của Lenovo ThinkPad được trang bị CPU Intel Core i7-7820HQ  và Card đồ họa Nvidia Quadro  M2200M . Lenovo ThinkPad P51 là dòng Workstation 15.6\" thực sự nổi bật với Cấu hình mạnh mẽ, Thiết kế chắc chắn và chất lượng bàn phím số 1 trên thế giới.\r\nChiếc máy tính Lenovo Thinkpad P51 có thiết kế nhẹ và ấn tượng nhất trong các mẫu laptop máy trạm di động mobile workstation với các thích thước các chiều 377x252x25 cùng cân nặng khoảng từ 2.5 kg – 2.9 kg.\r\nThinkpad P51 vẫn sử dụng bộ khung nhôm, magie đây là kết cấu bền bỉ và ổn định của hãng Lenovo được sử dụng trong nhiều sản phẩm dòng thinkpad cùng với đó là nắp máy sử dụng sợi carbon, tất cả đều phải trải qua quá trình test kiểm tra độ bền theo tiêu chuẩn quân sự Mỹ MIL-STD 810G về độ ẩm, độ rung lắc, khả năng chống sốc và chịu nhiệt.\r\nMàn hình chi tiết, màu sắc rực rỡ\r\nVới tùy chọn cao cấp nhất Thinkpad P51 đem lại trải nghiệm hình ảnh rất tốt với độ phân giải FULL HD của mình. Hình ảnh trong các bộ phim 4K được hiện thị rất chi tiết cùng với đó là màu sắc và tương phản tốt, người xem có thể thấy rõ được các phân vùng nhỏ trên màn ảnh.\r\nKhả năng tái tạo màu trên màn của thinkpad P51 có thể lên tới hơn 170% gam màu sRGB cực kỳ ấn tượng hơn nhiều so với một số đối thủ như Macbook Pro và Dell Precision 5520, thậm chí với cảm biến và phần mềm X Rite Pantone thì người mua có thể tùy biến chất lượng màu sắc một cách chính xác.\r\nCấu hình cao cấp \r\nTheo Geekbench 4 thì Thinkpad P51 có thể đạt tới hơn 15 nghìn điểm cao hơn nhiều so với mức trung bình. Thử nghiệm ghép các marco trên excel với 20000 tên với địa chỉ mất khoảng 3 phút cao hơn các mốc thời gian trung bình.\r\nSức mạnh của SSD NVMe PCIe hiện nay có thể gọi là vô đối nhất khi chỉ khoảng 10 giây bạn đã có thể sao chép xong file nặng khoảng 5GB data dữ liệu tất cả chỉ như một cái chớp mắt.\r\nBàn phím dần thay đổi với nhiều cải tiến\r\nCó một chút thay đổi về thiết kế bàn phím trên những mẫu laptop đời mới dòng thinkpad và Thinkpad P51 cũng sẽ như vậy, có vẻ cần một chút thời gian để người mua quen với nó khi mà những trải nghiệm cũ đã quá ấn tượng. Tuy vậy xét trên thị trường vẫn rất có có mẫu laptop nào đem lại trải nghiệm gõ phím thích như trên Thinkpad P51 nói riêng và dòng thinkpad nói chung.\r\nSử dụng track point màu đỏ là điều thú vị nhất trên thinkpad P51 tất nhiên với nhưng ai mới mua dung thinkpad thì hoàn toàn có thể sử dụng touchpad phía dưới bàn phím với cảm giác mượt, chính sách, độ nẩy của các phím chuột rất thích tay.\r\nCác kết nối ngoại vi mới nhanh hơn\r\nViệc loại bọ những kết nối cũ đang trở thành xu hướng mà nhiều hãng đã tiến hành và Thinkpad P51 cũng sẽ như vậy khi được trang bị các kết nối thế hệ mới như Mini Displayport, usb 3.0, thunderbolt, hdmi, usb type c và không có sự xuất hiện của ổ DVD.\r\nThời lượng pin khá tốt\r\nThinkpad P51 mặc dù có màn hình có độ phân giải cao và các thành phần đòi hỏi sức mạnh, tuy nhiên vẫn có thể sử dụng trong khoảng 4 tiếng đồng hồ với pin 6 cell hơn khá nhiều so với các mẫu laptop khác.\r\nTổng kết\r\nThinkPad P51 kết hợp hiệu suất tổng thể và đồ họa với màn hình đầy màu sắc, thiết kế bền và thời lượng pin khá tốt. Nếu bạn đang tìm kiếm một máy tính xách tay xách tay có cấu hình cao dễ dàng cho các công việc chuyên nghiệp như lập trình, thiết kế 3d hay làm kiến trúc thì một lựa chọn cấu hình như Lenovo Thinkpad P51 là rất đáng lưu tâm.\r\n', 22890000.00, 2, 'thinkpadp51.png', 1, 0, '2024-12-26 15:53:04', NULL),
(19, 'ThinkPad T490', 'Cảm nhận đầu tiên về Laptop Lenovo Thinkpad t490 đó là phong cách thiết kế có nhiều nét giống với những người anh, em tiền nhiệm trước đó về kiểu dáng nhưng lại có độ mỏng và tính di chuyển đáng ngưỡng mộ. Máy được làm bằng chất liệu cacbon đen sang trọng, nổi bật trên nắp máy là Logo ThinkPad màu trắng và có chấm đỏ làm điểm nhấn cho máy. Vẫn giữ được công nghệ bàn phím làm hai lỏng rất nhiều khách hàng khó tình nhất!\r\nLaptop Lenovo Thinkpad t490 máy mới 100%. LaptopAZ.vn có chế độ bảo hành sau bán hàng hấp dẫn, bảo hành 12 tháng phần cứng, bào hành phần mềm trọn đời, bao test đổi trả trong 15 ngày đầu nên khách hàng yên tâm khi mua hàng.\r\nMỏng nhẹ và tinh tế\r\nVới trọng lượng chỉ từ 1.27kg, ThinkPad t490 có tính di động rất cao. Viền màn hình vát kim cương được thiết kế nhỏ lại để khiến diện tích hiển thị lớn hơn nhiều so với các mẫu trước đó và một loạt những tùy chọn màn hình như màn hình cảm ứng, tích hợp tính năng PrivacyGuard và cả công nghệ hiển thị Dolby Vision®. Thời lượng sử dụng pin sẽ cao hơn và tính năng kết nối toàn cầu LTE-A sẽ khiến cho chiếc laptop này trở thành một chiếc laptop doanh nhân cao cấp.\r\nMàn hình tuyệt đẹp\r\nViền màn hình trên t490 được thu nhỏ lại giúp cho diện tích hiển thị được tăng lên đáng kể, trông như màn hình 13 inch nhưng có khả năng hiển thị của màn hình 14inch.\r\n \r\nCông nghệ tần nhạy sáng cao (HDR) Dolby Vision® p được tích hợp trên màn hình 2K WQHD sẽ giúp cho độ sáng được tăng lên rất nhiều, mở rộng tỉ lệ độ tương phản, làm cho màu sắc trở nên siêu chuẩn, các chi tiết sẽ trở nên thực hơn. Kết hợp với card đồ họa rời và T490 sẽ trở nên rất thích hợp cho những người làm về Multimedia (đa phương tiện). Hoặc bạn cũng có thể chọn màn hình FHD giúp tiết kiệm điện năng và tăng thời lượng pin lên khà nhiều.\r\n \r\nBền bỉ trong mọi môi trường\r\n \r\nVượt qua 12 bài kiểm tra tiêu chuẩn quân đội về độ bền và hơn 200 lần kiểm tra về khả năng làm việc trong môi trường khắc nghiệt: Dù là Bắc Cực hay bão cát sa mạc, dù là không trọng lực hay va đập thì cũng không là gì so với t490.\r\n\r\nNghe nhạc chân thật\r\nCông nghệ âm thanh vòm Dolby Audio™ Premium  cho phép âm thanh phát to và rõ hơn, thậm chí bạn còn có thể nghe được từng từ khi nghe Opera. Âm thanh siêu thật và sống động hệt như trong rạp chiếu phim giúp bạn có những giây phút giải trí tuyệt vời.\r\nKhả năng sạc nhanh siêu tốc\r\nt490 có thể trụ đến 20 giờ làm việc liên tục và nếu sắp hết pin, công nghệ sạc siêu nhanh (Rapid Charge) sẽ giúp bạn hồi phục đến 80% lượng pin chỉ trong 1 giờ.\r\n\r\nLuôn luôn kết nối\r\nDù bạn có ở ngoài không gian hay đang ở trong bàn làm việc, t490 luôn kết nối với bạn. Card kết nối toàn cầu LTE-A có khả năng kết nối đến bất cứ nơi nào trên thế giới.\r\n \r\nBảo mật cao hơn\r\n \r\nTùy chọn Camera hồng ngoại IR và bộ cảm ứng vân tay sẽ hỗ trợ bạn đăng nhập bằng phương pháp sinh trắc một cách nhanh chóng mà không phải nhập mật khẩu.\r\nKết nối mạng nhanh hơn tới 6 lần\r\nCard WiFi Intel® Dual-Band 9560 802.11AC (2 x 2)  có tốc độ tối đa lên tới 1.73Gbs, nhanh hơn gần 6 lần so với Card WiFi chuẩn N phổ thông hiện nay. Cho phép bạn thoải mái kết nối mạng không dây dù đang ở cách xa đến một dãy nhà.\r\n', 22890000.00, 2, 'thinkpadt490.png', 1, 0, '2025-02-13 15:13:18', NULL),
(145, 'abcd', 'abcd', 10000000.00, 1, 'hp1.png', 3, 1, '2025-02-21 01:07:45', '2025-02-21 01:07:23');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `discount_id` (`discount_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`discount_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
