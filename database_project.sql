-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2022 at 07:17 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `last_updated`) VALUES
(1, 'Robin Sharma', '2022-01-19 17:18:30'),
(2, 'Tony Buổi Sáng', '2022-01-19 05:55:23'),
(3, 'Rosie Nguyễn', '2022-01-19 09:07:23'),
(4, 'Robert T Kiyosaki', '2022-01-19 09:41:23'),
(5, 'Napoleon Hill', '2022-01-19 13:55:23'),
(6, 'Jim Collins', '2022-01-19 16:55:23'),
(7, 'Tô Hoài', '2022-01-19 11:55:23'),
(8, 'Philip Kotler', '2022-01-19 08:55:23'),
(9, 'Nguyễn Trọng Nhân', '2022-01-19 11:55:23'),
(10, 'Jack D Schwager', '2022-01-19 10:55:23'),
(11, 'Paulo Coenho', '2022-01-19 11:33:02'),
(12, 'Victor Hugo', '2022-01-19 11:33:14'),
(13, 'Margaret Mitchell', '2022-01-19 11:40:18'),
(14, 'Conan Doyle', '2022-01-19 11:53:02'),
(15, 'Emily Bronlé', '2022-01-19 12:00:34'),
(16, 'O\'henry', '2022-01-19 12:10:04'),
(17, 'Ernest Hemingway', '2022-01-19 12:10:08'),
(18, 'Khốn Ỷ Nguy Lâu', '2022-01-19 12:35:21'),
(19, 'Thiên Diễn', '2022-01-19 12:43:49'),
(20, 'Niccolò Machiavelli', '2022-01-19 14:56:55'),
(21, 'Lý Vĩnh Linh', '2022-01-19 15:07:40'),
(22, 'Nguyễn Thị Kim', '2022-01-19 15:07:40'),
(23, 'Emmanuel Macron', '2022-01-19 15:11:13'),
(24, 'Svetlana Alexievich', '2022-01-19 15:14:46'),
(25, 'Ron Chernow', '2022-01-19 15:20:45'),
(26, 'Lê Quýnh', '2022-01-19 15:24:08'),
(27, 'Phil Knight', '2022-01-19 15:28:49');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `tittle` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_time` datetime NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `tittle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `import_price` float NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_date` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `tittle`, `image`, `price`, `discount`, `import_price`, `quantity`, `content`, `publication_date`, `created_date`, `last_updated`) VALUES
(1, 'Nhà lãnh đạo không chức danh', 'assets/image/book/1_.png', 80000, 10000, 68000, 28, '                                                                          Làm thế nào để làm việc và tạo ảnh hưởng với mọi người như một siêu sao, bất chấp bạn đang ở vị trí nào\nMột phương pháp để nhận biết và nắm bắt cơ hội vào những thời điểm thay đổi\nNhững bí mật thật sự của sự đổi mới\nMột chiến lược tức thời để xây dựng đội nhóm tuyệt vời và trở thành một nhà cung cấp ngoạn mục của khách hàng\nNhững thủ thuật cứng rắn giúp trở nên mạnh mẽ cả về thể chất lẫn tinh thần để có thể đi đầu trong lĩnh vực của bạn\nNhững phương thức thực tế để đánh bại sự căng thẳng, xây dựng một ý chí bất bại, giải phóng năng lượng, và cân bằng cuộc sống cá nhân                                                                                                                                                                                                                          ', NULL, '2021-03-19 10:08:41', '2022-01-19 16:12:12'),
(2, 'Trên Đường Băng', 'assets/image/book/2.png', 100000, 12000, 80000, 30, '                                        Nếu như tuổi trẻ vẫn chưa bỏ bạn quá xa, hãy đọc cuốn sách này ít nhất một lần.Trên đường băng của (dượng) Tony (các bạn trẻ gọi Tony như thế, chính tác giả đã viết như vậy trong phần mở đầu) là một trong những quyển sách bán chạy nhất, nổi tiếng nhất, hoặc là các lí do khác .Nhưng mà bất kể vì lý do gì mà bạn đang tính là sẽ mua quyển sách này thì GOBE có thể chắc chắn rằng bạn đã không lãng phí tiền bạc của mình đâu .Làm thế nào vào được những trường Ivy League.Làm thế nào để xin được việc.Làm thế nào để có vốn khởi nghiệp                                                                                                            ', NULL, '2021-02-19 10:23:41', '2022-01-19 10:24:34'),
(3, 'Tuổi trẻ đáng giá bao nhiêu', 'assets/image/book/3.png', 90000, 5000, 75000, 14, ' “Bạn hối tiếc vì không nắm bắt lấy một cơ hội nào đó, chẳng có ai phải mất ngủ.\r\n\r\nBạn trải qua những ngày tháng nhạt nhẽo với công việc bạn căm ghét, người ta chẳng hề bận lòng.\r\n\r\nBạn có chết mòn nơi xó tường với những ước mơ dang dở, đó không phải là việc của họ.\r\n\r\nSuy cho cùng, quyết định là ở bạn. Muốn có điều gì hay không là tùy bạn.\r\n\r\nNên hãy làm những điều bạn thích. Hãy đi theo tiếng nói trái tim. Hãy sống theo cách bạn cho là mình nên sống.\r\n\r\nVì sau tất cả, chẳng ai quan tâm.”\r\n\r\n“Tôi đã đọc quyển sách này một cách thích thú. Có nhiều kiến thức và kinh nghiệm hữu ích, những điều mới mẻ ngay cả với người gần trung niên như tôi.\r\n\r\nTuổi trẻ đáng giá bao nhiêu? được tác giả chia làm 3 phần: HỌC, LÀM, ĐI.\r\n\r\nNhưng tôi thấy cuốn sách còn thể hiện một phần thứ tư nữa, đó là ĐỌC.\r\n\r\nHãy đọc sách, nếu bạn đọc sách một cách bền bỉ, sẽ đến lúc bạn bị thôi thúc không ngừng bởi ý muốn viết nên cuốn sách của riêng mình.\r\n\r\nNếu tôi còn ở tuổi đôi mươi, hẳn là tôi sẽ đọc Tuổi trẻ đáng giá bao nhiêu?                                                                                                             ', NULL, '2021-09-19 10:27:39', '2022-01-19 10:29:36'),
(4, 'Truyện Tây Bắc', 'assets/image/book/15.png', 119000, 20000, 90000, 46, '“Đọc Truyện Tây Bắc, chúng ta có cảm tưởng đó vừa là một bản cáo trạng, vừa là một khúc tình ca: cáo trạng đối với phong kiến miền núi và thực dân, tình ca ngợi khen cảnh đẹp, tập quán hay, tinh thần cách mạng, quan hệ giữa người và người Tây Bắc, như bản tình ca viết với một bút pháp trữ tình nồng đượm và nên thơ.\r\n\r\n”Giáo sư HUỲNH LÝ“\r\n\r\nTruyện Vợ chồng A Phủ cũng như tập Truyện Tây Bắc nói chung bộc lộ rõ nét phong cách của Tô Hoài: màu sắc dân tộc đậm đà; chất thơ, chất trữ tình đằm thắm, lời văn giàu tính tạo hình.”', NULL, '2021-08-19 10:32:51', '2022-01-19 16:08:10'),
(5, 'Tiếp Thị 4.0', 'assets/image/book/5.png', 100000, 10000, 80000, 25, '                                        Quyển cẩm nang vô cùng cần thiết cho những người làm tiếp thị trong thời đại số. Được viết bởi cha đẻ ngành tiếp thị hiện đại, cùng hai đồng tác giả là lãnh đạo của công ty MarkPlus, quyển sách sẽ giúp bạn lèo lái thế giới không ngừng kết nối và khách hàng không ngừng thay đổi để có được nhiều khách hàng hơn, xây dựng thương hiệu hiệu quả hơn, và cuối cùng kinh doanh thành công hơn. Ngày nay khách hàng không có nhiều thời gian và sự chú ý dành cho thương hiệu của bạn – và họ còn bị bao quanh bởi vô số các chọn lựa. Bạn phải tách khỏi đám đông, phải nổi trội, để gây sự chú ý và truyền đạt thông điệp mà khách hàng muốn nghe.                                                                                             ', NULL, '2021-07-19 10:36:19', '2022-01-19 10:37:22'),
(6, 'Bóc Phốt Tài Chính', 'assets/image/book/6.png', 149000, 12000, 100000, 25, 'Tác giả Nguyễn Trọng Nhân sinh ra ở Vũng Tàu, học ở Úc. Là một người tự nhận là viết vì rảnh, rảnh tới độ chủ đề nào cũng tham gia. Muốn chinh phục thế giới nhưng chưa nghĩ ra và không thể.\n\nTác giả bắt đầu với những bài viết trên Facebook. Mục đích ban đầu là để thỏa mãn bản thân chứ không mong muốn gì. Qua những bài viết chia sẻ kiến thức, kinh nghiệm của bản thân về tài chinh, chứng khoán tác giả muốn muốn lan tỏa đến nhiều người hơn, vậy là ý tưởng cho chủ đề “Bóc Phốt Tài Chính” ra đời.', NULL, '2021-06-19 10:39:59', '2022-01-19 16:08:51'),
(7, 'Dế Mèn Phiêu Lưu Ký', 'assets/image/book/16.jpg', 163000, 13000, 120000, 18, 'Trong hơn nửa thế kỉ, kể từ ngày đầu tiên ra mắt bạn đọc, năm 1941, \"Dế Mèn phiêu lưu ký\" là một trong những sáng tác tâm đắc nhất của nhà văn Tô Hoài. Tác phẩm đã được tái bản nhiều lần và được dịch ra hơn 20 thứ tiếng trên toàn thế giới và luôn được các thế hệ độc giả nhỏ tuổi đón nhận. Tác phẩm đã được xuất bản với nhiều hình thức khác nhau. Trong đó cuốn \"Dế Mèn phiêu lưu ký\" gồm 52 trang, trên khổ giấy 21,5x28cm là một ấn phẩm đặc biệt phù hợp với các em nhi đồng vì cách kể gọn, dễ nắm bắt. Các tranh diễn hoạ 4 màu sinh động của hoạ sĩ Trương Qua sẽ khiến các em thấy như đang được xem một cuốn phim về chú Dế Mèn nổi tiếng vậy!                                                                                                                                                                                                                                                                         ', NULL, '2021-09-19 10:46:17', '2022-01-19 16:15:16'),
(8, 'Dạy Con Làm Giàu 2', 'assets/image/book/8.png', 250000, 20000, 200000, 41, '                                                                                 Bạn đang đi học? Bạn vừa ra trường và chưa có việc làm? Bạn đang làm việc với mức lương ổn định? Bạn đang làm cho một công ty tư nhân tư nhân? Bạn là một chủ doanh nghiệp nhỏ? Bạn muốn được thoải mái về tiền bạc ? “Dạy con làm giàu tập 2” sẽ là bước khởi đầu cho bạn - những quan điểm mới về đồng vốn và cách sử dụng tiền hiệu quả.                                                                                                                                                   ', NULL, '2021-10-19 10:54:05', '2022-01-19 16:09:32'),
(9, 'Nghĩ Giàu & Làm Giàu', 'assets/image/book/9.png', 108000, 30000, 70000, 39, '                                        Nghĩ giàu Làm giàu là một trong những cuốn sách bán chạy nhất trên thế giới mọi thời đại.\r\nNó đã được tái bản hơn 60 triệu bản và phát hành với hàng trăm ngôn ngữ trên thế giới, được công nhận là cuốn sách tạo ra nhiều triệu phú nhất                                                                                                                                                                        ', NULL, '2021-11-19 10:59:11', '2022-01-19 11:02:18'),
(10, 'Từ Tốt Đến Vĩ Đại', 'assets/image/book/10.png', 110500, 10000, 90000, 41, 'Jim Collins cùng nhóm nghiên cứu đã miệt mài nghiên cứu những công ty có bước nhảy vọt và bền vững để rút ra những kết luận sát sườn, những yếu tố cần kíp để đưa công ty từ tốt đến vĩ đại. Đó là những yếu tố khả năng lãnh đạo, con người, văn hóa, kỷ luật, công nghệ… Những yếu tố này được nhóm nghiên cứu xem xét tỉ mỉ và kiểm chứng cụ thể qua 11 công ty nhảy vọt lên vĩ đại. Mỗi kết luận của nhóm nghiên cứu đều hữu ích, vượt thời gian, ý nghĩa vô cùng to lớn đối với mọi lãnh đạo và quản lý ở mọi loại hình công ty (từ công ty có nền tảng và xuất phát tốt đến những công ty mới khởi nghiệp), và mọi lĩnh vực ngành nghề. Đây là cuốn sách nên đọc đối với bất kỳ lãnh đạo hay quản lý nào!                                                                                                                                               ', NULL, '2021-12-19 11:04:31', '2022-01-19 11:06:02'),
(11, 'Đời Ngắn Đừng Ngủ Dài', 'assets/image/book/11.png', 100000, 10000, 80000, 45, '                                        “Mọi lựa chọn đều giá trị. Mọi bước đi đều quan trọng. Cuộc sống vẫn diễn ra theo cách của nó, không phải theo cách của ta. Hãy kiên nhẫn. Tin tưởng. Hãy giống như người thợ cắt đá, đều đặn từng nhịp, ngày qua ngày. Cuối cùng, một nhát cắt duy nhất sẽ phá vỡ tảng đá và lộ ra viên kim cương. Người tràn đầy nhiệt huyết và tận tâm với việc mình làm không bao giờ bị chối bỏ. Sự thật là thế.”\r\n\r\nBằng những lời chia sẻ thật ngắn gọn, dễ hiểu về những trải nghiệm và suy ngẫm trong đời, Robin Sharma tiếp tục phong cách viết của ông từ cuốn sách Điều vĩ đại đời thường để mang đến cho độc giả những bài viết như lời tâm sự, vừa chân thành vừa sâu sắc.                                                                                                                       ', NULL, '2021-05-19 15:41:49', '2022-01-19 15:55:26'),
(12, '3 Người Thầy Vĩ Đại', 'assets/image/book/12.png', 163000, 20000, 120000, 77, '                                                                                 “Tôi đã nếm trải nhiều thất bại trong hành trình đi qua những tháng ngày của mình. Thế nhưng, mỗi chướng ngại cuối cùng đều lại chính là một bàn đạp đưa tôi gần hơn nữa tới chân lý trong tâm khảm và cuộc đời tốt đẹp nhất của mình.\r\n\r\nCho dù tôi có thu thập được bao nhiêu tài sản vật chất đi chăng nữa thì cái thằng người mà tôi nhìn thấy trong tấm gương phòng tắm mỗi buổi sáng vẫn y nguyên – tôi không hề hạnh phúc hơn và không hề cảm thấy tốt hơn tí nào. Suy ngẫm nhiều hơn về thực trạng cuộc sống của mình, tôi bắt đầu nhận thức được sự trống rỗng ngay trong tim mình. Tôi bắt đầu chú ý đến những tiếng thầm thì lặng lẽ của con tim, những điều chỉ dẫn tôi rời bỏ nghề nghiệp mình đã chọn và bắt đầu quá trình tìm kiếm tâm hồn một cách nghiêm túc. Tôi bắt đầu suy nghĩ về lý do tại sao tôi lại ở đây, trên hành tinh này, và nhiệm vụ cụ thể của tôi là gì. Tôi tự hỏi tại sao cuộc đời mình lại không có tác dụng và cần phải thực hiện những thay đổi sâu sắc nào để giúp mình đi đúng hướng. Tôi xem xét những niềm tin cốt lõi, những giả định, và những lăng kính mà mình nhìn ra thế giới, và tôi tự cam kết làm sạch những lăng kính không lành mạnh.”                                                                                                                                      ', NULL, '2021-04-19 15:54:20', '2022-01-19 15:56:45'),
(13, 'Tư Duy Làm Giàu', 'assets/image/book/13.png', 130000, 5000, 80000, 49, 'Tập hợp những bài diễn thuyết, bài báo, bài nói chuyện bất hủ của Napoleon Hill, tác giả được mệnh danh là người tạo ra các nhà triệu phú của thế giới, Tư duy làm giàu mang đến độc giả cái nhìn đa chiều hơn về nguyên tắc thành công, không chỉ trong kinh doanh mà còn trong các khía cạnh khác của đời sống.\r\n\r\nSẽ không quá lời khi nói rằng, Napoleon Hill (1883 - 1970) là tác giả có ảnh hưởng rộng rãi nhất, mạnh mẽ nhất trong lĩnh vực thành công cá nhân hơn bất cứ một nhân vật nào trong lịch sử. Với công trình kéo dài gần 30 năm mang tên Nghĩ giàu và làm giàu (Think and Grow Rich), ông được mệnh danh là “người tạo ra các nhà triệu phú của thế giới” bởi đã truyền nguồn cảm hứng và một triết lý thành công dựa trên phương pháp tư duy tích cực, hiệu quả và những phẩm chất tốt đẹp trong tính cách cho hàng triệu người trên thế giới. Bộ tác phẩm nghĩ giàu làm giàu của ông được xem là một trong những tác phẩm bán chạy nhất mọi thời đại.                                                                ', NULL, '2021-08-19 15:59:01', '2022-01-19 15:59:01'),
(14, 'Trên Hành Trình Tự Học', 'assets/image/book/14.jpg', 80000, 10000, 69000, 13, '                                        Sau thành công của Tuổi Trẻ Đáng Giá Bao Nhiêu, tác giả lên đường du học và nhìn lại quá trình học tập của mình từ khi ra trường cho đến hôm nay. Trên Hành Trình Tự Học là tập hợp những bài viết liên quan đến việc học.\r\n\r\nSách chia làm bốn phần chính: Học Để Biết, Học Để Làm, Học Để Chuyển Mình, Học Để Chung Sống. Mỗi phần đều được viết dựa trên kinh nghiệm của tác giả và từ những câu chuyện của những người bạn mà tác giả có dịp gặp gỡ, chia sẻ. Tác giả cũng xem xét về các khía cạnh khác nhau của sự học: cách học trực tuyến, học từ trường, từ gia đình… Song song đó là nhận định tổng quan về giá trị chung của việc học.                                                                                  ', NULL, '2021-08-18 16:02:40', '2022-01-19 16:03:20'),
(15, 'Điều Vĩ Đại Đời Thường', 'assets/image/book/17.jpg', 90000, 5000, 78000, 68, '                                        Hành trình trở nên vĩ đại khởi đầu từ những điều thật giản dị và gần gũi, cũng giống như hành trình vạn dặm khởi đầu từ một bước chân giản đơn. 101 câu chuyện và ý tưởng của tác giả trong quyển sách này chính là 101 bài học minh chứng cho triết lý đơn sơ ấy.\r\nKhông có cuộc sống nào là hoàn hảo, tất cả chúng ta phải đối mặt với nhiều thử thách, từ đơn giản đến nghiêm trọng… Nhưng chúng ta đều có quyền lựa chọn vượt lên mọi nghịch cảnh để vươn tới vị trí cao nhất và tốt nhất của cuộc sống.                                                                                 ', NULL, '2021-11-19 16:18:49', '2022-01-19 16:21:52'),
(16, 'Cà Phê Cùng Tony', 'assets/image/book/18.png', 90000, 20000, 68000, 30, '                                        Có đôi khi vào những tháng năm bắt đầu vào đời, giữa vô vàn ngả rẽ và lời khuyên, khi rất nhiều dự định mà thiếu đôi phần định hướng, thì CẢM HỨNG là điều quan trọng để bạn trẻ bắt đầu bước chân đầu tiên trên con đường theo đuổi giấc mơ của mình. Cà Phê Cùng Tony là tập hợp những bài viết của tác giả Tony Buổi Sáng. Đúng như tên gọi, mỗi bài nhẹ nhàng như một tách cà phê, mà bạn trẻ có thể nhận ra một chút gì của chính mình hay bạn bè mình trong đó: Từ chuyện lớn như định vị bản thân giữa bạn bè quốc tế, cho đến chuyện nhỏ như nên chú ý những phép tắc xã giao thông thường.                                                                                             ', NULL, '2021-12-19 16:21:20', '2022-01-19 16:22:30'),
(17, 'Nhà Giả Kim ', 'assets/image/book/nhagiakim.jpg', 67000, 10000, 79000, 49, 'Tiểu thuyết Nhà giả kim của Paulo Coelho như một câu chuyện cổ tích giản dị, nhân ái, giàu chất thơ, thấm đẫm những minh triết huyền bí của phương Đông. Trong lần xuất bản đầu tiên tại Brazil vào năm 1988, sách chỉ bán được 900 bản. Nhưng, với số phận đặc biệt của cuốn sách dành cho toàn nhân loại, vượt ra ngoài biên giới quốc gia, Nhà giả kim đã làm rung động hàng triệu tâm hồn, trở thành một trong những cuốn sách bán chạy nhất mọi thời đại, và có thể làm thay đổi cuộc đời người đọc.                                                                            ', NULL, '2022-01-19 17:32:29', '2022-01-19 17:32:29'),
(18, 'Những người khốn khổ', 'assets/image/book/sach-nhung-nguoi-khon-kho.jpg', 340000, 20000, 310000, 77, 'Cuộc sống cao đẹp của Giăng Văngiăng (Jean Valjean) - người phải ngồi tù suốt 19 năm chỉ vì một chiếc bánh mỳ, tình nhân ái bao dung và tấm lòng độ lượng của đức cha Mirien, sự đeo bám dai dẳng của mật thám Giave (Javert), những mưu đồ đen tối và độc ác của vợ chồng Tênácđiê (Thenardier), sự ngây thơ trong trắng của Côdét (Cosette), cậu bé lang thang Ga-vơ-rốt (Gavroche). sự nhiệt tình hăng hái của Mariuýt (Marius)... Tất cả đều được khắc họa một cách sinh động. NHỮNG NGƯỜI KHỐN KHỔ là bài hát ca ngợi tình yêu và tự do của Giăng Văngiăng - một con người tái sinh trong đau khổ và tuyệt vọng.                                                                                                                                                    ', NULL, '2022-01-19 17:39:54', '2022-01-19 17:55:21'),
(19, 'Thằng gù Nhà thờ Đức bà', 'assets/image/book/sach-thang-gu-nha-tho-duc-ba.jpg', 213000, 0, 179000, 20, 'Nhà thờ Đức bà như một nhân chứng lịch sử, tạo ra một cuộc hoán đổi ngoạn mục giữa hai con người đại diện cho hai tầng lớp xã hội khác nhau. Một linh mục cao sang, quyền lực, được mọi con người từ dưới nhà thờ Đức bà nhìn lên, cảm thấy ông ta thật vĩ đại, lớn lao, nhưng tên gù đứng trên đỉnh của ngọn tháp nhà thờ, nhìn xuống dưới thấy người linh mục, ông ta thật nhỏ bé, tầm thường, và cũng là con người trần tục như ai. Là một tên gù bị xã hội cự tuyệt, ngay cả người linh mục nhận nuôi hắn cũng không phải vì lòng tốt mà chỉ là muốn để cái đức lại cho em ông ta, cứ tưởng như hắn cũng chỉ là một viên đá bị lỗi của tạo hóa, vậy mà hắn cũng biết yêu, biết ghen, biết buồn. Và chính tình yêu đã đưa hắn đi đến tận cùng cảm xúc của loài người. Kết thúc của tác phẩm để lại nhiều ám ảnh cho người đọc.                                                                                                                ', NULL, '2022-01-19 17:45:39', '2022-01-19 17:54:47'),
(20, 'Ngày Cuối Cùng Của Một Tử Tù', 'assets/image/book/ngay_cuoi_cung_cua_mot_tu_tu_1_2020_11_19_16_19_08.jpg', 95000, 15000, 75000, 28, 'Tác phẩm ghi lại 24 giờ cuối cùng của cuộc đời một tử tù qua nhật ký của nhân vật xưng tôi - nhân vật không tên tuổi, lai lịch, không nguồn gốc tội lỗi, không ai biết anh ta phạm tội gì đến nỗi trở thành tử tù. Anh ta kể về không gian sinh tồn là nhà tù, những con người va chạm với anh ta trong 24 giờ đó là bạn tù, linh mục, cai ngục... và những người phụ nữ trong tâm tưởng gồm mẹ, vợ và con gái. Tất cả những suy tư đó đan xen với dòng suy nghĩ về việc anh ta sắp bị thi hành án.\r\n\r\nTác phẩm này gần như chứa đừng đầy đủ phong cách, mô típ nhân vật và chủ đề quen thuộc trong sáng tác văn xuôi của Victor Hugo. Đặc biệt hơn nữa, có lẽ đây là tác phẩm chứa đựng nhiều tâm sự thầm kín, những nhức nhối khôn cùng của một nhà văn suốt đời đấu tranh cho quyền “được sống” của con người: án tử hình và sự xóa bỏ vĩnh viễn nó khỏi cuộc sống nhân loại.                                                                            ', NULL, '2022-01-19 17:48:57', '2022-01-19 17:48:57'),
(21, 'Cuốn Theo Chiều Gió', 'assets/image/book/8936203360035.jpg', 567000, 23000, 515000, 48, 'Lấy bối cảnh thời Nội chiến và tái thiết với các cuộc chiến ác liệt, những mâu thuẫn sâu sắc về chính trị, xã hội và cảnh đói nghèo sau chiến tranh, Cuốn theo chiều gió kể về Scarlett O’Hara, cô tiểu thư mắt xanh với dòng máu Ireland kiêu hãnh. Từ cô thiếu nữ mười sáu tuổi sống trong nhung lụa, bồng bột theo đuổi tình yêu, Scarlett đã đi qua những tháng ngày tuyệt vọng nhất, nếm trải mất mát, để cứu lấy mảnh đất Tara thân yêu, cứu lấy gia đình. Nhưng mặc cho phong ba bão táp của cuộc đời, nàng vẫn giữ đó niềm lạc quan vô tận. Và giữa thời thế loạn lạc, bên cạnh nàng vẫn có một Rhett Butler ngang tàng và bất cần nhưng luôn dành cho Scarlett tình yêu và sự dung túng, một Melanie Hamilton dịu dàng thương mến đã đồng hành với nàng qua mọi đau thương, cũng như một Ashley Wilkes hiền hòa luôn đắm chìm trong hoài niệm. Tất cả họ đã sống, đã yêu và đã tạo nên những hình tượng văn chương bất hủ, xóa nhòa mọi chuẩn mực, khiến người đọc vừa yêu vừa ghét, vừa nhớ mãi không quên.                                                                                                                ', NULL, '2022-01-19 17:52:44', '2022-01-19 17:54:27'),
(22, 'Sherlock Holmes (Hộp 3 Cuốn)', 'assets/image/book/untitled_2_2.png', 360000, 88000, 220000, 49, '                                          Có lẽ kể từ khi văn học viết trở thành một phần không thể thiếu trong đời sống tinh thần của con người, đã có rất nhiều nhân vật bước ra từ trang sách của các nhà văn đi vào đời sống, thậm chí trở thành những biểu tượng bất hủ trong tâm thức nhân loại. Sherlock Holmes của Athur Conan Doyle cũng giống như Don Quixote của Cervantes, Jean Valjean của Victor Hugo, AQ của Lỗ Tấn hay Túy Kiều của Nguyễn Du… đã thoát thai từ một nhân vật hư cấu và trở thành một biểu tượng của đời sống. Tuy nhiên, trong trường hợp Sherlock Holmes, ngoài những siêu kỉ lục về một trong những tác phẩm văn học bán chạy nhất thế giới, một trong những nhân vật văn học được nhiều người biết đến nhất, một nhân vật văn học được tôn vinh dưới rất nhiều hình thức (Viện bảo tàng mang tên Sherlock Holmes, Hội những người hâm mộ Sherlock Holmes, thậm chí là đạo Sherlockian do những người hâm mộ cuồng nhiệt nhân vật này lập nên)..., thì điều đặc biệt hơn cả là phương pháp suy diễn logic của Sherlock Holmes đã được các cơ quan bảo vệ pháp luật sừng sỏ của Anh quốc như MI6 và Scotland Yard đưa vào giáo trình huấn luyện cho nhân viên của họ.                                                                                                              ', NULL, '2022-01-19 17:59:43', '2022-01-19 21:06:50'),
(23, 'Đồi Gió Hú ', 'assets/image/book/doi_gio_hu___tai_ban_2018_1_2018_10_29_11_46_36.jpg', 120000, 12000, 80000, 49, 'Đồi gió hú, câu chuyện cổ điển về tình yêu ngang trái và tham vọng chiếm hữu, cuốn tiểu thuyết dữ dội và bí ẩn về Catherine Earnshaw, cô con gái nổi loạn của gia đình Earnshaw, với gã đàn ông thô ráp và điên rồ mà cha cô mang về nhà rồi đặt tên là Heathcliff, được trình diễn trên cái nền những đồng truông, quả đồi nước Anh cô quạnh và ban sơ không kém gì chính tình yêu của họ. Từ nhỏ đến lớn, sự gắn bó của họ ngày càng trở nên ám ảnh. Gia đình, địa vị xã hội, và cả số phận rắp tâm chống lại họ, bản tính dữ dội và ghen tuông tột độ cũng hủy diệt họ, vậy nên toàn bộ thời gian hai con người yêu nhau đó đã sống trong thù hận và tuyệt vọng, mà cái chết chỉ có ý nghĩa khởi đầu. Một khởi đầu mới để hai linh hồn mãnh liệt đó được tự do tái ngộ, khi những cơn gió hoang vắng và điên cuồng tràn về quanh các lâu đài trong Đồi gió hú...                                                                            ', NULL, '2022-01-19 18:03:45', '2022-01-19 18:03:45'),
(24, 'Chiếc Lá Cuối Cùng', 'assets/image/book/chiec-la-cuoi-cung-bia1.jpg', 95000, 15000, 67150, 40, ' O’ Henry tên thật là William Sydney Porter (1862 - 1910) là nhà văn nổi tiếng người Mỹ với lối viết truyện ngắn độc đáo, hấp dẫn. Với 10 tập truyện đã được xuất bản, ông được xem là nhà văn có bút lực dồi dào và được so sánh với bậc thầy người Nga Anton Checkhov (1860-1904). Nhiều sáng tác của ông đã trở thành những truyện ngắn mẫu mực và kinh điển.\r\n\r\nTập truyện ngắn “Chiếc lá cuối cùng” do Nhà xuất bản Văn học phát hành tháng 4 năm 2020 gồm 13 truyện ngắn đặc sắc của O’ Henry. Trong đó, truyện ngắn “Chiếc lá cuối cùng”  được lấy làm tiêu đề cho tập truyện. Đây là phẩm quen thuộc với các thế hệ học sinh Việt Nam, được trích dạy trong chương trình Trung học cơ sở và để lại nhiều ấn tượng sâu sắc đáng nhớ bởi tính nhân văn trong truyện.                                    ', NULL, '2022-01-19 18:12:43', '2022-01-19 18:51:36'),
(25, 'O.Henry - Truyện Ngắn Chọn Lọc', 'assets/image/book/2021_06_23_09_20_42_1-390x510.jpg', 125000, 22000, 80000, 20, '  O. Henry là cây bút truyện ngắn có bút lực dồi dào nổi tiếng ở Mỹ. Ông nổi tiếng với những tác phẩm có kết thúc bất ngờ, những tình huống ngẫu nhiên, pha trộn nét mỉa mai châm biếm và giọng điệu thương cảm, xót xa khi viết về những người lao động bình thường, những con người sống dưới đáy của một xã hội xa hoa giàu có.\r\n\r\nTruyện ngắn của O. Henry thể hiện nét đa dạng của xã hội Mỹ đương thời. Người ta có thể tìm thấy những nhân vật làm các nghề mà chính tác giả đã trải qua, và còn nữa: chủ cửa hiệu, nhân viên bán hàng, ký giả, họa sĩ, bác sĩ…                                                                          ', NULL, '2022-01-19 18:15:10', '2022-01-19 18:15:10'),
(26, 'Những Vụ Kỳ Án Của Sherlock Holmes', 'assets/image/book/nhung_vu_ky_an_cua_sherlock_holmestb_1_2020_05_30_12_53_10.jpg', 138000, 20000, 75000, 18, 'Những Vụ Kỳ Án Của Sherlock Holmes(TB)\r\n\r\nSherlock Holmes là tiểu thuyết của Sir Arthur Conan Doyle lần đầu xuất hiện vào năm 1887 trong cuốn tiểu thuyết trinh thám “A Study in Scarlet”. Từ đó, nhà văn Anh đã viết 4 tiểu thuyết và 55 truyện ngắn về Holmes. Qua hàng thế kỷ, vị thám tử đã trở thành một biểu tượng văn hóa và là nguồn cảm hứng của rất nhiều cây bút khác. Cuốn “Mary Russell” nổi tiếng của Laurie King từng tái hiện cuộc sống của Holmes sau khi “về hưu”.\r\n\r\nNhững Vụ Kỳ Án Của Sherlock Holmes đưa chúng ta sống cùng những vụ án ly kỳ, hóc búa, biến hoá vô cùng, và cũng lắm dữ dội, hiểm nguy, mà ở đó ông thể hiện tài ba phá án phi phàm của mình. Cuốn sách cuốn hút các bạn trẻ còn bởi lối kể chuyện nhẹ nhàng, nhưng bí hiểm và vô cùng thông minh. Và hơn thế nữa, còn nhiều THÍ DỤ TRẮC NGHIỆM, vừa giúp hiểu rõ hơn, khám phá lý thú hơn các vụ án lừng lẫy của Sherlock Holmes, vừa tăng cường khả năng phán đoán cho độc giả.                                                                            ', NULL, '2022-01-19 18:18:04', '2022-01-19 18:18:04'),
(27, 'Ông Già Và Biển Cả', 'assets/image/book/2017_08_30_11_53_17_1-390x510.jpg', 245000, 20000, 156000, 40, 'The last novel Ernest Hemingway saw published, \"The Old Man and the Sea\" has proved itself to be one of the enduring works of American fiction. It is the story of an old Cuban fisherman and his supreme ordeal: a relentless, agonizing battle with a giant marlin far out in the Gulf Stream. Using the simple. powerful language of a fable, Hemingway takes the timeless themes of courage in the face of defeat and personal triumph won from loss and transforms them into a magnificnet twentieth-century classic.                                                                            ', NULL, '2022-01-19 18:27:42', '2022-01-19 18:27:42'),
(28, 'Chuông Nguyện Hồn Ai ', 'assets/image/book/image_180164_1_8.jpg', 155000, 20000, 105000, 45, 'Nhà văn Mỹ lừng danh Ernest Hemingway, tên đầy đủ là Ernest Miller Hemingway, sinh năm 1899 tại Oak Park, bang Illinois, có bố là bác sĩ và mẹ là ca sĩ. E. Hemingway học hành dang dở, chưa qua trung học đã trốn nhà trốn trường bỏ đi kiếm sống, từ làm công ở trang trại, làm túi đấm ở lò quyền Anh đến làm thông tín viên cho tờ “Kansas City Star”… Chiến tranh thế giới thứ nhất (1914-1918) nổ ra, E. Hemingway tình nguyện làm lái xe cứu thương cho Hội Chữ thập đỏ ở vùng Bắc Italy và bị thương tại đó, mở đầu cho hàng trăm vết thương ông mang trên mình khi sống sót bước ra khỏi cuộc chiến.                                                                            ', NULL, '2022-01-19 18:31:38', '2022-01-19 18:31:38'),
(29, 'Truyện Ngắn Ernest Hemingway', 'assets/image/book/2020_07_11_09_53_52_1-390x510.jpg', 222000, 30000, 172000, 30, ' Tập truyện này được in lần đầu vào năm 1996, được tái bản năm 1998, năm tôi bảo vệ luận án tiến sĩ về nhân vật của Ernest Hemingway. Đa số truyện trong tập này là do tôi dịch để phục vụ đề tài nghiên cứu. Công việc đó, giờ nhìn lại quả quá sức tưởng tượng. Thử hình dung, một người thực sự bắt đầu học tiếng Anh từ năm 1992 (hồi phổ thông chỉ bập bõm đôi chữ), vừa học cao học, vừa làm nghiên cứu sinh, vừa xoay xở đủ cách để kiếm sống, hằng đêm đánh vật với từng con chữ Anh ngữ trong sách của một bậc thầy văn chương để cố chuyển tải cho được hồn cốt của ông quả là điều diệu kỳ. Phải nói, tôi đã trưởng thành rất nhiều từ những trang viết của Hemingway. Tôi yêu quý và ngưỡng mộ ông, một phần như là kẻ mang nợ phong cách, tư tưởng ông. Lần in lại này, tôi bổ sung thêm hai truyện do Lê Nguyên Phương chuyển ngữ, đưa con số tác phẩm lên 60 truyện. Hai mươi năm nay, vì vấn đề bản quyền mà sách chưa được in lại. Lần này, nhờ nỗ lực của Nhà xuất bản Tổng hợp Thành phố Hồ Chí Minh mà sách được ra mắt bạn đọc.                                                                           ', NULL, '2022-01-19 18:33:30', '2022-01-19 18:33:30'),
(30, 'Gần Mặt Cách Lòng', 'assets/image/book/bia-1_gan-mat-cach-long.jpg', 149000, 49000, 120000, 13, '                                        Để báo ơn, Thẩm Mặc đồng ý thực hiện một giao dịch kỳ lạ với quý ngài doanh nhân thành đạt– Quý Minh Hiên, để bảo toàn hạnh phúc vẹn tròn cho em gái của ngài Quý. Cậu vô tình vướng vào một mối quan hệ phức tạp, hoàn toàn không biết phải làm sao, chỉ ngày ngày ngẩn ngơ nhung nhớ mối tình cũ của thời thanh xuân tươi đẹp.\r\n\r\nĐến khi Thẩm Mặc nhận ra đâu mới là tình yêu đích thực của mình, thì cái người vẫn luôn sớm tối bên cậu đã không còn ở bên cậu nữa rồi.                                                                                                                ', NULL, '2022-01-19 18:36:14', '2022-01-19 21:12:41'),
(31, 'Khẩu Thị Tâm Phi', 'assets/image/book/tbph_kh_u_th_t_m_phib_a.png', 159000, 30000, 110000, 49, '  Khẩu Thị Tâm Phi\r\n\r\nRanh giới giữa “bạn bè” và “kẻ thù” trên đời này vốn dĩ rất mong manh. Có người vốn thân thiết như ruột thịt lại có thể trở mặt thành thù, cũng có người thù ghét nhau cả đời nhưng sâu thẳm trong tâm can lại luôn che chở đối phương…\r\n\r\nMối duyên giữa xà yêu Luyện Thiên Sương và Quỷ vương Lăng Phi đã kéo dài cả trăm năm. Từ khi còn là tiểu xà, quỷ non, đến khi thành đại xà, quỷ già, kẻ thù gặp nhau đỏ mắt phân tranh, bất phân thắng bại, dây dưa không dứt. Càng trớ trêu thay nữ nhân mà cả hai người cùng đem lòng mến mộ lại nên duyên cùng kẻ khác, thậm chí còn để lại đứa con cho hai người cùng nuôi dưỡng.                                                                          ', NULL, '2022-01-19 18:38:12', '2022-01-19 18:38:12'),
(32, 'Phàm Tâm Đại Động', 'assets/image/book/2021_06_22_10_22_06_1-390x510.jpg', 149000, 10000, 98000, 46, ' Thế gian này rộng lớn lắm, bỏ lỡ nhau một lần, cũng là bỏ lỡ một đời…\r\n\r\nTrương Triệu Huyền là thần tiên trên trời, sống đã trăm ngàn năm tuổi. Còn Diệp Thanh chỉ là một chàng thanh niên người phàm lại đem lòng ái mộ vị thần tiên cao xa vời vợi kia. Nhưng lời chân tình chưa kịp tỏ bày, đã bỏ lỡ nhau suốt ba trăm năm. “Duyên phận đều được định sẵn trong số mệnh. Nếu vô duyên ắt sẽ lướt qua vai nhau, đôi bên chẳng hề hay biết. Hoặc như những kẻ gái trai si tình trên thế gian, dẫu cho đau khổ quằn quại, sau cùng cũng chẳng gặt hái được kết quả gì.”                                                                           ', NULL, '2022-01-19 18:40:34', '2022-01-19 18:40:34'),
(33, 'Khi Chủ Tịch Không Yêu Nữ Chính', 'assets/image/book/bia_khi-chu-tich-khong-yeu-nu-chinh---ban-dac-biet-1_1.jpg', 218000, 20000, 168000, 55, ' Khi Chủ Tịch Không Yêu Nữ Chính (Bộ 2 tập)\r\n\r\nSở Ca - một thanh niên dân kỹ thuật luôn dành phần lớn thời gian ru rú ở nhà bỗng nhiên xuyên không vào thế giới truyện ngôn tình cẩu huyết phi logic. Điều đáng buồn, trong kịch bản này cậu chính là nhân vật phản diện đã bị nam chính - ngài chủ tịch Satan lạnh lùng cưỡi mây bảy màu đến lấy mạng. Chẳng biết làm cách nào để quay trở lại, cậu chỉ đành lặng lẽ rơi những giọt nước mắt đắng cay cho cuộc đời xuyên không của mình, đồng thời hạ quyết tâm: Phải quý trọng sinh mạng, né xa tình tiết gốc.\r\n\r\nThế nhưng, diễn biến câu chuyện có vẻ sai sai. Nam chính Hiên Viên Ngạo Thiên cầm nhầm kịch bản, cậu bạn mờ nhạt trong suy nghĩ của Sở Ca lại là em trai của nam chính, kẻ thù kiếp trước bỗng chốc trở thành bạn thân ở kiếp này. Chỉ có mình nữ chính là vẫn “tuân thủ” đúng quỹ đạo, song dường như cô ta lại có chút vấn đề về thần kinh. Vậy rốt cuộc Sở Ca phải làm gì đây?\r\n\r\nSở Ca quyết định yên phận trải qua cuộc sống của một học sinh cấp ba bình thường, nhưng dường như vị thần nắm giữ tình tiết truyện lại không muốn dễ dàng buông tha cho cậu. Năm lần, bảy lượt để cậu “đụng độ” với nam chính vừa giàu vừa đẹp trai, lại mắc bệnh ảo tưởng vô cùng nặng, khiến tình tiết kịch bản ban đầu dần đi chệch hướng.\r\n\r\nKẻ thù kiếp trước đã hoá thành bạn thân, lại không đem lòng yêu nữ chính. Cả nam chính lạnh lùng cũng chẳng ngó ngàng tới nữ chính. Sở Ca bớt lo lắng phần nào về chuyện sẽ bị nam chính cưỡi mây bảy màu đến tiêu diệt. Thế nhưng, nam chính lại đột nhiên muốn chịu trách nhiệm với cậu. Là một thanh niên thẳng băng chưa vấp vào tình yêu trong đời, rốt cuộc Sở Ca sẽ quyết định giải quyết chuyện này ra sao?\r\n\r\nBằng cách dẫn dắt đáng yêu, câu từ hài hước và tình tiết vô cùng bất ngờ, “Khi chủ tịch không yêu nữ chính” sẽ mang đến cho bạn một câu chuyện dễ thương về hành trình chinh phục tình yêu không dành cho nữ chính của ngài chủ tịch Satan lạnh lùng.\r\n\r\nMã hàng	8935325003387\r\nTên Nhà Cung Cấp	Skybooks\r\nTác giả	Thiên Diễn\r\nNgười Dịch	Hala\r\nNXB	NXB Dân Trí\r\nNăm XB	2022\r\nNgôn Ngữ	Tiếng Việt\r\nTrọng lượng (gr)	620\r\nKích Thước Bao Bì	20.5 x 14.5 cm\r\nSố trang	616\r\nHình thức	Bìa Mềm\r\nSản phẩm hiển thị trong	\r\nSkybooks\r\nSản phẩm bán chạy nhất	Top 100 sản phẩm Ngôn Tình bán chạy của tháng\r\nKhi Chủ Tịch Không Yêu Nữ Chính (Bộ 2 tập)\r\n\r\nSở Ca - một thanh niên dân kỹ thuật luôn dành phần lớn thời gian ru rú ở nhà bỗng nhiên xuyên không vào thế giới truyện ngôn tình cẩu huyết phi logic. Điều đáng buồn, trong kịch bản này cậu chính là nhân vật phản diện đã bị nam chính - ngài chủ tịch Satan lạnh lùng cưỡi mây bảy màu đến lấy mạng. Chẳng biết làm cách nào để quay trở lại, cậu chỉ đành lặng lẽ rơi những giọt nước mắt đắng cay cho cuộc đời xuyên không của mình, đồng thời hạ quyết tâm: Phải quý trọng sinh mạng, né xa tình tiết gốc.\r\n\r\nThế nhưng, diễn biến câu chuyện có vẻ sai sai. Nam chính Hiên Viên Ngạo Thiên cầm nhầm kịch bản, cậu bạn mờ nhạt trong suy nghĩ của Sở Ca lại là em trai của nam chính, kẻ thù kiếp trước bỗng chốc trở thành bạn thân ở kiếp này. Chỉ có mình nữ chính là vẫn “tuân thủ” đúng quỹ đạo, song dường như cô ta lại có chút vấn đề về thần kinh. Vậy rốt cuộc Sở Ca phải làm gì đây?                                                                           ', NULL, '2022-01-19 18:43:39', '2022-01-19 18:43:39'),
(34, 'Quân Vương', 'assets/image/book/8936071674722.jpg', 160000, 1000, 100000, 49, 'Ít có quyển sách nào gây nhiều tranh cãi trong lần xuất bản đầu tiên như Quân vương, và số sách có thể duy trì những cuốc tranh cãi đó trong suốt hơn năm thế kỉ sau lại càng ít hơn. Có nhiều luồng ý kiến về những mưu đồ chính trị xấu và và vô lương tâm được nêu trong tuyệt tác của Niccolò Machiavelli, nhưng những luận thuyết này lại rất thực dụng và sâu sắc. Là một trong những tác phẩm có tầm ảnh hưởng nhất, Quân vương đến nay vẫn đang làm kim chỉ nam cho tư tưởng và hành động của nhiều chính trị gia và doanh nhân trong thời hiện đại.                                                    ', NULL, '2022-01-19 20:54:34', '2022-01-19 20:54:34'),
(35, 'Singapore Của Tôi', 'assets/image/book/2_1.jpg', 500000, 200000, 100000, 9, '                                        Singapore Của Tôi là tập hợp những bài viết của Lý Vỹ Linh con gái duy nhất của cố Thủ tướng Singapore Lý Quang Diệu kiêm bác sĩ chỉ đạo chuyên môn cấp cao về thần kinh nhi tại Viện Khoa học Thần kinh Quốc gia Singapore, đăng trên các báo Straits Time và Sunday Time, gồm những chuyên mục Think-Tank, một chuyên mục Op-ed ( Ý kiến công luận) của tờ Straits Time, cùng những bài viết giải đáp về các sự kiện lớn. Độc giả cũng có thể tìm thấy trong sách nhiều bài viết về cuộc sống của gia đình danh giá nhất Singapore và những suy tư của Lý Vỹ Linh về giáo dục, y tế và sự phát triển của Singapore.                                                                                 ', NULL, '2022-01-19 21:05:04', '2022-01-19 21:08:24'),
(36, 'Cách Mạng', 'assets/image/book/3_1.jpg', 320000, 180000, 210000, 28, 'Cách Mạng được xuất bản ngày 24-11-2016, đã bán được gần 200.000 bản và là một trong những quyển sách bán chạy nhất nước Pháp trong năm 2016. Không phải ngẫu nhiên mà bản quyền dịch thuật cuốn sách này bán được cho hơn 20 quốc gia, một con số chưa từng có đối với một chính trị gia người Pháp.  Điều gì khiến cuốn sách nhỏ này hấp dẫn đến vậy?                                   ', NULL, '2022-01-19 21:10:25', '2022-01-19 21:10:25'),
(37, 'Những Nhân Chứng Cuối Cùng', 'assets/image/book/4.jpg', 365000, 140000, 150000, 55, '                                                             Những nhân chứng cuối cùng (ấn bản lần đầu năm 1985) là quyển thứ hai trong loạt năm quyển “Những giọng nói không tưởng”: Chiến tranh không mang một khuôn mặt phụ nữ, Những cậu bé kẽm, Lời nguyện cầu Chernobyl và Thời second hand, đã mang đến cho nữ nhà văn người Belarus Svetlana Alexievich giải Nobel Văn chương 2015. Trong một lần trả lời phỏng vấn báo chí Ba Lan năm 2013, nữ nhà văn cho biết ý tưởng viết quyển sách thứ hai này xuất phát từ những chuyến đi thực tế cho quyển sách đầu tiên Chiến tranh không mang một khuôn mặt phụ nữ. Cuộc chiến tranh chống phát xít Đức cướp mất hàng chục triệu con người Liên Xô đã khiến nhiều ngôi làng Xô viết sau chiến tranh không còn bóng dáng đàn ông, và tại những ngôi nhà góa bụa đó, bà thường nghe được hai câu chuyện: Một của người mẹ và một của đứa con. Nhờ đó, bà phát hiện: “còn một kho cất giữ nỗi đau còn tinh khôi, hoàn toàn chưa được động tới”: ký ức trẻ thơ. Người ta đã quen nghe nói về chiến tranh từ người lớn, nhưng chỉ những chuyện kể từ miệng trẻ em mới có thể bộc lộ hết sự điên rồ của chiến tranh, sự hung bạo phi nhân tính không gì có thể biện bạch.                                                                                          ', NULL, '2022-01-19 21:14:32', '2022-01-19 21:16:49'),
(39, 'Combo Gia Tộc Morgan + Titan', 'assets/image/book/5_2.jpg', 1000000, 200000, 700000, 3, '                                                                                                                 Một triều đại ngân hàng Mỹ và sự trỗi dậy của nền tài chính hiện đại\r\n\r\nHình thành, phát triển, sụp đổ rồi lại hồi sinh, có lẽ không một tổ chức nào ẩn chứa nhiều giai thoại, bí mật hay chủ đề gây tranh cãi gay gắt như đế chế ngân hàng Mỹ – Gia tộc Morgan. Đạt Giải thưởng Sách quốc gia và hiện được coi là một tác phẩm kinh điển, Gia tộc Morgan là cuốn tiểu sử tham vọng nhất từng được viết về một triều đại ngân hàng Mỹ. Cuốn sách vẽ nên bức tranh toàn diện về bốn thế hệ nhà Morgan và các công ty bí mật, mạnh mẽ mà họ sở hữu. Với thế lực của mình, đế chế Morgan đã biến nền kinh tế non trẻ của Mỹ thành một cường quốc công nghiệp mạnh nhất thế giới và khiến trung tâm tài chính thế giới dịch chuyển từ London sang New York. Vượt xa cả lịch sử đơn thuần của ngành ngân hàng Mỹ, cuốn sách chính là câu chuyện về sự tiến hóa của nền tài chính hiện đại. Dựa trên các cuộc phỏng vấn rộng rãi cùng quyền truy cập đặc biệt vào kho lưu trữ của gia tộc này, tác đã khắc họa nên bức chân dung hấp dẫn về câu chuyện riêng của nhà Morgan và thế giới hiếm hoi của giới tinh hoa Mỹ và Anh.\r\n\r\nTRÍCH ĐOẠN:                                                                                                                   ', NULL, '2022-01-19 21:20:27', '2022-01-19 21:26:25'),
(40, 'Bắc Hành Lược Ký', 'assets/image/book/6_1.jpg', 400000, 26000, 200000, 11, '                                                                      Bắc hành lược ký là một “hồi ký chính trị” của Trường Phái hầu Lê Quýnh mà trọng điểm là mười năm ông bị cầm tù trong nhiều nhà ngục tại Trung Hoa sau khi theo vua Lê Chiêu Thống chạy sang phương Bắc lưu vong. Có thể xem nó như một phong vũ biểu đo lường gió mưa, thăng trầm của thời cuộc, phản ánh những lên xuống trong bang giao Thanh-Việt từ đời Quang Trung sang đời Cảnh Thịnh và sau cùng là đời Gia Long.\r\n\r\nBản dịch mới lần này dựa theo bản Hán văn của tạp chí Nam Phong, có đối chiếu, bổ túc, tham khảo các bản in trong Việt Nam Hán văn tiểu thuyết tùng san và lưu trữ tại Viện Hán Nôm Hà Nội, cùng những tài liệu, văn thư của triều Thanh trong cùng thời điểm, nhằm giúp bạn đọc có cái nhìn đa chiều, sáng tỏ hơn khi nghiên cứu về giai đoạn lịch sử từ cuối triều Lê đến đầu triều Nguyễn.                                                                                  ', NULL, '2022-01-19 21:23:44', '2022-01-19 21:24:39'),
(41, 'Gã Nghiện Giày', 'assets/image/book/7.jpg', 240000, 200000, 120000, 120, '                                                                         Một câu chuyện cuốn hút, và truyền cảm hứng.... 24 tuổi, lấy bằng MBA ở Đại học Stanford, trăn trở với những câu hỏi lớn của cuộc đời, băn khoăn không biết tiếp tục làm việc cho một tập đoàn lớn hay tạo dựng sư nghiệp riêng cho mình... 24 tuổi, năm 1962, Phil Knight quyết định rằng con đường khác thường mới là lựa chọn duy nhất dành cho ông... Rồi ông khoác ba lô đi đến Tokyo, Hongkong, Bangkok, Việt Nam, Calcutta, Kathmandu, Bombay, Cairo, Jerusalem, Rome, Florence, Milan, Venice, Paris,, Munich, Vienna, London, Hy Lạp... Để rồi khi về lại quê nhà ở bang Oregon, ông quyết định mở công ty nhập khẩu giày chạy từ Nhật. Ban đầu chỉ một đôi để thử, rồi vài chục đôi, bán tại tầng hầm của gia đình bố mẹ Phil. Đam mê, quyết tâm, dám chấp nhận thất bại, vượt qua nhiều chông gai từ chuyện thiếu vốn, đến chuyện cạnh tranh từ đối thủ nhập khẩu khác… Phil Knight đã đưa công ty nhập khẩu giày ra đời với 50 đô-la mượn của bố phát triển đến doanh nghiệp có doanh số hơn 1 triệu đô-la chỉ 10 năm sau đó, năm 1972.                                                                               ', NULL, '2022-01-19 21:28:34', '2022-01-19 21:29:17'),
(42, 'Bão Lửa Và Cuồng Nộ', 'assets/image/book/8.jpg', 600000, 0, 300000, 3, '                                                               Bão lửa và cuồng nộ - Nội tình nhà Trắng thời Trump (Tựa gốc: Fire and Fury - Inside the Trump White House) của cây bút chính trị Michael Wolff tiết lộ toàn bộ những bí mật về năm đầu tiên ngồi ghế Tổng thống Mỹ của ông Donald Trump.\r\n\r\nSách phát hành ngày 5/1/2018 tại Mỹ, ngay lập tức gây chấn động trong thị trường xuất bản; đứng đầu danh sách những cuốn sách bán chạy nhất trên Amazon, sách bán chạy nhất của The New York Times. Chỉ trong một tuần đầu, Fire and Fury đã bán được hơn 1,7 triệu bản; tiếp tục là cuốn sách gây chú ý đặc biệt đến giữa năm 2018!\r\n\r\nVỀ TÁC PHẨM\r\n\r\n“Bão lửa và cuồng nộ” được viết dựa trên quá trình trải nghiệm quan sát và các cuộc phỏng vấn với nhiều nhân vật trong cuộc của một nhà báo, tác giả kỳ cựu về lĩnh vực chính trị Mỹ, với hàng loạt chuyện thâm cung bí sử, đã hé lộ những góc khuất, những âm mưu tác động đến vị tổng thống vốn nổi tiếng về tâm tính bất thường. Tác giả cũng phân tích rất rõ cuộc chiến giữa các phe nhóm quanh Tổng thống, sự kiện liên quan đến chính quyền Trump và nước Nga bằng lối kể khách quan. Và tất nhiên, cuốn sách càng tăng thêm phần hấp dẫn nhờ giọng văn hài hước và những nhận xét sắc bén đến mức đã khiến tổng thống Trump nổi trận lôi đình.\r\n\r\nTrình bày sự khởi đầu và vận hành của một cỗ máy chính trị quyền lực bằng lối viết sinh động, giễu nhại, hài hước, Michael Wolff làm cho bức chân dung tổng thống Mỹ đương nhiệm Donald Trump có sức hấp dẫn như một vở hài kịch đậm đặc chất phi lý. Điều này tạo ra sức cuốn hút lạ lùng như khi ta bước vào thế giới tiểu thuyết của Kafka!\r\n\r\nMô tả tổng thống Trump như một đứa trẻ lớn xác tỏ ra biết tuốt, không thích lắng nghe mà chỉ thích nói, thích được khen ngợi, thích được nịnh nọt, thích được tất cả mọi người yêu mến mình, dễ bị tác động, hay thay đổi, không thích đọc bất cứ thứ gì, chỉ xem ti-vi hoặc ảnh, thích trả thù ai làm trái ý, hay đưa ra những quyết định bốc đồng và nực cười, thích nói linh tinh trên Twitter,…\r\n\r\nDũng cảm, biến hóa, thuyết phục, đó là những gì có thể nhận thấy được ở thứ báo chí sắc bén, đầy tinh thần tự do, kiêu hãnh trước quyền lực mà Wolff thể hiện qua tác phẩm này.\r\n\r\nMột bản hỗn xướng chính trị đồ sộ, dị thường, chưa từng có trong lịch sử nước Mỹ.\r\n\r\nVỀ TÁC GIẢ\r\n\r\nMichael Wolff là cây bút xã luận có nhiều tác phẩm gây tiếng vang; từng nhận nhiều giải thưởng báo chí danh giá tại Mỹ. Những bình luận chính trị của ông thường xuất hiện trên các báo, tạp chí:Vanity Fair, New York, The Hollywood Reporter, GQ, USA Today và The Guardian.\r\n\r\nTác phẩm đã xuất bản: Television Is the New Television: The Unexpected Triumph of Old Media in the Digital Age, The Man Who Owns the News: Inside the Secret World of Rupert Murdoch, Autumn of the Moguls: My Misadventures with the Titans, Poseurs, and Money Guys, Who Mastered and Messed Up Big Media Burn Rate: How I Survived the Gold Rush Years on the Internet, Where We Stand, White Kids.\r\n\r\nNHẬN ĐỊNH\r\n\r\n“Điều làm cho quyển sách này đáng chú ý đến vậy là bức chân dung châm biếm và vui nhộn về một người đàn ông rỗng tuếch, hút vào trong lỗ đen của cái tôi nghèo nàn và tham lam của mình cả thế giới…” —The Guardian\r\n\r\n“Một cuốn biên niên ký cực kỳ thú vị về một chính quyền mà chỉ trong vòng một năm đã bị bao phủ bởi rất nhiều xì-căng-đan và khủng hoảng... Wolff đã cho độc giả cảm giác người trong cuộc mà không cần đến lối viết kịch tính không cần thiết.” —The San Francisco Chronicle\r\n\r\nMã hàng	8936144200049\r\nTên Nhà Cung Cấp	Phanbook\r\nTác giả	Michael Wolff\r\nNXB	NXB Hội Nhà Văn\r\nNăm XB	2018\r\nNgôn Ngữ	Tiếng Việt\r\nTrọng lượng (gr)	420\r\nKích Thước Bao Bì	24 x 16 x 0.5 cm\r\nSố trang	400\r\nHình thức	Bìa Mềm\r\nSản phẩm hiển thị trong	\r\nDONALD TRUMP VÀ NHỮNG CÂU CHUYỆN\r\nTủ Sách Donald Trump\r\nSản phẩm bán chạy nhất	Top 100 sản phẩm Chính Trị bán chạy của tháng\r\nQuyển sách phơi bày nội tình đầy bất thường của Nhà Trắng thời Donald Trump gây chấn động toàn thế giới vừa ra mắt bạn đọc Việt Nam!\r\n\r\nĐây là một cơn siêu bão hướng thẳng vào Nhà Trắng dưới thời Trump.\r\n\r\nBão lửa và cuồng nộ - Nội tình nhà Trắng thời Trump (Tựa gốc: Fire and Fury - Inside the Trump White House) của cây bút chính trị Michael Wolff tiết lộ toàn bộ những bí mật về năm đầu tiên ngồi ghế Tổng thống Mỹ của ông Donald Trump.\r\n\r\nSách phát hành ngày 5/1/2018 tại Mỹ, ngay lập tức gây chấn động trong thị trường xuất bản; đứng đầu danh sách những cuốn sách bán chạy nhất trên Amazon, sách bán chạy nhất của The New York Times. Chỉ trong một tuần đầu, Fire and Fury đã bán được hơn 1,7 triệu bản; tiếp tục là cuốn sách gây chú ý đặc biệt đến giữa năm 2018!                                                                                         ', NULL, '2022-01-19 21:30:53', '2022-01-19 21:31:37'),
(43, 'Combo Sự Thật Donald Trump', 'assets/image/book/9.jpg', 2000000, 1000000, 1200000, 1, '                                                                                    Đây là cuốn sách New York Times Bestseller ĐẦU TIÊN tiết lộ mối liên hệ giữa Donald Trump với Liên Bang Nga - thứ đã làm tốn không ít giấy mực của giới truyền thông toàn cầu.\r\n\r\n \r\n\r\nTrong \"Sự thật về Donald Trump\", những khía cạnh gay cấn và riêng tư nhất của nhân vật thời đại này sẽ được tiết lộ một cách cẩn trọng, dựa trên những tài liệu vững chắc. Thông qua hàng chục năm nghiên cứu các bài phỏng vấn, báo cáo tài chính, văn kiện tòa án... liên quan đến Donald Trump; tác giả - nhà báo David Cay Johnston cung cấp cho độc giả cái nhìn sâu sắc nhất về người đàn ông khiến cả thế giới phải dõi theo.\r\n\r\n \r\n\r\nĐúng như tiêu đề của nó, tất cả những sự thật về Donald Trump, như lịch sử gia đình phức tạp của ông, các câu chuyện hôn nhân đầy toan tính, sự nghiệp kinh doanh lắm thăng trầm, đế chế Trump hùng mạnh nhưng tai tiếng... đều sẽ được phơi bày trong tác phẩm. Và đương nhiên, chúng ta không thể không bàn tới việc Trump đã lôi kéo rất nhiều cá nhân quyền lực vào quỹ đạo của bản thân như thế nào. Johnston tâp trung phân tích hành vi ứng xử của Trump, để người đọc có thể phần nào hiểu được tính cách của con người kỳ lạ này.\r\n\r\n                                                                    ', NULL, '2022-01-19 21:33:16', '2022-01-19 21:34:05'),
(44, 'Trump - Đừng Bao Giờ Bỏ Cuộc', 'assets/image/book/10.jpg', 120000, 100000, 50000, 2, '                                                                     Trump - Đừng bao giờ bỏ cuộc, doanh nhân nổi tiếng nhất thế giới này thẳng thắn giãi bày những thách thức to lớn nhất, những giây phút tệ hại nhất, và những cuộc chiến khốc liệt nhất - và cách ông biến những nghịch cảnh đó thành các thành công mới.\r\nCuốn sách còn đưa ra những lời khuyên đắt giá trong kinh về: cách phản pháo khi gặp thất bại và trở ngại; biến những vấn đề lớn thành những cơ hội thậm chí còn lớn hơn; cách biến kẻ thù và địch thủ thành bạn bè và đồng minh; cách tận dụng những thất bại trước mắt làm động lực cho bản thân bạn - và khiến bạn kiên cường hơn.                                                                                   ', NULL, '2022-01-19 21:35:17', '2022-01-19 21:35:42'),
(45, 'Med - Putin Bộ Đội Quyền Lực', 'assets/image/book/11.jpg', 69000, 2000, 25000, 12, '                                                                          Medvedev & Putin Bộ Đội Quyền Lực\r\n\r\nCục diện chính trị Nga thay đổi thường mang tính đột ngột, bí mật và khó dự đoán. Medvedev và Putin có quyền sắp xếp chính trị mang tính chiến lược đối với các nhà cầm quyền và những quyền lực tối cao của nước Nga. Putin và Medvedev đã làm rất tốt. Điều quan trọng là, chúng ta đang mong chờ sự kết hợp chính trị và cơ cấu chính trị độc đáo, tuyệt vời này sẽ mang lại những gì cho nước Nga.                                                                              ', NULL, '2022-01-19 21:37:19', '2022-01-19 21:47:08');
INSERT INTO `books` (`id`, `tittle`, `image`, `price`, `discount`, `import_price`, `quantity`, `content`, `publication_date`, `created_date`, `last_updated`) VALUES
(46, 'Nghệ Thuật Bán Hàng Bậc Cao', 'assets/image/book/12(1).jpg', 150000, 0, 120000, 21, '                                                                             Mục tiêu của một thương vụ là đảm bảo khách hàng nhận được giá trị tương xứng, nhưng nếu bạn mang đến cho khách hàng những giá trị còn cao hơn giá trị mà lẽ ra họ sẽ nhận được thì không những bạn đã có một thương vụ thành công mà bạn còn có thêm một khách hàng sẵn lòng giúp bạn có thêm nhiều khách hàng khác nữa.\r\n\r\nTriết lý chứa đựng trong cuốn sách Nghệ Thuật Bán Hàng Bậc Cao thật đơn giản: “bạn có thể có được những tất cả mọi thứ trong cuộc sống nếu bạn biết giúp người khác đạt được điều họ muốn”, thậm chí còn đúng đắn và cần thiết hơn trong cuộc sống hiện nay so với thời kỳ khi cuốn Nghệ Thuật Bán Hàng Bậc Cao được xuất bản lần đầu                                                                           ', NULL, '2022-01-19 21:38:44', '2022-01-19 21:46:35'),
(47, 'Mã Vân Giày Vải ', 'assets/image/book/13_3.jpg', 320000, 190000, 200000, 49, '                                                                                                                                        Mã Vân Giày Vải (Tái Bản 2017)\r\n\r\nNgày nay, ALIBABA là một tập đoàn thương mại điện tử toàn cầu với quy mô và giá trị tài sản khổng lồ (tính đến 2015 là 255.434 tỷ nhân dân tệ, tương đương 41 tỷ đô-la Mỹ), là ngọn cờ đầu trong lĩnh vực thương mại điện tử của Trung Quốc, một trong những biểu tượng mới của nền kinh tế thế giới. Đứng sau sự thành công của tập đoàn này không ai khác chính là Mã Vân - nhà sáng lập của Alibaba. Tuy nhiên, thật khó để chúng ta hình dung ra con đường nào để Mã Vân từ một giáo viên tiếng Anh không chút hiểu biết về công nghệ, trở thành vị Chủ tịch của một tập đoàn thương mại điện tử lớn nhất toàn cầu. Mã Vân được biết đến với nhiều tư cách: Nhà sáng lập, diễn giản, nhà từ thiện và tỷ phú. Với mỗi vai trò, Mã Vân đều gặp hái được những thành công rực rỡ, anh không chỉ là tấm gương điển hình mà hơn thế, anh còn là một hiện tượng rất nhiều người muốn tìm hiểu và khám phá.\r\n\r\nKhông đơn thuần là một cuốn sách viết về tiểu sử - cuộc đời doanh nhân, Mã vân giày vải còn muốn gửi gắm tinh thần lập nghiệp, dấn thân vì lý tưởng và mơ ước đến tất cả những ai đang ấp ủ những dự định và hoài bão lớn lao.                                                                                            ', NULL, '2022-01-19 21:43:06', '2022-01-19 21:46:01'),
(48, ' Liên - Người Được Chọn', 'assets/image/book/14(1).jpg', 165000, 45000, 120000, 33, '                                                                                                                         Đỗ Thị Kim Liên (thường được gọi là Madam Liên, Shark Liên) là một nữ doanh nhân và là Lãnh sự Danh dự nước Cộng hòa Nam Phi tại Việt Nam. Hiện bà đảm nhiệm vị trí Chủ tịch Hội đồng Quản trị Tập đoàn AquaOne, Chủ tịch Hội đồng Quản trị Công ty Cổ phần nước mặt Sông Đuống, Chủ tịch Hội đồng Quản trị Công ty Cổ phần Nước Xuân Mai - Hòa Bình, Chủ tịch Quỹ Môi trường Xanh Việt Nam (Green Vietnam Fund), kiêm Hiệu trưởng trường Đào tạo Quản lý Doanh nghiệp (CBAM), nguyên Chủ tịch Hội đồng Quản trị kiêm Tổng giám đốc Công ty Cổ phần Bảo hiểm AAA.\r\n\r\nCuốn sách “Liên Người Được Chọn” được nhà văn Y Ban và Cộng sự chấp bút. Nhà văn Y Ban, với cảm hứng đặc biệt cho nhân vật đặc biệt, đã hóa thân một cách xuất sắc trong tác phẩm. Những ngày nghiên cứu tài liệu, đi thực tế, gặp gỡ các nhân vật có liên quan và nói chuyện cùng nhân vật đã giúp nhà văn Y Ban nhận ra, nhân vật Shark Liên đã vận dụng thành công 3 định luật. Đó là: Định luật hoa sen, Định luật cây tre và Định luật ve sầu.\r\n\r\nĐịnh luật hoa sen: Đại đa số những người thành công là do nghị lực, mấu chốt là nghị lực. Người ta cho rằng trong cuộc đời mỗi người có khoảng 7 cơ hội để thay đổi cuộc đời. Những cơ hội này đến với những người kiên trì dốc sức làm việc từng ngày một thì mới có thể bắt gặp.                                                                                                           ', NULL, '2022-01-19 21:44:51', '2022-01-19 23:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `books_authors`
--

CREATE TABLE `books_authors` (
  `author_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books_authors`
--

INSERT INTO `books_authors` (`author_id`, `book_id`) VALUES
(1, 1),
(1, 11),
(1, 12),
(1, 15),
(2, 2),
(2, 16),
(3, 3),
(3, 14),
(4, 8),
(4, 45),
(5, 9),
(5, 13),
(6, 10),
(7, 4),
(7, 7),
(8, 5),
(9, 6),
(11, 17),
(12, 18),
(12, 19),
(12, 20),
(13, 21),
(14, 22),
(14, 26),
(15, 23),
(16, 24),
(16, 25),
(17, 27),
(17, 28),
(17, 29),
(17, 42),
(17, 43),
(18, 30),
(18, 31),
(18, 32),
(19, 33),
(20, 34),
(21, 35),
(22, 35),
(23, 36),
(23, 47),
(24, 37),
(25, 39),
(25, 44),
(26, 40),
(26, 48),
(27, 41),
(27, 46);

-- --------------------------------------------------------

--
-- Table structure for table `books_genres`
--

CREATE TABLE `books_genres` (
  `book_id` int(11) NOT NULL,
  `genres_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books_genres`
--

INSERT INTO `books_genres` (`book_id`, `genres_id`) VALUES
(1, 4),
(2, 1),
(3, 4),
(4, 7),
(5, 3),
(6, 6),
(7, 7),
(8, 3),
(8, 6),
(9, 1),
(10, 6),
(11, 1),
(12, 4),
(12, 7),
(13, 3),
(13, 6),
(14, 4),
(14, 7),
(15, 4),
(16, 4),
(16, 7),
(17, 4),
(18, 1),
(19, 1),
(19, 9),
(20, 7),
(21, 1),
(21, 8),
(22, 1),
(22, 11),
(23, 1),
(24, 1),
(24, 7),
(25, 7),
(26, 7),
(26, 11),
(27, 4),
(27, 7),
(28, 1),
(29, 7),
(30, 2),
(30, 7),
(31, 2),
(31, 9),
(32, 1),
(32, 2),
(33, 2),
(33, 9),
(34, 8),
(35, 8),
(36, 8),
(37, 8),
(39, 8),
(40, 8),
(41, 3),
(42, 8),
(43, 8),
(44, 8),
(45, 8),
(46, 8),
(47, 8),
(48, 3),
(48, 6);

-- --------------------------------------------------------

--
-- Table structure for table `books_library`
--

CREATE TABLE `books_library` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_time` date NOT NULL,
  `last_updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books_library`
