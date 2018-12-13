 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
<?php  include "includes/nav.php"; ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';
?>   
 <?php
    if(isset($_POST['submit'])){

        $to = '619559629@qq.com';
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];
    
        $mail = new PHPMailer(true);                            // Passing `true` enables exceptions
        echo $body, $email,$subject;

        try {
            $mail->CharSet  = 'UTF-8';
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'lyldaniel96@gmail.com';                 // SMTP username
            $mail->Password = 'liuyilun123';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($email, 'Mailer');
            $mail->addAddress($to, 'SomeOne');     // Add a recipient
            $mail->addReplyTo($email, 'Information');


            //Attachments

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            header('Location: index.php');
            $mail->send();

        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    
 ?>



    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="key" class="form-control" placeholder="Subject">
                        </div>
                        <div class="form-group">
                        <textarea class="form-control" id="body" name="body">
                            
                        </textarea>
                        </div>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
