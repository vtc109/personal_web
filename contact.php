<?php include 'header.php' ?>

        <!-- Page Content -->
    


    
<!-- How to change your own map point
    1. Go to Google Maps
    2. Click on your location point
    3. Click "Share" and choose "Embed map" tab
    4. Copy only URL and paste it within the src="" field below
-->
    <div class="address-info-container">
        <div id="map-container">
            <h2 class="section-heading">Địa chỉ cửa hàng: </h2>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7172162244697!2d105.84526041476283!3d21.003969686011754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac743ba55555%3A0xb835dcc0410fa11!2zTmjDoCBTw6FjaCBCw6FjaCBLaG9h!5e0!3m2!1svi!2s!4v1637007397716!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        
        
        <div class="right-content">
            <h2 class="section-heading">Thông tin liên lạc: </h2>
            <ul class="li-info-container">
                <li class="li-info"><svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
</svg><a href="#">Địa chỉ </a></li>
                <li class="li-info"><svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg><a href="#">Hoạt động </i></a></li>
                <li class="li-info"><svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
</svg><a href="#">Địa chỉ mail </i></a></li>
                <li class="li-info"><svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
</svg><a href="#">Facebook</i></a></li>
            </ul>
        </div>
      
          
    </div>
         <?php
        // 2 phuong thuc de gui mail
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        if (isset($_GET['action']) && $_GET['action'] == "send") {
            if (empty($_POST['email'])) { //Kiểm tra xem trường email có rỗng không?
                $error = "Bạn phải nhập địa chỉ email";
            } elseif (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error = "Bạn phải nhập email đúng định dạng";
            } elseif (empty($_POST['content'])) { //Kiểm tra xem trường content có rỗng không?
                $error = "Bạn phải nhập nội dung";
            }
            if (!isset($error)) {
                include 'library.php'; // include the library file

                require 'vendor/autoload.php';  // call autoload de goi ra toan thu vien 
                $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                try {
                    //Server settings
                    $mail->CharSet = "UTF-8";
                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = SMTP_HOST;  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = SMTP_UNAME;                 // SMTP lay username
                    $mail->Password = SMTP_PWORD;                 // lay mat khau 
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = SMTP_PORT;  

                    //Recipients : TH SHOP gui cho user
                    $mail->setFrom(SMTP_UNAME, "SixteenClothingShop");      // ten nguoi gui
                    $mail->addAddress($_POST['email'], 'Customers');     // Add a recipient | name is option     ten nguoi nhan
                    $mail->addReplyTo(SMTP_UNAME, 'Customers');

//                    $mail->addCC('CCemail@gmail.com');
//                    $mail->addBCC('BCCemail@gmail.com');
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = $_POST['title'];
                    $mail->Body = $_POST['content'];
                    $mail->AltBody = $_POST['content']; //None HTML
                    $result = $mail->send();
                    if (!$result) {
                        $error = "Có lỗi xảy ra trong quá trình gửi mail";
                    }
                    //  try : co gang thuc hien ben trong ham nya, catch: ngoai le thi se dc bat vao ham catch
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            }
            ?>
             <div class = "container">
                <div class = "error"><?= isset($error) ? $error : "Gửi email thành công" ?></div>
                <a href = "index.php">Quay lại form gửi mail</a>
            </div>
             <?php } else {
            ?>
        <div class="container contact-content-container">
            <div class="container-contact100">
                <div class="wrap-contact100">
                <span class="contact100-form-title">
                        Gửi phản hồi cho chúng tôi!
                </span>
                <form class="contact-form contact100-form validate-form">
                    
                   

                    <div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Name is required">
                        <span class="label-input100">Họ và tên *</span>
                        <input class="input100" type="text" name="name" placeholder="Enter your name">
                    </div>

                    <div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <span class="label-input100">Địa chỉ email *</span>
                        <input class="input100" type="text" name="email" placeholder="Enter your email">
                    </div>

                    <div class="wrap-input100">
                        <span class="label-input100">Chủ đề bạn muốn phản hồi</span>
                        <input class="input100" type="text" name="web" placeholder="">
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Message is required">
                        <span class="label-input100">Nội dung</span>
                        <textarea class="input100" name="message" placeholder="Your message here..."></textarea>
                    </div>

                    <div class="container-contact100-form-btn">
                        <div class="wrap-contact100-form-btn">
                            <div class="contact100-form-bgbtn"></div>
                            <button class="contact100-form-btn">
                                Gửi
                            </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="contact-img">
                
            </div>
        </div>

    <?php } ?><!-- end else -->
            
    </body>
		<!-- Optional JavaScript -->
		<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
	
		<!-- custom js file link  -->
		<script src="./assets/js/main.js"></script>
        <script src="./assets/js/header.js"></script>
</body>

<style>
    /* * {
        box-sizing: border-box;
    } */
    
    .address-info-container {
        padding-left: 6rem;
        display: grid;
        grid-template-columns: 60fr 30fr;
        margin-top: 6rem;
        height: 100vh;
        column-gap: 6rem;
    }
    .section-heading {
        margin-bottom: 3rem;
        font-size: 2.5rem;
        font-weight: 600;
    }

    iframe {
        width: 100%;
    }
    .li-info-container {
        list-style: none;
        display: flex; 
        flex-direction: column;
        gap: 1rem;
    }

    .li-info {
        
        display: flex; 
        align-items: center;
        margin-bottom: 1.3rem;
    }

    li a:link, li a:visited {
        display: inline-block;
        text-decoration: none;
        font-size: 1.5rem;
        color: #27ae60;
        padding: 3px;
    }
    .icon {
        stroke: #27ae60;
        width: 32px; 
        height: 32px;
        
    }
    .container {
        max-width: 100%;
        padding: 0;
        
    }
    .contact-content-container {
        display: grid;
        grid-template-columns: 1fr 1.3fr; 
        
        padding-left: 8rem;
        background-color: #27ae60;
    }
    .contact100-form-title {
        display: inline-block;
        font-size: 2.5rem;
        font-weight: 600;
        margin-top: 2rem;
        margin-bottom: 1.5rem;
    }
    .contact-form {
        display: flex;
        flex-direction: column;
    }
    
    .label-input100 {
        display: block;
        font-size: 1.5rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .input100 {
        width: 70%;
        padding: 1rem;
        font-size: 1.3rem;
        font-family: inherit;
        color: inherit;
        border: none;
        background-color: #e9f7ef;
        border-radius: 9px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
    }

    .contact-img {
        background-image: linear-gradient(
        to right bottom,
        rgba(20,87,48,0.25),
        rgba(16,70,38,0.25)
        ),
    url("assets/image/contact-section-img.jpg");
    background-size: cover;
    background-position: center;
}

    .contact100-form-btn {
        font-size: 15px;
        font-weight: 600;
        background-color: #104626;
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border-radius: 9px;
        padding: 9px 24px;
        margin-top: 12px;
        margin-bottom: 24px;
    }
</style>
</html>     