--

INSERT INTO `books_library` (`id`, `book_id`, `path`, `created_time`, `last_updated`) VALUES
(1, 1, 'assets/image/book/1a.png', '2022-01-19', '2022-01-19'),
(2, 1, 'assets/image/book/1b.png', '2022-01-19', '2022-01-19'),
(3, 2, 'assets/image/book/2a.png', '2022-01-19', '2022-01-19'),
(4, 2, 'assets/image/book/2b.png', '2022-01-19', '2022-01-19'),
(5, 3, 'assets/image/book/3a.png', '2022-01-19', '2022-01-19'),
(6, 3, 'assets/image/book/3b.png', '2022-01-19', '2022-01-19'),
(8, 5, 'assets/image/book/5a.png', '2022-01-19', '2022-01-19'),
(9, 5, 'assets/image/book/5b.png', '2022-01-19', '2022-01-19'),
(10, 6, 'assets/image/book/6a.png', '2022-01-19', '2022-01-19'),
(11, 6, 'assets/image/book/6b.png', '2022-01-19', '2022-01-19'),
(14, 8, 'assets/image/book/8a.png', '2022-01-19', '2022-01-19'),
(15, 8, 'assets/image/book/8b.png', '2022-01-19', '2022-01-19'),
(16, 9, 'assets/image/book/9a.png', '2022-01-19', '2022-01-19'),
(17, 10, 'assets/image/book/10a.png', '2022-01-19', '2022-01-19'),
(18, 10, 'assets/image/book/10b.png', '2022-01-19', '2022-01-19'),
(19, 11, 'assets/image/book/11a.png', '2022-01-19', '2022-01-19'),
(20, 11, 'assets/image/book/11b.jpg', '2022-01-19', '2022-01-19'),
(21, 12, 'assets/image/book/12a.jpg', '2022-01-19', '2022-01-19'),
(22, 12, 'assets/image/book/12b.jpg', '2022-01-19', '2022-01-19'),
(23, 14, 'assets/image/book/14a.jpg', '2022-01-19', '2022-01-19'),
(24, 14, 'assets/image/book/14b.jpg', '2022-01-19', '2022-01-19'),
(25, 15, 'assets/image/book/17a.jpg', '2022-01-19', '2022-01-19'),
(26, 15, 'assets/image/book/17b.png', '2022-01-19', '2022-01-19'),
(27, 17, 'assets/image/book/8935235226272_1.jpg', '2022-01-19', '2022-01-19'),
(28, 17, 'assets/image/book/8935235226272_2.jpg', '2022-01-19', '2022-01-19'),
(29, 20, 'assets/image/book/ngay_cuoi_cung_cua_mot_tu_tu_2_2020_11_19_16_19_08.jpg', '2022-01-19', '2022-01-19'),
(30, 21, 'assets/image/book/8936203360035-1.jpg', '2022-01-19', '2022-01-19'),
(31, 21, 'assets/image/book/8936203360035-2.jpg', '2022-01-19', '2022-01-19'),
(32, 21, 'assets/image/book/8936203360035-5.jpg', '2022-01-19', '2022-01-19'),
(33, 21, 'assets/image/book/z2473807188423_6219d1b4d58093c0fbe2d925bbac6e87.jpg', '2022-01-19', '2022-01-19'),
(34, 22, 'assets/image/book/1_71_3.jpg', '2022-01-19', '2022-01-19'),
(35, 22, 'assets/image/book/2_21_6.jpg', '2022-01-19', '2022-01-19'),
(36, 23, 'assets/image/book/doi_gio_hu___tai_ban_2018_2_2018_10_29_11_46_36.jpg', '2022-01-19', '2022-01-19'),
(37, 23, 'assets/image/book/doi_gio_hu___tai_ban_2018_3_2018_10_29_11_46_36.jpg', '2022-01-19', '2022-01-19'),
(38, 23, 'assets/image/book/doi_gio_hu___tai_ban_2018_4_2018_10_29_11_46_36.jpg', '2022-01-19', '2022-01-19'),
(39, 24, 'assets/image/book/2021_08_02_14_23_10_2-390x510(1).jpg', '2022-01-19', '2022-01-19'),
(40, 24, 'assets/image/book/2021_08_02_14_23_10_3-390x510(1).jpg', '2022-01-19', '2022-01-19'),
(41, 25, 'assets/image/book/2021_06_23_09_20_42_2-390x510.jpg', '2022-01-19', '2022-01-19'),
(42, 25, 'assets/image/book/2021_06_23_09_20_42_3-390x510.jpg', '2022-01-19', '2022-01-19'),
(43, 26, 'assets/image/book/nhung_vu_ky_an_cua_sherlock_holmestb_2_2020_05_30_12_53_10.jpg', '2022-01-19', '2022-01-19'),
(44, 26, 'assets/image/book/nhung_vu_ky_an_cua_sherlock_holmestb_3_2020_05_30_12_53_10.jpg', '2022-01-19', '2022-01-19'),
(45, 26, 'assets/image/book/nhung_vu_ky_an_cua_sherlock_holmestb_4_2020_05_30_12_53_10.jpg', '2022-01-19', '2022-01-19'),
(46, 27, 'assets/image/book/1_56_1.jpg', '2022-01-19', '2022-01-19'),
(47, 27, 'assets/image/book/3_11_6.jpg', '2022-01-19', '2022-01-19'),
(48, 27, 'assets/image/book/4_37.jpg', '2022-01-19', '2022-01-19'),
(49, 27, 'assets/image/book/5_1_16.jpg', '2022-01-19', '2022-01-19'),
(50, 28, 'assets/image/book/2020_04_17_13_50_23_2-390x510.jpg', '2022-01-19', '2022-01-19'),
(51, 29, 'assets/image/book/2020_07_11_09_53_52_2-390x510.jpg', '2022-01-19', '2022-01-19'),
(52, 29, 'assets/image/book/2020_07_11_09_53_52_3-390x510.jpg', '2022-01-19', '2022-01-19'),
(53, 29, 'assets/image/book/image_195509_1_6351.jpg', '2022-01-19', '2022-01-19'),
(54, 31, 'assets/image/book/kttpuntitled-1.jpg', '2022-01-19', '2022-01-19'),
(55, 31, 'assets/image/book/sach-nentrang.png', '2022-01-19', '2022-01-19'),
(56, 31, 'assets/image/book/tbph_kh_u_th_t_m_phibookmark-nentrang.png', '2022-01-19', '2022-01-19'),
(57, 32, 'assets/image/book/2021_06_22_10_22_06_2-390x510.jpg', '2022-01-19', '2022-01-19'),
(58, 32, 'assets/image/book/2021_06_22_10_22_06_3-390x510.jpg', '2022-01-19', '2022-01-19'),
(59, 33, 'assets/image/book/600-khi-chu-tich-khong-yeu-nu-chinh---ban-dac-biet-1_1.jpg', '2022-01-19', '2022-01-19'),
(60, 33, 'assets/image/book/bia_khi-chu-tich-khong-yeu-nu-chinh---ban-dac-biet-1_1(1).jpg', '2022-01-19', '2022-01-19'),
(61, 33, 'assets/image/book/bia_khi-chu-tich-khong-yeu-nu-chinh---ban-dac-biet-2_1.jpg', '2022-01-19', '2022-01-19'),
(62, 34, 'assets/image/book/1.jpg', '2022-01-19', '2022-01-19'),
(63, 34, 'assets/image/book/8936071674722(1).jpg', '2022-01-19', '2022-01-19'),
(64, 34, 'assets/image/book/quan_vuong_2_2018_07_25_08_39_20.jpg', '2022-01-19', '2022-01-19'),
(65, 35, 'assets/image/book/2_1.jpg', '2022-01-19', '2022-01-19'),
(66, 35, 'assets/image/book/2_2.jpg', '2022-01-19', '2022-01-19'),
(67, 35, 'assets/image/book/2_3.jpg', '2022-01-19', '2022-01-19'),
(68, 35, 'assets/image/book/2.jpg', '2022-01-19', '2022-01-19'),
(69, 36, 'assets/image/book/3_1.jpg', '2022-01-19', '2022-01-19'),
(70, 36, 'assets/image/book/3_2.jpg', '2022-01-19', '2022-01-19'),
(71, 36, 'assets/image/book/3_3.jpg', '2022-01-19', '2022-01-19'),
(72, 36, 'assets/image/book/3_4.jpg', '2022-01-19', '2022-01-19'),
(73, 37, 'assets/image/book/4(1).jpg', '2022-01-19', '2022-01-19'),
(77, 39, 'assets/image/book/5_1.jpg', '2022-01-19', '2022-01-19'),
(78, 39, 'assets/image/book/5_2.jpg', '2022-01-19', '2022-01-19'),
(79, 39, 'assets/image/book/5(1).jpg', '2022-01-19', '2022-01-19'),
(80, 40, 'assets/image/book/6_1.jpg', '2022-01-19', '2022-01-19'),
(81, 40, 'assets/image/book/6_2.jpg', '2022-01-19', '2022-01-19'),
(82, 40, 'assets/image/book/6.jpg', '2022-01-19', '2022-01-19'),
(83, 41, 'assets/image/book/7_1.jpg', '2022-01-19', '2022-01-19'),
(84, 41, 'assets/image/book/7_2.jpg', '2022-01-19', '2022-01-19'),
(85, 41, 'assets/image/book/7(1).jpg', '2022-01-19', '2022-01-19'),
(86, 42, 'assets/image/book/8_1.jpg', '2022-01-19', '2022-01-19'),
(87, 42, 'assets/image/book/8_2.jpg', '2022-01-19', '2022-01-19'),
(88, 42, 'assets/image/book/8_3.jpg', '2022-01-19', '2022-01-19'),
(89, 42, 'assets/image/book/8(1).jpg', '2022-01-19', '2022-01-19'),
(90, 43, 'assets/image/book/9(1).jpg', '2022-01-19', '2022-01-19'),
(91, 44, 'assets/image/book/10_1.jpg', '2022-01-19', '2022-01-19'),
(92, 44, 'assets/image/book/10(1).jpg', '2022-01-19', '2022-01-19'),
(93, 45, 'assets/image/book/11(1).jpg', '2022-01-19', '2022-01-19'),
(94, 46, 'assets/image/book/12_1.jpg', '2022-01-19', '2022-01-19'),
(95, 46, 'assets/image/book/12(1).jpg', '2022-01-19', '2022-01-19'),
(96, 47, 'assets/image/book/13_1.jpg', '2022-01-19', '2022-01-19'),
(97, 47, 'assets/image/book/13_3.jpg', '2022-01-19', '2022-01-19'),
(98, 47, 'assets/image/book/13.jpg', '2022-01-19', '2022-01-19'),
(99, 48, 'assets/image/book/14(1).jpg', '2022-01-19', '2022-01-19');

