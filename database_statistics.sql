 THỐNG KÊ CHUNG :
- Tổng số Tk hiện có, tổng số sách bán được, tổng số đơn đã đặt, tổng số tác giả, NXB,
Cho biết trị giá hóa đơn cao nhất, thấp nhất là bao nhiêu ?

THỐNG KÊ CHI TIẾT :
- Lãi ( Doanh thu - Chi phí nhập) qua từng năm
- Sách được yêu thích nhất, bán chạy / bán ít
- Top 10 Khách hàng có số tiền mua MAX, tìm khách hàng có số lần mua hàng nhiều nhất.
- Top những thể loại sách được mua nhiều / ít
- Top các tác giả đc mua nhiều / ít

- Tính doanh thu bán hàng của từng tháng trong năm
- Số sách bán ra từng tháng



16/1
THỐNG KÊ CHI TIẾT :
- Lãi ( Doanh thu - Chi phí nhập) qua từng năm	(LINE)					DONE


- TOP Sách được yêu thích nhất, 
SELECT book_id, books.tittle ,COUNT(book_id) 
FROM `favorites`INNER JOIN books ON favorites.book_id = books.id 
GROUP BY(book_id)
ORDER BY COUNT(book_id) DESC 
LIMIT 10

- TOP sách bán chạy / bán ít
SELECT book_id,SUM(quantity) AS tongsoluong
FROM `orders_details` 
GROUP BY book_id
ORDER BY tongsoluong DESC / ASC
LIMIT 10


- Top 10 Khách hàng có số tiền mua MAX, tìm khách hàng có số lần mua hàng nhiều nhất.
SELECT id, first_name,last_name,money_spent
FROM `customers`
ORDER BY money_spent DESC
LIMIT 10

- Top những thể loại sách được mua nhiều / ít	DONE
SELECT SUM(quantity) AS tong ,genres_id AS theloai FROM `orders_details` 
INNER JOIN books_genres ON orders_details.book_id = books_genres.book_id
INNER JOIN orders ON orders_details.order_id = orders.id
WHERE YEAR(created_date)=2021
GROUP BY(genres_id)

- Top các tác giả đc mua nhiều / ít		DONE
				
- Số sách bán ra từng tháng, số đơn hàng						DONE
- So nguoi mua sach theo gia	(single bar)						???
