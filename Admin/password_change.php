<?php
ob_start();
session_start();
    // if((isset($_SESSION['status'])!='Mail Sent') && (!empty($_SESSION['status'])))
    // {
    //     header("location:index.php");
    //     exit(0);
    // }
    if(isset($_REQUEST['token'])==null)
    {
        header("location:index.php");
        exit(0);
    }
else{
    include(__DIR__."/../include/connect.php");
    if(isset($_REQUEST['reset']))
    {
        $email=mysqli_real_escape_string($connection,$_REQUEST['email']);
        $new_pwd=mysqli_real_escape_string($connection,$_REQUEST['new']);
        $confirm_pwd=mysqli_real_escape_string($connection,$_REQUEST['confirm']);
        $token=mysqli_real_escape_string($connection,$_REQUEST['token']);

        if(!empty($_REQUEST['token']))
        {
            if((!empty($new_pwd)) && (!empty($confirm_pwd)))
            {
                if(isset($_REQUEST['reset']))
                {
                if($new_pwd!==$confirm_pwd)
                {
                    echo"<script>alert('Check password')</script>";
                }
                else
                {
                    $reset_password="UPDATE admin_login SET pwd='$new_pwd' WHERE email='$email' AND verify_token='$token'";
                    $reset_password_run=mysqli_query($connection,$reset_password);
                    if($reset_password_run)
                    {
                        header("location:index.php");
                    }
                    else{
                        echo"something went wrong".mysqli_error($connection);
                    }
                }
                }
            }
        }
    }
}//else
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Blood Buzz-Reset Password</title>
    <link rel="stylesheet" href="../Style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../img/logo.png" type="image/x-icon" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        #update{
            background-color:crimson;
            color:white;
        }
        .back_to_login{
            color:rgb(227,103,128);
        }
        .back_to_login{
			color:crimson;
		}
    </style>
  </head>
  <body>
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
			      			<h3 class="mb-4">Reset Password</h3>
			      		</div>	
			      	</div>
                            <form autocomplete="off" action="" method="post">
                            <input type="hidden" id="action" value="<?php if(isset($_REQUEST['token'])){
                                echo $_REQUEST['token'];
                            } ?>" name="token">
                            <div class="form-group mb-3">
                                <input type="password" id="text" class="form-control" name="new" required placeholder="New Password">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" id="ans" class="form-control" name="confirm" required placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
		            	    <button type="submit" name="reset" style="cursor:pointer;" class="form-control" id="update">Reset Password</button>
                            </div>
                            <p class="text-center"><a data-toggle="tab" href="index.php" class="back_to_login">Back To Login</a></p>
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