-- --------------------------------------------------------

--
-- Table structure for table `books_publishers`
--

CREATE TABLE `books_publishers` (
  `book_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `started_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books_publishers`
--

INSERT INTO `books_publishers` (`book_id`, `publisher_id`, `started_date`) VALUES
(1, 4, '2019-12-20'),
(2, 1, '2021-07-01'),
(3, 8, '2016-11-10'),
(4, 3, '2018-11-11'),
(5, 1, '2021-01-01'),
(6, 7, '2020-07-15'),
(7, 10, '2021-08-05'),
(8, 1, '2021-06-06'),
(9, 9, '2019-10-10'),
(10, 4, '2021-03-03'),
(11, 3, '2020-07-10'),
(12, 1, '2021-06-13'),
(13, 4, '2020-03-10'),
(14, 3, '2019-02-06'),
(15, 1, '2021-03-06'),
(16, 9, '2019-02-13'),
(17, 2, '2021-02-12'),
(18, 2, '2020-01-27'),
(19, 2, '2021-09-22'),
(20, 4, '2020-12-14'),
(21, 2, '2020-03-19'),
(22, 1, '2019-11-05'),
(23, 5, '2021-12-29'),
(24, 4, '2021-10-07'),
(25, 5, '2020-02-19'),
(26, 1, '2021-12-28'),
(27, 2, '2021-07-19'),
(28, 10, '2021-08-10'),
(29, 3, '2020-06-19'),
(30, 1, '2021-06-28'),
(31, 6, '2019-10-21'),
(32, 6, '2018-02-19'),
(33, 1, '2021-11-03'),
(34, 11, '2020-01-29'),
(35, 1, '2020-11-23'),
(36, 4, '2019-06-26'),
(37, 1, '2018-11-28'),
(39, 13, '2016-06-07'),
(40, 9, '2017-07-04'),
(41, 1, '2018-08-28'),
(42, 10, '2018-04-22'),
(43, 13, '2020-09-19'),
(44, 13, '2022-02-13'),
(45, 4, '2020-04-24'),
(46, 13, '2022-04-21'),
(47, 11, '2020-05-19'),
(48, 4, '2021-10-13'),
(48, 12, '2021-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `money_spent` float NOT NULL DEFAULT 0,
  `last_updated` datetime NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `password`, `first_name`, `last_name`, `avatar`, `birthday`, `phone`, `address`, `email`, `status`, `money_spent`, `last_updated`, `created_date`) VALUES
(1, 'admin', '96e79218965eb72c92a549dd5a330112', 'Shop', 'Admin', './assets/image/user/Book-Icon.png', '0000-00-00', '0964747288', 'Hà Nội', 'bookly@gmail.com', 1, 0, '2022-01-19 15:03:08', '2021-01-19 00:20:44'),
(2, 'phuongnh', '96e79218965eb72c92a549dd5a330112', 'Nguyễn Hồng', 'Phương', './assets/image/user/thphuong(1).png', '0000-00-00', '02438692463', 'Hà Nội', 'phuongnh@gmail.com', 1, 4023500, '2022-01-19 16:37:04', '2021-02-19 11:07:32'),
(3, 'congvt', '96e79218965eb72c92a549dd5a330112', 'Vũ Tài', 'Công', 'assets/image/user/pic-1(1).png', '2020-02-01', '0989999123', 'Hải Dương', 'congvt@gmail.com', 1, 402000, '2022-01-19 14:23:07', '2021-03-19 11:18:42'),
(4, 'haiquang', '96e79218965eb72c92a549dd5a330112', 'Nguyễn Quang', 'Hải', 'assets/image/user/pic-1(1).png', NULL, '0989999274', 'Yên Bái', 'haiquang@gamil.com', 1, 920000, '2021-04-19 11:38:50', '2021-04-19 11:38:50'),
(5, 'dungbt', '96e79218965eb72c92a549dd5a330112', 'Bùi Tiến', 'Dũng', 'assets/image/user/pic-5(1).png', '0000-00-00', '0989999273', 'Thanh Hóa', 'dungbt@gmail.com', 1, 0, '2022-01-19 15:15:02', '2021-05-19 11:49:52'),
(6, 'anleminh', '96e79218965eb72c92a549dd5a330112', 'Lê Minh', 'An', './assets/image/user/user(1).png', '2014-03-19', '0989999273', 'Thái bình', 'leminhan@gmail.com', 1, 318000, '2022-01-19 15:11:38', '2021-06-19 11:55:09'),
(7, 'minhlevu', '96e79218965eb72c92a549dd5a330112', 'Lê Vũ', 'Minh', 'assets/image/user/user(1).png', '0000-00-00', '0989999299', 'Ninh Bình', 'levuminh@gmail.com', 1, 0, '2022-01-19 15:14:42', '2021-07-19 06:00:40'),
(8, 'phuongnt', '96e79218965eb72c92a549dd5a330112', 'Nguyễn Thanh', 'Phương', 'assets/image/user/pic-4(1).png', '0000-00-00', '0978999666', 'TP HCM', 'phuongnt@gmail.com', 1, 0, '2022-01-19 15:15:11', '2021-08-19 07:04:58'),
(9, 'duanlv', '96e79218965eb72c92a549dd5a330112', 'Lê Văn', 'Đức', 'assets/image/user/pic-1(1).png', NULL, '0989999273', 'Huế', 'duclv@gmail.com', 1, 286000, '2022-01-19 07:04:58', '2022-09-19 07:04:58'),
(10, 'thanhnv', '96e79218965eb72c92a549dd5a330112', 'Nguyễn Văn', 'Thanh', 'assets/image/user/pic-1(1).png', '0000-00-00', '0989999273', 'Đà Nẵng', 'thanhnv@gmail.com', 1, 0, '2022-01-19 15:15:26', '2021-10-19 07:07:51'),
(11, 'manhdd', '96e79218965eb72c92a549dd5a330112', 'Đỗ Duy', 'Mạnh', 'assets/image/user/user(1).png', '0000-00-00', '0989999273', 'Hà Giang', 'manhdd@gmail.com', 1, 0, '2022-01-19 15:14:20', '2021-11-19 07:07:51'),
(12, 'huypd', '96e79218965eb72c92a549dd5a330112', 'Phạm Đức', 'Huy', 'assets/image/user/pic-1(1)(1)(1).png', '0000-00-00', '0989999273', 'Nghệ An', 'huypd@gmail.com', 1, 0, '2022-01-19 14:24:45', '2021-12-19 07:07:51'),
(13, 'namnt0413', '96e79218965eb72c92a549dd5a330112', 'Nguyễn Tuấn', 'Nam', './assets/image/user/cat.jpg', '2001-04-13', '0367099786', 'số 31,Vĩnh quỳnh, Thanh Trì, Hà Nội', 'namnt0413@gmail.com', 1, 321000, '2022-01-19 17:12:46', '2021-04-09 15:27:39'),
(14, 'ngochan235', '25f9e794323b453885f5181f1b624d0b', 'Trần Ngọc', 'Hân', './assets/image/user/a.jpg', '2002-05-23', '0978643154', '731 Tran Hung Dao, Q5, TpHCM', 'ngochan235@yahoo.com', 1, 818500, '2022-01-19 19:07:53', '2021-10-31 11:47:54'),
(15, 'minhlong95', '25f9e794323b453885f5181f1b624d0b', 'Vũ Minh', 'Long', './assets/image/user/anh-anime-trai-dep-che-mat_104400036.jpg', '1995-03-08', '0654984534', '50/34 Le Dai Hanh, Q10, TpHCM', 'longvm@outlook.com', 1, 617500, '2022-01-19 19:11:43', '2021-11-18 17:15:38'),
(16, 'ngoclinh74', '25f9e794323b453885f5181f1b624d0b', 'Trần Ngọc', 'Linh', './assets/image/user/avatar-gai-xinh-49.jpg', '2005-07-04', '0123456789', '45 Nguyen Canh Chan, Q1, TpHCM', 'linhtn@gmail.com', 1, 1477000, '2022-01-19 19:14:14', '2021-05-19 17:16:05'),
(17, 'nhatminh2k6', '25f9e794323b453885f5181f1b624d0b', 'Nguyễn Nhật', 'Minh', './assets/image/user/5918d8e9040516b65f93c75a9c5b8175(1).jpg', '2006-12-08', '0648946182', 'Thanh Xuân, Hà Nội', '', 1, 668000, '2022-01-20 01:14:45', '2021-06-17 03:33:38'),
(18, 'thuonglh28', '25f9e794323b453885f5181f1b624d0b', 'Lê Hoài ', 'Thương', './assets/image/user/zzzz.jpg', '2003-02-28', '0321654897', '227 Nguyen Van Cu, Q5, TpHCM', 'thuonglh@yahoo.com', 1, 567000, '2022-01-19 19:20:32', '2021-07-23 19:46:16'),
(19, 'tamnguyen71', '25f9e794323b453885f5181f1b624d0b', 'Nguyễn Văn ', 'Tâm', NULL, NULL, NULL, NULL, NULL, 1, 567000, '2022-01-19 17:18:02', '2021-04-20 10:37:02'),
(20, 'lehavinh39', '25f9e794323b453885f5181f1b624d0b', 'Nguyễn Thành', 'Vinh', './assets/image/user/5918d8e9040516b65f93c75a9c5b8175.jpg', '2000-06-13', '0354564864', '204 Thượng Đình, Thanh Xuân Hà Nội', 'vinhle@gmail.com', 1, 1176000, '2022-01-19 22:12:32', '2021-03-25 17:18:57'),
(21, 'yen2104', '25f9e794323b453885f5181f1b624d0b', 'Lê Thị Phi ', 'Yến', './assets/image/user/zz.jpg', '1997-11-26', '098712345', 'Ngõ 11 Khuất Duy Tiến, Thanh Xuân, Hà Nội', 'yenltp@yahoo.com.vn', 1, 1193000, '2022-01-19 22:17:21', '2021-02-17 17:19:32'),
(22, 'thanhtuan246', '25f9e794323b453885f5181f1b624d0b', 'Ngô Thanh', 'Tuấn', NULL, '1985-03-23', '0367099786', 'Số 2 BT 16B5 đường, P. Nguyễn Văn Lộc, Hà Đông, Hà Nội', 'ngotuan@gmail.com.vn', 1, 2918000, '2022-01-19 22:22:35', '2021-12-15 17:19:58'),
(23, 'ntchuc207', '25f9e794323b453885f5181f1b624d0b', 'Nguyễn Thị', 'Chúc', './assets/image/user/co-4-la-may-man-3.jpg', NULL, NULL, NULL, NULL, 1, 0, '2022-01-19 22:29:37', '2021-01-15 17:20:42'),
(24, 'namduong111', '25f9e794323b453885f5181f1b624d0b', 'Tran Nam ', 'Duong', NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-01-19 20:37:55', '2022-01-19 20:37:55'),
(25, 'nduong1', '25f9e794323b453885f5181f1b624d0b', 'Nam', 'Duong', '', '2001-06-06', '', '', '', 1, 2488000, '2022-01-20 00:33:35', '2022-01-19 20:38:31'),
(27, 'namnt04131', '25f9e794323b453885f5181f1b624d0b', 'Nguyễn Hà ', 'Sơn', 'assets/image/user/zzzz(1).jpg', '2022-01-20', '0987456456', 'Hà Nội', 'namnt0413@gmail.com', 1, 0, '2022-01-20 00:31:11', '2022-01-19 23:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `book_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`book_id`, `customer_id`) VALUES
(1, 6),
(1, 7),
(1, 15),
(2, 2),
(2, 3),
(2, 5),
(2, 9),
(2, 14),
(2, 27),
(3, 5),
(3, 12),
(3, 15),
(3, 17),
(4, 5),
(4, 9),
(4, 19),
(6, 5),
(6, 11),
(6, 18),
(7, 11),
(7, 13),
(7, 18),
(8, 12),
(8, 19),
(8, 21),
(8, 22),
(9, 6),
(9, 11),
(9, 13),
(9, 19),
(10, 5),
(10, 12),
(10, 14),
(10, 15),
(11, 16),
(11, 18),
(11, 21),
(12, 13),
(12, 14),
(12, 21),
(13, 17),
(14, 15),
(14, 18),
(16, 17),
(17, 15),
(18, 15),
(18, 21),
(21, 22),
(22, 19),
(23, 17),
(24, 14),
(26, 19),
(30, 16),
(30, 18),
(31, 16),
(31, 21),
(32, 14),
(32, 18),
(33, 16),
(33, 21),
(35, 22),
(36, 23),
(37, 20),
(39, 22),
(39, 25),
(40, 20),
(41, 23),
(42, 22),
(43, 22),
(43, 25),
(44, 23),
(45, 22),
(46, 23),
(47, 22),
(48, 21);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`, `last_updated`) VALUES
(1, 'Tiểu thuyết', '2022-01-19 04:09:58'),
(2, 'Ngôn tình', '2022-01-19 04:09:58'),
(3, 'Kinh tế', '2022-01-19 04:09:58'),
(4, 'Kỹ năng sống', '2022-01-19 04:28:22'),
(5, 'Manga-Comic', '2022-01-19 04:28:22'),
(6, 'Kinh doanh', '2022-01-19 04:41:18'),
(7, 'Truyện ngắn', '2022-01-19 04:47:36'),
(8, 'Chính trị', '2022-01-19 09:46:54'),
(9, 'Tâm lý', '2022-01-19 09:46:54'),
(10, 'Ngoại ngữ', '2022-01-19 09:46:54'),
(11, 'Trinh thám', '2022-01-19 12:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `note` text DEFAULT NULL,
  `total` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `required_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `fullname`, `phone`, `address`, `note`, `total`, `created_date`, `required_date`, `status`, `last_updated`) VALUES
