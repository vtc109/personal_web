<!-- Đây là phần code đầu tiên của repostiry
 -->
<!DOCTYPE html>
<html>
    <head>
        <title>Huệ béo như Heo</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>

        <h1 style="color: #FF725E; text-align:center">Shopee</h1> 
        <p style="text-align:center; color: #37474F ">Trang web này được làm ra với mục đích bán hàng</p>
    </body>
</html>

<?php
//todo: in ra màn hình
    echo"Tự học <br><h1> PHP</h1>";     //chèn HTML vào php
    
//todo: biến
    $value = "tai cong"; //biến có ngoặc""
    $namsinh = 2001;   // biến số không cần ""
    echo $value."<br>".$namsinh."<br>";
    echo "Năm sinh là".$namsinh ;
//todo: hằng
    define("hang", "10", true);     
    //define ("Tên hằng", "giá trị hằng", "true để tên hằng không bị phân biệt in hoa hay thường")
    echo "<br>"."Giá trị của hằng là : ". hang;

//todo: ngoặc '' và ngoặc ""
    echo "<br>".$value; //in ra bình thường
    echo "<br>"."$value"; //vẫn nhận dạng và in ra biến value
    echo "<br>".'$value'; //sẽ in ra $value thay vì giá trị của nó

//todo: Câu lệnh echo 
    echo "<h1> Huệ béo như con heo</h1> <br>";    //cho thành thẻ h1
    echo "Tôi 20 tuổi";
    echo "<br>".$value.$namsinh;

//todo: print và echo
    echo "<br>"."hello";
    print "<br>"."hello";

//todo: if else 
    // if (dieukien){
    //     ket qua tra ve
    // }
    $index = 15;
    if ($index <= 4){
        echo "<br>"."Biến (a =".$index.") <= 4";
    }
    // }else
    // {
        //     echo "<br>"."Biến (a = ".$index.") < 4";
        // }
    //*Câu lệnh else if
    elseif ($index > 5){
        echo "Biến (a = ".$index.") < 5";
    }

    if ($index == 15){
        echo "<br>"."Vũ Tài Công ";
    }
    $name = "Vũ Tài Công";
    if ($name == "Vũ Tài Công"){
        echo "<br>". "Sinh năm".$namsinh;
    }

    $string = "123456";
//todo:Chuỗi 
    //*strlen lấy độ dài chuẩn
    echo "<br>"."Số kí tự của dãy 123456 là : ".strlen($string);
    //*str_word_count đếm số từ
    echo "<br>"."Số từ của chuỗi vu tai cong là : ".str_word_count("vu tai cong");
    //*strrev đảo ngươcj reverse
    echo strrev($string);
    //*strpos trả về index khi tìm kiếm, bắt đầu từ 0
    echo "<br>".strpos ("vu tai cong", "g");
    //*str_replace a, b, c. a= cái cần thay, b=cái thay thành, c=văn bản
    echo "<br>".str_replace("tai", "van", "vu tai cong");

//todo: kiểm tra kiểu dữ liệu 
    $a = "Công";
    echo "<br>";
    var_dump($a);
    //*dữ liệu trả về string(5)"Công" là kiểu và số kí tự

    $a = 100;
    echo "<br>";
    var_dump($a);
    //*dữ liệu trả về int(100)

//todo: Các kiểu dữ liệu liệu 
    // string
    // interger
    // float
    // boolean
    // array
    // object
    // null
    // resource
    $b = false;
    echo "<br>";
    var_dump($b);
    if ($b == 1) {
        echo $b." == 1";
    }else{
        echo $b." == 0";
    }
    //*Null
    $c =  NULL;
    var_dump($c);       //trả về Null, không có gì

//todo: Vài toán tử như C
    $a = 100;
    $b = $a;
    $b+= 100;   //*gán a = (a-100)     a=200
    echo "<br>"."a=100 gán bằng a+=100 = ".$b;

    $c = $a ;
    $c %= 9 ;   //*phép chia lấy dư 200/9 dư 2
    echo "<br>"."200 chia 9 dư ".$c;

    $d = $a;
    $d *= 5;
    echo "<br>"."100 * 5 = ".$d;

    $x = 5;
    $y = "5";
    if ($x === $y)          //* so sánh cả về kiểu và về giá trị
    {
        echo "<br>"."Hai cái này = nhau";
    }else{
        echo "<br>"."Hai cái này != nhau";
    }
    if ($x == $y){
        echo "<br>"."Hai cái này bằng nhau về giá trị và kiểu";
    }
//todo: Toán tử liên kết
    // $i = 1;
    // $o = 2;
    // if ($i==1 && $o==2)      echo "<br>"."Đúng1";
    // else ($i==1 or $o==2)       echo "<br>"."Đúng2";
    // else ($i==1 xor $o==2)       echo "<br>"."Đúng2";  //*cái này chạy khi 1 trong 2 cái đúng, nếu 2 đúng thì k chạy
    
?>