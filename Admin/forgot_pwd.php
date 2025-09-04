
<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Blood Buzz-forgot password</title>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="../File/jquery.js"></script>
	<script src="../File/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../Style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="../img/logo.png" type="image/x-icon" />
	<style>
		#submit{
            background-color:crimson;
            color:white;
			font-size:large;
        }
		p
         {
            font-size:18px;
               text-align:justify;
               text-justify:inter-word;
         }
		 #back_to_login:hover
		{
			font-size:large;
			cursor: pointer;
			font-weight:bold;
		}
		.error-message,.message
      {
         margin-bottom: 20px;
         font-size:medium;
         font-weight:bold;
         width:500px;
         height:40px;
         padding:8px;
         padding-bottom:5px;
         padding-left:25px;
         display: inline-block;
         margin-top:40px;
      }
      .error-message
      {
         background-color:#cc0000;
         color: white;
         border: 2px solid #cc0000;
      }
      .message
      {
         background-color:green;
         color: white;
         border: 2px solid green;
      }
	</style>

  </head>
  <body>


  <?php 
if(isset($_SESSION['error-message']))
{ ?>
   <p>
        <?php 
        echo '<center><div class="error-message">' . $_SESSION['error-message'] . '</div></center>';
        unset($_SESSION['error-message']);
       ?>
       </p>
<?php } ?>


    <form autocomplete="off" action="" method="post">
    <section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(../img/bbg.jpg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Reset Password </h3>
			      		</div>
								
			      	</div>
							<form autocomplete="off" action="" method="post">
              <input type="hidden" id="action" value="login">
			      		<div class="form-group mb-3">
						  <p>Enter your email address , and we'll send you a link to get back into your account.</p>
			      			<label class="label" for="name">Email</label>
			      			<input type="email" id="email" class="form-control" placeholder="Email" name="email" required>
			      		</div>
		            
		            <div class="form-group">
		            	<button type="submit" name="reset" class="form-control" id="submit">Send Reset Password Link</button><br>
						<p class="text-center"><a id="back_to_login"data-toggle="tab" href="index.php" class="sign_up">Back To Login</a></p>
		            </div>
		          </form>
		        </div>
		      </div>
			</div>
		</div>
	</div>
</section>
</form>
</body>
</html>


<?php
include '../Include/connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';


function send_password_reset($get_email,$token)
	{
		$mail = new PHPMailer(true);
		//Server settings
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->SMTPAuth   = true;  

		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		//Enable SMTP authentication
		$mail->Username   = 'bansarisorathiya74@gmail.com';                     //SMTP username
		$mail->Password   = "ckll maic lavq gyva";                               //SMTP password

		// $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
		$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	
		//Recipients
		$mail->setFrom('bansarisorathiya74@example.com', 'Blood Buzz');
		$mail->addAddress($get_email);     //Add a recipient

		$mail->isHTML(true);    
		$mail->Subject = 'Reset Your Password';

		$email_template="
		<div class='card' style='width: 18rem;margin-left:500px;'>  
        <div class='card-body'>
          <a class='card-text' style='color: #c21807;;font-size:30px;font-weight:bold;font-family:helvetica;text-align:left;margin-left:10px;margin-top:20px;text-decoration:none;' href='http://localhost/Blood/Member'>
            <img src='https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcStdj407c7vChyBW5_cHOgdZO6dK3vtp7s6KFeTDXRHfFkgSP_i' alt='Logo' style='float:left;width:70px;height:60px;font-size:small;margin-top:-10px;'/>Blood Buzz</a><br><br>
          <h1 class='card-title'>Hello</h1>
          <h3 class='card-subtitle mb-2 text-muted'>Blood Buzz Team</h3>
          <p class='card-text'>No need to worry ,you can reset your Blood Buzz Password by clicking the link below :<br>
          <a href='http://localhost/Blood/Admin/password_change.php?token=$token&email=$get_email' class='card-link'>Reset Password</a></p>
          <h3 class='card-subtitle mb-2 text-muted'>Have a nice rest day</h3>
        </div>
      </div>
		";
    	$mail->Body= $email_template;
		$mail->send();
	}


try
{
	if(isset($_POST['reset']))
	{
		$email=mysqli_real_escape_string($connection,$_POST['email']);
		$token=md5(rand());
		$check_email="SELECT email FROM admin_login WHERE email='$email' LIMIT 1";
		$check_email_run=mysqli_query($connection,$check_email);

		if(mysqli_num_rows($check_email_run) > 0)
		{
			$row=mysqli_fetch_array($check_email_run);
			$get_email=$row['email'];
			$update_token="UPDATE admin_login SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
			$update_token_run=mysqli_query($connection,$update_token);

			if($update_token_run)
			{
				send_password_reset($get_email,$token);
				header("location:mailSent.php"); 
			}
				else
				{
					$_SESSION['error-message']="Token Not Updated";
					//   header("location:index.php");
					exit(0);
				}
		}
		else
		{
			$_SESSION['error-message']="No Email Found !";
			//   header("location:index.php");
			//   exit(0);
		}
	}
}
catch (PDOException $e) 
   {
      // Handle query errors
      $error=$e->getMessage();
      $_SESSION['error-message'] = "Database error: " . $error;
   }
?>