(1, 2, 'Nguyễn Hồng Phương', '0989999999', 'Hà Nội ', 'giao hàng vào giờ hành chính', 406000, '2022-01-19 07:11:13', NULL, 1, '2022-01-19 11:11:13'),
(2, 3, 'Vũ Tài Công', '0123456789', 'Hải Phòng', '', 402000, '2021-12-19 08:20:33', NULL, 1, '2022-01-19 11:20:33'),
(3, 2, 'Nguyễn Hồng Phương', '0989999999', 'Hà Nội', '', 426500, '2021-11-19 11:23:57', NULL, 1, '2022-01-19 11:23:57'),
(4, 2, 'Nguyễn Hồng Phương', '0989999999', 'Hà Nội', '', 1500000, '2021-10-19 16:24:31', NULL, 1, '2022-01-19 11:24:31'),
(5, 4, 'Phạm Văn Cương', '0388499767', 'Nam Định', 'giao hàng vào buổi sáng', 920000, '2021-09-27 07:40:14', NULL, 1, '2022-01-19 11:40:14'),
(6, 5, 'Nguyễn Thanh Huyền', '0989976499', 'Thanh Hóa', '', 338000, '2021-08-18 11:51:58', NULL, 1, '2022-01-19 11:51:58'),
(7, 5, 'Nguyễn Thanh Huyền', '0367898001', 'Thanh Hóa', '', 359000, '2021-07-20 08:54:45', NULL, 1, '2022-01-19 11:54:45'),
(8, 6, 'Lê Minh An', '0398999378', 'Thái Bình', '', 148000, '2021-06-18 15:56:57', NULL, 1, '2022-01-19 11:56:57'),
(9, 7, 'Lê Vũ Minh', '0989999299', 'Ninh Bình', '', 210000, '2021-05-03 12:05:37', NULL, 1, '2022-01-19 12:05:37'),
(10, 11, 'Đỗ Duy Mạnh', '0989999273', 'Hà Giang', '', 600000, '2021-04-13 13:15:38', NULL, 1, '2022-01-19 13:15:38'),
(11, 11, 'Đỗ Duy Mạnh', '0989999273', 'Hà Giang', '', 137000, '2021-03-22 13:15:48', NULL, 1, '2022-01-19 13:15:48'),
(12, 11, 'Đỗ Duy Mạnh', '0989999273', 'Hà Giang', '', 156000, '2021-02-19 13:16:03', NULL, 1, '2022-01-19 13:16:03'),
(13, 12, 'Phạm Đức Huy', '0989999273', 'Nghệ An', 'Giao hàng buổi chiều', 690000, '2021-01-19 19:18:19', NULL, 1, '2022-01-19 13:18:19'),
(14, 12, 'Phạm Đức Huy', '0989999273', 'Nghệ An', '', 286000, '2021-03-19 13:19:44', NULL, 1, '2022-01-19 13:19:44'),
(15, 9, 'Lê Văn Đức', '0989999273', 'Huế', '', 286000, '2021-02-19 18:20:48', NULL, 1, '2022-01-19 13:20:48'),
(16, 6, 'Lê Minh An', '0989999273', 'Thái bình', '', 170000, '2022-01-19 14:17:36', NULL, 1, '2022-01-19 14:17:36'),
(17, 2, 'Nguyễn Hồng Phương', '0385496431', 'Hà Nội', '', 176000, '2022-01-19 15:21:05', NULL, 1, '2022-01-19 15:21:05'),
(18, 13, 'Nguyễn Tuấn Nam', '0989788677', 'số 31,Vĩnh Quỳnh, Thanh Trì,Hà Nội', '', 88000, '2022-01-19 15:28:20', NULL, 1, '2022-01-19 15:28:20'),
(19, 13, 'Nguyễn Tuấn Nam', '012345678', 'số31,Vĩnh Quỳnh, Thanh Trì,Hà Nội', '', 90000, '2022-01-19 15:29:07', NULL, 1, '2022-01-19 15:29:07'),
(20, 2, 'Nguyễn Hồng Phương', '02438692463', 'Hà Nội', '', 85000, '2021-01-11 16:35:38', NULL, 1, '2022-01-19 16:35:38'),
(21, 14, 'Trần Ngọc Hân', '0978643154', '731 Tran Hung Dao, Q5, TpHCM', '', 331500, '2021-08-18 19:09:08', NULL, 1, '2022-01-19 19:09:08'),
(22, 14, 'Trần Ngọc Hân', '0978643154', '731 Tran Hung Dao, Q5, TpHCM', '', 90000, '2021-09-27 19:09:17', NULL, 1, '2022-01-19 19:09:17'),
(23, 14, 'Trần Ngọc Hân', '0978643154', '731 Tran Hung Dao, Q5, TpHCM', '', 397000, '2021-09-08 19:09:51', NULL, 1, '2022-01-19 19:09:51'),
(24, 15, 'Vũ Minh Long', '0654984534', '50/34 Le Dai Hanh, Q10, TpHCM', '', 227500, '2021-12-24 19:12:28', NULL, 1, '2022-01-19 19:12:28'),
(25, 15, 'Vũ Minh Long', '0654984534', '50/34 Le Dai Hanh, Q10, TpHCM', '', 70000, '2021-12-15 19:12:43', NULL, 1, '2022-01-19 19:12:43'),
(26, 15, 'Vũ Minh Long', '0654984534', '50/34 Le Dai Hanh, Q10, TpHCM', '', 320000, '2021-11-24 19:12:59', NULL, 1, '2022-01-19 19:12:59'),
(27, 16, 'Trần Ngọc Linh', '0123456789', '45 Nguyen Canh Chan, Q1, TpHCM', '', 258000, '2021-11-10 19:14:47', NULL, 1, '2022-01-19 19:14:47'),
(28, 16, 'Trần Ngọc Linh', '0123456789', '45 Nguyen Canh Chan, Q1, TpHCM', '', 990000, '2021-12-24 19:15:27', NULL, 1, '2022-01-19 19:15:27'),
(29, 16, 'Trần Ngọc Linh', '0123456789', '45 Nguyen Canh Chan, Q1, TpHCM', '', 139000, '2021-11-17 19:15:49', NULL, 1, '2022-01-19 19:15:49'),
(30, 16, 'Trần Ngọc Linh', '0123456789', '45 Nguyen Canh Chan, Q1, TpHCM', '', 90000, '2021-11-11 19:16:06', NULL, 1, '2022-01-19 19:16:06'),
(31, 17, 'Nguyễn Nhật Minh', '0648946182', 'Thanh Xuân, Hà Nội', '', 85000, '2021-12-22 19:17:40', NULL, 1, '2022-01-19 19:17:40'),
(32, 17, 'Nguyễn Nhật Minh', '0648946182', 'Thanh Xuân, Hà Nội', '', 513000, '2021-12-25 19:18:38', NULL, 1, '2022-01-19 19:18:38'),
(33, 17, 'Nguyễn Nhật Minh', '0648946182', 'Thanh Xuân, Hà Nội', '', 70000, '2021-12-16 19:18:53', NULL, 1, '2022-01-19 19:18:53'),
(34, 18, 'Lê Hoài  Thương', '0321654897', '227 Nguyen Van Cu, Q5, TpHCM', '', 407000, '2021-09-10 19:21:10', NULL, 1, '2022-01-19 19:21:10'),
(35, 18, 'Lê Hoài  Thương', '0321654897', '227 Nguyen Van Cu, Q5, TpHCM', '', 160000, '2022-01-19 19:21:50', NULL, 1, '2022-01-19 19:21:50'),
(36, 19, 'Nguyễn Văn  Tâm', '0312354989', '32/3 Tran Binh Trong, Q5, TpHCM', '', 177000, '2021-04-21 19:23:17', NULL, 1, '2022-01-19 19:23:17'),
(37, 19, 'Nguyễn Văn  Tâm', '01321616516', '32/3 Tran Binh Trong, Q5, TpHCM', '', 390000, '2021-04-21 19:23:55', NULL, 1, '2022-01-19 19:23:55'),
(38, 25, 'Tran Nam Duong', '+10962936064', 'số 10 ngõ 61/40', 'thêm sốt cà chua', 88000, '2021-03-30 20:39:36', NULL, 1, '2022-01-19 20:39:36'),
(39, 25, 'James Bond', '2356898991', 'USA', '', 1800000, '2021-08-11 21:51:55', NULL, 1, '2022-01-19 21:51:55'),
(40, 25, 'James Bond', '2356898991', 'USA', '', 600000, '2021-03-16 21:52:42', NULL, 1, '2022-01-19 21:52:42'),
(41, 20, 'Nguyễn Thành Vinh', '0354564864', '204 Thượng Đình, Thanh Xuân Hà Nội', '', 599000, '2021-12-23 22:14:33', NULL, 1, '2022-01-19 22:14:33'),
(42, 20, 'Nguyễn Thành Vinh', '0354564864', '204 Thượng Đình, Thanh Xuân Hà Nội', '', 459000, '2021-04-23 22:15:04', NULL, 1, '2022-01-19 22:15:04'),
(43, 20, 'Nguyễn Thành Vinh', '0354564864', '204 Thượng Đình, Thanh Xuân Hà Nội', '', 118000, '2021-07-07 22:15:20', NULL, 1, '2022-01-19 22:15:20'),
(44, 21, 'Lê Thị Phi  Yến', '098712345', 'Ngõ 11 Khuất Duy Tiến, Thanh Xuân, Hà Nội', '', 120000, '2021-06-16 22:17:45', NULL, 1, '2022-01-19 22:17:45'),
(45, 21, 'Lê Thị Phi  Yến', '098712345', 'Ngõ 11 Khuất Duy Tiến, Thanh Xuân, Hà Nội', '', 550000, '2021-01-05 22:18:25', NULL, 1, '2022-01-19 22:18:25'),
(46, 21, 'Lê Thị Phi  Yến', '098712345', 'Ngõ 11 Khuất Duy Tiến, Thanh Xuân, Hà Nội', 'Giao hàng trong ngày cuối tuần', 200000, '2021-12-15 22:19:35', NULL, 1, '2022-01-19 22:19:35'),
(47, 21, 'Lê Thị Phi  Yến', '098712345', 'Ngõ 11 Khuất Duy Tiến, Thanh Xuân, Hà Nội', '', 180000, '2021-03-15 22:20:01', NULL, 1, '2022-01-19 22:20:01'),
(48, 21, 'Lê Thị Phi  Yến', '098712345', 'Ngõ 11 Khuất Duy Tiến, Thanh Xuân, Hà Nội', '', 143000, '2021-05-12 22:20:14', NULL, 1, '2022-01-19 22:20:14'),
(49, 22, 'Ngô Thanh Tuấn', '0367099786', 'Số 2 BT 16B5 đường, P. Nguyễn Văn Lộc, Hà Đông, Hà Nội', 'Bọc hàng cẩn thận, giao trong tháng này', 1088000, '2021-07-16 22:24:28', NULL, 1, '2022-01-19 22:24:28'),
(50, 22, 'Ngô Thanh Tuấn', '0367099786', 'Số 2 BT 16B5 đường, P. Nguyễn Văn Lộc, Hà Đông, Hà Nội', '', 1420000, '2021-06-17 22:25:32', NULL, 1, '2022-01-19 22:25:32'),
(51, 22, 'Ngô Thanh Tuấn', '0367099786', 'Số 2 BT 16B5 đường, P. Nguyễn Văn Lộc, Hà Đông, Hà Nội', '', 410000, '2021-10-13 22:26:02', NULL, 1, '2022-01-19 22:26:02'),
(52, 27, 'Nguyễn Tuấn Nam', '098764266', 'Vĩnh Quỳnh, Thanh Trì, Hà Nội', 'Giao ngay trong ngày', 80000, '2021-11-19 23:17:45', NULL, 1, '2022-01-19 23:17:45'),
(53, 27, 'Nguyễn Tuấn Nam', '0987456456', 'Hà Nội', '', 80000, '2021-01-13 23:19:58', NULL, 1, '2022-01-19 23:19:58'),
(54, 2, 'Nguyễn Hồng Phương', '02438692463', 'Hà Nội', '', 1430000, '2022-01-20 00:16:59', NULL, 1, '2022-01-20 00:16:59'),
(55, 13, 'Nguyễn Tuấn Nam', '0367099786', 'số 31,Vĩnh quỳnh, Thanh Trì, Hà Nội', '', 143000, '2022-01-20 00:28:08', NULL, 1, '2022-01-20 00:28:08');

-- --------------------------------------------------------

--
-- Table structure for table `orders_details`
--

CREATE TABLE `orders_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `discount` float NOT NULL DEFAULT 0,
  `import_price` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_details`
--

INSERT INTO `orders_details` (`id`, `order_id`, `book_id`, `quantity`, `price`, `discount`, `import_price`) VALUES
(1, 1, 2, 2, 100000, 12000, 80000),
(2, 1, 8, 1, 250000, 20000, 200000),
(3, 2, 1, 1, 80000, 10000, 68000),
(4, 2, 2, 2, 100000, 12000, 80000),
(5, 2, 9, 2, 108000, 30000, 70000),
(6, 3, 4, 1, 119000, 20000, 90000),
(7, 3, 5, 1, 100000, 10000, 80000),
(8, 3, 6, 1, 149000, 12000, 100000),
(9, 3, 10, 1, 110500, 10000, 90000),
(10, 4, 7, 10, 163000, 13000, 120000),
(11, 5, 8, 4, 250000, 20000, 200000),
(12, 6, 6, 1, 149000, 12000, 100000),
(13, 6, 10, 2, 110500, 10000, 90000),
(14, 7, 3, 1, 90000, 5000, 75000),
(15, 7, 6, 2, 149000, 12000, 100000),
(16, 8, 1, 1, 80000, 10000, 68000),
(17, 8, 9, 1, 108000, 30000, 70000),
(18, 9, 1, 3, 80000, 10000, 68000),
(19, 10, 7, 4, 163000, 13000, 120000),
(20, 11, 6, 1, 149000, 12000, 100000),
(21, 12, 9, 2, 108000, 30000, 70000),
(22, 13, 8, 3, 250000, 20000, 200000),
(23, 14, 3, 1, 90000, 5000, 75000),
(24, 14, 10, 2, 110500, 10000, 90000),
(25, 15, 2, 1, 100000, 12000, 80000),
(26, 15, 4, 2, 119000, 20000, 90000),
(27, 16, 3, 2, 90000, 5000, 75000),
(28, 17, 2, 2, 100000, 12000, 80000),
(29, 18, 2, 1, 100000, 12000, 80000),
(30, 19, 5, 1, 100000, 10000, 80000),
(31, 20, 3, 1, 90000, 5000, 75000),
(32, 21, 2, 1, 100000, 12000, 80000),
(33, 21, 10, 1, 110500, 10000, 90000),
(34, 21, 12, 1, 163000, 20000, 120000),
(35, 22, 11, 1, 100000, 10000, 80000),
(36, 23, 30, 2, 149000, 20000, 0),
(37, 23, 32, 1, 149000, 10000, 98000),
(38, 24, 10, 1, 110500, 10000, 90000),
(39, 24, 14, 1, 80000, 10000, 69000),
(40, 24, 17, 1, 67000, 10000, 79000),
(41, 25, 1, 1, 80000, 10000, 68000),
(42, 26, 18, 1, 340000, 20000, 310000),
(43, 27, 30, 1, 149000, 20000, 0),
(44, 27, 31, 1, 159000, 30000, 110000),
(45, 28, 33, 5, 218000, 20000, 168000),
(46, 29, 32, 1, 149000, 10000, 98000),
(47, 30, 11, 1, 100000, 10000, 80000),
(48, 31, 3, 1, 90000, 5000, 75000),
(49, 32, 15, 1, 90000, 5000, 78000),
(50, 32, 18, 1, 340000, 20000, 310000),
(51, 32, 23, 1, 120000, 12000, 80000),
(52, 33, 1, 1, 80000, 10000, 68000),
(53, 34, 30, 1, 149000, 20000, 0),
(54, 34, 32, 2, 149000, 10000, 98000),
(55, 35, 11, 1, 100000, 10000, 80000),
(56, 35, 14, 1, 80000, 10000, 69000),
(57, 36, 4, 1, 119000, 20000, 90000),
(58, 36, 9, 1, 108000, 30000, 70000),
(59, 37, 22, 1, 360000, 88000, 220000),
(60, 37, 26, 1, 138000, 20000, 75000),
(61, 38, 2, 1, 100000, 12000, 80000),
(62, 39, 39, 1, 1000000, 200000, 700000),
(63, 39, 43, 1, 2000000, 1000000, 1200000),
(64, 40, 42, 1, 600000, 0, 300000),
(65, 41, 37, 1, 365000, 140000, 150000),
(66, 41, 40, 1, 400000, 26000, 200000),
(67, 42, 34, 1, 160000, 1000, 100000),
(68, 42, 35, 1, 500000, 200000, 100000),
(69, 43, 26, 1, 138000, 20000, 75000),
(70, 44, 48, 1, 165000, 45000, 120000),
(71, 45, 8, 1, 250000, 20000, 200000),
(72, 45, 18, 1, 340000, 20000, 310000),
(73, 46, 30, 2, 149000, 49000, 120000),
(74, 47, 11, 2, 100000, 10000, 80000),
(75, 48, 12, 1, 163000, 20000, 120000),
(76, 49, 21, 2, 567000, 23000, 515000),
(77, 50, 39, 1, 1000000, 200000, 700000),
(78, 50, 42, 1, 600000, 0, 300000),
(79, 50, 44, 1, 120000, 100000, 50000),
(80, 51, 36, 2, 320000, 180000, 210000),
(81, 51, 47, 1, 320000, 190000, 200000),
(82, 52, 20, 1, 95000, 15000, 75000),
(83, 53, 20, 1, 95000, 15000, 75000),
(84, 54, 12, 10, 163000, 20000, 120000),
(85, 55, 12, 1, 163000, 20000, 120000);

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `last_updated`) VALUES
(1, 'NXB Trẻ', '2022-01-19 04:13:13'),
(2, 'NXB Hội Nhà Văn', '2022-01-19 04:13:13'),
(3, 'NXB Hà Nội', '2022-01-19 04:13:13'),
(4, 'NXB Tổng Hợp', '2022-01-19 04:13:13'),
(5, 'NXB Lao Động', '2022-01-19 04:13:13'),
(6, 'NXB Công Thương', '2022-01-19 04:15:38'),
(7, 'NXB Bách Khoa', '2022-01-19 04:15:38'),
(8, 'NXB Kim Đồng', '2022-01-19 04:15:38'),
(9, 'NXB Thanh Niên', '2022-01-19 04:15:38'),
(10, 'NXB Giáo Dục', '2022-01-19 04:15:38'),
(11, 'NXB Dân Trí', '2022-01-19 14:58:18'),
(12, 'NXB Phụ Nữ Việt Nam', '2022-01-19 15:16:23'),
(13, 'NXB Thế Giới', '2022-01-19 15:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rating` int(1) DEFAULT NULL,
  `tittle` varchar(50) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `book_id`, `customer_id`, `rating`, `tittle`, `content`, `created_date`, `last_updated`) VALUES
(1, 2, 4, NULL, '', 'Sách Hay, Rất bổ ích\r\n', '2022-01-19 11:43:26', '2022-01-19 11:43:26'),
(2, 1, 4, NULL, '', 'Sách giao nhanh, đúng giờ hành chính\r\nGiá cả hợp lí', '2022-01-19 11:44:01', '2022-01-19 11:44:01'),
(3, 8, 4, NULL, '', 'Sách hơi mắc, tuy nhiên nội dung rất hay và hữu ích. \r\nSẽ ủng hộ shop nhiêu hơn\r\n', '2022-01-19 11:44:43', '2022-01-19 11:44:43'),
(4, 6, 5, NULL, '', 'Sách giá rẻ, Nội dung hay', '2022-01-19 11:51:08', '2022-01-19 11:51:08'),
(5, 10, 5, NULL, '', 'Bìa sách khá mỏng, Shop tư vấn nhiệt tình', '2022-01-19 11:54:12', '2022-01-19 11:54:12'),
(6, 9, 6, NULL, '', 'Sách Có nhiều ví dụ thực tiễn rất thiết thực', '2022-01-19 11:55:54', '2022-01-19 11:55:54'),
(7, 1, 6, NULL, '', 'Giao hàng Nhanh, Sách rất hay', '2022-01-19 11:56:35', '2022-01-19 11:56:35'),
(8, 1, 7, NULL, '', 'Đã mua của shop 3 lần nhưng lần nào cũng rất hài lòng\r\n', '2022-01-19 12:05:23', '2022-01-19 12:05:23'),
(9, 10, 12, NULL, '', 'Nội dung sách rất hay', '2022-01-19 13:18:59', '2022-01-19 13:18:59'),
(10, 3, 12, NULL, '', 'Sách rất hay, Sẽ còn ủng hộ shop nhiều\r\n', '2022-01-19 13:19:37', '2022-01-19 13:19:37'),
(11, 2, 2, NULL, '', 'Sách rất hay, sẽ ủng hộ shop nhiều', '2022-01-19 15:20:09', '2022-01-19 15:20:09'),
(12, 4, 27, NULL, 'Sách hay, thú vị', 'Sách có nội dung hấp dẫn', '2022-01-19 23:15:29', '2022-01-19 23:15:29'),
(13, 12, 16, NULL, 'Mình rất thích sách này', 'Đây là một trong những cuốn sách mình yêu thích nhất. Nó là một cuốn sách tuyệt vời. Thật sự tuyệt vời. Mình gần như xúc động với những câu nói của tác giả. Cuốn sách nói về 3 câu hỏi lớn của đời người Mình đã sống một cách khôn ngoan chưa? Mình đã yêu thương thật sự chưa? Mình đã cống hiến thật nhiều chưa? Người ta nói “ Người giỏi là người biết rút kinh nghiệm từ bản thân. Người xuất sắc là người biết rút kinh nghiệm từ người khác” 3 câu hỏi này sẽ là kim chỉ nam để bạn tìm ra một cuộc sống đúng nghĩa, sẽ không bao giờ nói hai từ “ hối hận”', '2022-01-20 01:05:04', '2022-01-20 01:05:04'),
(14, 12, 17, NULL, 'trải nghiệm đọc thú vị và đáng giá', 'Sách kể về chàng trai không may gặp tai nạn gần như rơi vào bế tắc. Thì tại đây anh gặp lại người cha của mình. Trước khi ông chết để lại cho anh một bài học vô cùng quý giá. Vì vậy mà anh đã can đảm mở ra cánh cửa mới của cuộc đời. Anh lần lượt gặp ba người bạn của cha mình để tìm ra ý nghĩa của cuộc sống. Với những bài học vô cùng ý nghĩa những nhân vật hư cấu này đã khiến tôi phải suy nghĩ lại về cuộc sống và thái độ sống của mình. Qua cuốn sách bạn có thể hiểu được sự giàu có thiếu thốn điều quan trọng gì.', '2022-01-20 01:06:29', '2022-01-20 01:06:29'),
(16, 12, 18, NULL, '面白い本', 'Sách rất hay nói về một nhân vật hư cấu trong truyện được sự chỉ dạy của ba người thầy về ý nghĩa của cuộc sống. Người thầy đầu tiên là một nhà sư ông giải thích về ý nghĩa của cuộc sống qua triết học, cách thế giới vận hành và sống đúng với bản ngã đích thực. Người thầy thứ hai là một nhà lướt sóng, ông dạy cách mở rộng trái tim và sống hết mình với niềm đam mê cháy bỏng. Người thầy cuối cùng là một nữ CEO với một góc nhìn tích cực về mục đích thật sự của sự nghiệp, cách làm việc với mong muốn đem lại những lợi ích tốt đẹp nhất cho khách hàng và xã hội cùng với sứ mệnh để lại một di sản cho đời. Đây là một cuốn sách tuyệt vời mình đọc được. Hy vọng các bạn cũng có cho mình quyển sáng này.', '2022-01-20 01:12:41', '2022-01-20 01:12:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books_authors`
--
ALTER TABLE `books_authors`
  ADD UNIQUE KEY `author_id` (`author_id`,`book_id`),
  ADD KEY `books_authors_ibfk_2` (`book_id`);

--
-- Indexes for table `books_genres`
--
ALTER TABLE `books_genres`
  ADD UNIQUE KEY `book_id` (`book_id`,`genres_id`),
  ADD KEY `books_genres_ibfk_2` (`genres_id`);

--
-- Indexes for table `books_library`
--
ALTER TABLE `books_library`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`book_id`);

--
-- Indexes for table `books_publishers`
--
ALTER TABLE `books_publishers`
  ADD UNIQUE KEY `book_id_2` (`book_id`,`publisher_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `publisher_id` (`publisher_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD UNIQUE KEY `book_id` (`book_id`,`customer_id`),
  ADD KEY `favorites_ibfk_2` (`customer_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`book_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `books_library`
--
ALTER TABLE `books_library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books_authors`
--
ALTER TABLE `books_authors`
  ADD CONSTRAINT `books_authors_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `books_authors_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `books_genres`
--
ALTER TABLE `books_genres`
  ADD CONSTRAINT `books_genres_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_genres_ibfk_2` FOREIGN KEY (`genres_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `books_library`
--
ALTER TABLE `books_library`
  ADD CONSTRAINT `books_library_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `books_publishers`
--
ALTER TABLE `books_publishers`
  ADD CONSTRAINT `books_publishers_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_publishers_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD CONSTRAINT `orders_details_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
